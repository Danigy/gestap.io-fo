$(document).ready(function(){
	$('ul.switcher li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('li').removeClass('active');
    $('div.tab-pane').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	})

	// Appel Ajax pour se connecter
	$("#loginForm").submit(function(event){
	  event.preventDefault(); //prevent default action
		console.log('three');
	   // var post_url = $(this).attr("action"); //get form action url
	   // var request_method = $(this).attr("method"); //get form GET/POST method
		 var json = {};
		 json['login'] = $('login_username').value();
		 json['password'] = $('login_password').value();
		 console.log('json', json);
	   $.ajax({
	       url : 'dashboard.php',
	       type: 'GET',
	       data : json,
	   }).done(function(response){ //
	       window.location.href = "http://google.com";
	   });
	});

})
