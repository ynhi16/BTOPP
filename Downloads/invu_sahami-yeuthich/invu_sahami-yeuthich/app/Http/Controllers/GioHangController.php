<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class GioHangController extends Controller
{
    //
    ///thêm
    public function add_giohang(Request $request)
    {

        $maSP = $request->maSP;
        $key = $request->phanloai;
        $sl = $request->soluong;

        $pl = DB::table('phanloai')->where('maSP', $maSP)->get();

        $sanpham = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.masp', '=', 'hinhanh.masp')
            ->join('phanloai', 'sanpham.masp', '=', 'phanloai.masp')
            ->where('sanpham.maSP', $maSP)->where('tenPL', $pl[$key]->tenPL)->first();

        $data['id'] = $request->maSP;
        $data['qty'] = $sl[$key];
        $data['name'] = $sanpham->tenSP;
        $data['price'] = $sanpham->donGia;
        $data['options']['image'] = $sanpham->tenHA;
        $data['options']['phanloai'] = $pl[$key]->tenPL;
        $data['weight'] = '123';
        Cart::add($data);

        return Redirect::to('/giohang');
    }

    //xoá
    public function del_giohang($rowId)
    {

        Cart::update($rowId, 0);
        return Redirect::to('/giohang');
    }

    //update
    public function update_giohang($rowId, $soluong)
    {
        Cart::update($rowId, $soluong);
        return Redirect::to('/giohang');
    }

    //thêm hoá đơn
    public function add_hoadon(Request $request)
    {

        $maND = Session::get('nguoidung_id');

        $today = date("Y-m-d");

        $data = array();

        $data['maND'] = $maND;
        $data['ngayLap'] = $today;
        $data['nguoiNhan'] = $request->hoten;
        $data['SDT'] = $request->sdt;
        $data['diaChi'] = $request->sonha;
        $data['trangthai'] = "Chờ xác nhận";
        $data['maPX'] = $request->phuongxa;
        $data['ngayGiao'] = null;

        if ($data['nguoiNhan'] == null || $data['SDT'] == null || $data['diaChi'] == null || $data['maPX'] == null) {
            Session::put("msg", "Thông tin không hợp lệ.");
            return Redirect::to('/thanhtoan');
        }

        $result1 = DB::table('hoadon')->insert($data);

        if ($result1) {

            $getHD = DB::table('hoadon')->orderby('maHD', 'desc')->first();

            $maHD = $getHD->maHD;

            $giohang = Cart::content();

            foreach($giohang as $key => $value) {

                $item = array();
                $item['maHD'] = $maHD;
                $item['maSP'] = $value->id;
                $item['soLuong'] = $value->qty;
                $item['donGia'] = $value->price;
                $item['phanLoai'] = $value->options->phanloai;

                //add hoá đơn
                $result = DB::table('chitiethoadon')->insert($item);

                //lấy phân loại sản phẩm
                $itempl = DB::table('phanloai')
                ->where('maSP', $item['maSP'])
                ->where('tenPL', $item['phanLoai'])
                ->first();
                $newsl = $itempl->soLuong - $item['soLuong'];
                //giảm số lượng của phân loại vừa lấy
                $rs = DB::table('phanloai')
                ->where('maPL', $itempl->maPL)
                ->update(['soLuong' => $newsl]);
            }

            if($maND) {

                Cart::destroy();
                return Redirect::to('/donmua');
            } else {

                Cart::destroy();
                return Redirect::to('/giohang');
            }
        } else {

            Session::put("msg", "Thông tin không hợp lệ.");
            return Redirect::to('/thanhtoan');
        }
    }
    
    //huỷ đơn mua
    public function del_hoadon($maHD) {

        $get = DB::table('hoadon')
            ->where('maHD', $maHD)
            ->update(['trangthai' => "Đơn đã huỷ"]);

        $chitiet = DB::table('chitiethoadon')->where('maHD', $maHD)->get();
        foreach($chitiet as $key => $value){
            //lấy phân loại sản phẩm
            $itempl = DB::table('phanloai')
            ->where('maSP', $value->maSP)
            ->where('tenPL', $value->phanLoai)
            ->first();
            $newsl = $itempl->soLuong + $value->soLuong;
            //tăng số lượng của phân loại vừa lấy
            $rs = DB::table('phanloai')
            ->where('maPL', $itempl->maPL)
            ->update(['soLuong' => $newsl]);
        }

        return Redirect::to('/donmua');
    }

    //đánh giá
    public function danhgia($maHD) {
        $get = DB::table('hoadon')
        ->join('chitiethoadon', 'hoadon.maDH', '=', 'chitiethoadon.maHD')
        ->where('maHD', $maHD);

        return view('khachhang.danhgia');
    }
}