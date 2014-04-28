Rage4 DNS - Console Tool & PHP Library
====

This PHP5.3 library helps you to interact with the [Rage4 DNS API](http://gbshouse.uservoice.com/knowledgebase/articles/109834-rage4-dns-developers-api) via PHP or Console.

>The **Rage4 DNS** is fast, reliable and cost effective authoritative name servers service designed for high availability and performance. [Read more](http://rage4.com/Home/DNS)

Installation
------------

This library can be found on [Packagist](https://packagist.org/packages/toin0u/digitalocean).
The recommended way to install this is through [composer](http://getcomposer.org).

Run these commands to install composer, the library and its dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar require haphan/rage4dns:@stable
```

Or edit `composer.json` and add:

```json
{
    "require": {
        "haphan/rage4dns": "@stable"
    }
}
```

**Protip:** To install latest dev release, you should browse the
[`haphan/rage4dns`](https://packagist.org/packages/haphan/rage4dns)
page to choose a stable version to use, avoid the `@stable` meta constraint.

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Now you can add the autoloader, and you will have access to the library:

```php
<?php

require 'vendor/autoload.php';
```

Console commands - CLI 
------
To use the Command line interface, you need to copy and rename the
`credentials.yml.dist` file to `credentials.yml` in your project directory, then add your own Email and API key:

```yml
email: <YOUR_EMAIL>
api_key:  <YOUR_API_KEY>
```

If you want to use another credential file just add the option `--credentials="/path/to/file"` to command.

#### Available commands for `domains`
```bash
$ php bin/rage4dns domains:all
+-------+-------------+------------------------+------+-------------+
| ID    | Name        | Owner Email            | Type | Subnet Mask |
+-------+-------------+------------------------+------+-------------+
| 20000 | fooo.com    | email.1234@example.com | 0    | 0           |
| 20001 | example.net | email.1234@example.com | 0    | 0           |
| 20002 | example.com | email.1234@example.com | 0    | 0           |
+-------+-------------+------------------------+------+-------------+


$ php bin/rage4dns domains:id 20002
+-------+-------------+------------------------+------+-------------+
| ID    | Name        | Owner Email            | Type | Subnet Mask |
+-------+-------------+------------------------+------+-------------+
| 20002 | example.com | email.1234@example.com | 0    | 0           |
+-------+-------------+------------------------+------+-------------+


$ php bin/rage4dns domains:create foobar.com example.123@example.com
+--------+-------+-------+
| Status | ID    | Error |
+--------+-------+-------+
| true   | 27123 |       |
+--------+-------+-------+

domains:createVanity   Create regular domain with vanity name server.
domains:delete         Delete a domain.
domains:export         Export zones as BIND compatible file format

domains:name           Get domain by name.
domains:update         Update a domain.
```

#### Available commands for `records`

```bash
records:all            List all records for specific domain.
records:create         Create a record.
records:delete         Delete a record.
records:regions        Display all geo regions.
records:types          Display all available record types.
records:update         Update a record.
```

#### Available commands for `usage`
```bash
usage:domain           Retrieve usage of a domain.
usage:global           Retrieve global usage.
```
