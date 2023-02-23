<script src="js/enviacurp.js"></script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="css/estilosMenu.css">
<?php
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$fecha_actual = new DateTime(date('Y-m-d'));


$id_paciente = $dataRegistro['id'];
$curp = $dataRegistro['curp'];
$id = $dataRegistro['id_paciente'];
$municipio = $dataRegistro['municipio'];
$estado = $dataRegistro['estado'];
require 'conexionCancer.php';

$clues = $dataRegistro['clues'];
$sql_f = $conexion2->query("SELECT unidad from hospitales where clues = '$clues'");
$rown = mysqli_fetch_assoc($sql_f);

$sql = $conexion2->query("SELECT id_paciente, datoantecedentefamiliar
            FROM antecedentesfamiliarescancer
            WHERE id_paciente
            IN (SELECT id_paciente
            FROM antecedentesfamiliarescancer
            GROUP BY id_paciente
            HAVING count(id_paciente) >= 1)
            and id_paciente = $id_paciente
            ORDER BY id_paciente");

$sql_m = $conexion2->query("SELECT id_paciente, descripcioncancer
            FROM cancerpaciente
            WHERE id_paciente
            IN (SELECT id_paciente
            FROM cancerpaciente
            GROUP BY id_paciente
            HAVING count(id_paciente) >= 1)
            and id_paciente = $id_paciente
            ORDER BY id_paciente");


$sql_r = $conexion2->query("SELECT id_paciente, descripcionantecedente
            FROM antecedentespatopersonales
            WHERE id_paciente
            IN (SELECT id_paciente
            FROM antecedentespatopersonales
            GROUP BY id_paciente
            HAVING count(id_paciente) >= 1)
            and id_paciente = $id_paciente
            ORDER BY id_paciente");

$sql_q = $conexion2->query("SELECT id_quirurgico, realizoquirurgico, lateralidad, tipo, curpusuario 
            FROM quirurgico 
            WHERE curpusuario
            IN (SELECT curpusuario FROM quirurgico
            GROUP BY curpusuario
            HAVING count(curpusuario) >= 1)
            and curpusuario = '$curp'
            ORDER BY curpusuario");







//$fecha1 = new DateTime($dataRegistro['iniciosintomas']);//fecha inicial
// $fecha2 = new DateTime($dataRegistro['fechaterminotrombolisis']);//fecha de cierre

//$intervalo = $fecha1->diff($fecha2);

// $diasDiferencia = $intervalo->format('%d days %H horas %i minutos');
$imccalculo = $dataRegistro['imc'];
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
require '../esclerosis/conexion.php';
$sqls = $conexion2->query("SELECT * from t_estado where id_estado = $estado");
$rows = mysqli_fetch_assoc($sqls);

$sqlsm = $conexion2->query("SELECT * from t_municipio where id_municipio = $municipio");
$rowsm = mysqli_fetch_assoc($sqlsm);



?>

<div id="mensaje"></div>
<input type="hidden" id="idcurp" value="<?php echo $id_paciente; ?>">
<input type="hidden" id="cancer" value="<?php echo $dataRegistro['descripcioncancer']; ?>">
<input type="hidden" id="nombrepaciente" value="<?php echo $dataRegistro['nombrecompleto']; ?>">
<div class="containerr">
    <?php

    $sql_busqueda = $conexionCancer->prepare("SELECT id_paciente from seguimientoartritis where id_paciente = $id_paciente");
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
    $validaid = $validacion['id_paciente'];
    if ($dataRegistro['curp'] != '') {
        if ($validaid != $id_paciente) { ?>
            <a href="#" class="mandaid" id="<?php echo $id_paciente ?>">Seguimiento</a> <?php } else { ?>
            <input type="hidden" value="<?php echo $id_paciente ?>" id="seguimiento">
            <a href="#" onclick="seguimiento();" style="color: blue;">
                Ver seguimiento</a>
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
        </script>
        <?php session_start();
                if (isset($_SESSION['usuarioAdmin']) or isset($_SESSION['usuarioMedico'])) { 
                    if($dataRegistro['editopaciente'] == 0 ) {?>
                    
            <input type="submit" onclick="editarRegistro();" id="editarregistro" value="Editar registro">
                <?php }else{ ?>
                    <input type="submit" onclick="finalizarEdicion();" id="editarregistro" value="Finalizar Edicion">

                <?php }
            };?>
            <input type="submit" onclick="eliminarRegistro();" id="eliminarregistro" value="Eliminar registro">
            <?php
    }?>
                </div>
                <style>
                    .table:hover {
                            background: #EBEBEB;
                    }
                </style>
</div>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">



    <!-- Primera sección "Datos del Paciente, se agregan los campos que se solicitan en el formulario -->

    <div class="containerr2">Datos del Paciente</div>

    <tr>
        <th id="th">CURP:</th>
        <td id="td"><?php echo $dataRegistro['curp'] ?>
    </tr>

    <tr>
        <th id="th">Nombre:</th>
        <td id="td"><?php echo $dataRegistro['nombrecompleto'] ?>
    </tr>

    <tr>
        <th id="th">Escolaridad:</th>
        <td id="td"><?php echo $dataRegistro['escolaridad'] ?>
    </tr>

    <tr>
        <th id="th">Edad:</th>
        <td id="td"><?php echo $dataRegistro['edad'] ?>
    </tr>
    <tr>
        <th id="th">Sexo:</th>
        <td id="td"><?php echo $dataRegistro['sexo'] ?>
    </tr>

    <tr>
        <th id="th">Talla:</th>
        <td id="td"><?php echo $dataRegistro['talla'] ?>
    </tr>

    <tr>
        <th id="th">Peso:</th>
        <td id="td"><?php echo $dataRegistro['peso'] ?>
    </tr>

    <tr>
        <th id="th">IMC:</th>
        <td id="td"><?php echo $dataRegistro['imc'] ?>
    </tr>
    </tr>
</table>
<!--Finaliza Datos del Paciente-->





<!--Inicia Antecedentes Personales Patológicos-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">Antecedentes Personales Patológicos</div>
    <tr>
        <th id="th">Antecedentes Personales Patológicos:</th>
        <td id="td"><?php  ?></td>
    </tr>
</table>
<!--Inicia Antecedentes Personales Patológicos-->






<!--Inicia LABORATORIOS-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">Laboratorios</div>

    <tr>
        <th id="th">Plaquetas:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">FR Basal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">FR Nominal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">PCR:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">Vitamina D Basal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">Vitamina D Nominal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">AC Anticpp Basal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">AC Anticpp Nominal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">VSG:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">TGO Basal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">TGO Nominal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">TGP Basal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">TGP Nominal:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">Glucosa:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">Colesterol:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">Trigliceridos:</th>
        <td id="td">
    </tr>
</table>
<!--FINALIZA SECCIÓN DE LABORATORIOS-->





<!-- INCIA SECCIÓN USG HEPÁTICO-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">USG HEPÁTICO</div>

    <tr>
        <th id="th">USG Hepático:</th>
        <td></td>
    </tr>

    <tr>
        <th id="th">Hallazgo USG:</th>
        <td id="td">
    </tr>

    <tr>
        <th id="th">Clasificación Cirrosis:</th>
        <td id="td">
    </tr>
</table>
<!-- FINALIZA SECCIÓN USG HEPÁTICO-->






<!-- INCIA SECCIÓN CLINICA-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">CLINICA</div>

    <tr>
        <th id="th">Articulaciones Inflamadas SJC28:</th>
        <td id="td"><?php  ?></td>
    </tr>

    <tr>
        <th id="th">Articulaciones Dolorosas TJC28:</th>
        <td id="td"><?php ?></td>
    </tr>

    <tr>
        <th id="th">Evaluación Global PGA:</th>
        <td id="td"><?php ?></td>
    </tr>

    <tr>
        <th id="th">Evaluación del Evaluador EGA:</th>
        <td id="td"><?php ?></td>
    </tr>

    <tr>
        <th id="th">RESULTADO CDAI:</th>
        <td id="td"><?php ?></td>

        <!-- Aquí se debe hacer un calculo con base en los valores de los campos de la sección CLINICA, la formula es: 
            CDAI = SJC28 + TJC28 + PGA + EGA
            El resultado debe clasificarse en uno de los siguientes rubros:
            * <2.8,	remision
            * 2.8 - 10,	actividad de enfermedad baja
            * 10 - 222,	actividad de enfermedad moderada
            * >22,	actividad de enfermedad alta
        -->
    </tr>

    <tr>
        <th id="th">RESULTADO SDAI:</th>
        <td id="td"><?php ?></td>
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
        <td id="td"><?php ?></td>
    </tr>
    <tr>
        <th id="th">Leflunomide:</th>
        <td id="td"><?php  ?></td>
    </tr>
    <tr>
        <th id="th">Sulfazalasina:</th>
        <td id="td"><?php  ?></td>
    </tr>
    <tr>
        <th id="th">Tocoferol:</th>
        <td id="td"><?php  ?></td>
    </tr>
    <tr>
        <th id="th">Glucocorticoide:</th>
        <td id="td"><?php ?></td>
    </tr>
    <tr>
        <th id="th">Vitamina D:</th>
        <td id="td"><?php ?></td>
    </tr>
    <tr>
        <th id="th">Biológico:</th>
        <td id="td"><?php ?></td>
    </tr>
    <tr>
        <th id="th">Apego a Tratamiento:</th>
        <td id="td"><?php ?></td>
    </tr>
</table>
<!-- INICIA SECCIÓN TRATAMIENTO -->




<script>
    function eliminarRegistro() {
        var id = $("#idcurp").val();
        var cancer = $("#cancer").val();
        var nombrepaciente = $("#nombrepaciente").val();
        var mensaje = confirm("el registro se eliminara");
        let parametros = {
            id: id,
            cancer: cancer,
            nombrepaciente: nombrepaciente
        }
        if (mensaje == true) {
            $.ajax({
                data: parametros,
                url: 'aplicacion/eliminarRegistroCancer.php',
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
</script>