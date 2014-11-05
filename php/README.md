Subdomain Blacklist (PHP)
===================

For full information on this project check the main [README.md](../README.md).

# Installation

You can install Subdomain Blacklist using [Composer](https://getcomposer.org).

    $ composer require michaldudek/subdomain-blacklist dev-master

Or add it to your `composer.json` file:

    {
        "require": {
           "michaldudek/subdomain-blacklist": "dev-master"
        }
    }

# Using

To validate a string you have to instantiate the `MD\SubdomainBlacklist\SubdomainBlacklist` class
and call `::validate()` method on it:

    use MD\SubdomainBlacklist\SubdomainBlacklist;

    $blacklist = new SubdomainBlacklist();
    echo $blacklist->validate('myusername');
    // -> true

# Contributing

If you want to contribute to the PHP code please adhere to common coding conventions.

Also make sure all your changes pass unit tests and are covered with unit tests.

To run tests you will need PHPUnit.

    $ cd php
    $ phpunit -c phpunit.xml

