<?php include'views/content-header.php'?>








<body class="gray-bg">
    <div class="loginColumns animated fadeInDown" id="loginregistry">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="ibox-content">
                    <form  id="loginsecured" method="post">
						<div class="form-group">
							<h4 class="text-center">D2GAPP | Login</h4>
						</div>
                        <div class="form-group">
                             <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </span>
                                <input type="email" class="form-control" placeholder="Email"  name="email" value="" />
                             </div>
                        </div>
                        <div class="form-group">
                            <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </span>
                                <input type="password" class="form-control" placeholder="Password"  name="password" value="" />
                             </div>
                        </div>
						<div class="form-group">
							<a href="/forgot-password" class="text-left">Forgot Password?</a>
						</div>
                        <a href="main.php" type="submit" class="btn btn-primary block full-width m-b">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    <div class="loginColumns animated fadeInDown" id="securitypin">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="ibox-content">
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
                                <input type="text" class="form-control" placeholder="Insert PIN"  name="pin" id="pin" value="" />
                             </div>
                        </div>
                         <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button id="pinregistration" class="btn btn-primary block full-width m-b" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="loginColumns animated fadeInDown" id="registerpin">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                    <form  method="post" id="registersecured">
						<div class="form-group">
							<div class="row wrapper border-bottom white-bg page-heading">
                                <div class="col-lg-12">
                                    <h2>D2GAPP Registration</h2>
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
                                        <input type="text" class="form-control" placeholder="Firstname" id="firstname"  name="firstname" value="" />
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Lastname" id="lastname" name="lastname" value="" />
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="" id="mname"  name="mname" value="" />
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-map-marker"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Address"  name="address" value="" />
                                     </div>
                                </div>
                            </div>
                             <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-tablet"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Contact No."  name="contact" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-envelope-o"></span>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email"  name="email" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Username"  name="username" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-unlock-alt"></span>
                                        </span>
                                        <input type="password" class="form-control" placeholder="Password"  name="password" value=""/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-unlock-alt"></span>
                                        </span>
                                        <input type="cpassword" class="form-control" placeholder="Confirm Password"  name="cpassword" value=""/>
                                     </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="register" class="btn btn-info pull-right" name="action" value="" type="submit">Register</button>
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
    <button href="#" id="secretbutton" type="submit" class="" style="bottom:0;right:0;position:absolute">Secret</button>
</body>

<script>
$(document).ready(function(){
    $('#securitypin').hide();
    $('#registerpin').hide();

    $('#secretbutton').on('click',function(){
        $('#securitypin').slideDown(1000);
        $('#loginregistry').hide();
        $('#registerpin').hide();
    });

    $('#pinregistration').on('click', function(){
        $('#registerpin').slideToggle("slow");
        $('#securitypin').hide();
    });
    
    $('#cancel').on('click', function(){
        $('#securitypin').slideToggle("slow");
        $('#registerpin').hide();
    });
});

    
    
    
$(function () {
    $("#loginsecured").validate({
        rules: {
            email: "required",
            password: "required"
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert alert-info'>Successfully!</div>");
                    }else {
                        $('#mssg').html("<div class='alert alert-danger'>Unable to Insert PIN!</div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    location.reload()
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
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert alert-info'>Successfully!</div>");
                    }else {
                        $('#mssg').html("<div class='alert alert-danger'>Unable to Insert PIN!</div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    location.reload()
                }
            });
        }
    })
});
    
$(function () {
    $("#registersecured").validate({
        rules: {
            firstname: "required",
            lastname: "required"
           
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("form").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/GuestsController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert alert-info'>Successfully Added Admin!</div>");
                    }else if (data == "exists"){
                        $('#mssg').html("<div class='alert alert-danger'> Existing Records! </div>");
                    }else {
                        $('#mssg').html("<div class='alert alert-danger'>Im sorry Unable to add Admin!</div>");
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                    $('#loginregistry').slideDown(1000);
                    $('#securitypin').hide();
                    $('#registerpin').hide();
                    location.reload()
                }
            });
        }
    })
});
</script>