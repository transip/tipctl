<?php

namespace Transip\Api\CLI\Command;

class Field
{
    public const OPTIONAL = ' (optional)';

    public const CANCELTIME = 'CancelTime';
    public const CANCELTIME__DESC = 'Cancellation time, either ‘end’ or ‘immediately’';
    public const AVAILABILITY_ZONE = 'AvailabilityZone';
    public const AVAILABILITY_ZONE__DESC = 'The region name where this product should be created';

    public const VPS_NAME = 'VpsName';
    public const VPS_NAME__DESC = 'The name of the vps';
    public const VPS_ADDONS = 'Addons';
    public const VPS_ADDONS__DESC = 'Add-on names(more than one comma separated)';
    public const VPS_ADDON = 'AddonName';
    public const VPS_ADDON__DESC = 'Add-on name';
    public const VPS_BACKUP_ID = 'VpsBackupId';
    public const VPS_BACKUP_ID__DESC = 'Id of the backup';
    public const VPS_BACKUP_SNAPSHOT_DESCRIPTION = 'SnapshotDescription';
    public const VPS_BACKUP_SNAPSHOT_DESCRIPTION__DESC = 'An informative description that describes the snapshot';
    public const VPS_IPAddress = 'VpsIPAddress';
    public const VPS_IPAddress__DESC = 'The IP address of the VPS';
    public const VPS_IPAddress_Ptr = 'Ptr';
    public const VPS_IPAddress_Ptr__DESC = 'Reverse DNS record';
    public const VPS_IPV6Address = 'IPv6Address';
    public const VPS_IPV6Address__DESC = 'An IPv6 Address';
    public const VPS_OS_NAME = 'OperatingSystemName';
    public const VPS_OS_NAME__DESC = 'The name of the operating system to install';
    public const VPS_HOSTNAME = 'Hostname';
    public const VPS_HOSTNAME__DESC = 'Hostname is required for preinstallable web controlpanels';
    public const VPS_PRODUCT_NAME = 'ProductName';
    public const VPS_PRODUCT_NAME__DESC = 'Name of the product';
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

    public const HAIP_NAME = 'HaipName';
    public const HAIP_NAME__DESC = 'The name of the HA-IP';
    public const HAIP_DESCRIPTION = 'Description';
    public const HAIP_DESCRIPTION__DESC = 'Description to give to the Haip';

    public const DOMAIN_NAME = 'DomainName';
    public const DOMAIN_NAME__DESC = 'The domain name';
    public const DOMAIN_TAG = 'TagName';
    public const DOMAIN_TAG__DESC = 'The tag name';
}
