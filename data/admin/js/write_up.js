/*
|================================|
|==selector button hotel_writeup=|
|================================|
*/
$(document).ready(function(){
    $('#edit_informationz').hide();

    $('#edit_buttonz').on('click',function(){
        $('#edit_informationz').slideDown(1000);
        $('#show_informationz').hide();
    });

    $('#cancel_changesz').on('click', function(){
        $('#show_informationz').slideToggle("slow");
        $('#edit_informationz').hide();
    });
});