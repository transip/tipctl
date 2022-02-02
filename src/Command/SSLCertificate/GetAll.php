<?php

namespace Transip\Api\CLI\Command\SSLCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sslcertificate:getall')
            ->setDescription('List all SSL certificates in your account')
            ->addArgument(Field::PAGE, InputArgument::OPTIONAL, Field::PAGE__DESC . Field::OPTIONAL, 0)
            ->addArgument(Field::ITEMS_PER_PAGE, InputArgument::OPTIONAL, Field::ITEMS_PER_PAGE__DESC . Field::OPTIONAL, 0)
            ->setHelp('This command supports pagination, using this command you can limit the amount of ssl certificates returned by the api call, which might be useful if you expect a lot of response objects and you want to spread that over to multiple requests.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $page = $input->getArgument(Field::PAGE);
        $itemsPerPage = $input->getArgument(Field::ITEMS_PER_PAGE);

        $sslCertificateList = $this->getTransipApi()->sslCertificate()->getSelection($page, $itemsPerPage);

        $this->output($sslCertificateList);
    }
}
