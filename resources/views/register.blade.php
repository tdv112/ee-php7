@extends('layouts.master')
@section('content')

<style type="text/css">
    .divlogo{
        margin-top: 45px;
    }
</style>
<div class="newpost" id="newpost">
    <div class="form-group " style="padding-left: 242px;">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div id="google_translate_element"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2 contentpost">
                <form id="frm_register" class="form-horizontal" method="post">
                    <meta name="_token" content="{!! csrf_token() !!}"/>
                    <div class="form-group">
                        <label>Tên đăng kí</label>&nbsp<span class="msg-item" id="msg_name"></span>
                        <div class="input-field">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Ex. KhuongBui_90">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nhập mật khẩu</label>&nbsp<span class="msg-item" id="msg_password"></span>
                        <div class="input-field">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu ít nhất 4 kí tự">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>&nbsp<span class="msg-item" id="msg_repassword"></span>
                        <div class="input-field">
                          <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                    <div class="cleafix"></div>

                        <div class="form-group">
                            <button type="button" class="btn btn-lagre form-control btn-action" onclick="getData()">
                                Tạo tài khoản
                            </button>

                    </div>
                    <div class="form-group button connect-c">
                            <div class="col-md-6 col-xs-6 dgf" style="padding-left: 0px;">
                                <a href="{{route('fb_login')}}" class="connect facebook btn-fb">
                                    <div class="connect__icon">
                                        <i class="fa fa-facebook"></i>
                                    </div>
                                    <div class="connect__context">
                                        <span id="fbtext">Đăng kí bằng tài khoản Facebook</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xs-6 dgm" style="padding-right: 0px;">
                                <a href="{{route('gg_login')}}" class="connect googleplus btn-gg">
                                    <div class="connect__icon">
                                        <img id="img-login-gmail" src="{{asset('EE/images/gmail.png')}}" width="75%" style="object-fit: cover;">
                                    </div>
                                    <div class="connect__context">
                                        <span id="ggtext">Đăng kí bằng tài khoản Gmail</span>
                                    </div>
                                </a>
                            </div>
                    </div>
                </form>
            </div>
         </div>
    </div>
</div>
<script src="{{ asset('EE/js/mapAPI.js') }}"></script>
<script type="text/javascript">
        function getData() {
            var info = {};
            $(".msg-item").html("");
            $.each($('#frm_register').serializeArray(), function () {
                info[this.name] = this.value;
            });
            info.user_location = { "lat" : sessionStorage.getItem("lat"), "lng" : sessionStorage.getItem("lng") };
            info.user_address  = sessionStorage.getItem("address");
            info.google_id     = '';
            info.facebook_id   = '';
            info.avatar        = '';

            if (info.password != info.re_password) {
                $(".msg-item").html("");
                $("#msg_repassword").html("Nhập lại mật khẩu chưa chính xác");
                return;
            }
            console.log(info);
            $.ajax({
                url : '{{route("frontend_postRegister")}}',
                type: 'POST',
                data: {'data' : info ,'_token': '{{ csrf_token() }}'},
                dataType : 'JSON',
                async: false,
                success: function (data, status, xhr) {
                    if (data.errors) {
                        console.log(data);
                        $('.msg-item').html('');
                        if (data.errors.password) {
                            $('#msg_password').html(data.errors.password[0]);
                        }
                        if (data.errors.name) {
                            $('#msg_name').html(data.errors.name[0]);
                        }
                    }
                    if (data.success) {
                        swal('Thành công', 'Tạo tài khoản thành công', 'success')
                        .then((value) => {
                            location.href = "{{route('frontend_getLogin')}}";
                        });
                        setTimeout(function () {
                            location.href = "{{route('frontend_getLogin')}}";
                        }, 3000);
                    }
                    if (data.fail) {
                        swal('', data.fail, 'error');
                        ;
                    }
                }
            });
        }
    </script>
<script type="text/javascript" src="{{asset('EE/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var width = $(window).width();
        console.log(width);
        if (width <= 1024  && width > 768){
            $('#fbtext').text('Đăng kí bằng Facebook');
        }
        if (width <= 768){
            $('#fbtext').text('Facebook');
        }
        if (width <= 1024 && width > 768){
            $('#ggtext').text('Đăng kí bằng Gmail');
        }
        if (width <= 768){
            $('#ggtext').text('Gmail');
        }
    });
</script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endsection
