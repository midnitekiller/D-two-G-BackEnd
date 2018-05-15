 $(document).ready(function(){
      $('#viewguest').on('click',function(){
        window.location.href='displayguests.php';
    });
 });

jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) > Number($(params).val())); 
    },'Must be greater than {0}.');
    
$(function () {
    $("#create_guest_form").validate({
        rules: {
            firstname: {required:true,nonNumeric: true },
            lastname: {required:true,nonNumeric: true },
            room_no: "required",
            daterange_in: "required",
            daterange_out: {required:true, greaterThan: "#datetimepicker1"},
            email: { required: false, email: true }
        },
        messages: {
            daterange_out:{ greaterThan:"Check-out date must be equal or after check-in date"}
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
                        $('#mssg').html("<div class='alert alert-dismissable alert-info fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a> You have Successfully Added Guests.</div>");
                    }else{
                        $('#mssg').html("<div class='alert alert-dismissable alert-danger fade in ' role='alert' id='popalert'><a href='#' class='close' data-dismiss='alert' aria-alert='close'>&times;</a>Unable to Add Guests. Please try again.</div>");
                        console.log(data);
                    }
                    $("#loadthis").removeClass('loader-show');
                    setTimeout(function(){ $('#mssg').html(""); }, 4000);
                
                }
            });
        }
    })
});
    