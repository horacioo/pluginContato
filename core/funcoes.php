<?php
$tempo = "20";
global $wpdb;
$prefixo = $wpdb->prefix;





/*****************************/
/*****************************/

    
    



    
/***********************************/
add_shortcode('usuario_id', 'idfcn');
function idfcn($atts,$content){
    global $prefixo; 
      
    $value="";
    $id="";
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    return "<input type='hidden'  name=".$prefixo."0_cadastro[id] $id $value>";
}
/***********************************/

    
    
    












/***********************************/
add_shortcode('usuario_form', 'CadFormfcn');

function CadFormfcn($atts,$content){
 if($_POST){
     require"SalvaDados.php";
     $sd = new salvaDados();
 }
 else{
        global $prefixo; 
        $class="";
        $titulo="";
        if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
        if(isset($atts['titulo'])){$titulo= "<h2>".$atts['titulo']."</h2>";}
        global $wpdb;
        $x="<form action='' enctype=\"multipart/form-data\"  method='post' id='Formulario_Cadastro_Usuario' $classe name=Cadastro[".$prefixo."0_cadastro][]>";"<hr>";
        $x.="\n<input type='hidden' name=token value='".CriaToken()."'>";
        $x.="\n<input type='hidden' name=Prefixo value='".$wpdb->prefix."'>";
        $x.="<input type='hidden' id='EnderecoDeAjaxEnvioFormulario' value='". get_site_url()."/recebe_dados_formulario_usuario_'>";
        $x.=$titulo;
        $x.= do_shortcode($content);
        $x.="</form>";
        return $x;
 }
 
 
 }
/***********************************/
 function CriaToken(){
     global $wpdb;
     $IP = $_SERVER['REMOTE_ADDR'];
     $token = hash('sha512',$IP.microtime());
     $token =  substr($token, 0,149);
     $wpdb->insert(
             $wpdb->prefix."0_token",
             array('ip'=>$IP,'token'=>$token),
             array('%s','%s')             
             );
     $del="delete from ".$wpdb->prefix."0_token where data < '".date("Y-m-d H:i:s", strtotime("-".$tempo." MINUTES"))."'";
     $wpdb->query($del);
     return $token;
 }
 
 
 
 
 
 
 
 
 
 
 
 
 
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 function VerificaToken(){
     global $wpdb;
      $prefixo = $wpdb->prefix; 
      $token   = $_POST['chave']['usuario'];
      $IP      = $_SERVER['REMOTE_ADDR'];
      $select ="select id,data from ".$prefixo."0_token where token='$token' and ip='$IP' order by data asc";
      $resultado = $wpdb->get_row($select,ARRAY_A);
      $id = $resultado['id'];
      if(isset($id) && $id > 0){
            $data = strtotime($resultado['data']);
            $agora = time();
            $TempoPassado = $agora - $data;
            $TempoPassado = $TempoPassado/60;
            $TempoPassado = round($TempoPassado,0);
            if($TempoPassado < 20)
                { echo"salva -  $TempoPassado";}
                else
                { echo "rejeita $TempoPassado";}
      }
 }
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 /****************************************************************/
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
/***********************************/
add_shortcode('usuario_nome', 'Nomefcn');
function Nomefcn($atts,$content){
    global $prefixo; 
    
    /*******************/
    $placeholder="";
    $classe="";
    $value="";
    $id="";
    $label="Nome: ";
    /*******************/
    
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if($content!=""){$value="value = '$content'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    return "<p>$label<input type='text' $classe $placeholder name= Usuario[".$prefixo."0_cadastro][nome] $id $value></p>";
}
/***********************************/















/***********************************/
add_shortcode('usuario_data_nascimento', 'Datafcn');
function Datafcn($atts,$content){
 global $prefixo;
 
  $label="Data de Nascimento: ";
  if(isset($atts['label'])){$label=$atts['label'];}
 
 return "<p>$label<input type='date' $classe $placeholder name=Usuario[".$prefixo."0_cadastro][data] $id $value></p>";
}
/***********************************/












/***********************************/
add_shortcode('usuario_login', 'Loginfcn');
function Loginfcn($atts,$content){
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $value="";
    $id="";
    $label="Login: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if($content!=""){$value="value = '$content'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    return "<p>$label<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_cadastro][login] $id $value></p>";
}
/***********************************/










/***********************************/
add_shortcode('usuario_senha', 'Senhafcn');
function Senhafcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Senha: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    return "<p>$label<input type='password' $classe $placeholder name=Usuario[".$prefixo."0_cadastro][senha] $id></p>";
}
/***********************************/
    











