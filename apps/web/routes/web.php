<?php

declare(strict_types=1);

use Heritage\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Surface Routes
|--------------------------------------------------------------------------
| Public website routes and landing pages.
*/

Route::get('/', function () {
    return view('welcome');
});
