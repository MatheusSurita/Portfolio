"use strict";

$(document).ready(function () {
  $('#autoWdth').lightSlider({
    autoWidth: true,
    loop: true,
    onSliderLoad: function onSliderLoad() {
      $('#autoWidth').removeClass('cS-hidden');
    }
  });
});