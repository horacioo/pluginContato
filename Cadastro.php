<?php

/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
  Plugin Name: Cadastro de Clientes
  Description: Modulo de administração de cliente.
  Author: Horácio
  Version: 1
  Author URI: http://planet1.com.br
 */

date_default_timezone_set('America/Sao_Paulo');


require"core/cadastro.php";
require"core/funcoes.php";


register_activation_hook(__FILE__, array('cadastro', 'CriaTabelas'));
/* --------------------------------------------------------------- */
/* --------------------------------------------------------------- */
/* --------------------------------------------------------------- */
wp_register_script("Jquery_script", plugin_dir_url(__FILE__) . "core/js/jquery.min.js");
wp_enqueue_script("Jquery_script");

wp_register_script("Form_script", plugin_dir_url(__FILE__) . "core/js/Formulario.js");
wp_enqueue_script("Form_script");

wp_register_style("bootStrap_css", "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
wp_enqueue_style("bootStrap_css");
/* --------------------------------------------------------------- */
/* --------------------------------------------------------------- */
/* --------------------------------------------------------------- */





