<?php 
      include("model/ServicesClass.php");
      $serviceProd_ID = $_GET['id'];
      $services_db = new Services();
      $services_lists = $services_db->fetchServicesDetailInformation($serviceProd_ID);
      $servicesType_lists = $services_db->fetchServicesType($hotelid);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Update Services Detail</h2>
    </div>
</div>
<?php foreach ($services_lists as $services_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Service Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
					<div class="col-sm-3">
                          <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $services_list['hotel_name']);?>/services/<?=$services_list['image'];?>" class="center-block" width="200">
                    </div><br/>
                    <div class="col-sm-9">
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Service Name</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $services_list['serviceProdName'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Price</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $services_list['serviceProdPrice'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Service Type</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $services_list['serviceName'];?></div>
                        </div>
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Duration</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $services_list['duration'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Description</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $services_list['serviceProdDesc'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $services_list['created_at'];?></div>
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
            <h4>Update Services Detail</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="edit_services_form">
            <!--
            |================================
            |=========Services Details=======
            |================================
            -->
                <div class="row">
                    <input type="hidden" class="form-control" id="serviceProd_ID"  name="serviceProd_ID" value="<?php echo $_GET['id']; ?>"/>
                    <div class="col-sm-4">
                        <label class="control-label">Service Name</label> <small> ( required ) </small>
                        <input type="text" class="form-control" id="services_detail_name"  name="services_detail_name"/>
                        <input type="hidden" class="form-control" name="hotel_ID" value="<?=$hotelid;?>" >
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Service Price</label> <small> ( required ) </small>
                        <input type="text" class="form-control" id="service_price"  name="service_price"/>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Services Type</label> <small>( required ) </small>
                        <select class="form-control m-b" name="service_ID" ID="service_ID"> 
                            <option value="">-- Select --</option>
                            <?php foreach ($servicesType_lists as $servicesType_list): ?>
                            <option id="<?php echo $servicesType_list['service_ID'];?>" value="<?php echo $servicesType_list['service_ID'];?>"><?php echo $servicesType_list['serviceName'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Duration</label> <small> ( required ) </small>
                        <input type="text" class="form-control" id="duration"  name="duration"/>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Description</label><small> ( required ) </small>
                        <textarea class="form-control" rows="5" name="description" id="descriptions"></textarea>
                        <input type="hidden" class="form-control" rows="5"  value="" />
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Image</label><small> ( required ) </small>
                         <div class="input-group image-preview col-sm-12">
                            <input type="text" name="img_service" id="services_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" name="services_logo_image" id="services_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="services_detail.php" class="btn btn-info" name="action" type="submit" style="padding-top:10px;">Back</a>
                            <button class="btn btn-info" name="action" value="Edit Services Detail" type="submit">Submit</button>
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
    var serviceProd_ID = $("#serviceProd_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get Services Detail By ID"});
    data.push({"name":"serviceProd_ID","value":serviceProd_ID});
    $.post(
        'controller/ServicesController.php',
        data,
        function(info) {
            showFeature(info);
            $("#loadthis").removeClass('loader-show');
        }
    );
    
function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}
    
$(document).ready(function(){
    $("#edit_services_form").validate({
        rules: {
            services_detail_name  : "required",
            service_ID            : "required",
            duration              : "required",
            service_price         : {required:true,number: true },
            description           : "required",
            img_service          : "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');

            /* image upload */
            var logo_img = $('#services_logo_image')[0].files[0];
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
                    url:"controller/ServicesController.php",
                    data: datafields,
                    processData: false, //part of image upload
                    contentType: false, //part of image upload
                    timeout: 600000, //part of image upload
                    success: function(data) {
                        var result = $.trim(data);
                        if(result == "true") {
                            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Services Detail.</p></div>");
                        }else {
                            $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Services Detail. Please try again!</p></div>");
                        }
                        $("#loadthis").removeClass('loader-show');
                        setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    }
                });
            }
         }
    });
});    
    
function showFeature(Services) {
    var service_info = JSON.parse(Services);
    $("#services_detail_name").val(service_info[4]);
    $("#service_price").val(service_info[6]);
    $("#service_ID").append("<option value="+service_info[0]+">"+service_info[0]+"</option>");
    //$("#service_ID").val(service_info[0]);
    $("#duration").val(service_info[7]);
    $("#descriptions").val(service_info[5]);
    $("#services_logo").val(service_info[8]);
}
</script>