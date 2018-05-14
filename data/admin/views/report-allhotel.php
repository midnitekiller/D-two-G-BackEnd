<?php 
      include("model/AdminAllReportClass.php");
      $report_db = new AdminReport();
      $report_lists = $report_db->fetchViewAllHotelGuests();
      $hotel_lists = $report_db->fetchViewAllHotel();
?>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label>All Hotel Reports </label>
            </div>
            <div class="ibox-content"> 
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Hotel Name</label> <small>( required ) </small>
                            <select class="form-control m-b" name="hotel_name" id="hotel_name"> 
                                <option value="">-- Select --</option>
                                <?php foreach ($hotel_lists as $hotel_list): ?>
                                <option id="<?php echo $hotel_list['hotel_ID'];?>" value="<?php echo $hotel_list['hotel_name'];?>"><?php echo $hotel_list['hotel_name'];?></option>
                                <?php endforeach ?>
                            </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Date From</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="min"  id="datetimepicker1" value="" />
                        </div>
                    </div>  
                    <div class="col-sm-3">
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
                <label>All Hotel Reports </label>
            </div>
            <div class="ibox-content"> 
                <table id="sorting_data" class="table dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center select-filter">Hotel Name</th>
                            <th class="text-center">Guests Name</th>
                            <th class="text-center">Check In Date</th>
                            <th class="text-center">Check Out Date</th>
                            <th class="text-center">Date Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($report_lists as $report_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $report_list['guest_ID'];?></td>
                            <td class="text-center"><?php echo $report_list['hotel_name'];?></td>
                            <td class="text-center"><?php echo $report_list['lastname'].", ".$report_list['firstname']; ?></td>
                            <td class="text-center"><?php echo $report_list['check_in'];?></td>
                            <td class="text-center"><?php echo $report_list['check_out'];?></td>
                            <td class="text-center"><?php echo $report_list['created_at'];?></td>
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
    });
    $('#datetimepicker2').on('change', function() {
		var e = $("#datetimepicker2").val();
		table.draw();
		console.log(e);
    });
    $('#hotel_name').on('change', function () {
        table.columns(1).search( this.value).draw();
    });
});

$('#clearFilter').on('click', function() {
	$("#datetimepicker1").val("");
	$("#datetimepicker2").val("");
	$("#datetimepicker1").trigger("change");
	$("#datetimepicker2").trigger("change");
});

</script>