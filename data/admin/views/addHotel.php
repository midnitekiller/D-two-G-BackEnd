<div id="mssg"></div><br/>
 <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h4>New Hotel Account Registration</h4>
            
        </div>
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="create_hotel_form">
            <!--
                |================================
                |=========Personal Details=======
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Hotel Owner / IT Manager Email</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Email</label> <small>( required ) </small>
                        <input type="email" class="form-control" name="email" id="email" value="">
                        <br/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <!--
                |================================
                |=========Package Details========
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Hotel Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Hotel Name</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="hotel_name" id="hotel_name" value="" >
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Currency</label> <small>( optional ) </small>
                        <select name="currency" id="hotel_currency" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <option value="USD">USD</option>
                            <option value="RS">RUPEE</option>
                            <option value="EUR">EURO</option>
                            <option value="GBP">GBP</option>
                            <option value="JPY">JAPANIES YEN</option>
                            <option value="CAD">CANADIAN DOLLAR</option>
                            <option value="PHP">PHILIPPINE PESO</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Max Room No.</label> <small>( required ) </small>
                        <input type="number" class="form-control" name="max_no" id="max_no" value="" >
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
                    <div class="col-sm-4">
                        <label class="control-label">Street</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="hotel_street" id="hotel_street" value="">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">City</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="hotel_city" id="hotel_city" value="">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Country</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="hotel_country" id="hotel_country" value="">
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">State</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="hotel_state" id="hotel_state" value="">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Postal / Zip Code</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="hotel_postal" id="hotel_postal" value="">
                    </div>
					<div class="col-sm-4">
                        <label class="control-label">Telephone</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="hotel_phone" id="hotel_phone" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <!-- 
                |================================
                |=========Photos Details========
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Insert Photo</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-6"><br/>
                        <label class="control-label">Hotel Logo</label><small> ( required ) </small>
                        <div class="input-group image-preview col-sm-12">
                            <input type="text" name="hotel_logo" id="hotel_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="hotel_logo_img" id="hotel_logo_img"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6"><br/>
                        <label class="control-label">Hotel Background</label><small> ( optional ) </small>
                         <div class="input-group image-preview1 col-sm-12">
                            <input type="text" name="back_logo" id="back_logo" class="form-control image-preview-filename1"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear1" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input1">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title1">Choose File</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="back_logo_img" id="back_logo_img"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <!-- 
                |================================
                |=========Photos Details========
                |================================
                -->
                <div class="form-group">
                    <span class="label label-success arrowed">Flight Tracker & Weather</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Flight Tracker Code</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="flight_id" id="flight_id" value="">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Weather Code</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="weather_id" id="weather_id" value="">
                    </div>
                </div>
                <!--
                |================================
                |==========Confirm Button========
                |================================
                -->
                <br/>
                <div class="row">
                <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Add Admin" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
 $(document).ready(function(){
	var root = document.location.hostname;
	console.log(root);
 });
</script>
<script type="text/javascript" src="assets/js/checktime.js"></script>
<script type="text/javascript" src="js/addhotel.js"></script>
<script type="text/javascript"  src="js/image_input.js"></script>


