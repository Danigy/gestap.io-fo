$( document ).ready(function() {
  /// VERIFICATION ///

  var username = sessionStorage.getItem('username');
  if(username == null)
    window.location.href = "http://192.168.33.10/gestap.io-fo/";

  // LOGOUT //

  $("#logout").click(function(){
    sessionStorage.removeItem('username');
    window.location.href = "http://192.168.33.10/gestap.io-fo/";
  });

//////////////////////////////GROUPS ANIMATION//////////////////////////////////
  $(".GroupUsers").css("display", "none");
  $(".LessonsUsers").css("display", "none");
  $(".lesson1").css("display", "none");

  $( ".Groupclick" ).on( "click", function() {
      $(".GroupUsers").css("display", "block");
      const test = $(this)[0].innerHTML;
      $(".GroupUsers h5 ")[0].innerHTML = test;
    });

  $( ".AddLessons" ).on( "click", function() {
      $(".LessonsUsers").css("display", "block");
  });

  $( ".addLesson" ).on( "click", function() {
      $(".lesson1").css("display", "block");
  });
///////////////////////////////////////////////////////////////////////////////
});
