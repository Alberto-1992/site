<?php 
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
require 'conexionCancer.php';
$id = $_POST['id'];
$fechasegui = $_POST['fechasegui'];
$query= $conexionCancer->prepare("SELECT * 
FROM seguimientoartritis
where id_paciente = $id and fechainicioseguiartritis = '$fechasegui'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$dataRegistro= $query->fetch();
if($query != false){
    require 'frontend/vistaPacienteSeguiminetoArtritis.php';
}else{
    
}
return $dataRegistro['id'] ?? 'default value';

?>