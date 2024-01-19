<?php

use App\Http\Controllers\AnnualLeaveController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('annual-leaves')->group(function () {
    Route::get('/', [AnnualLeaveController::class, 'index'])->name('annual-leaves.index');
    Route::post('/', [AnnualLeaveController::class, 'store'])->name('annual-leaves.store');
    Route::get('/{id}', [AnnualLeaveController::class, 'show'])->name('annual-leaves.show');
});
