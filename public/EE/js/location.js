// jQuery(document).ready(function () {
//  if(jQuery('#map-canvas')){
        var currentPositionMarker,curPos;
        // Cô Bắc
        var center = new google.maps.LatLng(lat, lng);
        var geocoder;
        // Hà Nội
        // var center = new google.maps.LatLng(21.027764, 105.83416);

        var map, options, infowindow, marker, markers = [];
        var $html = '';

        // Dữ liệu form
        var form = $('#formFilterMap').serializeArray();

        // TÌM KIẾM NHANH ĐỊA ĐIỂM
        var placeSearch, autocomplete;

        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
         };

        function initialize() {
            var myStyles =[
                {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [
                        { visibility: "off" }
                    ]
                },
                {
                    featureType: "transit.station.bus",
                    elementType: "labels",
                    stylers: [
                        { visibility: "off" }
                    ]
                }
            ];
            options = {
                scrollwheel: false,                       
                center: center,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: myStyles
            };

            // Khởi tạo google map
            map = new google.maps.Map(document.getElementById("map-canvas"), options);
            geocoder = new google.maps.Geocoder();
            // Khởi tạo button filter
            var centerControlDiv = document.createElement('div');
            var centerControl = new CenterControl(centerControlDiv, map);

            centerControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
            // Kết thúc khởi tạo button filter


            google.maps.event.addListener(map, 'click', function(event){
                this.setOptions({scrollwheel:true});
            });   
            google.maps.event.addListener(map, 'mouseout', function(event){
                this.setOptions({scrollwheel:false});  
            });                    

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showThisPosition, anyErrorShow);
            } else {
                console.log("Your browser does not support the Geolocation API");
            }

            // // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('addressText')),
                {types: ['geocode']});
            // Gioi hạn tìm kiếm
            autocomplete.setComponentRestrictions(
            {'country': ['vn']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        function watchCurrentPosition() {
            var positionTimer = navigator.geolocation.watchPosition(
            function (position) {
                setMarkerPosition(
                    currentPositionMarker,
                    position
                    );
            });
        }

        function anyErrorShow(error) {
            // console.log("Hiển thị bản đồ khi không cho phép đánh dấu địa đểm");
            // var images= baseURL + 'frontend/images/icon-map.png';
            // marker = new google.maps.Marker({
            //  position: center,
            //  map: map,
            //  icon: images,
            //  zIndex: 9999999,
            //  optimized: false,
            // });

            myLat = center.lat();
            myLng = center.lng();

            showThisPosition(false, center.lat(), center.lng());
            // Get address by longlat
            createTitle(center.lat(), center.lng());
        }

        function showThisPosition(pos = false,latitude = 0, longitude = 0) {
            // map.setMap(null);
            curPos = {latitude: latitude, longitude: longitude};
            var cookies = Cookies.get('rememberNear');

            if(pos)
            {
                myLat = latitude = pos.coords.latitude;
                myLng = longitude = pos.coords.longitude;
                curPos = pos.coords;

                if(cookies){
                    cookies     = JSON.parse(cookies);
                    latitude    = cookies.lat;
                    longitude   = cookies.lng;
                    curPos = {latitude: latitude, longitude: longitude};
                }
                
                createTitle(latitude,longitude);
            }

            var content = '';
            // A new Info Window is created and set content
            infowindow = new google.maps.InfoWindow({
                content: content,
                maxWidth: 350
            });

            map.panTo(new google.maps.LatLng(
                latitude,
                longitude
            ));

            getSellNearby(curPos);

            // Event that closes the Info Window with a click on the map
            google.maps.event.addListener(map, 'click', function () {
                infowindow.close();
            });

            var service = new google.maps.places.PlacesService(map);
            // service.nearbySearch({
            //  location: new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude),
            //  radius: 300,
            //  types: ['store']
            // }, callback);

            google.maps.event.addListener(infowindow, 'domready', function () {

                // Reference to the DIV that wraps the bottom of infowindow
                var iwOuter = $('.gm-style-iw');

                /* Since this div is in a position prior to .gm-div style-iw.
                 * We use jQuery and create a iwBackground variable,
                 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
                 */
                var iwBackground = iwOuter.prev();

                // Removes background shadow DIV
                iwBackground.children(':nth-child(2)').css({
                    'display': 'none'
                });

                // Removes white background DIV
                iwBackground.children(':nth-child(4)').css({
                    'display': 'none'
                });

                // Moves the infowindow 80px to the right.
                iwOuter.parent().parent().css({
                    left: '80px'
                });

                // Moves the shadow of the arrow 76px to the left margin.
                iwBackground.children(':nth-child(1)').attr('style', function (i, s) {
                    return s + 'opacity: 0;'
                });

                // Moves the arrow 76px to the left margin.
                iwBackground.children(':nth-child(3)').attr('style', function (i, s) {
                    return s + 'opacity: 0;'
                });

                // Changes the desired tail shadow color.
                iwBackground.children(':nth-child(3)').find('div').children().css({
                    'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px',
                    'z-index': '1'
                });

                // Reference to the div that groups the close button elements.
                var iwCloseBtn = iwOuter.next();

                // Apply the desired effect to the close button
                iwCloseBtn.css({
                    opacity: '1',
                    right: '94px',
                    top: '30px',
                    'border-radius': '50%'
                });

                // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                /* if($('.iw-content').height() < 140){
                 $('.iw-bottom-gradient').css({display: 'none'});
                 }*/

                // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                iwCloseBtn.mouseout(function () {
                    $(this).css({
                        opacity: '1'
                    });
                });
            });
        }

        function setMarkerPosition(marker, position) {
            marker.setPosition(
                new google.maps.LatLng(
                        position.coords.latitude,
                        position.coords.longitude)
                );
        }
        /*
         * 5 ways to customize the infowindow
         * 2015 - en.marnoto.com
         */

        function getSellNearby(positon) {
            latitude = positon.latitude;
            longitude = positon.longitude;

            jQuery.ajax({
                url:baseURL + 'json/mapsjson',
                type:'POST',
                data: {lat: latitude, lng: longitude ,form : form},
                error: function(xhr, status, err) {
                     //console.log('error');
                     //console.log(xhr, status, err);
                },
                success:function(data){
                    var i = 1;
                    clearMarkers();
                    jQuery.each(data, function(key,value){
                        if( value.price != 'Thương lượng' ) {
                            var html =  '<div class="modal-content '+value.ads+'">\n';
                                html +=     '<div class="modal-header">\n';
                                value.ads == "hot" ? html +=       '<div class="hot"><p>HOT</p></div>\n' : null;
                                html +=            '<button type="button" class="close" data-dismiss="modal" title="Đóng">&times;</button>\n';
                                html +=            '<a href="'+value.link+'" target="_blank"><img data-src="'+value.image+'"></a>\n';
                                html +=        '</div>\n';
                                html +=        '<div class="modal-body">\n';
                                html +=            '<h4><a href="'+value.link+'" target="_blank">'+value.title+'</a></h4>\n';
                                html +=            '<br/>\n';
                                html +=            '<p class="gia">\n';
                                html +=                '<span class="price_top">'+value.pricediv+'/</span>\n';
                                html +=                '<span class="area_top">'+value.sqft+'</span>\n';
                                html +=            '</p>\n';
                                html +=            '<p class="giadientich">Giá/ diện tích '+value.price_app+'</p>\n';
                                html +=            '<p class="location"><i class="fa fa-map-marker"></i> '+value.adress+'</p>\n';
                                html +=            '<table>\n';
                                html +=                '<tr>\n';
                                html +=                    '<td style="width: 20%;"><i class="fa fa-home"></i></td>\n';
                                html +=                    '<td style="width: 40%;">Diện tích </td>\n';
                                html +=                    '<td style="width: 40%;">'+value.sqft+'</td>\n';
                                html +=                '</tr>\n';
                                html +=                '<tr>\n';
                                html +=                    '<td><i class="fa fa-bed"></i></td>\n';
                                html +=                    '<td>Phòng ngủ </td>\n';
                                html +=                    '<td>'+value.user+'</td>\n';
                                html +=                '</tr>\n';
                                html +=                '<tr>\n';
                                html +=                    '<td><i class="fa fa-calendar"></i></td>\n';
                                html +=                    '<td>Ngày đăng </td>\n';
                                html +=                    '<td>'+value.date+'</td>\n';
                                html +=                '</tr>\n';
                                html +=            '</table>\n';
                                html +=            '<p class="content">'+value.content+'</p>\n';
                                html +=        '</div>\n';
                                html +=        '<div class="modal-footer">\n';
                                html +=            '<a class="btn btn-succes" target="_blank" href="'+value.link+'">Xem</a>\n';
                                html +=        '</div>\n';
                                html +=    '</div>\n';

                            
                            createMarker(new google.maps.LatLng(value.latitude, value.longitude), i, html, value.price, value._class, value.link);
                            i = i + 1;
                        }
                        
                    });

                    var image = baseURL + 'frontend/images/icon-map.png';
                    marker = new MarkerWithLabel({
                        position: new google.maps.LatLng(
                                latitude,
                                longitude
                            ),
                        map: map,
                        icon: image,
                        zIndex: -9,
                        optimized: false,
                    });
                    markers.push(marker);
                    jQuery('#basic').sly('reload');
                }
            });
        }

        function newLocation(newLat, newLng, pos) {
            map.setCenter({
                lat: newLat,
                lng: newLng
            });
            infowindow.open(map, markers[pos]);
        }
        
        function createMarker(position, pos, content, price, _class, url) {     
            
            marker = new MarkerWithLabel({
                map: map,
                icon : " ",
                position: position,
                draggable: false,
                raiseOnDrag: true,
                labelContent: price,
                // labelContent: "<div class='arrow'></div>" + price,
                labelAnchor: new google.maps.Point(22, 0),
                labelClass: _class,
                url: url,
                zIndex: -9,
                optimized: false,
                labelInBackground: false,
                animation: google.maps.Animation.DROP,
            });
            markers.push(marker);

            infowindow.setContent(content);
            google.maps.event.addListener(marker, 'click', (function (marker, content, infowindow) {
                return function () {
                    content = content.replace("data-src", "src");
                    if( $('#showPost').hasClass('in') ){
                        $('#showPost').loading({
                            message: '<i class="fa fa-refresh fa-spin" style="font-size:24px"></i><br/>Loading...'
                        });
                        setTimeout(function(){ $('#showPost .modal-dialog').html(content);$('#showPost').loading('stop') }, 300);
                    }else{
                        $('#showPost .modal-dialog').html(content);
                        $('#showPost').modal({backdrop: 'static', keyboard: false}) ;
                    }
                    $('.modal-backdrop.in').css('display','none');
                    $('body').removeAttr('style');
                    $('.modal-open').css('overflow','auto');
                    // infowindow.setContent(content);
                    // var labelClass = marker.get('labelClass') + " hover";
                    // marker.set('labelClass', labelClass);
                    // infowindow.open(map, marker);
                };
            })(marker, content, infowindow));


            // infowindow.setContent(content);
            // google.maps.event.addListener(marker , 'click', (function (marker, content, infowindow) {
            //  infowindow.open(map);
            // }));

            // Hover show div post detail
            // infowindow.setContent(content);
            // google.maps.event.addListener(marker, 'mouseover', (function (marker, content, infowindow) {
            //  return function () {
            //      infowindow.setContent(content);
            //      var labelClass = marker.get('labelClass') + " hover";
            //      marker.set('labelClass', labelClass);
            //      infowindow.open(map, marker);
            //  };
            // })(marker, content, infowindow));
            // google.maps.event.addListener(marker, 'mouseout', (function (marker, content, infowindow) {
            //  return function () {
            //      marker.set('labelClass', marker.get('labelClass').replace('hover', ''));
            //      infowindow.close();
            //  };
            // })(marker, content, infowindow));
        }

        function clearMarkers(){
            for(var i=0; i<markers.length;i++){
                markers[i].setMap(null);
            }
            markers = [];
        }   

        // Create button filter
        function CenterControl(controlDiv, map) {
            // Set CSS for the control border.
            var controlUI = document.createElement('div');
            controlUI.style.backgroundColor = '#e65711';
            controlUI.style.color = '#fff';
            controlUI.style.borderRadius = '10px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginTop   = '30px';
            controlUI.style.marginBottom = '22px';
            controlUI.style.textAlign = '<i class="fa fa-filter""></i>BỘ LỌC THEO VỊ TRÍ';
            controlUI.title = 'Bộ lọc theo vị trí';
            controlDiv.appendChild(controlUI);

            // Set CSS for the control interior.
            var controlText = document.createElement('div');
            controlText.style.color = '#fff';
            controlText.style.fontSize = '14px';
            controlText.style.lineHeight = '33px';
            controlText.style.paddingLeft = '15px';
            controlText.style.paddingRight = '15px';
            controlText.innerHTML = '<i class="fa fa-filter"></i>&nbsp;&nbsp;&nbsp; BỘ LỌC THEO VỊ TRÍ';
            controlUI.appendChild(controlText);

            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener('click', function() {
                $('#filterMap').modal('show');
                $('.modal-backdrop.in').css('display','none');
                $('body').removeAttr('style');
                $('.modal-open').css('overflow','auto');
                $('.alert-title').html('Sử dụng công cụ LỌC KẾT QUẢ GẦN KHU VỰC để lọc những bất động sản theo nhu cầu cảu bạn và lưu làm mặc định để ghi nhớ trên máy tính(hoặc điện thoại) của bạn. Trong lần truy cập sau các kết quả thỏa mãn hoặc bộ lọc sẽ được hiện ra ngay tại Trang Chủ Website Nhadat.net');
            });
        }


        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            latitude    = place.geometry.location.lat();
            longitude   = place.geometry.location.lng();
                
            if(latitude && longitude){
                showThisPosition(false, latitude, longitude);
                createTitle(latitude,longitude);
                map.setZoom(15);
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
              });
            }
        }

        // In ra tên địa chỉ với lat & lng
        function createTitle(lat,lng){

            var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        var textAdress = (results[0].formatted_address).replace(', Vietnam','');
                        textAdress = (results[0].formatted_address).replace(', Việt Nam','');
                        
                        $('#filterMap .modal-title').html('LỌC KẾT QUẢ GẦN: '+textAdress);
                        $('#myAddress').html('LỌC BẤT ĐỘNG SẢN GẦN: '+textAdress);
                        $('#addressText').val(textAdress);
                        
                        // Get id by address
                        $.post( baseURL + 'json/get-id-address-by-text', { address: textAdress })
                            .done(function( data ) {
                                if(typeof data == 'object'){
                                    // LOCATION SEARCH DEFAULT
                                    if(data.provincial)     myProvince = data.provincial;
                                    if(data.district)       myDist     = data.district;
                                    if(data.ward)           myWard     = data.ward;
                                    if(data.home_number)    myHomeNumber = data.home_number;
                                    if(data.street)         myStreet   = data.street;
                                    myArea = null;
                                    getlocation.complete(function() {
                                        initLocatonFilterMap(storelocation);
                                    });
                                }
                            });


                    } else {
                        console.log('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });

        }

        // Trở về vị trí ban đầu
        $('#formFilterMap .mylocation').click(function() {
            showThisPosition(false,myLat,myLng);
            // Get address by longlat
            createTitle(myLat,myLng);
        });

        // Form change
        $('#formFilterMap').change(function() {
            form = $(this).serializeArray();

            var provincial  = $("#provincFilter option:selected");
            var district    = $("#distFilter option:selected");
            var ward        = $("#wardFilter option:selected");
            var street      = $("#streetFilter option:selected");
            var area        = $("#areaFilter option:selected");
            var textAdress  = '';

            if( provincial.val() != myProvince &&  provincial.val() ){
                $("#distFilter").html('');
                $("#wardFilter").html('');
                $("#streetFilter").html('');
                $("#areaFilter").html('');

                textAdress = provincial.text();
                myProvince = provincial.val();

                $('#addressText').val(textAdress);
                $('#filterMap .modal-title').html('LỌC KẾT QUẢ TRONG THÀNH PHỐ :'+textAdress);
                $('#myAddress').html('LỌC KẾT QUẢ TRONG THÀNH PHỐ :'+textAdress);

                const dist_sort = {};
                if (storelocation[myProvince].dist) {
                    Object.keys(storelocation[myProvince].dist).sort().forEach(function(key) {
                        dist_sort[key] = storelocation[myProvince].dist[key];
                    });
                }
                $.each(dist_sort, function(distkey, distvalue) {
                    $('#distFilter').append(
                        $('<option />')
                        .text(distvalue.full)
                        .val(distkey)
                    );
                });

                map.setZoom(13);

                $(".selectpicker").selectpicker('refresh');
            }

            if(myProvince == provincial.val() && district.val() != myDist &&  district.val() ){

                $("#wardFilter").html('');
                $("#streetFilter").html('');
                $("#areaFilter").html('');

                textAdress = provincial.text();
                textAdress += ', '+district.text();

                myDist = district.val();

                $('#addressText').val(textAdress);
                $('#filterMap .modal-title').html('LỌC KẾT QUẢ GẦN :'+textAdress);
                $('#myAddress').html('LỌC KẾT QUẢ GẦN :'+textAdress);

                const ward_sort = {};

                if (storelocation[myProvince].dist[myDist].ward) {
                  Object.keys(storelocation[myProvince].dist[myDist].ward).sort().forEach(function(key) {
                    ward_sort[key] = storelocation[myProvince].dist[myDist].ward[key];
                  });
                }

                $.each(ward_sort, function(wardkey, wardvalue) {
                  $('#wardFilter').append(
                    $('<option />')
                        .text(wardvalue.name)
                        .val(wardkey)
                        .attr('data-prefix', wardvalue.prefix)
                    );
                });

                const street_sort = {};
                if (storelocation[myProvince].dist[myDist].street) {
                    Object.keys(storelocation[myProvince].dist[myDist].street).sort().forEach(function(key) {
                        street_sort[key] = storelocation[myProvince].dist[myDist].street[key];
                    });
                }

                $.each(street_sort, function(streetkey, streetvalue) {
                    $('#streetFilter').append(
                        $('<option />')
                            .text(streetvalue.name)
                            .val(streetkey)
                            .attr('data-prefix', streetvalue.prefix)
                    );
                });

                const area_sort = {};
                if (storelocation[myProvince].dist[myDist].area) {
                    Object.keys(storelocation[myProvince].dist[myDist].area).sort().forEach(function(key) {
                        area_sort[key] = storelocation[myProvince].dist[myDist].area[key];
                    });
                }

                $.each(area_sort, function(areakey, areavalue) {
                    $('#areaFilter').append(
                        $('<option />')
                        .text(areavalue.name)
                        .val(areakey)
                    );
                });

                $(".selectpicker").selectpicker('refresh');
                map.setZoom(14);
            }

            if( myProvince == provincial.val() && myDist == district.val() && ward.val() != myWard && ward.val() ){
                $("#streetFilter").html('');
                $("#areaFilter").html('');

                textAdress = provincial.text();
                textAdress += ', '+district.text();
                textAdress += ', '+ward.text();

                myWard = ward.val();

                $('#addressText').val(textAdress);
                $('#filterMap .modal-title').html('LỌC KẾT QUẢ GẦN  :'+textAdress);
                $('#myAddress').html('LỌC KẾT QUẢ GẦN :'+textAdress);

                $(".selectpicker").selectpicker('refresh');
                map.setZoom(15);
            }

            if( myProvince == provincial.val() && myDist == district.val() && street.val() != myStreet && street.val() ){
                $("#areaFilter").html('');
                textAdress = provincial.text();
                textAdress += ', '+district.text();
                textAdress += ', '+ward.text();
                textAdress += ', '+street.text();
                
                myStreet = street.val();

                $('#addressText').val(textAdress);
                $('#filterMap .modal-title').html('LỌC KẾT QUẢ GẦN  :'+textAdress);
                $('#myAddress').html('LỌC KẾT QUẢ GẦN :'+textAdress);

                $(".selectpicker").selectpicker('refresh');
                map.setZoom(15);
            }

            if( myProvince == provincial.val() && myDist == district.val() && area.val() != myArea && area.val() ){
                $("#streetFilter").html('');
                textAdress = provincial.text();
                textAdress += ', '+district.text();
                textAdress += ', '+ward.text();
                textAdress += ', '+area.text();
                
                myArea = area.val();

                $('#addressText').val(textAdress);
                $('#filterMap .modal-title').html('LỌC KẾT QUẢ GẦN  :'+textAdress);
                $('#myAddress').html('LỌC KẾT QUẢ GẦN :'+textAdress);

                $(".selectpicker").selectpicker('refresh');
                map.setZoom(15);
            }


            if( textAdress != "" ){
                geocoder.geocode( { 'address': textAdress}, function(results, status) {
                    if (status == 'OK') {
                        latitude    = results[0].geometry.location.lat();
                        longitude   = results[0].geometry.location.lng();
                        
                        showThisPosition(false, latitude, longitude);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }   
                });
            }else{
                showThisPosition(false, latitude, longitude);
            }
            
        });
        
        $('#formFilterMap').submit(function(e) {
            e.preventDefault();
            var demand          = $("#demandfilter").selectpicker('val');
            var category        = $("#categoryfilter").selectpicker('val');
            var address         = $("#addressText").selectpicker('val');
            var acreage         = $("#acreageFilter").selectpicker('val');
            var pricedown       = $("#pricedown").selectpicker('val');
            var pricevote       = $("#pricevote").selectpicker('val');
            var bedroom         = $("#bedroom").selectpicker('val');
            var bathroom        = $("#bathroom").selectpicker('val');
            var floor           = $("#floor").selectpicker('val');

            var rememberNear    = new Object();
            rememberNear.lat    = latitude;
            rememberNear.lng    = longitude;
            rememberNear.demand = demand ? demand : null;
            rememberNear.category   = category ? category : null;
            rememberNear.acreage    = acreage ? acreage : null;
            rememberNear.pricedown  = pricedown ? pricedown : null;
            rememberNear.pricevote  = pricevote ? pricevote : null;
            rememberNear.bedroom    = bedroom ? bedroom : null;
            rememberNear.bathroom   = bathroom ? bathroom : null;
            rememberNear.floor      = floor ? floor : null;

            Cookies.set('rememberNear', rememberNear, { expires: 30*6 });

            $.post( baseURL + 'save-filter-near-area', { lat : latitude, lng : longitude, form : form })
                .done(function( data ) {
                });

            $('.alert-title').html('<div class="alert alert-success"><strong>Thông báo!</strong> Lưu mặc định tìm kiếm gần đây thành công.</div>');

        });
//  }
// });
