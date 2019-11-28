<?php


namespace Transip\Api\CLI\Command\Vps\Usage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetLastNetworkUsage extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:Usage:getLastNetworkUsage')
            ->setDescription('Retrieve the last measured network usage for the given VPS in mbit')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $usages  = $this->getTransipApi()->vpsUsage()->getByVpsName($vpsName, ['network'], time() - 300, time());

        $lastUsage = null;
        $usages    = $usages['network'] ?? null;
        foreach ($usages as $usage) {
            if ($lastUsage == null || $lastUsage->date < $usage->date) {
                $lastUsage = $usage;
            }
        }

        $this->output($lastUsage);
    }
}
