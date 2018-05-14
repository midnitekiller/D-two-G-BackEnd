<?php 
      include("model/HousekeepingClass.php");
      $keeping_db = new Housekeeping();
      $keeping_lists = $keeping_db->fetchViewHousekeeping($hotelid);
      $requests_lists = $keeping_db->fetchViewRequested($hotelid);
      $cancel_lists = $keeping_db->fetchViewCancelHousekeeping($hotelid);
      $stay_lists = $keeping_db->fetchViewStayHousekeeping($hotelid);
?>
<a class="buttonsp pull-left" id="showall" name="action" value="" type="submit" data-toggle="modal" data-target="#amenities-modal"><i class="fa fa-square-o"></i>&nbsp;&nbsp;Display all</a>
<a class="buttonsp pull-left" id="categoryall" name="action" value="" type="submit" data-toggle="modal" data-target="#amenities-modal"><i class="fa fa-clone"></i>&nbsp;&nbsp;Display by Category</a><br/><br/><br/>
<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins" id="allshow-housekeeping">
            <div class="ibox-title">
                <label> All Housekeeping </label>
            </div>
            <div class="ibox-content"> 
                <table class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
							<th class="text-center">Hidden Value</th>
                            <th class="text-center">Guest Name</th>
                            <th class="text-center">Room Number</th>
                            <th class="text-center">Housekeeping Type</th>
                            <th class="text-center">Date Request</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keeping_lists as $keeping_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $keeping_list['housekeeping_ID']; ?></td>
							<td class="text-center"><?php echo $keeping_list['notif_seen']; ?></td>
                            <td class="text-center"><?php echo $keeping_list['lastname'].", ".$keeping_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $keeping_list['room_no']; ?></td>
                            <td class="text-center"><?php echo $keeping_list['hk_status']; ?></td>
                            <td class="text-center"><?php echo $keeping_list['created_at']; ?></td>
                            <td class="text-center">
                                <a href='javascript:;' name="action" id="<?php echo $keeping_list['housekeeping_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="" id="category-housekeeping">
     <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins" id="allshow-housekeeping" >
                <div class="ibox-title">
                    <label> Requested HouseKeeping </label>
                </div>
                <div class="ibox-content"><br>
                    <table class="table rhtable">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
								<th class="text-center">Hidden Value</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Room No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests_lists as $requests_list): ?>
                            <tr class="lists-item">
                                <td class="text-center"><?php echo $requests_list['housekeeping_ID']; ?></td>
							<td class="text-center"><?php echo $requests_list['notif_seen']; ?></td>
                                <td class="text-center"><?php echo $requests_list['lastname'].", ".$requests_list['firstname']; ?></td>
                                <td class="text-center"><?php echo $requests_list['room_no']; ?></td>
                                <td class="text-center"><?php echo $requests_list['created_at']; ?></td>
                                <td class="text-center">
                                    <a href='javascript:;' name="action" id="<?php echo $requests_list['housekeeping_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins" id="allshow-housekeeping" >
                <div class="ibox-title">
                    <label> Cancelled HouseKeeping Today </label>
                </div>
                <div class="ibox-content"><br>
                    <table class="table chttable">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
								<th class="text-center">Hidden Value</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Room No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cancel_lists as $cancel_list): ?>
                            <tr class="lists-item">
                                <td class="text-center"><?php echo $cancel_list['housekeeping_ID']; ?></td>
							<td class="text-center"><?php echo $cancel_list['notif_seen']; ?></td>
                                <td class="text-center"><?php echo $cancel_list['lastname'].", ".$cancel_list['firstname']; ?></td>
                                <td class="text-center"><?php echo $cancel_list['room_no']; ?></td>
                                <td class="text-center"><?php echo $cancel_list['created_at']; ?></td>
                                <td class="text-center">
                                    <a href='javascript:;' name="action" id="<?php echo $keeping_list['housekeeping_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins" id="allshow-housekeeping" >
                <div class="ibox-title">
                    <label> Cancelled HouseKeeping for Whole Stay </label>
                </div>
                <div class="ibox-content"><br>
                    <table class="table chwstable">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
								<th class="text-center">Hidden Value</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Room No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stay_lists as $stay_list): ?>
                            <tr class="lists-item">
                                <td class="text-center"><?php echo $stay_list['housekeeping_ID']; ?></td>
							<td class="text-center"><?php echo $stay_list['notif_seen']; ?></td>
                                <td class="text-center"><?php echo $stay_list['lastname'].", ".$stay_list['firstname']; ?></td>
                                <td class="text-center"><?php echo $stay_list['room_no']; ?></td>
                                <td class="text-center"><?php echo $stay_list['created_at']; ?></td>
                                <td class="text-center">
                                    <a href='javascript:;' name="action" id="<?php echo $stay_list['housekeeping_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
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
								action: 'Set Notification Housekeeping',
								hotelid: hotelidd,
								hkid: aData[0]
							},success: function(data){
								
							}
						});
					}
                });

                return nRow;
           }
	});
	
	var rhtable = $('.rhtable').dataTable({
		ordering:true,
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
								action: 'Set Notification Housekeeping',
								hotelid: hotelidd,
								hkid: aData[0]
							},success: function(data){
								
							}
						});
					}
                });

                return nRow;
           }
	});
	
	var chttable = $('.chttable').dataTable({
		ordering:true,
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
								action: 'Set Notification Housekeeping',
								hotelid: hotelidd,
								hkid: aData[0]
							},success: function(data){
								
							}
						});
					}
                });

                return nRow;
           }
	});
	
	var chwstable = $('.chwstable').dataTable({
		ordering:true,
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
								action: 'Set Notification Housekeeping',
								hotelid: hotelidd,
								hkid: aData[0]
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
    
$(document).ready(function(){
    $('#category-housekeeping').hide();

    $('#categoryall').on('click',function(){
        $('#category-housekeeping').slideDown(1500);
        $('#allshow-housekeeping').hide();
    });

    $('#showall').on('click', function(){
        $('#allshow-housekeeping').slideDown(1500);
        $('#category-housekeeping').hide();
    });
});
    

function deleteThis(element) {
    var housekeeping_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Housekeeping"});
        data.push({"name":"housekeeping_ID","value":housekeeping_ID});
        $.post(
            'controller/HousekeepingController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted Housekeeping.</p></div>");
            $("#loadthis").removeClass('loader-show');
            setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        );
    }
}

</script>