Rage4 DNS - Console Tool & PHP Library
====

This PHP5.3+ library helps you to interact with the [Rage4 DNS API](http://gbshouse.uservoice.com/knowledgebase/articles/109834-rage4-dns-developers-api) via PHP or Console.

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

Requirements and Compatibility
------------

This library requires PHP 5.3+ runtime.

The library follows  [PSR-0](http://www.php-fig.org/psr/psr-0/) autoloading standard.

Compatible with all PSR-enabled frameworks and libaries, such as Symfony2, Zend Framework 2, Laravel, Phalcon.

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
# List all registered domains
$ php bin/rage4dns domains:all
+-------+-------------+------------------------+------+-------------+
| ID    | Name        | Owner Email            | Type | Subnet Mask |
+-------+-------------+------------------------+------+-------------+
| 20000 | fooo.com    | email.1234@example.com | 0    | 0           |
| 20001 | example.net | email.1234@example.com | 0    | 0           |
| 20002 | example.com | email.1234@example.com | 0    | 0           |
+-------+-------------+------------------------+------+-------------+

# Get domain by id.
$ php bin/rage4dns domains:id 20002
+-------+-------------+------------------------+------+-------------+
| ID    | Name        | Owner Email            | Type | Subnet Mask |
+-------+-------------+------------------------+------+-------------+
| 20002 | example.com | email.1234@example.com | 0    | 0           |
+-------+-------------+------------------------+------+-------------+

# Get domain by name.
$ php bin/rage4dns domains:id example.com
+-------+-------------+------------------------+------+-------------+
| ID    | Name        | Owner Email            | Type | Subnet Mask |
+-------+-------------+------------------------+------+-------------+
| 20002 | example.com | email.1234@example.com | 0    | 0           |
+-------+-------------+------------------------+------+-------------+

# Create regular domain.
$ php bin/rage4dns domains:create foobar.com example.123@example.com
+--------+-------+-------+
| Status | ID    | Error |
+--------+-------+-------+
| true   | 27123 |       |
+--------+-------+-------+
# Create regular domain with vanity name server.
$ php bin/rage4dns domains:createVanity example2.com example.123@example.com example.com ns
+--------+-------+-------+
| Status | ID    | Error |
+--------+-------+-------+
| true   | 27997 |       |
+--------+-------+-------+

# Remove a domain
$ php bin/rage4dns domains:delete 27997
Are you sure to delete domain with id 27997 ? (y/N) y
+--------+-------+-------+
| Status | ID    | Error |
+--------+-------+-------+
| true   | 27997 |       |
+--------+-------+-------+

# Export zones as BIND compatible file format
$ php bin/rage4dns domains:export 27995
$ORIGIN foobar.com.
$TTL 1h

foobar.com.	IN	SOA	r4ns.com. example.123.example.com. (
	2014042801
	1d
	2h
	4w
	1h
	)

foobar.com.	NS	ns1.r4ns.com.
foobar.com.	NS	ns2.r4ns.com.
foobar.com.	SOA	ns1.r4ns.com example.123.example.com 2014042801 10800 3600 604800 3600

# Update a domain
$php bin/rage4dns domains:update 27995 newemail@example.com example.com ns true
+--------+-------+-------+
| Status | ID    | Error |
+--------+-------+-------+
| true   | 27995 |       |
+--------+-------+-------+

```

#### Available commands for `records`

```bash
# List all records for specific domain.
$ php bin/rage4dns records:all 27995
+--------+------------+------------------------------------------------------------------------+------+------+----------+--------+--------+
| ID     | Name       | Content                                                                | Type | TTL  | Priority | Region | Active |
+--------+------------+------------------------------------------------------------------------+------+------+----------+--------+--------+
| 600393 | foobar.com | ns1.example.com                                                        | NS   | 3600 |          | 0      | true   |
| 600395 | foobar.com | ns2.example.com                                                        | NS   | 3600 |          | 0      | true   |
| 600397 | foobar.com | ns1.example.com newemail.example.com 2014042803 10800 3600 604800 3600 | SOA  | 3600 |          | 0      | true   |
+--------+------------+------------------------------------------------------------------------+------+------+----------+--------+--------+

# Create a record.
$ php bin/rage4dns records:create records:create 27995 dev.foobar.com 8.8.8.8 2 3600 0
+--------+--------+-------+
| Status | ID     | Error |
+--------+--------+-------+
| true   | 600811 |       |
+--------+--------+-------+

# Delete a record
$ php bin/rage4dns records:delete 600811
Are you sure to delete record with id 600811 ? (y/N) y
+--------+--------+-------+
| Status | ID     | Error |
+--------+--------+-------+
| true   | 600811 |       |
+--------+--------+-------+

# Display all geo regions.
$ php bin/rage4dns records:regions
+------------------------+--------------+
| Name                   | Value        |
+------------------------+--------------+
| World                  | 0            |
| Africa                 | 2            |
| Americas               | 4            |
| Asia                   | 8            |
| Europe                 | 16           |
| Oceania                | 32           |
| AustraliaAndNewZealand | 64           |
| Caribbean              | 132          |
| CentralAmerica         | 260          |
| CentralAsia            | 520          |
| EasternAfrica          | 1026         |
| EasternAsia            | 2056         |
| EasternEurope          | 4112         |
| Melanesia              | 8224         |
| Micronesia             | 16416        |
| MiddleAfrica           | 32770        |
| NorthernAfrica         | 65538        |
| NorthernAmerica        | 131076       |
| NorthernEurope         | 262160       |
| Polynesia              | 524320       |
| SouthAmerica           | 1048580      |
| SouthEasternAsia       | 2097160      |
| SouthernAfrica         | 4194306      |
| SouthernAsia           | 8388616      |
| SouthernEurope         | 16777232     |
| WesternAfrica          | 33554434     |
| WesternAsia            | 67108872     |
| WesternEurope          | 134217744    |
| USRegion10             | 268566532    |
| USRegion1              | 537001988    |
| USRegion2              | 1073872900   |
| USRegion3              | 2147614724   |
| USRegion4              | 4295098372   |
| USRegion5              | 8590065668   |
| USRegion6              | 17180000260  |
| USRegion7              | 34359869444  |
| USRegion8              | 68719607812  |
| USRegion9              | 137439084548 |
| CanadaEast             | 274878038020 |
| CanadaWest             | 549755944964 |
| Closest                | -1           |
+------------------------+--------------+

# Display all available record types.
$ php bin/rage4dns records:types
+--------+-------+
| Name   | Value |
+--------+-------+
| SOA    | 0     |
| NS     | 1     |
| A      | 2     |
| AAAA   | 3     |
| CNAME  | 4     |
| MX     | 5     |
| TXT    | 6     |
| SRV    | 7     |
| PTR    | 8     |
| SPF    | 9     |
| SSHFP  | 10    |
| LOC    | 11    |
| NAPTR  | 12    |
| RRSIG  | 13    |
| DNSKEY | 14    |
| DS     | 15    |
| NSEC   | 16    |
| DNAME  | 666   |
+--------+-------+

# Update a record.
$ php bin/rage4dns records:update 600815 dev.foobar.com 8.8.8.8 2
+--------+--------+-------+
| Status | ID     | Error |
+--------+--------+-------+
| true   | 600815 |       |
+--------+--------+-------+
```

#### Available commands for `usage`
```bash
# Retrieve usage of a domain.
$ php bin/rage4dns usage:domain 12345
+------------+-------+
| Date       | Value |
+------------+-------+
| 2014-04-01 | 65123 |
+------------+-------+

# Retrieve global usage.
$ php bin/rage4dns usage:global
+------------+-------+
| Date       | Value |
+------------+-------+
| 2014-04-28 | 88    |
| 2014-04-27 | 268   |
| 2014-04-26 | 2936  |
| 2014-04-25 | 486   |
| 2014-04-24 | 2418  |
+------------+-------+
```
Credits
-------
* [Ha Phan](https://github.com/haphan)
* [All contributors](https://github.com/haphan/php-rage4-dns-api/contributors)


Contributing
------------

Please see [CONTRIBUTING](https://github.com/haphan/php-rage4-dns-api/blob/master/CONTRIBUTING.md) for details.

Acknowledgments
---------------
This project is built on top of following libraries.

* [Symfony Console Component](https://packagist.org/packages/symfony/console)
* [Symfony Yaml Component](https://packagist.org/packages/symfony/yaml)
* [Guzzle HTTP Client](http://guzzle.readthedocs.org/en/latest/index.html)

Todos
----
- **Symfony2 coding standard compliant.** Make sure source code pass phpcs
- **Example code for PHP library** Add example code how to use with PHP
- **Project status badge.**  Add travis build status, SLInsight score, packagist download counter.
- **Tagged version release.** This will come last
- **Integration with popular frameworks.** Rage4DNSBundle for Symfony?