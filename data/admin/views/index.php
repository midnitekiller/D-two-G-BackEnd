<body class="gray-bg">
    <div class="loginColumns animated fadeInDown" id="loginregistry">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="ibox-content shadow-box">
                    <form id="loginsecured" method="post">
						<div class="form-group">
							<h4 class="text-center">D2GAPP | Login</h4>
						</div>
                        <div class="form-group">
                             <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </span>
                                <input type="text" class="form-control" placeholder="Email / Username" id="logemail" name="logemail" value="" />
                             </div>
                        </div>
                        <div class="form-group">
                            <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </span>
                                <input type="password" class="form-control" placeholder="Password" id="logpassword" name="logpassword" value="" />
                             </div>
                        </div>
						<div class="form-group">
                            <a class="pull-left" id="forgotPassword">Forgot Password?</a>
                            <a class="pull-right" id="registerHere">Register Here!</a><br/>
						</div>
                        <button id="logmein" name="logmein" type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="loginColumns animated fadeInDown" id="securitypin" style="display:none;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="ibox-content shadow-box">
                    <form method="post"  id="pinsecured">
						<div class="form-group">
							<small id="fileHelp" class="form-text text-muted">Insert PIN here.
                            <br/>
                            NOTE: Only authorized user can access the Adminboard.</small>
						</div>
                        <div class="form-group">
                            <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </span>
                                <input type="password" class="form-control" placeholder="Insert PIN"  name="pin" id="pin" value="" />
                             </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button id="pincode" name="pincode" class="btn btn-primary block full-width m-b" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a class="pull-right inline-link-2" id="loginHere">Back to Login Form</a><br/>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="loginColumns animated fadeInDown" id="registerpin" style="display:none;">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content shadow-box">
                    <form  method="post" id="registersecured">
						<div class="form-group">
							<div class="row wrapper border-bottom white-bg page-heading">
                                <div class="col-lg-12">
                                    <h2>D2GAPP Registration</h2>
									<input type="hidden" name="token" id="token"/>
									<input type="hidden" name="utype" id="utype"/>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="First name" id="firstname"  name="firstname" value="" />
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Middle name" id="middlename" name="middlename" value="" />
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Last name" id="lastname"  name="lastname" value="" />
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-map-marker"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Address" id="address" name="address" value="" />
                                     </div>
                                </div>
                            </div>
                             <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-tablet"></span>
                                        </span>
                                        <input type="number" class="form-control" placeholder="Contact No." id="contact" name="contact" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-envelope-o"></span>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Username" id="username" name="username" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-unlock-alt"></span>
                                        </span>
                                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-unlock-alt"></span>
                                        </span>
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword" value=""/>
                                     </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="register" class="btn btn-info pull-right" name="register" value="" type="submit">Register</button>
                                        <button id="cancel" class="btn btn-info pull-right" type="button">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <button href="#" id="secretbutton" type="submit" class="" style="bottom:0;right:0;position:absolute;background-color:Transparent;"></button>
	<div id="mssg" class="col-md-12" style="top:0;right:0;position:absolute;margin-top:-5px;margin-right:-5px;"></div>
</body>

<script>
$(document).ready(function(){
    $('#securitypin').hide();
    $('#registerpin').hide();

    $('#secretbutton').on('click',function(){
        $('#securitypin').slideDown(1000);
        $('#loginregistry').hide();
        $('#registerpin').hide();
		$('#secretbutton').hide();
    });
    
    $('#loginHere').on('click',function(){
        $('#loginregistry').slideDown(1000);
        $('#securitypin').hide();
        $('#registerpin').hide();
		$('#secretbutton').show();
    });
    
    $('#cancel').on('click', function(){
        $('#loginregistry').slideDown(1000);
		$('#registerpin').hide();
		document.getElementById("token").value = "";
    });
	
	
});

    
$(function () {
    $("#loginsecured").validate({
        rules: {
            logemail: "required",
            logpassword: "required"
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#loginsecured").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
                    if(data.trim() == "true") {
                        $('#mssg').html("<center><div class='alert-success-row'><span class='alert-label alert-label-left alert-success-cell'><i class='fa fa-unlock-alt fa-2x'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>You have Successfully Login!</p></div></center>");
						setTimeout(function() {location.reload() }, 2000);
                    }else {
                        $('#mssg').html("<center><div class='alert-danger-row'><span class='alert-label alert-label-left alert-danger-cell'><i class='glyphicon glyphicon-alert'></i></span><p class='alert-body alert-body-right alert-labelled-cell'>Unable to Login. Please try again!</p></div></center>");
						console.log(data);
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 2000);
                    
                }
            });
        }
    })
});

$(function () {
    $("#pinsecured").validate({
        rules: {
            pin: "required"
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#pinsecured").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
					var obj = JSON.parse(data);
                    if(obj.status == "true") {
						if(obj.type == "0"){
							$('#registerpin').slideToggle("slow");
							$('#securitypin').hide();
							$('#secretbutton').hide();
							document.getElementById("token").value = obj.pin;
							document.getElementById("utype").value = obj.type;
						}else{
							$('#mssg').html("<div class='alert alert-dismissable alert-danger fade in' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> You're in the wrong page! </div>");
							$('#popalert').show();
						}
                    }else if(obj.status == "pindown"){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger fade in' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Pin already used! Please contact super-admin! </div>");
						$('#popalert').show();
					}else{
						$('#mssg').html("<div class='alert alert-dismissable alert-danger fade in' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Invalid PIN Code! </div>");
						$('#popalert').show();
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    //location.reload()
                }
            });
        }
    })
});
    
$(function () {
    $("#registersecured").validate({
        rules: {
            firstname: {required:true, nonNumeric:true},
            lastname: {required:true, nonNumeric:true},
			email: {required:true, email:true},
			username: "required",
			password: "required",
			cpassword: {
				required: true,
				equalTo: "#password"
			}
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#registersecured").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert alert-dismissable alert-info' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Successfully Added Admin!</div>");
						$('#popalert').show();
						window.location.href = 'SuperDashboard.php';
                    }else if (data == "email"){
                        $('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Email is in use already! </div>");
						$('#popalert').show();
                    }else if(data == "username"){
                        $('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Username is in use already! </div>");
						$('#popalert').show();
                    }else if(data == "pin"){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Invalid Registration! </div>");
						$('#popalert').show();
					}else if(data == "both"){
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Username and email already exist! </div>");
						$('#popalert').show();
					}else {
						$('#mssg').html("<div class='alert alert-dismissable alert-danger' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Unable to add SuperAdmin!</div>");
						$('#popalert').show();
						console.log(data);
					}
                }
            });
        }
    })
});
</script>

<script>
$('#forgotPassword').on('click',function(){
    window.location.href='forgotPassword.php';
});
$('#registerHere').on('click',function(){
    window.location.href='registerAdmin.php';
});
</script>