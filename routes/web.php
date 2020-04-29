<?php

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







// Admin routes
Route::post("/admin/login", "Auth\LoginController@login");
Route::get('/', 'Admin\AdminController@showAdminLoginForm');
Route::post('/admin', 'Auth\LoginController@login');

Route::get('/admin/register', 'Admin\AdminController@showAdminRegistrationForm');
Route::post('/admin/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () { 
    
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get("/admin/home", 'Admin\HomeController@index');//
  
    //admin user role
    Route::resource('admin/roles', 'Admin\RoleController');
    Route::get('admin/roles/delete/{id}', 'Admin\RoleController@destroy');
  
    Route::resource('admin/users', 'Admin\UserController');
    Route::get('admin/users/delete/{id}', 'Admin\UserController@destroy');
    Route::post('admin/users/setactive', 'Admin\UserController@setactive');
    // home routes
    Route::get("/home", 'Admin\HomeController@index');
    Route::post("/search/load_content", 'Admin\HomeController@search')->name('search.content');
    Route::post("/getAppfamily", 'Admin\HomeController@getAppfamily');
    Route::post("/getApplication", 'Admin\HomeController@getApplication');

    //Mro Company Routes
    Route::get("/MRO", 'MROController@index');
    Route::get("/mro/create", 'MROController@create');
    Route::post("/mro/getApplication", 'MROController@getApplication');
    
    Route::post("/mro/store", 'MROController@store');
    Route::get('/mro/delete/{id}', 'MROController@destroy');
    Route::get('/mro/{id}/edit', 'MROController@edit');
    Route::post("/mro/update/{id}", 'MROController@update');

    // Upload fleets
    Route::get("/upload", 'UploadController@index');
    Route::post("/upload/import", 'UploadController@import')->name('import');;

    // Airline Routes
    Route::get("Airline", 'AirLineController@index');
    Route::get("/airline/edit/{company_name}/{country}", 'AirLineController@edit');
    Route::post("/airline/store", 'AirLineController@store');
    Route::get('/airline/delete/{company_name}/{country}', 'AirLineController@destroy');

    //Contact Routes
    Route::resource('contacts', 'ContactController');
    Route::get('/contacts/{id}/{company_name}/{type}/{p_id}/{af_id}/{ap_id}/{c_type}/edit', 'ContactController@edit');
    Route::get('/contacts/{p_id}/{af_id}/{ap_id}/{c_type}/back', 'ContactController@back');
    Route::post('/contact/delete', 'ContactController@destroy');
    Route::post('/contacts/update/{id}/{company_name}/{type}', 'ContactController@store');

    //admin visit report
    Route::resource('/admin/visit', 'Admin\VisitReportController');

    // product and application routes
    Route::resource('admin/products', 'Admin\ProductController');
    Route::get('admin/products/delete/{id}', 'Admin\ProductController@destroy');

    Route::resource('admin/applications', 'Admin\ApplicationController');
    Route::get('admin/applications/delete/{id}', 'Admin\ApplicationController@destroy');

    // application family routes
    Route::resource('admin/appfamily', 'Admin\ApplicationFamilyController');
    Route::get('admin/appfamily/delete/{id}', 'Admin\ApplicationFamilyController@destroy');
  
});