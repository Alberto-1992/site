<?php session_start();
if (isset($_SESSION['usuarioAdmin'])) {
    require 'frontend/lupusvista.php';
} elseif (isset($_SESSION['usuarioJefe'])) {
    require 'frontend/lupusvista.php';
} elseif (isset($_SESSION['usuarioMedico'])) {
    require 'frontend/lupusvista.php';
} else {
    header('location: index');
}
