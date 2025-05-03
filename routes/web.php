<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TicketController;
use App\Models\Store;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ticket create and store
Route::prefix('ticket/')->middleware('auth')->name('ticket.')->group(function () {
    Route::get('/create-ticket', [TicketController::class, 'create_ticket'])->name('create_ticket');
    Route::get('/ticket-history', [TicketController::class, 'ticket_history'])->name('ticket_history');
    Route::get('/create-customer-ticket', [TicketController::class, 'create_customer_ticket'])->name('create_customer_ticket');
    Route::get('/user-info', [TicketController::class, 'user_info'])->name('user_info');
    Route::get('/ticket-list', [TicketController::class, 'ticket_list'])->name('ticket_list');
    Route::get('/status-update', [TicketController::class, 'status_update'])->name('status_update');
    Route::get('/ticket-details', [TicketController::class, 'ticket_details'])->name('ticket_details');
    Route::delete('/destroy', [TicketController::class, 'destroy'])->name('destroy');
    Route::post('/ticket-store', [TicketController::class, 'ticket_store'])->name('ticket_store');
    Route::post('/customer-ticket-store', [TicketController::class, 'customer_ticket_store'])->name('customer_ticket_store');
});


//ticket department create and store
Route::prefix('ticket/')->middleware('auth')->name('department.')->group(function () {
    Route::get('/department-list', [DepartmentController::class, 'department_list'])->name('department_list');
    Route::get('/destroy', [DepartmentController::class, 'destroy'])->name('destroy');
    Route::post('/department-store', [DepartmentController::class, 'department_store'])->name('department_store');
});




