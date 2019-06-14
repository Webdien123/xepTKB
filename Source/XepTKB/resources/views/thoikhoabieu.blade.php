{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Quản lý tkb')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

    {{--  Tùy chỉnh css cho các thời khóa biểu thu nhỏ  --}}
    <link rel="stylesheet" href="{{ asset('css/qly_tkb.css') }}">

    <?php
        $namhoc_1 =  (int)substr($namhoc_hientai, 0, 2);
        $namhoc_2 =  (int)substr($namhoc_hientai, 3, 2);
        $namhoc = "20" . $namhoc_1 . "-20" . $namhoc_2;
    ?>
    
    <div class="container-fluid">

        <!-- Debug -->
        <div id="result"></div>

        {{--  Modal thông báo kết quả.  --}}
        <div class="modal fade" id="success-alert" style="margin-top: 20%; text-align: center; z-index: 9999">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-body">
                        <strong id="alert-text"></strong>
                    </div>
                </div>
            </div>
        </div>  

        {{--  Phần hiển thị tên trang và học kì hiện tại  --}}
        <div class="row text-success">
            <div class="col-xs-12 col-sm-4">
                <h4><b>Các thời khóa biểu đã tạo</b></h4>
            </div>

            <div class="col-xs-12 col-sm-8">
                <h4 class="visible-sm visible-md visible-lg text-right"><strong>Học kì hiện tại: Học kì {{ $hki_hientai }}, {{ $namhoc }}</strong></h4>
                <h4 class="visible-xs"><strong>Học kì hiện tại: Học kì {{ $hki_hientai }}, {{ $namhoc }}</strong></h4>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>
        </div>

        <script type="text/javascript">

            var disable = false;

            // Thông báo kết quả xử lý cho người dùng.
            function thongBaoKetQua(result, text_content = null) {
                if (result == "ok") {
                    $('#success-alert').modal('toggle');
                    $("#alert-text").removeClass('text-danger').addClass('text-success');
                    $("#alert-text").html('<i style="font-size: 10em;"  class="fa fa-check-circle-o" aria-hidden="true"></i><br>' + text_content);
                    setTimeout(function() {$('#success-alert').modal('hide');}, 1500);
                }
                if (result == "fail") {
                    $('#success-alert').modal('toggle');
                    $("#alert-text").removeClass('text-success').addClass('text-danger');
                    if (text_content == null) {
                        $("#alert-text").html('<i style="font-size: 10em;" class="fa fa-frown-o" aria-hidden="true"></i><br>Có lỗi! vui lòng thử lại sau.');
                    }
                    else{
                        $("#alert-text").html('<i style="font-size: 10em;" class="text-warning fa fa-info-circle" aria-hidden="true"></i><br><span class="text-warning">' + text_content + '</span>');
                    }
                    setTimeout(function() {$('#success-alert').modal('hide');}, 1500);
                }
            }

            // Xử lý xóa tkb.
            function Xoa_TKB(stt) {
                // Tắt event click trên ảnh thời khóa biểu.
                disable = true;

                if(window.confirm('Xóa thời khóa biểu số ' + stt + '?')){
                    $.ajax({
                        type: "POST",
                        url: "/delete_tkb",
                        data: {
                            mssv: "{{ Session::get("mssv_login") }}",
                            _token: "{{ Session::token() }}",
                            stt: stt
                        },                    
                        success: function (response) {
                            thongBaoKetQua(response, "Đã xóa");
                            setTimeout(function () {
                               window.location.replace("/qly_tkb");
                            }, 800);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            thongBaoKetQua("fail");
                            var dom_nodes = $($.parseHTML(jqXHR.responseText));
                            var message = dom_nodes.find("p.trace-message").eq(0).text();
                            $('#result').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');
                        }
                    });
                }
            }

            $(document).ready(function() {

                // Hiện các nút thao tác khi rê chuột vào tkb.
                $(".tkb_items").mouseover(function(event) {
                    $(this).find('.btn-group').eq(0).css('display','inline');
                });

                // Ẩn các nút thao tác khi đưa chuột ra ngoài tkb.
                $(".tkb_items").mouseout(function(event) {
                    $(this).find('.btn-group').eq(0).css('display','none');
                });

                // Click trực tiếp lên tkb.
                $(".tkb_items").click(function(event) {
                    if (!disable) {
                        link = $(this).find('a').attr("href");
                        window.open(link); 
                    }
                    else{
                        disable = false;
                    }
                });

                // Click nút tạo bản in.
                $('.btn_print').click(function () {

                    // Tắt event click trên ảnh thời khóa biểu.
                    disable = true;

                    $("img.img_tkb").attr("width", "800px");
                    $("img.img_tkb").attr("height", "530px");

                    var doc = new jsPDF('l','pt','a4',true);

                    doc.setFontType("italic");
                    doc.setFontSize(15);
                    doc.setFont("times");
                    doc.text(35, 25, 'MSSV: {{ Session::get("mssv_login") }}');
                    doc.text(35, 45, 'Thoi khoa bieu hoc ki ' + "{{ $hki_hientai.' nam hoc '.$namhoc }}");
                    doc.text(35, 45, '____________________________________');
                    
                    doc.setFontSize(12);
                    doc.text(35, 590, '--- He thong xep thoi khoa bieu ctu ---');

                    doc.fromHTML($(this).closest(".tkb_items").html(), 35, 45, {
                      'width': 100
                    }, function (dispose) {
                        doc.save('{{Session::get("mssv_login")."_".$hki_hientai."_".$namhoc}}.pdf');
                    });

                    $("img.img_tkb").attr("width", "100%");
                    $("img.img_tkb").attr("height", "100%");
                });
            });
        </script>

        <div class="container-fluid">
            @if($so_luong_tkb == 0)
                <h3><center>Chưa có thời khóa biểu nào</center></h3>
            @else
            <ol class="timeline">
            @for ($i = 1; $i <= $so_luong_tkb; $i++)
            <li class="col-xs-8" style="margin-left: 50px">
                <div class="tkb_items" style="cursor: pointer;">
                    <div class="btn-group" style="position:absolute; top:0px; right:10px; display: none;">
                        <a href="/edit_tkb/{{$i}}" target="_blank" title="Chỉnh sửa TKB" class="btn btn-warning">
                            <i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <button type="button" title="Tạo bản in" class="btn btn-info btn_print">
                            <i class="fa fa-2x fa-print" aria-hidden="true"></i>
                        </button>
                        <button type="button" title="Xóa TKB" class="btn btn-danger btn_delete" 
                        onclick="Xoa_TKB('{{$i}}')">
                            <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>

                    <img src="{{ asset('/tkb_img/'.\Session::get('mssv_login').'/'.$i.'_'.$hki_hientai.'_'.$namhoc_hientai.'.png') }}" width="100%" class="img-responsive img_tkb" alt="Image">
                </div>
            </li>
            @endfor
            </ol>
            @endif
        </div>
    </div>

@endsection