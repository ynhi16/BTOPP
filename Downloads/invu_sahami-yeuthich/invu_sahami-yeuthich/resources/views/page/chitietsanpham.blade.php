@extends('layout')
@section('trangchu')
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
<link rel="stylesheet" href="{{asset('public/frontend/css/sanpham/chitietsanpham.css')}}">
</head>

<body>
    <div class="main_body">
        <p class="list">{{$sanphamct[0]->tenDM}}</p>
        <div class="container">
            <div class="row">
                <div class="col-1">
                    @foreach($sanphamct as $key => $value)
                    <div class="box-test">
                        @if($key == 0)
                        <div class="tab-item active">
                            <img src="{{asset('public/frontend/img/'.$value->tenHA)}}" class="img-thumbnail"
                                alt="Cinque Terre">
                        </div>
                        @else
                        <div class="tab-item">
                            <img src="{{asset('public/frontend/img/'.$value->tenHA)}}" class="img-thumbnail"
                                alt="Cinque Terre">
                        </div>
                        @endif
                    </div>
                    @endforeach

                    @foreach($video as $key => $vid)
                    @if($vid->masp == $sanphamct[0]->maSP)
                    <div class="box-test">
                        <div class="tab-item">
                            <img src="{{asset('public/frontend/vids/'.$vid->tenimg)}}" class="img-thumbnail"
                                alt="Cinque Terre">
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="col-6 img_main">
                    @foreach($sanphamct as $key => $value)
                    @if ($key == 0)
                    <div class="tab-pane active">
                        <img src="{{asset('public/frontend/img/'.$value->tenHA)}}" class="img-thumbnail img"
                            alt="Cinque Terre">
                    </div>
                    @else
                    <div class="tab-pane">
                        <img src="{{asset('public/frontend/img/'.$value->tenHA)}}" class="img-thumbnail img"
                            alt="Cinque Terre">
                    </div>
                    @endif
                    @endforeach

                    @foreach($video as $key => $vid)
                    @if($vid->masp == $sanphamct[0]->maSP)
                    <div class="tab-pane video">
                        <video controls loop width="364.66px" height="364.66px">
                            <source src="{{asset('public/frontend/vids/'.$vid->tenvd)}}">
                        </video>
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="col-5">
                    <form action="{{URL::to('/add-giohang')}}" method="post">
                        @csrf
                        <input type="hidden" name="maSP" value="{{$sanphamct[0]->maSP}}">
                        <p class="text-dendam">{{$value->tenSP}}</p>
                        <div class="row">
                            <div class="col-md-7">
                                <p class="price_detail">{{$value->donGia}}đ</p>
                            </div>
                            <div class="col-md-5">
                                <!-- <p style="text-align: right;"><img src="{{asset('public/frontend/img/tym-trang.png')}}" alt=""></p> -->

                            </div>
                        </div>
                        <div>
                            <?php $maND = Session::get('nguoidung_id'); ?>
                            @if ($maND)
                            <div class="col-md-1">

                                <p style="text-align: right;" class="mt-3"><a class="like"
                                        href="{{URL::to('update-yeuthich/'.$sanphamct[0]->maSP.'&'.$tym)}}"><img
                                            src="{{asset('public/frontend/img/'.$tym)}}" alt=""></a></p>

                            </div>
                            @endif
                            <div class="chon-phanloai mt-2">
                                <label style="color: #8B8989; font-size:14px;">Phân loại</label>
                                <select class="form-control select-soluong" name="phanloai"
                                    onchange="soLuong(this.value)">
                                    @foreach($phanloaisp as $key => $value)
                                    <option value="<?php echo $key ?>">{{$value->tenPL}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label style="color: #8B8989; font-size:14px; margin-top: 10px;">Số lượng</label>

                            <div class="content2">
                                @foreach($phanloaisp as $key => $value2)
                                @if ($key == 0)
                                <div class="tab-pane2 active2">
                                    <select class="form-control select-soluong" name="soluong[]">
                                        @for($i=1; $i<=$value2->soLuong; $i++)
                                            <option><?php echo $i ?></option>
                                            @endfor
                                    </select>
                                </div>
                                @else
                                <div class="tab-pane2">
                                    <select class="form-control select-soluong" name="soluong[]">
                                        @for($i=1; $i<=$value2->soLuong; $i++)
                                            <option><?php echo $i ?></option>
                                            @endfor
                                    </select>
                                </div>
                                @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="box-btn mt-3">
                            <button type="submit" class="btn-chitiet">Thêm vào giỏ hàng</button>
                        </div>
                        <p>Kích thước: {{$sanphamct[0]->kichThuoc}}</p>
                        <p>Mô tả: {!!$sanphamct[0]->moTa!!}</p>
                        <div>
                    </form>

                </div>
            </div>
        </div>




        <!-- endtag mainbody -->
    </div>
</body>
<script>
//* hình ảnh sản phẩm */

//chỉ lấy 1 đối tượng
const $ = document.querySelector.bind(document);
//lấy tất cả đối tượng
const $$ = document.querySelectorAll.bind(document);

//lấy theo tên class
const tabs = $$(".tab-item");
const panes = $$(".tab-pane");

const tabActive = $(".tab-item.active");

tabs.forEach((tab, index) => {
    const pane = panes[index];

    tab.onclick = function() {
        //tìm và xoá các element có class chứa active
        $(".tab-item.active").classList.remove("active");
        $(".tab-pane.active").classList.remove("active");

        this.classList.add("active");
        pane.classList.add("active");
    };
});


///thay đổi số lượng
function soLuong(st) {
    const key = Number(st)
    const panes2 = $$(".tab-pane2");
    const pane2 = panes2[key];
    $(".tab-pane2.active2").classList.remove("active2");
    pane2.classList.add("active2");
    // $(".tab-pane2.active2").namespace.remove("soluong")
    // pane2.namespace.add("soluong");
}



/* btn số lượng */
const inputSL = $(".input-soluong.input-ct-sl");
const btnTang = $(".btn-soluong-tang.btn-ct-tang");
const btnGiam = $(".btn-soluong-giam.btn-ct-giam");

btnGiam.onclick = function() {
    var sl = inputSL.value;
    if (sl >= 2) {
        sl--;
        inputSL.value = sl;
    }
};

btnTang.onclick = function() {
    var sl = inputSL.value;
    var slmax = <?= $sanphamct[0]->soLuongCon; ?>;
    if (sl < slmax) {
        sl++;
        inputSL.value = sl;
    }
};
</script>
<script type="text/javascript">
$(document).ready(function() {
    var maSP = $('.sanphambl');
    alert(maSP);
});
</script>

<!-- start rating -->
<script>
function calcRate(r) {
    const f = ~~r, //Tương tự Math.floor(r)
        id = 'star' + f + (r % f ? 'half' : '')
    id && (document.getElementById(id).checked = !0)
}
</script>
<!-- end rating -->

@endsection