<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Foreach_;

session_start();

class KhachHangController extends Controller
{
    //
    public function index()
    {
        return view('layout');
    }
    //dang nhap
    // public function login() {
    //     return view('page.khachhang_home');
    // }

    public function giohang()
    {
        //giỏ hàng
        $giohang = Cart::content();
        // $phanloais = array();
        // $nows = array();
        // foreach($giohang as $key => $value) {
        //     //lấy phân loại sản phẩm
        //     $phanloai = DB::table('phanloai')->where('maSP', $value->id)->get();
        //     $phanloais[$key] = $phanloai;

        //     //lấy phân loại được chọn
        //     foreach($phanloai as $key2 => $pl) {
        //         if($pl->tenPL === $value->options->phanloai) {
        //             $nows[$key] = $key2;
        //         }
        //     }
        // }
        $soluong = array();
        foreach ($giohang as $key => $value) {
            $sl = DB::table('phanloai')->select('soLuong')->where('tenPL', $value->options->phanloai)->first();
            $soluong[$key] = $sl;
        }

        //sản phẩm bán chạy
        $get = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')->get();

        $distinct = null;

        foreach ($get as $key => $value) {
            if ($distinct != null) {
                $i = 0;
                foreach ($distinct as $key => $dis) {
                    if ($dis->maSP == $value->maSP) {

                        $i = 1;
                    }
                }
                if ($i == 0) {
                    $distinct[] = $value;
                }
            } else {
                $distinct = array();
                $distinct[] = $value;
            }
        }

        return view('khachhang.giohang')->with('sanphambc', $distinct)->with('soluongs', $soluong);
    }
    ///trang thanh toán
    public function thanhtoan()
    {

        $giohang = Cart::content();

        if (count($giohang) == 0) {

            return Redirect::to('/giohang');
        }

        $maND = Session::get('nguoidung_id');

        $tinhthanh = DB::table('tinhthanh')->get();
        $quanhuyen = DB::table('quanhuyen')->get();
        $phuongxa = DB::table('phuongxa')->get();


        $get = DB::table('nguoidung')
            ->join('phuongxa', 'nguoidung.maPX', '=', 'phuongxa.idPX')
            ->join('quanhuyen', 'quanhuyen.IDQH', '=', 'phuongxa.IDQH')
            ->join('tinhthanh', 'quanhuyen.IDTT', '=', 'tinhthanh.IDTT')
            ->where('nguoidung.maND', $maND)->first();
        return view('khachhang.thanhtoan')->with('nguoidung', $get)->with('tinhthanh', $tinhthanh)->with('quanhuyen', $quanhuyen)->with('phuongxa', $phuongxa);
    }

