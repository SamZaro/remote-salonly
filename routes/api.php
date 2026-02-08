<?php

use App\Http\Controllers\ProvisionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/provision-user', [ProvisionController::class, 'createUser']);
Route::post('/provision-template', [ProvisionController::class, 'setTemplate']);
Route::post('/sync-modules', [ProvisionController::class, 'syncModules']);
