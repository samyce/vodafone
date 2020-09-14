<?php
declare(strict_types=1);

require __DIR__ . '/autoload.php';

$container = new \app\Container();
$container->getService('Handler')->handle();