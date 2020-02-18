<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Vps\TCPMonitor;
use Transip\Api\Library\Entity\Vps\TCPMonitorContact;
use Transip\Api\Library\Entity\Vps\TCPMonitorIgnoreTime;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:tcpmonitor:update')
            ->setDescription('Update a TCP Monitor for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::TCP_IPADDRESS, InputArgument::REQUIRED, Field::TCP_IPADDRESS__DESC)
            ->addArgument(Field::LABEL, InputArgument::REQUIRED, Field::LABEL__DESC)
            ->addArgument(Field::PORTS, InputArgument::REQUIRED, Field::PORTS__DESC)
            ->addArgument(Field::CHECK_INTERVAL, InputArgument::REQUIRED, Field::CHECK_INTERVAL__DESC)
            ->addArgument(Field::ALLOWED_TIMEOUTS, InputArgument::REQUIRED, Field::ALLOWED_TIMEOUTS__DESC)
            ->addArgument(Field::CONTACT_ID, InputArgument::REQUIRED, Field::CONTACT_ID__DESC)
            ->addArgument(Field::CONTACT_ENABLE_EMAIL, InputArgument::REQUIRED, Field::CONTACT_ENABLE_EMAIL__DESC)
            ->addArgument(Field::CONTACT_ENABLE_SMS, InputArgument::REQUIRED, Field::CONTACT_ENABLE_SMS__DESC)
            ->addArgument(Field::TIME_FROM, InputArgument::OPTIONAL, Field::TIME_FROM__DESC . Field::OPTIONAL)
            ->addArgument(Field::TIME_TO, InputArgument::OPTIONAL, Field::TIME_TO__DESC . Field::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName            = $input->getArgument(Field::VPS_NAME);
        $ipAddress          = $input->getArgument(Field::TCP_IPADDRESS);
        $label              = $input->getArgument(Field::LABEL);
        $ports              = $input->getArgument(Field::PORTS);
        $checkInterval      = $input->getArgument(Field::CHECK_INTERVAL);
        $allowedTimeOuts    = $input->getArgument(Field::ALLOWED_TIMEOUTS);
        $contactId          = $input->getArgument(Field::CONTACT_ID);
        $contactEnableEmail = $input->getArgument(Field::CONTACT_ENABLE_EMAIL);
        $contactEnableSMS   = $input->getArgument(Field::CONTACT_ENABLE_SMS);
        $ignoreTimeFrom     = $input->getArgument(Field::TIME_FROM);
        $ignoreTimeTo       = $input->getArgument(Field::TIME_TO);

        $ports = explode(',', $ports);

        $tcpMonitor = new TCPMonitor();
        $tcpMonitor->setIpAddress($ipAddress);
        $tcpMonitor->setLabel($label);
        $tcpMonitor->setPorts($ports);
        $tcpMonitor->setInterval($checkInterval);
        $tcpMonitor->setAllowedTimeouts($allowedTimeOuts);

        $tcpMonitorContact = new TCPMonitorContact();
        $tcpMonitorContact->setId($contactId);
        $tcpMonitorContact->setEnableEmail($contactEnableEmail);
        $tcpMonitorContact->setEnableSMS($contactEnableSMS);
        $tcpMonitor->setContacts([$tcpMonitorContact]);

        if ($ignoreTimeFrom !== null && $ignoreTimeTo !== null) {
            $ignoreTime = new TCPMonitorIgnoreTime();
            $ignoreTime->setTimeFrom($ignoreTimeFrom);
            $ignoreTime->setTimeTo($ignoreTimeTo);
            $tcpMonitor->setIgnoreTimes([$ignoreTime]);
        }

        $this->getTransipApi()->vpsTCPMonitor()->update($vpsName, $tcpMonitor);
    }
}
