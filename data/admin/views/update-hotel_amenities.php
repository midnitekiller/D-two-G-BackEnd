<?php 
      include("model/HotelAmenitiesClass.php");
      $amenities_ID = $_GET['id'];
      $amenities_db = new Amenities();
      $amenities_lists = $amenities_db->fetchAmenitiesInformation($amenities_ID);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Update Amenities</h2>
    </div>
</div>
<?php foreach ($amenities_lists as $amenities_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Amenities Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
					<div class="col-sm-3">
                        <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $amenities_list['hotel_name']);?>/amenities/<?=$amenities_list['amenities_name'];?>/<?=$amenities_list['image'];?>" class="center-block" width="200">
                    </div>
                    <div class="col-sm-9">
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Amenities Name</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $amenities_list['amenities_name'];?></div>
                        </div>
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Amenities Type</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $amenities_list['amenities_type'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Description</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $amenities_list['description'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $amenities_list['created_at'];?></div>
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
            <h4>Update Amenities Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="edit_amenities_form">
            <!--
            |================================
            |========Amenities Details======
            |================================
            -->
                <div class="row">
                    <input type="hidden" class="form-control" id="amenities_ID"  name="amenities_ID" value="<?php echo $_GET['id']; ?>"/>
                    <div class="col-sm-6">
                        <label class="control-label">Amenities Name</label> <small> ( required ) </small>
                        <input type="text" class="form-control" id="amenities_name"  name="amenities_name"/>
                        <input type="hidden" class="form-control" name="hotel_ID" value="<?=$hotelid;?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Amenities Type</label> <small>( optional ) </small>
                        <select name="amenities_type" id="amenities_type" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Room">Room</option>
                        </select>
                    </div>
                    <div class="col-sm-6"><br/>
                        <label class="control-label">Description</label><small> ( required ) </small>
                        <textarea class="form-control" rows="5" name="description" id="descriptions"></textarea>
                        <input type="hidden" class="form-control" rows="5"  value="" />
                    </div>                   
                    <div class="col-sm-6"><br/>
                        <label class="control-label">Image</label><small> ( required ) </small>
                         <div class="input-group image-preview col-sm-12">
                            <input type="text" name="img_amenities" id="img_amenities" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" name="amenities_logo_image" id="amenities_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="amenities.php" class="btn btn-info" name="action" type="submit" style="padding-top:10px;">Back</a>
                            <button class="btn btn-info" name="action" value="Edit Amenities" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript"  src="js/image_input.js"></script>

<script>
$("#loadthis").addClass('loader-show');
    var amenities_ID = $("#amenities_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get Amenities By ID"});
    data.push({"name":"amenities_ID","value":amenities_ID});
    $.post(
        'controller/HotelAmenitiesController.php',
        data,
        function(info) {
            showFeature(info);
            $("#loadthis").removeClass('loader-show');
        }
    );
    
function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}
    
$("#edit_amenities_form").validate({
    rules: {
        amenities_name: "required",
        amenities_type: "required",
        description: "required",
        img_amenities: "required"
    },  
    submitHandler: function(form) {
        $("#loadthis").addClass('loader-show');

        /* image upload */
        var logo_img = $('#amenities_logo_image')[0].files[0];
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
                url:"controller/HotelAmenitiesController.php",
                data: datafields,
                processData: false, //part of image upload
                contentType: false, //part of image upload
                timeout: 600000, //part of image upload
                success: function(data) {
                    var result = $.trim(data);
                    if(result == "true") {
                         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Amenities.</p></div>");
                    }else {
                         $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Amenities. Please try again!</p></div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                 }
            });
        }
     }
});
 
function showFeature(Amenities) {
    var amenities_info = JSON.parse(Amenities);
    $("#amenities_name").val(amenities_info[2]);
    $("#amenities_type").val(amenities_info[3]);
    $("#descriptions").val(amenities_info[4]);
    $("#img_amenities").val(amenities_info[5]);
}
</script>