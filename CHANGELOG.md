CHANGELOG
=========
6.34.1
-----
* Added humbug box to pipeline so it uses latest version via composer

6.34.0
-----
* Added `GetByIdentifier` to the VPS commands 

6.33.3
-----
* Correctly parse the useApiWhitelist flag when using non interactive mode

6.33.2
-----
* CI: Fix GitHub release script

6.33.1
-----
* Renamed block storage diskSize parameter to size

6.33.0
-----
* Added ability to fetch Action from Operating Install

6.32.0
-----
* Added block storage commands. Deprecated big storage methods.

6.31.0
-----
* Added ssh key support to rescue images

6.30.0
-----
* Implemented Actions
* Implemented Poll Status command for Actions
* Added progress bar option to specific Actions

6.29.3
-----
* Added configFile option to all commands.

6.29.2
-----
* Fixed getEntries in certain conditions on mailLists.

6.29.1
-----
* Added type to the Openstack Project entity

6.29.0
-----
* Changed used resource parameter name in MailListRepository
* Changed behaviour of MailListRepository::update, now expects MailList entity

6.28.0
-----
* Implemented Object Store functionality
* Added token endpoint to Openstack

6.27.0
-----
* Added domain auth-code endpoint

6.24.0
-----
* Added an endpoint for operating system filtering on specs
* Added isDefault option to the SSH keys endpoint.

6.23.1
-----
* Updated `guzzlehttp/guzzle`

6.23.0
-----
* Added Ssl Install

6.22.0
-----
* Added domain handover

6.21.0
-----
* Added default domain contacts endpoint

6.19.0
-----
* Added includes to domain:getbyname and domain:getall
* Updated tipctl composer dependencies to symfony 5 
  * Minimum required PHP version is now 7.2.5
* Renamed update setting command and solved minor issue

6.18.0
-----
* Added colocation access request command

6.17.0
-----

* Added VPS Settings resource commands
* Added Rescue Image resource commands

6.16.1
-----
* Added Mailbox resource commands
* Added Mail Forward resource commands
* Added Mail List resource commands
* Added SSL certificate resource commands

6.14.0
-----
* Added licenseName field for vps order
* Added licenseName field for vps install

6.12.1
-----
* Fixed a json serializable return datatype deprecation that occurred when running on PHP 8.1

6.12.0
-----
* Added OpenStack resource commands

6.11.0
-----
* Added destination big storage name for backup restore

6.10.0
-----
* Added autodns functionality for domain

6.9.0
-----
* Added support for NAPTR DNS resource record

6.8.0
-----
* Added getbyvpsname method to the operatingsystem command
* Deprecated Traffic endpoint in favor of TrafficPool endpoint

6.7.1
-----
* Added getZoneFile function

6.7.0
-----
* Added a reset function for the VpsFirewall 

6.6.2
-----
* Fixed a bug that prevented running a non-interactive setup

6.6.1
-----
* Enabled PHP 8.0 support

6.6.0
-----
* Added vps license resource commands

6.5.0
-----
* Added isLocked property to HA-IP

6.4.0
-----
* Added UUID property to VPS

6.3.0
-----
* Added tls mode property to HA-IP

6.2.0
-----
* Added the serial property to BigStorage

6.1.0
-----

* Added SSH Key resource commands
* Added CloudInit installation functionality to order and install VPS commands
* Added bigstorage description parameter to order command

6.0.5
-----

* Fix to demo mode, you can now use it without running setup
* You can now specify expiry date when requesting access tokens

6.0.4
-----

* Switched the transip library repository to transip-api-php

6.0.3
-----

* Fixed errors with finding the auto loader when installing using composer

6.0.2
-----

* Added tipctl to the vendor binaries directory.
* Updated README.md

6.0.1
-----

* Fixed potential compatibility issues with Symfony versions across different projects when conducting a composer global install 

6.0.0
-----

* Added test and demo mode
* Added access to rate limit statistics
* Added commands for availability zones, bigstorage, colocation, domain, haip, invoice, mailservice, private network, products, traffic & VPS
* Started tipctl project
