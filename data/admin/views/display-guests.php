<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label>ALL GUESTS</label>
                <a class="buttonsp" id="addguest" name="action" value="" type="submit"><i class="fa fa-plus"></i> Create New Guests</a>
            </div>
            <div class="ibox-content"> 
                <table id="#GuestListTable" class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Room No.</th>
                            <th class="text-center">Check In Date</th>
                            <th class="text-center">Check Out Date</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Date Registered</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guests as $values => $guests_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $guests_list['lastname'].", ".$guests_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $guests_list['room_no'];?></td>
                            <td class="text-center"><?php echo $guests_list['check_in'];?></td>
                            <td class="text-center"><?php echo $guests_list['check_out'];?></td>
                            <td class="text-center"><?php echo $guests_list['email'];?></td>
                            <td class="text-center"><?php echo $guests_list['phone'];?></td>
                            <td class="text-center"><?php echo $guests_list['address'];?></td>
                            <td class="text-center"><?php echo $guests_list['created_at'];?></td>
                            <td class="text-center">
                                <label class="switch">
                                  <input id="<?=$guests_list['guest_ID'];?>" type="checkbox" <?=($guests_list['status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                                  <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="update-guests.php?id=<?php echo $guests_list['guest_ID']; ?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $guests_list['guest_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button id="btnaddguest" class="material-button material-button-toggle" title="Add Guests"><span class="fa fa-plus" aria-hidden="true"></span></button>
<script type="text/javascript"  src="js/view_guests.js"></script>
<?php include'views/script-foot.php' ?>

<script>
$(function () {
    $("#GuestListTable").DataTable({
        "iDisplayLength": 15,
        "order": [[ 0,"desc"]]
    });
});

function deleteThis(element) {
    var guest_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Guests"});
        data.push({"name":"guest_ID","value":guest_ID});
        $.post(
            'controller/GuestsController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted Guest!</p></div>");
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
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Guest is now Active.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Check-Out Guest.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
     $.ajax({
		type:"POST",
		url:"controller/GuestsController.php",
		data: {
			action : "Status Guests",
			status : status,
			guest_ID : id
		},
		success: function(data) {
		}
	});
	 
 }  
</script>
