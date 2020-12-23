<?php

use App\Events\Hello;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any?}', function () {
    return abort(403, 'Unauthorized action.');
})->where('any', '^(?!api\/)[\/\w\.-]*');