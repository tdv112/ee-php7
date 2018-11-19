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
        {{-- input name --}}
        <div class="form-group">
            <div class="row">
                <div class="col-sm-1">
                    <label class="lbl">Họ tên</label>&nbsp<span class="msg-item" id="msg_name"></span>
                </div>
                <div class="col-sm-11">
                    <input type="text" class="form-control" id="name" name="name" value="{{$post->name}}"
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
                        <input type="text" class="form-control" id="phonezone" name="phonezone" value="{{$post->phone_area}}"
                               placeholder="Ex. +84">
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$post->phone}}"
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
                                   value="{{$post->facebook}}"
                                   placeholder="Ex. facebook.com/buihuykhuong">
                        </div>
                        <div class="col-xs-6">
                            <img class="img-social" id="img-gmail" src="/EE/images/gmail.png" style="width: 34px">
                            <input type="text" class="form-control ipt-social" id="gmail" name="gmail" value="{{$post->gmail}}"
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
                    <input id="autocomplete" class="form-control" name="address" placeholder="Ex. 54 Nguyễn Thị Minh Khai, Q.1, TP HCM" type="text" value="{{$post->address}}">
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
                           placeholder="Ex. Tuyển thợ cắt cỏ" {{$post->post_title}}>
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
                    <label  class="lbl">Nội dung</label>&nbsp
                </div>
                <div class="col-sm-11">
                    <span class="msg-item" id="msg_phone"></span>
                    <textarea class="form-control" rows="10" id="content" name="content"
                              placeholder="Nhập nội dung bài đăng">{{$post->post_content}}</textarea>
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
        var img = ' <?php echo json_encode($session->get('upl')); ?>';
        $("#dropzone").dropzone({
            url: "/upload",
            drop : true,
            maxFilesize: 2,
            acceptedFiles : 'image/*',
            accept: function(file, done) {
                console.log(done);
              }
        });

        var lat = sessionStorage.getItem("lat");
        var lng = sessionStorage.getItem("lng");
        var address = sessionStorage.getItem("address");
        function  create_post()  {
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
            console.log(info);
            $.ajax('/store-post/{{$post->id}}', {
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
                        swal('Thành công','Cập nhật tin thành công','success');
                        setTimeout(function () {
                            location.href = "/";
                        }, 1500);
                    }
                }
            });
        }

    </script>

@endsection
