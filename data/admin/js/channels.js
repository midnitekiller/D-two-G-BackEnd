function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}
var hotelid;
$("#hotelID").on('change', function() {
	$("#display-channels").empty();
	var e = document.getElementById("hotelID");
	hotelid = e.options[e.selectedIndex].value;
	if(hotelid != ""){
		displayChannels(hotelid);
	}else{
		$("#display-channels").empty();
	}
	
});

function deleteThis(element) {
    var ch_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Channel"});
        data.push({"name":"channel_ID","value":ch_ID});
        $.post(
            'controller/ChannelController.php',
            data,
            function(data) {
				switch(data){
					case 'true':
						$('#mssg_channel').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Deleted the Channel.</p></div>")
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#mssg').html(""); }, 4000);
						break;
					default:
						break;
				}
            }
        );
    }
}
$(function () {
    $("#add_channel_form").validate({
        rules: {
			hotel_id: "required",
			channnel_name: "required",
			channel_url: "required",
            channel_type: "required"
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
			var logo_img = $('#channel_logo')[0].files[0];
			var datafields = new FormData($("form")[3]);
			var logo_error = 1;
			
			if(logo_img){
				var ext = logo_img.name.split('.').pop('-1');
				if(logo_img.size > 2000000){
					$('#mssg_channel').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(logo_img.size) + "LOGO : MB. Maximum file size for image is 2 MB. </div>");
					$('#popalert').show();
				}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
					$('#mssg_channel').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
					$('#popalert').show();
				}else{
					logo_error = 0;
					datafields.append('channel_logotext', logo_img.name);
				}
				
			} else{
				logo_error = 0;
				datafields.append('channel_logotext', $('logo_text').val());
			}
			
			var hoid = $('select[name=hotelID]').val();
			if(logo_error == 0){
				$.ajax({
					type:"POST",
					enctype: 'multipart/form-data',
					url:"controller/ChannelController.php",
					data: datafields,
					processData: false,
					contentType: false,
					timeout: 600000,
					success: function(data) {
						switch(data){
							case 'true':
								$('#messages').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Added New Channel.</p></div>")
                                setTimeout(function() { window.location.href='channelall.php?hotel_ID='+hoid; },2000);
								break;
							case 'false':
								$('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add New Channel. Please try again!</p></div>");
								break;
							case 'image':
								$('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Invalid Image. Please try again!</p></div>");
								break;
							case 'channelname':
								$('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Existing Channel. Please try again!</p></div>");
								break;
							default:
						}
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#messages').html(""); }, 4000);
					}
				});
			}
        }
    })
});



$(function () {
    $("#update_channel_form").validate({
        rules: {
            hotelid: "required",
			channnel_name: "required",
			channel_url: "required"
            
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
			var logo_img = $('#channel_logo')[0].files[0];
			var datafields = new FormData($("form")[3]);
			var logo_error = 1;
			
			if(logo_img){
				var ext = logo_img.name.split('.').pop('-1');
				if(logo_img.size > 2000000){
					$('#mssg_channel').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(logo_img.size) + "LOGO : MB. Maximum file size for image is 2 MB. </div>");
					$('#popalert').show();
				}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
					$('#mssg_channel').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
					$('#popalert').show();
				}else{
					logo_error = 0;
					datafields.append('channel_logotext', logo_img.name);
				}
				
			} else{
				logo_error = 0;
				datafields.append('channel_logotext', $('logo_text').val());
			}
			
			var hoid = $('select[name=hotelid]').val();
			if(logo_error == 0){
				$.ajax({
					type:"POST",
					enctype: 'multipart/form-data',
					url:"controller/ChannelController.php",
					data: datafields,
					processData: false,
					contentType: false,
					timeout: 600000,
					success: function(data) {
						switch(data){
							case 'true':
								$('#mssg_channel').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Updated the Channel.</p></div>")
                                setTimeout(function() { window.location.href='channelall.php?hotel_ID='+hoid; },2000);
								break;
							case 'false':
								$$('#mssg_channel').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update the Channel. Please try again!</p></div>");
								break;
							case 'image':
								$('#mssg_channel').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Invalid Image. Please try again!</p></div>");
								break;
							case 'channelname':
								$('#mssg_channel').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Existing Channel. Please try again!</p></div>");
								break;
							default:
						}
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#mssg_channel').html(""); }, 4000);
						/*location.reload()*/
					}
				});
			}
        }
    })
});