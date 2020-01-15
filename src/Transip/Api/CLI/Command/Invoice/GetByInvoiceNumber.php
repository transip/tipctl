<?php

namespace Transip\Api\CLI\Command\Invoice;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByInvoiceNumber extends AbstractCommand
{
    protected const INVOICE_NUMBER = 'InvoiceNumber';

    protected function configure(): void
    {
        $this->setName('invoice:getbyinvoicenumber')
            ->setDescription('Get a single invoice attached to your TransIP account')
            ->addArgument(Field::INVOICE_NUMBER, InputArgument::REQUIRED, Field::INVOICE_NUMBER__DESC)
            ->setHelp('This command returns an invoice object that contains a `invoiceItems` hash which provides further information on how each line item is applied to the invoice.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $invoiceNumber = $input->getArgument(Field::INVOICE_NUMBER);

        $invoiceData = $this->getTransipApi()->invoice()->getByInvoiceNumber($invoiceNumber);

        $this->output($invoiceData);
    }
}
