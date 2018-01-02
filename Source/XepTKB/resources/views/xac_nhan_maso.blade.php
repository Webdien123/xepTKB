{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Xác nhận mã số')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

    <div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-sm-offset-4">
				<div class="panel panel-default">
				<div class="panel-body">
					<div class="text-center">
						<h4 class="text-center">Một email xác nhận đã gửi vào địa chỉ mail của bạn</h4>
						<p>Kiểm tra mail rồi nhập mã số đã nhận để tiếp tục</p>
						<div class="panel-body">

						<form id="register-form" role="form" autocomplete="off" class="form" method="post">

							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-random" aria-hidden="true"></i></span>
								<input id="email" name="email" autofocus placeholder="Nhập mã số xác nhận" class="form-control"  type="email">
							</div>
							</div>
							<div class="form-group">
								<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Kích hoạt tài khoản" type="submit">
							</div>
							
							<input type="hidden" class="hide" name="token" id="token" value=""> 
						</form>
		
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

@endsection