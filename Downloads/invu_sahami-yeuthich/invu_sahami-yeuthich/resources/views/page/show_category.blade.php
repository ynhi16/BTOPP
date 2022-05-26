@extends('layout')
@section('trangchu')
<div class="container">
    <div class="row g-0">
        @foreach($ten as $key => $ten)
        <div class="title-row mb-2">{{ $ten -> tenDM }} </div>
        @endforeach
        <div class="row row-cols-4">
            @foreach($sanphambc as $key => $cate)
            <div class="col product">
                <div class="card">
                    <a href="{{URL::to('/chitietsanpham/'.$cate->maSP)}}">
                        <img src="{{asset('public/frontend/img/'.$cate->tenHA)}}" class="card-img-top" alt="..."
                            height="180px" width="98%"></a>
                    <?php $maND = Session::get('nguoidung_id'); ?>
                    @if ($maND)
                    <ul class="featured__item__pic__hover">
                        <li><a href="#"><img src="{{asset('public/frontend/img/tym-trang.png')}}" alt=""></a></li>
                    </ul>
                    @endif
                    <div class="card-body">
                        <div class="card-text">{{$cate->tenSP}}</div>
                        <div class="d-flex align-items-start">
                            <div class="text-end price">{{$cate->donGia}} VNĐ</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection