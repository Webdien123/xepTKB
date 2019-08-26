{{--  Mở rộng cho trang khách  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Đăng ký')

{{--  Phần nội dung sẽ dẫn vào trang khách  --}}
@section('noidung')

    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script validate dữ liệu đăng ký --}}
    <script src="{{ asset('js/validate_dky_taikhoan.js') }}"></script>

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

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                                <input type="text" value="{{old('email')}}" 
                                class="form-control" name="email" id="email"  placeholder="Nhập email do trường cấp"
                                onchange="hide_email_err()"/>
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

                    <div id="slow_warning" style="display:none" class="text-center text-success">
                        <i class="fa fa-spinner fa-spin" style="font-size:60px"></i>
                        <b style="font-size:36px">Đang xử lý</b>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Đăng ký</button>
                    </div>

                    <div class="form-group">
                        <a class="form-control btn btn-danger" href="login">Về trang đăng nhập</a>
                    </div>
                </form>

                <script>
                    $("#form_dki_tk").submit(function (e) { 
                        if ($("#form_dki_tk").valid()) {
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

@endsection