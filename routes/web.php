<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\WorkitemsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CertificationsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\CheckRole;



Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/dashboard-page', function () {
//     return view('pages.dashboard');
// });

Route::get('/dashboard-page', [CustomAuthController::class, 'dashboardpage'])->name('login.dashboardpage'); 



// Route::get('/dashboard-page', function () {
//     return view('sidebar');
// });



// Route::get('/dashboard-page', [UserController::class, 'showLoginForm'])->name('login');

// Route::post('/dashboard-page', [UserController::class, 'login']);


Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');





Route::get('/workitems/list', [WorkitemsController::class, 'index'])->name('index');
Route::get('/workitems/create', [WorkitemsController::class, 'create'])->name('create');
Route::post('/workitems/store', [WorkitemsController::class, 'store'])->name('workitems.store');
Route::get('/workitems/edit/{workitems}', [WorkitemsController::class, 'edit'])->name('workitems.edit');
Route::put('/workitems/update/{workitems}', [WorkitemsController::class, 'update'])->name('workitems.update');
Route::get('/workitems/delete/{workitems}', [WorkitemsController::class, 'delete'])->name('workitems.delete');
Route::post('/workitems/filter', [WorkitemsController::class, 'filterWorkitems']);


Route::group(['middleware' => [CheckRole::class . ':superadmin']], function () {
Route::get('/roles/list', [RolesController::class, 'index'])->name('index');
Route::get('/roles/create', [RolesController::class, 'create'])->name('create');
Route::post('/roles/store', [RolesController::class, 'store'])->name('roles.store');
Route::get('/roles/edit/{roles}', [RolesController::class, 'edit'])->name('roles.edit');
Route::put('/roles/update/{roles}', [RolesController::class, 'update'])->name('roles.update');
Route::get('/roles/delete/{roles}', [RolesController::class, 'delete'])->name('roles.delete');
});


Route::get('/team/list', [TeamsController::class, 'list'])->name('list');
Route::get('/team/create', [TeamsController::class, 'create'])->name('create');
Route::post('/team/store', [TeamsController::class, 'store'])->name('team.store');
Route::get('/team/edit/{teams}', [TeamsController::class, 'edit'])->name('teams.edit');
Route::put('/team/update/{teams}', [TeamsController::class, 'update'])->name('team.update');
Route::get('/team/delete/{teams}', [TeamsController::class, 'delete'])->name('teams.delete');



Route::get('/user/view', [UserController::class, 'index'])->name('index');
Route::post('/user/update/{user}', [UserController::class, 'update'])->name('user.update');





