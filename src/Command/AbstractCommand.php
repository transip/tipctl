<?php

namespace Transip\Api\CLI\Command;

use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\Setup\Setup;
use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface as ConsoleOutputInterface;
use Transip\Api\CLI\ConsoleOutput\OutputFactory;
use Transip\Api\CLI\Settings\Settings;
use Transip\Api\Library\TransipAPI;

abstract class AbstractCommand extends Command
{
    /**
     * @var TransipAPI $transipApi
     */
    private $transipApi;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        // adds --format option to all commands
        $this->addOption(
            Field::FORMAT,
            null,
            InputOption::VALUE_OPTIONAL,
            Field::FORMAT__DESC,
            'json'
        );

        // adds --configFile option to all commands
        $this->addOption(
            Field::CONFIG_FILE,
            null,
            InputOption::VALUE_OPTIONAL,
            Field::CONFIG_FILE__DESC,
            Settings::getDefaultConfigFilePath()
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $configFile = $input->getOption(Field::CONFIG_FILE);
        Settings::setConfigFilePath($configFile);

        if (!($this instanceof Setup)) {
            $isDemoMode = $input->getOption('demo');

            $settings = Settings::getInstance($isDemoMode);

            $this->transipApi = new TransipAPI(
                $settings->getApiLogin(),
                $settings->getApiPrivateKey(),
                $settings->getApiUseWhitelist(),
                '',
                $settings->getApiUrl()
            );

            if ($isDemoMode) {
                $this->transipApi->useDemoToken();
            }

            if ($input->getOption('test')) {
                $this->transipApi->setTestMode(true);
            }

            $this->transipApi->setTokenLabelPrefix('api.cli-');

            $helperSet = $this->getHelperSet();
            if ($helperSet === null) {
                throw new RuntimeException("Could not retrieve symfony console helperSet");
            }
            /** @var FormatterHelper $formatter */
            $formatter = $helperSet->get('formatter');

            $settings->ensureConfigFileIsReadOnly($formatter, $output);
        }

        $this->input  = $input;
        $this->output = $output;
    }

    protected function getTransipApi(): TransipAPI
    {
        return $this->transipApi;
    }

    /**
     * @param mixed $data
     * @return void
     */
    protected function output($data): void
    {
        $formatter = $this->getFormatterFromInput();

        $formattedOutput = $formatter->render($data);

        $this->output->writeln($formattedOutput);
    }

    private function getFormatterFromInput(): ConsoleOutputInterface
    {
        $formatType = $this->input->getOption(Field::FORMAT);

        return OutputFactory::create($formatType);
    }
}
