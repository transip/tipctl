<?php

namespace Transip\Api\CLI\Command\Domain\Verification;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Domain\Verification;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:verification:getall')
            ->setDescription('Get all of your domain verifications')
            ->setHelp('Get all domain verifications, optionally filtered on a domain name and statuses. Use <fg=yellow>domain:verification:getbyid</> to see the contact and domain of a verification')
            ->addOption(Field::VERIFICATION_DOMAIN_NAME, null, InputOption::VALUE_REQUIRED, Field::VERIFICATION_DOMAIN_NAME__DESC)
            ->addOption(Field::VERIFICATION_STATUSES, null, InputOption::VALUE_REQUIRED, Field::VERIFICATION_STATUSES__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getOption(Field::VERIFICATION_DOMAIN_NAME);
        $statuses   = $input->getOption(Field::VERIFICATION_STATUSES);

        $verifications = $this->getTransipApi()->domainVerifications()->getAll(
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
