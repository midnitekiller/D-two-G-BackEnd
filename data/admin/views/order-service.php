<?php 
      include("model/OrderClass.php");
      $order_db = new Order();
      $order_lists = $order_db->fetchService($hotelid);
?>
<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-9">
            <h2>SERVICES ORDER DETAILS</h2>
        </div>
    </div>
</div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label>ALL SERVICES ORDER</label>
            </div>
            <div class="ibox-content"> 
                <table id="#ServiceListTable" class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
							<th class="text-center">Hidden Value</th>
                            <th class="text-center">Room Number</th>
                            <th class="text-center">Guests Name</th>
                            <th class="text-center">Grand Total</th>
                            <th class="text-center">Date Order</th>
                            <th class="text-center">View Order</th>
                            <th class="text-center">Confirm Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_lists as $order_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $order_list['serviceOrder_ID'];?></td>
							<td class="text-center"><?php echo $order_list['notif_seen'];?></td>
                            <td class="text-center"><?php echo $order_list['room_no'];?></td>
                            <td class="text-center"><?php echo $order_list['lastname']." , ".$order_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $order_list['grand_total'];?></td>
                            <td class="text-center"><?php echo $order_list['created_at'];?></td>
                            <td class="text-center">
                                <a href="view-orderService.php?id=<?php echo $order_list['serviceOrder_ID']; ?>" class="glyphicon glyphicon-eye-open fa-2x" data-toggle="tooltip" title="View Order"></a>
                            </td>
                            <td class="text-center">
                                <label class="switch">
                                  <input id="<?=$order_list['serviceOrder_ID'];?>" type="checkbox" <?=($order_list['confirm_status'] == "active") ? "checked" : ""?> data-toggle="toggle" onclick="updateStatus(this);">
                                  <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"  src="js/view_guests.js"></script>
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
								action: 'Set Notification Services',
								hotelid: hotelidd,
								orderid: aData[0]
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

 function updateStatus(checkbox){
	 var status;
	 var id = checkbox.id;
     if(document.getElementById(id).checked){
		 status = "active";
         $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Confirm Order.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }else{
		 status = "inactive";
         $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-remove'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Succesfully Cancel Order.</p></div>");
         setTimeout(function(){ $('#mssg').html(""); }, 4000);
	 }
	 
     $.ajax({
		type:"POST",
		url:"controller/OrderController.php",
		data: {
			action : "Status ServiceOrder",
			status : status,
			serviceOrder_ID : id
		},
		success: function(data) {
		}
	});
 }  
</script>
