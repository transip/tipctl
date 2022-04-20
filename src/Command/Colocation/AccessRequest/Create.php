<?php

namespace Transip\Api\CLI\Command\Colocation\AccessRequest;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Colocation\AccessRequest;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:accessrequest:create')
            ->setDescription('Create an access request for your colocation')
            ->addArgument(
                Field::COLOCATION_NAME,
                InputArgument::REQUIRED,
                Field::COLOCATION_NAME__DESC
            )
            ->addArgument(
                Field::COLOCATION_ACCESS_REQUEST_DATE_TIME,
                InputArgument::REQUIRED,
                Field::COLOCATION_ACCESS_REQUEST_DATE_TIME__DESC
            )
            ->addArgument(
                Field::COLOCATION_ACCESS_REQUEST_DURATION,
                InputArgument::REQUIRED,
                Field::COLOCATION_ACCESS_REQUEST_DURATION__DESC
            )
            ->addArgument(
                Field::COLOCATION_ACCESS_REQUEST_VISITOR_NAMES,
                InputArgument::REQUIRED,
                Field::COLOCATION_ACCESS_REQUEST_VISITOR_NAMES__DESC
            )
            ->addArgument(
                Field::COLOCATION_ACCESS_REQUEST_PHONE_NUMBER,
                InputArgument::OPTIONAL,
                Field::COLOCATION_ACCESS_REQUEST_PHONE_NUMBER__DESC
            )
            ->setHelp('Send a request for some visitors to access the datacenter at some date and time for some specific duration');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $visitorNames = explode(',', Field::COLOCATION_ACCESS_REQUEST_VISITOR_NAMES);

        $accessRequest = new AccessRequest();
        $accessRequest->setColoName($input->getArgument(Field::COLOCATION_NAME));
        $accessRequest->setDateTime($input->getArgument(Field::COLOCATION_ACCESS_REQUEST_DATE_TIME));
        $accessRequest->setDuration($input->getArgument(Field::COLOCATION_ACCESS_REQUEST_DURATION));
        $accessRequest->setVisitorNames($visitorNames);
        $accessRequest->setPhoneNumber($input->getArgument(Field::COLOCATION_ACCESS_REQUEST_PHONE_NUMBER) ?? '');

        $this->getTransipApi()->colocationAccessRequest()->create($accessRequest);
        return 0;
    }
}
