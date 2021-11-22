CHANGELOG
=========

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
