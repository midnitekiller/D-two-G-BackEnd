<?php
      include("model/ChannelClass.php");
      $Channelad_db = new Channels();
      $ads_lists = $Channelad_db->fetchChannelAdsall($hotelid);
?>
<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> Channel Advisory </label>
                <a class="buttonsp" name="action" value="" type="submit" data-toggle="modal" id="addads"><i class="fa fa-plus"></i> Create New Channel Advisory</a>
            </div>
            <div id="data_handler" class="ibox-content"> 
                <table id="data_display" class="table table-bordered dynamicDataTables" id="FAQListTable">
                    <thead>
                        <tr>
                            <th class="text-center" width="50">ID</th>
                            <th class="text-center">Channel Advisory</th>
                            <th class="text-center" width="150">Date Registered</th>
                            <th class="text-center" width="150">Status</th>
                            <th class="text-center" width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ads_lists as $ads_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $ads_list['ticker_ID'];?></td>
                            <td class="text-center"><?php echo $ads_list['ticker_description'];?></td>
                            <td class="text-center"><?php echo $ads_list['created_at'];?></td>
                            <td class="text-center">
                                <label class="switch">
                                  <input id="<?=$ads_list['ticker_ID'];?>" type="checkbox" <?=($ads_list['status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                                  <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="update-channelad.php?id=<?php echo $ads_list['ticker_ID']; ?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $ads_list['ticker_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button id="addChannelAds" class="material-button material-button-toggle" title="Add Channel Ads" data-toggle="modal" data-target="channelads-modal"><span class="fa fa-plus" aria-hidden="true"></span></button>
<!-- Modal hotel faq -->
<div id="channelads-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Channel Advisory</h4>
        <div id="mssg_ads"></div>
      </div>
      <!-- content of channel ads -->
      <div class="modal-body">
          <div class="row">
              <form method="post" id="AdsForms">
                  <div class="col-sm-12">
                        <input type="hidden" class="form-control" rows="5" name="hotel_ID" value="<?=$hotelid;?>" />
                        <div class="col-sm-12"><br/>
                            <label class="control-label">Advisory Description</label><small> ( required ) </small>
                            <textarea class="form-control" rows="5" id="ads_description" name="ads_description"></textarea>
                            <input type="hidden" class="form-control" rows="5" value="" />
                        </div>
						<br/>
						<div class="col-lg-6">
							<label class="control-label">Display Advisory Every</label><small> ( required ) </small>
							<div class='input-group'>
								<input type="time" class="form-control" id="advisory_show" name="advisory_show" value="">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
						</div>
						<div class="col-lg-6">
							<label class="control-label">Duration</label> <small>( required ) </small>
							<select name="duration" id="duration" class="form-control m-b">
								<option value="">-- Select --</option>
								<option value="3000" >3 seconds</option>
								<option value="5000" >5 seconds</option>
								<option value="10000" >10 seconds</option>
								<option value="15000" >15 seconds</option>
								<option value="20000" >20 seconds</option>
								<option value="25000" >25 seconds</option>
								<option value="30000" >30 seconds</option>
								<option value="35000" >35 seconds</option>
								<option value="45000" >45 seconds</option>
								<option value="60000" >60 seconds</option>
							</select>
						</div>
                        <div class="col-sm-12"><br/>
                            <button class="btn btn-info" name="action" value="add ChannelAds" type="submit" style="float:right;">Submit</button>
                        </div>
                  </div>
              </form>
        </div>
      </div><br/>
      <!-- end content of channel ads --> 
    </div>
  </div>
</div>

<?php include'views/script-foot.php' ?>

<script>
$(document).ready(function(){
    $('#addChannelAds').on('click',function(){
       $('#channelads-modal').modal().show();
        return false;
    });
    $('#addads').on('click',function(){
       $('#channelads-modal').modal().show();
        return false;
    });
	
});
    

function deleteThis(element) {
    var ticker_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove ChannelAds"});
        data.push({"name":"ticker_ID","value":ticker_ID});
        $.post(
            'controller/ChannelController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Deleted Channel Ad.</p></div>");
            $("#loadthis").removeClass('loader-show');
            setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        );
    }
}
    
function updateStatus(checkbox){
var status;
var id = checkbox.id;
	 if(document.getElementById(id).checked){
		 status = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Activated Channel Advisory.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully DeActivated Advisory.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
     $.ajax({
		type:"POST",
		url:"controller/ChannelController.php",
		data: {
			action : "Status ChannelAds",
			status : status,
			ticker_ID : id
		},
		success: function(data) {
			
		}
	}); 
 } 
$(document).ready(function(){
    var datatable = $("#display_data").DataTable({
        "order":[[2,"desc"]],
        "aoColumnDefs":[{
            'bSortable' : false,
            'aTargets'  : [3]
        }]
    });

    $("#AdsForms").validate({
        rules: {
            ads_description: "required",
			advisory1: "required",
			advisory2: "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/ChannelController.php",
                data: datafields,
                success: function(data) {
                    var result = $.trim(data);
                    if(result == "true") {
                       datatable.destroy();
                       $('#data_handler').load("channelad.php #data_display", function(){
                         $("#display_data").DataTable({
                            "order":[[2,"desc"]],
                            "aoColumnDefs":[{
                                'bSortable' : false,
                                'aTargets'  : [3]
                            }]
                         });
                       });
                       $('#mssg_ads').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Added an Advisory.</p></div>");
                    }else {
                       $('#mssg_ads').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add an Advisory. Please try again!</p></div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg_ads').html(""); }, 4000);
                }
            });
         }
    });
});
</script>