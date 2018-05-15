<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h4>Add Places Nearby</h4>
        </div>
        <div class="ibox-content">
        <!--
            |================================
            |=========Personal Details=======
            |================================
            -->
            <div class="form-group">
                <span class="label label-success arrowed"> Owner Details</span>
            </div>
            <div class="hr-line-dashed"></div>
            <form method="POST" enctype="multipart/form-data" id="advertisementNearby">
				<div class="row">
					<div class="col-sm-3">
                        <label class="control-label">Existing User</label> <small>( required )</small>
                        <select name="existingUser" id="existingUser" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <?php foreach($companies as $key => $company):  ?>
								<option value="<?=$company['company_ID'];?>"><?=$company['company_name'];?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
				</div>
				
				<div class="hr-line-dashed"></div>

                <div class="row" id="newad">
                    <div class="col-sm-3">
                        <label class="control-label">Company</label> <small>( required )</small>
                        <input type="text" class="form-control" name="companyname" value="">
                    </div>
					<div class="col-sm-3">
                        <label class="control-label">Email</label> <small>( required )</small>
                        <input type="text" class="form-control" name="email" value=""><br/>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Contact No.</label> <small>( optional )</small>
                        <input type="text" class="form-control" name="contactnumber" value="">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Address</label> <small>( optional )</small>
                        <input type="text" class="form-control" name="address" value=""><br/>
                    </div>
                </div>
				
                <div class="hr-line-dashed" id="newad2"></div>
                <!--
                |================================
                |=========Package Details========
                |================================
                -->
				
                <div class="form-group">
                    <span class="label label-success arrowed">Ads Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="control-label">Header</label> <small>( required ) </small>
                            <input type="text" class="form-control" name="ad_name" value="" >
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Select Hotels</label> <small>( required )</small>
                            <select name="hotel_name" id="" class="form-control m-b">
                                <option value="">-- Select --</option>
                                <?php foreach($hotels as $key => $hotel):  ?>
									<option value="<?=$hotel['hotel_ID'];?>"><?=$hotel['hotel_name'];?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                         <div class="col-sm-3">
                            <label class="control-label">Select Category</label> <small>( required ) </small>
                            <select name="ad_category" id="" class="form-control m-b">
                                <option value="">-- Select --</option>
                                <?php foreach($categories as $key => $cate):  ?>
									<option value="<?=$cate['adtype_ID'];?>"><?=$cate['adtype_name'];?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Address</label> <small>( required ) </small>
                            <input type="text" class="form-control" name="ad_address" value="" ><br/>
                        </div>

                         <div class="col-sm-3">
                            <label class="control-label">Contact No</label> <small>( required ) </small>
                            <input type="text" class="form-control" name="ad_contact" value="" >
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Date Live from</label> <small>( required ) </small>
                             <div class='input-group input-daterange'>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar-check-o"></span>
                                </span>
                                <input type="text" class="form-control"  name="daterange_in"  id="datetimepicker1" value="" />
                            </div>
                        </div>  
                        <div class="col-sm-3">
                            <label class="control-label">Date Live to</label> <small>( required ) </small>
                             <div class='input-group input-daterange'>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                <input type="text" class="form-control"  name="daterange_out" id="datetimepicker2" value="" />
                            </div>
                        </div>
                    </div>
					<div class="row"><br/>
						<div class="col-sm-12">
							<strong class="control-label">Description</strong><small> ( required ) </small>
							<textarea style="resize: vertical" class="form-control" rows="5" name="description"></textarea>
						</div>
					</div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <span class="label label-success arrowed"> Photo </span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-3"><br/>
                        <label class="control-label">Places Nearby Photo</label><small> ( required ) Maximum of <b>5</b> Images</small>
                        <div class="input-group image-preview col-sm-12">
                            <input type="text" class="form-control image-preview-filename" name="adImagesText"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="adImagesFiles[]" id="imagesAd" multiple/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Add Advertisement" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="mssg" class="col-md-4" style="top:0;right:0;position:fixed;margin-top:0px;margin-right:-5px;"></div>
<script type="text/javascript" src="js/addnearby.js"></script>
<script type="text/javascript"  src="js/image_input.js"></script>
<script type="text/javascript" src="assets/js/checktime.js"></script>