<div id="mssg"></div><br/>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title-table">
                <label> Services Detail All Items </label>
                <a class="buttonsp" name="action" value="" type="submit" data-toggle="modal" data-target="#services_detail-modal"><i class="fa fa-plus"></i> Create Services Detail</a>
            </div>
            <div id="data_handler" class="ibox-content" > 
                <table id="data_display" class="table dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Preview</th>
                            <th class="text-center">Service Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Services Type</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $values => $servicesDetails_list): ?>
                        <tr class="lists-item">
                            <td class="text-center"><?php echo $servicesDetails_list['serviceProd_ID']; ?></td>
                            <td class="text-center"><img src="media/images/<?=preg_replace("/[^a-zA-Z]+/", "", $servicesDetails_list['hotel_name']);?>/services/<?=$servicesDetails_list['image'];?>" class="center-block" width="50" height="50"></td>
                            <td class="text-center"><?php echo $servicesDetails_list['serviceProdName']; ?></td>
                            <td class="text-center">₱ <?php echo $servicesDetails_list['serviceProdPrice']; ?></td>
                            <td class="text-center" width="400"><?php echo $servicesDetails_list['serviceProdDesc']; ?></td>
                            <td class="text-center"><?php echo $servicesDetails_list['serviceName']; ?></td>
                            <td class="text-center"><?php echo $servicesDetails_list['duration']; ?></td>
                            <td class="text-center">
                                <a href="update-servicesdetail.php?id=<?php echo $servicesDetails_list['serviceProd_ID']; ?>" class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='javascript:;' name="action" id="<?php echo $servicesDetails_list['serviceProd_ID']; ?>"  onclick='deleteThis(this)' class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Add Services Button-->
<button class="material-button material-button-toggle" title="Add Services Detail" data-toggle="modal" data-target="#services_detail-modal"><span class="fa fa-plus" aria-hidden="true"></span></button>

<!-- Modal hotel write-up -->
<div id="services_detail-modal" class="modal fade" role="dialog" style="margin-top:-35px;">
  <div class="modal-dialog decor">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Services Detail</h4>
            <div id="service_mssg"></div>
        </div>
            <!-- content of hotel write-up -->
            <div class="modal-body">
                 <form method="post" id="create_services_form" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="hotel_ID" value="<?=$hotelid;?>">
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Services Detail Name</label><small> ( required ) </small>
                                <input type="text" class="form-control" name="services_detail_name" value="">
                            </div>
                            <div class="col-sm-6"><br/>
                                <label class="control-label">Services Type</label> <small>( required ) </small>
                                <select class="form-control m-b" name="service_ID"> 
                                    <option value="">-- Select --</option>
                                    <?php foreach ($services_type as $values => $servicesType_list): ?>
                                    <option value="<?php echo $servicesType_list['service_ID'];?>"><?php echo $servicesType_list['serviceName'];?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-6"><br/>
                                <label class="control-label">Duration</label><small> ( required ) </small>
                                <input type="text" class="form-control" name="duration" value="">
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label">Services Price</label><small> ( required ) </small>
                                <input type="text" class="form-control" name="service_price" value="">
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Description</label><small> ( required ) </small>
                                <textarea class="form-control" rows="5" name="description"></textarea>
                                <input type="hidden" class="form-control" rows="5" name="" value=""/>
                            </div>
                            <div class="col-sm-12"><br/>
                                <label class="control-label">Image</label><small> ( required ) </small>
                                 <div class="input-group image-preview col-sm-12">
                                    <input type="text" name="img_service" id="services_logo" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                                    <span class="input-group-btn">
                                        <!-- image-preview-clear button -->
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                        </button>
                                        <!-- image-preview-input -->
                                        <div class="btn btn-default image-preview-input">
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="image-preview-input-title">Choose File</span>
                                            <input type="file" name="services_logo_image" id="services_logo_image" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-info" name="action" value="Add Service Detail" type="submit" style="float:right">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"  src="js/image_input.js"></script>
<?php include'views/script-foot.php' ?>

<script>
function deleteThis(element) {
    var serviceProd_ID = $(element).attr('id');
    var confirm_mssg = confirm("Confirm to delete it");
    if(confirm_mssg) {
        $(element).parent().parent().remove();
        var data = [];
        data.push({"name":"action","value":"Remove ServicesDetail"});
        data.push({"name":"serviceProd_ID","value":serviceProd_ID});
        $.post(
            'controller/ServicesController.php',
            data,
            function(info) {
                $('#mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Deleted Services Detail.</p></div>");
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

    $("#create_services_form").validate({
        rules: {
            services_detail_name  : "required",
            service_ID            : "required",
            duration              : "required",
            service_price         : {required:true,number: true },
            description           : "required",
            img_service         : "required"
        },  
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');

            /* image upload */
            var logo_img = $('#services_logo_image')[0].files[0];
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
                    url:"controller/ServicesController.php",
                    data: datafields,
                    processData: false, //part of image upload
                    contentType: false, //part of image upload
                    timeout: 600000, //part of image upload
                    success: function(data) {
                        var result = $.trim(data);
                        if(result == "true") {
                            datatable.destroy();
                            $('#data_handler').load("services_detail.php #data_display", function(){
                                 $("#display_data").DataTable({
                                    "order":[[2,"desc"]],
                                    "aoColumnDefs":[{
                                        'bSortable' : false,
                                        'aTargets'  : [3]
                                    }]
                                 });
                            });
                            $('#service_mssg').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Addded Services Detail.</p></div>");
                        }else {
                            $('#service_mssg').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Add Services Detail. Please try again!</p></div>");
                        }
                        $("#loadthis").removeClass('loader-show');
                        setTimeout(function(){ $('#service_mssg').html(""); }, 4000);
                    }
                });
            }
         }
    });
});    
</script>