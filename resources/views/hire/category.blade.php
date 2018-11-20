@extends('layouts.master')
@section('content')
<div class="content workers text-center" id="content">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2" style="left: -90px;top: 20px;">
            <div id="google_translate_element"></div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="newpost">
				<a href="{{route('hire_createposts')}}" class="btn btn-workers btn-thue">Đăng tin</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="newpost">
				<a href="{{route('hire_listposts')}}" class="btn btn-workers btn-thue">Kho thông tin</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

@endsection
