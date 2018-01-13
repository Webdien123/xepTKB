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

    {{--  Đặt style cho thời khóa biểu minh họa  --}}
    <link rel="stylesheet" href="{{ asset('css/tkb_minh_hoa.css') }}">

    {{--  Đặt màu cho các môn học   --}}
    <link rel="stylesheet" href="{{ asset('css/to_mau_hp.css') }}">

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

    {{--  Script tạo biến cục bộ js và xử lý ban đầu khi trang khởi động  --}}
    <script>
        // Lưu trữ token.
        var token = "{{ csrf_token() }}";

        // Lưu học phần vừa thêm gần nhất.
        var hp_vua_them = null;

        // Lưu tất cả học phần đã thêm.
        var ds_hp = [];
    </script>

    {{--  Script xử lý tìm thông tin học phần.  --}}
    <script src="{{ asset('js/tim_hp.js') }}"></script>

    {{--  Script xử lý trang tạo thời khóa biểu.  --}}
    <script src="{{ asset('js/tao_tkb.js') }}"></script>    

    {{--  Nội dung trang tạo tkb.  --}}
    <div class="container-fluid">
        
        {{--  Phần hiển thị tên trang và học kì hiện tại.  --}}
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

        {{--  Modal thêm lớp học phần.  --}}
        <div class="modal fade" id="modal-them-hp">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-success"><b>Thêm học phần vào TKB</b></h4>
                    </div>
                    <div class="modal-body">
                        
                        {{--  Form tìm kiếm học phần  --}}
                        <form id="f_tim_hp" class="form-inline">
                        
                            <div class="form-group">
                                <label for="" class="text-success">Nhập mã HP:</label>
                                <input type="text" required class="form-control" 
                                    id="mahp_input" placeholder="Mã HP"
                                    oninvalid="this.setCustomValidity('Chưa nhập mã HP')"
                                    oninput="setCustomValidity('')">
                            </div>
                        
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Tìm
                            </button>
                        </form>

                        {{--  Thông báo đang tìm HP  --}}
                        <div class="text-success" id="finding_hp">
                            <i class="fa fa-spinner fa-spin" style="font-size:72px"></i>
                            <b style="font-size:36px">Đang load dữ liệu</b>
                        </div>

                        {{--  Thông báo không tìm thấy HP  --}}
                        <h4 id="not_found_hp"><b class="text-danger">
                            Học phần không mở trong học kì này.
                        </b></h4>

                        {{--  Bảng thông tin HP đã tìm thấy  --}}
                        <div class="table-responsive" id="found_hp">
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
                                        <td id="mahp_tim"></td>
                                        <td id="tenhp_tim"></td>
                                        <td>
                                            <button type="button" class="btn btn-success"
                                                onclick="them_hp()">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                Thêm
                                            </button>
                                        </td>
                                    </tr>
                                    <tr id="error_trung_hp">
                                        <td colspan="3">
                                            <b class="text-danger">
                                                Học phần đã thêm trước đó.
                                            </b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{--  Thông báo có lỗi trong quá trình tìm HP  --}}
                        <h4 id="error_found_hp"><b class="text-danger">
                            Máy chủ đang có vấn đề, vui lòng thử lại sau.
                        </b></h4>
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

        {{--  Modal lưu thời khóa biểu.  --}}
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
        
        {{--  Modal xác nhận xóa tất cả HP.  --}}
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
                        
                        <a class="btn btn-danger" id="btn_xoa_all_hp" href="#" role="button" data-dismiss="modal">
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

        {{--  Phần thêm học phần và tkb minh họa.  --}}
        <div class="row">

            {{--  Nhóm nút chọn lớp học phần và bảng học phần  --}}
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
                    <table class="table table-bordered" id="tb_hp">
                        <thead>
                            <tr class="info">
                                <th>Mã HP</th>
                                <th>Tên HP</th>
                                <th>Sỉ số</th>
                                <th>Ký hiệu</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            {{--  Dòng hiển thị khi chưa có lớp học phần được chọn  --}}
                            <tr id="tr_no_hp">
                                <td colspan="5" class="text-center"><b><i>
                                    Chưa có lớp HP nào được chọn
                                </i></b>                                    
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

                <script>
                    // $(document).ready(function () {

                        // function doilich() {                            
                        
                        //     // Tính số tiết của HP cần xóa khỏi thời khóa biểu.
                        //     sotiet =  $("#CT111").attr("rowspan");

                        //     // Tính tr chứa tiết đầu tiên.
                        //     console.log($("#CT111").parent());

                        //     // console.log(sotiet);

                        //     for (let index = 0; index < sotiet - 1; index++) {
                        //         console.log("Xoa tiet");
                        //     }
                        // }
                    // });
                </script>


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
                            <tr class="tr_tiet_hoc">
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
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
                            <tr class="tr_tiet_hoc">
                                <td>6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
                                <td>7</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
                                <td>8</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
                                <td>9</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
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
                            <tr class="tr_tiet_hoc">
                                <td>11</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="tr_tiet_hoc">
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