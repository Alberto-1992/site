<?php session_start();
    if(isset($_SESSION['usuarioAdmin'])){
        require 'frontend/artritisvista.php';
    }elseif(isset($_SESSION['artritis'])){
        require 'frontend/artritisvista.php';
    
    }else{
    header('location: index');
    }

?>