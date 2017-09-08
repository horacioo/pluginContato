<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require"bd.php";
class salvaDados extends bd{
    
    function __construct() {
        print_r($_POST);
    }
}