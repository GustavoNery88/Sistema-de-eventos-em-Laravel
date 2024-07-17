<?php

// Include the autoloader
require __DIR__.'/../vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    Illuminate\Http\Request::capture()
);

