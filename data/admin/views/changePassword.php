<!-- Modal Change Password -->
<div id="changepassword-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
        <div id="messages"></div>
      </div>
      <!-- start content of change password -->
      <div class="modal-body">
          <div class="row">
                <div class="col-sm-12">
                    <form method="post" id="change_password">
                        <div class="col-lg-12"><br/>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Current Password</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="current_password" name="current_password" value="">
                                <?php foreach ($change as $values => $change_lists): ?>
                                <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $change_lists['email'];?>">
                                <?php endforeach ?>
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">New Password</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="new_password" name="new_password" value="">
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Confirm Password</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="confirm_password" name="confirm_password" value="">
                            </div>
                            <button class="btn btn-info" id="save_changesz" name="action" value="Change Password" type="submit" style="float:right;width:110px;">Save Changes</button>
                            <a class="btn btn-info" data-dismiss="modal"  style="float:right;padding-top:10px;">Cancel</a>
                        </div> 
                    </form>
                </div>
          </div>
      </div><br/>
      <!-- End Content of change password -->
    </div>
  </div>
</div>
<script>
$("#change_password").validate({
    rules: {
        current_password: "required",
            new_password: "required",
        confirm_password: {required: true, equalTo: "#new_password"}
    },  
    submitHandler: function(form) {
        $("#loadthis").addClass('loader-show');
        var datafields = [];
        datafields = $("form").serializeArray();
        $.ajax({
            type:"POST",
            url:"controller/SettingController.php",
            data: datafields,
            success: function(data) {
                var result = $.trim(data);
                if(result == "true") {
                    $('#messages').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Change Password.</p></div>");
                }else if(result == "Incorrect") {
                    $('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Incorrect Old Password. Please try again!</p></div>");
                }else{
                    $('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Change Password. Please try again!</p></div>");
                }
                $("#loadthis").removeClass('loader-show');
                setTimeout(function(){ $('#messages').html(""); }, 4000);
            }
        });
     }
});
</script>