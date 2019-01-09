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
		var json = {};
		json['login'] = $('#login_username')[0].value;
		json['password'] = $('#login_password')[0].value;
	  $.ajax({
	      url : 'http://192.168.33.10/gestap.io-fo/test.txt',
	      type: 'GET',
	      data : json,
	  }).done(function(result){
				if(result == true)
	      	window.location.href = "http://google.com";
				else
					alert('wrong username or password');
	  });
	});

	$("#signupForm").submit(function(event){
		event.preventDefault(); //prevent default action
		var json = {};
		json['login'] = $('#signup_username')[0].value;
		json['email'] = $('#signup_email')[0].value;
		json['password'] = $('#signup_password')[0].value;
	  $.ajax({
	      url : 'http://192.168.33.10/gestap.io-fo/test.txt',
	      type: 'GET',
	      data : json,
	  }).done(function(result){
				if(result == true)
	      	window.location.href = "http://google.com";
				else
					alert('An error occured. Please try again or contact administrator.');
	  });
	});

})
