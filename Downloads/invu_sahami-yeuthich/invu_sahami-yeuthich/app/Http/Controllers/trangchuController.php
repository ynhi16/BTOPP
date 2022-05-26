<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Login; //sử dụng model Login

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class trangchuController extends Controller
{
    public function index()
    {
        $get = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->orderby('sanpham.maSP', 'desc')
            ->get();
        $getMaxPrice = DB::table('sanpham')
            ->select('donGia')
            ->orderby('donGia', 'desc')
            ->limit(1)
            ->get();
        $getMinPrice = DB::table('sanpham')
            ->select('donGia')
            ->orderby('donGia', 'asc')
            ->limit(1)
            ->get();
        $get1 = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->orderby('sanpham.maSP', 'desc')
            ->get();
        $orders = DB::table('sanpham')
            ->join('chitiethoadon', 'chitiethoadon.maSP', '=', 'sanpham.maSP')
            ->select('chitiethoadon.maSP', 'tenSP', DB::raw('SUM(soLuong) as tong'))
            ->groupBy('chitiethoadon.maSP', 'tenSP')
            ->limit(5)
            ->get();
        $distinct1 = array();
        foreach ($orders as $key => $value) {
            $orders_id = $value->maSP;
            // echo $orders_id;
            $get1 = DB::table('sanpham')
                ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
                ->select('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
                ->where('sanpham.maSP', $orders_id)
                ->groupby('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
                ->limit(1)
                ->get();
            // echo '<pre>';
            // print_r($get1);
            // echo '</pre>';

            foreach ($get1 as $key => $value) {

                $distinct1[] = $value;
                // echo '<pre>';
                // print_r($distinct1);
                // echo '</pre>';
            }
        }
        //exit;
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
        return view('page.trangchu')->with('sanphambc1', $distinct1)->with('sanphambc', $distinct)->with('maxPrice', $getMaxPrice)->with('minPrice', $getMinPrice);
    }
    public function dangnhap()
    {
        return view('dangnhap');
    }
    public function dangky()
    {
        return view('dangky');
    }
    public function dangxuat()
    {
        Session::put('nguoidung_name', null);
        Session::put('nguoidung_id', null);

        return Redirect::to('/');
    }

    public function timkiem(Request $request)
    {
        $key = $request->tk;
        $all_category = DB::table('danhmuc')->get();
        $search_product = DB::table('sanpham')
            ->where('tenSP', 'like', '%' . $key . '%')->get();
        // echo '<pre>';
        // print_r($search_product);
        // echo '</pre>';
        $distinct1 = array();
        foreach ($search_product as $key => $value) {
            $orders_id = $value->maSP;
            // echo $orders_id;
            $get1 = DB::table('sanpham')
                ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
                ->select('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
                ->where('sanpham.maSP', $orders_id)
                ->groupby('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
                ->limit(1)
                ->get();
            // echo '<pre>';
            // print_r($get1);
            // echo '</pre>';
            foreach ($get1 as $key => $value) {

                $distinct1[] = $value;
                // echo '<pre>';
                // print_r($distinct1);
                // echo '</pre>';
            }
        }
        //exit;
        return view('page.tk')->with('sanphambc1', $distinct1);
    }
    public function auto_ajax(Request $request)
    {
        $data = $request->all();
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('sanpham')
                ->where('tenSP', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
               <li><a href="#" class="search" style="text-decoration: none; color: black">' . $row->tenSP . '</a></li>
               ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }


    //chi tiết sản phẩm
    public function chitietsanpham($maSP)
    {

        //lấy thông tin sản phẩm theo maSP
        $sanphamct = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->join('danhmuc', 'sanpham.maDM', '=', 'danhmuc.maDM')
            ->where('sanpham.maSP', $maSP)->get();
        //lấy phân loại sản phẩm
        $phanloaisp = DB::table('sanpham')
            ->join('phanloai', 'sanpham.maSP', '=', 'phanloai.maSP')
            ->where('sanpham.maSP', $maSP)->get();
        //lấy video
        $video = DB::table('videos')->where('masp', $maSP)->get();

        //lấy mảng các đường dẫn hình ảnh
        $hinhanhs = [];
        foreach ($sanphamct as $key => $value) {
            $hinhanhs[] = "{{asset('public/frontend/img/'.$value->tenHA)}}";
        }

        //lấy danh sách các bình luận
        $binhluan = DB::table('danhgia')
        ->join('nguoidung', 'danhgia.mand', '=', 'nguoidung.maND')
        ->where('masp', $maSP)
        ->orderby('thoigian', 'desc')
        ->get();

        //lấy danh sách sản phẩm bán chạy
        $get = DB::table('sanpham')
            ->where('maDM', 2)
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')->get();
        //lọc danh sách sản phẩm bán chạy
        // $distinct = null;
        // foreach ($get as $key => $value) {
        //     if ($distinct != null) {
        //         $i = 0;
        //         foreach ($distinct as $key => $dis) {
        //             if ($dis->maSP == $value->maSP) {

        //                 $i = 1;
        //             }
        //         }
        //         if ($i == 0) {
        //             $distinct[] = $value;
        //         }
        //     } else {
        //         $distinct = array();
        //         $distinct[] = $value;
        //     }
        $get = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->orderby('sanpham.maSP', 'desc')
            ->get();
        $orders = DB::table('sanpham')
            ->join('chitiethoadon', 'chitiethoadon.maSP', '=', 'sanpham.maSP')
            ->select('chitiethoadon.maSP', 'tenSP', DB::raw('SUM(soLuong) as tong'))
            ->groupBy('chitiethoadon.maSP', 'tenSP')
            ->limit(4)
            ->get();
        $distinct1 = array();
        foreach ($orders as $key => $value) {
            $orders_id = $value->maSP;
            // echo $orders_id;
            $get1 = DB::table('sanpham')
                ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
                ->select('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
                ->where('sanpham.maSP', $orders_id)
                ->groupby('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
                ->limit(1)
                ->get();


            foreach ($get1 as $key => $value) {

                $distinct1[] = $value;
            }
        }
        //kiểm tra sản phẩm yêu thích
        $tym = "tym-trang.png";
        $maND = Session::get("nguoidung_id");
        if ($maND) {
            $yt = DB::table('yeuthich')->where("maND", $maND)->where('maSP', $maSP)->first();

            if ($yt) {

                $tym = "tym-den.png";
            }
        }
        //binhluan

        $sanphambl = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->join('danhmuc', 'sanpham.maDM', '=', 'danhmuc.maDM')
            ->where('sanpham.maSP', $maSP)->limit(1)->get();
        // echo '<pre>';
        // print_r($sanphambl);
        // echo '</pre>';
        // exit;

        return view('page.chitietsanpham')->with('sanphamct', $sanphamct)->with('sanphambc1', $distinct1)->with('hinhanhs', $hinhanhs)->with('phanloaisp', $phanloaisp)->with('sanphambl', $sanphambl)->with('tym', $tym)->with('video', $video)->with('binhluan', $binhluan);
    }

    //filter ajax
    public function filterAjax(Request $request) {
        $startPrice = $_POST['start']; 
        $endPrice = $_POST['end'];
        $sortState= $_POST['sortState'] ? $_POST['sortState'] : '';
    /*     $data = $request->all();
        $query = $request->get('query'); */
        // echo 'cc';
        if ($sortState == '')
            $get = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->select('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
            ->whereBetween('donGia', [$startPrice, $endPrice])
            ->orderby('sanpham.maSP', 'desc')
            ->get();
        else 
        $get = DB::table('sanpham')
            ->join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
            ->select('sanpham.maSP', 'sanpham.tenSP', 'sanpham.donGia', 'hinhanh.tenHA')
            ->whereBetween('donGia', [$startPrice, $endPrice])
            ->orderby('sanpham.donGia', $sortState)
            ->orderby('sanpham.maSP', 'desc')
            ->get();

        $productList = array();
        foreach ($get as $key => $value) {
            if ($productList) {
                $i = 0;
                foreach ($productList as $key => $dis) {
                    if ($dis->maSP == $value->maSP) {
                        $i = 1;
                    }
                }
                if ($i == 0) {
                    $productList[] = $value;
                }
            } else {
                $productList[] = $value;
            }
        }
        
        foreach ($productList as $product) { ?>
<div class='col product'>
    <div class="card">
        <a href="./chitietsanpham/<?=$product->maSP?>">
            <img src="./public/frontend/img/<?=$product->tenHA?>" class="card-img-top" alt="..." height="230px"
                width="98%"></a>
        <div class="card-body">
            <div class="card-text"><?=$product->tenSP?></div>
            <div class="d-flex align-items-start">
                <div class="text-end price"><?=$product->donGia?> VNĐ</div>
            </div>
        </div>
    </div>
</div>
<?php
        }


    }
    public function show_category_home($maDM){
        
        $get = DB::table('sanpham')
        -> join('hinhanh', 'sanpham.maSP', '=', 'hinhanh.maSP')
        -> join('danhmuc', 'sanpham.maDM', '=', 'danhmuc.maDM')->where('sanpham.maDM',$maDM)->get();
        $distinct = null;
        $tenDM = DB::table('danhmuc')->where('danhmuc.maDM',$maDM)->get();
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

        return view('page.show_category')->with('sanphambc', $distinct)->with('maDM',$maDM)->with('ten',$tenDM);
        
        
    }
    //tạo tài khoản
    public function add_user(Request $request)
    {

        $data = array();
        $data['tenND'] = $request->hoten;
        // $data['gioiTinh'] = null;
        // $data['ngaySinh'] = null;
        // $data['SDT'] = null;
        $data['email'] = $request->email;
        // $data['diaChi'] = null;
        $data['taiKhoan'] = $request->taikhoan;
        $data['matKhau'] = $request->matkhau;
        // $data['maPX'] = null;
        $data['maQuyen'] = 3;
        $data['trangThai'] = 1;
        if ($request->hoten == null || $request->email == null || $request->taikhoan == null || $request->matkhau == null) {

            Session::put('msg', "Thông tin không hợp lệ!");
            return Redirect::to('/dangky');
        } else {

            $get1 = DB::table('nguoidung')->where('email', $request->email)->first();
            $get2 = DB::table('nguoidung')->where('taiKhoan', $request->taikhoan)->first();

            if ($get1 || $get2) {

                Session::put('msg', "Tài khoản đã tồn tại!");
                return Redirect::to('/dangky');
            } else {

                $result = DB::table('nguoidung')->insert($data);
                if ($result) {

                    $thongtin = DB::table('nguoidung')->orderby('maND', 'desc')->first();

                    Session::put('nguoidung_name', $thongtin->tenND);
                    Session::put('nguoidung_id', $thongtin->maND);

                    return Redirect::to('/');
                } else {

                    Session::put('msg', "Đăng ký thất bại!");
                    return Redirect::to('/dangky');
                }
            }
        }
    }
    public function kiemtra_dangnhap(Request $request)
    {
        $taikhoan = $request->taikhoan;
        $matkhau = $request->matkhau;

        $data = DB::table('nguoidung')->where('taikhoan', $taikhoan)->where('matkhau', $matkhau)->first();

        if ($data) {
            $khoa = $data->trangThai;
            if ($khoa == 1) {
                $quyen = $data->maQuyen;

                if ($quyen == 3) {

                    Session::put('nguoidung_name', $data->tenND);
                    Session::put('nguoidung_id', $data->maND);

                    // return Redirect::to('/khachhang');
                    return Redirect::to('/');
                } else if ($quyen == 1) {

                    return Redirect::to('/admin');
                }
                else {

                    return Redirect::to('/dangnhap');
                }
            } else {
                Session::put('khoa', 'Tài khoản đã bị khóa');
                return Redirect::to('/dangnhap');
            }
        } else {

            Session::put('message', 'Tai khoan hoac mat khau sai. Yeu cau nhap lai');

            return Redirect::to('/dangnhap');
        }
    }
    

  
    
}