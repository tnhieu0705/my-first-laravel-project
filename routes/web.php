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

Route::group(['prefix' => 'quantri'], function() {
    Route::get('tongquan', ['as' => 'tongquan', 'uses' => 'TongquanController@getData']);
});

/* ----- dangky - Begin -----*/
Route::get('dangky', ['uses' => 'KhachhangController@getRegister']);
Route::post('dangky', ['as' => 'dangky', 'uses' => 'KhachhangController@register']);
/* ----- dangky - End -----*/


/* ----- khachhang - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::resource(
        'khachhang',
        'KhachhangController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- khachhang - End -----*/

/* ----- donhang - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::resource(
        'donhang',
        'DonhangController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- donhang - End -----*/

/* ----- dangnhap - Begin -----*/
Route::get('dangnhap', ['uses' => 'DangnhapController@index']);
Route::post('dangnhap', ['as' => 'dangnhap', 'uses' => 'DangnhapController@login']);
Route::post('dangxuat', ['as' => 'dangxuat', 'uses' => 'DangnhapController@logout']);
/* ----- dangnhap - End -----*/


/* ----- nhanvien - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::resource(
        'nhanvien',
        'NhanvienController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- nhanvien - End -----*/

/* ----- chude - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::get('chude/{id}/loaisanpham', ['as' => 'chude.categories', 'uses' => 'ChudeController@getList']);
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

/* ----- hinhanh - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::get('hinhanh', ['as' => 'hinhanh', 'uses' => 'HinhanhController@hinhanh_sanpham']);
    Route::post('hinhanh/{id}', ['as' => 'hinhanh.upload', 'uses' => 'HinhanhController@upload_hinh']);
    Route::post('hinhanh/del/{id}', ['as' => 'hinhanh.delete', 'uses' => 'HinhanhController@delete_hinh']);
});
/* ----- hinhanh - End -----*/

/* ----- nhacungcap - Begin -----*/
Route::group(['prefix' => 'quantri'], function() {
    Route::resource(
        'nhacungcap',
        'NhacungcapController',
        ['except' => ['create', 'edit']]
    );
});
/* ----- nhacungcap - End -----*/

/* ----- trangchu - Begin -----*/
Route::get('/', ['as' => 'trangchu', 'uses' => 'PagesController@index']);
Route::post('/', ['as' => 'loadmore', 'uses' => 'PagesController@loadMore']);
Route::get('giohang', ['as' => 'giohang', 'uses' => 'PagesController@shoppingCart']);
Route::get('dathang/{id}', ['as' => 'dathang','uses' => 'PagesController@getOrder']);
Route::get('capnhat/{id}/{sl}', ['as'  => 'giohang.update', 'uses' => 'PagesController@updateCart']);
Route::get('xoahang/{id}', ['as' =>'giohang.delete', 'uses' => 'PagesController@deleteCart']);
Route::get('donhang', ['as' => 'donhang', 'uses' => 'PagesController@order']);
Route::get('{tenkhongdau}/{id}', ['as' => 'loaisanpham.products', 'uses' => 'PagesController@showListProducts']);
/* ----- trangchu - End -----*/