    public function canhan()
    {

        $maND = Session::get('nguoidung_id');

        $tinhthanh = DB::table('tinhthanh')->get();
        $quanhuyen = DB::table('quanhuyen')->get();
        $phuongxa = DB::table('phuongxa')->get();

        $nguoidung = DB::table('nguoidung')->where('maND', $maND)->get();
        $kiemtra = 0;

        if ($nguoidung[0]->maPX != null) {
            $nguoidung = DB::table('nguoidung')
            ->join('phuongxa', 'phuongxa.IDPX', '=', 'nguoidung.maPX')
            ->join('quanhuyen', 'quanhuyen.IDQH', '=', 'phuongxa.IDQH')
            ->join('tinhthanh', 'quanhuyen.IDTT', '=', 'tinhthanh.IDTT')
            ->where('maND', $maND)->get();

            $kiemtra = 1;
        }

        return view('khachhang.canhan')->with('nguoidung', $nguoidung)->with('tinhthanh', $tinhthanh)->with('quanhuyen', $quanhuyen)->with('phuongxa', $phuongxa)->with('kiemtra', $kiemtra);
    }
    //cập nhật thông tin cá nhân
    public function capnhat_ttcn(Request $request)
    {
        $data = array();

        $data['maND'] = $request->maND;
        $data['tenND'] = $request->tenND;
        $data['gioiTinh'] = $request->gioiTinh;
        $data['ngaySinh'] = $request->ngaySinh;
        $data['SDT'] = $request->SDT;
        $data['email'] = $request->email;
        $data['diaChi'] = $request->diaChi;
        $data['taiKhoan'] = $request->taiKhoan;
        $data['matKhau'] = $request->matKhau;
        $data['maPX'] = $request->phuongxa;
        $data['maQuyen'] = $request->maQuyen;

 

        DB::table('nguoidung')->where('maND', $request->maND)->update($data);
        return Redirect::to('canhan');
    }
    public function matkhau()
    {
        return view('khachhang.doimatkhau');
    }
    //đổi mật khẩu
    public function capnhat_mk(Request $request)
    {
        $mkcu = $request->mkcu;
        $mkmoi = $request->mkmoi;
        $mkmoi2 = $request->mkmoi2;

        $maND = Session::get('nguoidung_id');
        $nguoidung = DB::table('nguoidung')->where('maND', $maND)->first();
        $matKhau = $nguoidung->matKhau;

        if ($mkmoi !== $mkmoi2 || $mkcu == '' || $mkmoi == '' || $mkmoi2 == '' || $mkcu !== $matKhau) {

            Session::put('capnhat', "Thông tin không hợp lệ!");
            return Redirect::to('matkhau');
        } else {

            $data = array();

            $data['maND'] = $nguoidung->maND;
            $data['tenND'] = $nguoidung->tenND;
            $data['gioiTinh'] = $nguoidung->gioiTinh;
            $data['ngaySinh'] = $nguoidung->ngaySinh;
            $data['SDT'] = $nguoidung->SDT;
            $data['email'] = $nguoidung->email;
            $data['diaChi'] = $nguoidung->diaChi;
            $data['taiKhoan'] = $nguoidung->taiKhoan;
            $data['matKhau'] = $mkmoi;
            $data['maPX'] = $nguoidung->maPX;
            $data['vaiTro'] = $nguoidung->vaiTro;
            $data['maQuyen'] = $nguoidung->maQuyen;

            DB::table('nguoidung')->where('maND', $request->maND)->update($data);

            return Redirect::to('canhan');
        }
    }
    //đơn mua
    public function donmua()
    {
        $maND = Session::get('nguoidung_id');

        $gethoadon = DB::table('hoadon')
            ->where('maND', $maND)->orderby('maHD', 'desc')->get();

        $getchitiet = DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.maHD', '=', 'chitiethoadon.maHD')
            ->join('sanpham', 'sanpham.maSP', '=', 'chitiethoadon.maSP')
            ->where('maND', $maND)->get();

        $hinhanhs = array();
        foreach ($getchitiet as $key => $value) {

            $image = DB::table('hinhanh')->where('maSP', $value->maSP)->first();
            $hinhanhs[$key] = $image->tenHA;
        }

        return view('khachhang.donmua')->with('hoadons', $gethoadon)->with('chitiets', $getchitiet)->with('hinhanhs', $hinhanhs);
    }

    //yêu thích
    public function yeuthich()
    {

        $maND = Session::get('nguoidung_id');

        $get = DB::table('yeuthich')
            ->join('sanpham', 'yeuthich.maSP', '=', 'sanpham.masp')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->where('yeuthich.maND', $maND)->get();

        $yeuthichs = null;
        foreach ($get as $key => $value) {
            if ($yeuthichs != null) {

                $kt = 1;
                foreach ($yeuthichs as $id => $item) {

                    if ($value->maSP == $item->maSP) {

                        $kt = 0;
                    }
                }

                if ($kt == 1) {

                    $yeuthichs[] = $value;
                }
            } else {

                $yeuthichs = array();
                $yeuthichs[] = $value;
            }
        }

        return view('khachhang.yeuthich')->with('yeuthichs', $yeuthichs);
    }

    public function update_yeuthich($maSP, $tym)
    {

        $maND = Session::get('nguoidung_id');

        $data = array();
        $data['maND'] = $maND;
        $data['maSP'] = $maSP;

        if ($tym === "tym-trang.png") {

            $result = DB::table('yeuthich')->insert($data);
        } else {

            $result = DB::table('yeuthich')-> where('maND',$maND)->where('maSP', $maSP)->delete();
        }

        return Redirect::to('/chitietsanpham'.'/'.$maSP);
    }

    public function del_yeuthich($maSP) {

        $maND = Session::get('nguoidung_id');

        $data = array();
        $data['maND'] = $maND;
        $data['maSP'] = $maSP;

        $result = DB::table('yeuthich')-> where('maND',$maND)->where('maSP', $maSP)->delete();

        return Redirect::to('/yeuthich');
    }



    public function test(Request $request) {
        $response = $request->bien;
        $response = 'hè lố';
        return $request;
    }
}
