<?php

namespace Transip\Api\CLI\Command\ForwardingService;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:update')
            ->setDescription('Update a forwarding service')
            ->setHelp(
                'Update the settings of a forwarding service. ' .
                'The frame title, frame icon and forward options keep their current value when they are not provided.'
            )
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            )
            ->addArgument(
                Field::FORWARDING_SERVICE_FORWARD_TO,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_FORWARD_TO__DESC
            )
            ->addArgument(
                Field::FORWARDING_SERVICE_FORWARD_METHOD,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_FORWARD_METHOD__DESC
            )
            ->addOption(
                Field::FORWARDING_SERVICE_FRAME_TITLE,
                null,
                InputOption::VALUE_REQUIRED,
                Field::FORWARDING_SERVICE_FRAME_TITLE__DESC
            )
            ->addOption(
                Field::FORWARDING_SERVICE_FRAME_ICON,
                null,
                InputOption::VALUE_REQUIRED,
                Field::FORWARDING_SERVICE_FRAME_ICON__DESC
            )
            ->addOption(
                Field::FORWARDING_SERVICE_FORWARD_EVERYTHING,
                null,
                InputOption::VALUE_REQUIRED,
                Field::FORWARDING_SERVICE_FORWARD_EVERYTHING__DESC
            )
            ->addOption(
                Field::FORWARDING_SERVICE_FORWARD_SUBDOMAINS,
                null,
                InputOption::VALUE_REQUIRED,
                Field::FORWARDING_SERVICE_FORWARD_SUBDOMAINS__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);
        $forwardTo = $input->getArgument(Field::FORWARDING_SERVICE_FORWARD_TO);
        $forwardMethod = $input->getArgument(Field::FORWARDING_SERVICE_FORWARD_METHOD);

        $forwardingService = $this->getTransipApi()->forwardingServices()->getByDomainName($domainName);
        $forwardingService->setForwardTo($forwardTo);
        $forwardingService->setForwardMethod($forwardMethod);

        $frameTitle = $input->getOption(Field::FORWARDING_SERVICE_FRAME_TITLE);
        if ($frameTitle !== null) {
            $forwardingService->setFrameTitle($frameTitle);
        }

        $frameIcon = $input->getOption(Field::FORWARDING_SERVICE_FRAME_ICON);
        if ($frameIcon !== null) {
            $forwardingService->setFrameIcon($frameIcon);
        }

        $forwardEverything = $input->getOption(Field::FORWARDING_SERVICE_FORWARD_EVERYTHING);
        if ($forwardEverything !== null) {
            $forwardingService->setForwardEverything(filter_var($forwardEverything, FILTER_VALIDATE_BOOLEAN));
        }

        $forwardSubdomains = $input->getOption(Field::FORWARDING_SERVICE_FORWARD_SUBDOMAINS);
        if ($forwardSubdomains !== null) {
            $forwardingService->setForwardSubdomains(filter_var($forwardSubdomains, FILTER_VALIDATE_BOOLEAN));
        }

        $this->getTransipApi()->forwardingServices()->update($forwardingService);
        return 0;
    }
}
