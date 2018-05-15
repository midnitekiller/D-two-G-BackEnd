<?php 
      include("model/AdminAllReportClass.php");
      $order_db = new AdminReport();
      $order_lists = $order_db->fetchViewService($hotelid);
?>

 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Services Report (Hotel Order) </label>
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
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Services Report (Hotel Order) </label>
            </div>
            <div class="ibox-content"> 
                <table id="sorting_data" class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <!--<th class="text-center">ID</th>-->
                            <th class="text-center">Guests Name</th>
                            <th class="text-center">Order Name</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Sub Total</th>
                            <th class="text-center">Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_lists as $order_list): ?>
                        <tr class="lists-item">
                            <!--<td class="text-center"><?php //echo $order_list['serviceOrder_ID'];?></td>-->
                            <td class="text-center"><?php echo $order_list['lastname'].", ".$order_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $order_list['service_name'];?></td>
                            <td class="text-center"><?php echo $order_list['serviceProdDuration'];?></td>
                            <td class="text-center"><?php echo $order_list['serviceProdPrice'];?></td>
                            <td class="text-center"><?php echo $order_list['subtotal'];?></td>
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
        var created = Date.parse( data[5] ) || 0; // use data for the age column
 
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