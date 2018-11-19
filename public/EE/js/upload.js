var  baseURL = '';
$(".imgThumb").click(function (e) {
    e.preventDefault();
    $(this).focus();
    var win = window.open( $(this).find("a").attr('href'), '_blank');
    return false;
});

$(".kv-file-remove").click(function (e) {
    // debugger;
    e.preventDefault();
    $(this).focus();
    var tmp_delete = $("." + $(this).attr('data'));
    $.ajax({
        url: $(this).attr('href'),
        data: {"data": $(this).attr('data'),"id_post":id_post},
        type: 'POST',
        dataType: 'json',
        //console.log: error,
        success: function (data) {
            // debugger;
            tmp_delete.remove();
        },
        error: function (data) {
            alert('Có lỗi xảy ra, nhấn F5 để thử lại!');
        }
    });
    return false;
});
var autoUp = new PureUploader(
    {
        //Events
        html5Error: html5ErrorFunc,
        progress: uploaderProgress,
        success: uploaderSuccess,
        error: uploaderError,
        //Properties
        name: "autoUp",
        drop: true,
        dragHoverClass: "drop_hover",
        dropPlace: document.getElementById("dropPlace"),
        form: document.getElementById("dropper"),
        file_input: document.getElementById("fileInput"),
        file_filter: "",
        file_size: 1048576e3,
        file_class: "",
        template: '<div class="form-group text-center">{image}<p>{file.name} - {file.size}<\/p><\/div>',
        image: {
            thumb: true,
            thumb_width: 200,
            thumb_height: 200,
            resize_width: 0,
            resize_height: 0,
            preparing: '../public/frontend/preparing.png'
        },
        watermark: {
            watermark: false
        },
        limit: 20,
        ajax: {
            url: baseURL + '/upload',
            // global: true,
            data:id_post,
            clearAfterUpload: true,
            beforeSend: function () {
                $('#dropPlace').replaceWith('<img src="/themeEE/frontend/images/processing.gif" >');
            },
        },
        chunk: {
            active: true,
            size: 1 * 512 * 1024
        },
        auto_upload: true

    });

function uploaderProgress(data) {

    if (data.percent == 100) {
        $.ajax({
            url: baseURL + "newpost/uploader",
            data: {"data": data.template, "id_post":id_post},
            type: 'POST',
            dataType: 'json',
            complete: function (json) {
                if(json.responseText){
                    var images = JSON.parse(json.responseText);
                    if(images ==  'limited'){
                        $('.alert').html('Tối đa ảnh cho một bài đăng là 20 ảnh!');
                        $('.alert').show();
                    }else if(images ==  'notfound'){
                        $('.alert').html('Lỗi không xác định!');
                        $('.alert').show();
                    }else if(images ==  'haserror'){
                        $('.alert').html('Ảnh tải lên không hợp lệ. Vui lòng tải lên ảnh định dạng JPG, PNG, JPEG. Kích thước tối đa 2 MB');
                        $('.alert').show();
                    }else if(images ==  'maxsize'){
                        $('.alert').html('Kích thước ảnh quá lớn. Tối đa 2MB');
                        $('.alert').show();
                    }else if(images ==  'filext'){
                        $('.alert').html('Định dạng file không hợp lệ. Định dạng hợp lệ : jpg, png, jpeg');
                        $('.alert').show();
                    }
                    else{
                        $('.alert').hide();
                        $('._image>h5').remove();
                        var imagesrc = images['100x100'];
                        $(".post-images").append('<li class="imgThumb ' + data.template + '">  <a href="'+ (baseCDN+ images['file']) +'" file="'+baseCDN+images['file']+'" target="_blank"><img file="'+baseCDN+imagesrc+'" src="' +(baseCDN+ imagesrc) + '" width="100" height="100" /></a><a href=" '+baseURL+'newpost/removeimage" data="' + data.template + '" class="kv-file-remove" title="Xóa hình này"><i class="fa fa-remove"></i></a></li>');

                        $(".kv-file-remove").click(function (e) {
                            e.preventDefault();
                            $(this).focus();
                            var tmp_delete = $("." + $(this).attr('data'));
                            var id_post = id_post ? id_post : null;
                            $.ajax({
                                url: $(this).attr('href'),
                                data: {"data": $(this).attr('data'),"id_post":id_post},
                                type: 'POST',
                                dataType: 'json',
                                //console.log: error,
                                success: function (data) {
                                    $('.alert').hide();
                                    $('._image>h5').remove();
                                    tmp_delete.remove();
                                },
                                error: function (data) {
                                    alert('Có lỗi xảy ra, nhấn F5 để thử lại!');
                                }
                            });
                            return false;
                        });
                    }
                }

                return false;
            },
            error: function (data) {
                var device = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                if( !device ) {
                    alert('Có lỗi xảy ra, nhấn F5 để thử lại!');
                }
            }
        });

    }

}

function uploaderSuccess(event) {
    $('#dropPlace').loading('stop');
    var progress = document.getElementById("allprogress");
    progress.innerHTML = '';
}

function uploaderError(uploader, message, event) {
    if (message == uploader.settings.errors.NETWORK) {
        if (event.target.upload.template_id) {
            var temp = document.getElementById(event.target.upload.template_id);
            if (temp != null) {
                var p = temp.getElementsByTagName("p")[0];
                p.className = p.className + "file_error";
            }
        }
    } else {

    }
}

function html5ErrorFunc(uploader) {
    uploader.settings.imageHolder.style.display = "none";
    uploader.settings.dropPlace.style.display = "none";
    var error = document.createElement("p");
    error.className = "text-center";
    error.appendChild(document.createTextNode("Your browser doesn't support HTML5, we can offer you a new browser from here !"));
    uploader.settings.form.appendChild(error);
}

var confirmOnPageExit = function (e) {
    // If we haven't been passed the event get the window.event
    e = e || window.event;
    var uploading = autoUp.isworking();

    if (uploading == 1) {
        var message = 'Any text will block the navigation and display a prompt';

        // For IE6-8 and Firefox prior to version 4
        if (e) {
            e.returnValue = message;
        }

        // For Chrome, Safari, IE8+ and Opera 12+
        return message;
    } else {
        return null;
    }
};

window.onbeforeunload = confirmOnPageExit;