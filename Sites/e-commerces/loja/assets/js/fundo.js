$(function(){
 $('.layout').css('background-image','url(http://localhost/loja/assets/images/fundos.png)');
    $('.mobile').click(function () {
        $(this).find('ul').slideToggle();
    })

    $(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
  });

   $(document).ready(function() {
    $('#autoUidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoUidth').removeClass('cS-hiduen');
        } 
    });  
  });

});

function Abrirmodal(){
    $('#abrir').on('click',function() {
    $('#modal').css('display','block');     
});
}




function Fecharmodal(){
    $('.close').on('click',function() {
    $('#modal').css('display','none');   
    
    });
}



