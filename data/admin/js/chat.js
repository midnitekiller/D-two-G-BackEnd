(function () {
    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($('.message_template').clone().html());
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $('.messages').append($message);
                return setTimeout(function () {
                    return $message.addClass('appeared');
                }, 0);
            };
        }(this);
        return this;
    };
    $(function () {
        var getMessageText, message_side, sendMessage, loadChat;
        message_side = 'right';
		
        getMessageText = function () {
            var $message_input;
            $message_input = $('.message_inputs');
            return $message_input.val();
        };
		
		getHotelID = function () {
			var $hotelid;
			$hotelid = $('#hotelidd');
			return $hotelid.val();
		};
        sendMessage = function (text, side) {
            var $messages, message;
            if (text.trim() === '') {
                return;
            }
			
            $('.message_inputs').val('');
            $messages = $('.messages');
            message_side = side;
            message = new Message({
                text: text,
                message_side: message_side
            });
            message.draw();
            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
        };
        $('.send_message').click(function (e) {
			$.ajax({
                type:"POST",
                url:"controller/ChatController.php",
                data: {
					action: 'Send Message',
					msg: getMessageText(),
					hotel_id: getHotelID
				},
                success: function(data) {
                    if(data) {
						return sendMessage(getMessageText(),'right');
					}else {
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Message not sent.</div>");
						$('#popalert').show();
						console.log(data);
					}
                    
                }
            });
            
        });
		
        $('.message_inputs').keyup(function (e) {
            if (e.which === 13) {
                $.ajax({
					type:"POST",
					url:"controller/ChatController.php",
					data: {
						action: 'Send Message',
						msg: getMessageText(),
						hotel_id: getHotelID
					},
					success: function(data) {
						if(data) {
							return sendMessage(getMessageText(),'right');
						}else {
							$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Message not sent.</div>");
							$('#popalert').show();
							console.log(data);
						}
						
					}
				});
            }
        });
        /*sendMessage('Hello Joe! :)','left');
        setTimeout(function () {
            return sendMessage('Hi stef! How are you?','right');
        }, 1000);
        return setTimeout(function () {
            return sendMessage('I\'m fine, thank you!','left');
        }, 2000);*/
		
		
    });
	
}.call(this));

function loadChat (hotelid) {
			var desc = document.getElementsByClassName("desc");
			for(var i =0; i < desc.length; i++){
				desc[i].style.background = "#ffffff";
			}
			document.getElementById(hotelid.id).setAttribute("style", "background-color:rgba(0, 196, 255, 0.21)");
			
			document.getElementById("hotelidd").value= hotelid.id;
			$('#msssgs').empty();
			$.ajax({
				type:"POST",
				url:"controller/ChatController.php",
				data: {
					action: "Get Messages",
					hotelid: hotelid.id,
					msgfrom: "superadmin",
					msgto: "admin"
				},
				success: function(data) {
					var msg_array_obj = JSON.parse(data);
					for(var i = 0; i < msg_array_obj.length; i++){
						var msg = msg_array_obj[i];
						var side = "";
						if(msg.msg_from == "superadmin"){
							side = "right";
						}else{
							side = "left";
						}
						return sendMessage(msg.msg,side);
					}
				}
			});
			
		};