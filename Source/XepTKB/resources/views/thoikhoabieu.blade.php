{{--  Mở rộng cho trang admin  --}}
@extends('admin')

{{--  Đặt title webpage  --}}
@section('title', 'Xếp thời khóa biểu')

{{--  Phần nội dung sẽ dẫn vào trang admin  --}}
@section('noidung')
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                Trang thời khóa biểu
            </div>
        </div>
    </div>

    <style>
        .top-buffer { 
            margin-top: 20px; 
        }
        .left-buffer { 
            margin-left: 4%;
        }
    </style>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 top-buffer col-sm-offset-1" style="border: 1px solid red">
                <img id="a" src="#" class="img-responsive" alt="Image">        
            </div>
        </div>
    </div>

    
    <div class="table-responsive" id="ddd">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>A</th>
                    <th>A</th>
                    <th>A</th>
                    <th>A</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>a</td>
                    <td>a</td>
                    <td>a</td>
                    <td>a</td>
                </tr>
            </tbody>
        </table>
    </div>
    

    <script src="{{ asset('js/html2canvas.min.js') }}"></script>

    <script>
        html2canvas($("#ddd")[0]).then(function(canvas) {
            $("#ddd-out").append(canvas);
            $("#a").attr("src", canvas.toDataURL());
        });
    </script>


@endsection