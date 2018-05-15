<div id="mssg"></div><br/>
<div class="col-lg-12" id="staffdetail">
    <div class="ibox float-e-margins">
        <div class="ibox-title" >
            <h4>New Entry add new staff for your Hotel.</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="create_staff_form">
            <!--
                |================================
                |=========Personal Details=======
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed"> Personal Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Title</label> <small>( optional ) </small>
                        <select name="title" id="title" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <option value="Mr" >Mr</option>
                            <option value="Mrs" >Mrs</option>
                            <option value="Ms" >Ms</option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" name="hotel_ID"  value="<?=$hotelid;?>">
                    <div class="col-sm-3">
                        <label class="control-label">First Name</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Middle Name</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="middlename" id="middlename" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Last Name</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Phone</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="phone" id="phone" value="" >
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Address</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="address" id="address" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <!-- 
                |================================
                |=========Security Details=======
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Login Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Email</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="email" id="email" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Username</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="username" id="username" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Password</label> <small>( required ) </small>
                        <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Confirm Password</label> <small>( required ) </small>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" value="">
                    </div>
                </div>
                <br/>
                <div class="row">
                <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Add Staff" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12" id="staffassignment">
    <div class="ibox float-e-margins">
        <div class="ibox-title" >
            <h4>Assign staff for your Hotel.</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="assignment_staff_form" name="assignment_check">
                <!--
                |================================
                |=========Assinment Details======
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Assignment Details</span><small> ( Select at least one Assignment. ) </small>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-1" name="about_hotel" value="about_hotel">
                                <label for="box-1">About the Hotel</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-2" name="room_dining" value="room_dining">
                                <label for="box-2">In-Room Dining</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-3" name="frontdesk" value="frontdesk">
                                <label for="box-3">Front Desk</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-4" name="services" value="services">
                                <label for="box-4">Services</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-5" name="offers" value="offers">
                                <label for="box-5">Offers</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-6" name="staff" value="staff">
                                <label for="box-6">Manage Staff</label><br/>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-7" name="housekeeping" value="housekeeping">
                                <label for="box-7">Housekeeping</label>
                            </div>
							<div class="col-sm-2">
                                <input type="checkbox" id="box-8" name="feedbacks" value="feedbacks">
                                <label for="box-8">Feedbacks</label>
                            </div>
							<div class="col-sm-2">
                                <input type="checkbox" id="box-9" name="channels" value="channels">
                                <label for="box-9">Channels</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-10" name="pos" value="pos">
                                <label for="box-10">POS</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-11" name="order_history" value="order_history">
                                <label for="box-11">Order History</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-12" name="reports" value="reports">
                                <label for="box-12">Reports</label>
                            </div>
							<br/>
							<div class="col-sm-2">
                                <input type="checkbox" id="box-13" name="others" value="others">
                                <label for="box-13">Others</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <br/>
                <div class="row">
                <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Assignment Staff" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript"  src="js/staff.js"></script>
<script>
$(document).ready(function(){
    $('#staffdetail').show();
    $('#staffassignment').hide();

    $('#anotherstaff').on('click',function(){
        $('#staffdetail').slideDown(1000);
        $('#staffassignment').hide();
    });
});
    
function clearData(){
    document.getElementById("firstname").value= "";
    document.getElementById("middlename").value= "";
    document.getElementById("lastname").value= "";
    document.getElementById("phone").value= "";
    document.getElementById("address").value= "";
    document.getElementById("email").value= "";
    document.getElementById("username").value= "";
    document.getElementById("password").value= "";
    document.getElementById("cpassword").value= "";
    document.getElementById("box-1").checked = false;
    document.getElementById("box-2").checked = false;
    document.getElementById("box-3").checked = false;
    document.getElementById("box-4").checked = false;
    document.getElementById("box-5").checked = false;
    document.getElementById("box-6").checked = false;
    document.getElementById("box-7").checked = false;
    document.getElementById("box-8").checked = false;
    document.getElementById("box-9").checked = false;
    document.getElementById("box-11").checked = false;
    document.getElementById("box-12").checked = false;
    document.getElementById("box-13").checked = false;
}
    
$(function () {
    $("#create_staff_form").validate({
        rules: {
            firstname: {required:true,nonNumeric: true },
            lastname: {required:true,nonNumeric: true },
            phone: {required:true,number: true },
            address: "required",
            email: { required:true, email: true },
            username: "required",
            password: "required",
            cpassword: {
				required: true,
				equalTo: "#password"
			}
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/StaffController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Added Staff. You may now proceed for their assignment.</p></div>");
                        $('#staffassignment').slideDown(1000);
                        $('#staffdetail').hide();
                    }else if (data == "email"){
                        $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Email is already in use.</p></div>");
                    }else if (data == "username"){
                        $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Username is already in use.</p></div>");
                    }else{
                        $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add Staff. Please try again.</p></div>");
                        console.log(data);
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                   
                }
            });
        }
    })
});
$(function () {
    $("#assignment_staff_form").validate({
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            var staff = document.assignment_check.about_hotel.checked || document.assignment_check.room_dining.checked || document.assignment_check.frontdesk.checked ||                                                     document.assignment_check.services.checked || document.assignment_check.offers.checked || document.assignment_check.staff.checked || document.assignment_check.housekeeping.checked ||               document.assignment_check.pos.checked || document.assignment_check.order_history.checked || document.assignment_check.reports.checked
            if(staff == true){
                $.ajax({
                    type:"POST",
                    url:"controller/StaffController.php",
                    data: datafields,
                    success: function(data) {
                        if(data == "true") {
                            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Assign your staff for their assignment.</p></div>");
                            $('#staffdetail').slideDown(1000);
                            $('#staffassignment').hide();
                            setTimeout(function(){ $('#mssg').html(""); }, 4000);
                        }else{
                            $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to assign for their assignment. Please try again.</p></div>");
                            console.log(data);
                        }
                        $("#loadthis").removeClass('loader-show');
                        clearData();
                     }
                });
                    
             }else{  
                 $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Please provide at least one assignment.</p></div>");
                 
                setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        }
    })
});
</script>