<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class bd {

    protected $id;
    protected $dados;

    function __construct() {
        
    }

    function Salva($dados = '', $tabela = '') {
        global $wpdb;
        $chaves = array_keys($dados);
        if (isset($dados['id']) && $tabela):
        else:
            $info;
            $var;
            foreach ($chaves as $x) {
                $info[$x] = $dados[$x];
                $var[] = "'%s'";
            }
            $wpdb->insert($tabela, $info, $var);
            echo $wpdb->last_query;
        endif;
    }

}
