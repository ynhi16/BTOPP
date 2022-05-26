@extends('layout')
@section('trangchu')

<style>
	.btn-den {
		background-color: black;
		color: white;
		height: 45px;
		border-radius: 5px;
		font-size: 16px;
	}

	.btn-vienden {
		background-color: black;
		color: white;
		height: 45px;
		border-radius: 5px;
		font-size: 16px;
	}

	.tab-khongchon {
		text-decoration: none;
		padding-top: 10px;
	}

	.tab-khongchon:hover {
		text-decoration: none;
		color: black;
		font-size: 18px;
	}

	.tab-duocchon {
		text-decoration: none;
		padding-top: 10px;
	}

	.tab-duocchon:hover {
		text-decoration: none;
		color: white;
		font-size: 18px;
	}
</style>


<body>
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h2>Thiết lập tài khoản</h2>

				<!-- bắt đầu menu ngang -->
				<div class="row" style="margin-top: 70px;">
					<a class="tab-khongchon" href="{{URL::to('/canhan')}}">Thông tin cá nhân</a>
					<a class="btn-vienden tab-duocchon" href="{{URL::to('/matkhau')}}">Đổi mật khẩu</a>
				</div> <!-- kết thúc menu ngang -->

				<hr>

				<?php

				$tbcanhan = Session::get('capnhat');
				if ($tbcanhan) {
					echo $tbcanhan;
					Session::put('capnhat', '');
				}
				?>

				<!-- bắt đầu phần điền mật khẩu -->
				<form action="{{URL::to('/capnhat-mk')}}" method="post">
					@csrf
					<div class="row" style="margin-top: 50px;">

						<label for="pwd"><strong>Mật khẩu hiện tại</strong></label>
                                                <input type="password" class="form-control input-canhan" name="mkcu" style="width:35%;margin: 5px 0px 10px 13px;">
						<label for="pwd"><strong>Mật khẩu mới</strong></label>
						<input type="password" class="form-control input-canhan" name="mkmoi" style="width:35%;margin: 5px 0px 10px 13px;">
						<label for="pwd"><strong>Nhập lại mật khẩu</strong></label>
						<input type="password" class="form-control input-canhan" name="mkmoi2" style="width:35%;margin: 5px 0px 10px 13px;">

                                        </div>
                                        <!-- kết thúc phần điền mật khẩu -->

					<div class="row" style="margin-top: 70px;">
						<button type="submit" class="btn-den btn-luu">Lưu thay đổi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>

@endsection