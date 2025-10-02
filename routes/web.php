<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth', 'is-admin')->group(function () {

    Route::prefix('/admin')->name('admin.')->group(function() {
        
        Route::get('/', '\App\Http\Controllers\Controller@index')->name('index');
        
        Route::prefix('/profile')->name('profile.')->group(function() {
            Route::get('/edit/{id}', '\App\Http\Controllers\ProfileController@edit')->name('edit');
            Route::post('/update', '\App\Http\Controllers\ProfileController@update')->name('update');
            Route::delete('/delete', '\App\Http\Controllers\ProfileController@destroy')->name('destroy');
        });

        Route::prefix('/employer')->name('employer.')->group(function() {
            Route::get('/', '\App\Http\Controllers\EmployerController@index')->name('index');
            Route::get('/new', '\App\Http\Controllers\EmployerController@create')->name('create');
            Route::post('/store', '\App\Http\Controllers\EmployerController@store')->name('store');
            Route::get('/edit/{id}', '\App\Http\Controllers\EmployerController@edit')->name('edit');
            Route::post('/update', '\App\Http\Controllers\EmployerController@update')->name('update');
            Route::get('/delete/{id}', '\App\Http\Controllers\EmployerController@destroy')->name('destroy');
        });
        
    });
});

Route::middleware('auth', 'is-employer')->group(function () {

    Route::prefix('/employer')->name('employer.')->group(function() {
        
        Route::get('/', '\App\Http\Controllers\Controller@emp_index')->name('index');
        
        Route::prefix('/profile')->name('profile.')->group(function() {
            Route::get('/edit/{id}', '\App\Http\Controllers\ProfileController@edit')->name('edit');
            Route::post('/update', '\App\Http\Controllers\ProfileController@update')->name('update');
            Route::delete('/delete', '\App\Http\Controllers\ProfileController@destroy')->name('destroy');
        });

        Route::prefix('/group')->name('group.')->group(function() {
            Route::get('/', '\App\Http\Controllers\GroupController@index')->name('index');
            Route::get('/new', '\App\Http\Controllers\GroupController@create')->name('create');
            Route::get('/listing', '\App\Http\Controllers\GroupController@listing')->name('listing');
            Route::post('/store', '\App\Http\Controllers\GroupController@store')->name('store');
            Route::get('/edit/{id}', '\App\Http\Controllers\GroupController@edit')->name('edit');
            Route::post('/update', '\App\Http\Controllers\GroupController@update')->name('update');
            Route::get('/delete/{id}', '\App\Http\Controllers\GroupController@destroy')->name('destroy');
        });
        
        Route::prefix('/employee')->name('employee.')->group(function() {
            Route::get('/', '\App\Http\Controllers\EmployeeController@index')->name('index');
            Route::get('/new', '\App\Http\Controllers\EmployeeController@create')->name('create');
            Route::get('/listing', '\App\Http\Controllers\EmployeeController@listing')->name('listing');
            Route::post('/store', '\App\Http\Controllers\EmployeeController@store')->name('store');
            Route::get('/edit/{id}', '\App\Http\Controllers\EmployeeController@edit')->name('edit');
            Route::post('/update', '\App\Http\Controllers\EmployeeController@update')->name('update');
            Route::get('/delete/{id}', '\App\Http\Controllers\EmployeeController@destroy')->name('destroy');
            Route::post('/generate-key', '\App\Http\Controllers\EmployeeController@generate_key')->name('generate-key');
        });
        
        Route::prefix('/log')->name('log.')->group(function() {
            Route::get('/', '\App\Http\Controllers\LogController@index')->name('index');
            Route::get('/new', '\App\Http\Controllers\LogController@create')->name('create');
            Route::get('/listing', '\App\Http\Controllers\LogController@listing')->name('listing');
            Route::post('/store', '\App\Http\Controllers\LogController@store')->name('store');
            Route::get('/edit/{id}', '\App\Http\Controllers\LogController@edit')->name('edit');
            Route::post('/update', '\App\Http\Controllers\LogController@update')->name('update');
            Route::get('/delete/{id}', '\App\Http\Controllers\LogController@destroy')->name('destroy');
            Route::post('/generate-key', '\App\Http\Controllers\LogController@generate_key')->name('generate-key');
        });
        
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';