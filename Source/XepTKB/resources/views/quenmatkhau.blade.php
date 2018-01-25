{{--  Mở rộng cho trang admin  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Quên mật khẩu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

	{{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script validate dữ liệu đăng ký --}}
    <script src="{{ asset('js/validate_quenmk.js') }}"></script>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-sm-offset-4">
				<div class="panel panel-default">
				<div class="panel-body">
					<div class="text-center">
						<h3><i class="fa fa-lock fa-4x"></i></h3>
						<h2 class="text-center">Quên mật khẩu?</h2>
						<p>Nhập email sinh viên của bạn để lấy lại mật khẩu.</p>
						<div class="panel-body">

						<form id="form_quenmk" action="lost_pass" class="form" method="post">
							{{ csrf_field() }}

							@if ($errors->first('errorlogin') != "")
								<label>
									<b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
								</label>
							@endif

							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
								<input id="email" name="email" autofocus placeholder="Nhập email sinh viên" class="form-control" type="email"
								required>
							</div>
						
							<h4 id="email_ctu" class="text-danger">Vui lòng nhập email do trường cung cấp</h4>
							<script>
								function hide_email_err() {
									
									mail = $("#email").val();
									if (mail != ""){
										if (mail.indexOf("ctu.edu.vn") == -1){
											$("#email_ctu").show(0);
										}
										else {
											$("#email_ctu").hide(0);
										}
									}
								}
							</script>
							</div>

							<div id="slow_warning" style="display:none" class="text-center text-success">
								<i class="fa fa-spinner fa-spin" style="font-size:60px"></i>
								<b style="font-size:36px">Đang xử lý</b>
							</div>

							<div class="form-group">
								<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Lấy lại mật khẩu" type="submit">
							</div>

							<div class="form-group">
								<a class="form-control btn btn-danger" href="login">Về trang đăng nhập</a>
							</div>							
						</form>

						<script>
							$("#form_quenmk").submit(function (e) { 
								if ($("#form_quenmk").valid()) {
									mail = $("#email").val();
									if (mail != ""){
										if (mail.indexOf("ctu.edu.vn") == -1){
											$("#slow_warning").hide();
											$(".btn").prop('disabled', false);
										}
										else {
											$("#slow_warning").show();
											$(".btn").prop('disabled', true);
										}
									}
								} else {
									$("#slow_warning").hide();
									$(".btn").prop('disabled', false);
								}
							});
						</script>
		
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

@endsection