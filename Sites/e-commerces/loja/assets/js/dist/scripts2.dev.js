"use strict";

$(function () {
  $('.filtermaster ').find('input').on('change', function () {
    $('.filter form').submit();
  });
  $('.filtermaster').find('input').on('change', function () {
    $('.filter1 form').submit();
  });
});