"use strict";

$(function () {
  var curSlide = 0;
  var maxSlide = $('.slide').length - 1;
  var delay = 3;
  initSlider();
  changeSlide();

  function initSlider() {
    $('.slide').css('opacity', '0');
    $('.slide').eq(0).css('opacity', '1');

    for (var i = 0; i < maxSlide + 1; i++) {
      var content = $('.bullets').html();
      if (i == 0) content += '<span class="active-slider"></span>';else content += '<span></span>';
      $('.bullets').html(content);
    }
  }

  function changeSlide() {
    setInterval(function () {
      $('.slide').eq(curSlide).animate({
        'opacity': '0'
      }, 1000);
      curSlide++;
      if (curSlide > maxSlide) curSlide = 0;
      $('.slide').eq(curSlide).animate({
        'opacity': '1'
      }, 1000); //Trocar bullets da navegacao do slider!

      $('.bullets span').removeClass('active-slider');
      $('.bullets span').eq(curSlide).addClass('active-slider');
    }, delay * 2000);
  }

  $('body').on('click', '.bullets span', function () {
    var currentBullet = $(this);
    $('.slide').eq(curSlide).animate({
      'opacity': '0'
    }, 1000);
    curSlide = currentBullet.index();
    $('.slide').eq(curSlide).animate({
      'opacity': '1'
    }, 1000);
    $('.bullets span').removeClass('active-slider');
    currentBullet.addClass('active-slider');
  });
});