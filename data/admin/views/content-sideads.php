<?php include 'hotel-writeup.php';?>
<?php 	$sz = basename($_SERVER['PHP_SELF'],".php"); 
		$ars = array('advertiser-dashboard' => 'Dashboard', 'advertiser-ads' => 'Manage Ads', 'editadvertisement' => 'Update Places Nearby', 'advertiser-live' => 'Live Preview');

		$sar = array('Dashboard' , 'Manage Ads', 'Live Preview');
?>
<body class="home">
<audio id="message_tone" type="hidden">
<source src="/media/notification/message.mp3"></source>
</audio>
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-3h hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <div class="logo_hotel">
                        <img src="../media/d2g.png" class="img-responsive">
                        <label style="color:#fff;">D2G APP</label>
                    </div>
                </div>
                <div class="navi">
                     <ul id="accordion" class="accordion">
                        <li class="<?=($sz=="advertiser-dashboard")? "actives":"";?>"><div class="link" id="advertiser_dashboard"  ><i class="fa fa-dashboard"></i>Dashboard</div></li>
                        <li class="<?=($sz=="advertiser-ads")? "actives":"";?>"><div class="link" id="advertiser_ads"  ><i class="fa fa-street-view"></i>Manage Ads</div></li>
                        <!--<li class="<//?=($sz=="advertiser-live")? "actives":"";?>"><div class="link" id="advertiser_live"  ><i class="fa fa-sticky-note-o"></i>Live Preview</div></li>-->
                        <!--<li class="<//?=($sz=="advertiser-chat")? "actives":"";?>"><div id="advertiser_chat" class="link"><i class="fa fa-bell-o icon-notif"><span id="notif_msg_nav" class="label label-primary <//?=(count($gcount) == 0)? "visible-me":"";?>"><//?=count($gcount);?></span></i>Communications</div></li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-sm-11 display-table-cell v-align">
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <div class="myBreadcrumb">
                                        <a href="#"><i class="fa fa-dashboard fa-2x"></i></a>
                                        <a style="display: <?=($sz=="advertiser-dashboard" || $sz=="advertiser-ads" || $sz=="editadvertisement" || $sz=="advertiser-live")? "none;":"block;";?>" href="#">
										<?php
											if($sz=="advertiser-dashboard" || $sz=="advertiser-ads" || $sz=="editadvertisement" || $sz=="advertiser-live"){
												echo $ars[$sz];
											}else{
												echo $sar[0];
                                            }
										?>
										</a>
                                        <a href="#"><?=$ars[$sz];?></a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-5">
                           <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <!--<li>
                                        <a href="#" class="icon-info" onclick="openNav()" data-toggle="tooltip" title="Message" id="message" data-placement="bottom">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <span id="notif_msg_nav2" class="label label-primary<?//=(count($gcount) == 0)? "visible-me":"";?>"><?//=count($gcount);?></span>
                                        </a>
                                    </li>-->
                                    <li><a id="profile"><i class="fa fa-user-o" aria-hidden="true"></i> <?=$name;?> </a></li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Settings <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                        <li><a id="setting_profile">Profile Management</a></li>
                                        <li><a id="changepassword">Change Password</a></li>
                                      </ul>
                                    </li>
                                    <li><a href="index.php?logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Log-out</a></li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                            <div class="row  dashboard-header">
                            <!--- MESSAGES NOTIFICATION -->                               
							<div id="mySidenav" class="sidenav">
							  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
								<div class="title_message"><h3>MESSAGES</h3></div>
								<ul class="">
									<div class="ds2">
										<?php foreach($guestnav as $key => $gui): ?>
										
											<div class="desc2" id="z-<?=$gui['id'];?>" name="guests_contacts[]" onclick="loadChatGuest(this);" >
											<div style="float:left;margin-right:10px;margin-left:5px;margin-top:13px;">
												<span name="guest_icon" class="fa fa-user-circle-o fa-3x guest_icon"></span>
												<input type="hidden" id="abs<?=$gui['id'];?>" value="<?=$gui['hotel_ID'];?>">
											</div>
											<div>
												<p>
													<br/><a href="#"><small><b><?=$gui['name'];?></b></small></a><span value="<?=$gui['max_count'];?>" class="badge-me2 <?=($gui['max_count'] == 0)? "visible-me":"";?>"><?=$gui['max_count'];?></span><p class="ellipsis"><?=$gui['msg'];?></p>
												</p>
											</div>
										</div>
										<?php endforeach; ?>
									</div> 
								</ul>
							</div> 
      
<script>
var nav_message_count = 0;
var nav_all_chat_count = 0;
var hotelidd = 0;

$(document).ready(function(){
	nav_message_count = "<?=count($guestnav);?>";
	nav_all_chat_count = "<?=count($gcount);?>";
	setInterval(loadUpcomingMessage, 5000);
	hotelidd = "<?=$hotelid;?>";
	console.log(window.location.pathname);
});
var messagetone = $('#message_tone');
					
function loadUpcomingMessage(){
	
	$.ajax({
		type: "POST",
		url: "controller/ChatController.php",
		data: {
			action: 'Refresh Nav Message Guest',
			msgto: 'admin',
			hotelid: hotelidd
		},success: function(data){
			var obj = JSON.parse(data);
			if(obj.length > nav_message_count){
				var latest_msg = obj[0];
				var msg_div = "<div class=\"ds2\"><div class=\"desc2\" id=\"z-"+latest_msg.id+"\" name=\"guests_contacts[]\" onclick=\"loadChatGuest(this);\" ><div style=\"float:left;margin-right:10px;margin-left:5px;margin-top:13px;\"><span name=\"guest_icon\" class=\"fa fa-user-circle-o fa-3x guest_icon\"></span><input type=\"hidden\" id=\"abs"+latest_msg.id+"\" value=\""+latest_msg.hotel_ID+"\"></div><div><p><br/><a href=\"#\"><small><b>"+latest_msg.name+"</b></small></a><span value=\""+latest_msg.max_count+"\" class=\"badge-me2\">"+latest_msg.max_count+"</span><p class=\"ellipsis\">"+latest_msg.msg+"</p></p></div></div>";
				$('.ds2').prepend(msg_div);
				nav_message_count = obj.length;
				console.log(obj.length +" > "+nav_message_count); 
			}else{
				console.log(obj.length +" < "+nav_message_count);
			}
		}
	});
	
	$.ajax({
		type: "POST",
		url: "controller/ChatController.php",
		data: {
			action: 'Refresh Unseen Guest Count',
			msgto: 'admin',
			hotelid: hotelidd
		}, success: function(data){	
			var obj = JSON.parse(data);
			if(obj.length > nav_all_chat_count){
				$('#notif_msg_nav').removeClass('visible-me');
				$('#notif_msg_nav2').removeClass('visible-me');
				$('#notif_msg_nav').text(obj.length);
				$('#notif_msg_nav2').text(obj.length);
				messagetone[0].play();
				nav_all_chat_count = obj.length;
			}else if(obj.length < nav_all_chat_count){
				$('#notif_msg_nav').text(obj.length);
				$('#notif_msg_nav2').text(obj.length);
				nav_all_chat_count = obj.length;
			}
		}
	});
}

</script>							
<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="js/notify.js"></script>