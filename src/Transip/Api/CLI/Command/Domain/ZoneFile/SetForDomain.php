<?php

namespace Transip\Api\CLI\Command\Domain\ZoneFile;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Domain\Branding;

class SetForDomain extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Domain:ZoneFile:setForDomain')
            ->setDescription('Update zone for a domain')
            ->setHelp('Provide the zone for a domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DOMAIN_ZONE_FILE, InputArgument::REQUIRED, Field::DOMAIN_ZONE_FILE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $zoneFile   = $input->getArgument(Field::DOMAIN_ZONE_FILE);

        $this->getTransipApi()->domainZoneFile()->update($domainName, $zoneFile);
        $this->output($zoneFile);
    }
}
