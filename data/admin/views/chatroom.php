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
					<input type="hidden" id="guestidd" value=""/>
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
					<div class="ds">
							<div class="desc" id="su" name="guests_contacts[]" onclick="loadChat(this);" >
								<div style="float:left;margin-right:10px;margin-left:5px;">
									<img src="media/d2g.png" class="img-responsive" alt="" class="center-block" style="height:55px;width:60px;">
									<input type="hidden" id="aasu" value="Superadmin" />
								</div>
								<div>
                                    <p style="font-size:14px;">
								        <br/><a href="#"><b>D2G Assistant</b><span name="chat_count[]" value="<?=$sucount;?>" class="badge-me <?=($sucount == '0') ? "visible-me":"";?>"><?=$sucount;?></span></a>
                                    </p>
								</div>
							</div>
						<?php foreach($guests as $values => $gui): ?>
							<div class="desc" id="<?=$gui['guest_ID'];?>" name="guests_contacts[]" onclick="loadChat(this);" >
								<div style="float:left;margin-right:10px;margin-left:5px;">
									<span name="guest_icon"><img src="media/guests_icon.png" class="img-responsive" alt="" class="center-block" style="height:55px;width:auto;"></span>
									<input type="hidden" id="aa<?=$gui['guest_ID'];?>" value="<?=$gui['guest_name'];?> (RM <?=$gui['room_no'];?>)" />
								</div>
								<div style="margin-top: -11px;">
									<p style="font-size:14px;">
										<br/><a href="#"><?=$gui['guest_name'];?><span name="chat_count[]" value="<?=$gui['unseen_count'];?>" class="badge-me <?=($gui['unseen_count'] == '0') ? "visible-me":"";?>"><?=$gui['unseen_count'];?></span><br/><b>RM <?=$gui['room_no'];?></a>
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
var our_hotel_id = "";
$(document).ready(function(){
	var usertype = "<?=$usertype;?>";
	var guest_id = "<?=$guestidd;?>";
	our_hotel_id = "<?=$ourid;?>";
	$('#hotelidd').val(our_hotel_id);
	if(guest_id == "" && usertype == "su"){
		document.getElementById('su').click();
	}else{
		document.getElementById(guest_id).click();
	}
	loadCount();
	setInterval(worker, 2000);
});
var message_count = [];
var dyn_count = [];
function loadCount(){
	<?php foreach($guesting as $key => $ho): ?>
	message_count[<?=$key;?>] = <?=$ho['unseen_count'];?>; 
	<?php endforeach;?>
	console.log(message_count);
}

function worker(){
    
    $.ajax({
		type: "POST",
		url: "controller/ChatController.php",
		data: {
			action: 'Refresh Count',
			msgto: 'admin',
			hotel_id: our_hotel_id
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
					var guest_id = $(".mefocused").attr('id');
					if(j == seld){
						var ssfrom = "";
						if(guest_id == "su"){
							ssfrom = "superadmin";
						}else{
							ssfrom = "guest";
						}
						
						console.log("ssfrom ::  "+our_hotel_id);
						$.ajax({
							type: "POST",
							url: "controller/ChatController.php",
							data: {
								action: "Get Last Unseen Messages",
								guestid: guest_id,
								hotelid: our_hotel_id,
								msgfrom: ssfrom,
								msgto: "admin",
								ucount: message_count[j]
							},success: function(data){
								var side;
								var msg_array = JSON.parse(data);
								for(var i = msg_array.length-1; i >= 0; i--){
									var obj = msg_array[i];
									if(obj.msg_to == "admin"){
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
											guestid: guest_id,
											hotelid: our_hotel_id,
											msgfrom: ssfrom,
											msgto: "admin"
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
					var guest_id = $(".mefocused").attr('id');
					if(j == seld){
						var ssfrom = "";
						if(guest_id == "su"){
							ssfrom = "superadmin";
						}else{
							ssfrom = "guest";
						}
						$.ajax({
							type: "POST",
							url: "controller/ChatController.php",
							data: {
								action: "Get Last Unseen Messages",
								guestid: guest_id,
								hotelid: our_hotel_id,
								msgfrom: ssfrom,
								msgto: "admin",
								ucount: message_count[j]
							},success: function(data){
								var side;
								var msg_array = JSON.parse(data);
								for(var i = msg_array.length-1; i >= 0; i--){
									var obj = msg_array[i];
									if(obj.msg_to == "admin"){
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
											guestid: guest_id,
											hotelid: our_hotel_id,
											msgfrom: ssfrom,
											msgto: "admin"
										},
										success: function(data){
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
<script type="text/javascript" src="js/adminchat.js"></script>