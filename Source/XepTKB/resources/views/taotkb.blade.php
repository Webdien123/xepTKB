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

                <div class="btn-group">
                    <button type="button" class="btn btn-success" data-toggle="modal" href='#modal-them-hp'>
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Thêm HP
                    </button>

                    <button type="button" class="btn btn-primary">
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
                            <tr>
                                <td colspan="4" class="text-center"><b><i>
                                    Chưa có lớp HP nào được chọn
                                </i></b>                                    
                                </td>
                            </tr>

                            {{--  Dòng hiển thị khi đã có lớp học phần  --}}
                            <tr>
                                <td>
                                    NS114
                                </td>
                                <td>
                                    Kỹ thuật các quá trình sinh học trong chế biến thực phẩm
                                </td>
                                <td>
                                    <select name="" id="" required="required">
                                        <option value="" selected>01</option>
                                        <option value="">02</option>
                                        <option value="">03</option>
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
                
            </div>

            {{--  Phần minh họa thời khóa biểu khi thêm lớp học phần  --}}
            <div class="col-xs-12 col-lg-8 col-lg-pull-4">

                <h3 class="text-center">
                    Thời khóa biểu minh họa
                </h3>

                {{--  Bảng thể hiện thời khóa biểu  --}}
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-condensed">
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
                                    NS114 (103/NN)
                                </td>
                                <td>NS114 (103/NN)</td>
                                <td></td>
                                <td>NS114 (103/NN)</td>
                                <td></td>
                                <td>NS114 (103/NN)</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td></td>
                                <td></td>
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