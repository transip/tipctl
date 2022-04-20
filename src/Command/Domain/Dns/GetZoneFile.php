<?php

namespace Transip\Api\CLI\Command\Domain\Dns;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Domain\DnsEntry;

class GetZoneFile extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:dns:getzonefile')
            ->setDescription('Get DNS zonefile for a domain')
            ->setHelp('Provide a name to retrieve the DNS Records for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $dnsEntries = $this->getTransipApi()->domainDns()->getByDomainName($domainName);
        $table = new Table($output);
        $table->setStyle('compact');
        $table->setRows(array_map(function (DnsEntry $row) {
            return [$row->getName(), $row->getType(), $row->getExpire(), $row->getRdata()];
        }, $dnsEntries));
        $table->render();
        return 0;
    }
}
