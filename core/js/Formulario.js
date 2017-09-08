jQuery(document).ready(function () {





    jQuery("#Formulario_Cadastro_Usuario").submit(
            function ()
            {
                var endereco = jQuery("#EnderecoDeAjaxEnvioFormulario").val();
                //jQuery('form').prepend(endereco);
                var dados = jQuery('#Formulario_Cadastro_Usuario').serialize();

                /**************************************************************/
                /**************************************************************/

                var retorno = 1;

                ///console.log(endereco + "?dados=" + dados);
                endereco =endereco+"?dados="+dados

console.log(endereco);


                $.ajax({

                    //type: "post",
                    type: "get",
                    url: endereco,
                    data: {"dados": dados},
                    success: function (retorno) {
                        
                        var retorno = jQuery.parseJSON(retorno);
                        var resposta = retorno.res;
                        
                        alert("resposta "+resposta);
                        
                        console.log("x "+retorno.res);
                        
                        ///jQuery("#EnderecoDeAjaxEnvioFormulario").html("informação");
                        // var retorno = jQuery.parseJSON(retorno);

                        //var resposta = retorno.mensagem.conclusao;
                    }
                });

                /**************************************************************/
                /**************************************************************/
                ///console.log("informação " + dados);
                return false;
            }
    );






    jQuery(".more_email").click(function () {

        ///var classe = $(this).parent().children('input').attr('class');
        var cont = $(".Linha_Usuario_Email").length;

        var nome = $('#NomeDoCampoEmail').val();
        var Label = $('#LabelDoCampoEmail').val();

        var Classe = $('.Linha_Usuario_Email').children('input').attr('class');
        var PlaceHolder = $('.Linha_Usuario_Email').children('input').attr('placeholder');

        //Linha_Usuario_Email
        jQuery(".Linha_Usuario_Email").prepend("<p class='" + cont + "'>");
        jQuery(".Linha_Usuario_Email").prepend("" + Label + "<input type='email' name='" + nome + "' class='" + Classe + "' placeholder='" + PlaceHolder + "'>");
        jQuery(".Linha_Usuario_Email").prepend("</p>");
        
        /*
         $(this).parent().prepend("<p class='Linha_Usuario_Email Campo_Email_usuario" + cont + "'>");
         $(this).parent().prepend("" + Label + "<input type='email' name='" + nome + "' class='" + Classe + "' placeholder='" + PlaceHolder + "'>");
         $(this).parent().prepend("</p>");
         */

        //</p>"
    });


});
