{

  $(".menu_button").click(function () {
    $(".g-nav").toggleClass('panelactive');
  });


  $(".g-nav button").click(function() {
    $(".g-nav").removeClass('panelactive');
  });

}