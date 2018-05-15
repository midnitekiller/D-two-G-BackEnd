<?php //we will change this soon...
      include("model/FeedbackClass.php");
      $feedback_db = new Feedback();
      $hotel_lists = $feedback_db->fetchViewAllHotel();
?>
<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> All Devices Registered </label>
            </div>
            <div class="ibox-content"> 
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Hotel Name</label> <small>( required ) </small>
                            <select class="form-control m-b" name="hotel_name" id="hotel_name"> 
                                <option value="">-- Select --</option>
                                <?php foreach ($hotel_lists as $hotel_list): ?>
                                <option id="<?php echo $hotel_list['hotel_ID'];?>" value="<?php echo $hotel_list['hotel_name'];?>"><?php echo $hotel_list['hotel_name'];?></option>
                                <?php endforeach ?>
                            </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> All Device </label>
                <a class="buttonsp" id="adddevice" name="action" value="" type="submit"><i class="fa fa-plus"></i> Create New Device</a>
            </div>
            <div class="ibox-content"> 
                <table id="sorting_data" class="table dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Hotel Name</th>
                            <th class="text-center">Room Number Name</th>
                            <th class="text-center">Device UID/ Mac Address</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
						<?php foreach($devices as $values => $device): ?>					
                        <tr class="lists-item">
                            <td class="text-center"><?=$device['devid'];?></td>
                            <td class="text-center"><?=$device['hotelname'];?></td>
                            <td class="text-center"><?=$device['roomno'];?></td>
                            <td class="text-center"><?=$device['maccadd'];?></td>
                            <td class="text-center"><?=($device['status'] == "active") ? "<label class=\"label-info\" style=\"padding-left:5px;padding-right:5px;\"><h5>Guests Assigned</h5></label>" : "";?></td>
                            <td class="text-center">
                                <a href="editdevice.php?device_id=<?=$device['devid'];?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-trash fa-2x" data-toggle="tooltip" id="<?=$device['devid'];?>" onclick='deleteThis(this)' title="Delete" style="color:#333;"></i>
                            </td>
                        </tr>
						<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- add Device Button-->
<button class="material-button material-button-toggle" id="btnadddevice" title="Add Device"><span class="fa fa-plus" aria-hidden="true"></span></button>
<?php include'views/script-foot.php' ?>
<script>
function deleteThis(element) {
    var device_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Device"});
        data.push({"name":"device_ID","value":device_ID});
        $.post(
            'controller/DeviceController.php',
            data,
            function(data) {
				switch(data){
					case 'true':
				        $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Deleted Device.</p></div>");
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#mssg').html(""); }, 4000);
						break;
					default:
						break;
				}
            }
        );
    }
}
    
$(document).ready(function() {
    var table = $('#sorting_data').DataTable();
    $('#hotel_name').on('change', function () {
        table.columns(1).search( this.value).draw();
    });
});
</script>