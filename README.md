# Point Type
Point Type to Doctrine2

[![Build Status](https://travis-ci.org/vinyvicente/doctrine-point-type.svg?branch=master)](https://travis-ci.org/vinyvicente/doctrine-point-type)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vinyvicente/doctrine-point-type/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vinyvicente/doctrine-point-type/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/vinyvicente/doctrine-point-type/v/stable)](https://packagist.org/packages/vinyvicente/doctrine-point-type)
[![Total Downloads](https://poser.pugx.org/vinyvicente/doctrine-point-type/downloads)](https://packagist.org/packages/vinyvicente/doctrine-point-type)
[![License](https://poser.pugx.org/vinyvicente/doctrine-point-type/license)](https://packagist.org/packages/vinyvicente/doctrine-point-type)
[![composer.lock available](https://poser.pugx.org/vinyvicente/doctrine-point-type/composerlock)](https://packagist.org/packages/vinyvicente/doctrine-point-type)

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
