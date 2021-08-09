<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PersonnelTypeController;
use App\Http\Controllers\ComplianceActionController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('all-bos', [BosController::class, 'index'])->name(
            'all-bos.index'
        );
        Route::post('all-bos', [BosController::class, 'store'])->name(
            'all-bos.store'
        );
        Route::get('all-bos/create', [BosController::class, 'create'])->name(
            'all-bos.create'
        );
        Route::get('all-bos/{bos}', [BosController::class, 'show'])->name(
            'all-bos.show'
        );
        Route::get('all-bos/{bos}/edit', [BosController::class, 'edit'])->name(
            'all-bos.edit'
        );
        Route::put('all-bos/{bos}', [BosController::class, 'update'])->name(
            'all-bos.update'
        );
        Route::delete('all-bos/{bos}', [BosController::class, 'destroy'])->name(
            'all-bos.destroy'
        );

        Route::resource('personnel-types', PersonnelTypeController::class);
        Route::resource('offices', OfficeController::class);
        Route::resource('statuses', StatusController::class);
        Route::resource('ranks', RankController::class);
        Route::get('all-personnel', [
            PersonnelController::class,
            'index',
        ])->name('all-personnel.index');
        Route::post('all-personnel', [
            PersonnelController::class,
            'store',
        ])->name('all-personnel.store');
        Route::get('all-personnel/create', [
            PersonnelController::class,
            'create',
        ])->name('all-personnel.create');
        Route::get('all-personnel/{personnel}', [
            PersonnelController::class,
            'show',
        ])->name('all-personnel.show');
        Route::get('all-personnel/{personnel}/edit', [
            PersonnelController::class,
            'edit',
        ])->name('all-personnel.edit');
        Route::put('all-personnel/{personnel}', [
            PersonnelController::class,
            'update',
        ])->name('all-personnel.update');
        Route::delete('all-personnel/{personnel}', [
            PersonnelController::class,
            'destroy',
        ])->name('all-personnel.destroy');

        Route::resource('compliances', ComplianceController::class);
        Route::resource(
            'compliance-actions',
            ComplianceActionController::class
        );
        Route::resource('users', UserController::class);
    });
