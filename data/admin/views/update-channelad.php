<?php
      include("model/ChannelClass.php");;
      $ticker_ID = $_GET['id'];
      $ads_db = new Channels();
      $ads_lists = $ads_db->fetchChannelAdsInformation($ticker_ID);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>Update Channel Ad Details</h2>
        </div>
    </div>
</div>
<?php foreach ($ads_lists as $ads_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Registered Channel Ad Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row" style="height:170px;">
                    <div class="col-sm-3">
                        <i class="fa fa-clone fa-5x center-block"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Channel Ad</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $ads_list['ticker_description'];?></div>
                        </div>
						<div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Advisory Shows on</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $ads_list['ticker_start'];?></div>
                        </div>
						<div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Advisory Duration</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $ads_list['duration'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $ads_list['created_at'];?></div>
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
            <h4>Update Channel Ad Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="editChannelAdsForm">
                <div class="form-group">
                    <span class="label label-success arrowed"> Channel Ad Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <input type="hidden" class="form-control" name="ticker_ID" id="ticker_ID" value="<?php echo $_GET['id']; ?>">
                    <div class="col-sm-6">
                        <label class="control-label">Channel Ad Description</label><small> ( required ) </small>
                        <textarea class="form-control" rows="5" id="ads_description" name="ads_description"></textarea>
                        <input type="hidden" class="form-control" rows="5" value="" />
                    </div>
					<div class="col-lg-6">
							<label class="control-label">Display Advisory Every</label><small> ( required ) </small>
							<div class='input-group'>
								<input type="time" class="form-control" id="advisory_show" name="advisory_show" value="">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
						</div>
						<div class="col-lg-6">
							<label class="control-label">Duration</label> <small>( required ) </small>
							<select name="duration" id="duration" class="form-control m-b">
								<option value="">-- Select --</option>
								<option value="3000" >3 seconds</option>
								<option value="5000" >5 seconds</option>
								<option value="10000" >10 seconds</option>
								<option value="15000" >15 seconds</option>
								<option value="20000" >20 seconds</option>
								<option value="25000" >25 seconds</option>
								<option value="30000" >30 seconds</option>
								<option value="35000" >35 seconds</option>
								<option value="45000" >45 seconds</option>
								<option value="60000" >60 seconds</option>
							</select>
						</div>
                </div>
                <br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="channelad.php" class="btn btn-info" type="submit" style="padding-top:10px;">Back</a>
                            <button class="btn btn-info" name="action" value="Edit ChannelAds" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
             </form>
        </div>
    </div>
</div>
<script>
$(function () {
    $("#loadthis").addClass('loader-show');
    var ticker_ID = $("#ticker_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get ChannelAds By ID"});
    data.push({"name":"ticker_ID","value":ticker_ID});
    $.post(
        'controller/ChannelController.php',
        data,
        function(info) {
            showFeature(info);
            $("#loadthis").removeClass('loader-show');
        }
    );
    $("#editChannelAdsForm").validate({
        rules: {
            ads_description: "required",
			advisory_show: "required",
			duration: "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/ChannelController.php",
                data: datafields,
                success: function(data) {
                    var result = $.trim(data);
					if(result == "true") {
						$('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Channel Ad Information.</p></div>");
					}else {
						$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Update Channel Ad. Please try again!</p></div>");
					}
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    })
});
function showFeature(Channels) {
    var ads_info = JSON.parse(Channels);
    $("#ads_description").val(ads_info[2]);
}
</script>