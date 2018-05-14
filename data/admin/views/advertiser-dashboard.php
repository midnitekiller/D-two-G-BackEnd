<!--
|===========================================================================
|======================DISPLAYING DATA INTO RESTAURANT======================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-green has-footer" href="#">
        <div class="tiles-heading ibox-title">
            <div class="pull-left">LIVE PLACES NEARBY</div>
            <div class="pull-right">
                 <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>  
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$live;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
<!--
|===========================================================================
|======================DISPLAYING DATA INTO VIEW GUESTS=====================
|===========================================================================
-->
<div class="col-md-3">
    <a class="info-tiles tiles-grape has-footer" href="#" >
        <div class="tiles-heading ibox-title">
            <div class="pull-left">EXPIRED PLACES NEARBY</div>
            <div class="pull-right">
                <i class="fa fa-close fa-2x" aria-hidden="true"></i>      
            </div>
        </div>
        <div class="tiles-body">
            <div class="text-center"><?=$expired;?></div>
        </div>
        <div class="tiles-footer">
        </div>
    </a>
</div>
