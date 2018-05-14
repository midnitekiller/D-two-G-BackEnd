<?php 	
	session_start();
	include 'model/NotifClass.php';
	include_once 'model/StaffClass.php';
	$sta = new Staff();
	$sz = basename($_SERVER['PHP_SELF'],".php"); 
	$ars = array('amenities' => 'Amenities', 'update-hotel_amenities' => 'Update Hotel Amenities', 'authorizedaccess' => 'Authorized Access', 'updatehotelphoto' => 'Hotel Profile', 'addguests' => 'Add Guests', 'displayguests' => 'View Guests', 'update-guests' => 'Update Guest', 'restaurant' => 'Restaurants', 'update-restaurant' => 'Update Restaurant', 'menus' => 'Menus', 'services' => 'Services', 'update-services' => 'Update Services','services_detail' => 'Services Detail', 'update-servicesdetail' => 'Update Services Detail', 'offers' => 'Offers', 'update-offer' => 'Update Offer', 'offer_detail' => 'Offers Detail', 'update-offerdetails' => 'Update Offer Detail', 'order-guests' => 'Restaurant Order', 'view-order' =>  'Restaurant Order Detail', 'order-service' => 'Services Order', 'view-orderService' => 'Services Order Detail', 'housekeeping' => 'Housekeeping', 'main' => 'Dashboard', 'chatroom' => 'Communications', 'feedback' => 'Feedbacks', 'channel' => 'Channels', 'android' => 'TV Application', 'addStaff' => 'New Staff', 'viewStaff' => 'Manage Staffs', 'update-staff' => 'Update Staff', 'report-dining' => 'In-Room Dining Report', 'report-hotel' => 'Hotel Reports', 'report-services' => 'Services Report', 'report-feedback' => 'Feedback Report', 'faq' => 'FAQ', 'update-faq' => 'Update Frequently Asked Question', 'channelad' => 'Channel Ads', 'update-channelad' => 'Update Channel Ad');

	$sar = array('About the Hotel' , 'Guests List', 'In-Room Dining', 'Hotel Services', 'Hotel Offers', 'Guests Order', 'Staff Profile', 'Reports', 'Others');
	if(!empty($_SESSION['staff_id'])){
		$staffid = $_SESSION['staff_id'];
		$about = $sta->getAboutHotel($staffid);
		$dining = $sta->getRoomDining($staffid);
		$frontdesk = $sta->getFrontDesk($staffid);
		$services = $sta->getServices($staffid);
		$offers = $sta->getOffers($staffid);
		$staff = $sta->getStaff($staffid);
		$housekeeping = $sta->getHousekeeping($staffid);
		$feedbacks = $sta->getFeedbacks($staffid);
		$channels = $sta->getChannels($staffid);
		$android = $sta->getAndroid($staffid);
		$pos = $sta->getPOS($staffid);
		$orderhistory = $sta->getOrderHistory($staffid);
		$reports = $sta->getReports($staffid);
		$others = $sta->getOthers($staffid);
	}else{
		$about = "admin";
		$dining = "admin";
		$frontdesk = "admin";
		$services = "admin";
		$offers = "admin";
		$staff = "admin";
		$housekeeping = "admin";
		$feedbacks = "admin";
		$channels = "admin";
		$channels = "admin";
		$pos = "admin";
		$orderhistory = "admin";
		$reports = "admin";
		$others = "admin";
	}
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
                        <img src="media/images/<?=preg_replace("/[^a-zA-Z]+/","",$hotelname);?>/logo/<?=$hotel_logo;?>" class="img-responsive">
                        <label style="color:#fff;"><?=$hotelname;?></label>
                    </div>
                </div>
                <div class="navi">
                     <ul id="accordion" class="accordion">
                        <li><div class="link actives <?=($sz=="main")? "actives":"";?>" id="dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</div></li>
                        <li class="<?=($sz=="amenities" || $sz=="authorizedaccess" || $sz=="updatehotelphoto")? "open":"";?> <?=($about == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-building-o"></i>About The Hotel<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="amenities" || $sz=="update-hotel_amenities" || $sz=="authorizedaccess" || $sz=="updatehotelphoto")? "block;":"none;";?>">
                                <li><a id="write">Hotel Write Up</a></li>
                                <li class="<?=($sz=="amenities" || $sz=="update-hotel_amenities")? "actives":"";?>"><a id="amenities">Amenities</a></li>
                                <li class="<?=($sz=="authorizedaccess")? "actives":"";?>"><a id="access">Authorized Access</a></li>
                                <!--<li class="<?//=($sz=="updatehotelphoto")? "actives":"";?>"><a id="updatehotelphoto">Hotel Profile</a></li>-->
                            </ul>
                        </li>
                        <li class="<?=($sz=="addguests" || $sz=="displayguests")? "open":"";?> <?=($frontdesk == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-cutlery"></i>Guests List<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="addguests" || $sz=="displayguests" || $sz=="update-guests")? "block;":"none;";?>">
                                <li class="<?=($sz=="addguests")? "actives":"";?>"><a id="addguests">Add Guest</a></li>
                                <li class="<?=($sz=="displayguests" || $sz=="update-guests" )? "actives":"";?>"><a id="displayguests">View Guests</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="restaurant" || $sz=="menus")? "open":"";?> <?=($dining == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-cutlery"></i>In-Room Dining<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="restaurant" || $sz=="menus" || $sz=="update-restaurant")? "block;":"none;";?>">
                                <li class="<?=($sz=="restaurant" || $sz=="update-restaurant")? "actives":"";?>"><a id="restaurant">Restaurants</a></li>
                                <li class="<?=($sz=="menus")? "actives":"";?>"><a id="menus">Menu</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="services" || $sz=="services_detail")? "open":"";?> <?=($services == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-bus"></i>Hotel Services<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="services" || $sz=="update-services" || $sz=="services_detail" || $sz=="update-servicesdetail")? "block;":"none;";?>">
                                <li class="<?=($sz=="services" || $sz=="update-services")? "actives":"";?>"><a id="services">Services</a></li>
                                <li class="<?=($sz=="services_detail" || $sz=="update-servicesdetail")? "actives":"";?>"><a id="services_details">Services Detail</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="offers" || $sz=="offer_detail")? "open":"";?> <?=($offers == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-tasks"></i>Hotel Offers<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="offers" || $sz=="offer_detail" || $sz=="update-offer" || $sz=="update-offerdetails" )? "block;":"none;";?>">
                                <li class="<?=($sz=="offers" || $sz=="update-offer")? "actives":"";?>"><a id="offers">Offers</a></li>
                                <li class="<?=($sz=="offer_detail" || $sz=="update-offerdetails" )? "actives":"";?>"><a id="offers_details">Offers Detail</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="order-guests" || $sz=="order-service")? "open":"";?> <?=($orderhistory == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-shopping-cart icon-notif"><span id="foods_services_counts" class="label label-primary visible-me">0</span></i>Guests Order<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="order-guests" || $sz=="order-service" || $sz=="view-order" || $sz=="view-orderService")? "block;":"none;";?>">
                                <li class="<?=($sz=="order-guests" || $sz=="view-order")? "actives":"";?>"><a id="r_order"><span id="foods_counts" class="visible-me" style="border-radius: 50%; font-size: 9px; left: 8px; top: -9px; background-color: #1ab394; color: #FFFFFF; padding: 2px 5px;">0</span>Restaurant Order</a></li>
                                <li class="<?=($sz=="order-service" || $sz=="view-orderService")? "actives":"";?>"><a id="s_order"><span id="services_counts" class="visible-me" style="border-radius: 50%; font-size: 9px; left: 8px; top: -9px; background-color: #1ab394; color: #FFFFFF; padding: 2px 5px;">0</span>Services Order</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="housekeeping")? "actives":"";?> <?=($housekeeping == "blank")? "hide-me-under":"show-me-up";?>"><div class="link" id="housekeeping"><i href="#" class="fa fa-bed icon-notif"><span id="housekeeping_counts" class="label label-primary visible-me">0</span></i>Housekeeping</div></li>
                        <li class="<?=($sz=="chatroom")? "actives":"";?> <?=($frontdesk == "blank")? "hide-me-under":"show-me-up";?>"><div class="link" id="chat" ><i class="fa fa-bell-o icon-notif"><span id="notif_msg_nav" class="label label-primary <?=(count($gcount) == 0)? "visible-me":"";?>"><?=count($gcount);?></span></i>Communications</div></li>
                        <li class="<?=($sz=="feedback")? "actives":"";?> <?=($feedbacks == "blank")? "hide-me-under":"show-me-up";?>"><div class="link" id="feedback"><i class="fa fa-star-o icon-notif"><span id="feedbacks_counts" class="label label-primary visible-me">0</span></i>Feedbacks</div></li>
                        <li class="<?=($sz=="channel")? "actives":"";?> <?=($channels == "blank")? "hide-me-under":"show-me-up";?>"><div class="link" id="channel"><i href="#" class="fa fa-television"></i>Channels</div></li>
						<!--<li class="<?//=($sz=="android")? "actives":"";?> <?//=($android == "blank")? "hide-me-under":"show-me-up";?>"><div class="link" id="android"><i href="#" class="fa fa-android"></i>TV Application</div></li>-->
                        <li class="<?=($sz=="addStaff" || $sz=="viewStaff")? "open":"";?> <?=($staff == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-user-o"></i>Staff Profile<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="addStaff" || $sz=="viewStaff" || $sz=="update-staff")? "block;":"none;";?>">
                                <li class="<?=($sz=="addStaff")? "actives":"";?>"><a id="addStaff">New Entry</a></li>
                                <li class="<?=($sz=="viewStaff" || $sz=="update-staff")? "actives":"";?>"><a id="viewStaff">Manage Existing</a></li>
                            </ul>
                        </li>
                        <li class=" <?=($pos == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i class="fa fa-desktop"></i>POS Config<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu">
                                <li><a id="pos menu">Sync POS Menu</a></li>
                            </ul>
                        </li>
                        <li class="<?=($sz=="report-dining" || $sz=="report-services" || $sz=="report-hotel" || $sz=="report-feedback")? "open":"";?> <?=($reports == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link"><i href="#" class="fa fa-newspaper-o fa-fw"></i>Reports<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="report-dining" || $sz=="report-services" || $sz=="report-hotel" || $sz=="report-feedback")? "block;":"none;";?>">
                                <li class="<?=($sz=="report-dining")? "actives":"";?>"><a id="report-dining">In-Room Dining</a></li>
                                <li class="<?=($sz=="report-services")? "actives":"";?>"><a id="report-services">Services</a></li>
                                <li class="<?=($sz=="report-feedback")? "actives":"";?>"><a id="report-feedback">Feedback</a></li>
                                <li class="<?=($sz=="report-hotel")? "actives":"";?>"><a id="report-hotel">Hotel Reports</a></li>
                            </ul>
                        </li>
                        <!--<li class="<?=($sz=="faq" || $sz=="update-faq" || $sz=="channelad" || $sz=="update-channelad")? "open":"";?> <?=($others == "blank")? "hide-me-under":"show-me-up";?>">
                            <div class="link" id="others"><i href="#" class="fa fa-question-circle-o"></i>Others<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu" style="display: <?=($sz=="faq" || $sz=="update-faq" || $sz=="channelad" || $sz=="update-channelad")? "block;":"none;";?>">
                                <li class="<?=($sz=="faq" || $sz=="update-faq")? "actives":"";?>"><a id="faq">FAQ</a></li>
                                <li class="<?=($sz=="channelad" || $sz=="update-channelad")? "actives":"";?>"><a id="channeladd">Channel Ads</a></li>
                            </ul>
                        </li>-->
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
                                        <a href="main.php"><i class="fa fa-dashboard fa-2x"></i></a>
                                        <a style="display: <?=($sz=="housekeeping" || $sz=="chatroom" || $sz=="feedback" || $sz=="channel" || $sz=="main")? "none;":"block;";?>" href="#">
										<?php
											if($sz=="housekeeping" || $sz=="chatroom" || $sz=="feedback" || $sz=="channel" || $sz=="main"){
												echo $ars[$sz];
											}elseif($sz=="amenities" || $sz=="update-hotel_amenities" || $sz=="authorizedaccess" || $sz=="updatehotelphoto"){
												echo $sar[0];
											}elseif($sz=="addguests" || $sz=="displayguests" || $sz=="update-guests"){
												echo $sar[1];
											}elseif($sz=="restaurant" || $sz=="menus" || $sz=="update-restaurant"){
												echo $sar[2];
											}elseif($sz=="services" || $sz=="services_detail" || $sz=="update-services" || $sz=="update-servicesdetail"){
												echo $sar[3];
											}elseif($sz=="offers" || $sz=="offer_detail" || $sz=="update-offer" || $sz=="update-offerdetails"){
												echo $sar[4];
											}elseif($sz=="order-guests" || $sz=="order-service" || $sz=="view-order" || $sz=="view-orderService"){
												echo $sar[5];
											
											}elseif($sz=="addStaff" || $sz=="viewStaff" || $sz=="update-staff"){
												echo $sar[6];
											}elseif($sz=="report-dining" || $sz=="report-services" || $sz=="report-hotel" || $sz=="report-feedback"){
												echo $sar[7];
											}elseif($sz=="faq" || $sz=="update-faq" || $sz=="channelad" || $sz=="update-channelad"){
												echo $sar[8];
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
                                        <a href="#" class="icon-info" onclick="openNav()" data-toggle="tooltip" title="Message" id="message" data-placement="bottom">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <span id="notif_msg_nav2" class="label label-primary <?=(count($gcount) == 0)? "visible-me":"";?>"><?=count($gcount);?></span>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="#" class="icon-info" onclick="openNav1()" data-toggle="tooltip" title="Notification" id="notification" data-placement="bottom">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">0</span>
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
var hotelidd = 0;
var pagename = "<?=$sz;?>";

$(document).ready(function(){
	nav_message_count = "<?=count($guestnav);?>";
	nav_all_chat_count = "<?=count($gcount);?>";
	setInterval(loadUpcomingMessage, 5000);
	setInterval(loadNotifications, 500);
	hotelidd = "<?=$hotelid;?>";
	console.log(window.location.pathname);
	
});
var messagetone = $('#message_tone');
					
function loadUpcomingMessage(){
	if(pagename != "chatroom"){
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
}

function loadNotifications(){
	$.ajax({
			type: "POST",
			url: "controller/NotificationsController.php",
			data: {
				action: 'Ajax Notifications',
				hotelid: hotelidd
			},success: function(data){
				var obj = JSON.parse(data);
				if(parseInt(obj.foods_count) == 0 && parseInt(obj.services_count) == 0){
					
					document.getElementById("services_counts").classList.add("visible-me");
					document.getElementById("foods_counts").classList.add("visible-me");
					document.getElementById("foods_services_counts").classList.add("visible-me");
					
					
				}else if(parseInt(obj.foods_count) != 0 && parseInt(obj.services_count) == 0){
					
					document.getElementById("services_counts").classList.add("visible-me");
					document.getElementById("foods_services_counts").classList.remove("visible-me");
					document.getElementById("foods_counts").classList.remove("visible-me");
					$("#foods_counts").text(obj.foods_count);
					$("#foods_services_counts").text(obj.foods_count);
					
				}else if(parseInt(obj.foods_count) == 0 && parseInt(obj.services_count) != 0){
					
					document.getElementById("foods_counts").classList.add("visible-me");
					document.getElementById("foods_services_counts").classList.remove("visible-me");
					document.getElementById("services_counts").classList.remove("visible-me");
					
					$("#services_counts").text(obj.services_count);
					$("#foods_services_counts").text(obj.services_count);
					
				}else{
					
					document.getElementById("foods_services_counts").classList.remove("visible-me");
					document.getElementById("foods_counts").classList.remove("visible-me");
					document.getElementById("services_counts").classList.remove("visible-me");
					
					$("#foods_counts").text(obj.foods_count);
					$("#services_counts").text(obj.services_count);
					var total = parseInt(obj.foods_count) + parseInt(obj.services_count);
					$("#foods_services_counts").text(total);
					
				}
				
				if(parseInt(obj.housekeeping_count) == 0){
					document.getElementById("housekeeping_counts").classList.add("visible-me");
				}else{
					document.getElementById("housekeeping_counts").classList.remove("visible-me");
					$("#housekeeping_counts").text(obj.housekeeping_count);
				}
				
				if(parseInt(obj.feedback_count) == 0){
					document.getElementById("feedbacks_counts").classList.add("visible-me");
				}else{
					document.getElementById("feedbacks_counts").classList.remove("visible-me");
					$("#feedbacks_counts").text(obj.feedback_count);
				}
				
			}
	});
}

</script>							
<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="js/notify.js"></script>