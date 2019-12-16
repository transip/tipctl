<?php

namespace Transip\Api\CLI\Command;

class Field
{
    public const OPTIONAL = ' (optional)';

    public const CUSTOMER_NAME = 'CustomerName';
    public const CUSTOMER_NAME__DESC = 'The account name of the customer';
    public const CANCELTIME = 'CancelTime';
    public const CANCELTIME__DESC = 'Cancellation time, either ‘end’ or ‘immediately’';
    public const AVAILABILITY_ZONE = 'AvailabilityZone';
    public const AVAILABILITY_ZONE__DESC = 'The region name where this product should be created (find by <fg=yellow>AvailabilityZones:getAll</>)';

    public const DOMAIN_NAME = 'DomainName';
    public const DOMAIN_NAME__DESC = 'The domain name';
    public const DOMAIN_TRANSFER_LOCK = 'TransferLock';
    public const DOMAIN_TRANSFER_LOCK__DESC = 'Transfer Lock (true|false)';

    public const DOMAIN_NAMESERVERS = 'Nameservers';
    public const DOMAIN_NAMESERVERS__DESC = 'Nameserver hostnames (comma separated)';

    public const DOMAIN_COMPANY_NAME = 'companyName';
    public const DOMAIN_COMPANY_NAME__DESC = 'Name of the company';
    public const DOMAIN_SUPPORT_EMAIL = 'supportEmail';
    public const DOMAIN_SUPPORT_EMAIL__DESC = 'Public email shown in the branding';
    public const DOMAIN_COMPANY_URL = 'companyUrl';
    public const DOMAIN_COMPANY_URL__DESC = 'Website of the company';
    public const DOMAIN_TERMS_OF_USAGE_URL = 'termsOfUsageUrl';
    public const DOMAIN_TERMS_OF_USAGE_URL__DESC = 'URL to the terms of usage doc';
    public const DOMAIN_BANNER_LINE_1 = 'bannerLine1';
    public const DOMAIN_BANNER_LINE_2 = 'bannerLine2';
    public const DOMAIN_BANNER_LINE_3 = 'bannerLine3';

    public const DOMAIN_CONTACT_TYPE = 'type';
    public const DOMAIN_CONTACT_TYPE__DESC = 'Contact type registrant|administrative|technical';
    public const DOMAIN_FIRST_NAME = 'firstName';
    public const DOMAIN_FIRST_NAME__DESC = 'First Name';
    public const DOMAIN_LAST_NAME = 'lastName';
    public const DOMAIN_LAST_NAME__DESC = 'Last Name';
    public const DOMAIN_COMPANY_KVK = 'companyKvk';
    public const DOMAIN_COMPANY_KVK__DESC = 'Company Chamber of Commerce number';
    public const DOMAIN_STREET = 'street';
    public const DOMAIN_STREET__DESC = 'Street name';
    public const DOMAIN_NUMBER = 'number';
    public const DOMAIN_NUMBER__DESC = 'Street number';
    public const DOMAIN_POSTAL_CODE = 'postalCode';
    public const DOMAIN_POSTAL_CODE__DESC = 'Postal Code';
    public const DOMAIN_CITY = 'city';
    public const DOMAIN_CITY__DESC = 'City';
    public const DOMAIN_PHONE_NUMBER = 'phoneNumber';
    public const DOMAIN_PHONE_NUMBER__DESC = 'PhoneNumber';
    public const DOMAIN_FAX_NUMBER = 'faxNumber';
    public const DOMAIN_FAX_NUMBER__DESC = 'Fax Number';
    public const DOMAIN_EMAIL = 'email';
    public const DOMAIN_EMAIL__DESC = 'EmailAddress';
    public const DOMAIN_COUNTRY = 'country';
    public const DOMAIN_COUNTRY__DESC = 'Country';

    public const DOMAIN_AUTH_CODE = 'AuthCode';
    public const DOMAIN_AUTH_CODE__DESC = 'Authentication code for transfer';

    public const DOMAIN_ZONE_FILE = 'Zone';
    public const DOMAIN_ZONE_FILE__DESC = 'Whole DNS Zone for domain';

    public const DNS_ENTRY_NAME = 'Name';
    public const DNS_ENTRY_NAME__DESC = 'The name of the DNS Record';
    public const DNS_ENTRY_EXPIRE = 'Expire';
    public const DNS_ENTRY_EXPIRE__DESC = 'TTL of the DNS Record';
    public const DNS_ENTRY_TYPE = 'Type';
    public const DNS_ENTRY_TYPE__DESC = 'DNS Record type';
    public const DNS_ENTRY_CONTENT = 'Content';
    public const DNS_ENTRY_CONTENT__DESC = 'The content of the DNS Record';

    public const DNSSEC_ENTRY_KEYTAG = 'KeyTag';
    public const DNSSEC_ENTRY_KEYTAG__DESC = 'A 5-digit key of the Zonesigner';
    public const DNSSEC_ENTRY_FLAGS = 'Flags';
    public const DNSSEC_ENTRY_FLAGS__DESC = 'The signing key number, either 256 (Zone Signing Key) or 257 (Key Signing Key)';
    public const DNSSEC_ENTRY_ALGORITHM = 'Algorithm';
    public const DNSSEC_ENTRY_ALGORITHM__DESC = 'The algorithm type that is used, 3|5|6|7|8|10|12|13|14';
    public const DNSSEC_ENTRY_PUBLICKEY = 'PublicKey';
    public const DNSSEC_ENTRY_PUBLICKEY__DESC = 'The public key';

    public const SSL_ID = 'CertificateId';
    public const SSL_ID__DESC = 'SSL certificateId';

    public const TLD = 'TLD';
    public const TLD__DESC = 'Top level domain';

    public const VPS_NAME = 'VpsName';
    public const VPS_NAME__DESC = 'The name of the vps';
    public const VPS_DESCRIPTION = 'VpsDescription';
    public const VPS_DESCRIPTION__DESC = 'Description of the vps';
    public const VPS_ADDONS = 'Addons';
    public const VPS_ADDONS__DESC = 'Add-on names(more than one comma separated)';
    public const VPS_ADDON = 'AddonName';
    public const VPS_ADDON__DESC = 'Add-on name';
    public const VPS_BACKUP_ID = 'VpsBackupId';
    public const VPS_BACKUP_ID__DESC = 'Id of the backup';
    public const VPS_BACKUP_SNAPSHOT_DESCRIPTION = 'SnapshotDescription';
    public const VPS_BACKUP_SNAPSHOT_DESCRIPTION__DESC = 'An informative description that describes the snapshot';
    public const VPS_IPV6Address = 'IPv6Address';
    public const VPS_IPV6Address__DESC = 'An IPv6 Address';
    public const VPS_OS_NAME = 'OperatingSystemName';
    public const VPS_OS_NAME__DESC = 'The name of the operating system to install (find by <fg=yellow>Vps:OperatingSystem:getAll</>)';
    public const VPS_HOSTNAME = 'Hostname';
    public const VPS_HOSTNAME__DESC = 'Hostname is required for preinstallable web controlpanels';
    public const VPS_MULTIPLE_COUNT = 'Amount of VPSs';
    public const VPS_MULTIPLE_COUNT__DESC = 'The amount of VPSs to order';
    public const VPS_PRODUCT_NAME = 'ProductName';
    public const VPS_PRODUCT_NAME__DESC = 'Name of the product (find by <fg=yellow>Products:getAll</>)';
    public const VPS_SNAPSHOT_NAME = 'SnapshotName';
    public const VPS_SNAPSHOT_NAME__DESC = 'Name of the snapshot';

    public const PRIVATENETWORK_NAME = 'PrivateNetworkName';
    public const PRIVATENETWORK_NAME__DESC = 'The private network name';

    public const BIGSTORAGE_NAME = 'BigStorageName';
    public const BIGSTORAGE_NAME__DESC = 'The name of the big storage';
    public const BIGSTORAGE_SIZE = 'BigStorageSize';
    public const BIGSTORAGE_SIZE__DESC = 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40';
    public const BIGSTORAGE_HASOFFSITEBACKUPS = 'BigStorageHasOffSiteBackups';
    public const BIGSTORAGE_HASOFFSITEBACKUPS__DESC = 'Whether to order offsite backups, default is true.';
    public const BIGSTORAGE_BACKUPID = 'BigStorageBackupId';
    public const BIGSTORAGE_BACKUPID__DESC = 'ID number of the backup';
    public const BIGSTORAGE_DESCRIPTION = 'BigStorageDescription';
    public const BIGSTORAGE_DESCRIPTION__DESC = 'Description of the big storage';

    public const HAIP_NAME = 'HaipName';
    public const HAIP_NAME__DESC = 'The name of the HA-IP';
    public const PORTCONFIGURATION_ID = 'PortConfigurationId';
    public const PORTCONFIGURATION_ID__DESC = 'The id of the port configuration';
    public const HAIP_DESCRIPTION = 'Description';
    public const HAIP_DESCRIPTION__DESC = 'Description to give to the Haip';
    public const SSL_CERTIFICATE_ID = 'sslCertificateId';
    public const SSL_CERTIFICATE_ID__DESC = 'Provide the identifier of an existing Domain:Ssl certificate';

    public const DOMAIN_TAG = 'TagName';
    public const DOMAIN_TAG__DESC = 'The tag name';

    public const COLOCATION_NAME = 'coloName';
    public const COLOCATION_NAME__DESC = 'Name of colocation';
    public const COLOCATION_REMOTE_HANDS_CONTACT_NAME = 'contactName';
    public const COLOCATION_REMOTE_HANDS_CONTACT_NAME__DESC = 'Name of contact creating the remote hand';
    public const COLOCATION_REMOTE_HANDS_PHONE_NUMBER = 'phoneNumber';
    public const COLOCATION_REMOTE_HANDS_PHONE_NUMBER__DESC = 'Phonenumber to contact in case of questions';
    public const COLOCATION_REMOTE_HANDS_EXPECTED_DURATION = 'expectedDuration';
    public const COLOCATION_REMOTE_HANDS_EXPECTED_DURATION__DESC = 'Approximation of the time needed to complete in minutes';
    public const COLOCATION_REMOTE_HANDS_INSTRUCTIONS = 'instructions';
    public const COLOCATION_REMOTE_HANDS_INSTRUCTIONS__DESC = 'Instructions on the task to perform';


    public const IPADDRESS = 'IPAddress';
    public const IPADDRESS__DESC = 'The IP address';
    public const IPADDRESS_PTR = 'Ptr';
    public const IPADDRESS_PTR__DESC = 'Reverse DNS record';

    public const API_URL = 'apiUrl';
    public const API_LOGIN = 'loginName';
    public const API_PRIVATE_KEY = 'apiPrivateKey';
    public const API_USE_WHITELIST = 'apiUseWhitelist';
    public const SHOW_CONFIG_FILE_PERMISSION_WARNING = 'showConfigFilePermissionWarning';
    public const FORMAT = 'format';
    public const FORMAT__DESC = 'The output format `txt`, `yaml` or `json`';
}
