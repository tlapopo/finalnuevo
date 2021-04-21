<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
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
    return view('auth.login');
});


/*Route::get('/vendedor', function () {
    return view('vendedor.index');
});


Route::get('/vendedor/create', [VendedorController::class,'create']);*/



//Route::resource('vendedor', VendedorController::class)->middleware('auth');
Route::resource('productos', ProductoController::class)->middleware('auth');
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>'auth'], function(){
    //Route::get('/', [VendedorController::class, 'index'])->name('home');
    Route::get('/', [ProductoController::class, 'index'])->name('home');

});


//Route::resource('productos', ProductoController::class)->middleware('auth');
Route::resource('vendedor', VendedorController::class)->middleware('auth');
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::resource('pedidos', PedidoController::class)->middleware('auth');