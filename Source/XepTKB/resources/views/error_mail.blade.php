{{--  Mở rộng cho trang khách  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Lỗi gửi mail')

{{--  Phần nội dung sẽ dẫn vào trang khách  --}}
@section('noidung')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h2 class="text-center text-danger">Có lỗi trong quá trình gửi mail xác nhận</h2>
                        <i class="fa fa-frown-o fa-5x text-danger" aria-hidden="true"></i>
                        <div class="panel-body">

                            {{--  Nếu mail thất bại từ chức năng đăng ký  --}}
                            @if ($mail_type == "dangky")
                                <form id="send_mail" action="send_mail" class="form" method="post">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="email" id="email" class="form-control" value="{{ $email }}">
                                            <input type="hidden" name="name" id="name" class="form-control" value="{{ $name }}">
                                            <input type="hidden" name="mail_type" id="mail_type" class="form-control" value="{{ $mail_type }}">
                                        </div>
                                    </div>

                                    <div id="slow_warning" style="display:none" class="text-center text-success">
                                        <i class="fa fa-spinner fa-spin" style="font-size:60px"></i>
                                        <b style="font-size:36px">Đang xử lý</b>
                                    </div>

                                    <div class="form-group">                                        
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                                            <i class="fa fa-repeat" aria-hidden="true"></i>
                                            Thử lại
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <a class="form-control btn btn-danger" href="login">Về trang đăng nhập</a>
                                    </div>
                                </form>

                                <script>
                                    $("#send_mail").submit(function (e) { 
                                        $("#slow_warning").show();
                                        $(".btn").prop('disabled', true);
                                    });
                                </script>
                            @endif

                            {{--  Nếu mail thất bại từ chức năng quên mật khẩu  --}}
                            @if ($mail_type == "quenmk")

                                {{--  Script import jquery validate  --}}
                                <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

                                {{--  Script validate dữ liệu đăng ký --}}
                                <script src="{{ asset('js/validate_quenmk.js') }}"></script>

                                <form id="form_quenmk" action="lost_pass" class="form" method="post">
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                                    @if ($errors->first('errorlogin') != "")
                                        <label>
                                            <b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
                                        </label>
                                    @endif
        
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" autofocus placeholder="Nhập email sinh viên" class="form-control" type="email"
                                            required value="{{ $email }}">
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

                                    <input type="hidden" name="mail_type" id="mail_type" class="form-control" value="{{ $mail_type }}">
        
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
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection