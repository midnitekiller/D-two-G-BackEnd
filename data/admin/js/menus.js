/*
|================================|
|======selector button menus=====|
|================================|
*/
 $(document).ready(function(){
    $('#create-menu').on('click',function(){
       $('#menu-modal').modal().show();
        return false;
    });
     
    $('#menu-add').on('click',function(){
       $('#menu-modal').modal().show();
        return false;
    });
 });


 var restaurantid, categoryid;
 $("#selRestaurants1").on('change', function() {
	 var e = document.getElementById("selRestaurants1");
	 restaurantid = e.options[e.selectedIndex].value;
	 
	$.ajax({
		type:"POST",
		url:"controller/MenusController.php",
		data:{
			action : "Get Categories",
			restaurant_id : restaurantid
		},
		success: function(data){
			$('select[name="selCategory"]').html('');
			var myArr = JSON.parse(data);
			var optionAsString = "";
			for(var i = 0; i < myArr.length; i++){
				optionAsString += "<option value='"+myArr[i].category_ID+"'>"+ myArr[i].category_name + "</option>";
			}
			$('select[name="selCategory"]').append("<option value=''>-- Select --</option>");
			$('select[name="selCategory"]').append(optionAsString);
		}
	});
 });
 
 $("#menRestaurants").on('change', function() {
	 var e = document.getElementById("menRestaurants");
	 restaurantid = e.options[e.selectedIndex].value;
	 
	$.ajax({
		type:"POST",
		url:"controller/MenusController.php",
		data:{
			action : "Get Categories",
			restaurant_id : restaurantid
		},
		success: function(data){
			$('select[name="menCategories"]').html('');
			var myArr = JSON.parse(data);
			var optionAsString = "";
			for(var i = 0; i < myArr.length; i++){
				optionAsString += "<option value='"+myArr[i].category_ID+"'>"+ myArr[i].category_name + "</option>";
			}
			$('select[name="menCategories"]').append("<option value=''>-- Select --</option>");
			$('select[name="menCategories"]').append(optionAsString);
		}
	});
 });
 
 $("#menCategories").on('change', function() {
	 var e = document.getElementById("menRestaurants");
	 restaurantid = e.options[e.selectedIndex].value;
	 var e1 = document.getElementById("menCategories");
	 categoryid = e1.options[e1.selectedIndex].value;
	$.ajax({
		type:"POST",
		url:"controller/MenusController.php",
		data:{
			action : "Get Dishstyle",
			category_id : categoryid,
			restaurant_id : restaurantid
		},
		success: function(data){
			$('select[name="menDishstyle"]').html('');
			var myArr = JSON.parse(data);
			var optionAsString = "";
			for(var i = 0; i < myArr.length; i++){
				optionAsString += "<option value='"+myArr[i].dishstyle_ID+"'>"+ myArr[i].dishstyle_name + "</option>";
			}
			$('select[name="menDishstyle"]').append("<option value=''>-- Select --</option>");
			$('select[name="menDishstyle"]').append(optionAsString);
		}
	});
 });
 
 $("#actiontype").click(function(){
	 console.log("click");
	var radioValue = $("input[name='tabs']:checked").val();
	
	if(radioValue == "category"){
		$("#addcategory").validate({
			rules: {
				categoryin : "required",
				selRestaurants : "required"
			},
			submitHandler: function(form){
				$("#loadthis").addClass('loader-show');
				var datafields = $("#addcategory").serializeArray();
				$.ajax({
					type: "POST",
					url: "controller/MenusController.php",
					data: datafields,
					success: function(data){
						if(data == "true"){
                            $('#menumessage').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Added new Category.</p></div>");
                            setTimeout(function(){ $('#menumessage').html(""); }, 4000);
						}else{
                            $('#menumessage').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'> Unable to Add new Category. Please try again!</p></div>");
                            setTimeout(function(){ $('#menumessage').html(""); }, 4000);
						}
					}
				});
			}
		});
		$("#addcategory").submit();
	}else if(radioValue == "dishstyle"){
		$("#adddishstyle").validate({
			rules: {
				dishstylein : "required",
				selRestaurants1 : "required",
				selCategory : "required"
			},
			submitHandler: function(form){
				$("#loadthis").addClass('loader-show');
				var datafields1 = $("#adddishstyle").serializeArray();
				$.ajax({
					type: "POST",
					url: "controller/MenusController.php",
					data: datafields1,
					success: function(data){
						if(data == "true"){
                            $('#menumessage').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Added new Dishstlye.</p></div>");
                            setTimeout(function(){ $('#menumessage').html(""); }, 4000);
						}else{
                            $('#menumessage').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'> Unable to Add new Dishstlye. Please try again!</p></div>");
                            setTimeout(function(){ $('#menumessage').html(""); }, 4000);
						}
					}
				});
			}
		});
		$("#adddishstyle").submit();
	}else if(radioValue == "menu"){
		$("#addmenu").validate({
			rules: {
				menRestaurants : "required",
				menCategories : "required",
				menDishstyle : "required",
				dishname : "required",
				price : {required:true, number:true},
				description : "required",
				shortdescription : "required",
                menu_image: 'required'
			},
			submitHandler: function(form){
				$("#loadthis").addClass('loader-show');
		
				/* image upload */
				var logo_img = $('#menu_image_logo')[0].files[0];
				var logo_error = 1;
				var datafields2 = new FormData($("#addmenu")[0]);
				
				if(logo_img){
					var ext = logo_img.name.split('.').pop('-1');
					if(logo_img.size > 2000000){
						$('#menumessage').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> File Size: " + byteToMB(logo_img.size) + "LOGO : MB. Maximum file size for image is 2 MB. </div>");
						$('#popalert').show();
					}else if(ext != 'jpg' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'JPG' && ext != 'PNG'){
						$('#menumessage').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> LOGO:  File Type: " + ext + " Please select an image with '.jpg', '.png' file format. </div>");
						$('#popalert').show();
					}else{
						logo_error = 0;
						datafields2.append('logo', logo_img.name);
					}
					
				} else{
					logo_error = 0;
					datafields2.append('logo', $('hotel_logo').val());
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
						url:"controller/MenusController.php",
						data: datafields2,
						processData: false, //part of image upload
						contentType: false, //part of image upload
						timeout: 600000, //part of image upload
						success: function(data) {
							var result = $.trim(data);
							if(result == "true") {
                                $('#menumessage').html("<div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='glyphicon glyphicon-ok'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Successfully Added new Menu.</p></div>");
                                setTimeout(function(){ $('#menumessage').html(""); }, 4000);
							    setTimeout(function() {location.reload() },2000);
							}else {
                                $('#menumessage').html("<div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'> Unable to Add new Menu. Please try again!</p></div>");
                                setTimeout(function(){ $('#menumessage').html(""); }, 4000);
							}
							console.log(result);
							$("#loadthis").removeClass('loader-show');
							setTimeout(function(){ $('#mssg').html(""); }, 2000);
				
						 }
					});
				}
			}
		});
		$("#addmenu").submit();
	}
});