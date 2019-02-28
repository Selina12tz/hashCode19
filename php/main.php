<?php
declare(strict_types=1);

use App\Main;

require __DIR__ . '/vendor/autoload.php';

$main = new Main();
$main('resources/example.in');
