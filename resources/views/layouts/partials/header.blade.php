<?php
    use Symfony\Component\HttpFoundation\Session\Session;
    use Illuminate\Support\Facades\Route;
    $prefix     = Request()->route()->getPrefix();
    $routeName  =  Route::currentRouteName();
    $MenuStyle  = App\Http\Controllers\Controller::Menu($prefix,$routeName);
?>
<div class="header" id="header" style="margin-top: 0px;">
    <div class="row">
        <div class="col-md-12">
            <div class="control">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <a href="{{route('frontend_index')}}" onmouseover="darklogo()" onmouseout="defaultlogo()">
                            <img id="img_logo" src="/EE/images/logo-introhome.png" >
                        </a>
                        <?php $session = new Session();
                            if ($session->has('auth')) {
                            $value = $session->get('auth'); 
                        ?>
                        <label class="user-is-login"><i class="fa fa-circle online"></i> {{$value->name}}</label>
                        <?php }?>
                    </div>
                    <div class="col-md-4 ">
                        <div class="row" style="{{$MenuStyle->divStyleCenter}}">
                            <div class="col-xs-3 text-right">
                                <a href="javascript: history.back(1)" class="control-left"><i class="fa fa-caret-left"></i></a>
                            </div>
                            <div class="col-xs-6 text-center padding-0">
                                <button class="btn-workers btn-header" style="{{$MenuStyle->btnCenterStyle}}">
                                {{$MenuStyle->textBtnV}}<br>{{$MenuStyle->textBtnE}}</button>
                            </div>
                            <div class="col-xs-3 text-left">
                                <a href="javascript: history.go(1)" class="control-right"><i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center list-btnaction">
                        <?php  $session = new Session();
                            if ($session->has('auth')) { ?>
                            <a href="/mypost/{{$value->id}}" class="btn btn-primary">Tin của tôi</a>
                            <a href="{{route('frontend_postLogout')}}" class="btn btn-primary">Đăng xuất</a>
                        <?php } else  {?>
                            <a href="{{route('frontend_getLogin')}}" class="btn btn-primary">Đăng nhập</a>
                            <a href="{{route('frontend_getRegister')}}" class="btn btn-primary">Đăng ký</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function darklogo(){
        $('#img_logo').attr("src","/EE/images/logo-introhome-h.png");
    }
    function defaultlogo(){
        $('#img_logo').attr("src","/EE/images/logo-introhome.png");
    }
</script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script> 