VenkaDB
=======

ODM Library for different NoSQL databases.

Build status
------------
Master branch:

[![Build Status](https://secure.travis-ci.org/renepardon/VenkaDB.png?branch=master)](http://travis-ci.org/renepardon/VenkaDB)

Installation
------------

Ready to use within a ZF2 project. Just clone into **vendor/** directory and link within application config as module.

### Composer

Add the following parts to your **composer.json** file...

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/renepardon/VenkaDB.git"
        }
    ],
    "require": {
        "renepardon/VenkaDB": "dev-master"
    }
}
```

... and execute:

    $ php composer.phar update

### Git clone

    $ cd /path/to/project
    $ mkdir vendor/renepardon
    $ git clone --recursive https://github.com/renepardon/VenkaDB.git vendor/renepardon/VenkaDB

#### config/application.config.php

```php
<?php
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'VenkaDB',
    ),
);
```

Configuration
-------------

There is a configuration array placed within **module.config.php**. You can edit this configuration or place your own one into the Application's configuration folder.

Usage
-----

```php
<?php
// Retrieve service instance.
$service = $this->serviceManager->get('venkadb');
```