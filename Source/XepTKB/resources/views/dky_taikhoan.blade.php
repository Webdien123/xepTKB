{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Tạo tài khoản')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4 ">
            <div class="panel-heading">
                <div class="panel-title text-center">
                        <h1 class="title">Đăng ký tài khoản</h1>
                        <hr />
                    </div>
            </div> 
            <div class="main-login main-center">
                <form class="form-horizontal" method="post" action="#">
                    
                    <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Họ tên</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" autofocus class="form-control" name="name" id="name"  placeholder="Nhập họ tên"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Email</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="email" id="email"  placeholder="Nhập email trường cấp"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="cols-sm-2 control-label">MSSV</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="username" id="username"  placeholder="Nhập MSSV"/>
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
                        <label for="confirm" class="cols-sm-2 control-label">Xác nhận mật khẩu</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Xác nhận mật khẩu"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="button" class="btn btn-primary btn-lg btn-block login-button">Đăng ký</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection