var lat = sessionStorage.getItem("lat");
var lng = sessionStorage.getItem("lng");
var address = sessionStorage.getItem("address");

var hire = {
	create_post : function ()  {
		var info = {};
		$(".msg-item").html("");
		info.name 			= $('#name').val();
		info.phone_zone 	= $('#phonezone').val();
		info.phone 			= $('#phone').val();
		info.facebook 		= $('#facebook').val();
		info.gmail 			= $('#gmail').val();
		info.zalo 			= $('#zalo').val();
		info.twitter 		= $('#twitter').val();
		info.location 		= {lat : lat,lng : lng};
		info.address 		= address;
		info.title 			= $('#title').val();
		info.content 		= $('#content').val();
		info.media 			= img;
		console.log(info);
		$.ajax('/', {
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
					swal('Thành công','Đăng tin thành công !','success');
					setTimeout(function () {
						location.href = "/";
					}, 1500);
				}
			}
		});
	},
}
