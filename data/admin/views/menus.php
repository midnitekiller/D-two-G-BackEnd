<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Menus Sorting </label>
            </div>
            <div class="ibox-content"> 
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label">Restaurant Name</label> <small>( required ) </small>
                        <select name="title" id="hotel_ID" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <?php foreach($restaurants as $key => $res):  ?>
								<option value="<?=$res['restaurant_ID'];?>"><?=$res['restaurant_name'];?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
               
               
                    <div class="col-sm-6">
                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> All Menu </label>
                <a class="buttonsp" id="menu-add" name="action" value="" type="submit"><i class="fa fa-plus"></i> Create New Menu</a>
            </div>
            <div class="ibox-content"> 
                <table class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Dish Preview</th>
                            <th class="text-center">Dish Name</th>
                            <th class="text-center">Dish Price</th>
							<th class="text-center">Restaurant</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Dishes Style</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
						<?php foreach($menus as $i => $m): ?>
                        <tr class="lists-item">
                            <td class="text-center" width="80"><img src="<?=$m['img_path'];?>" class="img-preview"></td>
                            <td class="text-center"><?=$m['menu_name'];?></td>
                            <td class="text-center" width="140"><?=$m['menu_price'];?></td>
							<td class="text-center" width="160"><?=$m['restaurant_name'];?></td>
                            <td class="text-center" width="140"><?=$m['category_name'];?></td>
                            <td class="text-center" width="140"><?=$m['dishstyle_name'];?></td>
                            <td class="text-center"width="200">
                                <a href="update-menudetails.php?id=<?=$m['restomenu_ID'];?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $m['restomenu_ID']; ?>" onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
						<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Guests Button-->
<button id="create-menu" class="material-button material-button-toggle" title="Add Menu"><span class="fa fa-plus" aria-hidden="true"></span></button>

