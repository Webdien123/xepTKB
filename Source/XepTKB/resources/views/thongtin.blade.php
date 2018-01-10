{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Thông tin website')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Tên người phản hồi</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập họ tên" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Địa chỉ email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input type="email" class="form-control" id="email" placeholder="Nhập email" required="required" /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Chủ đề</label>
                                <select id="subject" name="subject" class="form-control" required="required">
                                    <option value="sj_chinhsua" selected="">Chỉnh sửa hệ thống</option>
                                    <option value="sj_baoloi">Báo lỗi</option>
                                    <option value="sj_yeucau">Yêu cầu chức năng</option>
                                    <option value="sj_khac">Khác</option>
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
            <div class="col-md-4">
                <form>
                <legend><span class="glyphicon glyphicon-globe"></span>Thông tin trang web</legend>
                <address>
                    <strong>Người thực hiện: Trần Lý Văn</strong><br>
                    KS ngành CNTT Đại học Cần Thơ<br>
                    Sinh viên K39 Đại học Cần Thơ<br>
                    
                </address>
                <address>
                    <strong>Email</strong><br>
                    <a href="mailto:#">lyvamax2018@gmail.com</a>
                </address>
                </form>
            </div>
        </div>
    </div>

@endsection