<?php 
      include("model/ChannelClass.php");;
      $channel_db = new Channels();
      $channel_lists = $channel_db->getChannelAdmin($hotelid);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>LIVE TV CHANNEL</h2>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content"> 
                <table id="#StaffListTable" class="table dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Channel Logo</th>
                            <th class="text-center">Channel Name</th>
                            <th class="text-center">Date Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($channel_lists as $channel_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $channel_list['channel_ID'];?></td>
                            <td class="text-center"><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $channel_list['hotel_name']);?>/channel/<?=$channel_list['channel_logo'];?>" class="center-block" width="50" height="50"></td>
                            <td class="text-center"><?php echo $channel_list['channel_name'];?></td>
                            <td class="text-center"><?php echo $channel_list['created_at'];?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include'views/script-foot.php' ?>
 