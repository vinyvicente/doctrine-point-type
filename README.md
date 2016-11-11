# Point Type
Point Type to Doctrine2

## How to use

First, composer install:

```
composer require vinyvicente/doctrine-point-type
```

After, add in your bootstrap:


```
<?php

$em = YourEntityManager();

Type::addType('point', 'Viny\PointType');

$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'point');

```

### Enjoy!