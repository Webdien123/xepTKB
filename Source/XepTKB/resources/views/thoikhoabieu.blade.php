{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Quản lý tkb')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')


    {{--  Đặt margin giữa các thời khóa biểu thu nhỏ  --}}
    <style>
        .top-buffer { 
            margin-top: 2%; 
        }
        .left-buffer { 
            margin-left: 5%;
        }
        @media only screen and (max-width: 992px) {
            .left-buffer { 
                margin-left: 0%;
            }
        }

        .timeline{
            position: relative;
        }

        /*Line*/
        .timeline>li::before{
            content:'';
            position: absolute;
            width: 1px;
            background-color: #33bbff;
            top: 0;
            bottom: 0;
            left:-19px;
        }

        /*Circle*/
        .timeline>li::after{
            text-align: center;
            padding-top:10px;
            z-index: 10;
            content:counter(item);
            position: absolute;
            width: 50px;
            height: 50px;
            border:3px solid white;
            background-color: #33bbff;
            border-radius: 50%;
            top:0;
            left:-43px;
        }

        /*Content*/
        .timeline>li{
            counter-increment: item;
            padding: 10px 10px;
            color: white;
            font-weight: bold;
            font-size: larger;
            margin-left: 0px;
            min-height:70px;
            position: relative;
            background-color: white;
            list-style: none;
        }
        
        .timeline>li:nth-last-child(1)::before{
            width: 0px;
        }

        .tkb_items:hover {
          border: 2px solid #33bbff; 
          padding-left: 20px;
          border-radius: 1%;
        }
    </style>

    <?php
        $namhoc_1 =  (int)substr($namhoc_hientai, 0, 2);
        $namhoc_2 =  (int)substr($namhoc_hientai, 3, 2);
        $namhoc = "20" . $namhoc_1 . "-20" . $namhoc_2;
    ?>
    
    <div class="container-fluid">
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

        <div class="row">
            @if($so_luong_tkb == 0)
                <h3><center>Chưa có thời khóa biểu nào</center></h3>
            @else
            <ol class="timeline col-xs-10 col-xs-offset-1">
            @for ($i = 1; $i <= $so_luong_tkb; $i++)
            <li>
                <div class="tkb_items">
                    <div class="btn-group" style="position:absolute; top:0px; right:10px; display: none;">
                        <button type="button" title="Chỉnh sửa TKB" class="btn btn-warning">
                            <i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" title="Tạo bản in" class="btn btn-info">
                            <i class="fa fa-2x fa-print" aria-hidden="true"></i>
                        </button>
                        <button type="button" title="Xóa TKB" class="btn btn-danger">
                            <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <img src="{{ asset('/tkb_img/'.\Session::get('mssv_login').'/'.$i.'_'.$hki_hientai.'_'.$namhoc_hientai.'.png') }}" class="img-responsive" alt="Image">
                </div>
            </li>
            @endfor
            </ol>
            @endif
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".tkb_items").mouseover(function(event) {
                    $(this).find('.btn-group').eq(0).css('display','inline');
                });

                $(".tkb_items").mouseout(function(event) {
                    $(this).find('.btn-group').eq(0).css('display','none');
                });
            });
        </script>
    </div>

@endsection