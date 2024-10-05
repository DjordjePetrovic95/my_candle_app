<?php

use App\Core\Router;

date_default_timezone_set('Europe/Belgrade');

session_start();

define('PROTOCOL', (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1) ? "https" : "http"));

require_once __DIR__ . '/vendor/autoload.php';

$Router = new Router();
$Router->GetRoute();
