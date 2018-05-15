<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Authorize Access</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
	<?php foreach($access as $key => $acc): ?>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?=$acc['real_name'];?></h5>
					<label class="switch pull-right" data-toggle="tooltip" title="Status">
						<input id="<?=$acc['access_name'];?>" type="checkbox" <?=($acc['status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateAccess(this);">
						<span class="slider round"></span>
					</label>
				</div>
				<div class="ibox-content text-center">
					<div class="apphotel_logo">
						<center><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/","",$hotelname);?>/logo/<?=$hotel_logo;?>" class="img-responsive" alt="" class="center-block"></center>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
<script>
 function updateAccess(checkbox){
	 var status, adstatus;
	 var an = checkbox.id;
	 var hotelid = "<?=$hotelid;?>";
	 if(document.getElementById(an).checked){
		 status = "active";
		 adstatus = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Activated.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
		 adstatus = "off";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully DeActivated.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
	 $.ajax({
		type:"POST",
		url:"controller/HotelController.php",
		redirect: false,
		data: {
			action : "Access Status",
			access_status : status,
			admin_status : adstatus,
			accessname : an,
			hotel_id : hotelid
		},
		success: function(data) {
			console.log(data);
		}
	});
 }
</script>