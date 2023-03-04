<?php 
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
require 'conexionCancer.php';
$id = $_POST['id'];
$query= $conexionCancer->prepare("SELECT *, 
somatometriainfarto.*,
atencionclinicainfarto.*,
paraclinicos.*,
tratamientoinfarto.*,
angiocoronaria.*
from dato_personalinfarto 
left outer join somatometriainfarto on somatometriainfarto.id_pacienteinfarto = dato_personalinfarto.id
left outer join atencionclinicainfarto on atencionclinicainfarto.id_pacienteinfarto = dato_personalinfarto.id
left outer join paraclinicos on paraclinicos.id_paciente = dato_personalinfarto.id
left outer join tratamientoinfarto on tratamientoinfarto.id_pacienteinfarto = dato_personalinfarto.id
left outer join angiocoronaria on angiocoronaria.id_pacienteinfarto = dato_personalinfarto.id
where dato_personalinfarto.id = $id");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$dataRegistro= $query->fetch();
if($query != false){
    require 'frontend/vistaPacientesBusqueda.php';
}else{

}
return $dataRegistro['id'] ?? 'default value';
?>