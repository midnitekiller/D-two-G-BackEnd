<div id="mssg_ad"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Places Nearby Sorting </label>
            </div>
            <div class="ibox-content"> 
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label">Hotel Name</label> <small>( required ) </small>
                        <select name="title" id="hotel_ID" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <?php foreach($hotels as $key => $hotel):  ?>
								<option value="<?=$hotel['hotel_ID'];?>"><?=$hotel['hotel_name'];?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins" id="allshow-housekeeping" >
            <div class="ibox-title-table">
                <label> Places Nearby List </label>
				<a id="" class="btn buttonsp" onclick="clearFilter(this);"><i class="fa fa-eraser"></i> Clear Filter</a>
                <a id="expired" class="btn buttonsp" onclick="expiredAds(this);"><i class="fa fa-close"></i> Expired Places Nearby</a>
                <a id="active" class="btn buttonsp" onclick="liveAds(this);"><i class="fa fa-check-circle"></i> Live Places Nearby</a>
            </div>
            <div class="ibox-content"> 
                <table class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Company Name</th>
							<th class="text-center">Type</th>
							<th class="text-center">Hotel</th>
                            <th class="text-center">Places Nearby Name</th>
                            <th class="text-center">Date From</th>
                            <th class="text-center">Date To</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
						<?php foreach($advertisements as $values => $ad): ?>	      
                        <tr class="lists-item">
                            <td class="text-center"><?=$ad['id'];?></td>
                            <td class="text-center"><?=$ad['company'];?></td>
							<td class="text-center"><?=$ad['type'];?></td>
							<td class="text-center"><?=$ad['hotel'];?></td>
                            <td class="text-center"><?=$ad['name'];?></td>
                            <td class="text-center"><?=$ad['from'];?></td>
                            <td class="text-center"><?=$ad['to'];?></td>
                            <td class="text-center"><?=$ad['expired'];?></td>
                      
                            <td class="text-center">
                                <a href="editad.php?ad_id=<?=$ad['id'];?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-trash fa-2x" data-toggle="tooltip" id="<?=$ad['id'];?>" onclick='deleteThis(this)' title="Delete" style="color:#333;"></i>
                            </td>
                        </tr>
						<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include'views/script-foot.php' ?>
<script>
	
	function deleteThis(element) {
    var ad_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Ad"});
        data.push({"name":"ad_ID","value":ad_ID});
        $.post(
            'controller/AdvertisementController.php',
            data,
            function(data) {
				switch(data){
					case 'true':
						$('#mssg_ad').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Remove Ad.</p></div>")
						$("#loadthis").removeClass('loader-show');
						setTimeout(function(){ $('#mssg_ad').html(""); }, 4000);
						break;
					default:
						break;
				}
            }
        );
    }
}
var table = $('.dynamicDataTables').DataTable();
function liveAds(element){
	var e = $(element).attr('id'),
		regex = '\\b' + e + '\\b';
	
	table.search( regex,true,false ).draw();
	console.log(e);
}
function expiredAds(element){
	var e = $(element).attr('id'),
		regex = '\\b' + e + '\\b';
	table.search( regex,true,false ).draw();
	console.log(e);
}
function clearFilter(element){
	table.search( "" ).draw();
}

$("#hotel_ID").on('change', function() {
		var e = $("#hotel_ID option:selected").text();
		if(e != "-- Select --"){
			table.search( e ).draw();
		}else{
			table.search("").draw();
		}
		console.log(e);
});
</script>