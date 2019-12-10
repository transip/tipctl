<?php

namespace Transip\Api\CLI\Command\Setup;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
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
            ->setDescription('Configure your access token')
            ->addOption(Field::API_URL, null, InputOption::VALUE_OPTIONAL, 'API url', Settings::TRANSIP_API_ENDPOINT)
            ->addOption(Field::API_TOKEN, null, InputOption::VALUE_REQUIRED, 'API token')
            ->setHelp('Set your access token to connect to your account at TransIP');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $helper = $this->getHelper('question');

        $this->greetUser($output);

        // First question: What is the restapi url?
        $apiUrl = $input->getOption(Field::API_URL);
        $urlQuestion = new Question("Enter the RestAPI url [<comment>{$apiUrl}</comment>]: ", $apiUrl);

        $apiUrl = $helper->ask($input, $output, $urlQuestion);
        $input->setOption(Field::API_URL, $apiUrl);

        // Second question: What is the restapi token?
        $token = $input->getOption(Field::API_TOKEN);
        $tokenQuestion = new Question("Enter your RestAPI token [<comment>{$token}</comment>]: ", $token);

        $token = $helper->ask($input, $output, $tokenQuestion);
        $input->setOption(Field::API_TOKEN, $token);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiUrl    = $input->getOption(Field::API_URL);
        $apiToken  = $input->getOption(Field::API_TOKEN);

        if (strlen($apiToken) < 2) {
            throw new RuntimeException('Provided RestAPI token is invalid');
        }

        // Test connection to the api
        try {
            $response = (new TransipAPI($apiToken, $apiUrl))->test()->test();
        } catch (Exception $exception) {
            $response = false;
        }

        if ($response === true) {
            $output->writeln('');
            $output->writeln('<fg=green>API connection successful</>');
        } else {
            $output->writeln('');
            $output->writeln('<fg=red>API connection failed</>');

            $tokenQuestion = new Question("Save to config file anyway? [<comment>No</comment>]: ", 'No');
            $helper        = $this->getHelper('question');
            $shouldSave    = $helper->ask($input, $output, $tokenQuestion);
            $shouldSave    = filter_var($shouldSave, FILTER_VALIDATE_BOOLEAN);

            if ($shouldSave === false) {
                return;
            }
        }

        // Ensure config directory exists
        $configDirectory = Settings::getConfigDir();
        $filesystem = new Filesystem();
        try {
            $filesystem->mkdir($configDirectory);
        } catch (IOException $e) {
            throw new RuntimeException("Config directory '{$e->getPath()}' could not be created");
        }

        // Create configuration file
        $configFilePath = Settings::getConfigFilePath();
        $data = [
            Field::API_URL => $apiUrl,
            Field::API_TOKEN => $apiToken,
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
