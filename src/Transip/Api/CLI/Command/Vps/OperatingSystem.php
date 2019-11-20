<?php

namespace Transip\Api\CLI\Command\Vps;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class OperatingSystem extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('VpsOperatingSystem')
            ->setDescription('TransIP Vps OperatingSystems')
            ->setHelp('List and install operating systems to your VPS.')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getAll")
            ->addUsage("install")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getAll":
                $operatingSystems = $this->getTransipApi()->vpsOperatingSystems()->getAll();
                $this->output($operatingSystems);
                break;
            case "install":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("vpsName, operatingSystemName required. hostname, base64InstallText optional");
                }
                $vpsName             = $arguments[0];
                $operatingSystemName = $arguments[1];
                $hostname            = $arguments[2] ?? '';
                $base64InstallText   = $arguments[3] ?? '';

                $this->getTransipApi()->vpsOperatingSystems()->install(
                    $vpsName,
                    $operatingSystemName,
                    $hostname,
                    $base64InstallText
                );
                break;
            default:
                throw new Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
