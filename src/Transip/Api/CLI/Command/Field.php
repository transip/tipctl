<?php

namespace Transip\Api\CLI\Command;

class Field
{
    const OPTIONAL = ' (optional)';

    const CANCELTIME = 'CancelTime';
    const CANCELTIME__DESC = 'Cancellation time, either ‘end’ or ‘immediately’';
    const AVAILABILITY_ZONE = 'AvailabilityZone';
    const AVAILABILITY_ZONE__DESC = 'The region name where this product should be created';

    const DOMAIN_NAME = 'DomainName';
    const DOMAIN_NAME__DESC = 'The domain name';

    const DOMAIN_NAMESERVERS = 'Nameservers';
    const DOMAIN_NAMESERVERS__DESC = 'Nameserver hostnames (comma separated)';

    const DOMAIN_COMPANY_NAME = 'companyName';
    const DOMAIN_COMPANY_NAME__DESC = 'Name of the company';
    const DOMAIN_SUPPORT_EMAIL = 'supportEmail';
    const DOMAIN_SUPPORT_EMAIL__DESC = 'Public email shown in the branding';
    const DOMAIN_COMPANY_URL = 'companyUrl';
    const DOMAIN_COMPANY_URL__DESC = 'Website of the company';
    const DOMAIN_TERMS_OF_USAGE_URL = 'termsOfUsageUrl';
    const DOMAIN_TERMS_OF_USAGE_URL__DESC = 'URL to the terms of usage doc';
    const DOMAIN_BANNER_LINE_1 = 'bannerLine1';
    const DOMAIN_BANNER_LINE_2 = 'bannerLine2';
    const DOMAIN_BANNER_LINE_3 = 'bannerLine3';

    const DOMAIN_CONTACT_TYPE = 'type';
    const DOMAIN_CONTACT_TYPE__DESC = 'Contact type registrant|administrative|technical';
    const DOMAIN_FIRST_NAME = 'firstName';
    const DOMAIN_FIRST_NAME__DESC = 'First Name';
    const DOMAIN_LAST_NAME = 'lastName';
    const DOMAIN_LAST_NAME__DESC = 'Last Name';
    const DOMAIN_COMPANY_KVK = 'companyKvk';
    const DOMAIN_COMPANY_KVK__DESC = 'Company Chamber of Commerce number';
    const DOMAIN_STREET = 'street';
    const DOMAIN_STREET__DESC = 'Street name';
    const DOMAIN_NUMBER = 'number';
    const DOMAIN_NUMBER__DESC = 'Street number';
    const DOMAIN_POSTAL_CODE = 'postalCode';
    const DOMAIN_POSTAL_CODE__DESC = 'Postal Code';
    const DOMAIN_CITY = 'city';
    const DOMAIN_CITY__DESC = 'City';
    const DOMAIN_PHONE_NUMBER = 'phoneNumber';
    const DOMAIN_PHONE_NUMBER__DESC = 'PhoneNumber';
    const DOMAIN_FAX_NUMBER = 'faxNumber';
    const DOMAIN_FAX_NUMBER__DESC = 'Fax Number';
    const DOMAIN_EMAIL = 'email';
    const DOMAIN_EMAIL__DESC = 'EmailAddress';
    const DOMAIN_COUNTRY = 'country';
    const DOMAIN_COUNTRY__DESC = 'Country';

    const DNS_ENTRY_NAME = 'Name';
    const DNS_ENTRY_NAME__DESC = 'The name of the DNS Record';
    const DNS_ENTRY_EXPIRE = 'Expire';
    const DNS_ENTRY_EXPIRE__DESC = 'TTL of the DNS Record';
    const DNS_ENTRY_TYPE = 'Type';
    const DNS_ENTRY_TYPE__DESC = 'DNS Record type';
    const DNS_ENTRY_CONTENT = 'Content';
    const DNS_ENTRY_CONTENT__DESC = 'The content of the DNS Record';

    const DNSSEC_ENTRY_KEYTAG = 'KeyTag';
    const DNSSEC_ENTRY_KEYTAG__DESC = 'A 5-digit key of the Zonesigner';
    const DNSSEC_ENTRY_FLAGS = 'Flags';
    const DNSSEC_ENTRY_FLAGS__DESC = 'The signing key number, either 256 (Zone Signing Key) or 257 (Key Signing Key)';
    const DNSSEC_ENTRY_ALGORITHM = 'Algorithm';
    const DNSSEC_ENTRY_ALGORITHM__DESC = 'The algorithm type that is used, 3|5|6|7|8|10|12|13|14';
    const DNSSEC_ENTRY_PUBLICKEY = 'PublicKey';
    const DNSSEC_ENTRY_PUBLICKEY__DESC = 'The public key';

    const VPS_NAME = 'VpsName';
    const VPS_NAME__DESC = 'The name of the vps';
    const VPS_ADDONS = 'Addons';
    const VPS_ADDONS__DESC = 'Add-on names(more than one comma separated)';
    const VPS_ADDON = 'AddonName';
    const VPS_ADDON__DESC = 'Add-on name';
    const VPS_BACKUP_ID = 'VpsBackupId';
    const VPS_BACKUP_ID__DESC = 'Id of the backup';
    const VPS_BACKUP_SNAPSHOT_DESCRIPTION = 'SnapshotDescription';
    const VPS_BACKUP_SNAPSHOT_DESCRIPTION__DESC = 'An informative description that describes the snapshot';

    const PRIVATENETWORK_NAME = 'PrivateNetworkName';
    const PRIVATENETWORK_NAME__DESC = 'The private network name';
    const PRIVATENETWORK_DESCRIPTION = 'PrivateNetworkDescription';
    const PRIVATENETWORK_DESCRIPTION__DESC = 'The private network description';

    const BIGSTORAGE_BACKUPID = 'BigStorageBackupId';
    const BIGSTORAGE_BACKUPID__DESC = 'ID number of the backup';
    const BIGSTORAGE_NAME = 'BigStorageName';
    const BIGSTORAGE_NAME__DESC = 'The name of the big storage';
    const BIGSTORAGE_DESCRIPTION = 'BigStorageDescription';
    const BIGSTORAGE_DESCRIPTION__DESC = 'Description of the big storage';
    const BIGSTORAGE_SIZE = 'BigStorageSize';
    const BIGSTORAGE_SIZE__DESC = 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40';
    const BIGSTORAGE_HASOFFSITEBACKUPS = 'BigStorageHasOffSiteBackups';
    const BIGSTORAGE_HASOFFSITEBACKUPS__DESC = 'Whether to order offsite backups, default is true.';

    const HAIP_NAME = 'HaipName';
    const HAIP_NAME__DESC = 'The name of the HA-IP';
}
