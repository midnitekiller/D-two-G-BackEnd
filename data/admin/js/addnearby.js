function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}
var existingCheck = "newuser";
$("#existingUser").on('change', function() {
	if($(this).val() == ""){
		existingCheck = "newuser";
		$("#newad").show();
		$("#newad2").show();
	}else {
		existingCheck = "existing";
		$("#newad").hide();
		$("#newad2").hide();
	}
	console.log(existingCheck);
});

$("#loadthis").addClass('loader-show');
    
	
jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) > Number($(params).val())); 
    },'Must be greater than {0}.');

$(function () {
	$("#advertisementNearby").validate({
		rules: {
			ad_name: "required",
			hotel_name: "required",
			ad_category: "required",
			ad_address: "required",
			ad_contact: {
					required: true,
					number: true
				},
			daterange_in: "required",
			daterange_out: {required:true, greaterThan:"#datetimepicker1"},
			description: "required",
			adImagesText: "required",
			companyname: {
				required: function(element){
					return $("#existingUser").val().length <= 0;
					}
			},
			email: {
				required: function(element){
					return $("#existingUser").val().length <= 0;
				},
				email : true
			},
			existingUser: {
				required: function(element){
					return $("#existingUser").val().length >= 1;
				}
			}
			
		},
        messages: {
            daterange_out:{ greaterThan:"Check-out date must be equal or after check-in date"}
        }, 
		submitHandler: function(form) {
			var $imageUpload = $("#imagesAd");
			var imageError = 1;
			if(parseInt($imageUpload.get(0).files.length) > 5){
				$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Maximum of 5 photos only. </div>");
					$('#popalert').show();
			}else{
				var image1 = $('#imagesAd')[0].files[0];
				var image2 = $('#imagesAd')[0].files[1];
				var image3 = $('#imagesAd')[0].files[2];
				var image4 = $('#imagesAd')[0].files[3];
				var image5 = $('#imagesAd')[0].files[4];
				
				if(image1){
					var ext = image1.name.split('.').pop('-1');
					if(image1.size > 2000000){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(image1.size) + "LOGO : MB. Maximum file size for images is 2 MB. </div>");
						$('#popalert').show();
					}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
						$('#popalert').show();
					}else{
						imageError = 0;
					}
				}else {
					imageError = 0;
				}
				if(image2){
					var ext = image2.name.split('.').pop('-1');
					if(image2.size > 2000000){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(image2.size) + "LOGO : MB. Maximum file size for images is 2 MB. </div>");
						$('#popalert').show();
					}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
						$('#popalert').show();
					}else{
						imageError = 0;
					}
				}else {
					imageError = 0;
				}
				if(image3){
					var ext = image3.name.split('.').pop('-1');
					if(image3.size > 2000000){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(image3.size) + "LOGO : MB. Maximum file size for images is 2 MB. </div>");
						$('#popalert').show();
					}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
						$('#popalert').show();
					}else{
						imageError = 0;
					}
				}else {
					imageError = 0;
				}
				if(image4){
					var ext = image4.name.split('.').pop('-1');
					if(image4.size > 2000000){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(image4.size) + "LOGO : MB. Maximum file size for images is 2 MB. </div>");
						$('#popalert').show();
					}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
						$('#popalert').show();
					}else{
						imageError = 0;
					}
				}else {
					imageError = 0;
				}
				if(image5){
					var ext = image5.name.split('.').pop('-1');
					if(image5.size > 2000000){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(image5.size) + "LOGO : MB. Maximum file size for images is 2 MB. </div>");
						$('#popalert').show();
					}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
						$('#popalert').show();
					}else{
						imageError = 0;
					}
				}else {
					imageError = 0;
				}
			}
			var datafields = new FormData($("form")[3]);
			datafields.append('advertisertype', existingCheck);
			if(imageError == 0){
				$.ajax({
					type:"POST",
					enctype: 'multipart/form-data',
					url:"controller/AdvertisementController.php",
					data: datafields,
					processData: false,
					contentType: false,
					timeout: 600000,
					success: function(data) {
						if(data.trim() == "true") {
							$('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Added Places Nearby Information.</p></div>");
                            setTimeout(function() { window.location.href=window.location.href='displaynearby.php'; },2000);
						}else if(data.trim() == "mail"){
				            $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to sent mail for registration. Please try again!</p></div>");
						}else{
                            $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to login. Please try again!</p></div>");
							console.log(data);
						}
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#mssg').html(""); }, 4000);
						
					}
				});
			}
		}
	});
});
