@extends('frontend.layouts.master')
@section('content')
<div class="content workers text-center" id="content">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="newpost">
				<a href="{{route('worker_createposts')}}" class="btn btn-workers btn-nld">Đăng tin</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
				<div class="newpost">
				<a href="{{route('worker_listposts')}}" class="btn btn-workers btn-nld">Kho thông tin</a>
			</div>
		</div>
	</div>
</div>
@endsection