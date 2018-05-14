<!--
|===========================================================================
|======================DISPLAYING DATA INTO VIEW GUESTS=====================
|===========================================================================
-->
<div id="message"></div>
<div class="col-md-3">
    <a class="info-tiles tiles-grape has-footer" href="displayguests.php" >
        <div class="tiles-heading ibox-title">
            <div class="pull-left">View All Guests</div>
            <div class="pull-right">
                <i class="fa fa-tasks fa-2x" aria-hidden="true"></i>      
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$guests;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|======================DISPLAYING DATA INTO RESTAURANT======================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-green has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Restaurant Orders Today</div>
            <div class="pull-right">
                 <i class="fa fa-cutlery fa-2x" aria-hidden="true"></i>  
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$restaurant;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|====================DISPLAYING DATA INTO SERVICES ORDERS===================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-blue has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Service Orders Today</div>
            <div class="pull-right">
                 <i class="fa fa-envelope fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$service;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|=======================DISPLAYING DATA INTO BOOKINGS=======================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-midnightblue has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Bookings Today</div>
            <div class="pull-right">
                <i class="fa fa-calendar fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$booking;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|=======================DISPLAYING DATA INTO CHANNELS=======================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-info has-footer" href="channel.php">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">View All Channels</div>
            <div class="pull-right">
                <i class="fa fa-tv fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$channels;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|=====================DISPLAYING DATA INTO HOUSEKEEPING=====================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-indigo has-footer" href="housekeeping.php">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">View Housekeeping Today</div>
            <div class="pull-right">
                <i class="fa fa-bell fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$housekeeping;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|=======================DISPLAYING DATA INTO FEEDBACK=======================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-grape has-footer" href="feedback.php">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">View Feedbacks Today</div>
            <div class="pull-right">
                <i class="fa fa-star-o icon-notif fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$feedback;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|========================DISPLAYING DATA INTO STAFF=========================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-inverse has-footer" href="viewStaff.php">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">Staffs Enrolled</div>
            <div class="pull-right">
                <i class="fa fa-users icon-notif fa-2x" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$staff;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>