<?php 
      include("model/RestaurantClass.php");
      $restaurant_ID = $_GET['id'];
      $restaurant_db = new Restaurant();
      $restaurant_lists = $restaurant_db->fetchRestaurantInformation($restaurant_ID);
?>
<link rel="stylesheet" type="text/css" href="assets/css/timepicki.css">
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Update Restaurant</h2>
    </div>
</div>
<?php foreach ($restaurant_lists as $restaurant_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Restaurant Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
					<div class="col-sm-3">
                          <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/","", $restaurant_list['hotel_name']);?>/restaurant/<?=preg_replace("/[^a-zA-Z]+/","",$restaurant_list['restaurant_name']);?>/<?=$restaurant_list['image'];?>" class="center-block" width="200">
                    </div>
                    <div class="col-sm-9">
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Restaurant Name</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $restaurant_list['restaurant_name'];?></div>
                        </div>
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Description</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $restaurant_list['description'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Time Open</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $restaurant_list['time_open'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Time Closed</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $restaurant_list['time_close'];?></div>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h4>Update Restaurant Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="edit_restaurant_form">
            <!--
            |================================
            |========Restaurant Details======
            |================================
            -->
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <input type="hidden" class="form-control"  name="hotel_ID" value="<?=$hotelid;?>"/>
                    <input type="hidden" class="form-control" id="restaurant_ID"  name="restaurant_ID" value="<?php echo $_GET['id']; ?>"/>
                    <div class="col-sm-4">
                        <label class="control-label">Restaurant Name</label> <small> ( required ) </small>
                        <div class="inner cover indexpicker">
                            <input type="text" class="form-control" id="restaurant_name"  name="restaurant_name"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Open Restaurant</label><small> ( required ) </small>
                        <div class='input-group'>
                            <input type="text" class="form-control" id="timepicker1" name="timepicker1" value="">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Closed Restaurant</label><small> ( required ) </small>
                        <div class='input-group'>
                            <input type="text" class="form-control" id="timepicker2" name="timepicker2" value="">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div> 
                    <div class="col-sm-4"><br/>
                        <label class="control-label">Description</label><small> ( required ) </small>
                        <textarea class="form-control" rows="5" name="description" id="descriptions"></textarea>
                        <input type="hidden" class="form-control" rows="5"  value="" />
                    </div>
                    <div class="col-sm-4"><br/>
                        <label class="control-label">Image</label><small> ( optional ) </small>
                         <div class="input-group image-preview col-sm-12">
                            <input type="text" name="img_restaurant" id="restaurant_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" name="restaurant_logo_image" id="restaurant_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="restaurant.php" class="btn btn-info" name="action" type="submit" style="padding-top:10px;">Back</a>
                            <button class="btn btn-info" name="action" value="Edit Restaurant" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/timepicki.js"></script>
<script type="text/javascript"  src="js/image_input.js"></script>
<script>
	$('#timepicker1').timepicki();
    $('#timepicker2').timepicki();
</script>
<script>
$("#loadthis").addClass('loader-show');
var restaurant_ID = $("#restaurant_ID").val();
var data = [];
data.push({"name":"action","value":"Get Restaurant By ID"});
data.push({"name":"restaurant_ID","value":restaurant_ID});
$.post(
    'controller/RestaurantController.php',
    data,
    function(info) {
        showFeature(info);
        $("#loadthis").removeClass('loader-show');
    }
);

    
function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}
    
$("#edit_restaurant_form").validate({
    rules: {
        restaurant_name: "required",
        timepicker1: "required",
        timepicker2: "required",
        description: "required",
        img_restaurant: "required"
    },  
    submitHandler: function(form) {
        $("#loadthis").addClass('loader-show');
		
		/* image upload */
		var logo_img = $('#restaurant_logo_image')[0].files[0];
		var logo_error = 1;
		var datafields = new FormData($("form")[3]);
		
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
		
		if(logo_error == 1){
			console.log("fail ang duha ka image");
		}else if(logo_error == 1){
			console.log("fail ang logo");
		}
		/* end */
		/* use logo_error for checking before proceeding to ajax */
        
		if(logo_error == 0){ // checking
			$.ajax({
				type:"POST",
				enctype: 'multipart/form-data', //part of image upload
				url:"controller/RestaurantController.php",
				data: datafields,
				processData: false, //part of image upload
				contentType: false, //part of image upload
				timeout: 600000, //part of image upload
				success: function(data) {
					var result = $.trim(data);
					if(result == "true") {
						$('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Restaurant!</p></div>");
					}else {
						$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Restaurant. Please try again!</p></div>");
					}
					console.log(result);
					$("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
				 }
			});
		 }
     }
});
    
function showFeature(Restaurant) {
    var restaurant_info = JSON.parse(Restaurant);
    $("#restaurant_name").val(restaurant_info[2]);
    $("#timepicker1").val(restaurant_info[3]);
    $("#timepicker2").val(restaurant_info[4]);
    $("#descriptions").val(restaurant_info[5]);
    $("#restaurant_logo").val(restaurant_info[6]);
}
</script>