
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Application Update</h5>
            </div>
            <div class="ibox-content">
                <form method="POST" enctype="multipart/form-data" id="add_app_update_form">
					<div class="row">
                        <div class="col-sm-6">
                            <label class="control-label">For Hotel</label>
							<select name="hotel_ids" id="hotel_ids" class="form-control m-b">
								<option value="">-- Select --</option>
							<?php foreach($hotelss as $values => $hotel):?>
								<option id="<?=$hotel['hotel_max_room'];?>" value="<?=$hotel['hotel_ID'];?>"><?=$hotel['hotel_name'];?></option>
							<?php endforeach; ?>
							</select>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <label class="control-label">Version Name</label>
                            <input required="required" type="text" class="form-control" name="versionname" id="versionname" placeholder="Ex. 1.2.3 or 1.0.9"/>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="apkfile">APK File</label>
                        <br />
                        <input type="file" required="required" class="form-control-file" id="apkfile" name="apkfile" aria-describedby="fileHelp"/>
                        <small id="fileHelp" class="form-text text-muted">Upload the updated apk here.
                        <br/>
                        NOTE: Only the recently uploaded apk file will be save in the server. Existing file will be overwritten.</small>

                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12">
								<button class="btn btn-info" name="action" value="Add APK" type="submit">Upload APK</button>
                            </div>
                        </div>
                    </div>
                </form>          
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Application Update History</h5>
            </div>
            <div class="ibox-content">
                <table class="table dynamicDataTables">
                    <thead>
                    <tr>
                        <th>Hotel</th>
                        <th class="text-center">Version</th>
                        <th class="text-center">Date and Time Uploaded</th>
                        <th class="text-center" width="150" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($apps as $val => $app): ?>
						<tr>
                            <td> <?=$app['hotel_name'];?> </td>
                            <td class="text-center"> <?=$app['versionname'];?> </td>
                            <td class="text-center"> <?=$app['created_at'];?> </td>
                            <td width="150" class="text-center">
                                 <a href='javascript:;' name="action" class="fa fa-trash fa-2x" id="<?=$app['appupdate_ID']; ?>" data-toggle="tooltip" title="Delete" style="color:#333;" onclick='deleteThis(this)'></a>
                            </td>
                        </tr>
						<?php endforeach; ?>
                    </tbody>
                </table>           
            </div>
        </div>
    </div>
</div>
<script>
function deleteThis(element) {
    var appupdate_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove APK"});
        data.push({"name":"appupdate_ID","value":appupdate_ID});
        $.post(
            'controller/AppUpdateController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted APK!</p></div>");
            $("#loadthis").removeClass('loader-show');
            setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        );
    }
}

$(function () {
    $("#add_app_update_form").validate({
        rules: {
            hotel_ids: "required",
			versionname: "required"
        },
        submitHandler: function(form) {
//$("#loadthis").addClass('loader-show');
			
			var apk_file= $('#apkfile')[0].files[0];
			var datafields = new FormData($("form")[3]);
			var apk_error = 1;
			
			if(apk_file){
				var ext = apk_file.name.split('.').pop('-1');
				if(ext != 'apk'){
					$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Invalid File. </div>");
					$('#popalert').show();
				}else{
					apk_error = 0;
					datafields.append('apkfilename', apk_file.name);
				}
				
			} else{
				apk_error = 0;
				datafields.append('apkfilename', apk_file.name);
			}
			if(apk_error == 0){
				
				$.ajax({
					type:"POST",
					enctype: 'multipart/form-data',
					url:"controller/AppUpdateController.php",
					data: datafields,
					processData: false,
					contentType: false,
					timeout: 600000,
					success: function(data) {
						if(data == "true") {
							$('#adddevice-modal').modal('hide');
							$('#mssg').html("<div class='alert alert-dismissable alert-info' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Successfully Added Updated APK!</div>");
							$('#popalert').show();
							location.reload();
						}else {
							$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Unable to add Updated APK.</div>");
							$('#popalert').show();
							console.log(data);
						}
						
					}
				});
			}
        }
    });
});
</script>