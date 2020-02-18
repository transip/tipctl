<?php

namespace Transip\Api\CLI\Command\Invoice\Items;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByInvoiceNumber extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('invoice:items:getbyinvoicenumber')
            ->setDescription('Get the invoiceItems for a specific invoice')
            ->addArgument(Field::INVOICE_NUMBER, InputArgument::REQUIRED, Field::INVOICE_NUMBER__DESC)
            ->setHelp('This API call returns details for each item on an invoice');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $invoiceNumber = $input->getArgument(Field::INVOICE_NUMBER);

        $invoicePdfData = $this->getTransipApi()->invoiceItem()->getByInvoiceNumber($invoiceNumber);

        $this->output($invoicePdfData);
    }
}
