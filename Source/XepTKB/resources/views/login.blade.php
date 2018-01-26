{{--  Mở rộng cho trang khách  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Đăng nhập')

{{--  Phần nội dung sẽ dẫn vào trang khách  --}}
@section('noidung')

    {{--  Script import jquery validate  --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    {{--  Script validate dữ liệu đăng ký --}}
    <script src="{{ asset('js/validate_login_form.js') }}"></script>

    {{--  Script xử lý 2 thông báo thành công hoặc thất bại khi cập nhật  --}}
    <script src="{{ asset('js/thong_bao.js') }}"></script>

    <!-- Form đang nhập -->  
    <div class="container">        
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                    <form role="form" id="form_login" action="login_process" class="form" method="post">
                        <legend>Đăng nhập</legend>

                        {{ csrf_field() }}

                        @if ($errors->first('errorlogin') != "")
                            <label>
                                <b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
                            </label>
                        @endif

                        @if ($ketqua_xuly)
                            <div class="alert alert-success" id="success-alert">
                                <strong>{{ $ketqua_xuly }}</strong>                                
                          </div>
                        @endif
                        
                        <?php
                            $mssv_old = '';
                            if ($mssv_xac_thuc){
                                $mssv_old = $mssv_xac_thuc;
                            }
                            else{
                                $mssv_old = old('mssv');
                            }
                        ?>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" autofocus required class="form-control" 
                                id="mssv" name="mssv" placeholder="Mã số sinh viên"
                                value="{{ $mssv_old }}">
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" required class="form-control" id="password" name="password" placeholder="Mật khẩu">
                            </div>
                        </div>

                        <script>
                            $(document).ready(function () {
                                if ( $( "#mssv" ).val() != "") {
                                    $( "#password" ).focus();
                                }
                            });
                        </script>
    
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