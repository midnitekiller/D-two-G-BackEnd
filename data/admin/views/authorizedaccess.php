<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Authorized Access</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <form method="POST" action="">
	<?php foreach ($access as $values => $acc): ?>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?=$acc['real_name'];?></h5>
					<label class="switch pull-right" data-toggle="tooltip" title="Status">
						<input id="<?=$acc['access_ID'];?>" type="checkbox" <?=($acc['admin_status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateAccess(this);">
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
    </form>
</div>
<script>
function updateAccess(checkbox){
     var status;
     var id = checkbox.id;
     if(document.getElementById(id).checked){
         status = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Activated authorized access status!</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
     }else{
         status = "inactive";
         $('#mssg').html("<div class='alert-labeled-row'><span class='alert-label alert-label-left alert-labelled-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deactivated authorized access status!</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
     }

     $.ajax({
        type:"POST",
        url:"controller/HotelController.php",
        data: {
            action : "Status AccessAdmin",
            status : status,
            access_ID : id
        },
        success: function(data) {
        }
    }); 
}  
</script>