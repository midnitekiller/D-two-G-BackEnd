<body class="gray-bg">
    <div class="loginColumns animated fadeInDown" id="emailpin" style="display:none;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="ibox-content shadow-box">
                    <form method="post"  id="emailsecured">
						<div class="form-group">
                            <div class="form-group">
                                <div class="row wrapper border-bottom white-bg page-heading">
                                    <div class="col-lg-12 text-center">
                                        <h2>FORGOT YOUR PASSWORD </h2>
                                        <input type="hidden" name="token" id="token"/>
                                    </div>
                                </div>
						    </div>
							<small id="fileHelp" class="form-text text-muted">Please enter your email address here!
                            <br/>
                            NOTE: After Submitting your email we will provide a challenge question you selected.</small>
						</div>
                        <div class="form-group">
                            <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </span>
                                <input type="email" class="form-control" placeholder="Email Address"  name="email" id="email" value="" />
                             </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button id="emailconfirm" name="emailconfirm" class="btn btn-primary block full-width m-b" type="submit">Submit</button>
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
	<div id="mssg" class="col-md-3" style="top:0;right:0;position:absolute;margin-top:10px;margin-right:-5px;"></div>
</body>

<script>
$(document).ready(function(){
    $('#emailpin').slideToggle("slow");
    $('#answerpin').hide();    
    
    $('#cancel').on('click', function(){
        document.getElementById("token").value = "";
        window.location.href='index.php';
    });
    
    $('#loginHere').on('click',function(){
        window.location.href='index.php';
    });
});
 
$(function () {
    $("#emailsecured").validate({
        rules: {
             email:{ required:true, email:true } 
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
                        $('#mssg').html("<div class='alert alert-dismissable alert-info fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> You have Successfully enter your email. You may now proceed the challenge Secret Question. </div>");
                        localStorage['email'] = $('#email').val();
                        setTimeout(function(){ window.location.href = 'SecretQuestion.php'; }, 1000)
                    }else {
                        $('#mssg').html("<div class='alert alert-dismissable alert-danger fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> Looks like your email you entered is not registered. Please try again! </div>");
                         console.log(data);
                    }
                    $("#loadthis").removeClass('loader-show');
                }
            });
        }
    })
});
</script>


