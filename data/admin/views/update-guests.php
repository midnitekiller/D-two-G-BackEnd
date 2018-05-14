<?php 
      include("model/GuestsClass.php");
      $guest_ID = $_GET['id'];
      $guest_db = new Guests();
      $guests_lists = $guest_db->fetchGuestsInformation($guest_ID);
      $guests_room = $guest_db->fetchHotelRoomInformation($hotelid);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>Update Guests Details</h2>
        </div>
    </div>
</div>
<?php foreach ($guests_lists as $guests_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Registered Guests Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-3">
                        <i class="fa fa-address-book-o fa-5x center-block"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Guests Name</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['lastname'].", ".$guests_list['firstname']; ?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Postal / Zip Code</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['postal'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Date Check-In</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['check_in'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>City</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['city'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Date Check-Out</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['check_out'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Address</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['address'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Room Number</strong>
                            </div>
                            <div id="rrno" class="col-sm-8"><?php echo $guests_list['room_no'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Country</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['country'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Email Address</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['email'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Mobile No.</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['phone'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Inclusion</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['inclusion_Breakfast']." &nbsp; ".$guests_list['inclusion_Lunch']." &nbsp; ".$guests_list['inclusion_Dinner']." &nbsp; ".$guests_list['inclusion_Spa']." &nbsp; ".$guests_list['inclusion_Transportation']." &nbsp; ".$guests_list['inclusion_Sightseeing']; ?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-4">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-8"><?php echo $guests_list['created_at'];?></div>
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
            <h4>Update Guests Details</h4>
        </div>
        <div class="ibox-content">
           <form method="post" id="editGuestsForm">
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
                    <input type="hidden" class="form-control" name="hotel_ID" value="<?php echo $hotelid ?>">
                    <input type="hidden" class="form-control" name="guest_ID" id="guest_ID" value="<?php echo $_GET['id']; ?>">
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
                <div class="hr-line-dashed"></div>
                <!--
                |================================
                |=========Package Details========
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Package Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Room Number</label> <small>( required ) </small>
                            <select name="room_no" id="room_no" class="form-control m-b"> 
                                <option value="">-- Select --</option>
                                <?php foreach ($guests_room as $guests_rooms): ?>
                                <option id="<?php echo $guests_rooms['tabs_ID'];?>" value="<?php echo $guests_rooms['room_no'];?>"><?php echo $guests_rooms['room_no'];?></option>
                                <?php endforeach ?>
                            </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Check In Date</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="daterange_in"  id="datetimepicker1" value="" />
                        </div>
                    </div>  
                     <div class="col-sm-4">
                        <label class="control-label">Check Out Date</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            <input type="text" class="form-control"  name="daterange_out" id="datetimepicker2" value="" />
                        </div>
                    </div>     
                </div>
                <div class="hr-line-dashed"></div>
                <!--
                |================================
                |=========Package Inclusion======
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Inclusions</span><small> ( optional ) </small>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-1" value="Breakfast">
                                <label for="box-1">Breakfast</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-2" value="Lunch">
                                <label for="box-2">Lunch</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-3" value="Dinner">
                                <label for="box-3">Dinner</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-4" value="Spa">
                                <label for="box-4">Spa</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-5" value="Transportation">
                                <label for="box-5">Transportation</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" id="box-6" value="Sightseeing">
                                <label for="box-6">Sightseeing</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <!-- 
                |================================
                |=========Address Details========
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Address Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Address</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="Address" id="Address" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Street</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="street" id="street" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">City</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="city" id="city" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Country</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="country" id="country" value="">
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Postal / Zip Code</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="postal_code" id="postal_code" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Phone / Mobile Number</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="phone" id="phone_no" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Email Address</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="email" id="emailadd" value="">
                    </div>
                </div>
                <!--
                |================================
                |========Attendant Details=======
                |================================
                -->
                <br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" id="cancelGuest" type="button">Back</button>
                            <button class="btn btn-info" id="submit" name="action" value="Edit Guests" type="submit">Submit</button>
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
 $(document).ready(function(){
      $('#cancelGuest').on('click',function(){
        window.location.href='displayguests.php';
    });
 }); 
var global_room_no = 0;
$(function () {
    $("#loadthis").addClass('loader-show');
    var guest_ID = $("#guest_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get Guests By ID"});
    data.push({"name":"guest_ID","value":guest_ID});
    $.post(
        'controller/GuestsController.php',
        data,
        function(info) {
            showFeature(info);
            $("#loadthis").removeClass('loader-show');
        }
    );
    jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) > Number($(params).val())); 
    },'Must be greater than {0}.');

    $("#editGuestsForm").validate({
        rules: {
            firstname: {required:true,nonNumeric: true },
            lastname: {required:true,nonNumeric: true },
            room_no: "required",
            daterange_in: "required",
            daterange_out: {required:true, greaterThan: "#datetimepicker1"},
            email: { required: false, email: true }
        },
        messages: {
               daterange_out:{ greaterThan:"Check-out date must be equal or after check-in date"}
        },             
        submitHandler: function(form) {
            var Breakfast = "",
                Lunch = "",
                Dinner = "",
                Spa = "",
                Transportation = "",
                Sightseeing = "";
            Breakfast = (document.getElementById('box-1').checked) ? "Breakfast" : "";
            Lunch  = (document.getElementById('box-2').checked) ? "Lunch" : "";
            Dinner  = (document.getElementById('box-3').checked) ? "Dinner" : "";
            Spa  = (document.getElementById('box-4').checked) ? "Spa" : "";
            Transportation  = (document.getElementById('box-5').checked) ? "Transportation" : "";
            Sightseeing  = (document.getElementById('box-6').checked) ? "Sightseeing" : "";
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            var device_ID = $("#room_no").children(":selected").attr("id");
            datafields = $("form").serializeArray();
            datafields.push({"name":"device_ID","value":device_ID});
            datafields.push({"name":"previous_room","value":global_room_no});
            datafields.push({"name":"breakfast","value":Breakfast});
            datafields.push({"name":"lunch","value":Lunch});
            datafields.push({"name":"dinner","value":Dinner});
            datafields.push({"name":"spa","value":Spa});
            datafields.push({"name":"transportation","value":Transportation});
            datafields.push({"name":"sightseeing","value":Sightseeing});
            $.ajax({
                type:"POST",
                url:"controller/GuestsController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
						$('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have successfully Updated Guest.</p></div>");
					}else {
						$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Guest. Please try again!</p></div>");
					}
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    })
});
function showFeature(guests) {
    var guests_info = JSON.parse(guests);
    $("#title").val(guests_info[2]);
    $("#fname").val(guests_info[3]);
    $("#middlename").val(guests_info[4]);
    $("#lname").val(guests_info[5]);
    $("#emailadd").val(guests_info[6]);
    $("#phone_no").val(guests_info[7]);
    $("#room_no").append("<option value="+guests_info[8]+">"+guests_info[8]+"</option>");
    $("#room_no").val(guests_info[8]);
    global_room_no = guests_info[8];
    if(guests_info[9]== "Breakfast"){document.getElementById("box-1").checked = true;}
    if(guests_info[10]== "Lunch"){ document.getElementById("box-2").checked = true;}
    if(guests_info[11]== "Dinner"){document.getElementById("box-3").checked = true;}
    if(guests_info[12]== "Spa"){document.getElementById("box-4").checked = true;}
    if(guests_info[13]== "Transportation"){ document.getElementById("box-5").checked = true;}
    if(guests_info[14]== "Sightseeing"){document.getElementById("box-6").checked = true;}
    $("#datetimepicker1").val(guests_info[15]);
    $("#datetimepicker2").val(guests_info[16]);
    $("#Address").val(guests_info[17]);
    $("#street").val(guests_info[18]);
    $("#city").val(guests_info[19]);
    $("#country").val(guests_info[20]);
    $("#postal_code").val(guests_info[21]);
}
</script>