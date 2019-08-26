{{--  Định nghĩa trang thông tin cán bộ  --}}
@extends('guest')

{{--  Tiêu đề trang  --}}
@section('title', 'Báo lỗi')

{{--  Định nghĩa phần import vào layout cha  --}}
@section('noidung')

	<h1 class="text-center text-danger">{{ $mes }}</h1>

	<center><img src="<?php echo asset('imgs/sad.png')?>" class="img-responsive" alt="Image"></center>

	<h3 class="text-center"><b>{!! $re !!}</b></h3>
	
	<h3 class="text-center">
		Bấm vào
		<a onclick="window.history.back();">đây</a>		
		để thử lại. Hoặc  
		<a href="{{ route('home') }}">về trang chủ</a>
		để thực hiện chức năng khác.
	</h3>
@endsection