<?php

namespace Transip\Api\CLI\Command\Setup;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Settings\Settings;
use Transip\Api\CLI\Settings\Provider\Json;
use Transip\Api\Client\TransipAPI;
use RuntimeException;

class Setup extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('setup')
            ->setDescription('Configure your API access credentials')
            ->addOption(Field::API_URL, null, InputOption::VALUE_OPTIONAL, 'API url', Settings::TRANSIP_API_ENDPOINT)
            ->addOption(Field::API_LOGIN, null, InputOption::VALUE_REQUIRED, 'API token')
            ->addOption(Field::API_PRIVATE_KEY, null, InputOption::VALUE_REQUIRED, 'API Private key')
            ->addOption(Field::API_USE_WHITELIST, null, InputOption::VALUE_OPTIONAL, 'API whitelist enabled', true)
            ->setHelp('Set your key to connect to your account at TransIP');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $helper = $this->getHelper('question');

        $this->greetUser($output);

        // First question: What is the restapi url?
        $apiUrl      = $input->getOption(Field::API_URL);
        $urlQuestion = new Question("Enter the RestAPI url [<comment>{$apiUrl}</comment>]: ", $apiUrl);

        $apiUrl = $helper->ask($input, $output, $urlQuestion);
        $input->setOption(Field::API_URL, $apiUrl);

        // Second question: What is the username?
        $login         = $input->getOption(Field::API_LOGIN);
        $tokenQuestion = new Question("Enter your TransIP Username [<comment>{$login}</comment>]: ", $login);

        $login = $helper->ask($input, $output, $tokenQuestion);
        $input->setOption(Field::API_LOGIN, $login);

        // Third question: use the IP whitelist?
        $apiUseWhitelist   = $input->getOption(Field::API_USE_WHITELIST);
        $whitelistQuestion = new ConfirmationQuestion(
            "Use IP Whitelisting? [<comment>Yes</comment>]: ",
            $apiUseWhitelist
        );

        $apiUseWhitelist = $helper->ask($input, $output, $whitelistQuestion);
        $input->setOption(Field::API_USE_WHITELIST, $apiUseWhitelist);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiUrl    = strval($input->getOption(Field::API_URL));
        $login     = strval($input->getOption(Field::API_LOGIN));
        $whitelist = boolval($input->getOption(Field::API_USE_WHITELIST));

        $helper = $this->getHelper('question');

        // Last question: What is the restapi private key?
        $output->writeln('Enter your RestAPI Private Key:');
        $keyQuestion = new Question('');

        $privateKey = '';

        // multiline input hack
        for ($i = 0; $i < 30; $i++) {
            $privateKeyPart = $helper->ask($input, $output, $keyQuestion);
            $privateKey     .= $privateKeyPart . PHP_EOL;
            if (strpos($privateKeyPart, '-----END PRIVATE KEY-----') !== false || $privateKeyPart == '') {
                break;
            }
        }

        if (strlen($privateKey) < 2) {
            throw new RuntimeException('Provided RestAPI key is invalid');
        }

        // Test connection to the api
        try {
            $response = (new TransipAPI($login, $privateKey, $whitelist, '', $apiUrl))->test()->test();
        } catch (Exception $exception) {
            $response = false;
            $errorMessage = $exception->getMessage();
        }

        if ($response === true) {
            $output->writeln('');
            $output->writeln('<fg=green>API connection successful</>');
        } else {
            $output->writeln('');
            $output->writeln("<fg=red>API connection failed! {$errorMessage}</>");

            $tokenQuestion = new ConfirmationQuestion("Save to config file anyway? [<comment>No</comment>]: ", false);
            $shouldSave    = $helper->ask($input, $output, $tokenQuestion);

            if ($shouldSave === false) {
                return;
            }
        }

        // Ensure config directory exists
        $configDirectory = Settings::getConfigDir();
        $filesystem      = new Filesystem();
        try {
            $filesystem->mkdir($configDirectory);
        } catch (IOException $e) {
            throw new RuntimeException("Config directory '{$e->getPath()}' could not be created");
        }

        // Create configuration file
        $configFilePath = Settings::getConfigFilePath();
        $data           = [
            Field::API_URL                             => $apiUrl,
            Field::API_LOGIN                           => $login,
            Field::API_PRIVATE_KEY                     => $privateKey,
            Field::API_USE_WHITELIST                   => $whitelist,
            Field::SHOW_CONFIG_FILE_PERMISSION_WARNING => true,
        ];
        (new Json($configFilePath))->write($data);
        @chmod($configFilePath, 0600);

        $output->writeln("Config file saved in {$configFilePath}");
        $output->writeln('');
    }

    private function greetUser(OutputInterface $output): void
    {
        $formatter = $this->getHelperSet()->get('formatter');

        $welcomeMessage = $formatter->formatBlock(
            'Welcome to the TransIP RestAPI config generator',
            'bg=blue;fg=white',
            true
        );

        $output->writeln('');
        $output->writeln($welcomeMessage);
        $output->writeln('');
        $output->writeln('');
        $output->writeln('This command will guide you through creating your transip.json config.');
        $output->writeln('');
    }
}
