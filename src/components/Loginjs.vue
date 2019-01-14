<script>
$(document).ready(function() {
  // Switch between login and signup
  $('ul.switcher li').on("click", function() {
    var tab_id = $(this).attr('data-tab')
    $('li').removeClass('active')
    $('div.tab-pane').removeClass('active')

    $(this).addClass('active')
    $("#" + tab_id).addClass('active')
  })

  // Appel Ajax pour se connecter
  $("#loginForm").submit(function(event) {
    event.preventDefault() //prevent default action
    var json = {}
    json['email'] = $('#login_email')[0].value
    json['password'] = $('#login_password')[0].value
    $.ajax({
      url: 'http://vps.quentinmodena.fr:2999/users/login',
      type: 'POST',
      data: json,
    }).done(function(result) {
      if (result.code == 200) {
        sessionStorage.setItem('email', json['email'])
        window.location.href = 'dashboard'
      } else {
        alert('Wrong username or password')
      }
    })
  })

  // Appel Ajax pour s'inscrire
  $("#signupForm").submit(function(event) {
    event.preventDefault() //prevent default action
    var json = {}
    json['firstname'] = $('#signup_firstname')[0].value
    json['lastname'] = $('#signup_lastname')[0].value
    json['email'] = $('#signup_email')[0].value
    json['password'] = $('#signup_password')[0].value
    json['birthday'] = null
    json['rfid'] = null
    json['admin'] = 1
    $.ajax({
      url: 'http://ebcitakademy.alwaysdata.net/users/add',
      type: 'POST',
      data: json,
    }).done(function(result) {
      if (result.code === 200) {
        sessionStorage.setItem('email', json['email'])
        window.location.href = 'dashboard'
      } else {
        alert('An error occured. Please try again or contact administrator.')
      }
    })
  })
})
</script>
