<?php

namespace Transip\Api\CLI\Command\Colocation\RemoteHands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Colocation\RemoteHands;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:remotehands:create')
            ->setDescription('Create a remote hands request for your colocation')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC)
            ->addArgument(
                Field::COLOCATION_REMOTE_HANDS_CONTACT_NAME,
                InputArgument::REQUIRED,
                Field::COLOCATION_REMOTE_HANDS_CONTACT_NAME__DESC
            )
            ->addArgument(
                Field::COLOCATION_REMOTE_HANDS_PHONE_NUMBER,
                InputArgument::REQUIRED,
                Field::COLOCATION_REMOTE_HANDS_PHONE_NUMBER__DESC
            )
            ->addArgument(
                Field::COLOCATION_REMOTE_HANDS_EXPECTED_DURATION,
                InputArgument::REQUIRED,
                Field::COLOCATION_REMOTE_HANDS_EXPECTED_DURATION__DESC
            )
            ->addArgument(
                Field::COLOCATION_REMOTE_HANDS_INSTRUCTIONS,
                InputArgument::REQUIRED,
                Field::COLOCATION_REMOTE_HANDS_INSTRUCTIONS__DESC
            )
            ->setHelp('Give instructions to a datacenter engineer to perform on your colocation server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coloName         = $input->getArgument(Field::COLOCATION_NAME);
        $contactName      = $input->getArgument(Field::COLOCATION_REMOTE_HANDS_CONTACT_NAME);
        $phoneNumber      = $input->getArgument(Field::COLOCATION_REMOTE_HANDS_PHONE_NUMBER);
        $expectedDuration = $input->getArgument(Field::COLOCATION_REMOTE_HANDS_EXPECTED_DURATION);
        $instructions     = $input->getArgument(Field::COLOCATION_REMOTE_HANDS_INSTRUCTIONS);

        $remoteHands = new RemoteHands();
        $remoteHands->setColoName($coloName);
        $remoteHands->setContactName($contactName);
        $remoteHands->setPhoneNumber($phoneNumber);
        $remoteHands->setExpectedDuration($expectedDuration);
        $remoteHands->setInstructions($instructions);

        $this->getTransipApi()->colocationRemoteHands()->create($remoteHands);
    }
}
