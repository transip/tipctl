<?php


namespace Transip\Api\CLI\Command\Vps\Usage;

use StdClass;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Vps\UsageData;

class GetLastDiskUsage extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:usage:getlastdiskusage')
            ->setDescription('Retrieve the last measured disk usage for the given VPS in IOPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $usages  = $this->getTransipApi()->vpsUsage()->getByVpsName($vpsName, ['disk'], time() - 300, time());

        /** @var null|UsageData $lastUsage */
        $lastUsage = null;
        $usages    = $usages['disk'] ?? [];
        foreach ($usages as $usage) {
            if ($lastUsage === null || $lastUsage->getDate() < $usage->getDate()) {
                $lastUsage = $usage;
            }
        }

        $this->output($lastUsage);
        return 0;
    }
}
