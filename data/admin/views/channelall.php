
<div id="mssg_channel"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>LIVE TV CHANNEL</h2>
        </div>
        <div class="col-lg-3">
             <a id="channelclick" class="buttonsp" name="action" value="" type="submit"> CREATE NEW CHANNEL </a>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<div class="ibox-content"> 
			<div class="row">
				<div class="col-sm-6">
					<label class="control-label">View by Hotel</label> <small>( required ) </small>
					<select name="hotelID" id="hotelID" class="form-control m-b">
						<option value="">-- Select --</option>
						<?php foreach($hotels as $key => $hotel):  ?>
							<option value="<?=$hotel['hotel_ID'];?>"><?=$hotel['hotel_name'];?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6">
				</div>
			</div>
		</div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row" id="display-channels">
	
	</div>    
</div>


<!-- Modal feedback -->
<div id="channel-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CREATE NEW CHANNEL</h4>
        <div id="messages"></div>
      </div>
      <!-- start content of feedback -->
      <div class="modal-body">
	  <form method="post" enctype="multipart/form-data" id="add_channel_form">
        <div class="row">
            <div class="col-lg-12 margin-text">
                <div class="ibox float-e-margins">
                      <div class="ibox-content"> 
                        <div class="row">
							<div class="col-sm-12"><br/>
								<label class="control-label">For Hotel</label><small> ( required ) </small>
								<select name="hotel_id" id="hotel_id" class="form-control m-b">
									<option value="">-- Select --</option>
								<?php foreach($hotels as $values => $hotel):?>
									<option value="<?=$hotel['hotel_ID'];?>"><?=$hotel['hotel_name'];?></option>
								<?php endforeach; ?>
								</select>
							</div>
							<div class="col-sm-12"><br/>
								<label class="control-label">Channel Type</label><small> ( required ) </small>
								<select name="channel_type" id="channel_type" class="form-control m-b">
									<option value="">-- Select --</option>
									<option value="RTMP">RTMP Channel</option>
									<option value="HLS">HLS Channel</option>
								</select>
							</div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Channel Name</label><small> ( required ) </small>
                                <input type="text" class="form-control" name="channel_name" value="" >
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Channel URL</label><small> ( required ) </small>
                                <input type="text" class="form-control" name="channel_url" value="" >
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Channel Logo</label><small> ( optional ) </small>
                                 <div class="input-group image-preview col-sm-12">
                                    <input type="text" class="form-control image-preview-filename" name="logo_text" id="logo_text"> <!-- don't give a name === doesn't send on POST/GET -->
                                    <span class="input-group-btn">
                                        <!-- image-preview-clear button -->
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                        </button>
                                        <!-- image-preview-input -->
                                        <div class="btn btn-default image-preview-input">
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="image-preview-input-title">Choose File</span>
                                            <input type="file" accept="image/png, image/jpeg, image/gif" id="channel_logo" name="channel_logo"/> <!-- rename it -->
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-info pull-right" name="action" value="Add Channel" type="submit">Submit</button>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
		</form>
		</div>
    </div>
</div>


<script>
   $('#channelclick').on('click',function(){
       $('#channel-modal').modal().show();
        return false;
   });
</script>


<script>
$(document).ready(function(){
    $('#securitypin').hide();
    $('#videoplayer').hide();

    $('#play').on('click',function(){
        $('#videoplayer').slideDown(1000);
        $('#playtv').hide();
        $('#imagetv').hide();
        $('#play').hide();
    });

    $('#pinregistration').on('click', function(){
        $('#registerpin').slideToggle("slow");
        $('#securitypin').hide();
    });
    
    $('#cancel').on('click', function(){
        $('#securitypin').slideToggle("slow");
        $('#registerpin').hide();
    });
	
	var hotelid = 1;;
	var check = "true";
	if(check =="<?=($_GET['hotel_ID'] != "")? "true":"false";?>"){
		hotelid	= "<?=$_GET['hotel_ID'];?>";
		$("#hotelID").val(hotelid);
	}else{
		hotelid = "1";
		$("#hotelID").val(hotelid);
	}
	displayChannels(hotelid);
});
var data = [];
function displayChannels(id){
	data = [];
	<?php if($channels != NULL): ?>
	<?php foreach($channels as $key => $ch): ?>
		if(id == "<?=$ch['hotel_ID'];?>"){
			data.push({ 'channel_name': '<?=$ch['channel_name'];?>', 'channel_logo': '<?=$ch['channel_logo'];?>', 'hotel_name': '<?=preg_replace("/[^a-zA-z]+/", "", $ch['hotel_name'])?>', 'hotel_ID': '<?=$ch['hotel_ID'];?>', 'channel_ID': '<?=$ch['channel_ID'];?>' });
		}
	<?php endforeach; ?>
	
	
	for(var i = 0; i < data.length; i++){
		var dat = data[i];
		$("#display-channels").append("<div class=\"col-lg-3\"><div class=\"ibox float-e-margins\"><div class=\"ibox-title\"><h5>"+dat['channel_name']+"</h5><i class=\"fa fa-trash fa-2x pull-right\" data-toggle=\"tooltip\" id=\""+ dat['channel_ID'] +"\" onclick='deleteThis(this);' title=\"Delete\" style=\"color:#333;\"></i></div><div class=\"ibox-content text-center\" id=\"playdetails\"><div class=\"form-image\" id=\"imagetv\"><center><img src=\"media/images/" + dat['hotel_name'] + "/channel/" + dat['channel_logo'] + "\" class=\"img-responsive\" alt=\"\" class=\"center-block\"></center><br/><a class=\"inline-link-2\" href=\"channelupdate.php?channel_id="+ dat['channel_ID'] +"\">View Details</a></div></div></div></div>");
	}
	<?php endif; ?>
}
</script>



 <!--<script type="text/javascript">
    /* get stream from query string */
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    var stream = getParameterByName('stream') || 'http://iwantvsphls-lh.akamaihd.net/i/iwantspabscbn_1@388737/index_800_av-p.m3u8?sd=10&rebase=on&hdntl=exp=1505875558~acl=%2f*~data=hdntl~hmac=9c049b0e29109a66d844d5cb86632c95d93032e0a8c96c13962ad7af1731a9c0';
</script>
<script>
        if(Hls.isSupported()) {
            var video = document.getElementById('video');
            var hls = new Hls();
            hls.loadSource(stream);
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED,function() {
                //video.play();
            });
        }
</script>
-->
    
<script type="text/javascript"  src="js/image_input.js"></script>
<script type="text/javascript"  src="js/channels.js"></script>