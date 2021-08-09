<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BosController;
use App\Http\Controllers\Api\RankController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OfficeController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\ComplianceController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PersonnelTypeController;
use App\Http\Controllers\Api\BosAllPersonnelController;
use App\Http\Controllers\Api\RankAllPersonnelController;
use App\Http\Controllers\Api\ComplianceActionController;
use App\Http\Controllers\Api\OfficeCompliancesController;
use App\Http\Controllers\Api\StatusCompliancesController;
use App\Http\Controllers\Api\PersonnelTypeRanksController;
use App\Http\Controllers\Api\OfficeAllPersonnelController;
use App\Http\Controllers\Api\ComplianceComplianceActionsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('all-bos', BosController::class);

        // Bos All Personnel
        Route::get('/all-bos/{bos}/all-personnel', [
            BosAllPersonnelController::class,
            'index',
        ])->name('all-bos.all-personnel.index');
        Route::post('/all-bos/{bos}/all-personnel', [
            BosAllPersonnelController::class,
            'store',
        ])->name('all-bos.all-personnel.store');

        Route::apiResource('personnel-types', PersonnelTypeController::class);

        // PersonnelType Ranks
        Route::get('/personnel-types/{personnelType}/ranks', [
            PersonnelTypeRanksController::class,
            'index',
        ])->name('personnel-types.ranks.index');
        Route::post('/personnel-types/{personnelType}/ranks', [
            PersonnelTypeRanksController::class,
            'store',
        ])->name('personnel-types.ranks.store');

        Route::apiResource('offices', OfficeController::class);

        // Office Compliances
        Route::get('/offices/{office}/compliances', [
            OfficeCompliancesController::class,
            'index',
        ])->name('offices.compliances.index');
        Route::post('/offices/{office}/compliances', [
            OfficeCompliancesController::class,
            'store',
        ])->name('offices.compliances.store');

        // Office All Personnel
        Route::get('/offices/{office}/all-personnel', [
            OfficeAllPersonnelController::class,
            'index',
        ])->name('offices.all-personnel.index');
        Route::post('/offices/{office}/all-personnel', [
            OfficeAllPersonnelController::class,
            'store',
        ])->name('offices.all-personnel.store');

        Route::apiResource('statuses', StatusController::class);

        // Status Compliances
        Route::get('/statuses/{status}/compliances', [
            StatusCompliancesController::class,
            'index',
        ])->name('statuses.compliances.index');
        Route::post('/statuses/{status}/compliances', [
            StatusCompliancesController::class,
            'store',
        ])->name('statuses.compliances.store');

        Route::apiResource('ranks', RankController::class);

        // Rank All Personnel
        Route::get('/ranks/{rank}/all-personnel', [
            RankAllPersonnelController::class,
            'index',
        ])->name('ranks.all-personnel.index');
        Route::post('/ranks/{rank}/all-personnel', [
            RankAllPersonnelController::class,
            'store',
        ])->name('ranks.all-personnel.store');

        Route::apiResource('all-personnel', PersonnelController::class);

        Route::apiResource('compliances', ComplianceController::class);

        // Compliance Compliance Actions
        Route::get('/compliances/{compliance}/compliance-actions', [
            ComplianceComplianceActionsController::class,
            'index',
        ])->name('compliances.compliance-actions.index');
        Route::post('/compliances/{compliance}/compliance-actions', [
            ComplianceComplianceActionsController::class,
            'store',
        ])->name('compliances.compliance-actions.store');

        Route::apiResource(
            'compliance-actions',
            ComplianceActionController::class
        );

        Route::apiResource('users', UserController::class);
    });
