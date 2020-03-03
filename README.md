<a href="https://transip.eu" target="_blank">
    <img width="200px" src="https://www.transip.nl/img/cp/transip-logo.svg">
</a>

# Tipctl

TransIP Control (tipctl) is a tool that connects to the TransIP API from your terminal. It has all available resources implemented from the [TransIP RestAPI](https://api.transip.nl/rest/docs.html), and offers you commands to order, update and remove products from your TransIP account.  

[![Latest Stable Version](https://poser.pugx.org/transip/tipctl/v/stable?format=flat-square)](https://packagist.org/packages/transip/tipctl)
[![License](https://poser.pugx.org/transip/tipctl/license?format=flat-square)](https://packagist.org/packages/transip/tipctl)

## Requirements

* PHP 7.2.0 or later.
* [json](https://www.php.net/manual/en/book.json.php) (php extension)
* [openssl](https://www.php.net/manual/en/book.openssl.php) (php extension)

## Installation

There are two ways you can install Tipctl.

### Download and install the PHAR file

This can be downloaded from our most recent [GitHub Release](https://github.com/transip/tipctl/releases).
 
Once the file has been downloaded, you must make sure that the phar file has a correct permission for it to be an executable.
```shell script
# Go to tipctl.phar
cd /path/to/tipctl

# Make phar file executable
chmod +x ./tipctl.phar

# Test if the tipctl is executable
./tipctl.phar --version
```
It is important to note that you must use `./` every time to indicate you are using the tipctl executable from your current directory. This is because the command line (bash) interprets all commands by looking for commands in locations described in the environment variable `$PATH`. If you want to use the tipctl command globally, then we recommend installing using composer.

### Install with Composer

You can install Tipctl using [Composer](http://getcomposer.org/). Run the following command:

```shell script
composer global require transip/tipctl
```

Now that the tipctl binary is available globally, make sure that your global vendor binaries directory is included in your environment `$PATH` variable. You can get the vendor binaries directory by using the following command:
```shell script
composer global config bin-dir --absolute
```

Now execute the following command to see the version of tipctl installed:
```shell script
tipctl --version
```

## Getting started

Run the user interactive setup script
```shell script
tipctl setup
```

You can also run the setup script with no user interaction
```shell script
tipctl setup --no-interaction --apiUrl 'https://api.transip.nl/v6' --loginName 'yourUsername' --apiPrivateKey 'yourKeyPair' --apiUseWhitelist true
```

## Usage / Commands

### List all available commands

```shell script
tipctl list
```

### List all of your domains

```shell script
tipctl domain:getall
```

### Update a single DNS record on your domain

```shell script
# See usage information
tipctl domain:dns:updatednsentry -h

# Update a DNS record
tipctl domain:dns:updatednsentry example.com subdomain 300 A 37.97.254.1
```

## How PHP resource calls are implemented

Since this project is built on the RestAPI PHP library, in the [library README.md](https://github.com/transip/transip-api-php/blob/master/README.md) we recommend to look in to this CLI project for examples on how we have implemented the available resource calls that exist in the RestAPI library.

### Where to find the implementations

All commands implemented in this project are located inside the `src/Command/` directory. Each class represents a command for Tipctl. 

Every class has a execute method that will look like this:
```php
protected function execute(InputInterface $input, OutputInterface $output)
{
    $domains = $this->getTransipApi()->domains()->getAll();
    $this->output($domains);
}
```

The code snippet in the code above is equivalent to this library example:
```php
$domains = $api->domains()->getAll();
```

To see how to retrieve all invoices in your TransIP account, you would look in to the file: `src/Command/Invoice/GetAll.php`

The code example for this should be interpreted like this:

```php
/**
* Implementation in tipctl
 */
protected function execute(InputInterface $input, OutputInterface $output)
{
    $page = $input->getArgument(Field::PAGE);
    $itemsPerPage = $input->getArgument(Field::ITEMS_PER_PAGE);

    $invoices = $this->getTransipApi()->invoice()->getSelection($page, $itemsPerPage);

    $this->output($invoices);
}

/**
* How this implementation should be interpreted and used when using the RestAPI library
 */
$page = 1;
$itemsPerPage = 25;
$invoices = $api->invoice()->getSelection($page, $itemsPerPage);
print_r($invoices);
```

To see all implementations in this project, you can see what commands are available by downloading Tipctl and listing all available commands. You can then use this as a reference point to find your desired class.
