<?php

$dados = $_REQUEST['Usuario'];
$chave = $_REQUEST['chave'];
$prefixo = $_REQUEST['Prefixo'];
global $wpdb;

    global $wpdb;
    $query = "select data,ip,token from " . $prefixo . "0_token where ip='" . $_SERVER['REMOTE_ADDR'] . "'";
    echo $query;
    $wpdb->query($query, ARRAY_A);

