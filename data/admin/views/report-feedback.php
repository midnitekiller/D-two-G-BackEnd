<?php 
      include("model/AdminAllReportClass.php");
      $order_db = new AdminReport();
      $order_lists = $order_db->fetchViewFeedback($hotelid);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Feedbacks Report </label>
            </div>
            <div class="ibox-content"> 
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Date From</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="min"  id="datetimepicker1" value="" />
                        </div>
                    </div>  
                    <div class="col-sm-5">
                        <label class="control-label">Date To</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="max" id="datetimepicker2" value="" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-info pull-right" name="action" id="clearFilter" value="display" type="button">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins" id="allshow-housekeeping" >
            <div class="ibox-title">
                <label> Feedbacks Report </label>
            </div>
            <div class="ibox-content"> 
                <table id="sorting_data" class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Guests Name</th>
                            <th class="text-center">Room Number</th>
                            <th class="text-center">Overall</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Room</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Cleanliness</th>
                            <th class="text-center">Restaurant</th>
                            <th class="text-center">Feedback Message</th>
                            <th class="text-center">Date Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_lists as $order_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $order_list['guest_ID'];?></td>
                            <td class="text-center"><?php echo $order_list['lastname'].", ".$order_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $order_list['room_no'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_overall'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_location'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_room'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_service'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_value'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_cleanliness'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_restaurant'];?></td>
                            <td class="text-center"><?php echo $order_list['feedback_message'];?></td>
                            <td class="text-center"><?php echo $order_list['created_at'];?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/checktime.js"></script>
<?php include'views/script-foot.php' ?>
<script>
/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = Date.parse( $('#datetimepicker1').val());
        var max = Date.parse( $('#datetimepicker2').val());
        var created = Date.parse( data[11] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && created <= max ) ||
             ( min <= created  && isNaN( max ) ) ||
             ( min <= created  && created <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#sorting_data').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
	$('#datetimepicker1').on('change', function() {
		var e = $("#datetimepicker1").val();
        table.draw()
		console.log(e);
    } );
    $('#datetimepicker2').on('change', function() {
		var e = $("#datetimepicker2").val();
		table.draw();
		console.log(e);
    } );
} );

$('#clearFilter').on('click', function() {
	$("#datetimepicker1").val("");
	$("#datetimepicker2").val("");
	$("#datetimepicker1").trigger("change");
	$("#datetimepicker2").trigger("change");
});
</script>

