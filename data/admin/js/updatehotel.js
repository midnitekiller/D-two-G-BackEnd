function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}

$(function () {
    $("#update_hotel_form").validate({
        rules: {
            hotel_name: "required",
            email: {required:true, email:true},
            hotel_name: "required",
            currency:"required",
            max_no:{required:true, number:true},
            hotel_logo:"required"
            
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
			var logo_img = $('#hotel_logo_img')[0].files[0];
			var back_img = $('#back_logo_img')[0].files[0];
			var datafields = new FormData($("form")[3]);
			var logo_error = 1;
			var background_error = 1;
			
			if(logo_img){
				var ext = logo_img.name.split('.').pop('-1');
				if(logo_img.size > 2000000){
					$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(logo_img.size) + "LOGO : MB. Maximum file size for image is 2 MB. </div>");
					$('#popalert').show();
				}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
					$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
					$('#popalert').show();
				}else{
					logo_error = 0;
					datafields.append('logo', logo_img.name);
				}
				
			} else{
				logo_error = 0;
				datafields.append('logo', $('hotel_logo').val());
			}
			
			if(back_img){
				var ext = back_img.name.split('.').pop('-1');
				if(back_img.size > 2000000){
					$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(back_img.size) + "BACKGROUND : MB. Maximum file size for image is 2 MB. </div>");
					$('#popalert').show();
				}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
					$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>BACKGROUND : File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
					$('#popalert').show();
				}else{
					background_error = 0;
				}
				datafields.append('background', back_img.name);
			} else{
				background_error = 0;
				datafields.append('background', $('hotel_logo').val());
			}
			if(logo_error == 1 && background_error == 1){
				console.log("fail ang duha ka image");
			}else if(logo_error == 1 && background_error == 0){
				console.log("fail ang logo");
			}else if(logo_error == 0 && background_error == 1){
				console.log("fail ang background");
			}
			else{
				$.ajax({
					type:"POST",
					enctype: 'multipart/form-data',
					url:"controller/HotelController.php",
					data: datafields,
					processData: false,
					contentType: false,
					timeout: 600000,
					success: function(data) {
						switch(data){
							case 'true':
								$('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Hotel Information.</p></div>");
								break;
							case 'notadded':
								$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Hotel Information. Please try again!</p></div>");
								break;
							case 'image':
								$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Invalid Image. Please try again!</p></div>");
							case 'hotel':
								$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>This hotel is already added. Please try again!</p></div>");
								break;
							case 'email':
								$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Email is already in use. Please try again!</p></div>");							
							case 'emailhotel':
								$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Email and Hotel is already is use. Please try again!</p></div>");
							default:
						}
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#mssg').html(""); }, 4000);
					}
				});
			}
        }
    })
});