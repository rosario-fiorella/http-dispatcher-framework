<?php

include_once __DIR__ . '/example/base.application.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

use \Core\Boot\Registry;
use \Core\Task;

$registry = new Registry;
$registry->set('application', Application::class);

$app = new Task;
$app->startup();
