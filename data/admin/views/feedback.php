<?php 
      include("model/FeedbackClass.php");
      $feedback_db = new Feedback();
      $feedback_lists = $feedback_db->fetchViewFeedback($hotelid);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Guests Feedback Details</h2>
    </div>
</div><br/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins" id="allshow-housekeeping" >
            <div class="ibox-title">
                <label> All Feedbacks </label>
            </div>
            <div class="ibox-content"> 
                <table class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
							<th class="text-center">Hidden Value</th>
                            <th class="text-center">Guests Name</th>
                            <th class="text-center">Room No.</th>
                            <th class="text-center">Overall</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Room</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Cleanliness</th>
                            <th class="text-center">Restaurant</th>
                            <th class="text-center" width="300">Feedback Message</th>
                            <th class="text-center">Date Feedback</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>         
                        <?php foreach ($feedback_lists as $feedback_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $feedback_list['feedback_ID'];?></td>
							<td class="text-center"><?php echo $feedback_list['notif_seen'];?></td>
                            <td class="text-center"><?php echo $feedback_list['lastname'].", ".$feedback_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $feedback_list['room_no'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_overall'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_location'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_room'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_service'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_value'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_cleanliness'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_restaurant'];?></td>
                            <td class="text-center"><?php echo $feedback_list['feedback_message'];?></td>
                            <td class="text-center"><?php echo $feedback_list['created_at'];?></td>
                            <td class="text-center">
                                <a href='javascript:;' name="action" id="<?php echo $feedback_list['feedback_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables/dataTables.buttons.min.js"></script>
<script src="http://www.direct2guests.tv/js/plugins/dataTables/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script>

</script>
<!--<script src="assets/js/my_jquery.js"></script>-->
<script src="assets/js/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

<script>
	
	
	var table = $('.dynamicDataTables').dataTable({
		dom: 'Blfrtip',
		buttons: ['copy', 'excel', 'pdf','print'],
		ordering:true,
		searching:true,
		bFilter:true,
		language: { search: "" },
		"columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false
            },
			{
				"targets": [ 0 ],
				"visible": false,
				"searchable": false
			}],
		"createdRow": function( row, data, dataIndex ) {
			if ( data[1] == "false" ) {
			  $(row).addClass( 'set-tr-bkg' );
			  console.log("added class");
			}else{
				console.log("error");
			}
		  },
		  "fnRowCallback": function (nRow, aData, iDisplayIndex) {

                // Bind click event
                $(nRow).click(function() {

					if ( $(this).hasClass('set-tr-bkg') ) {
						$(this).removeClass('set-tr-bkg');
						console.log("clicked");
						$.ajax({
							type: "POST",
							url: "controller/NotificationsController.php",
							data: {
								action: 'Set Notification FeedBack',
								hotelid: hotelidd,
								feedid: aData[0]
							},success: function(data){
								
							}
						});
					}
                });

                return nRow;
           }
	});
	
	
</script>
<script>
    function deleteThis(element) {
    var feedback_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Feedback"});
        data.push({"name":"feedback_ID","value":feedback_ID});
        $.post(
            'controller/FeedbackController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted Feedback.</p></div>");
            $("#loadthis").removeClass('loader-show');
            setTimeout(function(){ $('#mssg').html(""); }, 2000);
            }
        );
    }
}
</script>