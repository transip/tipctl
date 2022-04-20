<?php

namespace Transip\Api\CLI\Command\Vps\Setting;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsNameSettingName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:setting:getbyvpsnamesettingname')
            ->setDescription('Get the value for one specific setting')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SETTING_NAME, InputArgument::REQUIRED)
            ->setHelp('This API call will return the specified setting');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName     = $input->getArgument(Field::VPS_NAME);
        $settingName = $input->getArgument(Field::VPS_SETTING_NAME);

        $setting = $this->getTransipApi()->vpsSettings()->getByVpsNameSettingName($vpsName, $settingName);

        $this->output($setting);
        return 0;
    }
}
