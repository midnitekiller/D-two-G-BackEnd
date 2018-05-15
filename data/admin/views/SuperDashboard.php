<?php 
      include("model/AdminDashboardClass.php");;
      $dashboard_db = new AdminDashboard();
      $hotel_lists = $dashboard_db->fetchViewAllHotel();
      $channel_lists = $dashboard_db->fetchViewAllChannels();
      $device_lists = $dashboard_db->fetchViewAllDevice();
      $feedback_lists = $dashboard_db->fetchViewAllFeedback();
      $nearby_lists = $dashboard_db->fetchPlaceNearby();
?>

<style>
.grey {
    background-color: rgba(103, 106, 108, 0.42)!important;
}

.tag {
    display: inline-block;
    padding: .25em .4em;
    font-size: 80%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
  
    width:19px;
}
</style>

<?php foreach ($hotel_lists as $hotel_list): ?>
<div class="col-md-3">
    <a class="info-tiles tiles-grape has-footer " href="#" >
        <div class="tiles-heading ibox-title" >
            <div class="pull-left">Hotel App Users</div>
            <div class="pull-right">
                <i class="fa fa-building-o fa-2x" aria-hidden="true"></i>      
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?php echo $hotel_list['hotel_ID'];?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<?php endforeach ?>
<?php foreach ($nearby_lists as $nearby_list): ?>
<div class="col-md-3">
    <a class="info-tiles tiles-indigo has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Places Nearby</div>
            <div class="pull-right">
                <i class="fa fa-industry fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?php echo $nearby_list['company'];?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<?php endforeach ?>
<div class="col-md-3">
    <a class="info-tiles tiles-blue has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Hotel Message</div>
            <div class="pull-right">
                 <i class="fa fa-envelope fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center">0</div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="info-tiles tiles-midnightblue has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Notification</div>
            <div class="pull-right">
                <i class="fa fa-bell fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center">0</div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="info-tiles tiles-info has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Channels</div>
            <div class="pull-right">
                <i class="fa fa-tv fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <?php foreach ($channel_lists as $channel_list): ?>
            <div class=""><h5>&nbsp;&nbsp;<?php echo $channel_list['hotel_name'];?> <span class="col-lg-1 tag grey"> <?php echo $channel_list['channel'];?></span></h5></div>
            <?php endforeach ?>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="info-tiles tiles-green has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Devices</div>
            <div class="pull-right">
                 <i class="fa fa-tablet fa-2x" aria-hidden="true"></i>  
            </div>
        </div>
        <div class="tiles-body">
            <?php foreach ($device_lists as $device_list): ?>
            <div class=""><h5>&nbsp;&nbsp;<?php echo $device_list['hotel_name'];?> <span class="col-lg-1 tag grey"> <?php echo $device_list['device'];?></span></h5></div>
            <?php endforeach ?>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="info-tiles tiles-inverse has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Feedback</div>
            <div class="pull-right">
                <i class="fa fa-star-o icon-notif fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <?php foreach ($feedback_lists as $feedback_list): ?>
                <div class=""><h5>&nbsp;&nbsp;<?php echo $feedback_list['hotel_name'];?> <span class="col-lg-1 tag grey"><?php echo $feedback_list['feedback'];?></span></h5></div>
            <?php endforeach ?>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
