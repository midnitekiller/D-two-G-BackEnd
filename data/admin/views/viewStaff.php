
<style>
/*.loader{
    width: 70px;
    height: 70px;
    margin: 40px auto;
}
.loader p{
    font-size: 16px;
    color: #777;
}
.loader .loader-inner{
    display: inline-block;
    width: 15px;
    border-radius: 15px;
    background: #74d2ba;
}
.loader .loader-inner:nth-last-child(1){
    -webkit-animation: loading 1.5s 1s infinite;
    animation: loading 1.5s 1s infinite;
}
.loader .loader-inner:nth-last-child(2){
    -webkit-animation: loading 1.5s .5s infinite;
    animation: loading 1.5s .5s infinite;
}
.loader .loader-inner:nth-last-child(3){
    -webkit-animation: loading 1.5s 0s infinite;
    animation: loading 1.5s 0s infinite;
}
@-webkit-keyframes loading{
    0%{
        height: 15px;
    }
    50%{
        height: 35px;
    }
    100%{
        height: 15px;
    }
}
@keyframes loading{
    0%{
        height: 15px;
    }
    50%{
        height: 35px;
    }
    100%{
        height: 15px;
    }
}*/
    

</style>



<!--<div class="row">
    <div class="col-md-12">
        <div class="loader" id="loader">
            <p>Loading...</p>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
        </div>
    </div>
</div>-->
<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> All Staff </label>
                <a class="buttonsp" id="addstaff" name="action" value="" type="submit"><i class="fa fa-plus"></i> Create New Staff</a>
            </div>
            <div class="ibox-content"> 
                <table id="#StaffListTable" class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff_lists as $staff_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $staff_list['staff_ID'];?></td>
                            <td class="text-center"><?php echo $staff_list['lastname'].", ".$staff_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $staff_list['phone'];?></td>
                            <td class="text-center"><?php echo $staff_list['address'];?></td>
                            <td class="text-center"><?php echo $staff_list['email'];?></td>
                            <td class="text-center">
                                <label class="switch">
                                  <input id="<?=$staff_list['staff_ID'];?>" type="checkbox" <?=($staff_list['status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                                  <span class="slider round"></span>
                                </label>
                            </td>
                             <td class="text-center">
                                <a href="update-staff.php?id=<?php echo $staff_list['staff_ID']; ?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $staff_list['staff_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Add Staff Button-->
<button id="btnaddStaff" class="material-button material-button-toggle" title="Add Staff" ><span class="fa fa-plus" aria-hidden="true"></span></button>

<script type="text/javascript"  src="js/staff.js"></script>
<?php include'views/script-foot.php' ?>

<script>
$(function () {
    $("#StaffListTable").DataTable({
        "iDisplayLength": 15,
        "order": [[ 0,"desc"]]
    });
});

function deleteThis(element) {
    var staff_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Staff"});
        data.push({"name":"staff_ID","value":staff_ID});
        $.post(
            'controller/StaffController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Deleted Staff Profile.</p></div>");
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
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Activated Staff Profile.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully DeActivated Staff Profile.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
     $.ajax({
		type:"POST",
		url:"controller/StaffController.php",
		data: {
			action : "Status Staff",
			status : status,
			staff_ID : id
		},
		success: function(data) {
		
		}
	}); 
 }    

// Wait for window load
/*$(window).load(function() {
    $("#loader").animate({
        top: -200
    }, 1500);
});*/
</script>
