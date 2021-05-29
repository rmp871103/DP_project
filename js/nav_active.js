
 $(".hot_list").on('mouseenter', function () {
    $(this).find('.hot_list_text').tab('show');
  });

  $(".hot_list").on('mouseenter', function () {
    $(".hot_list_nav").find(".active").removeClass("active");
    $(this).addClass("active");
  });

  $()