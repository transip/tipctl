<?php

namespace Transip\Api\CLI\Command\Setup;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\Client\TransipAPI;

class Setup extends AbstractCommand
{
    const API_URL = 'ApiUrl';
    const API_TOKEN = 'ApiToken';
    const DEFAULT_API_URL = 'https://api.transip.nl/v6/';

    protected function configure(): void
    {
        $this->setName('setup')
            ->setDescription('Configure your access token')
            ->addOption(self::API_URL, null, InputOption::VALUE_OPTIONAL, 'API url', self::DEFAULT_API_URL)
            ->addOption(self::API_TOKEN, null, InputOption::VALUE_REQUIRED, 'API token')
            ->setHelp('');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $formatter = $this->getHelperSet()->get('formatter');
        $helper = $this->getHelper('question');

        /*
         * Greetings to user
         */
        $welcomeMessage = $formatter->formatBlock('Welcome to the TransIP RestAPI config generator',
            'bg=blue;fg=white', true);

        $output->writeln("\n". $welcomeMessage);
        $output->writeln("\n\nThis command will guide you through creating your transip.json config.\n");

        /*
         * First question: What is the restapi url?
         */
        $apiUrl = $input->getOption(self::API_URL);
        $formattedText = str_replace(' ', '', $formatter->formatBlock($apiUrl, 'fg=yellow'));
        $urlQuestion = new Question("Enter the RestAPI url [{$formattedText}]: ", $apiUrl);

        $apiUrl = $helper->ask($input, $output, $urlQuestion);
        $input->setOption(self::API_URL, $apiUrl);

        /*
         * Second question: What is the restapi token?
         */
        $token = $input->getOption(self::API_TOKEN);
        $formattedText = str_replace(' ', '', $formatter->formatBlock($token, 'fg=yellow'));
        $tokenQuestion = new Question("Enter your RestAPI token [{$formattedText}]: ", $token ?? null);

        $token = $helper->ask($input, $output, $tokenQuestion);
        $input->setOption(self::API_TOKEN, $token);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiUrl = $input->getOption(self::API_URL);
        $apiToken = $input->getOption(self::API_TOKEN);
        $formatter = $this->getHelperSet()->get('formatter');

        if (strlen($apiToken) < 2) {
            throw new \Exception('Provided RestAPI token is invalid');
        }

        $response = (new TransipAPI($apiToken, $apiUrl))->products()->getAll();
        if(is_object($response) || is_array($response)) {
            $output->writeln("\nAPI connection successful");
        }

        // todo implement file saving
    }
}
