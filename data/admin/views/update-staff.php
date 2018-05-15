
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>Update Staff Details</h2>
        </div>
    </div>
</div><br/>
<?php foreach ($staff_lists as $staff_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Registered Staff Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row" style="height:170px;">
                    <div class="col-sm-3">
                        <i class="fa fa-address-book-o fa-5x center-block"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Staff Name</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['lastname'].", ".$staff_list['firstname']; ?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Address</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['address'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Username</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['username'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Email Address</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['email'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Phone</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['phone'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Assignments</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['about_hotel']." &nbsp; ".$staff_list['room_dining']." &nbsp; ".$staff_list['frontdesk']." &nbsp; ".$staff_list['services']." &nbsp; ".$staff_list['offers']." &nbsp; ".$staff_list['staff']." &nbsp; ".$staff_list['housekeeping']." &nbsp; ".$staff_list['pos']." &nbsp; ".$staff_list['order_history']." &nbsp; ".$staff_list['reports']; ?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $staff_list['created_at'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h4>Update Staff Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="editStaffForm">
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
                    <input type="hidden" class="form-control" name="staff_ID" id="staff_ID" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" class="form-control" name="hotel_ID"  value="<?=$hotelid;?>">
                    <div class="col-sm-3">
                        <label class="control-label">First Name</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="firstname" id="fname" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Middle Name</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="middlename" id="middlename" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Last Name</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="lastname" id="lname" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Phone</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="phone" id="phone_no" value="" >
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Address</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="address" id="Address" value="">
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
                        <input type="text" class="form-control" name="email" id="emailadd" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Username</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="username" id="unames" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Password</label> <small>( required ) </small>
                        <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Confirm Password</label> <small>( required ) </small>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" value="">
                    </div>
                </div><br/>
                <div class="hr-line-dashed"></div>
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
                                <input type="checkbox" id="box-1" value="AboutHotel">
                                <label for="box-1">About the Hotel</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-2" value="room_dining">
                                <label for="box-2">In-Room Dining</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-3" value="frontdesk">
                                <label for="box-3">Front Desk</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-4" value="services">
                                <label for="box-4">Services</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-5" value="offers">
                                <label for="box-5">Offers</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-6" value="staff">
                                <label for="box-6">Manage Staff</label><br/>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-7" value="housekeeping">
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
							<div class="col-sm-2" style="margin-top: 25px !important;">
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
                                <a href="viewStaff.php" class="btn btn-info" type="submit" style="padding-top:10px;">Back</a>
                                <button class="btn btn-info" name="action" value="Edit Staff" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
             </form>
        </div>
    </div>
</div>
<div id="mssg" class="col-md-4" style="top:0;right:0;position:fixed;margin-top:0px;margin-right:-5px;"></div>
<script type="text/javascript" src="assets/js/checktime.js"></script>
<script>
$(function () {
    $("#loadthis").addClass('loader-show');
    var staff_ID = $("#staff_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get Staff By ID"});
    data.push({"name":"staff_ID","value":staff_ID});
    $.post(
        'controller/StaffController.php',
        data,
        function(info) {
            showFeature(info);
            $("#loadthis").removeClass('loader-show');
        }
    );
    $("#editStaffForm").validate({
        rules: {
            firstname: {required:true,nonNumeric: true },
            lastname: {required:true,nonNumeric: true },
            phone: "required",
            address: "required",
            username: "required",
            email: { required: true, email: true },
			password: "required",
            cpassword: {equalTo: "#password", required: true}
        },  
        submitHandler: function(form) {
            var about_hotel = "",room_dining = "",frontdesk = "",services = "",offers = "",staff = "",housekeeping = "",pos = "",order_history = "",reports = "";
            about_hotel = (document.getElementById('box-1').checked) ? "about_hotel" : "";
            room_dining = (document.getElementById('box-2').checked) ? "room_dining" : "";
              frontdesk = (document.getElementById('box-3').checked) ? "frontdesk" : "";
               services = (document.getElementById('box-4').checked) ? "services" : "";
                 offers = (document.getElementById('box-5').checked) ? "offers" : "";
                  staff = (document.getElementById('box-6').checked) ? "staff" : "";
           housekeeping = (document.getElementById('box-7').checked) ? "housekeeping" : "";
			  feedbacks = (document.getElementById('box-8').checked) ? "feedbacks" : "";
			   channels = (document.getElementById('box-9').checked) ? "channels" : "";
                    pos = (document.getElementById('box-10').checked) ? "pos" : "";
          order_history = (document.getElementById('box-11').checked) ? "order_history" : "";
                reports = (document.getElementById('box-12').checked) ? "reports" : "";
                 others = (document.getElementById('box-13').checked) ? "others" : "";
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            datafields.push({"name":"about_hotel","value":about_hotel});
            datafields.push({"name":"room_dining","value":room_dining});
            datafields.push({"name":"frontdesk","value":frontdesk});
            datafields.push({"name":"services","value":services});
            datafields.push({"name":"offers","value":offers});
            datafields.push({"name":"staff","value":staff});
            datafields.push({"name":"housekeeping","value":housekeeping});
            datafields.push({"name":"feedbacks","value":feedbacks});
            datafields.push({"name":"channels","value":channels});
            datafields.push({"name":"pos","value":pos});
            datafields.push({"name":"order_history","value":order_history});
            datafields.push({"name":"reports","value":reports});
            datafields.push({"name":"others","value":others});
            $.ajax({
                type:"POST",
                url:"controller/StaffController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Staff.</p></div>");
                    } else {
                        $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Staff. Please try again!</p></div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    })
});
function showFeature(staff) {
    var staff_info = JSON.parse(staff);
    $("#title").val(staff_info[1]);
    $("#fname").val(staff_info[2]);
    $("#middlename").val(staff_info[3]);
    $("#lname").val(staff_info[4]);
    $("#phone_no").val(staff_info[5]);
    $("#Address").val(staff_info[6]);
    $("#emailadd").val(staff_info[7]);
    $("#unames").val(staff_info[9]);
    if(staff_info[11]== "about_hotel"){document.getElementById("box-1").checked = true;}
    if(staff_info[12]== "room_dining"){ document.getElementById("box-2").checked = true;}
    if(staff_info[13]== "frontdesk"){document.getElementById("box-3").checked = true;}
    if(staff_info[14]== "services"){document.getElementById("box-4").checked = true;}
    if(staff_info[15]== "offers"){ document.getElementById("box-5").checked = true;}
    if(staff_info[16]== "staff"){document.getElementById("box-6").checked = true;}
    if(staff_info[17]== "housekeeping"){document.getElementById("box-7").checked = true;}
    if(staff_info[18]== "feedbacks"){document.getElementById("box-8").checked = true;}
    if(staff_info[19]== "channels"){ document.getElementById("box-9").checked = true;}
    if(staff_info[20]== "pos"){document.getElementById("box-10").checked = true;}
    if(staff_info[18]== "order_history"){document.getElementById("box-11").checked = true;}
    if(staff_info[19]== "reports"){ document.getElementById("box-12").checked = true;}
    if(staff_info[20]== "others"){document.getElementById("box-13").checked = true;}
}
</script>