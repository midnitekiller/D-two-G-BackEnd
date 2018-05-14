function openNav() {
    document.getElementById("mySidenav").style.width = "260px";
	//closeNav1();
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    //document.getElementById("close").style.width = "0";
}

/*function openNav1() {
    document.getElementById("mySidenav1").style.width = "260px";
	closeNav();
	
}
function closeNav1() {
    document.getElementById("mySidenav1").style.width = "0";
    document.getElementById("close").style.width = "0";
}*/

$(document).ready(function(){
    $('#message').on('click',function(){
        $('#mySidenav').show();
        //$('#mySidenav1').hide();
    }); 
    $('#notification').on('click', function(){
        $('#mySidenav1').show();
        $('#mySidenav').hide();
    });
	
});

function openChat(e){
	var Hid = e.id;
	Hid = Hid.split("-");
	$.ajax({
		type:"POST",
		url:"controller/ChatController.php",
		data:{
			action: "Change Status",
			hotelid: Hid[1],
			msgfrom: "admin",
			msgto: "superadmin"
		},
		success: function(data){
			window.location.href = "adminchatroom.php?hotel_ID="+Hid[1];
		}
	});
	
}

function loadChatGuest(e){
	var id = e.id;
	id = id.split("-");
	var hotel_id = $('#abs'+id).val();
	var msfrom = "";
	if(id[1] == "su"){
		msfrom = "superadmin";
	}else{
		msfrom = "guest";
	}
	
	$.ajax({
		type:"POST",
		url:"controller/ChatController.php",
		data:{
			action: "Change Status",
			guestid: id[1],
			hotelid: hotel_id,
			msgfrom: msfrom,
			msgto: "admin"
		},
		success: function(data){
			if(id[1] == "su"){
				window.location.href = "chatroom.php?usertype="+id[1];
			}else{
				window.location.href = "chatroom.php?guest_ID="+id[1];
			}
		}
	});
}

