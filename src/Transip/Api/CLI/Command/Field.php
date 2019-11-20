<?php

namespace Transip\Api\CLI\Command;

class Field
{
    const OPTIONAL = ' (optional)';

    const CANCELTIME = 'CancelTime';
    const CANCELTIME__DESC = 'Cancellation time, either ‘end’ or ‘immediately’';
    const AVAILABILITY_ZONE = 'AvailabilityZone';
    const AVAILABILITY_ZONE__DESC = 'The region name where this product should be created';

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
    const VPS_IPAddress = 'VpsIPAddress';
    const VPS_IPAddress__DESC = 'The IP address of the VPS';
    const VPS_IPAddress_Ptr = 'Ptr';
    const VPS_IPAddress_Ptr__DESC = 'Reverse DNS record';
    const VPS_IPV6Address = 'IPv6Address';
    const VPS_IPV6Address__DESC = 'An IPv6 Address';

    const PRIVATENETWORK_NAME = 'PrivateNetworkName';
    const PRIVATENETWORK_NAME__DESC = 'The private network name';
    const PRIVATENETWORK_DESCRIPTION = 'PrivateNetworkDescription';
    const PRIVATENETWORK_DESCRIPTION__DESC = 'The private network description';

    const BIGSTORAGE_BACKUPID = 'BigStorageBackupId';
    const BIGSTORAGE_BACKUPID__DESC = 'ID number of the backup';
    const BIGSTORAGE_NAME = 'BigStorageName';
    const BIGSTORAGE_NAME__DESC = 'The name of the big storage.';
    const BIGSTORAGE_DESCRIPTION = 'BigStorageDescription';
    const BIGSTORAGE_DESCRIPTION__DESC = 'Description of the big storage';
    const BIGSTORAGE_SIZE = 'BigStorageSize';
    const BIGSTORAGE_SIZE__DESC = 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40';
    const BIGSTORAGE_HASOFFSITEBACKUPS = 'BigStorageHasOffSiteBackups';
    const BIGSTORAGE_HASOFFSITEBACKUPS__DESC = 'Whether to order offsite backups, default is true.';
}
