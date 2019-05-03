{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Thông tin website')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

    <div class="container-fluid">
        <div class="row">

            {{--  Phần chức năng phản hồi.  --}}
            <div class="col-md-8">

                @if ($errors->first('errorlogin') != "")
                    <label>
                        <span class="glyphicon glyphicon-exclamation-sign">
                        <b class='text-danger'>{{ $errors->first('errorlogin') }}</b>
                    </label>
                @endif

                @if (session()->has('ketqua_xuly'))
                    <div class="alert alert-success" id="success-alert">
                        <span class="glyphicon glyphicon-ok"></span>
                        <strong>{{ session('ketqua_xuly') }}</strong>                                
                  </div>
                @endif

                <legend><i class="fa fa-envelope" aria-hidden="true"></i>Hộp thư góp ý</legend>
                <div class="well well-sm">
                    
                    <form action="feedback" method="POST" onsubmit="showModal();">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                 
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Tên người phản hồi</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ tên" required="required" value="{{ \Session::get('name_login') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Địa chỉ email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email" required="required" value="{{ \Session::get('email_login') }}" /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Chủ đề</label>
                                <select id="subject" name="subject" class="form-control" required="required">
                                    <option value="chỉnh sửa" selected="">Góp ý</option>
                                    <option value="báo lỗi">Báo lỗi</option>
                                    <option value="yêu cầu chức năng">Yêu cầu chức năng mới</option>
                                    <option value="khác">Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Tin nhắn</label>
                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                    placeholder="Nhập tin nhắn cần gửi"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                Gửi phản hồi
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            {{--  Phần thông tin website  --}}
            <div class="col-md-4">
                <form>
                <legend><span class="glyphicon glyphicon-globe"></span>Thông tin trang web</legend>
                <blockquote>
                    <p>Website xếp thời khóa biểu online được xây dựng cho sinh viên Đại học Cần thơ. 
                    Hệ thống phục vụ cho việc xây dựng các thời khóa biểu trực quan nhầm hỗ trợ cho quá trình đăng ký học phần được dễ dàng hơn.</p>
                    <footer>Admin</footer>
                </blockquote>
                <address>
                    <strong>Phiên bản<br>1.0</strong>
                </address>
                <address>
                    <strong>Email</strong><br>
                    <a href="mailto:#">thoikhoabieu.ctu@gmail.com</a>
                </address>
                <address>
                    <strong>Facebook</strong><br>
                    <a href="https://www.facebook.com/xeptkb.ctu/" target="_blank">www.facebook.com/xeptkb.ctu</a>
                </address>
                </form>
            </div>
        </div>
    </div>

@endsection