{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Quản lý tkb')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')

    {{--  Đặt margin giữa các thời khóa biểu thu nhỏ  --}}
    <style>
        .top-buffer { 
            margin-top: 5%; 
        }
        .left-buffer { 
            margin-left: 4%;
        }
        .tkb{
            background-color: darkgray
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
            <a href="">
                <div class="col-xs-12 col-md-5 top-buffer left-buffer tkb">
                    <img src="{{ asset('/tkb_img/1_2-17-18.png') }}" class="img-responsive" alt="Image">
                </div>
            </a>

            <a href="">
                <div class="col-xs-12 col-md-5 top-buffer left-buffer tkb">
                    <img src="{{ asset('/tkb_img/1_2-17-18.png') }}" class="img-responsive" alt="Image">
                </div>
            </a>

            <a href="">
                <div class="col-xs-12 col-md-5 top-buffer left-buffer tkb">
                    <img src="{{ asset('/tkb_img/1_2-17-18.png') }}" class="img-responsive" alt="Image">
                </div>
            </a>

            <a href="">
                <div class="col-xs-12 col-md-5 top-buffer left-buffer tkb">
                    <img src="{{ asset('/tkb_img/1_2-17-18.png') }}" class="img-responsive" alt="Image">
                </div>
            </a>

            <a href="">
                <div class="col-xs-12 col-md-5 top-buffer left-buffer tkb">
                    <img src="{{ asset('/tkb_img/1_2-17-18.png') }}" class="img-responsive" alt="Image">
                </div>
            </a>
        </div>
    </div>


    {{--  PHẦN CHỤP ẢNH FILE VÀ LƯU FILE BẰNG AJAX  --}}

    {{--  <div class="container" id="ddd">
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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

    <script src="{{ asset('js/html2canvas.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            html2canvas($("#ddd")[0]).then(function(canvas) {
                var Img_url = canvas.toDataURL("image/jpg");
                $("#a").attr("src", Img_url);
            
                var imagedata = canvas.toDataURL('image/png');
                var imgdata = imagedata.replace(/^data:image\/(png|jpg);base64,/, "");

                var token = "{{ csrf_token() }}";

                //ajax call to save image inside folder
                $.ajax({
                    url: '/save_tkb_img',
                    data: {
                        imgdata: imgdata,
                        id_tkb: "1",
                        hocki: "2",
                        namhoc: "17-18",
                        _token: token
                    },
                    type: 'POST',
                    success: function (response) {
                        console.log("Lưu ảnh thành công, kết quả: " + response);
                    },
                    error: function(xhr,err){
                        console.log("Lưu ảnh thất bại");
                        console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                    }
                });
                
            });
        });
        
    </script>  --}}

    {{--  KẾT THÚC PHẦN CHỤP ẢNH BẰNG AJAX  --}}


@endsection