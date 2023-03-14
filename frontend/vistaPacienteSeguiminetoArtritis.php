<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="css/estilosMenu.css">
<?php
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$fecha_actual = new DateTime(date('Y-m-d'));


$id_paciente = $dataRegistro['id_paciente'];
$curp = $dataRegistro['curpseguiart'];
$id = $dataRegistro['id_paciente'];

require 'conexionCancer.php';

//$fecha1 = new DateTime($dataRegistro['iniciosintomas']);//fecha inicial
// $fecha2 = new DateTime($dataRegistro['fechaterminotrombolisis']);//fecha de cierre

//$intervalo = $fecha1->diff($fecha2);

// $diasDiferencia = $intervalo->format('%d days %H horas %i minutos');
$imccalculo = $dataRegistro['imcaeguiart'];
$imcbajo = "IMC bajo";
$imcok = "IMC ok";
$imcsobre = "Sobrepeso";
$obe1 = "Obesidad I";
$obe2 = "Obesidad II";
$obe3 = "<i class='lnr lnr-flag'></i>";
$obe4 = "<i class='lnr lnr-flag'></i>";
if ($imccalculo <= 18.5) {
    $showimc = "<span class='imcbajo'> $imcbajo";
} elseif ($imccalculo > 18.5 and $imccalculo <= 24.9) {
    $showimc = "<span class='imcok'> $imcok";
} elseif ($imccalculo > 25 and $imccalculo <= 29.9) {
    $showimc = "<span class='imcsobre'> $imcsobre";
} elseif ($imccalculo > 30 and $imccalculo <= 34.9) {
    $showimc = "<span class='obesidad1'> $obe1";
} elseif ($imccalculo > 35 and $imccalculo <= 39.9) {
    $showimc = "<span class='obesidad2'> $obe2";
}

$cdaicalculo = $dataRegistro['resultadocdaiseguiart'];
$cdairemision = "Remision";
$cdaibaja= "Baja";
$cdaimoderada = "Moderada";
$cdaialta = "Alta";

if($cdaicalculo <= 2.8 ){
$cdai = "<span class='imcbajo'> $cdairemision";
}elseif($cdaicalculo >= 2.9 and $cdaicalculo <= 10 ){
$cdai = "<span class='imcok'> $cdaibaja";
}elseif($cdaicalculo > 11 and $cdaicalculo <= 22 ){
$cdai = "<span class='imcsobre'> $cdaimoderada";
}elseif($cdaicalculo > 23 ){
$cdai = "<span class='obesidad1'> $cdaialta";
}

$sdaicalculo = $dataRegistro['resultadosdaiseguiart'];
$sdairemision = "Remision";
$sdaibaja= "Baja";
$sdaimoderada = "Moderada";
$sdaialta = "Alta";

if($sdaicalculo <= 3.3 ){
$sdai = "<span class='imcbajo'> $sdairemision";
}elseif($sdaicalculo >= 3.4 and $sdaicalculo <= 11 ){
$sdai = "<span class='imcok'> $sdaibaja";
}elseif($sdaicalculo >= 12 and $sdaicalculo <= 26 ){
$sdai = "<span class='imcsobre'> $sdaimoderada";
}elseif($sdaicalculo > 27 ){
$sdai = "<span class='obesidad1'> $sdaialta";
}


?>

