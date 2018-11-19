@extends('layouts.master')
@section('content')

    {{-- Start section / Import css --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"
          xmlns="http://www.w3.org/1999/html">

    {{-- End import css --}}
    <div class="newpost" id="newpost">
        <div class="vipcontainer">
            <div class="row">
                {{-- Begin left ads --}}
                <div class="col-sm-2 hidden-xs ads">
                    <ul class="list-unstyled">
                        <li>
                            <a href="">
                                <div class="card">
                                    <img class="card-img-top img-rounded img-responsive"
                                         src="/EE/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="card">
                                    <img class="card-img-top img-rounded img-responsive"
                                         src="/EE/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="card">
                                    <img class="card-img-top img-rounded img-responsive"
                                         src="/EE/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="card">
                                    <img class="card-img-top img-rounded img-responsive"
                                         src="/EE/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="card">
                                    <img class="card-img-top img-rounded img-responsive"
                                         src="/EE/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="card">
                                    <img class="card-img-top img-rounded img-responsive"
                                         src="/EE/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- End left / Begin content posts --}}
                <div class="col-md-7 contentpost">
                    {{-- Begin icon view --}}
                    <div class="row" id="icon-view">
                        @foreach ($posts as $element)
                            <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="/EE/images/ads.jpg" alt="...">
                                <div class="caption">
                                    <h5 style="word-wrap: break-word;">{{$element->post_title}}</h5>
                                    <p>Ngày đăng : {{date("d-m-Y", strtotime($element->created_at))}}</p>  
                                </div>
                                <div class="text-center">
                                    <a href="/edit-post/{{$element->id}}" class="btn btn-primary" role="button">Sửa</a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- End content posts --}}
                <div class="col-sm-3 right-banner-ads" style="">
                    <div class="categorys" style="height: 10rem; background-color: #CCCCCC;">
                        Banner ADS
                    </div>
                </div>
                {{-- <div class="col-sm-3 right-banner-posts" style="display: none">
                    <div class="categorys" style="height: 10rem; background-color: #CCCCCC;">
                        <table>
                            <tbody>
                            <tr>
                                <td><a href="{{route('worker_detailposts')}}">Tìm người giúp việc</a></td>
                            </tr>
                            <tr>
                                <td><a href="{{route('worker_detailposts')}}">Tìm thợ hàn</a></td>
                            </tr>
                            <tr>
                                <td><a href="{{route('worker_detailposts')}}">Tìm thợ xây dựng</a></td>
                            </tr>
                            <tr>
                                <td><a href="{{route('worker_detailposts')}}">Tìm người ship hàng</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- End section --}}
@endsection
{{-- Page Javascript --}}

<script type="text/javascript" src="{{asset('themeEE/frontend/js/jquery.min.js')}}"></script> 

{{-- <script src="{{ asset('themeEE/frontend/js/mapAPI.js') }}"></script> --}}


