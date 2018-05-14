<div id="mssg"></div><br/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label>Amenities</label>
                <a class="buttonsp" name="action" value="" type="submit" data-toggle="modal" data-target="#amenities-modal"><i class="fa fa-plus"></i> Create New Amenities</a>
            </div>
            <div id="data_handler" class="ibox-content" > 
                <table id="data_display" class="table dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Preview</th>
                            <th class="text-center">Amenities Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Amenities Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php foreach($amenities as $values => $amenities_list): ?>	
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $amenities_list['amenities_ID']; ?></td>
                            <td class="text-center"><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $amenities_list['hotel_name']);?>/amenities/<?=$amenities_list['amenities_name'];?>/<?=$amenities_list['image'];?>" class="center-block" width="50" height="50"></td>
                            <td class="text-center"><?php echo $amenities_list['amenities_name']; ?></td>
                            <td class="text-center"><?php echo $amenities_list['description']; ?></td>
                            <td class="text-center"><?php echo $amenities_list['amenities_type']; ?></td>
                            <td class="text-center">
                                <a href="update-hotel_amenities.php?id=<?php echo $amenities_list['amenities_ID']; ?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $amenities_list['amenities_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Add Amenities Button-->
<button  class="material-button material-button-toggle" title="Add Amenities" data-toggle="modal" data-target="#amenities-modal"><span class="fa fa-plus" aria-hidden="true"></span></button>
<!-- Modal Hotel Amenities -->
<div id="amenities-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
    <div class="modal-dialog decor">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Amenities</h4>
                <div id="message_info"></div>
            </div>
              <!-- content of Hotel Amenities -->
              <div class="modal-body">
                  <div class="row">
                      <form method="post" id="create_amenities_form" enctype="multipart/form-data">
                            <div class="col-sm-12">
                                <div class="col-sm-12"><br/>
                                    <label class="control-label">Amenities Name</label><small> ( required ) </small>
                                    <input type="text" class="form-control" name="amenities_name" id="amenities_name" value="">
                                    <input type="hidden" class="form-control" name="hotel_ID" value="<?=$hotelid;?>">
                                </div>
                                <div class="col-sm-12"><br/>
                                    <label class="control-label">Amenities Type</label><small>( required ) </small>
                                    <select name="amenities_type" id="amenities_type" class="form-control m-b">
                                        <option value="">-- Select --</option>
                                        <option value="Hotel" >Hotel</option>
                                        <option value="Room" >Room</option>
                                    </select>
                                </div> 
                                <div class="col-sm-12">
                                    <label class="control-label">Description</label><small> ( required ) </small>
                                    <textarea class="form-control" rows="5" name="amenities_description" id="amenities_description"></textarea>
                                    <input type="hidden" class="form-control" rows="5" name="" id="descriptions" value=""/>
                                </div>
                                <div class="col-sm-12"><br/>
                                    <label class="control-label">Image</label><small> ( required ) </small>
                                     <div class="input-group image-preview col-sm-12">
                                        <input type="text" name="img_amenities" id="amenities_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title">Choose File</span>
                                                <input type="file" name="amenities_logo_image" id="amenities_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-info" name="action" value="Add Amenities" type="submit">Submit</button>
                                </div>
                            </div>
                      </form>
                  </div>
              </div>
        </div>
    </div>
</div>
<script type="text/javascript"  src="js/image_input.js"></script>
<?php include'views/script-foot.php' ?>
<script>

function clearData(){
    document.getElementById("amenities_name").value = "";
    document.getElementById("amenities_type").value = "";
    document.getElementById("amenities_description").value = "";
    document.getElementById("amenities_logo").value= "";
}
 
function deleteThis(element) {
    var amenities_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove Amenities"});
        data.push({"name":"amenities_ID","value":amenities_ID});
        $.post(
            'controller/HotelAmenitiesController.php',
            data,
            function(info) {
            $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted Hotel Amenities!</p></div>");
            $("#loadthis").removeClass('loader-show');
            setTimeout(function(){ $('#mssg').html(""); }, 4000);
            }
        );
    }
}
    
function byteToMB(intVal){
	return (intVal * 0.000001).toFixed(2);
}
    
$(document).ready(function(){
    var datatable = $("#display_data").DataTable({
        "order":[[2,"desc"]],
        "aoColumnDefs":[{
            'bSortable' : false,
            'aTargets'  : [3]
        }]
    });

    $("#create_amenities_form").validate({
        rules: {
            amenities_name : "required",
            amenities_type : "required",
            amenities_description    : "required",
            img_amenities  : "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');

            /* image upload */
            var logo_img = $('#amenities_logo_image')[0].files[0];
            var logo_error = 1;
            var datafields = new FormData($("form")[3]);

            if(logo_img){
                var ext = logo_img.name.split('.').pop('-1');
                if(logo_img.size > 2000000){
                    $('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(logo_img.size) + "LOGO : MB. Maximum file size for image is 2 MB. </div>");
                    $('#popalert').show();
                }else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
                    $('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
                    $('#popalert').show();
                }else{
                    logo_error = 0;
                    datafields.append('logo', logo_img.name);
                }

            } else{
                logo_error = 0;
                datafields.append('logo', $('hotel_logo').val());
            }

            if(logo_error == 1){
                console.log("fail ang duha ka image");
            }else if(logo_error == 1){
                console.log("fail ang logo");
            }
            /* end */
            /* use logo_error for checking before proceeding to ajax */

            if(logo_error == 0){ // checking
                $.ajax({
                    type:"POST",
                    enctype: 'multipart/form-data', //part of image upload
                    url:"controller/HotelAmenitiesController.php",
                    data: datafields,
                    processData: false, //part of image upload
                    contentType: false, //part of image upload
                    timeout: 600000, //part of image upload
                    success: function(data) {
                        var result = $.trim(data);
                        if(result == "true") {
                            datatable.destroy();
                            $('#data_handler').load("amenities.php #data_display", function(){
                                 $("#display_data").DataTable({
                                    "order":[[2,"desc"]],
                                    "aoColumnDefs":[{
                                        'bSortable' : false,
                                        'aTargets'  : [3]
                                    }]
                                 });
                            });
                             $('#message_info').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Added Hotel Amenities!</p></div>");
                             clearData();
                        }else {
                             $('#message_info').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add Hotel Amenities. Please try again!</p></div>");
                        }
                        $("#loadthis").removeClass('loader-show');
                        setTimeout(function(){ $('#message_info').html(""); }, 4000);
                     }
                });
            }
         }
    });
});    
</script>