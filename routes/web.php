<?php

use App\Http\Controllers\DealerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('auth:sanctum')->get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Inventory/InwardEntry');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', function () {
        return redirect('/inventory/inward-entry');
    });

    Route::group(['prefix' => '/inventory'], function () {
        Route::get('/inward-entry', [InventoryController::class, 'showInwardEntry']);
        Route::get('/outward-entry', [InventoryController::class, 'showOutwardEntry']);
    });
    Route::group(['prefix' => '/master'], function () {
        Route::get('/add-user', [UserController::class, 'showAddUserPage']);
        Route::get('/add-dealer', [DealerController::class, 'showAddDealerPage']);
        Route::get('/manage-dealer', [DealerController::class, 'showManageDealerPage']);
        Route::get('/edit/dealer/{dealer}', [DealerController::class, 'editDealer']);

        Route::get('/add-supplier', [SupplierController::class, 'showAddSupplierPage']);
        Route::get('/manage-supplier', [SupplierController::class, 'showManageSupplierPage']);
        Route::get('/edit/supplier/{supplier}', [SupplierController::class, 'editSupplier']);

        Route::get('/add-product', [ProductController::class, 'showAddProductPage']);
        Route::get('/manage-product', [ProductController::class, 'showManageProductPage']);
        Route::get('/edit/product/{product}', [ProductController::class, 'editProduct']);

        Route::get('/create-user', [MasterController::class, 'showCreateUser']);
        Route::get('/manage-units', [MasterController::class, 'showManageUnits']);
    });

    Route::group(['prefix' => '/report'], function () {
        Route::get('/inward', [ReportController::class, 'showInwardEntryReport']);
        Route::get('/inward-entry-items', [ReportController::class, 'showInwardEntryItemsReport']);
        Route::get('/outward', [ReportController::class, 'showOutwardEntryReport']);
        Route::get('/outward-entry-items', [ReportController::class, 'showOutwardEntryItemsReport']);
        Route::get('/incoming-report', [ReportController::class, 'showOutwardEntry']);
        Route::get('/outgoing-report', [ReportController::class, 'showOutwardEntry']);
    });
});

require __DIR__.'/auth.php';
