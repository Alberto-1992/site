<?php 
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
require 'conexionCancer.php';
$id = $_POST['id'];
$query= $conexionCancer->prepare("SELECT * 
FROM dato_usuariobucal
left outer join seguimientocancerbucal on seguimientocancerbucal.id_pacientebucal = dato_usuariobucal.id_bucal

where dato_usuariobucal.id_bucal = $id");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$dataRegistro= $query->fetch();
if($query != false){
    require 'frontend/vistaPacientesBusquedaLupus.php';
}else{
    
}
return $dataRegistro['id'] ?? 'default value';
?>