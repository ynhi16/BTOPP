@extends('layout')
@section('trangchu')



<div class="container">
    <div class="row g-0">
        <h3 class="mt-3">Sản phẩm yêu thích</h3>



        <!-- bắt đầu danh sách sản phẩm -->
        @if ($yeuthichs && count($yeuthichs) > 0)
        <div class="row row-cols-4">
            @foreach($yeuthichs as $key => $value)
            <div class="col product">
                <a href="{{URL::to('/chitietsanpham/'.$value->maSP)}}"><img
                        src="{{asset('public/frontend/img/'.$value->tenHA)}}" class="img-thumbnail" alt="Cinque Terre"
                        height="180px" width="98%"></a>
                <div class="card-body">
                    <div class="card-text">{{$value->tenSP}}</div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="text-end price">{{$value->donGia}} VNĐ</div>
                        <p style="text-align: right; margin-top: 20px;"><a class="like"
                                href="{{URL::to('del-yeuthich/'.$value->maSP)}}"><img class="tymnho"
                                    src="{{asset('public/frontend/img/tym-den.png')}}" alt=""></a></p>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="col-md-6">
            <img src="{{asset('public/frontend/img/rong.png')}}" alt="">
            <div style="height: 400px;"></div>
        </div>
        @endif
        <!-- kết thúc danh sách -->

    </div>

</div>
</div>

<script>
$(document).ready(function() {
    $('alo').click(function(event) {
        alert('clm')
        var bien = $('bla').val();
        $.ajax({
            method: 'post',
            url: '{{url("/test")}}',
            data: bien,
            // other AJAX settings goes here
            // ..
            success: function(request) {
                alert(request)
            }
        });
        //event.preventDefault(); // <- avoid reloading
    });
});
</script>

@endsection