<div id="mensaje"></div>
<input type="hidden" id="idcurp" value="<?php echo $id_paciente; ?>">
<input type="hidden" id="artritispaciente" value="<?php echo $dataRegistro['descripcion_artritis']; ?>">
<input type="hidden" id="nombrepaciente" value="<?php echo $dataRegistro['nombrecompleto']; ?>">
<div class="containerr">
    <?php

    $sql_busqueda = $conexionCancer->prepare("SELECT id_paciente from seguimientoartritis where id_paciente = $id_paciente");
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
    $validaid = $validacion['id_paciente'];
    if ($dataRegistro['curpseguiart'] != '') {
        if ($validaid != $id_paciente) { ?>
            <input type="submit" class="mandaidartritis" id="<?php echo $id_paciente ?>" value="Seguimiento" onclick="aplicarSeguimientoArtritis();"> <?php } else { ?>
            <input type="hidden" value="<?php echo $id_paciente ?>" id="seguimiento">
        <?php } ?>
        <script>
            function seguimiento() {

                let id = $("#seguimiento").val();

                let ob = {
                    id: id
                };
                $.ajax({
                    type: "POST",
                    url: "consultaCancerdeMamaBusquedaSeguimiento.php",
                    data: ob,
                    beforeSend: function() {

                    },
                    success: function(data) {

                        $("#tabla_resultado").html(data);

                    }
                });

            };
            function buscarseguimiento() {
                let fechasegui = $("#seguimientos").val();
                let id = $("#idcurp").val();
                let ob = {
                    id:id, fechasegui:fechasegui
                };
                $.ajax({
                    type: "POST",
                    url: "consultaSeguimientosArtritis.php",
                    data: ob,
                    beforeSend: function() {

                    },
                    success: function(data) {

                        $("#tabla_resultado").html(data);

                    }
                });
                
            }
        </script>
        <?php session_start();
                if (isset($_SESSION['usuarioAdmin']) or isset($_SESSION['usuarioMedico']) or isset($_SESSION['artritis'])) { 
                    if($dataRegistro['editopacienteseguimiento'] == 0 ) {?>
            
           <input type="submit" onclick="editarRegistro();" id="editarregistro" value="Editar registro">
                <?php }else{ ?>
                    <input type="submit" onclick="finalizarEdicion();" id="editarregistro" value="Finalizar Edicion">

                <?php }
            };?>
            <select id="seguimientos" name="seguimientos" onchange="buscarseguimiento();">
                <option value="Ver seguimientos">Ver seguimientos</option>
            <?php 
				    require 'conexionCancer.php';
				        $query = $conexionCancer->prepare("SELECT DISTINCT fechainicioseguiartritis FROM seguimientoartritis where id_paciente = $id_paciente order by fechainicioseguiartritis desc");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['fechainicioseguiartritis']; ?>">
                                                <?php echo $row['fechainicioseguiartritis']; ?></option>
                                            <?php } ?>
                                        </select>
            <!--<input type="submit" onclick="eliminarRegistro();" id="eliminarregistro" value="Eliminar registro">-->
            <?php
    }?>
                </div>
                <style>
                    .table:hover {
                            background: #EBEBEB;
                    }
                </style>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopacienteseguimiento'] == 1 ) { ?> onclick="editarfechaseguimiento();" <?php } }else if(isset($_SESSION['artritis'])) { if($dataRegistro['editopacienteseguimiento'] == 1 ) { ?> onclick="editarfechaseguimiento();" <?php } }?>>

