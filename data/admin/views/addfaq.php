
<!-- Modal hotel write-up -->
<div id="faq-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Question</h4>
        <div id="mssg_faq"></div>
      </div>
      <!-- content of hotel write-up -->
      <div class="modal-body">
          <div class="row">
              <form method="post" id="faqAreaForms">
                  <div class="col-sm-12">
                        <input type="hidden" class="form-control" rows="5" name="hotel_ID" value="<?=$hotelid;?>" />
                        <div class="col-sm-12"><br/>
                            <label class="control-label">Question</label><small> ( required ) </small>
                            <textarea class="form-control" rows="5" id="question" name="question"></textarea>
                            <input type="hidden" class="form-control" rows="5" value="" />
                        </div>
                        <div class="col-sm-12"><br/>
                            <label class="control-label">Answer</label><small> ( required ) </small>
                            <input type="text" class="form-control" id="answer" name="answer" value="" >
                        </div>
                        <div class="col-sm-12"><br/>
                            <button class="btn btn-info" name="action" value="add FAQ" type="submit" style="float:right;">Submit</button>
                        </div>
                  </div>
              </form>
        </div>
      </div><br/>
      <!-- end content of hotel write-up --> 
    </div>
  </div>
</div>

<script>
$("#faqAreaForms").validate({
    rules: {
        question: "required",
        answer: "required"
    },  
    submitHandler: function(form) {
        $("#loadthis").addClass('loader-show');
        var datafields = [];
        datafields = $("form").serializeArray();
        $.ajax({
            type:"POST",
            url:"controller/FAQController.php",
            data: datafields,
            success: function(data) {
                var result = $.trim(data);
                if(result == "true") {
                   datatable.destroy();
                   $('#data_handler').load("faq.php #data_display", function(){
                     $("#display_data").DataTable({
                        "order":[[2,"desc"]],
                        "aoColumnDefs":[{
                            'bSortable' : false,
                            'aTargets'  : [3]
                        }]
                     });
                   });
                   $('#mssg_faq').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Added Frequency Asked Question.</p></div>");
                }else {
                   $('#mssg_faq').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add Frequency Asked Question. Please try again!</p></div>");
                }
                $("#loadthis").removeClass('loader-show');
                setTimeout(function(){ $('#mssg_faq').html(""); }, 4000);
            }
        });
    }
});
</script>