<?php

namespace Transip\Api\CLI\Command\Domain\Verification;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetById extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:verification:getbyid')
            ->setDescription('Get a domain verification by id')
            ->setHelp('Get the details of a single domain verification, including its contact and domain information (find ids by <fg=yellow>domain:verification:getall</>)')
            ->addArgument(Field::VERIFICATION_ID, InputArgument::REQUIRED, Field::VERIFICATION_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = (int) $input->getArgument(Field::VERIFICATION_ID);

        $verification = $this->getTransipApi()->domainVerifications()->getById($id);

        $this->output($verification);
        return 0;
    }
}
