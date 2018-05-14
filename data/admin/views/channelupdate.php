<div id="mssg_channel"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
		<h2>Edit Channel</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Channel Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
					<div class="col-sm-3">
                        <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $channel['hotel_name']);?>/channel/<?=$channel['channel_logo'];?>" class="center-block" width="200">
                    </div>
                    <div class="col-sm-9">
						<div class="col-sm-6">
                            <div class="col-sm-6">
                                <strong>Hotel Name</strong>
                            </div>
                            <div class="col-sm-6"><?=$channel['hotel_name'];?></div>
                        </div>
						<div class="col-sm-6">
                            <div class="col-sm-6">
                                <strong>Channel Type</strong>
                            </div>
                            <div class="col-sm-6"><?=$channel['channel_type'];?></div>
                        </div>
						<div class="col-sm-6">
                            <div class="col-sm-6">
                                <strong>Channel Name</strong>
                            </div>
                            <div class="col-sm-6"><?=$channel['channel_name'];?></div>
                        </div>
					</div>
					<br/>
					<div class="col-sm-9">
						<div class="col-sm-6">
                            <div class="col-sm-6">
                                <strong>Channel URL</strong>
                            </div>
                            <div class="col-sm-6"><?=$channel['channel_url'];?></div>
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
            <h4>Edit Channel Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="update_channel_form">
            
                <div class="form-group">
                    <span class="label label-success arrowed">Channel Details</span>
					<input type="hidden" name="channelid" value="<?=$channel['channel_ID'];?>" />
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
					<div class="col-sm-6">
                        <label class="control-label">For Hotel</label> <small>( required ) </small>
                        <select name="hotelid" id="hotelid" class="form-control m-b">
                            <option value="">-- Select --</option>
						<?php foreach($hotels as $values => $hotel):?>
							<option id="<?=$hotel['hotel_max_room'];?>" value="<?=$hotel['hotel_ID'];?>" <?=($channel['hotel_ID'] == $hotel['hotel_ID']) ? "selected" : "";?>><?=$hotel['hotel_name'];?></option>
						<?php endforeach; ?>
                        </select>
                    </div>
					<div class="col-sm-6">
                        <label class="control-label">Channel Type</label> <small>( required ) </small>
                        <select name="channeltype" id="channeltype" class="form-control m-b">
                            <option value="">-- Select --</option>
							<option value="RTMP">RTMP</option>
							<option value="HLS">HLS</option>
                        </select>
                    </div>
					<div class="col-sm-6">
                        <label class="control-label">Channel Name</label> <small>( required ) </small><small id="allowednumber"></small>
                        <input type="text" class="form-control" name="channel_name" id="channel_name" value="<?=$channel['channel_name'];?>" >
                    </div>
				</div>
				<div class="row">
                    <div class="col-sm-6">
                        <label class="control-label">Channel URL</label> <small>( required ) </small><small id="allowednumber"></small>
                        <input type="text" class="form-control" name="channel_url" id="channel_url" value="<?=$channel['channel_url'];?>" >
                    </div>
					
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-6"><br/>
                        <label class="control-label">Channel Logo</label><small> ( required ) </small>
                        <div class="input-group image-preview col-sm-12">
                            <input type="text" name="logo_text" class="form-control image-preview-filename" value="<?=$channel['channel_logo'];?>"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="channel_logo" id="channel_logo"/> <!-- rename it -->
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
                            <button class="btn btn-info" name="action" value="Update Channel" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
 
 var hotelname;
	$("#hotelname").on('change', function() {
		hotelname = $(this).children(":selected").attr("id");
		document.getElementById("allowednumber").innerHTML = "Max. Room No. <b>"+hotelname+"</b>";
	});

	
</script>
<script type="text/javascript"  src="js/image_input.js"></script>
<script type="text/javascript"  src="js/channels.js"></script>