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
            @for ($i = 1; $i <= $so_luong_tkb; $i++)
            <a href="" style="margin-bottom:50px">
                <div class="col-xs-11 col-xs-offset-1">
                    <img src="{{ asset('/tkb_img/'.\Session::get('mssv_login').'/'.$i.'_'.$hki_hientai.'_'.$namhoc_hientai.'.png') }}" class="img-responsive" alt="Image">
                </div>
            </a>
            @endfor
            @endif
        </div>
    </div>

@endsection