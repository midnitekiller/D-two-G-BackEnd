var host = 'http://'+top.location.host+"";
var xhr = null;

console.log(host);
// jQuery.ajaxPrefilter(function(options) {
//     if (options.crossDomain && jQuery.support.cors) {
//         options.url = 'https://cors-anywhere.herokuapp.com/' + options.url;
//     }
// });
var error_msgs = new Array("Naaa!","Oops!","Baaam!");
jQuery(document).ready(function($){

	// hideThis();
	feedbacksDate();

	$('.dynamicDataTables').DataTable({
          dom: 'Blfrtip',
          buttons: [
              'copy', 'excel', 'pdf', 'print'
          ],
	} );

	function hideThis() {
	    $.get( host + "/admin/chats/ajax", function (data) {
	        var response = data.notifications;
	        var resplen = response.length;
	        // console.log(response);
	        for(var ppp = 0; ppp < resplen; ppp++) {
	                $( "#notification-userid-" + response[ppp][0] ).addClass('show-this');
	            // if ( $( '#notification-userid-' + response[ppp][0] != 'undefined') ) {
	            //     $( "#notification-userid-" + response[ppp][0] ).html("<span id='notification-userid-" + response[ppp][0] + "' class='align-left label label-danger'>" + response[ppp][1] + "</span>");
	            // } else {
	            //     $( ".chat-user" ).append("<span id='notification-userid-" + response[ppp][0] + "' class='align-left label label-danger'>" + response[ppp][1] + "</span>");
	            // }
	                $( "#notification-userid-" + response[ppp][0] ).html( response[ppp][1] );
	        }
	        
	    });
	    console.log('update guest list with unread new messages.');
	}

	// $(function(){
	//   if($('div').hasClass('autorefreshcontent')){
	//     auto_load();
	//   }
	// });

	// fetchorders();

	// $('#testbtn').on('click', function(event) {
     

	// 			$.ajax( 'http://localhost:27017/d2gapp/notifications/?limit=-10', {
	// 			  type: 'GET',
	// 			  dataType: 'json',
	// 			  success: function( resp ) {
	// 			    console.log( resp.people );
	// 			  },
	// 			  error: function( req, status, err ) {
	// 			    console.log( 'something went wrong', status, err );
	// 			  }
	// 			});


	//     });  

	// $('#macaddress').remove();
	// var mac_address = $('select[name="room_no"] option:selected').data('mac-address');
	// $( "#create_guest_form" ).append( $( "<input name='mac_address' id='macaddress' type='hidden' value='" + mac_address + "'>" ) );
	
	// $('select[name="room_no"]').on('change', function(){
	// 	// $('#macaddress').remove();
	// 	var mac_address = $('select[name="room_no"] option:selected').data('mac-address');

	// 	$( "#macaddress" ).replaceWith( $( "<input name='mac_address' id='macaddress' type='hidden' value='" + mac_address + "'>" ) );

	// });
	
	// $('select[name="hotel_id"]').on('change', function(){
		// var value = $(this).val();
		// var url = host + '/s_admin/tabs/create?hotel_id=' + value;
		// console.log( url );
		// // var url = host + '/api/public/hotels/' + value + '?f=max_room';
		// window.location.href = url;
		// 
		// var url = host + '/api/public/hotels/' + value + '?f=max_room';
		// var room_no = $('select[name="room_no"]');
		// room_no.empty();
		// console.log(url);
		// $.getJSON(url, function (data) {
		// 	var rooms = data.results.max_room;
		// 	for(var i = 1; i <= rooms; i++) {
		// 		room_no.append("<option value="+ i +">" + i + "</option>");
		// 	}
	 //    	console.log(data.results.max_room);
		// });
		// http://backend.d2gapp.dev/api/public/hotels/57a20fa6d6a79385850041ab?f=max_room
	// });

	// category

	$(document).on('click', '.delete-this-item', function() {
		var $this = $(this);
		if( !confirm( $this.attr('data-confirmation-msg') ) ) return false;

		var id = $this.attr('data-id');
		var url = $(this).attr('data-action'); 

		$.get( url , function(data) {
			if( data.error === false ){
				reloadApp(id);
				$this.parents('.lists-item').hide('slow');
				$('.lists-item').each(function (i) {
				   $("td:first tr", this).html(i + 1);
				});
			} else {
				alert( data.msg );
			}
		},"json");

		return false;
	});

	var Araiene =  

	// $( ".view_order" ).click(function() {
	//   $( ".order_content" ).slideToggle('slow');
	// });


   //  $('#myModal1').on("show.bs.modal", function (event) {
	  // // var button = $(event.relatedTarget); // Button that triggered the modal
	  // // var id = button.data('id'); // Extract info from data-* attributes
	  // // var modal = $(this);
	  // // modal.find('.modal-title').text('New message to ' + id);
	  // // modal.find('.modal-footer input').val(id);  
 		//  alert('id');
   //  });

	// $('#myModal2').on('show.bs.modal', function (event) {
	//   // var elems = $(event.relatedTarget) 
	//   // var firstcol = elems.data('firstcol')
	//   // var secondcol = elems.data('secondcol')
	//   // var title = elems.data('title')
	//   // var modal = $(this)
	//   // modal.find('.modal-title').text(title)
	//   // modal.find('#firstcol').text(firstcol)
	// })    
	// $('#myModal').on('shown.bs.modal', function () {
	// 	$('.rowdata').each(function (i) {
	// 	   $("td:first", this).html(i + 1);
	// 	});
	// })

	// $('.order_details').on('click','tr',function() {
		
	//     // e.preventDefault();
	//     // var oThis = $(this);
	//     // var data = $(this).data('file');
	//     // $.ajax({
	//     //     type:'POST',
	//     //     url:'/backup/delete',
	//     //     data:'fileName='+data,
	//     //     success: function(data){
	//             // $(this).parents('tr').remove();

 //  		$(this).remove();
	//    	$(".row-id").each(function (i){
	//         	$(this).text(i+1);
	//     });   		
  		       
	//     //     }
	//     // },'json');
	// });

    $(".order_details a").click(function () {
    	var OnThis = $(this);
    	var order_item_id = OnThis.find("input[name=product-id]").val();
    	var modalid = OnThis.find("input[name=product-id]").attr('fff');

        $.ajax({

            type: 'GET',
			data: {	format: 'json' },
            url: host + '/admin/orders/destroy/' + order_item_id,
            success: function (data) {
                console.log(data);
		       	OnThis.closest('tr').remove();
				$('.rowdata' + modalid).each(function (i) {
				   $("td:first a", this).html(i + 1);
				});
				    var grandTotal = 0;
				 
				    $(".total" + modalid).each(function () {
				        var stval = parseFloat($(this).text());
				        grandTotal += isNaN(stval) ? 0 : stval;
				    });

				    var nn = $(".total" + modalid).length;

				    $('.orders'+modalid).text(nn);
			 	
			    	$('.grandtotal'+modalid).text(grandTotal.toFixed(2));				
	            },
	            error: function (data) {
	                console.log('Error:', data);
	            }
        });	    
    });  

    $(".view_order").click(function () {
    	var OnThis = $(this);
    	var modal_id = OnThis.attr('fff');
  //   	$('.rowdata' + modal_id).each(function (i) {
		// 	$("td:first", this).html(i + 1);
		// });
		var grandTotal = 0;
	 
	    $(".total" + modal_id).each(function () {
	        var stval = parseFloat($(this).text());
	        grandTotal += isNaN(stval) ? 0 : stval;
	    });
	 
	    $('.grandtotal' + modal_id).text(grandTotal.toFixed(2));		
    });  

	$('.modal').on('hidden.bs.modal', function () {
	    window.location.reload(true);
	})    

	// http://d2gapp.dev/admin/staff/destroy/575bdf5832d9bfdf030041a7



	// $('.staff-lists-item').on('click', '.delete-staff', function() {
	// 	alert('1');
	// 	return false;
	// 	var thisObj = $('#create_hotel_user_form .submit');
	// 	var butText = thisObj.attr('value');
	// 	thisObj.attr('disabled', 'disabled');
	// 	thisObj.attr('value', 'Submitting...');
	// 	var data =  $(this).serialize();
	// 	var url = $(this).attr('action'); 
	// 	console.log(url);
	// 	$.get( url , data , function(data) {
	// 		console.log(data.form_errors);
	// 		if( data.error === false ){
	// 			alert( data.msg );
	// 		} else {
	// 			alert( data.msg );
	// 		}
	// 	},"json");
	// 	return false;
	// });



}); // end document ready	

