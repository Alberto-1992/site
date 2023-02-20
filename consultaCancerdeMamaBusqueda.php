<?php 
error_reporting(0);
date_default_timezone_set('America/Monterrey');
require 'conexionCancer.php';
$id = $_POST['id'];
$query= $conexionCancer->prepare("SELECT *, 
antecedentesgineco.menarca, antecedentesgineco.ultimamestruacion, antecedentesgineco.cuentacon, antecedentesgineco.gestas, antecedentesgineco.parto, antecedentesgineco.aborto, 
antecedentesgineco.cesarea, antecedentesgineco.embarazada, antecedentesgineco.fpp, antecedentesgineco.terapiareemplazohormonal, antecedentesgineco.lactancia, antecedentesgineco.tiempolactancia, antecedentesgineco.id_paciente,
signosvitales.frecuenciacardiaca, signosvitales.presionarterial, signosvitales.talla, signosvitales.peso, signosvitales.imc,
atencionclinica.fechaatencioninicial,atencionclinica.biradsreferencia,atencionclinica.biradshraei,atencionclinica.lateralidadmama,atencionclinica.estadioclinico,atencionclinica.etapaclinica,atencionclinica.tamaniotumoral,
atencionclinica.compromisolenfatico,atencionclinica.metastasis,atencionclinica.calidaddevidaecog,atencionclinica.mastectoextrainstituto,atencionclinica.lateralidadmastectoextrainstituto,atencionclinica.fechamastectoextrainstituto,
histopatologia.*,
histopatoregionganglioderecha.*,
histopatologiaizquierda.*,
histopatoregionganglionariz.*,
inmunohistoquimica.*,
inmunohistoquimicargd.*,
inmunohistoquimicaiz.*,
inmunohistoquimicargiz.*,
cancerpaciente.descripcioncancer,
radioterapia.aplicoradio,
tiporadioterapia.*,
quimioterapia.*,
braquiterapia.*,
seguimientocancer.*,
unidadreferenciado.*,
defencionpaciente.*,
molecular.*,
molecularrgd.*,
molecularizquierda.*,
molecularrgiz.*
FROM dato_usuario 
left outer join antecedentesgineco on antecedentesgineco.id_paciente = dato_usuario.id
left outer join signosvitales on signosvitales.id_paciente = dato_usuario.id
left outer join atencionclinica on atencionclinica.id_usuario = dato_usuario.id
left outer join histopatologia on histopatologia.id_usuario = dato_usuario.id
left outer join histopatoregionganglioderecha on histopatoregionganglioderecha.id_paciente = dato_usuario.id
left outer join histopatologiaizquierda on histopatologiaizquierda.id_paciente = dato_usuario.id
left outer join histopatoregionganglionariz on histopatoregionganglionariz.id_paciente = dato_usuario.id
left outer join inmunohistoquimica on inmunohistoquimica.id_usuario = dato_usuario.id
left outer join inmunohistoquimicargd on inmunohistoquimicargd.id_paciente = dato_usuario.id
left outer join inmunohistoquimicaiz on inmunohistoquimicaiz.id_usuario = dato_usuario.id
left outer join inmunohistoquimicargiz on inmunohistoquimicargiz.id_paciente = dato_usuario.id
left outer join cancerpaciente on cancerpaciente.id_paciente = dato_usuario.id
left outer join radioterapia on radioterapia.id_paciente = dato_usuario.id
left outer join tiporadioterapia on tiporadioterapia.id_radio = radioterapia.id_radio
left outer join quimioterapia on quimioterapia.id_paciente = dato_usuario.id
left outer join braquiterapia on braquiterapia.id_paciente = dato_usuario.id
left outer join seguimientocancer on seguimientocancer.id_paciente = dato_usuario.id
left outer join unidadreferenciado on unidadreferenciado.id_paciente = dato_usuario.id
left outer join defencionpaciente on defencionpaciente.id_paciente = dato_usuario.id
left outer join molecular on molecular.id_paciente = dato_usuario.id
left outer join molecularrgd on molecularrgd.id_paciente = dato_usuario.id
left outer join molecularizquierda on molecularizquierda.id_paciente = dato_usuario.id
left outer join molecularrgiz on molecularrgiz.id_paciente = dato_usuario.id
where dato_usuario.id = $id");
$query->execute();
$dataRegistro= $query->fetch();
if($query != false){
    require 'frontend/vistaPacientesBusquedaCancer.php';
}else{
    
}
return $dataRegistro['id'] ?? 'default value';

?>