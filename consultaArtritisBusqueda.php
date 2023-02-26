<?php 
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
require 'conexionCancer.php';
$id = $_POST['id'];
$query= $conexionCancer->prepare("SELECT *,
artritispaciente.* ,
somatometriaartritis.*,
laboratoriosartritis.*,
clinicaartritis.*,
usghepaticoartritis.*
FROM dato_usuarioartritis 
left outer join artritispaciente on artritispaciente.id_paciente = dato_usuarioartritis.id_usuarioartritis
left outer join somatometriaartritis on somatometriaartritis.id_paciente = dato_usuarioartritis.id_usuarioartritis
left outer join laboratoriosartritis on laboratoriosartritis.id_paciente = dato_usuarioartritis.id_usuarioartritis
left outer join clinicaartritis on clinicaartritis.id_paciente = dato_usuarioartritis.id_usuarioartritis
left outer join usghepaticoartritis on usghepaticoartritis.id_paciente = dato_usuarioartritis.id_usuarioartritis
where dato_usuarioartritis.id_usuarioartritis = $id");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$dataRegistro= $query->fetch();
if($query != false){
    require 'frontend/vistaPacientesBusquedaArtritis.php';
}else{
    
}
return $dataRegistro['id'] ?? 'default value';

?>