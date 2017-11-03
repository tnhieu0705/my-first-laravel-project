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

Route::get('/', function() {
    return view('master');
});

Route::group(['prefix' => 'quantri'], function() {
    Route::get('tongquan', ['uses' => 'TongquanController@getData']);
});

Route::get('dangnhap', ['uses' => 'DangnhapController@index']);
Route::post('dangnhap', ['as' => 'dangnhap', 'uses' => 'DangnhapController@login']);
Route::post('dangxuat', ['as' => 'dangxuat', 'uses' => 'DangnhapController@logout']);

/* ----- chude - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::get('chude/{id}/loaisanpham', ['as' => 'chude.loaisanpham', 'uses' => 'ChudeController@getList']);
    Route::resource(
        'chude',
        'ChudeController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- chude - End -----*/

/* ----- loaisanpham - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::resource(
        'loaisanpham',
        'LoaisanphamController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- loaisanpham - End -----*/

/* ----- sanpham - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::get('sanpham/{id}/loaisanpham', ['uses' => 'SanphamController@getSelectData']);
    Route::resource(
        'sanpham',
        'SanphamController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- sanpham - End -----*/

/* ----- nhanvien - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::resource(
        'nhanvien',
        'NhanvienController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- nhanvien - End -----*/

Route::get('test', function() {
	$ds_loaisanpham = App\Loaisanpham::where('l_ma', 1)->first();
    echo count($ds_loaisanpham->coSanPham);
});