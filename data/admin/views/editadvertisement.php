<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Update Places Nearby Details</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Places Nearby Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Company</strong>
                            </div>
                            <div class="col-sm-9"><?=$comp['company_name'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Header</strong>
                            </div>
                            <div class="col-sm-9"><?=$ad['ad_title'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Email</strong>
                            </div>
                            <div class="col-sm-9"><?=$comp['company_email'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Hotel</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotelname;?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Address</strong>
                            </div>
                            <div class="col-sm-9">
                                <?=$comp['company_address'];?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Category</strong>
                            </div>
                            <div class="col-sm-9"><?=$placesname;?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Contact No</strong>
                            </div>
                            <div class="col-sm-9"><?=$comp['company_contact'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Adress</strong>
                            </div>
                            <div class="col-sm-9"><?=$ad['ad_address'];?></div>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
						<div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Contact No</strong>
                            </div>
                            <div class="col-sm-9"><?=$ad['ad_contact'];?></div>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
						<div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Date Live From</strong>
                            </div>
                            <div class="col-sm-9"><?=$adfrom?></div>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
						<div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Date Live To</strong>
                            </div>
                            <div class="col-sm-9"><?=$adto?></div>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
						<div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Description</strong>
                            </div>
                            <div class="col-sm-9"><?=$ad['ad_description'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title ">
            <h4>Update Places Nearby Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="update_places_detail_form">
				<div class="row" id="newad">
                    <div class="col-sm-3">
                        <label class="control-label">Company</label> <small>( required )</small>
                        <input type="text" class="form-control" name="companyname" value="<?=$comp['company_name'];?>">
						<input type="hidden" name="comp_id" value="<?=$comp['company_ID'];?>"/>
                    </div>
					<div class="col-sm-3">
                        <label class="control-label">Email</label> <small>( required )</small>
                        <input type="text" class="form-control" name="email" value="<?=$comp['company_email'];?>"><br/>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Contact No.</label> <small>( optional )</small>
                        <input type="text" class="form-control" name="contactnumber" value="<?=$comp['company_contact'];?>">
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Address</label> <small>( optional )</small>
                        <input type="text" class="form-control" name="address" value="<?=$comp['company_address'];?>"><br/>
                    </div>
                </div>
				
                <div class="hr-line-dashed" id="newad2"></div>
				<div class="form-group">
                    <span class="label label-success arrowed">Ads Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="control-label">Header</label> <small>( required ) </small>
                            <input type="text" class="form-control" name="ad_name" value="<?=$ad['ad_title'];?>" >
							<input type="hidden" name="ad_id" value="<?=$ad['ads_ID'];?>" />
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Address</label> <small>( required ) </small>
                            <input type="text" class="form-control" name="ad_address" value="<?=$ad['ad_address'];?>" ><br/>
                        </div>

                         <div class="col-sm-3">
                            <label class="control-label">Contact No</label> <small>( required ) </small>
                            <input type="text" class="form-control" name="ad_contact" value="<?=$ad['ad_contact'];?>" >
                        </div>
   
                    </div>
					<div class="row"><br/>
						<div class="col-sm-12">
							<strong class="control-label">Description</strong><small> ( required ) </small>
							<textarea style="resize: vertical" class="form-control" rows="5" name="description" ><?=$ad['ad_description'];?></textarea>
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
                            <input type="text" class="form-control image-preview-filename" name="adImagesText" value="<?=$ad['image1'].",".$ad['image2'].",".$ad['image3'].",".$ad['image4'].",".$ad['image5'];?>"> <!-- don't give a name === doesn't send on POST/GET -->
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
                            <button class="btn btn-info" name="action" value="Edit Advertisement" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
			</form>
        </div>
    </div>
</div>
<div id="mssg" class="col-md-4" style="top:0;right:0;position:fixed;margin-top:0px;margin-right:-5px;"></div>

<script type="text/javascript" src="js/updatenearby.js"></script>
<script type="text/javascript"  src="js/image_input.js"></script>
<script type="text/javascript" src="assets/js/checktime.js"></script>