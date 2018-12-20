$(document).ready(function(){
	console.log("one");
	$('ul.switcher li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('li').removeClass('active');
    $('div.tab-pane').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	})

})

// Appel Ajax pour se connecter
$("#loginForm").submit(function(event){
  event.preventDefault(); //prevent default action
	console.log('three');
  // var post_url = $(this).attr("action"); //get form action url
  // var request_method = $(this).attr("method"); //get form GET/POST method
	// var form_data = new FormData(this); //Creates new FormData object
  // $.ajax({
  //     url : post_url,
  //     type: request_method,
  //     data : form_data,
	// contentType: false,
	// cache: false,
	// processData:false
  // }).done(function(response){ //
  //     $("#server-results").html(response);
  // });
});

$("#testLogin").click(function() {
  alert( "zero" );
});

function test() {
	alert( "two" );
}
