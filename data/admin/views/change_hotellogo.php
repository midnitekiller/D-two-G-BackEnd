
<!-- Modal hotel write-up -->
<div id="logo-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
         <div id="message"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Hotel Logo</h4>
      </div>
      <!-- start content of hotel write-up -->
      <div class="modal-body">
          <div class="row">
                <div class="col-sm-12">
                  
                    <form method="post" id="editLogoForm">
                        <div class="col-lg-12"><br/>
                            <div class="ibox float-e-margins">
                                <div class="logo">
                                    <div class="logo_hotel">
                                        <img src="media/dummy_logo.png" id="change_logo" class="img-responsive" alt="" style="cursor:pointer;">
                                        <label style="color:#fff;"><?=$hotelname;?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Image</label><small> ( optional ) </small>
                                 <div class="input-group image-preview col-sm-12">
                                    <input type="text" name="img_service" id="services_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                                    <span class="input-group-btn">
                                        <!-- image-preview-clear button -->
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                        </button>
                                        <!-- image-preview-input -->
                                        <div class="btn btn-default image-preview-input">
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="image-preview-input-title">Choose File</span>
                                            <input type="file" name="services_logo_image" id="services_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
          </div>
      </div><br/>
      <!-- end content of hotel write-up -->
    </div>
  </div>
</div>
<script type="text/javascript"  src="js/write_up.js"></script>
<script>
    /*$("#editWriteUpForm").validate({
        rules: {
            hotel_name: "required",
            description: "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/WriteUpController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#message').html("<div class='alert alert-dismissable alert-info fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Successfully Updated Hotel Write Up.</div>");
                        $("#descs").empty();
                        $("#descs").text($("#description").val());
                        $("#name").empty();
                        $("#name").text($("#hotel_name").val());
                        $('#edit_informationz').hide();
                        $('#show_informationz').slideToggle("slow");
                    } else {
                        $('#message').html("<div class='alert alert-dismissable alert-danger fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Unable to Update Hotel Write Up. Please try Again!</div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#message').html(""); }, 4000);
                }
            });
        }
    });*/
</script>