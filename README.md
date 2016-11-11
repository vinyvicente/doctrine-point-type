# Point Type
Point Type to Doctrine2

[![Build Status](https://travis-ci.org/vinyvicente/doctrine-point-type.svg?branch=master)](https://travis-ci.org/vinyvicente/doctrine-point-type)

## How to use

First, composer install:

```
composer require vinyvicente/doctrine-point-type
```

After, add in your bootstrap:


```php

use Doctrine\DBAL\Types\Type;

$em = YourEntityManager();

Type::addType('point', 'Viny\PointType');

// in case silex :)
$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'point');

```

### Enjoy!