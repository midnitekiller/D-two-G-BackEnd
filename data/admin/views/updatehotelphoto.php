<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Update Hotel Logo and Background</h2>
    </div>
</div>
<br/>
<?php foreach ($hotel as $values => $hotel_list): ?>
<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-title">
            <h4>Hotel Logo
                <a class="fa fa-pencil pull-right" data-toggle="tooltip" title="Edit" style="color:green;font-size:20px;"></a>
                <label class="switch pull-right" data-toggle="tooltip" title="Status">
                    <input id="<?=$hotel_list['hotel_ID'];?>" type="checkbox" <?=($hotel_list['hotel_status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                    <span class="slider round"></span>
                </label>
            </h4>
        </div>
        <div class="ibox-content sizelogo text-center"> 
            <form method="post"  id="">
                <div class="apphotel_logo">
                    <center><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel_list['hotel_name']);?>/logo/<?=$hotel_list['hotel_image'];?>" class="img-responsive" alt="" class="center-block"></center>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-title">
            <h4>Hotel Background
                <a class="fa fa-pencil pull-right" data-toggle="tooltip" title="Edit" style="color:green;font-size:20px;"></a>
                <label class="switch pull-right" data-toggle="tooltip" title="Status">
                    <input id="<?=$hotel_list['hotel_ID'];?>" type="checkbox" <?=($hotel_list['hotel_status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                    <span class="slider round"></span>
                </label>
            </h4>
        </div>
        <div class="ibox-content sizelogo text-center"> 
            <form method="post"  id="">
                <div class="apphotel_logo">
                    <center><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel_list['hotel_name']);?>/background/<?=$hotel_list['background_image'];?>" class="img-responsive" alt="" class="center-block"></center>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>
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