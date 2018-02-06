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
                    <li><a href="thongtin">THÔNG TIN, LIÊN HỆ</a></li>                    
                </ul>                   
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
                    <a href="https://www.facebook.com/bootsnipp" target="_blank"><i class="fa fa-facebook-square fa-3x social"></i></a>
                </div>
            <hr />
        </div>
        
    </body>
</html>