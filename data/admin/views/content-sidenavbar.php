<?php 	$sz = basename($_SERVER['PHP_SELF'],".php"); 
		$ars = array('SuperDashboard' => 'Dashboard','hotelSelection' => 'Hotel App Users List', 'addHotel' => 'Add Hotel App', 'hotelupdate' => 'Hotel Update', 'authorizedaccessall' => 'Authorized Access', 'devicelist' => 'All Device', 'editdevice' => 'Update Device', 'displaynearby' => 'Places Nearby List', 'addnearby' => 'Add Places Nearby', 'editad' => 'Update Places Nearby', 'adminchatroom' => 'Chat Room', 'report-allfeedback' => 'Guests Feedback', 'channelall' => 'Live TV Channels', 'channelupdate' => 'Update Channel', 'application-update' => 'Application Update', 'report-allhotel' => 'Report All Hotel');

		$sar = array('Hotel App Users', 'Manage Devices', 'Manage Places Nearby', 'Communications', 'Feedbacks', 'Channels', 'Application Update', 'Reports');
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
                        <img src="media/d2g.png" class="img-responsive" alt="">
                        <label style="color:#fff;">D2G APP</label>
                    </div>
                </div>
                <div class="navi">
                     <ul id="accordion" class="accordion">
                        <li><div class="link actives <?=($sz=="SuperDashboard")? "actives":"";?>" id="superdashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</div></li>
                        <li class="<?=($sz=="hotelSelection" || $sz=="addHotel")? "open":"";?>">
                            <div class="link"><i class="fa fa-building-o"></i>Hotel App Users<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="hotelSelection" || $sz=="addHotel" || $sz=="hotelupdate" || $sz=="authorizedaccessall")? "block;":"none;";?>">
                                <li class="<?=($sz=="hotelSelection" || $sz=="hotelupdate" || $sz=="authorizedaccessall")? "actives":"";?>"><a id="hotelselection">Hotel App Users List</a></li>
                                <li class="<?=($sz=="addHotel")? "actives":"";?>"><a id="addhotel">Add Hotel App User</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="devicelist")? "open":"";?>">
                            <div class="link"><i class="fa fa-tablet"></i>Manage Devices<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="devicelist" || $sz=="editdevice")? "block;":"none;";?>">
                                <li class="<?=($sz=="devicelist" || $sz=="editdevice")? "actives":"";?>"><a id="devicelist">Devices List</a></li>
                                <li><a id="device-modal">Add Device</a></li>
                            </ul>
                        </li> 
                        <li class="<?=($sz=="displaynearby" || $sz=="addnearby")? "open":"";?>">
                            <div class="link"><i class="fa fa-street-view"></i>Manage Places Nearby<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="displaynearby" || $sz=="addnearby" || $sz=="editad")? "block;":"none;";?>">
                                <li class="<?=($sz=="displaynearby" || $sz=="editad")? "actives":"";?>"><a id="displaynearby">Places Nearby List</a></li>
                                <li class="<?=($sz=="addnearby")? "actives":"";?>"><a id="addnearby">Add Places Nearby</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="adminchatroom")? "actives":"";?>"><div class="link" id="chatadmin"><i class="fa fa-bell-o icon-notif"><span id="notif_msg_nav" class="label label-primary <?=(count($chatcount) == 0)?"visible-me":"";?>"><?=count($chatcount);?></span></i>Communications</div></li>
                        <li class="<?=($sz=="report-allfeedback")? "actives":"";?>"><div class="link" id="allreport-feedback"><i class="fa fa-star-o icon-notif"></i>Feedbacks</div></li>
                        <li class="<?=($sz=="channelall" || $sz=="channelupdate")? "actives":"";?>"><div class="link" id="channelall"><i  class="fa fa-television"></i>Channels</div></li>
                        <li class="<?=($sz=="application-update")? "actives":"";?>"><div class="link" id="application-update"><i class="fa fa-laptop"></i>Application Update</div></li>
                        <li class="<?=($sz=="report-allhotel")? "open":"";?>">
                            <div class="link"><i href="#" class="fa fa-newspaper-o fa-fw"></i>Reports<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="report-allhotel")? "block;":"none;";?>">
                                <li class="<?=($sz=="report-allhotel")? "actives":"";?>"><a id="allreport-hotel">Hotel Reports</a></li>
                            </ul>
                        </li>
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
                                        <a href="SuperDashboard.php"><i class="fa fa-dashboard fa-2x"></i></a>
                                        <a style="display: <?=($sz=="housekeeping" || $sz=="chatroom" || $sz=="feedback" || $sz=="channel" || $sz=="SuperDashboard")? "none;":"block;";?>" href="#">
										<?php
											if($sz=="housekeeping" || $sz=="chatroom" || $sz=="feedback" || $sz=="channel" || $sz=="SuperDashboard"){
												echo $ars[$sz];
											}elseif($sz=="hotelSelection" || $sz=="addHotel" || $sz=="hotelupdate" || $sz=="authorizedaccessall"){
												echo $sar[0];
											}elseif($sz=="devicelist" || $sz=="editdevice"){
												echo $sar[1];
											}elseif($sz=="displaynearby" || $sz=="addnearby" || $sz=="editad"){
												echo $sar[2];
											}elseif($sz=="adminchatroom"){
												echo $sar[3];
											}elseif($sz=="report-allfeedback"){
												echo $sar[4];
											}elseif($sz=="channelall" || $sz=="channelupdate"){
												echo $sar[5];
											}elseif($sz=="application-update"){
												echo $sar[6];
											}elseif($sz=="report-allhotel"){
												echo $sar[7];
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
                                    <li>
                                        <a href="#" class="icon-info" onclick="openNav()" data-toggle="tooltip" title="Message" data-placement="bottom">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <span id="notif_msg_nav2" class="label label-primary <?=(count($chatcount) == 0)?"visible-me":"";?>"><?=count($chatcount);?></span>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="#" class="icon-info" onclick="openNav1()" data-toggle="tooltip" title="Notification" data-placement="bottom">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">0</span>
                                        </a>
                                    </li>-->
                                    <li><a id="profile"><i class="fa fa-user-o" aria-hidden="true"></i> <?=$name;?></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
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
										<?php foreach($messages as $key => $msg): ?>
										<div class="desc2" id="z-<?=$msg['hotel_ID'];?>" name="hotel_contactss[]" onclick="openChat(this);">
											<div style="float:left;margin-right:10px;margin-left:7px;margin-top:7px;">
												<img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $msg['hotel_name']);?>/logo/<?=$msg['hotel_image'];?>" class="img-responsive" alt="" style="height: 60px;width: auto;border-radius: 10px;background: rgba(210, 210, 210, 0.55);">
												<input type="hidden" id="abs<?=$msg['hotel_ID'];?>" value="<?=$msg['hotel_name'];?>">
											</div>
											<div>
												<p>
													<br/><a href="#"><?=$msg['hotel_name'];?></a><span value="<?=$msg[7];?>" class="badge-me2"><?=$msg['max_count'];?></span><p class="ellipsis"><?=$msg['msg'];?></p>
												</p>
											</div>
										</div>
										<?php endforeach; ?>
									</div> 
								</ul>
							</div> 
