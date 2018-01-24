{{--  Mở rộng cho trang khách  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Đăng nhập')

{{--  Phần nội dung sẽ dẫn vào trang khách  --}}
@section('noidung')

    {{--  Đặt màu cho phần form đăng nhập  --}}
    <style>
        .input-group-addon {
            color: #fff;
            background: #3276B1;
        }
    </style>

    <!-- Form đang nhập -->  
    <div class="container">        
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                    <form role="form" class="form">
                        <legend>Đăng nhập</legend>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" autofocus class="form-control" id="uLogin" placeholder="Mã số sinh viên">
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" id="uPassword" placeholder="Mật khẩu">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <button class="form-control btn btn-primary" type="submit">OK</button>
                        </div>
    
                        <div class="form-group">
                            <a class="form-control btn btn-danger" href="dk_taikhoan">Đăng ký tài khoản</a>
                        </div>

                        <div class="form-group">
                            <a class="form-control btn btn-link" href="quen_mk">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>   

@endsection