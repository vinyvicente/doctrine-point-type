<?php
/*
 * This file bootstraps the test environment.
 */

error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('UTC');

$classLoader = require __DIR__ . '/../vendor/autoload.php';

/* @var $classLoader \Composer\Autoload\ClassLoader */
$classLoader->add('Doctrine\\Tests\\', __DIR__ . '/../vendor/doctrine/dbal/tests/');
unset($classLoader);
