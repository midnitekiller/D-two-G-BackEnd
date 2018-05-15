<div class="row">
    <div class="col-lg-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label id="chatName"> Admin </label><br/>
			    <!--<i><span class="fa fa-circle" style="color:#a3d063;"></span> Online </i>-->
            </div>
            <div class="ibox-content"> 
                <ul class="messages" id="msssgs"></ul>
				<br/>
				<div class="row justify-content-md-center">
					<div class="input-group">
						<input type="text" class="form-control message_inputs" placeholder="Your message here...." style="height:43px;">
						<span class="input-group-btn">
							<button class="btn btn-secondary send_message" type="button"><i class="fa fa-send fa-2x" aria-hidden="true"></i></button>
						</span>
					</div>
					<input type="hidden" id="hotelidd" value=""/>
				</div>
            </div>
        </div>
    </div>
	<div class="col-lg-3">
		<div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> Contact List </label><br/>
            </div>
            <div class="ibox-content"> 
                <ul class="" style="position: relative;list-style: none;margin: 0;height: 650px;overflow-y: scroll;">
					<div class=" ds">
						<?php foreach($hotels as $values => $hotel): ?>
							<div class="desc" id="<?=$hotel['hotel_ID'];?>" name="hotel_contacts[]" onclick="loadChat(this);" >
								<div style="float:left;margin-right:10px;margin-left:5px;">
									<img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $hotel['hotel_name']);?>/logo/<?=$hotel['hotel_image'];?>" class="img-responsive" alt="" class="center-block" style="height:55px;width:auto;">
									<input type="hidden" id="aa<?=$hotel['hotel_ID'];?>" value="<?=$hotel['hotel_name'];?>" />
								</div>
								<div>
									<p style="font-size:14px;">
										<br/><a href="#"><b><?=$hotel['hotel_name'];?></b><span name="chat_count[]" value="<?=$hotel['unseen_count'];?>" class="badge-me <?=($hotel['unseen_count'] == '0') ? "visible-me":"";?>"><?=$hotel['unseen_count'];?></span></a>
									</p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</ul>
            </div>
        </div>
	</div>
</div>
<div class="message_template">
    <li class="message">
        <div class="text_wrapper">
            <div class="text"></div><small class="datesent"></small>
				<span class="message-time pull-right"></span>
        </div>
    </li>
</div>
<div id="mssg" class="col-md-3" style="top:0;right:0;position:fixed;margin-top:10px;margin-right:-5px;"></div>

<script>
$(document).ready(function(){
	var hotel_id = "<?=$hotelidd;?>";
	if(hotel_id == ""){
		document.getElementById('1').click();
	}else{
		document.getElementById(hotel_id).click();
	}
	console.log(hotel_id);
	loadCount();
	setInterval(worker, 2000);
});
var message_count = [];
var dyn_count = [];
function loadCount(){
	<?php foreach($hotels as $key => $ho): ?>
	message_count[<?=$key;?>] = <?=$ho['unseen_count'];?>; 
	<?php endforeach;?>
}

function worker(){
    
    $.ajax({
		type: "POST",
		url: "controller/ChatController.php",
		data: {
			action: 'Refresh Count',
			msgto: 'superadmin'
		},success: function(data){
			var cnt_obj = JSON.parse(data);
			for(var i = 0; i < cnt_obj.length; i++){
				var obj = cnt_obj[i];
				dyn_count[i] = obj.unseen_count;
			}
			for(var j = 0; j < dyn_count.length; j++){
				if(dyn_count[j] > message_count[j]){
					message_count[j] = dyn_count[j];
					$("span[name='chat_count[]']").eq(j).removeClass('visible-me');
					$("span[name='chat_count[]']").eq(j).val(message_count[j]);
					$("span[name='chat_count[]']").eq(j).text(message_count[j]);
					var messagetone = $('#message_tone');
					messagetone[0].play();
					var seld = $(".mefocused").index();
					var hotel_id = $(".mefocused").attr('id');
					if(j == seld){
						console.log("equal select");
						$.ajax({
							type: "POST",
							url: "controller/ChatController.php",
							data: {
								action: "Get Last Unseen Messages",
								hotelid: hotel_id,
								msgfrom: "admin",
								msgto: "superadmin",
								ucount: message_count[j]
							},success: function(data){
								var side;
								var msg_array = JSON.parse(data);
								for(var i = msg_array.length-1; i >= 0; i--){
									var obj = msg_array[i];
									if(obj.msg_to == "superadmin"){
										side = "left";
									}
									sendMessage(obj.msg, side, obj.created_at);
									$('.messages').animate({scrollTop: $('.messages').prop('scrollHeight') },300);
									$("span[name='chat_count[]']").eq(seld).addClass('visible-me');
									$.ajax({
										type:"POST",
										url:"controller/ChatController.php",
										data:{
											action: "Change Status",
											hotelid: hotel_id,
											msgfrom: "admin",
											msgto: "superadmin"
										},
										success: function(data){
										}
									});
								}
							}
						});
					}
				}else if(dyn_count[j] == message_count[j] && dyn_count[j] != 0){
					var seld = $(".mefocused").index();
					var hotel_id = $(".mefocused").attr('id');
					if(j == seld){
						console.log("equal select");
						$.ajax({
							type: "POST",
							url: "controller/ChatController.php",
							data: {
								action: "Get Last Unseen Messages",
								hotelid: hotel_id,
								msgfrom: "admin",
								msgto: "superadmin",
								ucount: message_count[j]
							},success: function(data){
								var side;
								var msg_array = JSON.parse(data);
								for(var i = msg_array.length-1; i >= 0; i--){
									var obj = msg_array[i];
									if(obj.msg_to == "superadmin"){
										side = "left";
									}
									sendMessage(obj.msg, side, obj.created_at);
									$('.messages').animate({scrollTop: $('.messages').prop('scrollHeight') },300);
									$("span[name='chat_count[]']").eq(seld).addClass('visible-me');
									$.ajax({
										type:"POST",
										url:"controller/ChatController.php",
										data:{
											action: "Change Status",
											hotelid: hotel_id,
											msgfrom: "admin",
											msgto: "superadmin"
										},
										success: function(data){
											console.log(data +" - "+ index);
										}
									});
								}
							}
						});
					}
				}
			}
		}
	});
}

</script>
<script type="text/javascript" src="js/superadminchat.js"></script>