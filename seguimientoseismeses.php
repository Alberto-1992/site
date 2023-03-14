<?php session_start();
    if(isset($_SESSION['usuario'])){
        require 'frontend/seguimiento6meses.php';
    }else if(isset($_SESSION['usuarioAdmin'])){
        require 'frontend/seguimiento6meses.php';
    }else if(isset($_SESSION['usuarioMedico'])){
        require 'frontend/seguimiento6meses.php';
    }else{
            header ('location: index');
    }

    ?>
