@extends('layouts.master')
@section('content')

    <?php use Symfony\Component\HttpFoundation\Session\Session; $session = new Session();?>
    <?php $auth = $session->get('auth');?>
    <link rel="stylesheet" type="text/css" href="{{ asset('EE/css/dropzone.css') }}">
    <div class="newpost" id="newpost">

        {{-- Start left banner ads --}}
        <div class="col-md-2 hidden-xs ads">
            <div class="row">
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
        </div>
        {{-- end left banner ads --}}

        {{-- Start content --}}
        <div class="col-md-7 contentpost">
            <div class="form-group ">
                <div class="row">
                    <div class="col-sm-11 col-sm-offset-1">
                        <div id="google_translate_element"></div>
                    </div>
                </div>
            </div>
            {{-- input name --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Họ tên</label>&nbsp<span class="msg-item" id="msg_name"></span>
                    </div>
                    <div class="col-sm-11">
                        <input type="text" class="form-control"  style="border: 1px solid #fff;" value="{{$post->name}}" readonly>
                    </div>
                </div>

            </div>
            {{-- end  --}}

            {{-- input phone --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Điện thoại</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                    </div>
                    <div class="col-sm-11" style="padding-left: 0px;padding-right: 0px;">
                        <div class="col-xs-3">
                            <div class="show"><p class="show-content">{{$post->phone_area}}</p></div>
                        </div>
                        <div class="col-xs-9">
                            <div class="show"><p class="show-content">{{$post->phone}}</p></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}

            {{-- input contact --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Liên lạc</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                    </div>
                    <div class="col-sm-11 form-group" style="padding-left: 0px;padding-right:0px">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <img class="img-social" id="img-fb" src="/EE/images/icon-facebook.png" style="width: 34px">
                                <div class="show"><p class="show-content" style="padding-left: 44px!important;">{{$post->facebook}}</p></div>
                            </div>
                            <div class="col-xs-6">
                                <img class="img-social" id="img-gmail" src="/EE/images/gmail.png" style="width: 34px">
                                <div class="show"><p class="show-content" style="padding-left: 44px!important;">{{$post->gmail}}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end --}}

            {{-- input location/address --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Vị trí</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                    </div>
                    <div class="col-sm-11">
                        <div class="show"><p class="show-content">{{$post->address}}</p></div>
                        <div class="map-canvas" id="map-canvas" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
            {{-- end --}}

            {{-- input title post --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Tiêu đề</label>&nbsp
                    </div>
                    <div class="col-sm-11">
                        <span class="msg-item" id="msg_phone"></span>
                        <div class="show"><p class="show-content">{{$post->post_title}}</p></div>
                    </div>
                </div>

            </div>
            {{-- end --}}

            {{-- input image --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Đính kèm</label>
                    </div>
                    <div class="col-sm-11 img-upload">
                        <div id="dropzone">
                            <form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="dz-message needsclick">
                                    <small>Nhấp vào để tải ảnh lên</small><br> <small>(Hoặc kéo ảnh vào đây)</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            {{-- end --}}

            {{-- input content post --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Nội dung</label>&nbsp
                    </div>
                    <div class="col-sm-11">
                        <span class="msg-item" id="msg_phone"></span>
                        <div class="show" style="height: 165px!important;"><p class="show-content">{{$post->post_content}}</p></div>
                    </div>
                </div>


            </div>
            {{-- end --}}

            {{-- button --}}
            {{-- end --}}
        </div>
        {{-- End content --}}

        {{-- Start right banner ads --}}
    <!-- <div class="col-md-2">
            <div class="form-group">
                <div class="categorys" style="background-color: #cccccc; min-height: 100px;">
                    <small class="text-center">BANNER ADS</small>
                </div>
            </div>
        </div> -->
        {{-- End right banner ads--}}
    </div>
    {{-- @import script --}}
    <script type="text/javascript" src="{{asset('EE/js/jquery.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('EE/js/dropzone.js')}}"></script>
    {{-- @endimport script --}}
    <script type="text/javascript">
        function initialize(){
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat: 10.762622, lng: 106.660172},
                zoom: 17
            });
            $.ajax('{{ route('get_location_post') }}', {
                type: 'GET',
                data: {'data': {{$post->id}}, '_token': '{{ csrf_token() }}'},
                async: false,
                success: function (results) {
                    if (results['status'] = 200) {
                        var thislocation = JSON.parse(results['location']);
                        var lat = parseFloat(thislocation.lat);
                        var lng = parseFloat(thislocation.lng);
                        var map = new google.maps.Map(document.getElementById('map-canvas'), {
                            center: {lat: lat, lng: lng},
                            zoom: 17
                        });
                        var marker = new google.maps.Marker({
                            map: map,
                            position: {lat: lat, lng: lng}
                        });
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endsection
