Subdomain Blacklist
===================

List of common words that your users shouldn't use when setting up accounts.

[![Build Status](https://travis-ci.org/michaldudek/subdomain-blacklist.svg?branch=master)](https://travis-ci.org/michaldudek/subdomain-blacklist)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/55ab2d97-ebbc-46a9-844b-877ab991eafa/mini.png)](https://insight.sensiolabs.com/projects/55ab2d97-ebbc-46a9-844b-877ab991eafa)
[![HHVM Status](http://hhvm.h4cc.de/badge/michaldudek/subdomain-blacklist.png)](http://hhvm.h4cc.de/package/michaldudek/subdomain-blacklist)

When your app or service allows users to access their accounts using subdomains, e.g. `_michaldudek_.myapp.com`,
it is useful to block some words so they don't take away a subdomain you'd want to use in the future
or worse, try to trick your other users into believing they represent you (e.g. `_legal_.myapp.com` or
`_support_.myapp.com).

Apart from the blacklist, the goal of this repository is to provide code in various languages
that validates a username against the list.

Note that the goal of this library IS NOT to validate domain name. You still have to check whether or not
the given username makes a valid subdomain.

#### Acknowledgement

The idea and the list was originally taken from [Sandeep Shetty](https://github.com/sandeepshetty/subdomain-blacklist).

# Spec

Implementation MUST have a method/function called `validate` which takes a single string argument.

The `validate` method/function MUST return a boolean value.

Before a string is validates it MUST be normalized. Normalization of the string MUST:

- remove any suffixed digits,
- change case to lowercase,
- remove a single `s` character if the string ends with an `s`.

#### addToList

Implementation CAN contain `addToList` (or `add_to_list` if more appropriate for the language) method/function
that will add other items to the blacklist.

`addToList` method/function MUST accept single string argument.

`addToList` method/function CAN accept an array of strings as a single argument.

Before a string item is added to the blacklist via `addToList` method/function the default blacklist MUST be loaded.

Before a string item is added to the blacklist it MUST be normalized with the rules above.

#### getList

Implementation CAN contain `getList` (or `get_list` if more appropriate for the language) method/function
that will return the blacklist.

# Using and Languages

For more information about how to use this list in your specific language, please refer to `README.md` file
in the language's folder.

Currently supported:

- php - [more info](php/README.md) - `$ composer require michaldudek/subdomain-blacklist dev-master`

Planned:

- JavaScript (node.js)
- JavaScript (browser)
- Go
- Ruby
- Python

You are welcome to add support for other languages.

# Contributing

At this moment pull requests with support for various languages are most welcome.

If you add a language support make sure to cover it with appropriate tests.

Also if you think some words should be added to the list either open an issue or do a PR.

If you are editing a code please make sure to adhere to common patterns and rules in that language.

See more in each languages specific `README.md` file in their appropriate directory.
