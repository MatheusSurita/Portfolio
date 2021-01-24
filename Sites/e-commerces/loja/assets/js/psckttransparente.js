$(function(){

$('.efetuarCompra').on('click', function(){
  
    var id = PagSeguroDirectPayment.getSenderHash();

    var nome = $('input[name=nome]').val();
    var cpf = $('input[name=cpf]').val();
    var telefone = $('input[name=telefone]').val();

    var email = $('input[name=email]').val();
    var senha = $('input[name=senha]').val();

    var cep = $('input[name=cep]').val();
    var rua = $('input[name=rua]').val();
    var numero = $('input[name=numero]').val();
    var complemento = $('input[name=complemento]').val();
    var bairro = $('input[name=bairro]').val();
    var cidade = $('input[name=cidade]').val();
    var estado = $('input[name=estado]').val();  
    
    
    var titularCard = $('input[name=titular_cartao]').val();
    var cpftitularcard= $('input[name=cpf_titularcard]').val();
    var cartao_numero = $('input[name=cartao_numero]').val();
    var cvv = $('input[name=cartao_cvv]').val();
    var mes  = $('select[name=cartao_mes]').val();
    var ano = $('select[name=cartao_ano]').val();
    var parc = $('select[name=parc]').val();

   


    if(cartao_numero != '' && cvv != ''  && mes != ''  && ano != '' ) {
        PagSeguroDirectPayment.createCardToken({
            cardNumber:cartao_numero,
            brand:window.cardBrand,
            cvv:cvv,
            expirationMonth:mes,
            expirationYear:ano,


            success:function(r){
            window.cardToken = r.card.token;

            $.ajax({
                url:'http://localhost/loja/psckttransparente/checkout',
                type:'POST',
                data:{
                    id:id,
                    nome:nome,
                    cpf:cpf,
                    telefone:telefone,
                    email:email,
                    senha:senha,
                    cep:cep,
                    rua:rua,
                    numero:numero,
                    complemento:complemento,
                    bairro:bairro,
                    cidade:cidade,
                    estado:estado,
                    titularCard:titularCard,
                    cpftitularcard:cpftitularcard,
                    cartao_numero:cartao_numero,
                    cvv:cvv,
                    mes:mes,
                    ano:ano,
                    parc:parc,
                    cartao_token:window.cardToken,
                    },
                dataType:'json',
               success:function(json){
                    if(json.error == true){
                       alert(json.msg);
                    }else{
                    window.location.href = 'http://localhost/loja/psckttransparente/obrigado' ;
                    }
                },
                 error:function(){

                }

            })

                },
                error:function(r){

                }

        });
    }else{   
        ;
    }


});



    $('input[name=cartao_numero]').on('keyup' , function(e){
        if($(this).val().length >= 6 ) {

           PagSeguroDirectPayment.getBrand({
            cardBin: $(this).val().substring(0,6),
            success:function(r){
            window.cardBrand = r.brand.name;
            var cvvlimit = r.brand.cvvSize;

            $('input[name=cartao_cvv').attr('maxlength', cvvlimit);

            PagSeguroDirectPayment.getInstallments({
                amount:$('input[name=total]').val(),
                brand:window.cardBrand,
                success:function(r){

                    if(r.error == false){

                     var parc = r.installments[window.cardBrand];

                     var html = '';


                    for(var i in parc ){
                        var amount = parc[i].installmentAmount;
                        var optionValue = parc[i].quantity+';'+amount+';';
                         if (parc[i].interestFree == true) {
                            optionValue +='true';
                        }else{
                            optionValue +='false';
                        }
                        html += '<option value="'+optionValue+'">'+parc[i].quantity+'x de R$'+amount+'</option>';
                    }
                   
                    $('select[name=parc]').html(html);
                }
            
            

                },
                error:function(r){

                },
                complete:function(r){

                }
            })
            },
            error:function(r){
            
            }

            });

        }

    });
});