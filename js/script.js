$( document ).ready(function() {
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
