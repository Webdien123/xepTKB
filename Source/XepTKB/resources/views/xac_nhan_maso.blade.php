{{--  Mở rộng cho trang khách  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Xác nhận email')

{{--  Phần nội dung sẽ dẫn vào trang khách  --}}
@section('noidung')

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-sm-offset-4">
				<div class="panel panel-default">
				<div class="panel-body">
					<div class="text-center">
						@if ($status != "Over")
						<h4 class="text-center">Tài khoản chưa được kích hoạt</h4>
						<h4 class="text-center">Một email xác nhận đã gửi vào địa chỉ mail trường của bạn</h4>
						<p>Kiểm tra mail rồi nhập mã số đã nhận để tiếp tục</p>
						<div class="panel-body">
						
						<form id="register-form" action="kich_hoat_account" class="form" method="post">

							{{ csrf_field() }}
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-random" aria-hidden="true"></i></span>
								<input id="maso" required name="maso" autofocus placeholder="Nhập mã số xác nhận" 
									class="form-control" type="text"
									oninvalid="this.setCustomValidity('Chưa nhập mã kích hoạt')"
									oninput="setCustomValidity('')">
								<input type="hidden" name="email" id="email" class="form-control" value="{{ $email }}">
							</div>
							</div>
							<div class="form-group">
								<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Kích hoạt tài khoản" type="submit">
							</div>

							<div class="form-group">
								<a class="form-control btn btn-danger" href="login">Về trang đăng nhập</a>
							</div>
						</form>
						@endif

						@if ($status == "Err")
							<h4 class="text-danger"><b>Mã số không đúng</h4>
						@endif

						@if ($status == "Over")
							<h4 class="text-danger"><b>
								Quá thời gian xác nhận, mã số đã bị xóa.</br>
								Đăng nhập để kích hoạt lại.
							</b></h4>
							<a class="form-control btn btn-danger" href="login">Đăng nhập</a>
						@endif
		
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

@endsection