<!DOCTYPE htm>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        @include('import')

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
                <a class="navbar-brand" href="/">Xếp thời khóa biểu CTU</a>
            </div>
            
            <div class="collapse navbar-collapse button-menu">
                <ul class="nav navbar-nav ">

                @if (\Session::get('name_login'))

                    @if (strpos ($_SERVER['REQUEST_URI'], 'taotkb'))
                        {!! '<li><a href="taotkb" 
                            style="color: #ffcc80; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            TẠO TKB MỚI
                        </a></li>' !!}
                        
                    @else
                        {!! '<li><a href="taotkb">TẠO TKB MỚI</a></li>' !!}
                    @endif

                    @if (strpos ($_SERVER['REQUEST_URI'], 'qly_tkb'))
                        {!! '<li><a href="qly_tkb" 
                            style="color: #ffcc80; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            TKB CỦA TÔI
                        </a></li>' !!}
                        
                    @else
                        {!! '<li><a href="qly_tkb">TKB CỦA TÔI</a></li>' !!}
                    @endif
                
                @endif 

                    @if (strpos ($_SERVER['REQUEST_URI'], 'thongtin'))
                        {!! '<li><a href="thongtin" 
                            style="color: #ffcc80; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            THÔNG TIN, LIÊN HỆ
                        </a></li>' !!}
                    @else
                        {!! '<li><a href="thongtin">THÔNG TIN, LIÊN HỆ</a></li>' !!}
                    @endif 
                </ul>
                
                @if (\Session::get('name_login'))

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> 
                            <strong>{{ \Session::get('name_login') }}</strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <span class="glyphicon glyphicon-user icon-size"></span>
                                            </p>
                                        </div>

                                        <!-- Nội dung khi đã đăng nhập -->
                                        <div class="col-lg-8">
                                            <p class="text-left"><strong>{{ \Session::get('name_login') }}</strong></p>
                                            <p class="text-left small">{{ \Session::get('email_login') }}</p>
                                            <p class="text-left">
                                                <a href="logout" class="btn btn-primary btn-block btn-sm">
                                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                    Đăng xuất
                                                </a>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="doi_mk" class="btn btn-danger btn-block">Đổi mật khẩu</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>

                @endif            
            </div>
        </nav>

        <!-- Dẫn nội dung trang web con tương ứng -->
        @yield('noidung')

        <!-- Footer trang web -->
        <div class="container-fluid">
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