
Library and command line to use the Gandi V5 API.

This library is not developed or maintained by Gandi.

Using CLI commands
==================

Requirements
-------------

Minimum version of PHP is 7.2.5.

Api key
-------

To use the Gandi API, you should retrieve an API key [from your account](https://account.gandi.net/),
in the security section.

You can store it into several place:

- in a file `.gandi-apikey` in the same directory of the `gandi` script
- in a file `.gandi-apikey` in your home directory
- in any file, if you set the environment variable `GANDI_APIKEY_FILE` with the
  full path to the file.

Usage
-----

Use the `gandi` script to execute command.

```
# show global help and list all commands
./gandi   

# a simple command to get the status of Gandi
./gandi status

```


Using the library in your code
===============================

You should first create a `Jelix\GandiApi\Configuration` object, with the API key:

```php
<?php
use Jelix\GandiApi\Configuration;

$configuration = new Configuration('my api key');

```

Then give this object to all classes that use the Gandi API v5.

Example:

```php
<?php

// List of organizations

use Jelix\GandiApi\ApiV5\Organizations;
$organizations = new Organizations($configuration);

$list = $organizations->getList();
foreach($list as $organization) {
    echo $organization->getName() . ", " . $organization->getType(). ", ".$organization->getId() . "\n" ;
}

// Create a zone Record
use Jelix\GandiApi\ApiV5\LiveDns\ZoneRecord;
$apiLiveDns = new \Jelix\GandiApi\ApiV5\LiveDns($configuration);

$record = new ZoneRecord(
    'myrecordname', // name
    'A', // type
    ['127.0.0.1'], // values
    10800 // ttl
);

$message = $apiLiveDns->createRecord('my.domain', $record);

```


Supported API
==============

- get Gandi Status (no api key is needed)
- list of organizations
- retrieve an organization by name
- LiveDNS: domains list
- LiveDNS: records list
- LiveDNS: create/update/delete a record into a zone


Feel free to help us to implement other API ;-) 
