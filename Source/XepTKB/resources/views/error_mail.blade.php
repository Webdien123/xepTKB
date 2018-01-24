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
                        <h2 class="text-center text-danger">Có lỗi trong quá trình gửi mail</h2>
                        <i class="fa fa-frown-o fa-5x text-danger" aria-hidden="true"></i>
                        <div class="panel-body">

                            @if ($mail_type == "dangky")
                                <form id="send_mail" action="send_mail" class="form" method="post">                                
                            @endif

                                <div class="form-group">
                                    <div class="input-group">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="email" id="email" class="form-control" value="{{ $email }}">
                                        <input type="hidden" name="name" id="name" class="form-control" value="{{ $name }}">
                                        <input type="hidden" name="mail_type" id="mail_type" class="form-control" value="{{ $mail_type }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        <i class="fa fa-repeat" aria-hidden="true"></i>
                                        Thử lại
                                    </button>
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