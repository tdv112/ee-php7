@extends('layouts.master')
@section('content')
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
<?php //$a =session()->get('tmp_social'); dd($a[0][0]); ?>
<div class="content home text-center" id="content">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="newpost">
                <a href="{{route('hire')}}" class="btn btn-workers btn-thue" style="line-height: 94px;">Thuê lao động</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="newpost">
                <a href="{{route('worker')}}" class="btn btn-workers btn-nld" style="line-height: 94px;">Người lao động</a>
            </div>
        </div>
    </div>
</div>

@endsection