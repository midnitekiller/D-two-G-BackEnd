/*
|================================|
|=====selector button device=====|
|================================|
*/
 $(document).ready(function(){
    $('#adddevice').on('click',function(){
       $('#adddevice-modal').modal().show();
    });
     
    $('#btnadddevice').on('click',function(){
       $('#adddevice-modal').modal().show();
    });
 });
 var hotelid,maxrooms;
	$("#hotel_id").on('change', function() {
		var e = document.getElementById("hotel_id");
		hotelid = e.options[e.selectedIndex].value;
		maxrooms = $(this).children(":selected").attr("id");
		document.getElementById("allowednumber").innerHTML = "Max. Room No. <b>"+maxrooms+"</b>";
		$.ajax({
			type:"POST",
			url:"controller/DeviceController.php",
			data:{
				action : "Get Rooms",
				hotel_ID : hotelid
			},
			success: function(data){
				$('select[name="roomnumber"]').html('');
				if(data != "0"){
					var myArr = JSON.parse(data);
					var optionsAsString = "";
					var checker = 0;
					for(var i = 1; i <= maxrooms; i++) {
						for(var j = 0; j < myArr.length; j++){
							if(myArr[j] == i.toString()){
								checker = 1;
								break;
							}
						}
						if(checker == 0){
							optionsAsString += "<option value='" + i + "'>" + i + "</option>";
						}else{
							checker = 0;
						}
					}
					$( 'select[name="roomnumber"]' ).append("<option value=''>-- Select --</option>");
					$( 'select[name="roomnumber"]' ).append( optionsAsString );
				}else{
					var optionsAsString = "";
					var checker = 0;
					for(var i = 1; i <= maxrooms; i++) {
						
							optionsAsString += "<option value='" + i + "'>" + i + "</option>";
						
					}
					$( 'select[name="roomnumber"]' ).append("<option value=''>-- Select --</option>");
					$( 'select[name="roomnumber"]' ).append( optionsAsString );
				}
				
			}
		});
	});
	
 $(function () {
    $("#adddeviceform").validate({
        rules: {
            hotel_id: "required",
			macaddress: "required"

        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#adddeviceform").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/DeviceController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
						//$('#adddevice-modal').modal('hide');
                        $('#messages').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Add Device.</p></div>");
                        setTimeout(function(){ $('#messages').html(""); }, 2000);
					}else {
						$('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add Device. Please try again!</p></div>");
                        setTimeout(function(){ $('#messages').html(""); }, 2000);
						console.log(data);
					}
                    
                }
            });
        }
    })
});