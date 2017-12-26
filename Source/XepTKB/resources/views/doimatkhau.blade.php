{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Đổi mật khẩu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

<div class="container">        
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Đổi mật khẩu</h3>
                </div>
                <div class="panel-body">
                    
                    <form action="" method="POST" role="form">                    
                        <div class="form-group">
                            <label for="">Mật khẩu hiện tại</label>
                            <input type="text" class="form-control" id="" placeholder="Nhập mật khẩu hiện tại">
                        </div>                    
                        
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <input type="text" class="form-control" id="" placeholder="Nhập mật khẩu mới">
                        </div>

                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu mới</label>
                            <input type="text" class="form-control" id="" placeholder="nhập lại mật khẩu mới">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">OK</button>
                        
                    </form>
                    
                     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection