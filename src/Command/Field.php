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
    public const AVAILABILITY_ZONE__DESC = 'The region name where this product should be created (find by <fg=yellow>availabilityzones:getall</>)';

    public const DOMAIN_NAME = 'DomainName';
    public const DOMAIN_NAME__DESC = 'The domain name';
    public const DOMAIN_NAMES = 'DomainNames';
    public const DOMAIN_NAMES__DESC = 'DomainNames (comma seperated)';
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
    public const DOMAIN_COMPANY_TYPE = 'CompanyType';
    public const DOMAIN_COMPANY_TYPE__DESC = 'Company type: BV|BVI/O|COOP|CV|EENMANSZAAK|KERK|NV|OWM|REDR|STICHTING|VERENIGING|VOF|BEG|BRO|EESV|ANDERS';
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

    public const TLD = 'TLD';
    public const TLD__DESC = 'Top level domain';

    public const PRODUCT_NAME = 'ProductName';
    public const PRODUCT_NAME__DESC = 'Name of the product (find by <fg=yellow>products:getall</>)';

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
    public const VPS_FIREWALL_DESCRIPTION = 'Description';
    public const VPS_FIREWALL_DESCRIPTION__DESC = 'Description of the Firewall Rule';
    public const VPS_FIREWALL_START_PORT = 'StartPort';
    public const VPS_FIREWALL_START_PORT__DESC = 'StartPort of the Firewall Rule';
    public const VPS_FIREWALL_END_PORT = 'EndPort';
    public const VPS_FIREWALL_END_PORT__DESC = 'EndPort of the Firewall Rule';
    public const VPS_FIREWALL_PROTOCOL = 'Protocol';
    public const VPS_FIREWALL_PROTOCOL__DESC = 'Protocol of the Firewall Rule';
    public const VPS_FIREWALL_WHITELIST = 'Whitelist';
    public const VPS_FIREWALL_WHITELIST__DESC = 'Whitelisted IP\'s or Ranges of the Firewall Rule (comma seperated)';
    public const VPS_SNAPSHOT_DESCRIPTION = 'SnapshotDescription';
    public const VPS_SNAPSHOT_DESCRIPTION__DESC = 'An informative description that describes the snapshot';
    public const VPS_SNAPSHOT_SHOULDSTARTVPS = 'ShouldStartVPS';
    public const VPS_SNAPSHOT_SHOULDSTARTVPS__DESC = 'Should start the VPS right after the snapshot has been taken';
    public const VPS_IPV6Address = 'IPv6Address';
    public const VPS_IPV6Address__DESC = 'An IPv6 Address';
    public const VPS_OS_NAME = 'OperatingSystemName';
    public const VPS_OS_NAME__DESC = 'The name of the operating system to install (find by <fg=yellow>vps:operatingsystem:getall</>)';
    public const VPS_HOSTNAME = 'Hostname';
    public const VPS_HOSTNAME__DESC = 'Hostname is required for preinstallable web controlpanels';
    public const VPS_MULTIPLE_COUNT = 'Amount of VPSs';
    public const VPS_MULTIPLE_COUNT__DESC = 'The amount of VPSs to order';
    public const VPS_SNAPSHOT_NAME = 'SnapshotName';
    public const VPS_SNAPSHOT_NAME__DESC = 'Name of the snapshot';
    public const VPS_DESTINATION_VPS_NAME = 'DestinationVpsName';
    public const VPS_DESTINATION_VPS_NAME__DESC = 'Reverts the snapshot to this VPS.';
    public const VPS_BASE64INSTALLTEXT = 'Base64InstallText';
    public const VPS_BASE64INSTALLTEXT__DESC = 'Base64 encoded preseed / kickstart instructions, when installing unattended';
    public const VPS_SET_LOCK = 'SetLock';
    public const VPS_SET_LOCK__DESC = 'VPS SetLock `true` or `false`';
    public const VPS_USERNAME = 'Username';
    public const VPS_USERNAME__DESC = 'The username you will be able to login with when installing with cloudinit flavour';
    public const VPS_INSTALL_FLAVOUR = 'installFlavour';
    public const VPS_INSTALL_FLAVOUR__DESC = 'The type of installation to use, installer, cloudinit or preinstallable';
    public const VPS_SSH_KEYS = 'SshKeys';
    public const VPS_SSH_KEYS__DESC = 'Add a public sshKey use for authentication with username in a cloudinit installation (use comma to seperate multiple keys)';

    public const PRIVATENETWORK_NAME = 'PrivateNetworkName';
    public const PRIVATENETWORK_NAME__DESC = 'The private network name';
    public const PRIVATENETWORK_DESCRIPTION = 'Description';
    public const PRIVATENETWORK_DESCRIPTION__DESC = 'Description to give to the private network';
    public const PRIVATENETWORK_WAIT_FOR_DELIVERY = 'WaitForDelivery';
    public const PRIVATENETWORK_WAIT_FOR_DELIVERY__DESC = 'Wait and poll until the private network is delivered';

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
    public const BIGSTORAGE_STARTDATE = 'StartDate';
    public const BIGSTORAGE_STARTDATE__DESC = 'Start date in unix timestamp';
    public const BIGSTORAGE_ENDDATE = 'EndDate';
    public const BIGSTORAGE_ENDDATE__DESC = 'End date in unix timestamp';
    public const BIGSTORAGE_VPS_ATTACH__DESC = 'The name of the VPS to attach the big storage to';
    public const BIGSTORAGE_VPS_AVAILABILITY_ZONE__DESC = 'The name of the availabilityZone where the BigStorage should be created. This parameter can not be used in conjunction with vpsName. If a vpsName is provided as well as an availabilityZone, the zone of the vps is leading';

    public const HAIP_NAME = 'HaipName';
    public const HAIP_NAME__DESC = 'The name of the HA-IP';
    public const HAIP_LOADBALANCING_MODE = 'LoadBalancingMode';
    public const HAIP_LOADBALANCING_MODE__DESC = 'The load balancing mode for the haip (roundrobin|cookie|source) are allowed load balancing modes';
    public const HAIP_COOKIE_NAME = 'CookieName';
    public const HAIP_COOKIE_NAME__DESC = 'Name of the cookie used in cookie loadbalancing mode';
    public const HAIP_IP_SETUP = 'IpSetup';
    public const HAIP_IP_SETUP__DESC = 'HA-IP IP setup can be any of (both|noipv6|ipv6to4)';
    public const HAIP_INTERVAL = 'Interval';
    public const HAIP_INTERVAL__DESC = 'The interval must be larger than 2000';
    public const HAIP_WAIT_FOR_DELIVERY = 'WaitForDelivery';
    public const HAIP_WAIT_FOR_DELIVERY__DESC = 'Wait and poll until the Haip is delivered';
    public const HAIP_PORT_CONFIGURATION_NAME = 'PortConfigName';
    public const HAIP_PORT_CONFIGURATION_NAME__DESC = 'The name of the PortConfiguration';
    public const HAIP_PORT_CONFIGURATION_SOURCE_PORT = 'SourcePort';
    public const HAIP_PORT_CONFIGURATION_SOURCE_PORT__DESC = 'Incoming portNumber of configuration';
    public const HAIP_PORT_CONFIGURATION_TARGET_PORT = 'TargetPort';
    public const HAIP_PORT_CONFIGURATION_TARGET_PORT__DESC = 'PortNumber to send the traffic to';
    public const HAIP_PORT_CONFIGURATION_MODE = 'Mode';
    public const HAIP_PORT_CONFIGURATION_MODE__DESC = 'The port configuration mode';
    public const HAIP_PORT_CONFIGURATION_SSL_MODE = 'SslMode';
    public const HAIP_PORT_CONFIGURATION_SSL_MODE__DESC = 'The endpoint SSL mode';
    public const HAIP_PORT_CONFIGURATION_ID = 'PortConfigurationId';
    public const HAIP_PORT_CONFIGURATION_ID__DESC = 'The id of the port configuration';
    public const HAIP_DESCRIPTION = 'Description';
    public const HAIP_DESCRIPTION__DESC = 'Description to give to the Haip';
    public const HAIP_TLS_MODE = 'TlsMode';
    public const HAIP_TLS_MODE__DESC = '`tls10_11_12` or `tls11_12` `tls12`';

    public const SSL_CERTIFICATE_ID = 'sslCertificateId';
    public const SSL_CERTIFICATE_ID__DESC = 'Provide the identifier of an existing domain:ssl certificate';
    public const SSL_COMMON_NAME = 'commonName';
    public const SSL_COMMON_NAME__DESC = 'Domain name for which we should issue the certificate';

    public const TAG_NAME = 'TagName';
    public const TAG_NAME__DESC = 'The tag name';

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
    public const IPADDRESSES = 'IPAddresses';
    public const IPADDRESSES__DESC = 'IpAddresses ipv4 or/and ipv6 (comma separated)';
    public const IPADDRESS_PTR = 'Ptr';
    public const IPADDRESS_PTR__DESC = 'Reverse DNS record';

    public const API_URL = 'apiUrl';
    public const API_LOGIN = 'loginName';
    public const API_PRIVATE_KEY = 'apiPrivateKey';
    public const API_USE_WHITELIST = 'apiUseWhitelist';
    public const SHOW_CONFIG_FILE_PERMISSION_WARNING = 'showConfigFilePermissionWarning';
    public const FORMAT = 'format';
    public const FORMAT__DESC = 'The output format `txt`, `yaml` or `json`';

    public const INVOICE_NUMBER = 'InvoiceNumber';
    public const INVOICE_NUMBER__DESC = 'A unique code that was assigned to your invoice';
    public const PAGE = 'Page';
    public const PAGE__DESC = 'Page of the result set';
    public const ITEMS_PER_PAGE = 'ItemsPerPage';
    public const ITEMS_PER_PAGE__DESC = 'Amount of data you would like visible per page.';

    public const TCP_IPADDRESS = self::IPADDRESS;
    public const TCP_IPADDRESS__DESC = 'IP Address that is monitored';
    public const LABEL = 'Label';
    public const LABEL__DESC = 'Title of the monitor';
    public const PORTS = 'Ports';
    public const PORTS__DESC = 'Ports that are to be monitored (comma separated)';
    public const CHECK_INTERVAL = 'CheckInterval';
    public const CHECK_INTERVAL__DESC = 'Checking interval in minutes (numbers 1-6)';
    public const ALLOWED_TIMEOUTS = 'AllowedTimeouts';
    public const ALLOWED_TIMEOUTS__DESC = 'Allowed time outs (numbers 1-5)';
    public const CONTACT_ID = 'ContactId';
    public const CONTACT_ID__DESC = 'Id number of the contact (find by <fg=yellow>vps:tcpmonitor:contact:getall</>)';
    public const CONTACT_ENABLE_EMAIL = 'EnableEmail';
    public const CONTACT_ENABLE_EMAIL__DESC = 'Send emails to contact (true|false)';
    public const CONTACT_ENABLE_SMS = 'EnableSMS';
    public const CONTACT_ENABLE_SMS__DESC = 'Send SMS text messages to contact (true|false)';
    public const TIME_FROM = 'TimeFrom';
    public const TIME_FROM__DESC = 'Ignore time start from (example `18:00`)';
    public const TIME_TO = 'TimeTo';
    public const TIME_TO__DESC = 'Ignore time end at (example `08:30`)';

    public const CONTACT_NAME = 'Name';
    public const CONTACT_NAME__DESC = 'Name of the contact';
    public const CONTACT_TELEPHONE = 'Telephone';
    public const CONTACT_TELEPHONE__DESC = 'Telephone number of the contact';
    public const CONTACT_EMAIL = 'Email';
    public const CONTACT_EMAIL__DESC = 'Email address of the contact';

    public const READ_ONLY = 'ReadOnly';
    public const READ_ONLY__DESC = 'Whether the token should be read only (true|false)';
    public const TOKEN_END_DATE = 'TokenEndDate';
    public const TOKEN_END_DATE__DESC = "Token end date '10 min', '1 day', '1 week', '1 month'";

    public const SSH_KEY_ID = 'SSHKeyId';
    public const SSH_KEY_ID__DESC = 'SSH key identifier';
    public const SSH_KEY = 'SSHKey';
    public const SSH_KEY__DESC = 'SSH Key';
    public const SSH_KEY_DESCRIPTION = 'Description';
    public const SSH_KEY_DESCRIPTION__DESC = 'SSH key description';

    public const LICENSE_ID = 'LicenseId';
    public const LICENSE_ID__DESC = 'License Id';
    public const LICENSE_NAME = 'LicenseName';
    public const LICENSE_NAME__DESC = 'License name';
    public const NEW_LICENSE_NAME = 'NewLicenseName';
    public const NEW_LICENSE_NAME__DESC = 'New license name that you want to switch to';
    public const QUANTITY = 'Quantity';
    public const QUANTITY__DESC = 'Amount';

    public const OPENSTACK_PROJECT_ID = 'ProjectId';
    public const OPENSTACK_PROJECT_ID__DESC = 'Project Id';
}
