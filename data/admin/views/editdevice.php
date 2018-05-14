<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Edit Device</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Device Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
					<div class="col-6 col-md-4">
							<strong>Hotel Name :</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?=$hotelname;?>
                    </div>
					<div class="col-6 col-md-4">
							<strong>Room Number :</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?=$device['room_no'];?>
                    </div>
					<div class="col-6 col-md-4">
							<strong>Device UID :</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?=$device['mac_address'];?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h4>Edit Device Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="update_device_form">
            
                <div class="form-group">
                    <span class="label label-success arrowed">Device Details</span>
					<input type="hidden" name="deviceid" value="<?=$device['tabs_ID'];?>" />
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
					<div class="col-sm-4">
                        <label class="control-label">Hotel Name</label> <small>( required ) </small>
                        <select name="hotelname" id="hotelname" class="form-control m-b">
                            <option value="">-- Select --</option>
						<?php foreach($hotels as $values => $hotel):?>
							<option id="<?=$hotel['hotel_max_room'];?>" value="<?=$hotel['hotel_ID'];?>" <?=($device['hotel_ID'] == $hotel['hotel_ID']) ? "selected" : "";?>><?=$hotel['hotel_name'];?></option>
						<?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Room No.</label> <small>( required ) </small><small id="allowednumber"></small>
                        <input type="text" class="form-control" name="roomnumber" id="roomnumber" value="<?=$device['room_no'];?>" >
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label">Mac Address / Device UID</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="macaddress" id="macaddress" value="<?=$device['mac_address'];?>" >
                    </div>   
                </div>
                <div class="hr-line-dashed"></div>
                
                <!--
                |================================
                |==========Confirm Button========
                |================================
                -->
                <br/>
                <div class="row">
                <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Update Device" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="mssg" class="col-md-3" style="top:0;right:0;position:fixed;margin-top:10px;margin-right:-5px;"></div>
<script>
/*
|================================|
|==selector button update hotel==|
|================================|
*/
 $(document).ready(function(){
    $('#access').on('click',function(){
        window.location.href='authorizedaccessall.php?hotel_id=<?=$hotel['hotel_ID'];?>';
    });
 });
 
 var hotelname;
	$("#hotelname").on('change', function() {
		hotelname = $(this).children(":selected").attr("id");
		document.getElementById("allowednumber").innerHTML = "Max. Room No. <b>"+hotelname+"</b>";
	});
$(function () {
    $("#update_device_form").validate({
        rules: {
            hotelname: "required",
            /*roomnumber:{
				number: true,
				min: 1,
				max: function() {
					return parseInt(hotelname);
				}
			},*/
			macaddress: "required"

        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#update_device_form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/DeviceController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
						window.location.href='devicelist.php';
						$('#adddevice-modal').modal('hide');
                        $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Updated Device.</p></div>");
						$('#popalert').show();
					}else if(data == "exist"){
						$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Room Number is already in use.</p></div>");
						console.log(data);
					}else {
						$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Device. Please try again.</p></div>");
						console.log(data);
					}
                    
                }
            });
        }
    })
});
</script>