/***********************************/
add_shortcode('usuario_rg', 'Rgfcn');
function Rgfcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Rg: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    return "<p>$label<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_cadastro][rg] $id></p>";
}
/***********************************/





/***********************************/
add_shortcode('usuario_cpf', 'cpffcn');
function cpffcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Cpf: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    return "<p>$label<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_cadastro][cpf] $id></p>";
}
/***********************************/




/***********************************/
add_shortcode('usuario_profissao', 'Profissaofcn');
function Profissaofcn($atts,$content){
    
    global $wpdb;
    global $prefixo; 
    
    $classe="";
    $id="";
    $label="Profissão: ";
      
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    
    $select="<p>$label";
    $select.="<select name=Usuario[".$prefixo."0_cadastro][profissao]>";
    $select.="<option value='0'>selecione uma profissão</option>";
    $resultado = $wpdb->get_results("select * from ".$prefixo."0_profissao order by profissao asc", ARRAY_A);
        foreach ($resultado as $r):
        $select.="<option value='".$r['id']."'>".$r['profissao']."</option>";
        endforeach;
    $select.="</select>";
    $select.="</p>";
    return $select;
}
/***********************************/















/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------tabela email------------------------*/
/***********************************/
add_shortcode('usuario_email', 'Emailfcn');
function Emailfcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="E-mail: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    /**************************************/
    
    /**************************************/
    $email =  "<input type='hidden' id='NomeDoCampoEmail'  value='Usuario[".$prefixo."0_email][email][]'>";
    $email.=  "<input type='hidden' id='LabelDoCampoEmail' value='".$label."'>";
    /*------------------------------------*/
    $email.=  "<p class='Linha_Usuario_Email'>";
    $email.=  "$label";
    $email.=  "<input type='email' $classe $placeholder name=Usuario[".$prefixo."0_email][email][] $id>";
    $email.=  "</p>";
    $email.=  "<p><small class='more_email'>Adicionar email</small></p>";
    return $email;
}
/***********************************/








/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*----------------------------------------------------------*/
/*--------------------tabela telefone-----------------------*/
/***********************************/
add_shortcode('usuario_telefone', 'Telfcn');
function Telfcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Telefone: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    $telefone =  "<p>";
    $telefone.=  "$label";
    /***Usuario[".$prefixo."0_email]***/
    $telefone.=  "<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_telefone][telefone][] $id>";
    $telefone.=  "<small class='more_telefone'>Adicionar telefone</small></p>";
    return $telefone;
}
/***********************************/





/***********************************/
add_shortcode('usuario_rua', 'Ruafcn');
function Ruafcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Endereço: ";
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    $rua =  "<p>";
    $rua.=  "$label";                                                  
    $rua.=  "<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_endereco][rua] $id >";
    $rua.=  "</p>";
    return $rua;
}
/***********************************/




/***********************************/
add_shortcode('usuario_numero', 'numerofcn');
function numerofcn($atts,$content){
    global $prefixo; 
    $placeholder="";
    $classe="";
    $id="";
    $label="Numero: ";
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    $rua =  "<p>";
    $rua.=  "$label";
    $rua.=  "<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_endereco][numero] $id>";
    $rua.=  "</p>";
    return $rua;
}
/***********************************/







