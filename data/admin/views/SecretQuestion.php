
<body class="gray-bg">
    <div class="loginColumns animated fadeInDown" id="answerpin" style="display:none;">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content shadow-box">
                    <form  method="post" id="answersecured">
						<div class="form-group">
                            <div class="form-group">
                                <div class="row wrapper border-bottom white-bg page-heading">
                                    <div class="col-lg-12 text-center">
                                        <h2>FORGOT PASSWORD</h2>
                                        <small id="fileHelp" class="form-text text-muted">Answer the security question below</small>
                                        <input type="hidden" name="token" id="token"/>
                                    </div>
                                </div>
						    </div>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label"><?=$question; ?></label> <small>( required ) </small>
                                <input type="text" class="form-control" name="Secret_Answer" id="Secret_Answer" value="" placeholder="your secret answer here..." >
                                <input type="hidden" class="form-control" name="email" id="email" value="<?=$email; ?>">
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="register" class="btn btn-info pull-right" name="checkAnswer" value="" type="submit">Submit</button>
                                        <a href="<?=$baseUrl;?>index.php?logout"  class="btn btn-info pull-right" type="button" style="padding-top:10px;">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="loginColumns animated fadeInDown" id="resetPasswordPin" style="display:none;">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content shadow-box">
                    <form  method="post" id="resetPasswordSecured">
						<div class="form-group">
                            <div class="form-group">
                                <div class="row wrapper border-bottom white-bg page-heading">
                                    <div class="col-lg-12 text-center">
                                        <h2>RESET NEW PASSWORD</h2>
                                        <small id="fileHelp" class="form-text text-muted">Please fill out all fields.</small>
                                        <input type="hidden" name="token" id="token"/>
                                    </div>
                                </div>
						    </div>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label">New Password</label> <small>( required ) </small>
                                <input type="hidden" class="form-control" name="email" id="email" value="<?=$email; ?>">
                                <input type="password" class="form-control" name="password" id="password" value=""><br/>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label">Confirm Password</label> <small>( required ) </small>
                                <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" value=""><br/>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="confirmReset" class="btn btn-info pull-right" name="ConfirmReset" value="" type="submit">Submit</button>
                                        <a href="<?=$baseUrl;?>index.php?logout"  class="btn btn-info pull-right" type="button" style="padding-top:10px;">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<div id="mssg" class="col-md-3" style="top:0;right:0;position:absolute;margin-top:10px;margin-right:-5px;"></div>      
</body>


<script>
$(document).ready(function(){
    $('#answerpin').slideToggle("slow");
    $('#resetPasswordPin').hide();
});
                  
$('#cancel').on('click', function(){
    document.getElementById("token").value = "";
    window.location.href='index.php';
});

  
$(function () {
    $("#answersecured").validate({
        rules: {
             Secret_Answer: "required"
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#answersecured").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert alert-dismissable alert-info fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> You have Successfully Answer the Secret Question.</div>");
                        $('#resetPasswordPin').slideToggle("slow");
                        $('#answerpin').hide();
                    }else {
                        $('#mssg').html("<div class='alert alert-dismissable alert-danger fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Invalid Answer Please try Again. </div>");
                         console.log(data);
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    })
});       
    
$(function () {
    $("#resetPasswordSecured").validate({
        rules: {
             password: "required",
             ConfirmPassword: { required: true, equalTo: "#password" }
        },
        submitHandler: function(form) {
            $("#loadthis").addClass('loader-show');
            var datafields = [];
            datafields = $("#resetPasswordSecured").serializeArray();
            $.ajax({
                type:"POST",
                url:"controller/AdminController.php",
                data: datafields,
                success: function(data) {
                    if(data == "true") {
                        $('#mssg').html("<div class='alert alert-dismissable alert-info fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> You have Succesfully Reset your New Password  </div>");
                        window.location.href='<?=$baseUrl;?>index.php?logout';
                    }else {
                        $('#mssg').html("<div class='alert alert-dismissable alert-danger fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Unable to Reset your New Password Please try Again. </div>");
                         console.log(data);
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                }
            });
        }
    })
});    
</script>


