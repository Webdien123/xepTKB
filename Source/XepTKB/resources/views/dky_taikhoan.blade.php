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

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 ">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                            <h1 class="title">Đăng ký tài khoản</h1>
                            <hr />
                        </div>
                </div>
                @if ($errors->first('errorlogin') != "")
                    <label>
                        <b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
                    </label>
                @endif
                <div class="main-login main-center">

                    

                    <form class="form-horizontal" id="form_dki_tk" method="post" action="dangki_process">                        

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Họ tên</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" value="{{old('name')}}" autofocus class="form-control" name="name" id="name"  placeholder="Nhập họ tên"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Email sinh viên</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" value="{{old('email')}}" class="form-control" name="email" id="email"  placeholder="Nhập email do trường cấp"/>
                                </div>
                                <h4 id="email_ctu" class="text-danger">Vui lòng nhập email do trường cung cấp</h4>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="malop" class="cols-sm-2 control-label">Mã lớp</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-address-book" aria-hidden="true"></i></span>
                                    <input type="text" value="{{old('malop')}}" class="form-control" name="malop" id="malop"  placeholder="Nhập mã lớp"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mssv" class="cols-sm-2 control-label">MSSV</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" value="{{old('mssv')}}" class="form-control" name="mssv" id="mssv"  placeholder="Nhập MSSV"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Mật khẩu</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Nhập mật khẩu"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label">Nhập lại mật khẩu</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Nhập lại mật khẩu"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Đăng ký</button>
                        </div>

                        <div class="form-group">
                            <a class="form-control btn btn-danger" href="login">Về trang đăng nhập</a>
                        </div>
                    </form>
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