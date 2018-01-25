{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Đổi mật khẩu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

{{--  Script import jquery validate  --}}
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

{{--  Script validate dữ liệu đăng ký --}}
<script src="{{ asset('js/validate_doimk.js') }}"></script>

<div class="container">        
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Đổi mật khẩu</h3>
                </div>
                <div class="panel-body">
                    
                    <form action="change_pass" id="form_doimk" method="POST">
                        {{ csrf_field() }}
                        
                        @if ($errors->first('errorlogin') != "")
                            <label>
                                <b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
                            </label>
                        @endif

                        <div class="form-group">
                            <label for="">Mật khẩu hiện tại</label>
                            <input type="password" autofocus class="form-control" id="old_pass" name="old_pass" placeholder="Nhập mật khẩu hiện tại">
                        </div>                    
                        
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Nhập mật khẩu mới">
                        </div>

                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="r_new_pass" name="r_new_pass" placeholder="nhập lại mật khẩu mới">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">OK</button>
                        
                    </form>                     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection