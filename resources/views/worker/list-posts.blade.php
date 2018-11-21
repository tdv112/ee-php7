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
                                         src="/themeEE/frontend/images/ads.jpg" alt="Card image cap">
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
                                         src="/themeEE/frontend/images/ads.jpg" alt="Card image cap">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- End left / Begin content posts --}}
                <div class="col-md-7 contentpost">
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-1">
                                <div id="google_translate_element"></div>
                            </div>
                            <div class="col-sm-7 pull-right">
                                <div class="form-group pull-right">
                                    <button class="btn" onclick="mapview()"><i class="fas fa-map-marked-alt"></i></button>
                                    <button class="btn" onclick="listview()"><i class="fas fa-list-alt"></i></button>
                                    <button class="btn" onclick="iconview()"><i class="fas fa-th"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- Begin icon view --}}
                    <div class="row" id="icon-view"  style="display: none">
                        @foreach ($posts as $element)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="/EE/images/ads.jpg" alt="...">
                                    <div class="caption">
                                        <h5 style="word-wrap: break-word;">{{$element->post_title}}</h5>
                                        <p>Người đăng : {{$element->name}}</p>
                                        <p class="gr-btnds">
                                            <a href="#" class="btn btn-primary btn-login" role="button">Button</a>
                                            <a href="#"class="btn btn-default btn-ds"role="button">Button</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{-- End icon view / Begin list view --}}
                    <div class="row" id="list-view">
                        <form class="form-horizontal" id="frm_posts" action="" method="">
                            <div class="form-group contact">
                                <div class="col-md-1">
                                    <label class="lbl">Vị trí</label>&nbsp
                                </div>
                                <div class="col-md-11">
                                    <input type="hidden" id="lat" name="lat">
                                    <input type="hidden" id="lng" name="lng">
                                    <input id="autocomplete" class="form-control" name="address" placeholder="Ex. 54 Nguyễn Thị Minh Khai, Q.1, TP HCM" type="text" value="{{$address}}">
                                    <div class="map-canvas" id="map-canvas" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                            <div class="cleafix"></div>
                            <div class="form-group">
                                <div class="col-md-1">
                                    <label class="lbl">Tìm kiếm</label>&nbsp
                                </div>
                                <div class="col-md-11 inner-addon">
                                    <span class="msg-item" id="msg_phone"></span>
                                    <button type="submit" class="btn btn-default search" style="color: white;"><i class="fa fa-search" style="font-size: 16px"></i> Tìm kiếm
                                    </button>
                                    <input type="text" class="form-control" name="search" id="search"
                                           placeholder="Ex. Tuyển thợ cắt cỏ" value="{{$keyword}}">
                                </div>
                            </div>
                            <div class="form-group row-list">
                                <div class="col-md-1">
                                    <label class="lbl">Danh sách</label>&nbsp
                                </div>
                                <div class="col-md-11">
                                    <span class="msg-item" id="msg_phone"></span>
                                    <div class="categorys">
                                        <table id="list-table" class="table">
                                            <tbody>
                                            @foreach ($posts as $element)
                                                <tr class="let">
                                                    <td>
                                                        <a style="font-weight: bold; " href="../thue-lao-dong/tin/{{$element->id}}">{{$element->post_title}}</a><br>
                                                        <p class="sh-content">{{$element->post_content}}</p>
                                                    </td>
                                                    <td style="width: 60px"><small class="pull-right time-post">{{date("d-m-Y", strtotime($element->created_at))}}</small></td>
                                                </tr>
                                            @endforeach
                                            @if (count($posts) == 0)
                                                <tr>
                                                    <td>
                                                        Không tìm thấy tin đăng nào
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <div class="col-md-12 ">
                                        {{ $posts->links() }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- End icon view / Begin map view --}}
                    <div class="row" id="map-view" style="display: none">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6112189693436!2d106.6919210148006!3d10.764416592329638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f14284504b1%3A0x91f90800d80e5738!2zMTM2IEPDtCBC4bqvYywgUGjGsOG7nW5nIEPDtCBHaWFuZywgUXXhuq1uIDEsIEjhu5MgQ2jDrSBNaW5o!5e0!3m2!1svi!2s!4v1539019392525" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    {{-- End tab view --}}
                </div>
                {{-- End content posts --}}
                <div class="col-sm-3 right-banner-ads" style="">
                    <div class="categorys" style="height: 10rem; background-color: #CCCCCC;">
                        Banner ADS
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End section --}}
@endsection
{{-- Page Javascript --}}
<script type="text/javascript" src="{{asset('EE/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    function mapview(){
        $('#list-view').hide();
        $('#icon-view').hide();
        $('#map-view').show();
        // $('.right-banner-posts').hide();
        // $('.right-banner-ads').show();
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?onview=map';
        window.history.pushState({ path: newurl }, '', newurl);
    }
    function listview(){
        $('#icon-view').hide();
        $('#map-view').hide();
        $('#list-view').show();
        // $('.right-banner-posts').show();
        // $('.right-banner-ads').hide();
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?onview=list';
        window.history.pushState({ path: newurl }, '', newurl);
    }
    function iconview(){
        $('#list-view').hide();
        $('#map-view').hide();
        $('#icon-view').show();
        // $('.right-banner-posts').hide();
        // $('.right-banner-ads').show();
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?onview=icon';
        window.history.pushState({ path: newurl }, '', newurl);
    }
</script>
<script type="text/javascript">
    function initialize(){
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {lat: {{$lat}}, lng: {{$lng}} },
            zoom: 8
        });
        $.ajax({
            url: '{{route("location")}}',
            type: 'GET',
            data: {address : '{{$address}}', '_token': '{{ csrf_token() }}'},
            dataType: 'JSON',
            async: false,
            success: function (result) {
                if(result.status == 200){
                    for (var i = 0; i<= result.post.length-1 ; i++){
                        var location = JSON.parse(result.post[i].location);
                        console.log(parseFloat(location.lat));
                        console.log(parseFloat(location.lng));
                        var marker = new google.maps.Marker({
                            map: map,
                            position: {lat: parseFloat(location.lat), lng: parseFloat(location.lng)}
                        });
                    }
                }
            }
        });
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            console.log(place);
            if (place.geometry.viewport) {
                var map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: {lat: place.geometry.viewport.l.j, lng: place.geometry.viewport.j.j},
                    zoom: 8
                });
                $.ajax({
                    url: '{{route("location")}}',
                    type: 'GET',
                    data: {address : place.formatted_address, '_token': '{{ csrf_token() }}'},
                    dataType: 'JSON',
                    async: false,
                    success: function (result) {
                        if(result.status == 200){
                            for (var i = 0; i<= result.post.length-1 ; i++){
                                var location = JSON.parse(result.post[i].location);
                                console.log(parseFloat(location.lat));
                                console.log(parseFloat(location.lng));
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: {lat: parseFloat(location.lat), lng: parseFloat(location.lng)},
                                    title: result.post[i].post_title +' | '+ result.post[i].name
                                });
                                marker.addListener('click', function() {
                                    map.setZoom(8);
                                    map.setCenter(marker.getPosition());
                                });
                            }
                        }
                    }
                });
                $('#lat').val(place.geometry.viewport.l.j);
                $('#lng').val(place.geometry.viewport.j.j);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.

            }
            // marker.setPosition(place.geometry.location);
        });
    }
</script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

