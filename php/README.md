Subdomain Blacklist (PHP)
===================

For full information on this project check the main [README.md](../README.md).

[![Build Status](https://travis-ci.org/michaldudek/subdomain-blacklist.svg?branch=master)](https://travis-ci.org/michaldudek/subdomain-blacklist)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/55ab2d97-ebbc-46a9-844b-877ab991eafa/mini.png)](https://insight.sensiolabs.com/projects/55ab2d97-ebbc-46a9-844b-877ab991eafa)
[![HHVM Status](http://hhvm.h4cc.de/badge/michaldudek/subdomain-blacklist.png)](http://hhvm.h4cc.de/package/michaldudek/subdomain-blacklist)

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

