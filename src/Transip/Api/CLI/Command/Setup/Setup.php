<?php

namespace Transip\Api\CLI\Command\Setup;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Settings\Settings;
use Transip\Api\CLI\Util\JSONFile;
use Transip\Api\Client\TransipAPI;
use RuntimeException;

class Setup extends AbstractCommand
{
    const DEFAULT_API_URL = 'https://api.transip.nl/v6/';

    protected function configure(): void
    {
        $this->setName('setup')
            ->setDescription('Configure your access token')
            ->addOption(Field::API_URL, null, InputOption::VALUE_OPTIONAL, 'API url', self::DEFAULT_API_URL)
            ->addOption(Field::API_TOKEN, null, InputOption::VALUE_REQUIRED, 'API token')
            ->setHelp('Set your access token to connect to your account at TransIP');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $formatter = $this->getHelperSet()->get('formatter');
        $helper = $this->getHelper('question');

        /*
         * Greetings to user
         */
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

        /*
         * First question: What is the restapi url?
         */
        $apiUrl = $input->getOption(Field::API_URL);
        $urlQuestion = new Question("Enter the RestAPI url [<comment>{$apiUrl}</comment>]: ", $apiUrl);

        $apiUrl = $helper->ask($input, $output, $urlQuestion);
        $input->setOption(Field::API_URL, $apiUrl);

        /*
         * Second question: What is the restapi token?
         */
        $token = $input->getOption(Field::API_TOKEN);
        $tokenQuestion = new Question("Enter your RestAPI token [<comment>{$token}</comment>]: ", $token ?? null);

        $token = $helper->ask($input, $output, $tokenQuestion);
        $input->setOption(Field::API_TOKEN, $token);
    }

    /**
     * @throws RuntimeException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiUrl    = $input->getOption(Field::API_URL);
        $apiToken  = $input->getOption(Field::API_TOKEN);

        if (strlen($apiToken) < 2) {
            throw new RuntimeException('Provided RestAPI token is invalid');
        }

        /*
         * Test connection to the api
         */
        $response = (new TransipAPI($apiToken, $apiUrl))->products()->getAll();
        if (is_object($response) || is_array($response)) {
            $output->writeln('');
            $output->writeln('API connection successful');
        }

        /*
         * Ensure config directory exists
         */
        $config_dir = Settings::getConfigDir();
        if (!is_dir($config_dir)) {
            if (!mkdir($config_dir) && !is_dir($config_dir)) {
                throw new RuntimeException("Directory '{$config_dir}' could not be created");
            }
        }

        /*
         * Create configuration file
         */
        $configFilePath = Settings::getConfigFileName(true);
        $data = [
            Field::API_URL   => $apiUrl,
            Field::API_TOKEN => $apiToken,
        ];
        JSONFile::write($configFilePath, $data);

        $output->writeln("Config file saved in {$configFilePath}");
        $output->writeln('');
    }
}
