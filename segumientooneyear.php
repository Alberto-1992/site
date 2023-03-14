<?php session_start();
    if(isset($_SESSION['usuario'])){
        require 'frontend/seguimiento1anio.php';
    }else if(isset($_SESSION['usuarioAdmin'])){
        require 'frontend/seguimiento1anio.php';
    }else if(isset($_SESSION['usuarioMedico'])){
        require 'frontend/seguimiento1anio.php';
    }else{
            header ('location: index');
    }