<input type="hidden" id="fechainicioseguimiento" value="<?php echo $dataRegistro['fechainicioseguiartritis'] ?>">
<input type="hidden" id="idartritis" value="<?php echo $dataRegistro['id_seguimientoartritis'] ?>">

    <!-- Primera sección "Datos del Paciente, se agregan los campos que se solicitan en el formulario -->

    <div class="containerr2">Datos del Paciente</div>
    <tr>
        <th id="th">Fecha de inicio de seguimiento:</th>
        <td id="td"><?php echo $dataRegistro['fechaseguimiento'] ?></td>
    </tr>
    <tr>
        <th id="th">CURP:</th>
        <td id="td"><?php echo $dataRegistro['curpseguiart'] ?></td>
    </tr>
    <tr>
        <th id="th">Talla:</th>
        <td id="td"><?php echo $dataRegistro['tallaseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Peso:</th>
        <td id="td"><?php echo $dataRegistro['pesoartsegui'] ?></td>
    </tr>

    <tr>
        <th id="th">IMC:</th>
        <td id="td"><?php echo $dataRegistro['imcseguiart'].'&nbsp'; if($id_paciente != ''){ echo $showimc;}?></td>
    </tr>
    </tr>
</table>
<!--Finaliza Datos del Paciente-->

<!--Inicia LABORATORIOS-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editarlaboratoriosartritis();" <?php } }else if(isset($_SESSION['artritis'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editarlaboratoriosartritis();" <?php } }?>>
    <div class="containerr3">Laboratorios</div>

    <tr>
        <th id="th">Plaquetas:</th>
        <td id="td"><?php echo $dataRegistro['plaquetasseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">FR Basal:</th>
        <td id="td"><?php echo $dataRegistro['frbasalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">FR Nominal:</th>
        <td id="td"><?php echo $dataRegistro['frnominalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">PCR:</th>
        <td id="td"><?php echo $dataRegistro['pcrseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Vitamina D Basal:</th>
        <td id="td"><?php echo $dataRegistro['vitaminadbasalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Vitamina D Nominal:</th>
        <td id="td"><?php echo $dataRegistro['vitaminadnominalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">AC Anticpp Basal:</th>
        <td id="td"><?php echo $dataRegistro['anticppbasalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">AC Anticpp Nominal:</th>
        <td id="td"><?php echo $dataRegistro['anticppnominalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">VSG:</th>
        <td id="td"><?php echo $dataRegistro['vsgseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">TGO Basal:</th>
        <td id="td"><?php echo $dataRegistro['tgobasalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">TGO Nominal:</th>
        <td id="td"><?php echo $dataRegistro['tgonominalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">TGP Basal:</th>
        <td id="td"><?php echo $dataRegistro['tgpbasalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">TGP Nominal:</th>
        <td id="td"><?php echo $dataRegistro['tgpnominalseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Glucosa:</th>
        <td id="td"><?php echo $dataRegistro['glucosaseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Colesterol:</th>
        <td id="td"><?php echo $dataRegistro['colesterolseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Trigliceridos:</th>
        <td id="td"><?php echo $dataRegistro['trigliceridosseguiart'] ?></td>
    </tr>
    <tr>
        <th id="th">FIB 4:</th>
        <td id="td"><?php echo $dataRegistro['fib4seguiart'] ?></td>
    </tr>
    <tr>
        <th id="th">Resultado fib 4:</th>
        <td id="td"><?php echo $dataRegistro['resultadofib4seguiart'] ?></td>
    </tr>
</table>
<!--FINALIZA SECCIÓN DE LABORATORIOS-->





<!-- INCIA SECCIÓN USG HEPÁTICO-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="artritisusghepatic();" <?php } }else if(isset($_SESSION['artritis'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="artritisusghepatic();" <?php } }?>>
    <div class="containerr3">USG HEPÁTICO</div>

    <tr>
        <th id="th">USG Hepático:</th>
        <td id="td"><?php echo $dataRegistro['detalleusghepaticoseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Hallazgo USG:</th>
        <td id="td"><?php echo $dataRegistro['hallazgousgseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Clasificación Cirrosis:</th>
        <td id="td"><?php echo $dataRegistro['clasificacionesteatosisseguiart'] ?></td>
    </tr>
</table>
<!-- FINALIZA SECCIÓN USG HEPÁTICO-->






<!-- INCIA SECCIÓN CLINICA-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">CLINICA</div>

    <tr>
        <th id="th">Articulaciones Inflamadas SJC28:</th>
        <td id="td"><?php echo $dataRegistro['articulacionesinflamadassjc28seguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Articulaciones Dolorosas TJC28:</th>
        <td id="td"><?php echo $dataRegistro['articulacionesdolorosastjc28seguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Evaluación Global PGA:</th>
        <td id="td"><?php echo $dataRegistro['evglobalpgaseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">Evaluación del Evaluador EGA:</th>
        <td id="td"><?php echo $dataRegistro['evegaseguiart'] ?></td>
    </tr>

    <tr>
        <th id="th">RESULTADO CDAI:</th>
        <td id="td"><?php echo $dataRegistro['resultadocdaiseguiart'].'&nbsp'; if($id_paciente != ''){ echo $cdai;}?></td>

        <!-- Aquí se debe hacer un calculo con base en los valores de los campos de la sección CLINICA, la formula es: 
            CDAI = SJC28 + TJC28 + PGA + EGA
            El resultado debe clasificarse en uno de los siguientes rubros:
            * <2.8,	remision
            * 2.8 - 10,	actividad de enfermedad baja
            * 10 - 22,	actividad de enfermedad moderada
            * >22,	actividad de enfermedad alta
        -->
    </tr>

    <tr>
        <th id="th">RESULTADO SDAI:</th>
        <td id="td"><?php echo $dataRegistro['resultadosdaiseguiart'].'&nbsp'; if($id_paciente != ''){ echo $sdai;}?></td>
        <!-- Aquí se debe hacer un calculo con base en la siguiente formula:
            SDAI = CDAI + PCR 
            (EL CAMPO PCR ESTÁ EN LA SECCIÓN LABORATORIOS)
            Donde:
            * < 3.3,    REMISION
            * 3.3 - 11, ACTIVIDAD BAJA
            * 11 - 26, 	ACTIVIDAD MODERADA
            * >26,  	ACTIVIDAD ALTA
        -->
    </tr>

</table>
<!-- FINALIZA SECCIÓN USG HEPÁTICO-->






<!-- INICIA SECCIÓN TRATAMIENTO -->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">TRATAMIENTO</div>

    <!-- En los siguientes campos se deberá recuperar la dosis del medicamento-->
    <tr>
        <th id="th">Metrotexate:</th>
        <td id="td"><?php echo $dataRegistro['metrotexateseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Dosis Metrotexate:</th>
        <td id="td"><?php echo $dataRegistro['dosissemanalmetroseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Leflunomide:</th>
        <td id="td"><?php  echo $dataRegistro['leflunomideseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Dosis Leflunomide:</th>
        <td id="td"><?php  echo $dataRegistro['dosissemanalfemuaseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Sulfazalasina:</th>
        <td id="td"><?php  echo $dataRegistro['sulfazalasinaseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Dosis Sulfazalasina:</th>
        <td id="td"><?php  echo $dataRegistro['dosissemanalsulfaseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Tocoferol:</th>
        <td id="td"><?php  echo $dataRegistro['tecoferolseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Dosis Tocoferol:</th>
        <td id="td"><?php  echo $dataRegistro['dosissemanaltecoseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Glucocorticoide:</th>
        <td id="td"><?php echo $dataRegistro['glucocorticoideseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Tratamiento:</th>
        <td id="td"><?php echo $dataRegistro['usghepaticoseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Dosis Tratamiento:</th>
        <td id="td"><?php echo $dataRegistro['dosissemanaltrataseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Vitamina D:</th>
        <td id="td"><?php echo $dataRegistro['vitaminadseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Dosis Vitamina D:</th>
        <td id="td"><?php echo $dataRegistro['dosissemanalvitadseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Biológico:</th>
        <td id="td"><?php echo $dataRegistro['biologicoseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Tratamiento Biológico:</th>
        <td id="td"><?php echo $dataRegistro['tratamientobiologicoseguiart']?></td>
    </tr>
    <tr>
        <th id="th">Apego a Tratamiento:</th>
        <td id="td"><?php echo $dataRegistro['apegotratamientoseguiart']?></td>
    </tr>
</table>
<!-- INICIA SECCIÓN TRATAMIENTO -->
<?php

require 'modals/edicionArtritis.php';
require 'modals/seguimientoArtritis.php';

?>



<script>
    
    function editarRegistro(){
        var id = $("#idartritis").val();
    var artritis = $("#artritispaciente").val();
    var valor = 1;
    var nombrepaciente = $("#nombrepaciente").val();
    var mensaje = confirm("Desea continuar con la edición de los datos");
    let parametros = {
        id: id, artritis:artritis, valor:valor, nombrepaciente:nombrepaciente
    }
            if(mensaje == true){
                $.ajax({
            data: parametros,
            url: 'aplicacion/editarRegistroArtritisseguimeinto.php',
            type: 'post',
            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#idcurp").val();
                                                let fechasegui = $("#fechainicioseguimiento").val();
                                                let ob = {
                                                            id: id, fechasegui:fechasegui
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaSeguimientosArtritis.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            
                                                            
                                                            }
                                                            
                                                    });
                                                
                                            }
        });
            }else{
                alert('proceso cancelado')
            }
    }
    function finalizarEdicion(){
        var id = $("#idcurp").val();
    var artritis = $("#artritispaciente").val();
    var valor = 0;
    var nombrepaciente = $("#nombrepaciente").val();
    var mensaje = confirm("Desea finalizar con la edición de los datos");
    let parametros = {
        id: id, artritis:artritis, valor:valor, nombrepaciente:nombrepaciente
    }
            if(mensaje == true){
                $.ajax({
            data: parametros,
            url: 'aplicacion/editarRegistro.php',
            type: 'post',
        
            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#idcurp").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaArtritisBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            
                                                            
                                                            }
                                                            
                                                    });
                                                
                                            }
        });
            }else{
                alert('proceso cancelado')
            }
    }
    function eliminarRegistro() {
        var id = $("#idcurp").val();
        var artritis = $("#artritispaciente").val();
        var nombrepaciente = $("#nombrepaciente").val();
        var mensaje = confirm("el registro se eliminara");
        let parametros = {
            id: id,
            artritis: artritis,
            nombrepaciente: nombrepaciente
        }
        if (mensaje == true) {
            $.ajax({
                data: parametros,
                url: 'aplicacion/eliminarRegistroArtritis.php',
                type: 'post',
                beforeSend: function() {
                    $("#mensaje").html("Procesando, espere por favor");
                },
                success: function(response) {
                    $("#mensaje").html(response);
                    $("#tabla_resultadobus").load('consultaArtritis.php');
                    $("#tabla_resultado").load('consultaArtritisBusqueda.php');

                }
            });
        } else {
            swal({
                title: 'Cancelado!',
                text: 'Proceso cancelado',
                icon: 'warning',

            });
        }
    }
function aplicarSeguimientoArtritis() {
    $("#seguimientoArtritis").modal('show');
}
function editardatospersonales() {
    $("#artritisdatospersonales").modal('show');
}
function editarantecedentespato() {
    $("#artritisantecedentespato").modal('show');
}
function editarlaboratoriosartritis() {
    $("#artritislaboratorios").modal('show');
}
function artritisusghepatic() {
    $("#artritisusghepatico").modal('show');
}
function editarfechaseguimiento() {
        $("#edicionfechaseguimiento").modal('show');
    }
</script>

