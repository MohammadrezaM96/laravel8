<?php

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use MongoDB\BSON\ObjectId;

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

//Auth Router Admin

Route::get('administrator/login', 'Admin\AuthController@showLoginForm')->name('admin.login');
Route::get('administrator/login', 'Admin\AuthController@showLoginForm')->name('login');
Route::post('administrator/login', 'Admin\AuthController@login')->name('admin.login.submit');
Route::post('administrator/logout', 'Admin\AuthController@logout')->name('admin.logout');

Route::prefix('administrator')->group(function () {


    //Router For Add Admin
    Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');
    Route::get('/admin/index', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/admin/create', 'Admin\AdminController@createAdmin')->name('admin.create');
    Route::post('/admin/store', 'Admin\AdminController@storeAdmin')->name('admin.store');
    Route::get('/admin/edit/{admin}', 'Admin\AdminController@editAdmin')->name('admin.edit');
    Route::post('/admin/update/{admin}', 'Admin\AdminController@updateAdmin')->name('admin.update');
    Route::get('/admin/person/edit/{admin}', 'Admin\AdminController@editPerson')->name('admin.person.edit');
    Route::post('/admin/person/update/{admin}', 'Admin\AdminController@updatePerson')->name('admin.person.update');


    //Route For User
    Route::prefix('user')->group(function () {
        Route::get('/{user}/orders' , 'Admin\UserController@userOrders')->name('admin.user.orders');
        Route::resource('user', 'Admin\UserController');
    });


    //Route For Payments
    Route::get('/payments' , 'Admin\PaymentController@index')->name('admin.payments.index');

    //Routes For Contact Us
    Route::get('/contact-us', 'Admin\ContactUsController@index')->name('contact-us.index');
    Route::get('/contact-us/show/{contactUs}', 'Admin\ContactUsController@show')->name('contact-us.show');
    Route::get('/contact-us/flag/change/{contactUs}', 'Admin\ContactUsController@changeFlag')->name('contact-us.change.flag');
    Route::post('/contact-us/post/delete', 'Admin\ContactUsController@destroy')->name('contact-us.ajax.delete');


    Route::get('/settings/{setting_name}', 'Admin\SettingController@index')->name('setting.index');
    Route::post('/settings/update', 'Admin\SettingController@update')->name('settings.update');
});


Route::get('/', function () {
    return 'Hello World';
});
