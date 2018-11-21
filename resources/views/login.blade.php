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
            <?php use Symfony\Component\HttpFoundation\Session\Session; $session = new Session(); ?>
            @if($session->has('alert-login'))
            <div class="row">
                <div class="col-md-8 col-md-offset-2 contentpost" style="padding-left: 0px;padding-right: 0px">
                    <div class="alert alert-warning" role="alert">
                     {{$session->get('alert-login')}}
                     <?php $session->remove('alert-login')?>
                    </div>
                </div>
          </div>
          @endif
            <div class="row">
                <div class="col-md-8 col-md-offset-2 contentpost">
                    <form class="form-horizontal" id="frm_login" name="frm_login" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>Tên đăng nhập</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                            <div class="input-field">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="Nhập số số tên đăng kí của bạn">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>&nbsp<span class="msg-item" id="msg_password"></span>
                            <div class="input-field">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                            </div>
                        </div>
                        <div class="cleafix"></div>
                        <div class="form-group">
                            <button type="button" class="btn btn-lagre form-control btn-action" onclick="login()">
                                Đăng nhập
                            </button>
                        </div>

                        <div class="form-group button connect-c">
                            <div class="col-md-6 col-xs-6 dgf" style="padding-left: 0px;">
                                <a href="{{route('fb_login')}}" class="connect facebook btn-fb">
                                    <div class="connect__icon">
                                        <i class="fa fa-facebook"></i>
                                    </div>
                                    <div class="connect__context">
                                        <span id="fbtext">Đăng nhập bằng tài khoản Facebook</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xs-6 dgm" style="padding-right: 0px;">
                                <a href="{{route('gg_login')}}" class="connect googleplus btn-gg">
                                    <div class="connect__icon">
                                        <img id="img-login-gmail" src="{{asset('EE/images/gmail.png')}}" width="75%">
                                    </div>
                                    <div class="connect__context">
                                        <span id="ggtext">Đăng nhập bằng tài khoản Gmail</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--PAGE SCRIPT--}}
    <script type="text/javascript">
        function login() {
            var info = {};
            $(".msg-item").html("");
            info.phone = $('#phone').val();
            info.password = $('#password').val();
            $.ajax('{{route("frontend_postLogin")}}', {
                type: 'POST',
                data: {'data': info, '_token': '{{ csrf_token() }}'},
                async: false,
                success: function (data, status, xhr) {
                    if (data.errors) {
                        if (data.errors.phone) {
                            $('#msg_phone').html(data.errors.phone[0]);
                        }
                        if (data.errors.password) {
                            $('#msg_password').html(data.errors.password[0]);
                        }
                    }
                    if (data.fail) {
                        swal({
                            title: "",
                            text: data.fail,
                            icon: "error",
                        });
                    }
                    if (data.success) {
                        swal('','Đăng nhập thành công !','success');
                        setTimeout(function () {
                        location.href = "{{route('frontend_index')}}";
                        }, 1500);
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
                $('#fbtext').text('Đăng nhập bằng Facebook');
            }
            if (width <= 768){
                $('#fbtext').text('Facebook');
            }
            if (width <= 1024 && width > 768){
                $('#ggtext').text('Đăng nhập bằng Gmail');
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
