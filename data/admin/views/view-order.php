<?php 
      include("model/OrderClass.php");
      $order_ID = $_GET['id'];
      $order_db = new Order();
      $order_lists = $order_db->fetchViewOrder($order_ID);
      $total_lists = $order_db->fetchDataOrder($order_ID);
?>

<div id="mssg"></div><br/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-lg-10">
            <h2 style="padding-top:10px;">Guests Ordered Details</h2>
        </div>
        <div class="col-lg-2">
            <a href="order-guests.php" class="btn btn-info pull-center"  value="" type="submit" style="padding-top:10px;width:150px;">Back</a>
        </div>
    </div>
</div>

<div class="loginColumns animated fadeInDown" id="loginregistry">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="ibox-content shadow-box">
                <form id="confirmOrder" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_lists as $order_list): ?>
                                        <tr>
                                            <td class="col-md-8">
                                                <div class="media">
                                                    <div class="thumbnail pull-left fa fa-shopping-basket fa-5x"></div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading text-warning"><?php echo $order_list['menu_name'];?></h4>
                                                        <h5 class="media-heading"><?php echo $order_list['menu_shortDesc'];?></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><strong>₱<?php echo $order_list['menu_price'];?></strong></td>
                                            <td class="text-center"><strong><?php echo $order_list['quantity'];?></strong></td>
                                            <td class="text-center"><strong>₱<?php echo $order_list['subtotal'];?></strong></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <?php foreach ($total_lists as $total_list): ?>
                                        <tr>
                                            <td class="col-md-8">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Guest Name  : <?php echo $total_list['lastname'].", ".$total_list['firstname']; ?></h4>
                                                        <h4 class="media-heading">Room Number : <?php echo $total_list['room_no'];?></h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td class="col-md-4">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h3 class="media-heading">Grand Total  : ₱ <?php echo $total_list['grand_total'];?></h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <input type="hidden" class="form-control" name="restoorder_ID" id="restoorder_ID" value="<?php echo $total_list['restoorder_ID'];?>">
                                        <?php endforeach ?>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-info pull-right" name="action" value="Confirm Order" type="submit" style="width:150px;">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include'views/script-foot.php' ?>
<script>
    $("#confirmOrder").validate({ 
        rules: { },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/OrderController.php",
                data: datafields,
                success: function(data) {
                    var result = $.trim(data);
                    if(result == "success") {
                        $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Confirm Order.</p></div>");
                    } else {
                        $('#mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Confirm Order. Please try again!</p></div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    });
</script>
