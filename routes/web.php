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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@profile');

Route::get('/category', 'CategoryController@index');

Route::get('/getAllCategories', 'CategoryController@getAllCategories');

Route::get('/record', 'RecordController@index');

Route::get('/record/cat', 'RecordController@getRecordByCat');

Route::post('/addRecord', 'RecordController@addRecord');

Route::get('/view/{record_id}', 'RecordController@view');

Route::get('/edit/{record_id}', 'RecordController@edit');

Route::post('/editRecord/{record_id}', 'RecordController@editRecord');

Route::get('/delete/{record_id}', 'RecordController@deleteRecord');
Route::get('/delete_permanent/{record_id}', 'RecordController@deleteRecordPermanent');
Route::get('/restore/{record_id}', 'RecordController@restoreRecord');

//Route::get('/settings', 'SettingsController@settings')->name('settings');
//Route::post('/editSettings/{user}', 'SettingsController@update');

Route::get('/download/{file}', 'RecordController@download');

Route::post('/addProfile', 'ProfileController@addProfile');

Route::prefix('settings')->name('settings.')->middleware('auth')->group(function(){
    Route::resource('users', 'SettingsController');
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('users', 'UserController');
    Route::resource('company', 'CompanyController');
    Route::resource('recycle', 'RecycleController');
});
