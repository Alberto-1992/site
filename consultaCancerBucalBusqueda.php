<?php 
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
require 'conexionCancer.php';
$id = $_POST['id'];
$query= $conexionCancer->prepare("SELECT *,
somatometriabucal.*,
unidadreferenciadobucal.*,
antecedentesnopatologicosbucal.*,
atencionclinicabucal.*,
histopatologiacancerbucal.*,
alcoholismotabaquismobucal.*,
inmunohistoquimicabucal.*,
casoexitosobucal.*,
defuncionbucal.*
FROM dato_usuariobucal
left outer join somatometriabucal on somatometriabucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join unidadreferenciadobucal on unidadreferenciadobucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join seguimientocancerbucal on seguimientocancerbucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join antecedentesnopatologicosbucal on antecedentesnopatologicosbucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join atencionclinicabucal on atencionclinicabucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join histopatologiacancerbucal on histopatologiacancerbucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join alcoholismotabaquismobucal on alcoholismotabaquismobucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join inmunohistoquimicabucal on inmunohistoquimicabucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join casoexitosobucal on casoexitosobucal.id_pacientebucal = dato_usuariobucal.id_bucal
left outer join defuncionbucal on defuncionbucal.id_pacientebucal = dato_usuariobucal.id_bucal
where dato_usuariobucal.id_bucal = $id");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$dataRegistro= $query->fetch();
if($query != false){
    require 'frontend/vistaPacientesBusquedaBucal.php';
}else{
    
}
return $dataRegistro['id'] ?? 'default value';

?>
