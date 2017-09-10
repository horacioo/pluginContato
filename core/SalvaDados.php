<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require"bd.php";

class salvaDados extends bd {

    protected $dadosUsuario;
    protected $dadosEmail;
    protected $dadosTelefone;
    protected $dadosEndereco;
    protected $chave;
    protected $array;
    protected $token;
    protected $Prefixo;
    protected $informacao_email;

    function __construct() {
        global $wpdb;
        $info = $_POST;
        
        $prefixo = $wpdb->prefix;
        $this->Prefixo = $wpdb->prefix;
        $this->token = $_POST['token'];
        $this->Prefixo = $_POST['Prefixo'];
        $this->dadosUsuario = $_POST['Usuario'][$prefixo . '0_cadastro'];
        $this->dadosEmail = $_POST['Usuario'][$prefixo . '0_email'];
        $this->dadosTelefone = $_POST['Usuario'][$prefixo . '0_telefone'];
        $this->dadosEndereco = $_POST['Usuario'][$prefixo . '0_endereco'];

        $this->SalvaUsuarios();
        $this->SalvaEmail();
        $this->SalvaTelefone();
        $this->SalvaEndereco();
    }

    private function SalvaUsuarios() {
        if($this->dadosUsuario['profisao'] < 1){$this->dadosUsuario['profissao']=1;}
        $this->Salva($this->dadosUsuario,$this->Prefixo."0_cadastro");
    }

    private function SalvaEmail() {
        echo"<br>";
        //print_r($this->dadosEmail);
    }

    private function SalvaTelefone() {
        echo"<br>";
        //print_r($this->dadosTelefone);
    }

    private function SalvaEndereco() {
        echo"<br>";
        //print_r($this->dadosEndereco);
    }

}
