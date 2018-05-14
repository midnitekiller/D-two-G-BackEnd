<?php
      //include("addfaq.php");
      include("model/FAQClass.php");
      $FAQ_db = new FAQ();
      $FAQ_lists = $FAQ_db->fetchFAQall($hotelid);
?>
<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> Frequency Asked Question </label>
                <a class="buttonsp" name="action" value="" type="submit" data-toggle="modal" id="addfaq"><i class="fa fa-plus"></i> Create New Question</a>
            </div>
            <div id="data_handler" class="ibox-content"> 
                <table id="data_display" class="table table-bordered dynamicDataTables" id="FAQListTable">
                    <thead>
                        <tr>
                            <th class="text-center" width="50">ID</th>
                            <th class="text-center" width="500">Question</th>
                            <th class="text-center">Answer</th>
                            <th class="text-center" width="150">Date Registered</th>
                            <th class="text-center" width="150">Status</th>
                            <th class="text-center" width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($FAQ_lists as $FAQ_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $FAQ_list['faq_ID'];?></td>
                            <td class="text-center"><?php echo $FAQ_list['question'];?></td>
                            <td class="text-center"><?php echo $FAQ_list['ans'];?></td>
                            <td class="text-center"><?php echo $FAQ_list['created_at'];?></td>
                            <td class="text-center">
                                <label class="switch">
                                  <input id="<?=$FAQ_list['faq_ID'];?>" type="checkbox" <?=($FAQ_list['status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                                  <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="update-faq.php?id=<?php echo $FAQ_list['faq_ID']; ?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $FAQ_list['faq_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button id="addfaqz" class="material-button material-button-toggle" title="Add FAQ" data-toggle="modal" data-target="faq-modal"><span class="fa fa-plus" aria-hidden="true"></span></button>
<!-- Modal hotel faq -->
<div id="faq-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Question</h4>
        <div id="mssg_faq"></div>
      </div>
      <!-- content of hotel faq -->
      <div class="modal-body">
          <div class="row">
              <form method="post" id="faqAreaForms">
                  <div class="col-sm-12">
                        <input type="hidden" class="form-control" rows="5" name="hotel_ID" value="<?=$hotelid;?>" />
                        <div class="col-sm-12"><br/>
                            <label class="control-label">Question</label><small> ( required ) </small>
                            <input type="text" class="form-control" id="question" name="question" value="" >
                        </div>
                        <div class="col-sm-12"><br/>
                            <label class="control-label">Answer</label><small> ( required ) </small>
                            <textarea class="form-control" rows="5" id="answer" name="answer"></textarea>
                            <input type="hidden" class="form-control" rows="5" value="" />
                        </div>
                        <div class="col-sm-12"><br/>
                            <button class="btn btn-info" name="action" value="add FAQ" type="submit" style="float:right;">Submit</button>
                        </div>
                  </div>
              </form>
        </div>
      </div><br/>
      <!-- end content of hotel faq --> 
    </div>
  </div>
</div>

<?php include'views/script-foot.php' ?>

<script>
$(document).ready(function(){
    $('#addfaq').on('click',function(){
       $('#faq-modal').modal().show();
        return false;
    });
    $('#addfaqz').on('click',function(){
       $('#faq-modal').modal().show();
        return false;
    });
});
    

function deleteThis(element) {
    var faq_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove FAQ"});
        data.push({"name":"faq_ID","value":faq_ID});
        $.post(
            'controller/FAQController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Deleted Frequency Asked Question.</p></div>");
            $("#loadthis").removeClass('loader-show');
            setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        );
    }
}
    
function updateStatus(checkbox){
var status;
var id = checkbox.id;
	 if(document.getElementById(id).checked){
		 status = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Activated Frequency Asked Question.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully DeActivated Frequency Asked Question.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
     $.ajax({
		type:"POST",
		url:"controller/FAQController.php",
		data: {
			action : "Status FAQ",
			status : status,
			faq_ID : id
		},
		success: function(data) {
			
		}
	}); 
 } 
$(document).ready(function(){
    var datatable = $("#display_data").DataTable({
        "order":[[2,"desc"]],
        "aoColumnDefs":[{
            'bSortable' : false,
            'aTargets'  : [3]
        }]
    });

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
});
</script>