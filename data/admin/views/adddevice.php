<!-- Modal add device -->
<div id="adddevice-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
    <div class="modal-dialog decor">
        <!-- Modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add device</h4>
            <div id="messages"></div>
          </div>
              <!-- start content of add device -->
              <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="col-lg-12"><br/>
                            <div class="ibox float-e-margins">
                                <div>
									<form method="post" id="adddeviceform">
										<div class="col-sm-12">
											<label class="control-label">Hotel Name</label> <small>( required ) </small>
											<select name="hotel_id" id="hotel_id" class="form-control m-b">
												<option value="">-- Select --</option>
											<?php foreach($hotels as $values => $hotel):?>
												<option id="<?=$hotel['hotel_max_room'];?>" value="<?=$hotel['hotel_ID'];?>"><?=$hotel['hotel_name'];?></option>
											<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="control-label">Room Number / Name</label> <small>( required ) </small><small id="allowednumber"></small>
											<select name="roomnumber" id="roomnumber" class="form-control m-b">
												
											</select>
										</div>
										<div class="col-sm-12">
											<label class="control-label">Device UID / Mac Address</label> <small>( required ) </small>
											<input type="text" class="form-control" name="macaddress" id="macaddress" value="" >
										</div>
										<button class="btn btn-info" id="addDeviceButton" name="action" value="Add Device" type="submit" style="float:right;width:110px;">Save Changes</button>
									</form>
                                    <button class="btn btn-info" id="cancelDeviceButton" data-dismiss="modal" name="action" value="" type="submit" style="float:right">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br/>
              <!-- end content of add device -->
            </div>
        </div>
    </div>
</div>
