<!DOCTYPE htm>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang đăng nhập</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Header css -->
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">

        <!-- Footer css -->
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

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
                    <form role="form">
                        <legend>Đăng nhập</legend>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="uLogin" placeholder="Login">
                                <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="uPassword" placeholder="Password">
                                <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <button class="form-control btn btn-primary" type="submit">Ok</button>
                        </div>
    
                        <div class="form-group">
                            <a class="form-control btn btn-danger" href="">Đăng ký tài khoản</a>
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