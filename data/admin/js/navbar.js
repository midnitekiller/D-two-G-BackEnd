$(function() {
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find('.link');
        // Evento
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    }
    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
            $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');
        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        };
    }	
    var accordion = new Accordion($('#accordion'), false);
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
/*
|================================|
|===selector navbar menu admin===|
|================================|
*/
 $(document).ready(function(){
    $('#write').on('click',function(){
        $('#writeup-modal').modal().show();
        return false;
    });
    $('#change_logo').on('click',function(){
        $('#logo-modal').modal().show();
        return false;
    });
    $('#amenities').on('click',function(){
        window.location.href='amenities.php';
    });
    $('#addguests').on('click',function(){
        window.location.href='addguests.php';
    });
    $('#displayguests').on('click',function(){
        window.location.href='displayguests.php';
    });
    $('#dashboard').on('click',function(){
        window.location.href='main.php';
    });
     $('#restaurant').on('click',function(){
        window.location.href='restaurant.php';
    });
    $('#menus').on('click',function(){
        window.location.href='menus.php';
    });
    $('#offers').on('click',function(){
        window.location.href='offers.php';
    });
    $('#offers_details').on('click',function(){
        window.location.href='offer_detail.php'; 
    });
    $('#services').on('click',function(){
        window.location.href='services.php';
    });
    $('#services_details').on('click',function(){
        window.location.href='services_detail.php'; 
    });
    $('#housekeeping').on('click',function(){
		window.location.href='housekeeping.php';
    });
    $('#feedback').on('click',function(){
        window.location.href='feedback.php';
    });
    $('#report-dining').on('click',function(){
        window.location.href='report-dining.php';
    });
    $('#report-services').on('click',function(){
        window.location.href='report-services.php';
    });
    $('#report-hotel').on('click',function(){
        window.location.href='report-hotel.php';
    });
    $('#report-feedback').on('click',function(){
        window.location.href='report-feedback.php';
    });
    $('#addStaff').on('click',function(){
        window.location.href='addStaff.php';
    });
    $('#btnaddStaff').on('click',function(){
        window.location.href='addStaff.php';
    });
    $('#viewStaff').on('click',function(){
        window.location.href='viewStaff.php';
    });
    $('#faq').on('click',function(){
        window.location.href='faq.php';
    });
    $('#chat').on('click',function(){
        window.location.href='chatroom.php';
    });
    $('#r_order').on('click',function(){
        window.location.href='order-guests.php';
    });
    $('#s_order').on('click',function(){
		window.location.href='order-service.php';
    });
    $('#channeladd').on('click',function(){
        window.location.href='channelad.php';
    });
/*
|====================================|
|===selector navbar menu superadmin==|
|====================================|
*/   
    $('#hotelselection').on('click',function(){
        window.location.href='hotelSelection.php';
    });
    $('#hotelselections').on('click',function(){
        window.location.href='hotelSelection.php';
    });
    $('#superdashboard').on('click',function(){
        window.location.href='SuperDashboard.php';
    });
    $('#addhotel').on('click',function(){
        window.location.href='addHotel.php';
    });
    $('#devicelist').on('click',function(){
        window.location.href='devicelist.php';
    });
    $('#device-modal').on('click',function(){
        $('#adddevice-modal').modal().show();
        return false;
    });
    $('#changepassword').on('click',function(){
        $('#changepassword-modal').modal().show();
        return false;
    });
    $('#profile').on('click',function(){
        $('#profile-modal').modal().show();
        return false;
    });
    $('#setting_profile').on('click',function(){
        $('#profile-modal').modal().show();
        return false;
    });
    $('#application-update').on('click',function(){
        window.location.href='application-update.php';
    });
    $('#allreport-hotel').on('click',function(){
        window.location.href='report-allhotel.php';
    });
    $('#allreport-dining').on('click',function(){
        window.location.href='report-alldining.php';
    });
    $('#allreport-services').on('click',function(){
        window.location.href='report-allservices.php';
    });
    $('#allreport-feedback').on('click',function(){
        window.location.href='report-allfeedback.php';
    });
    $('#addnearby').on('click',function(){
        window.location.href='addnearby.php';
    });
    $('#displaynearby').on('click',function(){
        window.location.href='displaynearby.php';
    });
    $('#authorized').on('click',function(){
        window.location.href='authorizedaccessall.php';
    });
    $('#access').on('click',function(){
        window.location.href='authorizedaccess.php';
    });
    $('#updatehotelphoto').on('click',function(){
        window.location.href='updatehotelphoto.php';
    });
    $('#channel').on('click',function(){
        window.location.href='channel.php';
    });
	$('#android').on('click',function(){
        window.location.href='android.php';
    });
    $('#channelall').on('click',function(){
        window.location.href='channelall.php';
    });
    $('#chatadmin').on('click',function(){
        window.location.href='adminchatroom.php';
    });
/*
|====================================|
|===selector navbar menu advertiser==|
|====================================|
*/   
    $('#advertiser_dashboard').on('click',function(){
        window.location.href='advertiser-dashboard.php';
    });
    $('#advertiser_ads').on('click',function(){
        window.location.href='advertiser-ads.php';
    });
    $('#advertiser_live').on('click',function(){
        window.location.href='advertiser-live.php';
    });
 });