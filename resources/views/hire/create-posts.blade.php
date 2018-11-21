@extends('layouts.master')
@section('content')
<?php use Symfony\Component\HttpFoundation\Session\Session; $session = new Session();?>
<?php $auth = $session->get('auth');?>
    <link rel="stylesheet" type="text/css" href="{{ asset('EE/css/dropzone.css') }}">
    <style type="text/css">
        #img-fb{
            position: absolute!important;
        }
    </style>
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
                        <input type="text" class="form-control" id="name" name="name" value=""
                               placeholder="Ex. Bùi Huy Khương">
                    </div>
                </div>

            </div>
            {{-- end  --}}

            {{-- input phone --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label  class="lbl">Điện thoại</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                    </div>
                    <div class="col-sm-11" style="padding-left: 0px;padding-right: 0px;">
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="phonezone" name="phonezone" value=""
                                   placeholder="Ex. +84">
                        </div>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="phone" name="phone" value=""
                                   placeholder="Ex. 9768052285">
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
                    <div class="col-sm-11 form-group contact" style="padding-left: 0px;padding-right:0px">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <img class="img-social" id="img-fb" src="/EE/images/icon-facebook.png" style="width: 34px">
                                <input type="text" class="form-control ipt-social" id="facebook" name="facebook"
                                       value=""
                                       placeholder="Ex. facebook.com/buihuykhuong">
                            </div>
                            <div class="col-xs-6">
                                <img class="img-social" id="img-gmail" src="/EE/images/gmail.png" style="width: 34px">
                                <input type="text" class="form-control ipt-social" id="gmail" name="gmail" value=""
                                       placeholder="Ex. huykhuong@gmail.com">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end --}}

            {{-- input location/address --}}
            <div class="form-group address">
                <div class="row">
                    <div class="col-sm-1">
                        <label class="lbl">Vị trí</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                    </div>
                    <div class="col-sm-11">
                        <input id="autocomplete" class="form-control" name="address" placeholder="Ex. 54 Nguyễn Thị Minh Khai, Q.1, TP HCM" type="text">
                        <div class="map-canvas" id="map-canvas" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
            {{-- end --}}

            {{-- input title post --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label  class="lbl">Tiêu đề</label>&nbsp
                    </div>
                    <div class="col-sm-11">
                        <span class="msg-item" id="msg_phone"></span>
                        <input type="text" class="form-control" name="title" id="title"
                               placeholder="Ex. Tuyển thợ cắt cỏ">
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
                    <div class="col-sm-11 img-upload ">
                        <div id="dropzone">
                            <form action="" class="dropzone needsclick dz-clickable" id="demo-upload">
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
                        <label  class="lbl">Nội dung</label>&nbsp
                    </div>
                    <div class="col-sm-11">
                        <span class="msg-item" id="msg_phone"></span>
                        <textarea class="form-control" rows="10" id="content" name="content"
                                  placeholder="Nhập nội dung bài đăng"></textarea>
                    </div>
                </div>


            </div>
            {{-- end --}}

            {{-- button --}}
            <div class="form-group">
                <label class="col-sm-2">&nbsp;</label>
                <div class="col-sm-10 divbutton">
                    <button type="button" class="btn btn-primary pull-right" onclick='create_post()' style="margin-left: 20px;">Hoàn
                        tất
                    </button>
                    <button type="button" class="btn btn-warning pull-right">Hủy bỏ</button>
                </div>
            </div>
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
                zoom: 13
            });
            if (navigator.geolocation) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        sessionStorage.setItem("lat", position.coords.latitude);
                        sessionStorage.setItem("lng", position.coords.longitude);
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        var geocoder = new google.maps.Geocoder;
                        var latlng = new google.maps.LatLng(geolocation.lat, geolocation.lng);
                        geocoder.geocode({'latLng': latlng}, function(results, status) {
                            if (status === google.maps.GeocoderStatus.OK) {
                                if (results[1]) {
                                    console.log(results[0]);
                                    sessionStorage.setItem("address", results[0].formatted_address);
                                    console.log( results[0].formatted_address);
                                    var map = new google.maps.Map(document.getElementById('map-canvas'), {
                                        center: {lat: position.coords.latitude, lng: position.coords.longitude},
                                        zoom: 17
                                    });
                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: results[0].geometry.location
                                    });
                                    $('#autocomplete').val(results[0].formatted_address);
                                } else {
                                    alert('No results found');
                                }
                            } else {
                                alert('Geocoder failed due to: ' + status);
                            }
                        });
                    });
                } 
            }
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                return;
                }
                console.log(place);
                sessionStorage.setItem("address", place.formatted_address);
                if (place.geometry.viewport) {
                   var map = new google.maps.Map(document.getElementById('map-canvas'), {
                        center: {lat: place.geometry.viewport.l.j, lng: place.geometry.viewport.j.j},
                        zoom: 17
                    });
                   var marker = new google.maps.Marker({
                        map: map,
                        position: {lat: place.geometry.viewport.l.j, lng: place.geometry.viewport.j.j}
                    });
                    sessionStorage.setItem("lat", place.geometry.viewport.l.j);
                    sessionStorage.setItem("lng", place.geometry.viewport.j.j);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.

                }
                // marker.setPosition(place.geometry.location);
            });
        }
    </script>
    <script type="text/javascript">
        var img = ' <?php echo json_encode($session->get('upl')); ?>';
        $("#dropzone").dropzone({
            url : '/upload',
            addRemoveLinks: true,
        });
        function  create_post()  {
            var lat = sessionStorage.getItem("lat");
            var lng = sessionStorage.getItem("lng");
            var address = sessionStorage.getItem("address");
            sessionStorage.removeItem('lat');
            sessionStorage.removeItem('lng');
            sessionStorage.removeItem('address');
            var info = {};
            $(".msg-item").html("");
            info.name           = $('#name').val();
            info.phone_zone     = $('#phonezone').val();
            info.phone          = $('#phone').val();
            info.facebook       = $('#facebook').val();
            info.gmail          = $('#gmail').val();
            info.location       = {lat : lat,lng : lng};
            info.address        = address;
            info.title          = $('#title').val();
            info.content        = $('#content').val();
            info.media          = img;
            info.user_id        = {{$auth->id}};
            $.ajax('{{ route('hire_storeposts') }}', {
                type: 'POST',
                data: {'data': info, '_token': '{{ csrf_token() }}'},
                async: false,
                success: function (results) {
                    console.log(results);
                    if (results['status'] = 400) {
                        swal({
                            title: "",
                            text: "Có lỗi xảy ra",
                            icon: "error",
                        });
                    }
                    if (results['status'] = 200) {
                        swal('Thành công','Đăng tin thành công !','success');
                        setTimeout(function () {
                            location.href = "{{ route('hire_listposts') }}";
                        }, 1500);
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
