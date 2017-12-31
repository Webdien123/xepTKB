{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Quên mật khẩu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Quên mật khẩu?</h2>
                  <p>Nhập email sinh viên của bạn để lấy lại mật khẩu.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                        <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            <input id="email" name="email" autofocus placeholder="Nhập email sinh viên" class="form-control"  type="email">
                        </div>
                        </div>
                        <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Lấy lại mật khẩu" type="submit">
                        </div>
                        
                        <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

@endsection