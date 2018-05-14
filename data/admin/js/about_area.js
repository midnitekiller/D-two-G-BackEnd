/*
|================================|
|===selector button about_area===|
|================================|
*/
$(document).ready(function(){
    $('#edit_information').hide();

    $('#edit_button').on('click',function(){
        $('#edit_information').slideDown(1000);
        $('#show_information').hide();
    });

    $('#cancel_changes').on('click', function(){
        $('#show_information').slideToggle("slow");
        $('#edit_information').hide();
    });
});
