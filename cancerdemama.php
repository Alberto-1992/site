<?php session_start();
    if(isset($_SESSION['usuarioAdmin'])){
        require 'frontend/cancerdemamavista.php';
    }elseif(isset($_SESSION['usuarioJefe'])){
        require 'frontend/cancerdemamavista.php';
    }elseif(isset($_SESSION['residentes'])){
        require 'frontend/cancerdemamavista.php';
    }else{
    header('location: login');
    }

?>