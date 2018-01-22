<!DOCTYPE htm>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang đăng ký</title>

        @include('import')

        {{--  Script import jquery validate  --}}
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

        {{--  Script validate dữ liệu đăng ký --}}
        <script src="{{ asset('js/validate_dky_taikhoan.js') }}"></script>

    </head>
    <body>

        <!-- Header trang web -->
        <nav class="navbar navbar-default nav-menu">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".button-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/login">Xếp thời khóa biểu CTU</a>
            </div>

            <div class="collapse navbar-collapse button-menu">
                <ul class="nav navbar-nav ">
                    <li><a href="thongtin">THÔNG TIN, LIÊN HỆ</a></li>
                </ul>                  
            </div>
        </nav>

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

		<!-- Footer trang web -->
        <div class="container">
			<hr />
				<div class="text-center center-block">
					<p class="txt-railway">- Hệ thống hỗ trợ xếp thời khóa biểu sinh viên CTU -</p>
					<br />
					<a href="https://www.facebook.com/bootsnipp"><i class="fa fa-facebook-square fa-3x social"></i></a>
					<a href="https://plus.google.com/+Bootsnipp-page"><i class="fa fa-google-plus-square fa-3x social"></i></a>
				</div>
			<hr />
		</div>
		
	</body>
</html>