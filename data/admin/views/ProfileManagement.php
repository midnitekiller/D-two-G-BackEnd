<!-- Modal Profile Management -->
<div id="profile-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Profile management</h4>
        <div id="message"></div>
      </div>
      <!-- start content of profile management -->
    
      <div class="modal-body">
          <div class="row">
                <div class="col-sm-12">
                    <form method="post" id="edit_profileManagement">
                        <?php foreach ($profile as $values => $profile_lists): ?>
                        <div id="edit_profile">
                            <div class="col-sm-6"><br/>
                                <label class="control-label">Firstname</label><small> ( required ) </small>
                                <input type="hidden" class="form-control" id="user_ID" name="user_ID" value="<?php echo $profile_lists['user_ID'];?>">
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $profile_lists['firstname'];?>">
                            </div>
                            <div class="col-sm-6"><br/>
                                <label class="control-label">Lastname</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $profile_lists['lastname'];?>">
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Address</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $profile_lists['address'];?>">
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Phone Number</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $profile_lists['phone'];?>">
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Email</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $profile_lists['email'];?>">
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Username</label><small> ( required ) </small>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $profile_lists['username'];?>">
                            </div>
                            <button class="btn btn-info" id="save_changes" name="action" value="Edit Profile" type="submit" style="float:right;width:110px;">Save Changes</button>
                            <a class="btn btn-info" id="cancel_changes"  style="float:right;padding-top:10px;">Cancel</a>
                        </div>
                        <div id="detail_profile">
                            <div class="row" style="height:160px;">
                                <div class="container col-lg-12">
                                    <div class="col-sm-3">
                                        <img src="media/guests_icon.png" class="img-responsive" alt="" class="center-block" style="height:100px;width:100px;">
                                    </div>
                                    <div class="col-sm-9"><br/>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <strong>Name:</strong>
                                            </div>
                                            <div class="col-sm-9" id="name"><?php echo $profile_lists['lastname'].", ".$profile_lists['firstname']; ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <strong>Address:</strong>
                                            </div>
                                            <div class="col-sm-9" id="add"><?php echo $profile_lists['address'];?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <strong>Phone:</strong>
                                            </div>
                                            <div class="col-sm-9" id="contact"><?php echo $profile_lists['phone'];?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <strong>Email:</strong>
                                            </div>
                                            <div class="col-sm-9" id="main"><?php echo $profile_lists['email'];?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <strong>Username:</strong>
                                            </div>
                                            <div class="col-sm-9" id="uname"><?php echo $profile_lists['username'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a class="btn btn-info" id="edit_management" name="action" style="float:right;padding-top:10px;">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </form>
                </div>
          </div>
       </div>
      <!-- End Content of profile management -->
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('#edit_profile').hide();

    $('#edit_management').on('click',function(){
        $('#edit_profile').slideDown(2000);
        $('#detail_profile').hide();
    });

    $('#cancel_changes').on('click', function(){
        $('#detail_profile').slideToggle("slow");
        $('#edit_profile').hide();
    });
}); 
    
$("#edit_profileManagement").validate({
    rules: {
        firstname: {required:true,nonNumeric: true },
        lastname: {required:true,nonNumeric: true },
        phone: {required:true,number: true },
        address: "required",
        email: { required:true, email: true },
        username: "required"
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
                    $('#message').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Change Profile.</p></div>");
                    $("#name").empty();
                    $("#name").text($("#lastname").val() + ", " + $("#firstname").val());
                    $("#add").empty();
                    $("#add").text($("#address").val());
                    $("#contact").empty();
                    $("#contact").text($("#phone").val());
                    $("#mail").empty();
                    $("#mail").text($("#email").val());
                    $("#uname").empty();
                    $("#uname").text($("#username").val());
                    $('#detail_profile').slideToggle("slow");
                    $('#edit_profile').hide();
                } else {
                     $('#message').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Change Profile. Please try again!</p></div>");
                }
                $("#loadthis").removeClass('loader-show');
                setTimeout(function(){ $('#message').html(""); }, 4000);
            }
        });
     }
});
</script>