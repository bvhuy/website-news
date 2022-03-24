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

Route::get('/', 'HomeController@index');

// 404
Route::get('/404', 'HomeController@errors_404');

// Admin
Route::get('/admin-login', 'AdminController@index');
Route::post('/admin-login', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');
Route::get('/dashboard', 'AdminController@dashboard')->middleware('twofactor');

// Search
Route::get('/search', 'SearchController@search')->name('web.search');

Route::group([ 'middleware' => 'roles.user'], function () {
    //Category
    Route::get('/add-category-users', 'CategoryNew@add_category_users');
    Route::get('/list-category-users', 'CategoryNew@list_category_users');
    Route::get('/edit-category-users/{id}', 'CategoryNew@edit_category_users');
    Route::post('/update-category-users/{id}', 'CategoryNew@update_category_users');
    Route::post('/save-category-users', 'CategoryNew@save_category_users');
    Route::get('/delete-category-users/{id}', 'CategoryNew@delete_category_users');

    // Type New
    Route::get('/list-type-users', 'TypeController@list_type_users');
    Route::get('/add-type-users', 'TypeController@add_type_users');
    Route::post('/save-type-users', 'TypeController@save_type_users');
    Route::get('/edit-type-users/{id}', 'TypeController@edit_type_users');
    Route::post('/update-type-users/{id}', 'TypeController@update_type_users');
    Route::get('/delete-type-users/{id}', 'TypeController@delete_type_users');

    // New
    Route::get('/list-new-users', 'NewController@list_new_users');
    Route::get('/add-new-users', 'NewController@add_new_users');
    Route::post('/save-new-users', 'NewController@save_new_users');
    Route::get('/edit-new-users/{id}', 'NewController@edit_new_users');
    Route::post('/update-new-users/{id}', 'NewController@update_new_users');
    Route::get('/delete-new-users/{id}', 'NewController@delete_new_users');

    Route::get('/active-new-users/{id}', 'NewController@active_new_users');
    Route::get('/unactive-new-users/{id}', 'NewController@unactive_new_users');
    
});

Route::group([ 'middleware' => 'roles'], function () {
    // Category New
    Route::get('/list-category', 'CategoryNew@list_category');
    Route::get('/add-category', 'CategoryNew@add_category');
    Route::post('/save-category', 'CategoryNew@save_category');
    Route::get('/edit-category/{id}', 'CategoryNew@edit_category');
    Route::post('/update-category/{id}', 'CategoryNew@update_category');
    Route::get('/delete-category/{id}', 'CategoryNew@delete_category');
    Route::get('/active-category/{id}', 'CategoryNew@active_category');
    Route::get('/unactive-category/{id}', 'CategoryNew@unactive_category');

    // Type New
    Route::get('/list-type', 'TypeController@list_type');
    Route::get('/add-type', 'TypeController@add_type');
    Route::post('/save-type', 'TypeController@save_type');
    Route::get('/edit-type/{id}', 'TypeController@edit_type');
    Route::post('/update-type/{id}', 'TypeController@update_type');
    Route::get('/delete-type/{id}', 'TypeController@delete_type');
    Route::get('/active-type/{id}', 'TypeController@active_type');
    Route::get('/unactive-type/{id}', 'TypeController@unactive_type');

    // New
    Route::get('/list-new', 'NewController@list_new');
    Route::get('/add-new', 'NewController@add_new');
    Route::post('/save-new', 'NewController@save_new');
    Route::get('/edit-new/{id}', 'NewController@edit_new');
    Route::post('/update-new/{id}', 'NewController@update_new');
    Route::get('/delete-new/{id}', 'NewController@delete_new');
    Route::get('/active-new/{id}', 'NewController@active_new');
    Route::get('/unactive-new/{id}', 'NewController@unactive_new');


    // Users
    Route::get('/add-users','UserController@add_users');
    Route::get('/list-users','UserController@list_users');
    //save users
    Route::post('/store-users','UserController@store_users');
    //phân quyền users
    Route::post('/assign-roles','UserController@assign_roles');
    // xóa user
    Route::get('/delete-user-roles/{admin_id}','UserController@delete_user_roles');

    //list accept article
    Route::get('/list-new-accept','NewController@list_new_accept');
    Route::get('/refuse-new/{id}','NewController@refuse_new');
    Route::get('/accept-new/{id}','NewController@accept_new');
    Route::get('/unactive-status-accept-new/{id}','NewController@unactive_status_accept_new');
    Route::get('/active-status-accept-new/{id}','NewController@active_status_accept_new');
    //Menu
    Route::get('/list-position-menu','CategoryNew@list_position_menu');
    Route::post('/update-list-position','CategoryNew@update_list_position');
    
    //Menu sub
    Route::get('/edit-menu-sub/{id}','TypeController@edit_menu_sub');
    Route::post('/update-menu-sub','TypeController@update_menu_sub');
    
    //Video
    Route::get('/add-video','VideoController@add_video');
    Route::post('/save-video','VideoController@save_video');
    Route::get('/list-video','VideoController@list_video');
    Route::get('/edit-video/{id}','VideoController@edit_video');
    Route::post('/update-video/{id}','VideoController@update_video');
    Route::get('/delete-video/{id}','VideoController@delete_video');
    Route::get('/active-video/{id}', 'VideoController@active_video');
    Route::get('/unactive-video/{id}', 'VideoController@unactive_video');

    //user
    Route::get('/resend-verify-email/{id}','UserController@resend_verify_email');
});

// chuyển quyền
Route::get('/impersonate/{admin_id}','UserController@impersonate');
Route::get('/impersonate-destroy','UserController@impersonate_destroy');

Route::post('/uploads-ckeditor','NewController@ckeditor_image');
Route::get('/file-browser','NewController@file_browser');

Route::group(['middleware' => 'filter'], function() {
    Route::get('/{code}.html', 'HomeController@detail_article');
});

Route::get('verify/resend', 'TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'TwoFactorController')->only(['index', 'store']);


Route::get('/verify-email/{verification_code}','UserController@verify_email')->name('verify_email');

Route::get('/{code}', 'HomeController@detail_category');

Route::get('/{code_category}/{code_type}', 'HomeController@detail_type');
