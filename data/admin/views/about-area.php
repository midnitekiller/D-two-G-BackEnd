
<!-- Modal about the area -->
<div id="aboutarea-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hotel Write Up</h4>
      </div>
      <!-- start content of about the area -->
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
                <?php foreach ($writeUp_lists as $writeUp_list): ?>
                <form method="post" id="editWriteUpAreaForm">
                    <div class="col-lg-12"><br/>
                        <div id="show_information" class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h4>About The Area</h4>
                            </div>
                            <div class="ibox-content" id="area">
                                <?php echo $writeUp_list['area_description'];?>
                            </div>
                            <a class="btn btn-info" id="edit_button" name="action" value="" type="submit" style="float:right;padding-top:10px;">Edit</a>
                        </div>
                        <div id="edit_information">
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Description</label><small> ( required ) </small>
                                <textarea class="form-control" rows="5" id="aboutareas" name="aboutarea"><?php echo $writeUp_list['area_description'];?></textarea>
                                <input type="hidden" class="form-control" rows="5"  value="" />
                            </div>
                            <button class="btn btn-info" id="save_change" name="action" value="Edit WriteUpArea" type="submit" style="float:right;width:110px;">Save Changes</button>
                            <a class="btn btn-info" id="cancel_changes" name="action" value="" type="submit" style="float:right;padding-top:10px;">Cancel</a>
                        </div>
                    </div>
                </form>
                <?php endforeach ?>
            </div>
        </div>
      </div> <br/>
      <!-- end content of about the area -->
    </div>
  </div>
</div>
<script type="text/javascript"  src="js/about_area.js"></script>
<script>
    $("#editWriteUpAreaForm").validate({
        rules: {
            aboutarea: "required"
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
                        $('#mssg').html("<div class='alert alert-info'>Successfully Updated Hotel Write Up Area Profile!</div>");
                        $("#area").empty();
                        $("#area").text($("#aboutareas").val());
                        $('#edit_information').hide();
                        $('#show_information').slideToggle("slow");
                    } else {
                        $('#mssg').html("<div class='alert alert-danger'>Unable to Update Hotel Write Up Area Profile. Please try again!</div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    });
</script>