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


Route::get('/test', function () {
    return view('test');
});

//page
Route::get('/','trangchuController@index');
Route::post('/ajax/filter','trangchuController@filterAjax');

Route::get('/chitietsanpham/{maSP}','trangchuController@chitietsanpham');
Route::post('/load-comment','trangchuController@load_comment');

Route::post('/auto-ajax','trangchuController@auto_ajax');
///giỏ hàng
Route::get('/giohang','KhachHangController@giohang');

Route::post('/add-giohang','GioHangController@add_giohang');
Route::get('/del-giohang/{rowId}','GioHangController@del_giohang');
Route::get('/update-giohang/{rowId}&{soluong}','GioHangController@update_giohang');
//tim kiem
Route::get('/find','TimKiemController@index');

Route::post('/timkiem','trangchuController@timkiem');
///khách hàng
Route::get('/khachhang','KhachHangController@index');
//dang nhap
// Route::get('/khachhangHome','KhachHangController@login');
Route::get('/thanhtoan','KhachHangController@thanhtoan');
Route::get('/canhan','KhachHangController@canhan');
Route::get('/matkhau','KhachHangController@matkhau');
Route::get('/yeuthich','KhachHangController@yeuthich');
Route::get('/update-yeuthich/{maSP}&{tym}','KhachHangController@update_yeuthich');
Route::get('/del-yeuthich/{maSP}','KhachHangController@del_yeuthich');
///cập nhậT thông tin cá nhân
Route::post('/capnhat-ttcn','KhachHangController@capnhat_ttcn');
///đổi mật khẩu
Route::post('/capnhat-mk','KhachHangController@capnhat_mk');
//đơn mua
Route::get('/donmua','KhachHangController@donmua');
//danh muc
Route::get('/danhmuc/{maDM}','trangchuController@show_category_home');
//dang nhap dang ky
Route::get('/dangky','trangchuController@dangky');
Route::get('/dangnhap','trangchuController@dangnhap');
//
Route::post('/add-user','trangchuController@add_user');
//kiểm tra đăng nhập
Route::post('/kiemtra-dangnhap','trangchuController@kiemtra_dangnhap');
//đăng xuất
Route::get('/dangxuat','trangchuController@dangxuat');