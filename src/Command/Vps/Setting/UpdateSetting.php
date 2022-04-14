<?php

namespace Transip\Api\CLI\Command\Vps\Setting;

use Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Vps\Setting;
use Transip\Api\Library\Entity\Vps\SettingValue;

class UpdateSetting extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:setting:updatesetting')
            ->setDescription('Update a VPS setting')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SETTING_NAME, InputArgument::REQUIRED)
            ->addArgument(Field::VPS_SETTING_DATATYPE, InputArgument::REQUIRED)
            ->addArgument(Field::VPS_SETTING_VALUE, InputArgument::REQUIRED)
            ->setHelp('This API call will allow you to update an existing setting for your VPS');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName             = $input->getArgument(Field::VPS_NAME);
        $settingName         = $input->getArgument(Field::VPS_SETTING_NAME);
        $settingDataType     = $input->getArgument(Field::VPS_SETTING_DATATYPE);
        $settingValueInput   = $input->getArgument(Field::VPS_SETTING_VALUE);

        $setting = new Setting();
        $setting->setName($settingName);
        $setting->setDataType($settingDataType);
        $setting->setReadOnly(false);

        $settingValue = new SettingValue();

        switch ($settingDataType) {
            case 'string':
                $settingValue->setValueString($settingValueInput);
                break;
            case 'boolean':
                $settingValue->setValueBoolean($settingValueInput);
                break;
            default:
                throw new Exception("The used value input and/or datatype parameter are not valid for this setting");
        }

        $setting->setValue($settingValue);
        $this->getTransipApi()->vpsSettings()->update($vpsName, $setting);
    }
}
