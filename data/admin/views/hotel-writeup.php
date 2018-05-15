<?php
      include("model/WriteUpClass.php");
      $writeUp = new WriteUp();
      $writeUp_lists = $writeUp->fetchWriteUpInformation($hotelid);
?>
<!-- Modal hotel write-up -->
<div id="writeup-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hotel Write Up</h4>
        <div id="message"></div>
      </div>
      <!-- start content of hotel write-up -->
      <div class="modal-body">
          <div class="row">
                <div class="col-sm-12">
                    <?php foreach ($writeUp_lists as $writeUp_list): ?>
                    <form method="post" id="editWriteUpForm">
                        <div class="col-lg-12"><br/>
                            <div id="show_informationz" class="ibox float-e-margins">
                                <center><h3><?php echo $writeUp_list['hotel_name'];?></h3></center>
                                <div class="ibox-content" id="descs">
                                    <?php echo $writeUp_list['hotel_description'];?>
                                </div>
                                <a class="btn btn-info" id="edit_buttonz" style="float:right;padding-top:10px;">Edit</a>
                            </div>
                            <div id="edit_informationz">
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" id="writeUp_ID" name="writeUp_ID" value="<?php echo $writeUp_list['writeUp_ID'];?>">
                                    <input type="hidden" class="form-control" id="hotel_name" name="hotel_name" value="<?php echo $writeUp_list['hotel_name'];?>"><br/>
                                </div>
                                <div class="col-sm-12">
                                    <strong class="control-label">Description</strong><small> ( required ) </small>
                                    <textarea class="form-control" rows="5" name="description" id="description"><?php echo $writeUp_list['hotel_description'];?></textarea>
                                    <input type="hidden" class="form-control" rows="5"  value="" />
                                </div>
                                <button class="btn btn-info" id="save_changesz" name="action" value="Edit WriteUp" type="submit" style="float:right;width:110px;">Save Changes</button>
                                <a class="btn btn-info" id="cancel_changesz"  style="float:right;padding-top:10px;">Cancel</a>
                            </div> 
                        </div>
                    </form>
                    <?php endforeach ?>
                </div>
          </div>
      </div><br/>
      <!-- End Content of Hotel Write-up -->
    </div>
  </div>
</div>
<script type="text/javascript"  src="js/write_up.js"></script>
<script>
$("#editWriteUpForm").validate({
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
                    //$('#message').html("<div class='alert-message alert-message-success'><h4>Success Message</h4><h4>Hotel Write Up Successfully Updated!</h4></div>");
                    $('#message').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Hotel Write Up!</p></div>");
                    $("#descs").empty();
                    $("#descs").text($("#description").val());
                    $("#name").empty();
                    $("#name").text($("#hotel_name").val());
                    $('#edit_informationz').hide();
                    $('#show_informationz').slideToggle("slow");
                } else {
                     $('#messages').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Hotel Write Up. Please try again!</p></div>");
                }
                $("#loadthis").removeClass('loader-show');
                setTimeout(function(){ $('#message').html(""); }, 4000);
            }
        });
     }
});
</script>