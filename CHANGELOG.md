CHANGELOG
=========

6.1.1
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
