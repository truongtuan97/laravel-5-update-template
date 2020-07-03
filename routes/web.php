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
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('/');

//Admin session
route::get('/admin', 'AdminController@getLogin')->name('admin');
route::post('/admin', 'AdminController@postLogin');

Route::group(['middleware' => ['admin']], function () {
  Route::get('admin/users/{cAccName}/napcard',  ['as' => 'management.user.napcard', 'uses' => 'ManagementController@userNapcardEdit']);
  Route::patch('admin/users/{user}/napcard',  ['as' => 'management.user.napcard', 'uses' => 'ManagementController@userNapcardUpdate']);

  Route::get('admin/users/{cAccName}/show',  ['as' => 'management.user.show', 'uses' => 'ManagementController@userDetail']);
  Route::get('admin/users/{cAccName}/edit',  ['as' => 'management.user.edit', 'uses' => 'ManagementController@userEdit']);
  Route::patch('admin/users/{user}/update',  ['as' => 'management.user.update', 'uses' => 'ManagementController@userUpdate']);
  Route::get('list_users', ['as' => 'users', 'uses' => 'ManagementController@listUser']);
  Route::post('list_users', ['as' => 'users', 'uses' => 'ManagementController@listUser']);

  Route::get('admin/chkms', ['as' => 'management.chkm.list', 'uses' => 'ManagementController@chkmList']);
  Route::get('admin/chkms/{chkm}/edit', ['as' => 'management.chkm.edit', 'uses' => 'ManagementController@chkmEdit']);
  Route::patch('admin/chkms/{chkm}/update', ['as' => 'management.chkm.update', 'uses' => 'ManagementController@chkmUpdate']);

  Route::get('admin/thongkenap', ['as' => 'management.thongkenap.list', 'uses' => 'ManagementController@thongKeNap']);
  Route::post('admin/thongkenap', ['as' => 'management.thongkenap.list', 'uses' => 'ManagementController@thongKeNap']);

  Route::get('admin/lognaptien', ['as' => 'management.lognaptien.list', 'uses' => 'ManagementController@logNapTien']);
  Route::post('admin/lognaptien', ['as' => 'management.lognaptien.list', 'uses' => 'ManagementController@logNapTien']);
  Route::get('admin/logquanlytaikhoan', ['as' => 'management.logquanlytaikhoan.list', 'uses' => 'ManagementController@logQuanLyTaiKhoan']);
  Route::post('admin/logquanlytaikhoan', ['as' => 'management.logquanlytaikhoan.list', 'uses' => 'ManagementController@logQuanLyTaiKhoan']);

  Route::get('admin/lichsuruttien', ['as' => 'management.lichsuruttien.list', 'uses' => 'ManagementController@lichsuruttien']);
  Route::post('admin/lichsuruttien', ['as' => 'management.lichsuruttien.list', 'uses' => 'ManagementController@lichsuruttien']);
});
//End admin session

Auth::routes();

Route::get('password_c1/{cAccName}/edit', ['as' => 'password_c1.users.edit', 'uses' => 'CustomerUserController@editPwdC1']);
Route::patch('password_c1/{cAccName}/update', ['as' => 'password_c1.users.update', 'uses' => 'CustomerUserController@updatePwdC1']);

Route::get('password_c2/{cAccName}/edit', ['as' => 'password_c2.users.edit', 'uses' => 'CustomerUserController@editPwdC2']);
Route::patch('password_c2/{cAccName}/update', ['as' => 'password_c2.users.update', 'uses' => 'CustomerUserController@updatePwdC2']);

Route::get('email/{cAccName}/edit', ['as' => 'email.users.edit', 'uses' => 'CustomerUserController@editEmail']);
Route::patch('email/{cAccName}/update', ['as' => 'email.users.update', 'uses' => 'CustomerUserController@updateEmail']);

Route::get('phone/{cAccName}/edit', ['as' => 'phone.users.edit', 'uses' => 'CustomerUserController@editPhone']);
Route::patch('phone/{cAccName}/update', ['as' => 'phone.users.update', 'uses' => 'CustomerUserController@updatePhone']);

Route::get('lichsunaptien', ['as' => 'lichsunaptien', 'uses' => 'CustomerUserController@lichsunaptien']);
Route::get('lichsuruttien', ['as' => 'lichsuruttien', 'uses' => 'CustomerUserController@lichsuruttien']);

Route::get('/home', 'HomeController@index')->name('/home');
Route::get('users/{user}/show',  ['as' => 'users.show', 'uses' => 'CustomerUserController@show']);
Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'CustomerUserController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'CustomerUserController@update']);

Route::get('napcard/{cAccName}/edit', ['as' => 'user.napcard.edit', 'uses' => 'CustomerUserController@napcard']);
Route::post('napcard/{cAccName}/update', ['as' => 'user.napcard.update', 'uses' => 'CustomerUserController@updateNapCard']);
Route::post("napcard/success", ['as' => 'napcard_success', 'uses' => 'CustomerUserController@napcard_success']);

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('promotion/{promotion}', ['as' => 'promotion.edit', 'uses' => 'PromotionConfigurationController@edit']);
Route::patch('promotion/{promotion}/update', ['as' => 'promotion.update', 'uses' => 'PromotionConfigurationController@update']);