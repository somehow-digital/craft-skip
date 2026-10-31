<?php

/**
 * Prints whether Twig reloads templates with dev mode disabled.
 *
 * Craft reads dev mode from a constant, which can't change once it's defined, so this runs in a process of its own.
 */

use SomehowDigital\Craft\Skip\Tests\Support\App;

define('YII_DEBUG', false);

require dirname(__DIR__) . '/bootstrap.php';

$twig = App::create()->getView()->getTwig();

echo $twig->isAutoReload() ? 'enabled' : 'disabled';
