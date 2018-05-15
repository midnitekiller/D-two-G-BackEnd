<div id="mssg"></div><br/> 
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h2> ADD GUEST </h2>
        </div>
        <div class="ibox-content">
            <form method="post"  id="create_guest_form">
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
                        <input type="hidden" class="form-control" name="hotel_ID"  value="<?=$hotelid;?>">
                        <select name="title" id="title" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <option value="Mr" >Mr</option>
                            <option value="Mrs" >Mrs</option>
                            <option value="Ms" >Ms</option>
                        </select>
                    </div>
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
                            <select class="form-control m-b selectpicker" name="room_no" id="room_no"> 
                                <option value="">-- Select --</option>
                                <?php foreach ($room_no as $values => $guests_list): ?>
                                <option id="<?php echo $guests_list['tabs_ID'];?>"  value="<?php echo $guests_list['room_no'];?>"><?php echo $guests_list['room_no'];?></option>
                                <?php endforeach ?>
                                <option value="">-- Select --</option>
                            </select>
                    </div> 
                    <div class="col-sm-4">
                        <label class="control-label">Check In Date</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="daterange_in"  id="datetimepicker1" value=""/>
                        </div>
                    </div>  
                     <div class="col-sm-4">
                        <label class="control-label">Check Out Date</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            <input type="text" class="form-control"  name="daterange_out" id="datetimepicker2" value=""/>
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
                                <input type="checkbox" id="box-5"  value="Transportation">
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
                |========End Address Details=====
                |================================
                -->
                <br/>
                <div class="row">
                <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Add Guests" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/checktime.js"></script>
<script>
$(document).ready(function(){
    $('#cancelGuest').on('click',function(){
        window.location.href='displayguests.php';
    });
});

function clearData(){
    document.getElementById("title").value = "";
    document.getElementById("fname").value = "";
    document.getElementById("middlename").value = "";
    document.getElementById("lname").value= "";
    document.getElementById("room_no").value= "";
    document.getElementById("datetimepicker1").value= "";
    document.getElementById("datetimepicker2").value= "";
    document.getElementById("box-1").checked = false;
    document.getElementById("box-2").checked = false;
    document.getElementById("box-3").checked = false;
    document.getElementById("box-4").checked = false;
    document.getElementById("box-5").checked = false;
    document.getElementById("box-6").checked = false;
    document.getElementById("Address").value = "";
    document.getElementById("street").value = "";
    document.getElementById("city").value = "";
    document.getElementById("country").value = "";
    document.getElementById("postal_code").value = "";
    document.getElementById("phone_no").value = "";
    document.getElementById("emailadd").value = "";
}
    
$(function () {
    $("#loadthis").addClass('loader-show');
    jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) > Number($(params).val())); 
    },'Must be greater than {0}.');

    $("#create_guest_form").validate({
        rules: {
            firstname: {required:true,nonNumeric: true },
            lastname: {required:true,nonNumeric: true },
            room_no: "required",
            phone:{number:true},
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
                        $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Added Guest Profile!</p></div>");
                        setTimeout(function(){ $('#mssg').html(""); }, 4000);
                        $("#room_no").load(location.href + " #room_no>*", "");
                        clearData();
                    }else {
                        $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add Guest Profile. Please try again!</p></div>");
                        setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    }
                    $("#loadthis").removeClass('loader-show');
                 }
            });
        }
    })
}); 
</script>