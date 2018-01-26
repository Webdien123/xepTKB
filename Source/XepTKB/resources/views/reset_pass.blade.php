{{--  Mở rộng cho trang admin  --}}
@extends('guest')

{{--  Đặt title webpage  --}}
@section('title', 'Reset mật khẩu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

{{--  Script import jquery validate  --}}
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

{{--  Script validate dữ liệu đăng ký --}}
<script src="{{ asset('js/validate_reset_mk.js') }}"></script>

<div class="container">        
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Reset mật khẩu</h3>
                </div>
                <div class="panel-body">
                    
                    <form action="reset_pass_process" id="form_reset_mk" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if ($errors->first('errorlogin') != "")
                            <label>
                                <b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
                            </label>
                        @endif
                        
                        <input type="hidden" name="mssv" class="form-control" value="{{ $errors->first('mssv') }}">
                        
                        <div class="form-group">
                            <label for="">Mã số đặt mật khẩu</label>
                            <input type="text" autofocus class="form-control" id="pass_num" name="pass_num" placeholder="Nhập mã số hiện tại">
                        </div>                    
                        
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu mới">
                        </div>

                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="r_pass" name="r_pass" placeholder="nhập lại mật khẩu mới">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">OK</button>
                        </div>

                        <div class="form-group">
                            <a class="form-control btn btn-danger" href="login">Về trang đăng nhập</a>
                        </div>
                    </form>                     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection