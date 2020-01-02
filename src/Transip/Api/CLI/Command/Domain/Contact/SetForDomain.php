<?php

namespace Transip\Api\CLI\Command\Domain\Contact;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Domain\WhoisContact;

class SetForDomain extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:contact:setfordomain')
            ->setDescription('Update WHOIS contact information for a domain')
            ->setHelp('Provide all the information for a type contact to update')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DOMAIN_CONTACT_TYPE, InputArgument::REQUIRED, Field::DOMAIN_CONTACT_TYPE__DESC)
            ->addArgument(Field::DOMAIN_FIRST_NAME, InputArgument::REQUIRED, Field::DOMAIN_FIRST_NAME__DESC)
            ->addArgument(Field::DOMAIN_LAST_NAME, InputArgument::REQUIRED, Field::DOMAIN_LAST_NAME__DESC)
            ->addArgument(Field::DOMAIN_COMPANY_NAME, InputArgument::REQUIRED, Field::DOMAIN_COMPANY_NAME__DESC)
            ->addArgument(Field::DOMAIN_COMPANY_KVK, InputArgument::REQUIRED, Field::DOMAIN_COMPANY_KVK__DESC)
            ->addArgument(Field::DOMAIN_STREET, InputArgument::REQUIRED, Field::DOMAIN_STREET__DESC)
            ->addArgument(Field::DOMAIN_NUMBER, InputArgument::REQUIRED, Field::DOMAIN_NUMBER__DESC)
            ->addArgument(Field::DOMAIN_POSTAL_CODE, InputArgument::REQUIRED, Field::DOMAIN_POSTAL_CODE__DESC)
            ->addArgument(Field::DOMAIN_CITY, InputArgument::REQUIRED, Field::DOMAIN_CITY__DESC)
            ->addArgument(Field::DOMAIN_PHONE_NUMBER, InputArgument::REQUIRED, Field::DOMAIN_PHONE_NUMBER__DESC)
            ->addArgument(Field::DOMAIN_EMAIL, InputArgument::REQUIRED, Field::DOMAIN_EMAIL__DESC)
            ->addArgument(Field::DOMAIN_COUNTRY, InputArgument::REQUIRED, Field::DOMAIN_COUNTRY__DESC)
            ->addArgument(Field::DOMAIN_FAX_NUMBER, InputArgument::OPTIONAL, Field::DOMAIN_FAX_NUMBER__DESC . Field::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName  = $input->getArgument(Field::DOMAIN_NAME);
        $type        = $input->getArgument(Field::DOMAIN_CONTACT_TYPE);
        $firstName   = $input->getArgument(Field::DOMAIN_FIRST_NAME);
        $lastName    = $input->getArgument(Field::DOMAIN_LAST_NAME);
        $companyName = $input->getArgument(Field::DOMAIN_COMPANY_NAME);
        $companyKvk  = $input->getArgument(Field::DOMAIN_COMPANY_KVK);
        $street      = $input->getArgument(Field::DOMAIN_STREET);
        $number      = $input->getArgument(Field::DOMAIN_NUMBER);
        $postalCode  = $input->getArgument(Field::DOMAIN_POSTAL_CODE);
        $city        = $input->getArgument(Field::DOMAIN_CITY);
        $phoneNumber = $input->getArgument(Field::DOMAIN_PHONE_NUMBER);
        $email       = $input->getArgument(Field::DOMAIN_EMAIL);
        $country     = $input->getArgument(Field::DOMAIN_COUNTRY);
        $faxNumber   = $input->getArgument(Field::DOMAIN_FAX_NUMBER) ?? '';

        $whoisContact = new WhoisContact();
        $whoisContact->setType($type);
        $whoisContact->setFirstName($firstName);
        $whoisContact->setLastName($lastName);
        $whoisContact->setCompanyName($companyName);
        $whoisContact->setCompanyKvk($companyKvk);
        $whoisContact->setStreet($street);
        $whoisContact->setNumber($number);
        $whoisContact->setPostalCode($postalCode);
        $whoisContact->setCity($city);
        $whoisContact->setPhoneNumber($phoneNumber);
        $whoisContact->setEmail($email);
        $whoisContact->setCountry($country);
        $whoisContact->setFaxNumber($faxNumber);

        /**
         * This PUT function will override all current contacts. therefore we get the current contacts first
         * and override only one contact (type). this is a bit more practical when using CLI
         */

        $newContacts = [];
        $currentContacts = $this->getTransipApi()->domainContact()->getByDomainName($domainName);

        foreach ($currentContacts as $currentContact) {
            if ($currentContact->getType() === $type) {
                $newContacts[] = $whoisContact;
            } else {
                $newContacts[] = $currentContact;
            }
        }

        $this->getTransipApi()->domainContact()->update($domainName, $newContacts);
    }
}
