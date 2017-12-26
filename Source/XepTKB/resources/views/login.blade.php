<!DOCTYPE htm>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang đăng nhập</title>

        @include('import')

        {{--  Đặt màu cho phần admin form đăng nhập  --}}
        <style>
            .input-group-addon {
                color: #fff;
                background: #3276B1;
            }
        </style>

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
                <a class="navbar-brand" href="#">Xếp thời khóa biểu CTU</a>
            </div>

            <div class="collapse navbar-collapse button-menu">
                <ul class="nav navbar-nav ">
                    <li><a href="#">THÔNG TIN, LIÊN HỆ</a></li>
                </ul>                  
            </div>
        </nav>

        <!-- Form đang nhập -->  
        <div class="container">        
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                    <form role="form" class="form">
                        <legend>Đăng nhập</legend>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="uLogin" placeholder="Mã số sinh viên">
                                <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="uPassword" placeholder="Mật khẩu">
                                <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <button class="form-control btn btn-primary" type="submit">Ok</button>
                        </div>
    
                        <div class="form-group">
                            <a class="form-control btn btn-danger" href="">Đăng ký tài khoản</a>
                        </div>

                        <div class="form-group">
                            <a class="form-control btn btn-link" href="">Quên mật khẩu?</a>
                        </div>
                    </form>
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