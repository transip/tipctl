<?php

namespace Transip\Api\CLI\Command\Domain\Dns;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Domain\DnsEntry;

class RemoveDnsEntry extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:dns:removeDnsEntry')
            ->setDescription('Remove a dns entry from the domain DNS entries')
            ->setHelp('Provide the information of a DNS Record you want to remove')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DNS_ENTRY_NAME, InputArgument::REQUIRED, Field::DNS_ENTRY_NAME__DESC)
            ->addArgument(Field::DNS_ENTRY_EXPIRE, InputArgument::REQUIRED, Field::DNS_ENTRY_EXPIRE__DESC)
            ->addArgument(Field::DNS_ENTRY_TYPE, InputArgument::REQUIRED, Field::DNS_ENTRY_TYPE__DESC)
            ->addArgument(Field::DNS_ENTRY_CONTENT, InputArgument::REQUIRED, Field::DNS_ENTRY_CONTENT__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $name       = $input->getArgument(Field::DNS_ENTRY_NAME);
        $expire     = $input->getArgument(Field::DNS_ENTRY_EXPIRE);
        $type       = $input->getArgument(Field::DNS_ENTRY_TYPE);
        $content    = $input->getArgument(Field::DNS_ENTRY_CONTENT);

        $dnsEntry = new DnsEntry();
        $dnsEntry->setName($name);
        $dnsEntry->setExpire($expire);
        $dnsEntry->setType($type);
        $dnsEntry->setContent($content);

        $this->getTransipApi()->domainDns()->removeDnsEntry($domainName, $dnsEntry);
    }
}
