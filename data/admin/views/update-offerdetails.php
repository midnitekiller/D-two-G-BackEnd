<?php 
      include("model/OfferClass.php");
      $offerdetail_ID = $_GET['id'];
      $offer_db = new Offer();
      $offer_lists = $offer_db->fetchOfferDetailInformation($offerdetail_ID);
      $offerType_lists = $offer_db->fetchOfferType($hotelid);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Update Offer Details</h2>
    </div>
</div>
<?php foreach ($offer_lists as $offer_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Offer Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
					<div class="col-sm-3">
                          <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $offer_list['hotel_name']);?>/offer/<?=$offer_list['image'];?>" class="center-block" width="200">
                    </div>
                    <div class="col-sm-9">
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Offer Name</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['offerdetail_name'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Offer Type</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['offer_name'];?></div>
                        </div>
						<div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Duration</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['duration'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Original Price</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['original_price'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Selling Price</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['selling_price'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Description</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['offer_description'];?></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-6"><?php echo $offer_list['created_at'];?></div>
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
            <form method="post"  id="edit_offerdetail_form">
            <!--
            |================================
            |=========Offer Details=======
            |================================
            -->
                <div class="row">
                    <input type="hidden" class="form-control" id="offerdetail_ID"  name="offerdetail_ID" value="<?php echo $_GET['id']; ?>"/>
                    <div class="col-sm-4">
                        <label class="control-label">Offers Detail Name</label><small> ( required ) </small>
                        <input type="text" class="form-control" id="offerdetail_name" name="offerdetail_name" value="" >
                        <input type="hidden" class="form-control" name="hotel_ID" value="<?=$hotelid;?>" >
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Offers Type</label> <small>( required ) </small>
                        <select class="form-control m-b" id="offer_ID" name="offer_ID"> 
                            <option value="">-- Select --</option>
                            <?php foreach ($offerType_lists as $offerType_list): ?>
                            <option value="<?php echo $offerType_list['offer_ID'];?>"><?php echo $offerType_list['offer_name'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Duration</label><small> ( optional ) </small>
                        <input type="text" class="form-control" id="duration" name="duration" value="" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Original Price</label><small> ( required ) </small>
                        <input type="text" class="form-control" id="o_price" name="o_price" value="" >
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Selling Price</label><small> ( required ) </small>
                        <input type="text" class="form-control" id="s_price" name="s_price" value="" >
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Image</label><small> ( required ) </small>
                         <div class="input-group image-preview col-sm-12">
                            <input type="text" name="img_offer" id="offer_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" name="offer_logo_image" id="offer_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Description</label><small> ( required ) </small>
                        <textarea class="form-control" rows="5" id="descriptions" name="description"></textarea>
                        <input type="hidden" class="form-control" rows="5" name="" value="" />
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="offer_detail.php" class="btn btn-info" name="action" type="submit" style="padding-top:10px;">Back</a>
                            <button class="btn btn-info" name="action" value="Edit Offer Detail" type="submit">Submit</button>
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
    var offerdetail_ID = $("#offerdetail_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get Offer Detail By ID"});
    data.push({"name":"offerdetail_ID","value":offerdetail_ID});
    $.post(
        'controller/OfferController.php',
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
    $("#edit_offerdetail_form").validate({
        rules: {
            offerdetail_name  : "required",
            description       : "required",
            duration          : "required",
            offer_ID          : "required",
            o_price           : {required:true,number: true },
            s_price           : {required:true,number: true },
            img_offer         : "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');

            /* image upload */
            var logo_img = $('#offer_logo_image')[0].files[0];
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
                    url:"controller/OfferController.php",
                    data: datafields,
                    processData: false, //part of image upload
                    contentType: false, //part of image upload
                    timeout: 600000, //part of image upload
                    success: function(data) {
                        var result = $.trim(data);
                        if(result == "true") {
                            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Offer Detail.</p></div>");
                        }else {
                            $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Offer Detail. Please try again!</p></div>");
                        }
                        $("#loadthis").removeClass('loader-show');
                        setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    }
                });
            }
         }
    });
});    
    
function showFeature(Offer) {
    var offer_info = JSON.parse(Offer);
    /*$("#offer_ID").append("<option value="+offer_info[0]+">"+offer_info[0]+"</option>");
    $("#offer_ID").val(offer_info[0]);*/
    $("#offerdetail_name").val(offer_info[4]);
    $("#descriptions").val(offer_info[5]);
    $("#s_price").val(offer_info[6]);
    $("#o_price").val(offer_info[7]);
    $("#duration").val(offer_info[8]);
    $("#offer_logo").val(offer_info[9]);
}
</script>