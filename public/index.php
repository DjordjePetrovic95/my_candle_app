<?php

use App\Core\Router;

date_default_timezone_set('Europe/Belgrade');

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$Router = new Router();
$Router->GetRoute();
