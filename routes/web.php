<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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

Route::get('/news', [NewsController::class, 'index'])
	->name('news');

Route::get('/news/{id}', [NewsController::class, 'show'])
	->where('id', '\d+')
	->name('news.show');

//admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
	Route::get('/', AdminController::class)
		->name('index');
	Route::resource('/categories', AdminCategoryController::class);
	Route::resource('/news', AdminNewsController::class);
});

Route::get('/collection', function() {
	$collection = collect(['Nick', 'Ben', 'Ann', 'Jil', 'Fred', 'Pit', 'July']);
	dd($collection->map(function($item) {
		return strtoupper($item);
	})->filter(function($item) {
		if(strlen($item) > 3) {
			 return $item;
		}
	})->sort()->toJson());
});