/***********************************/
add_shortcode('usuario_bairro', 'Bairrofcn');
function Bairrofcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Bairro: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    $bairro =  "<p>";
    $bairro.=  "$label";
    
                                                            //Usuario[".$prefixo."0_endereco][numero]
    $bairro.=  "<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_endereco][bairro] $id>";
    $bairro.=  "</p>";
    return $bairro;
}
/***********************************/






/***********************************/
add_shortcode('usuario_complemento', 'Complementofcn');
function Complementofcn($atts,$content){
  
    global $prefixo; 
    
    $placeholder="";
    $classe="";
    $id="";
    $label="Complemento: ";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    $comple =  "<p>";
    $comple.=  "$label";
                                                          // Usuario[".$prefixo."0_endereco][numero]
    $comple.=  "<input type='text' $classe $placeholder name=Usuario[".$prefixo."0_endereco][complemento] $id>";
    $comple.=  "</p>";
    return $comple;
}
/***********************************/




/***********************************/
add_shortcode('usuario_cidade', 'Cidadefcn');
function Cidadefcn($atts,$content){
    
    global $wpdb;
    global $prefixo; 
    
    $classe="";
    $id="";
    $label="Cidade: ";
      
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    
    $select="<p>$label";
                          //Usuario[".$prefixo."0_endereco][numero]
    $select.="<select name=Usuario[".$prefixo."0_endereco][cidade]>";
    $resultado = $wpdb->get_results("select * from ".$prefixo."0_cidade order by cidade asc", ARRAY_A);
        foreach ($resultado as $r):
        $select.="<option value='".$r['id']."'>".$r['cidade']."</option>";
        endforeach;
    $select.="</select>";
    $select.="</p>";
    return $select;
}
/***********************************/






/***********************************/
add_shortcode('usuario_estado', 'estadofcn');
function estadofcn($atts,$content){
    
    global $wpdb;
    global $prefixo; 
    
    $classe="";
    $id="";
    $label="Estado: ";
      
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    
    $select="<p>$label";
    $select.="<select name=Usuario[".$prefixo."0_endereco][cidade]>";
    $resultado = $wpdb->get_results("select * from ".$prefixo."0_estado order by estado asc", ARRAY_A);
        foreach ($resultado as $r):
        $select.="<option value='".$r['id']."'>".$r['estado']."</option>";
        endforeach;
    $select.="</select>";
    $select.="</p>";
    return $select;
}
/***********************************/






/***********************************/
add_shortcode('usuario_form_btn', 'btnfcn');
function btnfcn($atts,$content){
        
   
    $classe="";
    $value="value='salvar'";
    $id="";
    $label="";
       
    if(isset($atts['placeholder'])){$placeholder="placeholder ='".$atts['placeholder']."'";}
    if(isset($atts['class'])){$classe="class='".$atts['class']."'";}
    if(isset($atts['value'])){$value="value = '".$atts['value']."'";}
    if(isset($atts['id'])){$id="id='".$atts['id']."'";}
    if(isset($atts['label'])){$label="<label>".$atts['label']."</label>";}
    
    $btn =  "<p>";
    $btn.=  "<input type='submit' $classe $id $value>";
    $btn.=  "</p>";
  
    return $btn;
}
/***********************************/




if(isset($_POST)){
    if(isset($_POST['chave'])){ VerificaToken(); }
}




   /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */

   


    function CriaPagina() {
        $arquivo_nome = TEMPLATEPATH . "/page-Recebe_dados_formulario_usuario_.php";
        if (file_exists($arquivo_nome)) {
            
        } else {
            $x = fopen($arquivo_nome, "w+");
            fwrite($x, " ");
            fwrite($x, "[carrega_formulario]");
            fwrite($x, "");
            
            
            $conteudo="<?php ?>";
            
            fclose($x);
            /*             * ***************************** */
            wp_insert_post(
                    Array(
                        "post_title" => "Recebe_dados_formulario_usuario_",
                        "post_content" => "",
                        "post_type" => "page",
                        "post_name" => "Recebe_dados_formulario_usuario_",
                        "post_status" => "publish"
                    )
            );
        }
    }

    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */