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

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/','HomeController@index');
// Route::post ('/search','HomeController@search');

// Route::post('/search/load_content', 'HomeController@search')->name('search.content');
// Route::post('import', 'HomeController@import')->name('import');
// Route::post('getheader', 'HomeController@getHeaderRow')->name('getheader');

// Route::get('pagination/fetch_data', 'HomeController@fetch_data');
Route::get("/", 'Admin\HomeController@index');
Route::post("/search/load_content", 'Admin\HomeController@search')->name('search.content');

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
Route::get("Airline", 'AirlineController@index');
Route::get("/airline/edit/{company_name}/{country}", 'AirlineController@edit');
Route::post("/airline/store", 'AirlineController@store');
Route::get('/airline/delete/{company_name}/{country}', 'AirlineController@destroy');

//Contact Routes
Route::post('/contact/delete', 'ContactController@destroy');

// Admin routes
Route::post("/admin/login", "Auth\LoginController@login");
Route::get('/admin', 'Admin\AdminController@showAdminLoginForm');
Route::post('/admin', 'Auth\LoginController@login');

Route::get('/admin/register', 'Admin\AdminController@showAdminRegistrationForm');
Route::post('/admin/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () { 
    
    Route::get('/admin/logout', 'Admin\AdminController@logout');
    Route::get("/admin/home", 'Admin\HomeController@index');//
  
      //admin user role
    Route::resource('admin/roles', 'Admin\RoleController');
    Route::get('admin/roles/delete/{id}', 'Admin\RoleController@destroy');
  
    Route::resource('admin/users', 'Admin\UserController');
    Route::get('admin/users/delete/{id}', 'Admin\UserController@destroy');
    Route::post('admin/users/setactive', 'Admin\UserController@setactive');
  
});