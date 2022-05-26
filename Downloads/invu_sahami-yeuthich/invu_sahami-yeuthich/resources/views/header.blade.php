<style>
.li-2 {
    position: relative;
    list-style: none;
    display: inline-block;
    padding: 0;
    margin: 0;
    width: 100px;
    background-color: #FDF9F9;
}

.li-2-a {
    display: block;
    text-decoration: none;
    padding: 0 10px;
    color: #454545;
    background-color: #FDF9F9;

}

.ul-2 {
    position: absolute;
    display: none;
    margin: 0;
    padding: 0;
}

.li-1:hover>.ul-2 {
    display: block;
}

.li-1 {
    margin-top: 10px;
    width: 100px;
}

.input-search {

    width: 100%;

    border-radius: 10px;

    padding: 8px;
}

.text16 {
    font-size: 15px;
}
</style>
<div class="navbar_style" style="width: 80%; margin: 0 auto">
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="d-flex justify-content-between" style="width: 100%; height: 50px;">
            <div class="mt-2 ">
                <a class="navbar-brand" href="{{URL::to('/')}}">
                    <h1 class="title">Sahami</h1>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <?php $nguoidung_id = Session::get('nguoidung_id') ?>
            @if($nguoidung_id)


            <div class="p-2" style="width: 95%;">
                <form action="{{URL::to('/timkiem')}}" autocomplete="off" method="post" class="d-flex">
                    {{csrf_field()}}
                    <input class="input-search me-2" type="search" placeholder="Tìm kiếm" name="tk" id="key">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li><a class="navbar_right" href="#"><img src="{{asset('public/frontend/img/avtkhachhang.png')}}"
                            style="width: 30px; height: 30px;"></a></li>
                <li class="nav-item li-1"><span>
                        <?php
                                $hoten = Session::get('nguoidung_name');
                                $fullname = explode ( ' ' , $hoten);
                                $count = count($fullname);
                                $name = $fullname[$count-2] . " " . $fullname[$count-1];
                                echo $name;
                            ?>
                    </span>
                    <ul class="ul-2">
                        <li class="li-2"><a href="{{URL::to('/canhan')}}" class="li-2-a">Cá nhân</a></li>
                        <li class="li-2"><a href="{{URL::to('/yeuthich')}}" class="li-2-a">Yêu thích</a></li>
                        <li class="li-2"><a href="{{URL::to('/giohang')}}" class="li-2-a">Giỏ hàng</a></li>
                        <li class="li-2"><a href="{{URL::to('/donmua')}}" class="li-2-a">Đơn mua</a></li>
                        <li class="li-2"><a href="{{URL::to('/dangxuat')}}" class="li-2-a">Đăng xuất</a></li>
                    </ul>
                <li class="nav-item">
                </li>
                <button type="button" class="btn me-2">
                    <a href="{{URL::to('/giohang')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-cart3" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                    </a>
                </button>
            </ul>

            @else
            <div class="p-2" style="width: 95%;">
                <form action="{{URL::to('/timkiem')}}" autocomplete="off" method="post" class="d-flex">
                    {{csrf_field()}}
                    <input class="input-search me-2" type="search" placeholder="Tìm kiếm" name="tk" id="key">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div style="width:21%" class="pt-2">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar_right text16" href="{{URL::to('/dangnhap')}}">Đăng Nhập</a>
                    <li class="nav-item">
                        <a class="navbar_right text16" href="{{URL::to('/dangky')}}">Đăng Ký</a>
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </nav>
    <div>
        <ul class="d-flex justify-content-between ps-0">
            @foreach ($categories as $category)
            <li class="nav-item me-2 navbar-nav ">
                <a class="nav-link text-secondary fs-6"
                    href="{{URL::to('/danhmuc/'. $category -> maDM )}}">{{ $category -> tenDM }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div id="search_ajax" class="container mb-4"></div>

</div>