<!-- NOTIFICATION BAR -->
							<div id="mySidenav1" class="sidenav">
							  <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">&times;</a>
								<ul class="">
									<div class=" ds">
										<div class="title-notifys"><h3>NOTIFICATIONS</h3></div>
										  <div class="desc">
											<div class="thumb">
												<i class="fa fa-clock-o fa-2x"></i>
											</div>
											<div class="details">
												<p><muted>2 Minutes Ago</muted><br/>
												   <a href="#">lebron Joe</a> purchased a coffee.<br/>
												</p>
											</div>
										  </div>
										  <div class="desc">
											<div class="thumb">
												<i class="fa fa-clock-o fa-2x"></i>
											</div>
											<div class="details">
												<p><muted>3 Hours Ago</muted><br/>
												   <a href="#">Lester lorem</a> purchased a year subscription.<br/>
												</p>
											</div>
										  </div>
										  <div class="desc">
											<div class="thumb">
												<i class="fa fa-clock-o fa-2x"></i>
											</div>
											<div class="details">
												<p><muted>7 Hours Ago</muted><br/>
												   <a href="#">Jhona Lorem</a> rent a car on your services.<br/>
												</p>
											</div>
										  </div>
										  <div class="desc">
											<div class="thumb">
												<i class="fa fa-clock-o fa-2x"></i>
											</div>
											<div class="details">
												<p><muted>11 Hours Ago</muted><br/>
												   <a href="#">Ranz Lorem</a> purchased a drink in your store.<br/>
												</p>
											</div>
										  </div>
										  <div class="desc">
											<div class="thumb">
												<i class="fa fa-clock-o fa-2x"></i>
											</div>
											<div class="details">
												<p><muted>18 Hours Ago</muted><br/>
												   <a href="#">Sean Lazenby</a> purchased a drink in your store.<br/>
												</p>
											</div>
										  </div>
									</div>
								</ul>
							</div>                  
<script>
var nav_message_count = 0;
var nav_all_chat_count = 0;
var pagename = "<?=$sz;?>";
$(document).ready(function(){
	nav_message_count = "<?=count($messages);?>";
	nav_all_chat_count = "<?=count($chatcount);?>";
	setInterval(loadUpcomingMessage, 5000);
});
var messagetone = $('#message_tone');
					
function loadUpcomingMessage(){
	if(pagename != "adminchatroom"){
		$.ajax({
			type: "POST",
			url: "controller/ChatController.php",
			data: {
				action: 'Refresh Nav Message',
				msgto: 'superadmin'
			},success: function(data){
				var obj = JSON.parse(data);
				if(obj.length > nav_message_count){
					var latest_msg = obj[0];
					var msg_div = "<div class=\"desc2\" id=\"z-"+ latest_msg.hotel_ID +"\" name=\"hotel_contactss[]\" onclick=\"openChat(this);\"><div style=\"float:left;margin-right:10px;margin-left:7px;margin-top:7px;\"><img src=\"media/images/"+ latest_msg.hot_name +"/logo/"+latest_msg.hotel_image+"\" class=\"img-responsive\" alt=\"\" style=\"height: 60px;width: auto;border-radius: 10px;background: rgba(210, 210, 210, 0.55);\"><input type=\"hidden\" id=\"abs"+ latest_msg.hotel_ID +"\" value=\""+ latest_msg.hotel_name +"\"></div><div><p><br/><a href=\"#\">"+ latest_msg.hotel_name +"</a><span value=\""+ latest_msg.mssg +"\" class=\"badge-me2\">"+ latest_msg.max_count+"</span><p class=\"ellipsis\">"+latest_msg.msg+"</p></p></div></div>";
					$('.ds2').prepend(msg_div);
					nav_message_count = obj.length;
				}
			}
		});
		
		$.ajax({
			type: "POST",
			url: "controller/ChatController.php",
			data: {
				action: 'Refresh Unseen Count',
				msgfrom: 'admin',
				msgto: 'superadmin'
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
}
</script>							
<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="js/notify.js"></script>