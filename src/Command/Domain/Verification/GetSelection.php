<?php

namespace Transip\Api\CLI\Command\Domain\Verification;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Domain\Verification;

class GetSelection extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:verification:getselection')
            ->setDescription('Get a selection of your domain verifications')
            ->setHelp('Get the domain verifications for a page number and amount of verifications per page, optionally filtered on a domain name and statuses')
            ->addArgument(Field::PAGE, InputArgument::REQUIRED, Field::PAGE__DESC)
            ->addArgument(Field::ITEMS_PER_PAGE, InputArgument::REQUIRED, Field::ITEMS_PER_PAGE__DESC)
            ->addOption(Field::VERIFICATION_DOMAIN_NAME, null, InputOption::VALUE_REQUIRED, Field::VERIFICATION_DOMAIN_NAME__DESC)
            ->addOption(Field::VERIFICATION_STATUSES, null, InputOption::VALUE_REQUIRED, Field::VERIFICATION_STATUSES__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $page         = (int) $input->getArgument(Field::PAGE);
        $itemsPerPage = (int) $input->getArgument(Field::ITEMS_PER_PAGE);
        $domainName   = $input->getOption(Field::VERIFICATION_DOMAIN_NAME);
        $statuses     = $input->getOption(Field::VERIFICATION_STATUSES);

        $verifications = $this->getTransipApi()->domainVerifications()->getSelection(
            $page,
            $itemsPerPage,
            is_string($domainName) ? $domainName : null,
            is_string($statuses) && $statuses !== '' ? explode(',', $statuses) : []
        );

        // A list item is a summary, the contact and domain are only shown by domain:verification:getbyid
        $this->output(array_map(static function (Verification $verification): array {
            /** @var array<string, mixed> $summary */
            $summary = $verification->jsonSerialize();
            unset($summary['contact'], $summary['domain']);

            return $summary;
        }, $verifications));
        return 0;
    }
}
