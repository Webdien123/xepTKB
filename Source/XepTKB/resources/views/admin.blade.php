<!DOCTYPE htm>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">

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
                        {!! '<li><a href="/taotkb" 
                            style="color: #ffcc80; padding-bottom:25px; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            TẠO TKB MỚI
                        </a></li>' !!}
                    @else
                        {!! '<li><a href="/taotkb">TẠO TKB MỚI</a></li>' !!}
                    @endif

                    @if (strpos ($_SERVER['REQUEST_URI'], 'edit_tkb'))
                        {!! '<li><a href='.$_SERVER["REQUEST_URI"].'\ 
                            style="color: #ffcc80; padding-bottom:25px; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            Cập nhật thời khóa biểu
                        </a></li>' !!}
                    @endif

                    @if (strpos ($_SERVER['REQUEST_URI'], 'qly_tkb'))
                        {!! '<li><a href="/qly_tkb" 
                            style="color: #ffcc80; padding-bottom:25px; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            TKB CỦA TÔI
                        </a></li>' !!}
                        
                    @else
                        {!! '<li><a href="/qly_tkb">TKB CỦA TÔI</a></li>' !!}
                    @endif
                
                @endif 

                    @if (strpos ($_SERVER['REQUEST_URI'], 'thongtin'))
                        {!! '<li><a href="/thongtin" 
                            style="color: #ffcc80; padding-bottom:25px; border-bottom: #ffcc80 solid 5px;
                            font-weight: bold">
                            THÔNG TIN, LIÊN HỆ
                        </a></li>' !!}
                    @else
                        {!! '<li><a href="/thongtin">THÔNG TIN, LIÊN HỆ</a></li>' !!}
                    @endif 
                </ul>
                
                @if (\Session::get('name_login'))

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="" id="img_profile_1" class="img-responsive img-circle" style="height: 32px; width: 32px; display: inline;">
                            <strong>{{ \Session::get('name_login') }}</strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="" id="img_profile_2" class="img-responsive img-rounded" style="width: 100%; display: inline;">
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
                                        <div class="col-sm-12">
                                            <p>
                                                <form id="f_upload_avt" method="POST" action="/upload_avt" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_uname_avt" id="_uname_avt" value="{{ \Session::get('mssv_login') }}">
                                                    <input type="file" id="selectedFile" name="img_avt" style="display: none;" accept="image/x-png,image/gif,image/jpeg">
                                                    <button type="button" class="btn btn-success btn-block" id="btn_upload_avt">
                                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                                        Cập nhật ảnh đại diện
                                                    </button>
                                                </form>

                                                <!-- Xử lý cập nhật avt -->
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($) {
                                                        // Click nút đổi avatar.
                                                        $("#btn_upload_avt").click(function(event) {
                                                            $("#selectedFile").click();
                                                        });

                                                        // Xử lý sau khi nhận file avt mới.
                                                        $("#selectedFile").change(function(event) {
                                                            if ($("#selectedFile").val() != "") {
                                                                $("#f_upload_avt").submit();    
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </p>
                                            <p>
                                                <a href="doi_mk" class="btn btn-danger btn-block">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                Đổi mật khẩu</a>
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

        <!-- Load avt người dùng -->
        <script type="text/javascript">
            jQuery(document).ready(function($) {
            
                var avt_profile = '{{ url("/") }}' + "/avt/" + '{{ \Session::get("mssv_login") }}' + ".png";
                $("#img_profile_1").attr('src', avt_profile);

                $("#img_profile_1").on('error', function(){
                    if ( $(this).attr("src").indexOf("png") != -1 ) {
                        $(this).unbind("error").attr("src", $(this).attr("src").replace("png", "jpg"));
                    }
                    $("#img_profile_1").on('error', function(){
                        if ( $(this).attr("src").indexOf("jpg") != -1 ) {
                            $(this).unbind("error").attr("src", $(this).attr("src").replace("jpg", "gif"));
                        }
                        $("#img_profile_1").on('error', function(){
                            $(this).unbind("error").attr("src", "../avt/no_avt.png");
                        });
                    });
                });

                $("#img_profile_2").attr('src', avt_profile);

                $("#img_profile_2").on('error', function(){
                    if ( $(this).attr("src").indexOf("png") != -1 ) {
                        $(this).unbind("error").attr("src", $(this).attr("src").replace("png", "jpg"));
                    }
                    $("#img_profile_2").on('error', function(){
                        if ( $(this).attr("src").indexOf("jpg") != -1 ) {
                            $(this).unbind("error").attr("src", $(this).attr("src").replace("jpg", "gif"));
                        }
                        $("#img_profile_2").on('error', function(){
                            $(this).unbind("error").attr("src", "../avt/no_avt.png");
                        });
                    });
                });
            });
        </script>

        <!-- Dẫn nội dung trang web con tương ứng -->
        @yield('noidung')

        @include('footer')
        
    </body>
</html>