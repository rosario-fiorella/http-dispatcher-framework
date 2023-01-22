<?php

declare(strict_types=1);

chdir(__DIR__);

require_once dirname(__DIR__) . '/Core/Bootstrap.php';

$app = \Core\bootstrap();
$app->run();
