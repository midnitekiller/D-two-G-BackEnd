<?php
      include("model/FAQClass.php");;
      $faq_ID = $_GET['id'];
      $FAQ_db = new FAQ();
      $FAQ_lists = $FAQ_db->fetchFAQInformation($faq_ID);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>Update FAQ Details</h2>
        </div>
    </div>
</div>
<?php foreach ($FAQ_lists as $FAQ_list): ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5>Registered FAQ Details</h5>
            </div>
            <div class="ibox-content">
                <div class="row" style="height:170px;">
                    <div class="col-sm-3">
                        <i class="fa fa-question-circle-o fa-5x center-block"></i>
                    </div>
                    <div class="col-sm-9">
                     
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Question</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $FAQ_list['question'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Answer</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $FAQ_list['answer'];?></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <strong>Date Registered</strong>
                            </div>
                            <div class="col-sm-9"><?php echo $FAQ_list['created_at'];?></div>
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
            <h4>Update FAQ Details</h4>
        </div>
        <div class="ibox-content">
            <form method="post"  id="editFAQForm">
                <div class="form-group">
                    <span class="label label-success arrowed"> FAQ Details</span>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <input type="hidden" class="form-control" name="faq_ID" id="faq_ID" value="<?php echo $_GET['id']; ?>">
                    <div class="col-sm-6">
                        <label class="control-label">Question</label><small> ( required ) </small>
                        <textarea class="form-control" rows="5" id="question" name="question"></textarea>
                        <input type="hidden" class="form-control" rows="5" value="" />
                    </div>
                     <div class="col-sm-6">
                        <label class="control-label">Answer</label> <small>( required ) </small>
                        <input type="text" class="form-control" name="answer" id="answer" value="">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="faq.php" class="btn btn-info" type="submit" style="padding-top:10px;">Back</a>
                            <button class="btn btn-info" name="action" value="Edit FAQ" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
             </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/checktime.js"></script>
<script>
$(function () {
    $("#loadthis").addClass('loader-show');
    var faq_ID = $("#faq_ID").val();
    var data = [];
    data.push({"name":"action","value":"Get FAQ By ID"});
    data.push({"name":"faq_ID","value":faq_ID});
    $.post(
        'controller/FAQController.php',
        data,
        function(info) {
            showFeature(info);
            $("#loadthis").removeClass('loader-show');
        }
    );
    $("#editFAQForm").validate({
        rules: {
            question: "required",
            answer: "required",
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
						$('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Updated Frequently Asked Question.</p></div>");
					}else {
						$('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Update Frequently Asked Question. Please try again!</p></div>");
					}
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    })
});
function showFeature(FAQ) {
    var FAQ_info = JSON.parse(FAQ);
    $("#question").val(FAQ_info[2]);
    $("#answer").val(FAQ_info[3]);
}
</script>