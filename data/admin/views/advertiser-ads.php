<div id="mssg_ad"></div><br/>
<div id="advertiser-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
    <div class="modal-dialog modal-lg decor">
        <!-- Modal content -->
        <div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6" style="padding-left: 35px; padding-top: 20px; padding-bottom: 20px;">
						<div id="carousel-example-generic" class="carousel slide" data-interval="false">
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-generic" data-slide-to="1"></li>
								<li data-target="#carousel-example-generic" data-slide-to="2"></li>
								<li data-target="#carousel-example-generic" data-slide-to="3"></li>
								<li data-target="#carousel-example-generic" data-slide-to="4"></li>
							</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<img src="http://imgsv.imaging.nikon.com/lineup/lens/zoom/normalzoom/af-s_dx_18-300mmf_35-56g_ed_vr/img/sample/sample4_l.jpg" alt="..." style="height: 320px;" />
								</div>
								<div class="item">
									<img src="https://static.pexels.com/photos/896/city-weather-glass-skyscrapers-medium.jpg" alt="..."  style="height: 320px;" />
								</div>
								<div class="item">
									<img src="https://static.pexels.com/photos/896/city-weather-glass-skyscrapers-medium.jpg" alt="..."  style="height: 320px;" />
								</div>
								<div class="item">
									<img src="https://static.pexels.com/photos/896/city-weather-glass-skyscrapers-medium.jpg" alt="..."  style="height: 320px;" />
								</div>
								<div class="item">
									<img src="https://static.pexels.com/photos/896/city-weather-glass-skyscrapers-medium.jpg" alt="..."  style="height: 320px;" />
								</div>
							</div>

							<!-- Controls -->
							<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="row">
							<br/>
							<div><strong style="font-size: 25px;">Helmet Diving</strong></div>
							<br/>
							<div style="font-size: 14px; padding-right: 30px;">Spend a blissful rendezvous underwater with vibrant fishes and corals through helmet diving. This wondrous marine trip starts with a thrilling speedboat ride from White Beach to a wide raft in the middle of the sea amid the spectacular panorama of the surrounding islands. </div>
							<br/>
							<div style="font-size: 14px; padding-right: 30px;">Address :  Boracay</div>
							<br/>
							<div style="font-size: 14px; padding-right: 30px;">Contact :  09123456789</div>
							<br/>
						</div>
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
                            <th class="text-center">Company Name</th>
							<th class="text-center">Type</th>
							<th class="text-center">Hotel</th>
                            <th class="text-center">Places Nearby Name</th>
                            <th class="text-center">Date From</th>
                            <th class="text-center">Date To</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
							<th class="text-center">Preview</th>
                        </tr>
                    </thead>
                    <tbody>    
						<?php foreach($advertisements as $values => $ad): ?>	      
                        <tr class="lists-item">
                            <td class="text-center"><?=$ad['company'];?></td>
							<td class="text-center"><?=$ad['type'];?></td>
							<td class="text-center"><?=$ad['hotel'];?></td>
                            <td class="text-center"><?=$ad['name'];?></td>
                            <td class="text-center"><?=$ad['from'];?></td>
                            <td class="text-center"><?=$ad['to'];?></td>
                            <td class="text-center"><?=$ad['expired'];?></td>
                      
                            <td class="text-center">
                                &nbsp;&nbsp;<a href="editadvertisement.php?ad_id=<?=$ad['id'];?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;
                            </td>
							<td class="text-center">
                                &nbsp;&nbsp;<i class="fa fa-eye fa-2x" data-toggle="tooltip" id="<?=$ad['id'];?>" onclick='viewThis(this)' title="Preview" style="color:#000b5d;"></i>&nbsp;&nbsp;
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

function viewThis(element) {
	$('#advertiser-modal').modal().show();
	return false;
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