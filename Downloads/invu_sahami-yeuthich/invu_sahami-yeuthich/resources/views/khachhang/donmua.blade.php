@extends('layout')
@section('trangchu')
<style>
    .item-donmua {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        border: solid #DDDDDD;
        border-width: 2px;
        margin-bottom: 30px;
    }

    .inf-sanpham {
        border: solid #6666;
        border-width: 1.5px;
        border-radius: 5px;
        height: 580px;
        padding-left: 15px;
        padding-top: 20px;
        margin-left: 50px;

    }

    .a-thaotac {
        padding-left: 5px;
        color: #16A085;
        text-decoration: none;
    }

    a.a-thaotac:hover {
        text-decoration: none;
    }
</style>


<div class="wp-thanhtoan ms-5 me-5">
    <h2>Lịch sử mua hàng</h2>
    <hr style="border-width: 0.5px;">
    <div class="row" style="padding-left: 10px; padding-right: 10px;">

        <!-- item don mua -->
        <?php $tongtien = 0; ?>
        @foreach($hoadons as $key => $hoadon)
        <!-- kiểm tra ngày giao so vs ngày hiện tại => đánh giá sp -->
        <?php 
            $danhgia = 0;
            $ngayGiao = explode('-', $hoadon->ngayGiao);
            $today = explode('/', date("Y/m/d"));
            if ($ngayGiao[0] == $today[0] && $ngayGiao[1] == $today[1])
                if($today[2] - $ngayGiao[2] <= 3)
                    $danhgia = 1;
        ?>
        <div class="col-md-12 item-donmua">
            <div class="row" style="margin-bottom: -30px;">
                <div class="col-md-6">
                    <p style="color: #6B6A6A;">Ngày đặt: {{$hoadon->ngayLap}}</p>
                </div>
                <div class="col-md-6">
                    @if($hoadon->trangThai == 'Chờ xác nhận' || $hoadon->trangThai == 'Đang xử lý')
                    <p style="text-align: right;"><label style="padding-right: 5px; color: #16A085;">{{$hoadon->trangThai}}</label><label style="color: #16A085;"> | </label><a href="{{URL::to('/del-hoadon/'.$hoadon->maHD)}}" class="a-thaotac">Huỷ đơn</a></p>
                    @elseif($danhgia == 1)
                    <p style="text-align: right;"><label style="padding-right: 5px; color: #16A085;">{{$hoadon->trangThai}}</label><label style="color: #16A085;"> | </label><a href="{{URL::to('/danhgia/'.$hoadon->maHD)}}" class="a-thaotac">Đánh giá</a></p>
                    @else
                    <p style="text-align: right;"><label style="padding-right: 5px; color: #16A085;">{{$hoadon->trangThai}}</label></p>
                    @endif
                </div>
            </div>
            <hr style="border-width: 0.5px;">
            <!-- danh sach san pham -->

            @foreach($chitiets as $id => $value)
            @if($value->maHD == $hoadon->maHD)
            <!-- bat dau item san pham -->
            <div class="row item-sanphamgiohang">
                <div class="col-md-2">
                    <a href="{{URL::to('/chitietsanpham/'.$value->maSP)}}"><img src="{{asset('public/frontend/img/'.$hinhanhs[$id])}}" class="img-thumbnail" alt="Cinque Terre"></a>
                </div>
                <div class="col-md-7" style="padding-left: 0px;">
                    <p class="text-dendam">{{$value->tenSP}}</p>
                    <p>Phân loại: {{$value->phanLoai}}</p>
                    <p>Đơn giá: {{$value->donGia}} đ</p>
                    <p>Số lượng: {{$value->soLuong}}</p>
                </div>
                <div class="col-md-3">
                    <p class="p-box4">{{$value->soLuong * $value->donGia}} đ</p>
                </div>
            </div>
            <!-- ket thuc item san pham -->
            <hr style="border-width: 0.5px;">

            <?php $tongtien += $value->soLuong * $value->donGia; ?>
            @endif
            @endforeach
            <p style="text-align: right;">Tổng tiền: <?php echo $tongtien ?> đ</p>
        </div>
        @endforeach

        <!-- ket thuc item don mua -->

    </div>
    <!-- ket thuc item don mua -->


</div>

@endsection