<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockProductController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminPemesananController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\UserProfileController;

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
    return redirect()->route('register');
})->middleware('guest');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/home', [AuthController::class, 'redirectToDashboard'])->name('home');


Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [AuthController::class, 'redirectToDashboard'])->name('dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboardAdmin');
    Route::group(['prefix' => 'admin'],function(){
        Route::resource('stockProduk', StockProductController::class,array('as' => 'admin'));
        Route::resource('user-profile',UserProfileController::class,array('as' => 'admin'));
        Route::resource('pemesanan',AdminPemesananController::class,array('as' => 'admin'));
    });
    
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('dashboardUser');
    Route::group(['prefix' => 'user'],function(){
        Route::resource('product-catalog',ProductCatalogController::class,array('as' => 'user'));
        Route::resource('keranjang',KeranjangController::class,array('as' => 'user'));
        Route::resource('pemesanan',PemesananController::class,array('as' => 'user'));
        Route::resource('ketentuan',KetentuanController::class,array('as' => 'user'));
        Route::resource('lokasi',LokasiController::class,array('as' => 'user'));
        Route::resource('kritik-saran',KritikSaranController::class,array('as' => 'user'));
        Route::resource('user-profile',UserProfileController::class,array('as' => 'user'));
    });
});
