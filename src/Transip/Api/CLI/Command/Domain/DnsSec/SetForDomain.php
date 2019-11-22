<?php

namespace Transip\Api\CLI\Command\Domain\DnsSec;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Domain\DnsSecEntry;

class SetForDomain extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:DnsSec:setForDomain')
            ->setDescription('Update all DNSSEC entries for a domain')
            ->setHelp('Provide all DNSSEC entries of the domain, this function only sets one!')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DNSSEC_ENTRY_KEYTAG, InputArgument::REQUIRED, Field::DNSSEC_ENTRY_KEYTAG__DESC)
            ->addArgument(Field::DNSSEC_ENTRY_FLAGS, InputArgument::REQUIRED, Field::DNSSEC_ENTRY_FLAGS__DESC)
            ->addArgument(Field::DNSSEC_ENTRY_ALGORITHM, InputArgument::REQUIRED, Field::DNSSEC_ENTRY_ALGORITHM__DESC)
            ->addArgument(Field::DNSSEC_ENTRY_PUBLICKEY, InputArgument::REQUIRED, Field::DNSSEC_ENTRY_PUBLICKEY__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $keyTag     = $input->getArgument(Field::DNSSEC_ENTRY_KEYTAG);
        $flags      = $input->getArgument(Field::DNSSEC_ENTRY_FLAGS);
        $algorithm  = $input->getArgument(Field::DNSSEC_ENTRY_ALGORITHM);
        $publicKey  = $input->getArgument(Field::DNSSEC_ENTRY_PUBLICKEY);

        $dnsSecEntry = new DnsSecEntry();
        $dnsSecEntry->setKeyTag($keyTag);
        $dnsSecEntry->setFlags($flags);
        $dnsSecEntry->setAlgorithm($algorithm);
        $dnsSecEntry->setPublicKey($publicKey);

        $this->getTransipApi()->domainDnsSec()->update($domainName, [$dnsSecEntry]);
    }
}
