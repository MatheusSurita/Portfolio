"use strict";

function Abrirmodal() {
  $('#abrir').on('click', function () {
    $('#modal').css('display', 'block');
  });
}

function Fecharmodal() {
  $('.close').on('click', function () {
    $('#modal').css('display', 'none');
  });
}