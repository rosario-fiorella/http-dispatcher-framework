<?php

declare(strict_types=1);

namespace App;

use App\Config\Debug;
use App\Config\Loader;
use App\Config\Locale;

chdir(__DIR__);

include_once './Config/Loader.php';

$loader = new Loader();
$debug = new Debug();
$locale = new Locale();

$app = new Http();
