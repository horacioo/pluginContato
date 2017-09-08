<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cadastro
 *
 * @author horacio
 */
/* * ************************** */
/* * ************************** */

class cadastro {
    /*     * ****
     * colocar um comando para pegar o site e o email do administrador
     * ***** */

    private static $banco;
    public static $prefixo;
    public static $chave;
    public static $Ip;

    public static function CriaTabelas() {
        global $wpdb;
        self::$banco = $wpdb;
        self::$prefixo = $wpdb->prefix;
        self::Profissao();
        self::CriaCadastro();
        self::CriaTelefone();
        self::CriaEmail();
        self::CriaCidade();
        self::CriaEstado();
        self::CriaBairro();
        self::CriaEndereco();
        self::cadastro_telefone();
        self::CriaCadastro_email();
        self::CriaToken();
        self::cad_endereco();
        //self::CriaPagina();
    }

    private static function CriaCadastro() {
        $query = " CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_cadastro` ( `id` int(11) NOT NULL AUTO_INCREMENT, `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `login` varchar(200) NOT NULL, `senha` varchar(200) NOT NULL, `data_nascimento` datetime NOT NULL, `nome` varchar(200) NOT NULL, `rg` varchar(20) NOT NULL, `cpf` varchar(20) NOT NULL, `profissao` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `senha_key` (`senha`) USING BTREE, UNIQUE KEY `dados_key` (`rg`,`cpf`) USING BTREE, KEY `profissao_key` (`profissao`), CONSTRAINT `profissao_key` FOREIGN KEY (`profissao`) REFERENCES `" . self::$prefixo . "0_profissao` (`id`) ON DELETE CASCADE ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;";
        self::$banco->query($query);
    }

    private static function CriaTelefone() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_telefone` ( `id` int(11) NOT NULL AUTO_INCREMENT, `telefone` varchar(25) NOT NULL, PRIMARY KEY (`id`), UNIQUE 
KEY `telefone_key` (`telefone`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT; ";
        self::$banco->query($query);
    }

    private static function CriaEmail() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_email` ( `id` int(11) NOT NULL AUTO_INCREMENT, `email` varchar(200) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY 
`email` (`email`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT; ";
        self::$banco->query($query);
    }

    private static function CriaCadastro_email() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_cadastro_email` ( `cadastro` int(11) NOT NULL, `email` int(11) NOT NULL, UNIQUE KEY `cadastro_email` 
(`cadastro`,`email`), KEY `mailKey` (`email`), CONSTRAINT `cadKey` FOREIGN KEY (`cadastro`) REFERENCES `" . self::$prefixo . "0_cadastro` (`id`) ON DELETE CASCADE, CONSTRAINT 
`mailKey` FOREIGN KEY (`email`) REFERENCES `" . self::$prefixo . "0_email` (`id`) ON DELETE CASCADE ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;";
        self::$banco->query($query);
    }

    private static function CriaEstado() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_estado` ( `id` int(11) NOT NULL AUTO_INCREMENT, `estado` varchar(200) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY 
`estado` (`estado`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
        self::$banco->query($query);
    }

    private static function CriaCidade() {
        $query = " CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_cidade` ( `id` int(11) NOT NULL AUTO_INCREMENT, `cidade` varchar(200) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY 
`cidade` (`cidade`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT; ";
        self::$banco->query($query);
    }

    private static function CriaBairro() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_bairro` ( `id` int(11) NOT NULL AUTO_INCREMENT, `bairro` varchar(200) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB 
AUTO_INCREMENT=3 DEFAULT CHARSET=latin1; ";
        self::$banco->query($query);
    }

    private static function CriaEndereco() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_endereco` ( `id` int(11) NOT NULL AUTO_INCREMENT, `rua` varchar(200) NOT NULL, `numero` int(11) NOT NULL, 
`complemento` varchar(200) NOT NULL, `bairro` int(11) NOT NULL, `cidade` int(11) NOT NULL, `estado` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `Bairro_Cad_fk` 
(`bairro`), KEY `Cidade_Cad_fk` (`cidade`), KEY `Estado_Cad_Fk` (`estado`), CONSTRAINT `Bairro_Cad_fk` FOREIGN KEY (`bairro`) REFERENCES `" . self::$prefixo . "0_bairro` (`id`) ON 
DELETE CASCADE, CONSTRAINT `Cidade_Cad_fk` FOREIGN KEY (`cidade`) REFERENCES `" . self::$prefixo . "0_cidade` (`id`) ON DELETE CASCADE, CONSTRAINT `Estado_Cad_Fk` FOREIGN KEY 
(`estado`) REFERENCES `" . self::$prefixo . "0_estado` (`id`) ON DELETE CASCADE ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;";
        self::$banco->query($query);
    }

    private static function cadastro_telefone() {
        $query = " CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_cadastro_telefone` ( `cadastro` int(11) NOT NULL, `telefone` int(11) NOT NULL, UNIQUE KEY 
`cad_telefone` (`cadastro`,`telefone`), KEY `cad_cad_Key` (`telefone`), CONSTRAINT `cadTelKey` FOREIGN KEY (`cadastro`) REFERENCES `" . self::$prefixo . "0_cadastro` (`id`) ON 
DELETE CASCADE, CONSTRAINT `cad_cad_Key` FOREIGN KEY (`telefone`) REFERENCES `" . self::$prefixo . "0_telefone` (`id`) ON DELETE CASCADE ) ENGINE=InnoDB DEFAULT CHARSET=latin1 
ROW_FORMAT=COMPACT; ";
        self::$banco->query($query);
    }

    private static function Profissao() {
        $query = "CREATE TABLE IF NOT EXISTS  `" . self::$prefixo . "0_profissao` ( `id` int(11) NOT NULL AUTO_INCREMENT, `profissao` varchar(200) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `profissao` (`profissao`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        self::$banco->query($query);
    }

    private static function CriaToken() {
        $query = "CREATE TABLE IF NOT EXISTS `" . self::$prefixo . "0_token` ( `id` int(11) NOT NULL AUTO_INCREMENT, `ip` varchar(20) NOT NULL, `token` varchar(150) NOT NULL, `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";
        self::$banco->query($query);
    }

    private static function cad_endereco() {
        $query = "CREATE TABLE IF NOT EXISTS `" . self::$prefixo . "0_cad_endereco` ( `cadastro` int(11) NOT NULL, `endereço` int(11) NOT NULL, UNIQUE KEY `cad_endereco_` (`endereço`), KEY `cad_E_cadastro_Chave_` (`cadastro`), CONSTRAINT `cad_E_Endereco_Chave_` FOREIGN KEY (`endereço`) REFERENCES `" . self::$prefixo . "0_endereco` (`id`), CONSTRAINT `cad_E_cadastro_Chave_` FOREIGN KEY (`cadastro`) REFERENCES `" . self::$prefixo . "0_cadastro` (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        self::$banco->query($query);
    }

 
}
