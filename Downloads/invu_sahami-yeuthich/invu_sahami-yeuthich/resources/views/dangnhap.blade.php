<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- File Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- CSS tùy chỉnh của bạn ở dưới này -->
    <link rel="stylesheet" href="{{('public/frontend/css/khachhang.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/dn-dk.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/layout.css')}}">
</head>

<body>
    <div class="wp-dangnhap">
        <nav class="navbar navbar-expand-sm navbar-light">
            <a class="navbar-brand navbar-light" href="{{URL::to('/')}}">
                <h1 class="title">Sahami</h1>
            </a>
        </nav>
        <div class="row form_dangnhap">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <img class="img-dangnhap" src="{{asset('public/frontend/img/dangnhap.png')}}" alt="error">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 mt-5">
                <div class="thongtin-dangnhap">
                    <h2>Đăng nhập</h2>
                    <div class="inf">
                        <form action="{{URL::to('/kiemtra-dangnhap')}}" method="post">
                            @csrf
                            <input type="text" class="form-control input-trang input-inf" placeholder="Tên đăng nhập"
                                name="taikhoan">
                            <input type="password" class="form-control input-trang input-inf" placeholder="Mật khẩu"
                                name="matkhau">
                            <p class="p-quenmk">Quên mật khẩu?</p>
                            <input type="submit" name="dangnhap" class="btn-hong btn-dangnhap" value="Đăng nhập">
                        </form>
                        <p class="p-dangky">Bạn chưa có tài khoản?
                            <a class="b-dangky" href="{{URL::to('/dangky')}}">
                                <span class="span-dangky"> Đăng kí</span>
                            </a>
                        </p>
                        <p class="p-dangky">
                            <a class="a-dangky" href="{{URL::to('/login-google')}}">
                                <img src="{{('public/frontend/img/icongg.png')}}" style="width: 48px; height: 48px;"
                                    alt="">
                            </a>
                            <a class="a-dangky" href="{{URL::to('/login-google')}}">
                                <img src="{{('public/frontend/img/iconfb.png')}}" style="width: 45px; height: 45px;"
                                    alt="">
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div style="margin: 95px 3rem 0px 3rem;">
	{{View::make('footer')}}
	</div> -->
</body>

</html>