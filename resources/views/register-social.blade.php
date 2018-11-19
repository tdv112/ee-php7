@extends('layouts.master')
@section('content')

    <div class="newpost" id="newpost">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2  contentpost">
                    <form class="form-horizontal" id="frm_register" name="frm_register" method="POST"
                          action="{{route('gg_register')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="alert alert-success alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Chào {{$user->name}}</strong> Vui lòng bổ sung 1 số thông tin trước khi bắt
                                đầu với EE.
                            </div>
                        </div>
                        <input type="hidden" name="avatar" value="{{$user->avatar}}">
                        <input type="hidden" name="email" value="{{$user->email}}">
                        <input type="hidden" name="name" value="{{$user->name}}">
                        <input type="hidden" name="google_id" value="{{$user->id}}">
                        <div class="form-group">
                            <label>Số điện thoại</label>&nbsp<span class="msg-item" id="msg_phone"></span>
                            <div class="input-field">
                                <input type="text" id="phone" name="phone" placeholder="Ex. 0987654321">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nhập mật khẩu</label>&nbsp<span class="msg-item" id="msg_password"></span>
                            <div class="input-field">
                                <input type="password" id="password" name="password"
                                       placeholder="Nhập mật khẩu ít nhất 4 kí tự">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>&nbsp<span class="msg-item" id="msg_repassword"></span>
                            <div class="input-field">
                                <input type="password" id="re_password" name="re_password"
                                       placeholder="Nhập lại mật khẩu">
                            </div>
                        </div>
                        <div class="cleafix"></div>
                        <div class="form-group button">
                            <button type="button" onclick="check_user()" class="connect normal">
                                Tiếp tục
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--PAGE SCRIPT--}}
    <script src="{{ asset('themeEE/frontend/js/mapAPI.js') }}"></script>
    <script type="text/javascript">
        function check_user() {
            var info = {};
            info.facebook_id = '';
            info.google_id = '';
            $(".msg-item").html("");
            $.each($('#frm_register').serializeArray(), function () {
                info[this.name] = this.value;
            });
            if (info.password != info.re_password) {
                $(".msg-item").html("");
                $("#msg_repassword").html("Nhập lại mật khẩu chưa chính xác");
                return;
            }
            info.user_location = user_location;
            console.log(info);
            $.ajax('{{route("frontend_postRegister")}}', {
                type: 'POST',
                data: {"data": info, "_token": "{{ csrf_token() }}"},
                async: false,
                success: function (data, status, xhr) {
                    if (data.errors) {
                        console.log(data);
                        $('.msg-item').html('');
                        if (data.errors.email) {
                            $('#msg_email').html(data.errors.email[0]);
                        }
                        if (data.errors.password) {
                            $('#msg_password').html(data.errors.password[0]);
                        }
                        if (data.errors.phone) {
                            $('#msg_phone').html(data.errors.phone[0]);
                        }
                    }
                    if (data.success) {
                        swal('', 'Chúc mừng ' + data.success + ' đã tạo thành công tài khoản tại EE. Nhấn OK để tiếp tục', 'success')
                            .then((value) => {
                                location.href = "{{route('frontend_index')}}";
                            });
                        setTimeout(function () {
                            location.href = "";
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

@endsection