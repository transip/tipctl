<?php


namespace Transip\Api\CLI\Command\Vps\Usage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetLastCpuUsage extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:Usage:getLastCpuUsage')
            ->setDescription('Retrieve the last measured CPU usage for the given VPS in percent')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $usages  = $this->getTransipApi()->vpsUsage()->getByVpsName($vpsName, ['cpu'], time() - 300, time());

        /** @var \StdClass $lastUsage */
        $lastUsage = null;
        $usages    = $usages['cpu'] ?? [];
        foreach ($usages as $usage) {
            if ($lastUsage == null || $lastUsage->date < $usage->date) {
                $lastUsage = $usage;
            }
        }

        $this->output($lastUsage);
    }
}
