"use strict";

$(function () {
  $('.filtermaster ').find('input').on('change', function () {
    $('.filter form').submit();
  });
  $('.filtermaster').find('input').on('change', function () {
    $('.filter1 form').submit();
  });
  $('.addtocartform button').on('click', function (e) {
    e.preventDefault();
    var qt = parseInt($('.addqt').val());
    var action = $(this).attr('data-action');

    if (action == 'decrease') {
      if (qt - 1 >= 1) {
        qt = qt - 1;
      }
    } else if (action == 'increase') {
      qt = qt + 1;
    }

    $('input[name=qtP]').val(qt);
    $('.addqt').val(qt);
  });
  $('.images').on('click', function () {
    var url = $(this).find('img').attr('src');
    $('.imageP1').find('img').attr('src', url);
  });
});