function fetchorders() {

	$.get( host + "/admin/neworders", function( data ) {
	  	// console.log(data.msg);
	  	$("#counter_orders").html(data.msg);
	});

}


function reloadApp(val) {
	var userid = val;
	console.log('userid : ' + userid);
    console.log('reload android app with no guest registered...');

    var content2 = {
                    'app_id' : '9c1798f0-4dbd-48e5-9170-15c4395cdc4f',
                    'contents' : {'en': 'reload app'},
                    'data' : {'reload': '2'},
                    'filters' : [
                                { "field": "tag", "key": "user_id", "relation": "=", "value": userid }
                                ],
                    'isAndroid': 'true',
                    'priority': '10',
                    '' : new Date().toString()
    };

    $.ajax({
    url: encodeURI('https://onesignal.com/api/v1/notifications'),
    type: 'POST',
    beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization', 'Basic ZTEyN2RiMGItMGFjZS00MmNkLWJiNzEtMGRiMzUwZmVlZDUz');
        xhr.setRequestHeader('Accept', '*/*');
        xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
    },
    data: JSON.stringify(content2),
    success: function (data) { console.log(JSON.stringify(data)); },
    error: function (data) { console.log(JSON.stringify(data)); },
    });
}

function feedbacksDate() {

	$( "span.feedbacks-date" ).each(function( i ) {
	var feedbacksdate = $( this ).text();
	// console.log(feedbacksdate);
	$( this ).text(moment( feedbacksdate ).fromNow());
	});

}