<?php

namespace Transip\Api\CLI\Command\Invoice;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByInvoiceNumber extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('invoice:getbyinvoicenumber')
            ->setDescription('Get a specific invoice by invoiceNumber')
            ->addArgument(Field::INVOICE_NUMBER, InputArgument::REQUIRED, Field::INVOICE_NUMBER__DESC)
            ->setHelp('This API call will return information for one specific invoice');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $invoiceNumber = $input->getArgument(Field::INVOICE_NUMBER);

        $invoiceData = $this->getTransipApi()->invoice()->getByInvoiceNumber($invoiceNumber);

        $this->output($invoiceData);
    }
}
