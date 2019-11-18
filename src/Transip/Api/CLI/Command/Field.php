<?php

namespace Transip\Api\CLI\Command;

class Field
{
    const VPS_NAME = 'VpsName';
    const VPS_NAME__DESC = 'The name of the vps';

    const PRIVATENETWORK_NAME = 'PrivateNetworkName';
    const PRIVATENETWORK_NAME__DESC = 'The private network name';
    const PRIVATENETWORK_DESCRIPTION = 'PrivateNetworkDescription';
    const PRIVATENETWORK_DESCRIPTION__DESC = 'The private network description';
    const PRIVATENETWORK_CANCELTIME = 'PrivateNetworkCancelTime';
    const PRIVATENETWORK_CANCELTIME__DESC = 'Cancellation time, either ‘end’ or ‘immediately’';

    const BIGSTORAGE_BACKUPID = 'BigStorageBackupId';
    const BIGSTORAGE_BACKUPID__DESC = 'ID number of the backup';
    const BIGSTORAGE_NAME = 'BigStorageName';
    const BIGSTORAGE_NAME__DESC = 'The name of the big storage.';
    const BIGSTORAGE_DESCRIPTION = 'BigStorageDescription';
    const BIGSTORAGE_DESCRIPTION__DESC = 'Description of the big storage';
    const BIGSTORAGE_CANCELTIME = 'BigStorageCancelTime';
    const BIGSTORAGE_CANCELTIME__DESC = 'Cancellation time, either ‘end’ or ‘immediately’';
    const BIGSTORAGE_SIZE = 'BigStorageSize';
    const BIGSTORAGE_SIZE__DESC = 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40.';
    const BIGSTORAGE_HASOFFSITEBACKUPS = 'BigStorageHasOffSiteBackups';
    const BIGSTORAGE_AVAILABILITYZONE = 'BigStorageAvailabilityZone';
}
