<?php

namespace Transip\Api\CLI\Command\Domain\Branding;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Domain\Branding;

class SetForDomain extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:branding:setfordomain')
            ->setDescription('Update branding information for a domain')
            ->setHelp('Provide all the information for the branding of a domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DOMAIN_COMPANY_NAME, InputArgument::REQUIRED, Field::DOMAIN_COMPANY_NAME__DESC)
            ->addArgument(Field::DOMAIN_SUPPORT_EMAIL, InputArgument::REQUIRED, Field::DOMAIN_SUPPORT_EMAIL__DESC)
            ->addArgument(Field::DOMAIN_COMPANY_URL, InputArgument::REQUIRED, Field::DOMAIN_COMPANY_URL__DESC)
            ->addArgument(Field::DOMAIN_TERMS_OF_USAGE_URL, InputArgument::REQUIRED, Field::DOMAIN_TERMS_OF_USAGE_URL__DESC)
            ->addArgument(Field::DOMAIN_BANNER_LINE_1, InputArgument::REQUIRED, Field::DOMAIN_BANNER_LINE_1)
            ->addArgument(Field::DOMAIN_BANNER_LINE_2, InputArgument::REQUIRED, Field::DOMAIN_BANNER_LINE_2)
            ->addArgument(Field::DOMAIN_BANNER_LINE_3, InputArgument::REQUIRED, Field::DOMAIN_BANNER_LINE_3);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName      = $input->getArgument(Field::DOMAIN_NAME);
        $companyName     = $input->getArgument(Field::DOMAIN_COMPANY_NAME);
        $supportEmail    = $input->getArgument(Field::DOMAIN_SUPPORT_EMAIL);
        $companyUrl      = $input->getArgument(Field::DOMAIN_COMPANY_URL);
        $termsOfUsageUrl = $input->getArgument(Field::DOMAIN_TERMS_OF_USAGE_URL);
        $bannerLine1     = $input->getArgument(Field::DOMAIN_BANNER_LINE_1);
        $bannerLine2     = $input->getArgument(Field::DOMAIN_BANNER_LINE_2);
        $bannerLine3     = $input->getArgument(Field::DOMAIN_BANNER_LINE_3);

        $branding = new Branding();
        $branding->setCompanyName($companyName);
        $branding->setSupportEmail($supportEmail);
        $branding->setCompanyUrl($companyUrl);
        $branding->setTermsOfUsageUrl($termsOfUsageUrl);
        $branding->setBannerLine1($bannerLine1);
        $branding->setBannerLine2($bannerLine2);
        $branding->setBannerLine3($bannerLine3);

        $this->getTransipApi()->domainBranding()->update($domainName, $branding);
    }
}
