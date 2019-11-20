<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class IpAddress extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('VpsIpAddress')
            ->setDescription('TransIP Vps Ip Addresses')
            ->setHelp('Get ipv4/6 addresses for a VPS')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getByVpsName")
            ->addUsage("getByVpsNameAddress")
            ->addUsage("setPtr")
            ->addUsage("addIpv6")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getByVpsName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $ipAddresses = $this->getTransipApi()->vpsIpAddresses()->getByVpsName($arguments[0]);
                $this->output($ipAddresses);
                break;
            case "getByVpsNameAddress":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("Vps name and address is required");
                }
                $ipAddress = $this->getTransipApi()->vpsIpAddresses()->getByVpsNameAddress($arguments[0], $arguments[1]);
                $this->output($ipAddress);
                break;
            case "setPtr":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 3) {
                    throw new \Exception("vpsName, IpAddress and PTR are required ");
                }
                $vpsName   = $arguments[0];
                $ipAddress = $arguments[1];
                $ptr       = $arguments[2];

                $ipAddressObject = $this->getTransipApi()->vpsIpAddresses()->getByVpsNameAddress($vpsName, $ipAddress);
                $ipAddressObject->setReverseDns($ptr);
                $this->getTransipApi()->vpsIpAddresses()->update($vpsName, $ipAddressObject);
                $this->output($ipAddressObject);

                break;
            case "addIpv6":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and ipv6Address are required");
                }
                $this->getTransipApi()->vpsIpAddresses()->addIpv6Address($arguments[0], $arguments[1]);
                break;
            case "removeIpv6":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and ipv6Address are required");
                }
                $this->getTransipApi()->vpsIpAddresses()->removeIpv6Address($arguments[0], $arguments[1]);
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
