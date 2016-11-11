# Point Type
Point Type Doctrine

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