<!-- Modal Add Menus -->
<div id="menu-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Menu</h4>
        <div id="menumessage"></div>
      </div>
      <div class="modal-body">
          <div class="tab_container">
			<input id="tab1" type="radio" name="tabs" checked value="category">
			<label for="tab1"><i class="fa fa-clone"></i><span>Category</span></label>
			<input id="tab2" type="radio" name="tabs" value="dishstyle">
			<label for="tab2"><i class="fa fa-clone"></i><span>Dish Style</span></label>
            <input id="tab3" type="radio" name="tabs" value="menu">
			<label for="tab3"><i class="fa fa-clone"></i><span>Menu Description</span></label>
            <!-- start content of menus -->
			<section id="content1" class="tab-content">
			<form method="post" id="addcategory">
				<div class="row">
				<input type="hidden" name="action" id="action" value="Add Category" />
                    <div class="col-sm-12">
                        <strong class="control-label">Category</strong><small> ( required ) </small>
                        <input type="text" class="form-control" name="categoryin" id="categoryin" value="" ><br/>
                    </div>
                    <div class="col-sm-12">
                        <strong class="control-label">Restaurant</strong> <small>( required ) </small>
                        <select name="selRestaurants" id="selRestaurants" class="form-control m-b">
                            <option value="">-- Select --</option>
						<?php foreach($restaurants as $values => $res):?>
							<option id="<?=$res['restaurant_ID'];?>" value="<?=$res['restaurant_ID'];?>"><?=$res['restaurant_name'];?></option>
						<?php endforeach; ?>
                        </select>
                    </div>
                </div>
			</form>
			</section>
			<section id="content2" class="tab-content">
			<form method="post" id="adddishstyle">
				<div class="row">
				<input type="hidden" name="action" value="Add Dishstyle" />
                <div class="col-sm-12">
                    <strong class="control-label">Dish Style</strong><small> ( required ) </small>
                    <input type="text" class="form-control" name="dishstylein" value="" ><br/>
                </div>
				<div class="col-sm-12">
					<strong class="control-label">Restaurant</strong> <small>( required ) </small>
					<select name="selRestaurants1" id="selRestaurants1" class="form-control m-b">
						<option value="">-- Select --</option>
					<?php foreach($restaurants as $values => $res):?>
						<option id="<?=$res['restaurant_ID'];?>" value="<?=$res['restaurant_ID'];?>"><?=$res['restaurant_name'];?></option>
					<?php endforeach; ?>
					</select>
				</div>
                <div class="col-sm-12">
                    <strong class="control-label">Category</strong> <small>( required ) </small>
                    <select name="selCategory" id="selCategory" class="form-control m-b">
                        <option value="">-- Select --</option>
                    </select>
                 </div>
              </div>
			</form>
			</section>
            <section id="content3" class="tab-content">
			<form method="post" enctype="multipart/form-data" id="addmenu">
                <div class="row">
				
				<input type="hidden" name="action" value="Add Menu" />
                    <div class="col-sm-4">
                        <strong class="control-label">Restaurant</strong> <small>( required ) </small>
                        <select name="menRestaurants" id="menRestaurants" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <?php foreach($restaurants as $values => $res):?>
								<option id="<?=$res['restaurant_ID'];?>" value="<?=$res['restaurant_ID'];?>"><?=$res['restaurant_name'];?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <strong class="control-label">Category</strong> <small>( required ) </small>
                        <select name="menCategories" id="menCategories" class="form-control m-b">
                            <option value="">-- Select --</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <strong class="control-label">Dishes Style</strong> <small>( required ) </small>
                        <select name="menDishstyle" id="menDishstyle" class="form-control m-b">
                            <option value="">-- Select --</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <strong class="control-label">Dish Name</strong><small> ( required ) </small>
                        <input type="text" class="form-control" name="dishname" id="dishname" value="" ><br/>
                    </div>
                  
                    <div class="col-sm-6">
                        <strong class="control-label">Price</strong><small> ( required ) </small>
                        <input type="text" class="form-control" name="price" value="" >
                    </div>
                    <div class="col-sm-6">
                        <strong class="control-label">POS Reference ID</strong><small> ( required ) </small>
                        <input type="text" class="form-control" name="posid" id="posid" value="" ><br/>
                    </div>
                    <div class="col-sm-12">
                        <strong class="control-label">Description</strong><small> ( required ) </small>
                        <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                        <input type="hidden" class="form-control" rows="5" name="aboutarea" value="" /><br/>
                    </div>
                    <div class="col-sm-12">
                        <strong class="control-label">Short Description</strong><small> ( required ) </small>
                        <textarea class="form-control" rows="5" name="shortdescription" id="shortdescription"></textarea>
                        <input type="hidden" class="form-control" rows="5" name="aboutarea" value="" />
                    </div>
                    <div class="col-sm-12"><br/>
                        <strong class="control-label">Image</strong><small> ( required ) </small>
                         <div class="input-group image-preview col-sm-12">
                            <input type="text" class="form-control image-preview-filename" name="menu_image" id="menu_image"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Choose File</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="menu_image_logo" id="menu_image_logo"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
				</form>
			</section>
            <!-- end content of menus -->
		</div>
      </div>
      <!-- Modal Footer -->
      <div class="modal-footer">
        <div class="row">
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-info" name="actiontype" id="actiontype" value="POST" type="button" style="float:right">Submit</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include'views/script-foot.php' ?>
<script type="text/javascript"  src="js/image_input.js"></script>
<script type="text/javascript"  src="js/menus.js"></script>

<script>
 $(document).ready(function(){
    var hotelid = "<?=$hotelid;?>";
 });
var table = $('.dynamicDataTables').DataTable();

 $("#hotel_ID").on('change', function() {
		var e = $("#hotel_ID option:selected").text();
		if(e != "-- Select --"){
			table.search( e ).draw();
		}else{
			table.search("").draw();
		}
		console.log(e);
});

function deleteThis(element) {
    var restomenu_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Restaurant Menu"});
        data.push({"name":"restomenu_ID","value":restomenu_ID});
        $.post(
            'controller/MenusController.php',
            data,
            function(info) {
                $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted Restaurant Menu.</p></div>");
                $("#loadthis").removeClass('loader-show');
                setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        );
    }
}
</script>