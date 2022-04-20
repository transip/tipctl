<?php

namespace Transip\Api\CLI\Command\Invoice\Pdf;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByInvoiceNumber extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('invoice:pdf:getbyinvoicenumber')
            ->setDescription('Get PDF data of an invoice as a Base64 encoded string')
            ->addArgument(Field::INVOICE_NUMBER, InputArgument::REQUIRED, Field::INVOICE_NUMBER__DESC)
            ->setHelp('This command returns a string that is Base64 encoded. Decode this string before saving to a PDF file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $invoiceNumber = $input->getArgument(Field::INVOICE_NUMBER);

        $invoicePdfData = $this->getTransipApi()->invoicePdf()->getByInvoiceNumber($invoiceNumber);

        $this->output($invoicePdfData);
        return 0;
    }
}
