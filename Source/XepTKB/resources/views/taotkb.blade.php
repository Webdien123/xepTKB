{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Tạo thời khóa biểu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

    {{--  Đặt màu cho cột thứ và tiết thời khóa biểu  --}}
    <script>
        $(document).ready(function () {
            $('th, td').addClass("text-center");
        });
    </script>

    {{--  Đặt style cho dấu gạch cách môn cùng lịch nhưng không cùng tuần học  --}}
    <style>
        hr.line_hocphan {
            margin-top: 4px;
            margin-bottom: 4px;
            width: 100%;
            border: 0.25px dashed black;
        }

        .vcenter {
            vertical-align: middle !important;
        }

        #tb-tkb td:not(:first-child){
            width: 16%;
        }
        
    </style>

    <?php
        $url = "https://dkmh2.ctu.edu.vn/tracuu/DANHSACHHOCPHANMOHK2_17_18.XLS";
        $headers = @get_headers($url);
        if(strpos($headers[0],'404') === false)
        {
            echo "URL Exists";
        }
        else
        {
            echo "URL Not Exists";
        }
    ?>

    <div class="container-fluid">
        
        {{--  Phần hiển thị tên trang và học kì hiện tại  --}}
        <div class="row text-success">
            <div class="col-xs-4">
                <h4><b>Tạo thời khóa biểu mới</b></h4>
            </div>

            <div class="col-xs-8 text-right">
                <h4><strong>Học kì hiện tại: Học kì 2, 2017-2018</strong></h4>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>            
        </div>

        {{--  Modal thêm lớp học phần  --}}
        <div class="modal fade" id="modal-them-hp">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-success"><b>Thêm học phần vào TKB</b></h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="" method="POST" class="form-inline" role="form">
                        
                            <div class="form-group">
                                <label for="" class="text-success">Nhập mã HP:</label>
                                <input type="text" class="form-control" id="" placeholder="Mã HP">
                            </div>
                        
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Tìm
                            </button>
                        </form>
                        <h4><b class="text-danger">Học phần không mở cho học kì này</b></h4>

                        <div class="text-success">
                            <i class="fa fa-spinner fa-spin" style="font-size:72px"></i>
                            <b style="font-size:36px">Đang load dữ liệu</b>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã HP</th>
                                        <th>Tên học phần</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mã nè</td>
                                        <td>Tên nè</td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                Thêm
                                            </button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-luu-hp">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Lưu thời khóa biểu</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
        

        {{--  Modal xác nhận xóa tất cả HP  --}}
        <div class="modal fade" id="modal-xoatc-hp">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-danger"><b>Cảnh báo</b></h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row text-danger">
                            <div class="col-xs-2 text-center">
                                <i class="fa fa-exclamation-circle" aria-hidden="true" style="font-size:72px"></i>
                            </div>
                            <div class="col-xs-10" style="font-size:30px">
                                Bạn chắc chắn xóa hết học phần trong TKB này?
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        
                        <a class="btn btn-danger" href="#" role="button">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            Có
                        </a>
                        
                        <button type="button" class="btn btn-info" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Không
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            {{--  Phần chọn lớp học phần  --}}
            <div class="col-xs-12 col-lg-4 col-lg-push-8">

                <h3>Học phần</h3>

                {{--  Nhóm button thao tác menu học phần  --}}
                <div class="btn-group">
                    <button type="button" class="btn btn-success" data-toggle="modal" href='#modal-them-hp'>
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Thêm HP
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="modal" href='#modal-luu-hp'>
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Lưu TKB
                    </button>

                    <button type="button" class="btn btn-danger" data-toggle="modal" href='#modal-xoatc-hp'>
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Xóa tất cả HP
                    </button>                                      
                </div>                
                
                {{--  Bảng chọn lớp học phần  --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th>Mã HP</th>
                                <th>Tên HP</th>
                                <th>Ký hiệu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            {{--  Dòng hiển thị khi chưa có lớp học phần được chọn  --}}
                            {{--  <tr>
                                <td colspan="4" class="text-center"><b><i>
                                    Chưa có lớp HP nào được chọn
                                </i></b>                                    
                                </td>
                            </tr>  --}}

                            {{--  Các dòng hiển thị khi đã có lớp học phần  --}}
                            <tr class="bg-danger">
                                <td>
                                    CN117
                                </td>
                                <td>
                                    Phương pháp tính - Kỹ thuật
                                </td>
                                <td>
                                    <select name="" id="" required="required">
                                        <option value="" selected>H01</option>
                                    </select>
                                    
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>


                            <tr class="bg-success">
                                <td>
                                    CN118
                                </td>
                                <td>
                                    Nguyên lý kiến trúc
                                </td>
                                <td>
                                    <select name="" id="" required="required">
                                        <option value="" selected>H02</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>


                            <tr class="bg-info" style="color: rgb(252, 9, 219)">
                                <td>
                                    CN154
                                </td>
                                <td>
                                    Cơ học kết cấu
                                </td>
                                <td>
                                    <select name="" id="" required="required" style="color: black">
                                        <option value="" selected>H01</option>
                                        <option value="">H02</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="bg-warning">
                                <td>
                                    CN349
                                </td>
                                <td>
                                    Kết cấu bê-tông công trình dân dụng
                                </td>
                                <td>
                                    <select name="" id="" required="required">
                                        <option value="" selected>H02</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    CN510
                                </td>
                                <td>
                                    Đồ án nền móng công trình<br>
                                    <span class="text-danger">(Liên hệ GV để xếp lịch)</span>
                                </td>
                                <td>
                                    <select name="" id="" required="required">
                                        <option value="" selected>H01</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="bg-info">
                                <td>
                                    CN514
                                </td>
                                <td>
                                    Quản lý dự án xây dựng
                                </td>
                                <td>
                                    {{--  <select name="" id="" style="color: black" required="required">  --}}
                                    <select name="" id="" required="required">
                                        <option value="" selected>H01</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-large btn-block btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-danger"><b>
                    Lịch họp cố vấn vào lúc 4h 10 chiều thứ 4 tuần 3, 6, 9, 11
                </b></div>
                
            </div>

            {{--  Phần minh họa thời khóa biểu khi thêm lớp học phần  --}}
            <div class="col-xs-12 col-lg-8 col-lg-pull-4">
                <h3>
                    Thời khóa biểu minh họa
                </h3>
                {{--  Bảng thể hiện thời khóa biểu  --}}
                <div class="table-responsive">
                    <table id="tb-tkb" class="table table-bordered table-condensed">
                        <thead>
                            <tr class="info">
                                <th></th>
                                <th>Thứ 2</th>
                                <th>Thứ 3</th>
                                <th>Thứ 4</th>
                                <th>Thứ 5</th>
                                <th>Thứ 6</th>
                                <th>Thứ 7</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    
                                </td>
                                <td>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="bg-danger vcenter" rowspan="3">
                                    <span>Phương pháp tính - Kỹ thuật <br> (331/QP)</span>
                                </td>
                                <td></td>
                                <td class="bg-success vcenter" rowspan="3">
                                    <span>Nguyên lý kiến trúc <br> (105/HA)</span>
                                </td>
                                <td class="bg-warning vcenter" rowspan="4">
                                    <span>Kết cấu bê-tông công trình dân dụng <br> (334/QP)</span>
                                </td>
                                <td></td>
                                <td class="bg-info vcenter" rowspan="3">
                                    <span >Quản lý dự án xây dựng <br> (103/HA)</span><br>
                                    <span class="text-danger">(Tuần 11->17)</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="vcenter bg-info" rowspan="3">
                                    <span style="color: rgb(252, 9, 219)">Cơ học kết cấu <br> (103/HA)</span><br>
                                    <span class="text-danger">(Tuần 1->10)</span>

                                    <hr class="line_hocphan">

                                    <span>Quản lý dự án xây dựng <br> (111/HA)</span><br>
                                    <span class="text-danger">(Tuần 11->17)</span>
                                </td>
                                <td class="bg-info vcenter" rowspan="3">
                                    <span style="color: rgb(252, 9, 219)">Cơ học kết cấu <br> (103/HA)</span><br>
                                    <span class="text-danger">(Tuần 1->10)</span>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </div>   
@endsection