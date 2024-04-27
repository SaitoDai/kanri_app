<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;



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

Route::get('readme', [UserController::class, 'readme'])->name('users.readme');
Route::get('/', function () {
    return view('users.getLogin');
})->name('users.getLogin');
Route::post('/login', [UserController::class, 'login'])->name('users.login');
Route::middleware(['AdminMiddleware'])->group(function(){
	Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
Route::get('/users/reset', [UserController::class, 'reset'])->name('users.reset');
Route::post('/users/sendResetMail', [UserController::class, 'sendResetMail'])->name('users.sendResetMail');
Route::middleware(['ParameterMiddleware'])->group(function(){
	Route::get('/users/password={user}/edit', [UserController::class, 'pwEdit'])->name('users.pwEdit');
});
Route::patch('/users/password={user}/update', [UserController::class, 'pwUpdate'])->name('users.pwUpdate');
Route::get('/users/apply', [UserController::class, 'apply'])->name('users.apply');
Route::post('/user/sendMail', [UserController::class, 'sendMail'])->name('users.sendMail');
Route::middleware(['ParameterMiddleware'])->group(function(){
	Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
});
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::middleware(['LoginMiddleware'])->group(function(){
	Route::get('/user={user}', [UserController::class, 'show'])->name('users.show');
	Route::get('/user={user}/edit', [UserController::class, 'edit'])->name('users.edit');
	Route::patch('/user={user}/edit', [UserController::class, 'update'])->name('users.update');
	Route::patch('/user={user}/verify', [UserController::class, 'verify'])->name('users.verify');
	Route::get('/user={user}/logout', [UserController::class, 'logout'])->name('users.logout');
	Route::delete('/user={user}/hardDelete', [UserController::class, 'hardDelete'])->name('users.hardDelete');
	Route::delete('/user={user}/softDelete', [UserController::class, 'softDelete'])->name('users.softDelete');

	Route::get('/items', [ItemController::class, 'index'])->name('items.index');
	Route::get('/items/category={category}', [ItemController::class, 'categorizedIndex'])->name('items.categorizedIndex');
	Route::middleware(['AdminMiddleware'])->group(function(){
		Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
		Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');
	});
	Route::get('/items={item}', [ItemController::class, 'show'])->name('items.show');
	Route::get('items={item}/options', [ItemController::class, 'indexOption'])->name('items.indexOption');
	Route::middleware(['AdminMiddleware'])->group(function(){
		Route::get('/items={item}/edit', [ItemController::class, 'edit'])->name('items.edit');
		Route::patch('/items={item}/update', [ItemController::class, 'update'])->name('items.update');
		Route::delete('/items={item}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');

		Route::get('/itemDetails={item}/create', [ItemDetailController::class, 'create'])->name('itemDetails.create');
		Route::post('/itemDetails={item}/store', [ItemDetailController::class, 'store'])->name('itemDetails.store');
		Route::get('/itemDetails={item_detail}/edit', [ItemDetailController::class, 'edit'])->name('itemDetails.edit');
		Route::patch('/itemDetails={item_detail}/update', [ItemDetailController::class, 'update'])->name('itemDetails.update');
	});
	Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers.index');
	Route::get('/buyers/create', [BuyerController::class, 'create']) ->name('buyers.create');
	Route::post('/buyers/store', [BuyerController::class, 'store'])->name('buyers.store');
	Route::get('/buyer={buyer}', [BuyerController::class, 'show'])->name('buyers.show');
	Route::get('/buyer={buyer}/edit', [BuyerController::class, 'edit'])->name('buyers.edit');
	Route::patch('/buyer={buyer}/update', [BuyerController::class, 'update'])->name('buyers.update');
	Route::middleware(['AdminMiddleware'])->group(function(){
		Route::delete('/buyers={buyer}/delete', [BuyerController::class, 'destroy'])->name('buyers.destroy');
		Route::delete('/buyers={buyer}/softDelete', [BuyerController::class, 'softDelete'])->name('buyers.softDelete');
	});
	Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
	Route::post('/carts/store', [CartController::class, 'store'])->name('carts.store');
	Route::get('/carts/register', [CartController::class, 'show'])->name('carts.show');
	Route::get('/carts/edit', [CartController::class, 'edit'])->name('carts.edit');
	Route::patch('/carts={cart_detail}/update', [CartController::class, 'update'])->name('carts.update');
	Route::delete('/carts/destroy={cart}', [CartController::class, 'delete'])->name('carts.destroy');
	Route::post('/carts/payment', [CartController::class, 'payment'])->name('carts.payment');

	Route::get('/destinations/buyer={buyer}/create', [DestinationController::class, 'create'])->name('destinations.create');
	Route::post('/destinations/store', [DestinationController::class, 'store'])->name('destinations.store');
	Route::get('/destinations={destination}', [DestinationController::class, 'show'])->name('destinations.show');
	Route::get('/destinations={destination}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
	Route::patch('/destinations={destination}/update', [DestinationController::class, 'update'])->name('destinations.update');
	Route::middleware(['AdminMiddleware'])->group(function(){
		Route::delete('/destinations={destination}/delete', [DestinationController::class, 'destroy'])->name('destinations.destroy');
	});
	Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
	Route::get('/orders={order}', [OrderController::class, 'show'])->name('orders.show');

	Route::get('/category/index', [CategoryController::class, 'index'])->name('categories.index');
	Route::middleware(['AdminMiddleware'])->group(function(){
		Route::get('/category/create', [CategoryController::class, 'create'])->name('categories.create');
		Route::post('/category/store', [CategoryController::class, 'store'])->name('categories.store');
		Route::get('/category={category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
		Route::patch('/category={category}/update', [CategoryController::class, 'update'])->name('categories.update');
		Route::delete('/category={category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
	});
});