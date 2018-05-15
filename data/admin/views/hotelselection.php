
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Hotel App User List</h2>
    </div>
</div>
<br/>
<div id="mssg"></div><br/>
<?php foreach($hotels as $values => $hotel): ?>
<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-title">
            <h4><?=$hotel['hotel_name'];?>
                <label class="switch pull-right" data-toggle="tooltip" title="Status">
                    <input id="<?=$hotel['hotel_ID'];?>" type="checkbox" <?=($hotel['hotel_status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                    <span class="slider round"></span>
                </label>
            </h4>
        </div>
        <div class="ibox-content sizelogo text-center"> 
			<div class="apphotel_logo">
				<center><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel['hotel_name']);?>/logo/<?=$hotel['hotel_image'];?>" class="img-responsive" alt="" class="center-block"></center>
				 <a class="inline-link-2" href="hotelupdate.php?hotel_id=<?=$hotel['hotel_ID'];?>">View Details</a>
			</div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<script type="text/javascript"  src="js/image_input.js"></script>
<script>
/*
|================================|
|==selector button update hotel==|
|================================|
*/
 function updateStatus(checkbox){
	 var status;
	 var id = checkbox.id;
	 if(document.getElementById(id).checked){
		 status = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Activated Hotel Profile.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully DeActivated Hotel Profile.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
	 $.ajax({
		type:"POST",
		url:"controller/HotelController.php",
		data: {
			action : "Hotel Status",
			hotel_status : status,
			hotel_id : id
		},
		success: function(data) {
			/*location.reload()*/
		}
	});
	 
 }
</script>