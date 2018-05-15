<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>TV Application</h2>
    </div>
</div>
<br/>
<div class="row">
	<div class="col-lg-3">
		<div class="ibox">
			<div class="ibox-title">
				<h4>Hotel Logo
					
				</h4>
			</div>
			<div class="ibox-content sizelogo text-center"> 
				<form method="post"  id="">
					<div class="apphotel_logo">
						<center><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel_name);?>/logo/<?=$hotel_image;?>" class="img-responsive" alt="" class="center-block"></center>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-4"><br/>
		<label class="control-label">Hotel Logo</label><small> ( required ) </small>
		<div class="input-group image-preview col-sm-12">
			<input type="text" name="hotel_logo" class="form-control image-preview-filename" value="<?=$hotel_image;?>"> <!-- don't give a name === doesn't send on POST/GET -->
			<span class="input-group-btn">
				<!-- image-preview-clear button -->
				<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
					<span class="glyphicon glyphicon-remove"></span> Clear
				</button>
				<!-- image-preview-input -->
				<div class="btn btn-default image-preview-input">
					<span class="glyphicon glyphicon-folder-open"></span>
					<span class="image-preview-input-title">Choose File</span>
					<input type="file" accept="image/png, image/jpeg, image/gif" name="hotel_logo_img" id="hotel_logo_img"/> <!-- rename it -->
				</div>
			</span>
		</div>
		<div class="col-sm-12">
			<button class="btn btn-info" name="action" value="Update Hotel" type="submit">Submit</button>
		</div>
	</div>
	
</div>
<div class="hr-line-dashed"></div>
<div class="row">
	<div class="col-lg-3">
		<div class="ibox">
			<div class="ibox-title">
				<h4>Hotel Background
					
				</h4>
			</div>
			<div class="ibox-content sizelogo text-center"> 
				<form method="post"  id="">
					<div class="apphotel_logo">
						<center><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel_name);?>/background/<?=$background_image;?>" class="img-responsive" alt="" class="center-block"></center>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-4"><br/>
		<label class="control-label">Hotel Background</label><small> ( optional ) </small>
		 <div class="input-group image-preview1 col-sm-12">
			<input type="text" name="back_logo" class="form-control image-preview-filename1" value="<?=$background_image;?>"> <!-- don't give a name === doesn't send on POST/GET -->
			<span class="input-group-btn">
				<!-- image-preview-clear button -->
				<button type="button" class="btn btn-default image-preview-clear1" style="display:none;">
					<span class="glyphicon glyphicon-remove"></span> Clear
				</button>
				<!-- image-preview-input -->
				<div class="btn btn-default image-preview-input1">
					<span class="glyphicon glyphicon-folder-open"></span>
					<span class="image-preview-input-title1">Choose File</span>
					<input type="file" accept="image/png, image/jpeg, image/gif" name="back_logo_img" id="back_logo_img"/> <!-- rename it -->
				</div>
			</span>
		</div>
		<div class="col-sm-12">
			<button class="btn btn-info" name="action" value="Update Hotel" type="submit">Submit</button>
		</div>
	</div>
</div>
<!--
|================================
|==========Confirm Button========
|================================
-->
<br/>
<script>
function updateStatus(checkbox){
     var status;
     var id = checkbox.id;
     if(document.getElementById(id).checked){
         status = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Activated Hotel Photo!</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
     }else{
         status = "inactive";
         $('#mssg').html("<div class='alert-labeled-row'><span class='alert-label alert-label-left alert-labelled-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deactivated Hotel Photo!</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
     }

     $.ajax({
        type:"POST",
        url:"controller/HotelController.php",
        data: {
            action : "Status Hotel_Photo",
            status : status,
            access_ID : id
        },
        success: function(data) {
        }
    }); 
}  
</script>