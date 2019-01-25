<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
	@include('import')
</head>
<body>
	<?php
        $namhoc_1 =  (int)substr($namhoc_hientai, 0, 2);
        $namhoc_2 =  (int)substr($namhoc_hientai, 3, 2);
        $namhoc = "20" . $namhoc_1 . "-20" . $namhoc_2;
    ?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Import - Export dữ liệu lớp học phần</a>
			</div>
		</div>
	</nav>
	{{--  Phần hiển thị tên trang và học kì hiện tại.  --}}
    <div class="row text-success">
        <div class="col-xs-12 col-sm-4">
            <h4><b>Tạo thời khóa biểu mới</b></h4>
        </div>

        <div class="col-xs-12 col-sm-8">
            <h4 class="visible-sm visible-md visible-lg text-right"><strong>Học kì tiếp theo: Học kì {{ $hki_hientai }}, {{ $namhoc }}</strong></h4>
            <h4 class="visible-xs"><strong>Học kì tiếp theo: Học kì {{ $hki_hientai }}, {{ $namhoc }}</strong></h4>
        </div>
        <div class="col-xs-12">
            <hr>
        </div>
    </div>

	<div class="container">
		<a href="{{ URL::to('/') }}"><button class="btn btn-success">
			<i class="fa fa-home" aria-hidden="true"></i>
			Home
		</button></a>
		<a href="{{ $link_file }}"><button class="btn btn-success">
			<i class="fa fa-download" aria-hidden="true"></i>
			Tải file lớp học phần
		</button></a>
		<?php
	    	$headers = @get_headers($link_file);
	        if(strpos($headers[0],'404') === false)
	        {
	            echo "<br><h2 class='text-danger'>Đã có lịch mới</h2>";
	        }
	        else
	        {
	        	echo "<br><h2 class='text-danger'>Chưa có lịch mới</h2>";
	        }
	    ?>
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" onsubmit="showModal();" class="form-horizontal" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="file" name="import_file" />
			<button class="btn btn-primary">Import File</button>
		</form>
	</div>
</body>
</html>