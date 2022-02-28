# Point Type
Point Type to Doctrine2

[![Build Status](https://travis-ci.org/vinyvicente/doctrine-point-type.svg?branch=master)](https://travis-ci.org/vinyvicente/doctrine-point-type)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vinyvicente/doctrine-point-type/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vinyvicente/doctrine-point-type/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/vinyvicente/doctrine-point-type/v/stable)](https://packagist.org/packages/vinyvicente/doctrine-point-type)
[![Total Downloads](https://poser.pugx.org/vinyvicente/doctrine-point-type/downloads)](https://packagist.org/packages/vinyvicente/doctrine-point-type)
[![License](https://poser.pugx.org/vinyvicente/doctrine-point-type/license)](https://packagist.org/packages/vinyvicente/doctrine-point-type)
[![composer.lock available](https://poser.pugx.org/vinyvicente/doctrine-point-type/composerlock)](https://packagist.org/packages/vinyvicente/doctrine-point-type)

### Versions:

| Version | PHP Version   |
|---------|---------------|
| 1.*     | 7.0           |
| 2.*     | 7.1 or higher |
| 3.*     | 7.4 or higher |


## How to use

First, composer install:

```
composer require vinyvicente/doctrine-point-type
```

After, add in your bootstrap:


```php
use Doctrine\DBAL\Types\Type;
use Viny\PointType;

$em = YourEntityManager();

Type::addType('point', PointType::class);

// in case without Symfony :)
$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'point');

```

Or add it in your app/config yml files
```yaml
doctrine:
    dbal:
        types:
            point: Viny\PointType
        default_connection: default
        connections:
            default:
                driver: pdo_mysql
                host: '%database_host%'
                port: '%database_port%'
                dbname: '%database_name%'
                user: '%database_user%'
                password: '%database_password%'
                charset: UTF8
                mapping_types:
                    point: point
```

Symfony Normalization is supported, just add the tag in your app/services yml file
```yaml
services:
  Viny\PointNormalizer:
    tags: ['serializer.normalizer']
```

### Enjoy!
