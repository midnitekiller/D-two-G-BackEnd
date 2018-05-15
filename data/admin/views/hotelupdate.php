
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>Hotel App Users Update Details</h2>
        </div>
        <div class="col-lg-3">
             <a id="access" class="btn buttonsp" name="action" value="" type="submit"> Authorized Access </a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Registered Hotel Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel['hotel_name']);?>/logo/<?=$hotel['hotel_image'];?>" class="center-block" width="200">
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Fullname</strong>
                            </div>
                            <div class="col-sm-9"><?=$user['firstname']." ".$user['middlename']." ".$user['lastname'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Email Address</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['main_email'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Mobile No.</strong>
                            </div>
                            <div class="col-sm-9"><?=$user['phone'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Hotel Name</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['hotel_name'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Hotel Address</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['hotel_address'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>City</strong>
                            </div>
                            <div class="col-sm-9">
                                <?=$hotel['hotel_city'];?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>State</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['hotel_state'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Country</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['hotel_country'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Postal / Zip Code</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['hotel_postal'];?></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                <strong>Date Created</strong>
                            </div>
                            <div class="col-sm-9"><?=$hotel['created_at'];?></div>
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
            <h4>Update Hotel Account Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="update_hotel_form">
            
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
                        <input type="text" class="form-control" name="hotel_name" id="hotel_name" value="<?=$hotel['hotel_name'];?>" >
						<input type="hidden" name="hotel_id" value="<?=$hotel['hotel_ID'];?>" />
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Currency</label> <small>( optional ) </small>
                        <select name="currency" id="currency" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <option value="USD" <?=($hotel['hotel_currency']=="USD") ? "selected":""?>>USD</option>
                            <option value="RS" <?=($hotel['hotel_currency']=="RS") ? "selected":""?>>RUPEE</option>
                            <option value="EUR" <?=($hotel['hotel_currency']=="EUR") ? "selected":""?>>EURO</option>
                            <option value="GBP"<?=($hotel['hotel_currency']=="GBP") ? "selected":""?>>GBP</option>
                            <option value="JPY" <?=($hotel['hotel_currency']=="JPY") ? "selected":""?>>JAPANIES YEN</option>
                            <option value="CAD" <?=($hotel['hotel_currency']=="CAD") ? "selected":""?>>CANADIAN DOLLAR</option>
                            <option value="PHP" <?=($hotel['hotel_currency']=="PHP") ? "selected":""?>>PHILIPPINE PESO</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Max Room No.</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="max_no" id="max_no" value="<?=$hotel['hotel_max_room'];?>" >
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
                        <input type="text" class="form-control" name="street" value="<?=$hotel['hotel_street'];?>">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">City</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="city" value="<?=$hotel['hotel_city'];?>">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Country</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="country" value="<?=$hotel['hotel_country'];?>">
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">State</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="state" value="<?=$hotel['hotel_state'];?>">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Postal / Zip Code</label> <small>( optional ) </small>
                        <input type="text" class="form-control" name="postal_code" value="<?=$hotel['hotel_postal'];?>">
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
                    <div class="col-sm-4"><br/>
                        <label class="control-label">Hotel Logo</label><small> ( required ) </small>
                        <div class="input-group image-preview col-sm-12">
                            <input type="text" name="hotel_logo" class="form-control image-preview-filename" value="<?=$hotel['hotel_image'];?>"> <!-- don't give a name === doesn't send on POST/GET -->
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
                    <div class="col-sm-4"><br/>
                        <label class="control-label">Hotel Background</label><small> ( optional ) </small>
                         <div class="input-group image-preview1 col-sm-12">
                            <input type="text" name="back_logo" class="form-control image-preview-filename1" value="<?=$hotel['background_image'];?>"> <!-- don't give a name === doesn't send on POST/GET -->
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
                <!--
                |================================
                |==========Confirm Button========
                |================================
                -->
                <br/>
                <div class="row">
                <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="action" value="Update Hotel" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="mssg" class="col-md-4" style="top:0;right:0;position:fixed;margin-top:0px;"></div>

<script>
/*
|================================|
|==selector button update hotel==|
|================================|
*/
 $(document).ready(function(){
    $('#access').on('click',function(){
        window.location.href='authorizedaccessall.php?hotel_id=<?=$hotel['hotel_ID'];?>';
    });
 });
</script>
<script type="text/javascript" src="js/updatehotel.js"></script>
<script type="text/javascript"  src="js/image_input.js"></script>