@extends('layout')
@section('trangchu')
<style>


</style>


<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2>Thiết lập tài khoản</h2>

            <!-- bắt đầu menu ngang -->
            <div class="row" style="margin-top: 60px;">
                <a class="btn-vienden tab-duocchon" href="{{URL::to('/canhan')}}">Thông tin cá nhân</a>
                <a class="tab-khongchon" href="{{URL::to('/matkhau')}}">Đổi mật khẩu</a>
            </div> <!-- kết thúc menu ngang -->
            <hr>

            <div class="row">
                <!-- bắt đầu phần thông tin cá nhân -->
                <form action="{{URL::to('/capnhat-ttcn')}}" method="post">
                    @csrf
                    <div class="row inf-canhan" style="margin-top: 50px;">
                        @foreach($nguoidung as $key => $value)
                        <div class="col-md-5">
                            <label for="pwd"><strong>Họ tên</strong></label>
                            <input type="text" class="form-control input-canhan" value="{{$value->tenND}}" name="tenND">
                            <label for="pwd"><strong>Giới tính</strong></label>
                            <!-- <input type="text" class="form-control input-canhan" value="{{$value->gioiTinh}}" name="gioiTinh"> -->
                            <select class="form-control input-canhan" name="gioiTinh">
                                <option></option>
                                <?php $gt = array('Nam', 'Nữ') ?>
                                @for($i=0; $i<=1; $i++) @if($kiemtra==1 && $gt[$i]==$value->gioiTinh)

                                    <option selected value="{{$gt[$i]}}">{{$gt[$i]}}</option>
                                    @else

                                    <option value="{{$gt[$i]}}">{{$gt[$i]}}</option>
                                    @endif
                                    @endfor
                            </select>
                            <label for="pwd"><strong>Ngày sinh</strong></label>
                            <input type="date" class="form-control input-canhan" value="{{$value->ngaySinh}}"
                                name="ngaySinh">
                            <label for="pwd"><strong>Email</strong></label>
                            <input type="email" class="form-control input-canhan" value="{{$value->email}}"
                                name="email">
                            <label for="pwd"><strong>Số điện thoại</strong></label>
                            <input type="text" class="form-control input-canhan" value="{{$value->SDT}}" name="SDT">

                        </div>

                        <div class="col-md-1"></div>

                        <div class="col-md-5">
                            <label for="pwd"><strong>Tỉnh thành</strong></label>
                            <select class="form-control input-canhan" name="tinhthanh">
                                <option></option>
                                @foreach($tinhthanh as $key => $tt)
                                @if($kiemtra == 1 && $tt->tenTT == $value->tenTT)

                                <option selected value="{{$tt->IDTT}}">{{$tt->tenTT}}</option>
                                @else

                                <option value="{{$tt->IDTT}}">{{$tt->tenTT}}</option>
                                @endif
                                @endforeach
                            </select>
                            <label for="pwd"><strong>Quận huyện</strong></label>
                            <select class="form-control input-canhan" name="quanhuyen">
                                <option></option>
                                @foreach($quanhuyen as $key => $tt)
                                @if($kiemtra == 1 && $tt->tenQH == $value->tenQH)

                                <option selected value="{{$tt->IDQH}}">{{$tt->tenQH}}</option>
                                @else

                                <option value="{{$tt->IDQH}}">{{$tt->tenQH}}</option>
                                @endif
                                @endforeach
                            </select>
                            <label for="pwd"><strong>Phường xã</strong></label>
                            <select class="form-control input-canhan" name="phuongxa">
                                <option></option>
                                @foreach($phuongxa as $key => $tt)
                                @if($kiemtra == 1 && $tt->tenPX == $value->tenPX)

                                <option selected value="{{$tt->IDPX}}">{{$tt->tenPX}}</option>
                                @else

                                <option value="{{$tt->IDPX}}">{{$tt->tenPX}}</option>
                                @endif
                                @endforeach
                            </select>
                            <label for="pwd"><strong>Số nhà</strong></label>
                            <input type="text" class="form-control input-canhan" value="{{$value->diaChi}}"
                                name="diaChi">
                        </div>

                        <input type="hidden" value="{{$value->maND}}" name="maND">
                        <input type="hidden" value="{{$value->taiKhoan}}" name="taiKhoan">
                        <input type="hidden" value="{{$value->matKhau}}" name="matKhau">
                        <input type="hidden" value="{{$value->maQuyen}}" name="maQuyen">
                        @endforeach
                    </div>

                    <div class="row" style="margin-top: 100px;">
                        <input type="submit" class="btn-den btn-luu" value="Lưu thay đổi" />
                    </div>
                </form> <!-- kết thúc phần thông tin cá nhân -->
            </div>
        </div>
    </div>
</div>



@endsection