

function sendMessage(message, side, date) {
	var $message;
	$('.message_inputs').val("");
	$message = $($('.message_template').clone().html());
	$message.addClass(side).find('.text').html(message);
	$message.find('.datesent').html(date);
	$('.messages').append($message);
	setTimeout(appeared($message),0);
	
	
}

function appeared($msg){
	$msg.addClass('appeared');
}

function getMessageText() {
	var $message_input;
	$message_input = $('.message_inputs');
	return $message_input.val();
}

function getGuestID() {
	var $guestid;
	$guestid = $('#guestidd');
	return $guestid.val();
}

function getHotelID() {
	var $hotelid;
	$hotelid = $('#hotelidd');
	return $hotelid.val();
}

$('.send_message').click(function (e) {
	if(getMessageText() != ""){
		$.ajax({
			type:"POST",
			url:"controller/ChatController.php",
			data: {
				action: 'Send Message',
				msg: getMessageText(),
				guest_id: getGuestID(),
				hotel_id: getHotelID()
			},
			success: function(data) {
				if(data) {
					var d = new Date();
					var date = d.getMonth() + " " + d.getDate() + ", " + d.getFullYear() + " - " + d.getHours().toString() + ":" + d.getMinutes().toString();
					sendMessage(getMessageText(), 'right', date);
					$('.messages').animate({ scrollTop: $('.messages').prop('scrollHeight') },300);
				}else {
					$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Message not sent.</div>");
					$('#popalert').show();
					console.log(data);
				}
				
			}
		});
	}
});

$('.message_inputs').keyup(function (e) {
	if (e.which === 13) {
		if(getMessageText() != ""){
			$.ajax({
				type:"POST",
				url:"controller/ChatController.php",
				data: {
					action: 'Send Message',
					msg: getMessageText(),
					guest_id: getGuestID(),
					hotel_id: getHotelID()
				},
				success: function(data) {
					if(data) {
						var d = new Date();
						var date = d.getMonth() + " " + d.getDate() + ", " + d.getFullYear() + " - " + d.getHours().toString() + ":" + d.getMinutes().toString();
						sendMessage(getMessageText(), 'right', date);
						$('.messages').animate({ scrollTop: $('.messages').prop('scrollHeight') },300);
					}else {
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Message not sent.</div>");
						$('#popalert').show();
						console.log(data);
					}
					
				}
			});
		}
	}
});

function loadChat (guestid) {
	var desc = document.getElementsByClassName("desc");
	var chatname = $("#aa"+guestid.id).val();
	var $chatname = $("#chatName");
	$chatname.text(chatname);
	for(var i =0; i < desc.length; i++){
		//desc[i].style.background = "#ffffff";
		desc[i].classList.remove("mefocused");
		$('.desc').removeClass('mefocused');
	}
	if(guestid.id == "su"){
		document.getElementById(guestid.id).classList.add("mefocused");
	}else{
		document.getElementById(guestid.id).classList.add("mefocused");
	}
	
	document.getElementById("guestidd").value= guestid.id;
	$('#msssgs').empty();
	changeMstatus($(".mefocused").index());
	var msssfrom = "";
	if(guestid.id == "su"){
		msssfrom = "superadmin";
	}else{
		msssfrom = "guest";
	}
	$.ajax({
		type:"POST",
		url:"controller/ChatController.php",
		data: {
			action: "Get Messages",
			guestid: guestid.id,
			hotelid: getHotelID(),
			msgfrom: msssfrom,
			msgto: "admin"
		},
		success: function(data) {
			var msg_array_obj = JSON.parse(data);
			for(var i = 0; i < msg_array_obj.length; i++){
				var msg = msg_array_obj[i];
				var side = "";
				if(msg.msg_from == "admin"){
					side = "right";
				}else{
					side = "left";
				}
				sendMessage(msg.msg, side, msg.created_at);
				$('.messages').animate({ scrollTop: $('.messages').prop('scrollHeight') },300);
			}
		}
	});
	
	
};

function changeMstatus(index){
	$("span[name='chat_count[]']").eq(index).addClass('visible-me');
	var guest_id = $(".mefocused").attr('id');
	var msssgfrom = "";
	if(guest_id == "su"){
		msssgfrom = "superadmin";
	}else{
		msssgfrom = "guest";
	}
	$.ajax({
		type:"POST",
		url:"controller/ChatController.php",
		data:{
			action: "Change Status",
			guestid: guest_id,
			hotelid: getHotelID(),
			msgfrom: msssgfrom,
			msgto: "admin"
		},
		success: function(data){
		}
	});
	
};