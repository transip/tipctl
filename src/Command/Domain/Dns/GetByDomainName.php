<?php

namespace Transip\Api\CLI\Command\Domain\Dns;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Domain\DnsEntry;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:dns:getbydomainname')
            ->setDescription('Get DNS Records for a domain')
            ->setHelp('Provide a name to retrieve the DNS Records for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $dnsEntries = $this->getTransipApi()->domainDns()->getByDomainName($domainName);

        if ($input->getOption(Field::FORMAT) === 'txt') {
            $table = new Table($output);
            $table->setStyle('compact');
            $table->setRows(array_map(function(DnsEntry $row) {
                return [$row->getName(), $row->getType(), $row->getExpire(), $row->getContent()];
            }, $dnsEntries));
            $table->render();
        } else {
            $this->output($dnsEntries);
        }
    }
}
