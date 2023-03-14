<script src="js/enviacurp.js"></script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="css/estilosMenu.css">
<?php
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
$fecha_actual = new DateTime(date('Y-m-d'));

$id_paciente = $dataRegistro['id'];
$id = $dataRegistro['id_pacienteinfarto'];
$municipio = $dataRegistro['municipio'];
$estado = $dataRegistro['estado'];

$sql = $conexion2->query("SELECT descripcionfrinfarto, id_pacienteinfarto
            FROM factoresriesgoinfarto
            WHERE id_pacienteinfarto
            IN (SELECT id_pacienteinfarto
        FROM factoresriesgoinfarto
            GROUP BY id_pacienteinfarto
            HAVING count(id_pacienteinfarto) >= 1)
            and id_pacienteinfarto = $id_paciente
            ORDER BY id_pacienteinfarto");
$sql_mace = $conexion2->query("SELECT descripcionmacehosp, id_pacienteinfarto
            FROM macehospinfarto
            WHERE id_pacienteinfarto
            IN (SELECT id_pacienteinfarto
        FROM macehospinfarto
            GROUP BY id_pacienteinfarto
            HAVING count(id_pacienteinfarto) >= 1)
            and id_pacienteinfarto = $id_paciente
            ORDER BY id_pacienteinfarto");

$fecha1 = new DateTime($dataRegistro['iniciosintomas']); //fecha inicial
$fecha2 = new DateTime($dataRegistro['fechaterminotrombolisis']); //fecha de cierre

$intervalo = $fecha1->diff($fecha2);

$diasDiferencia = $intervalo->format('%d days %H horas %i minutos');
$imccalculo = $dataRegistro['imcinfarto'];
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
require 'conexionCancer.php';
$sqls = $conexion2->query("SELECT * from t_estado where id_estado = $estado");
$rows = mysqli_fetch_assoc($sqls);

$sqlsm = $conexion2->query("SELECT * from t_municipio where id_municipio = $municipio");
$rowsm = mysqli_fetch_assoc($sqlsm);

?>


<div id="mensaje"></div>
<input type="hidden" id="idcurp" value="<?php echo $id_paciente; ?>">
<input type="hidden" id="infartopaciente" value="<?php echo $dataRegistro['descripcioncancer']; ?>">
<input type="hidden" id="nombrepaciente" value="<?php echo $dataRegistro['nombrecompleto']; ?>">
<div class="containerr">
    <a href="#" class="mandaid" onclick="abrirseguimiento();" id="<?php echo $id_paciente ?>">Seguimiento</a>
    <?php session_start();
    if (isset($_SESSION['usuarioAdmin']) or isset($_SESSION['usuarioMedico'])) { ?>
        <a href="#" onclick="editarRegistro();" id="editarregistro">Editar registro</a>
    <?php }; ?>
    <input type="submit" onclick="eliminarRegistro();" id="eliminarregistro" value="Eliminar registro">
</div>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr2">DATOS DEL PACIENTE</div>

    <tr>
        <th id="th">CURP</th>
        <td id="td"><?php echo $dataRegistro['curp'] ?></td>
    </tr>

    <tr>
        <th id="th">Nombre</th>
        <td id="td"><?php echo $dataRegistro['nombrecompleto'] ?></td>
    </tr>

    <tr>
        <th id="th">Población Indígena</th>
        <td id="td"><?php echo $dataRegistro['poblacionindigena'] ?></td>
    </tr>



    <tr>
        <th id="th">Estado de Residencia</th>
        <td id="td"><?php echo $rows['estado'] ?></td>
    </tr>

    <tr>
        <th id="th">Alcaldía / Municipio</th>
        <td id="td"><?php echo $rowsm['municipio'] ?></td>
    </tr>

    <tr>
        <th id="th">Escolaridad</th>
        <td id="td"><?php echo $dataRegistro['escolaridad'] ?></td>
    </tr>

    <tr>
        <th id="th">Edad</th>
        <td id="td"><?php echo $dataRegistro['edad'] ?></td>
    </tr>

    <tr>
        <th id="th">Sexo</th>
        <td id="td"><?php echo $dataRegistro['sexo'] ?></td>
    </tr>
</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">SOMATOMETRÍA</div>
    <tr>
        <th id="th">Peso</th>
        <td id="td"><?php echo $dataRegistro['pesoinfarto'] ?></td>
    </tr>
    <tr>
        <th id="th">Talla</th>
        <td id="td"><?php echo $dataRegistro['tallainfarto'] ?></td>
    </tr>
    <tr>
        <th id="th">IMC</th>
        <td id="td"><?php echo $dataRegistro['imcinfarto'] . '&nbsp' . $showimc ?></td>
    </tr>
</table>





<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <tr>
        <div class="containerr3">FACTORES RIESGO</div>

        <th id="th">Factores de Riesgo:</th>

        <td id="td"><?php while ($dataRegist = mysqli_fetch_assoc($sql)) {
                        echo '&nbsp&nbsp' . $dataRegist['descripcionfrinfarto'] . '--' . '';
                    } ?></td>

    </tr>
</table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">ATENCIÓN CLINICA</div>
    <tr>
        <th id="th">Fecha/Hora Inicio de Síntomas</th>
        <td id="td"><?php echo $dataRegistro['iniciosintomas'] ?></td>
    </tr>
    <tr>
        <th id="th">Características del Dolor</th>
        <td id="td"><?php echo $dataRegistro['caracterisiticasdolor'] ?></td>
    </tr>
    <tr>
        <th id="th">Fecha/Hora Inicio de Triage</th>
        <td id="td"><?php echo $dataRegistro['iniciotriage'] ?></td>
    </tr>
    <tr>
        <th id="th">Fecha/Hora Termino de Triage</th>
        <td id="td"><?php echo $dataRegistro['terminotriage'] ?></td>
    </tr>
    <tr>
        <th id="th">Electrocardiograma</th>
        <td id="td"><?php echo $dataRegistro['electrocardiograma'] ?></td>
    </tr>
    <tr>
        <th id="th">Localización</th>
        <td id="td"><?php echo $dataRegistro['localizacionelectro'] ?></td>
    </tr>
    <tr>
        <th id="th">Con o Sin Elevación</th>
        <td id="td"><?php echo $dataRegistro['consinelevacion'] ?></td>
    </tr>
    <tr>
        <th id="th">Mace Hospitalario</th>
        <td id="td"><?php while ($dataMace = mysqli_fetch_assoc($sql_mace)) {
                        echo '&nbsp&nbsp' . $dataMace['descripcionmacehosp'] . '--' . '';
                    } ?></td>
    </tr>
    <tr>
        <th id="th">Killip Kimball</th>
        <td id="td"><?php echo $dataRegistro['killipkimball'] ?></td>
    </tr>
</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">PARACLINICOS</div>
    <tr>
        <th id="th">CK</th>
        <td id="td"><?php echo $dataRegistro['ck'] ?></td>
    </tr>
    <tr>
        <th id="th">CK-MB</th>
        <td id="td"><?php echo $dataRegistro['ckmb'] ?></td>
    </tr>
    <tr>
        <th id="th">Troponinas</th>
        <td id="td"><?php echo $dataRegistro['troponinas'] ?></td>
    </tr>
    <tr>
        <th id="th">Glucosa</th>
        <td id="td"><?php echo $dataRegistro['glucosa'] ?></td>
    </tr>
    <tr>
        <th id="th">Urea</th>
        <td id="td"><?php echo $dataRegistro['urea'] ?></td>
    </tr>
    <tr>
        <th id="th">Creatinina</th>
        <td id="td"><?php echo $dataRegistro['creatinina'] ?></td>
    </tr>
    <tr>
        <th id="th">Colesterol</th>
        <td id="td"><?php echo $dataRegistro['colesterol'] ?></td>
    </tr>
    <tr>
        <th id="th">Trigliceridos</th>
        <td id="td"><?php echo $dataRegistro['trigliceridos'] ?></td>
    </tr>
    <tr>
        <th id="th">Ácido Úrico</th>
        <td id="td"><?php echo $dataRegistro['acidourico'] ?></td>
    </tr>
    <tr>
        <th id="th">HB Glucosilada</th>
        <td id="td"><?php echo $dataRegistro['hbglucosilada'] ?></td>
    </tr>
    <tr>
        <th id="th">Proteinas</th>
        <td id="td"><?php echo $dataRegistro['proteinas'] ?></td>
    </tr>
    <tr>
        <th id="th">Colesterol Total</th>
        <td id="td"><?php echo $dataRegistro['colesteroltotal'] ?></td>
    </tr>
    <tr>
        <th id="th">LDL</th>
        <td id="td"><?php echo $dataRegistro['ldl'] ?></td>
    </tr>
    <tr>
        <th id="th">HDL</th>
        <td id="td"><?php echo $dataRegistro['hdl'] ?></td>
    </tr>
</table>




<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">TRATAMIENTO/TROMBÓLISIS</div>
    <tr>
        <th id="th">Fibrinólisis</th>
        <td id="td"><?php echo $dataRegistro['fibrinolisis'] ?></td>
    </tr>
    <tr>
        <th id="th">Fecha/Hora inicio</th>
        <td id="td"><?php echo $dataRegistro['horainiciofibro'] ?></td>
    </tr>
    <tr>
        <th id="th">Fecha/Hora finaliza</th>
        <td id="td"><?php echo $dataRegistro['horaterminofibro'] ?></td>
    </tr>
    <tr>
        <th id="th">Tipo de Fibrinolítico</th>
        <td id="td"><?php echo $dataRegistro['tipofibrinolitico'] ?></td>
    </tr>
    <tr>
        <th id="th">¿Procedimiento Exitoso?</th>
        <td id="td"><?php echo $dataRegistro['procedimientoexitoso'] ?></td>
    </tr>
</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">ANGIOPLASTIA CORONARIA TRANSLUMINAL PERCUTANEA</div>
    <tr>
        <th id="th">Fecha/Hora</th>
        <td id="td"><?php echo $dataRegistro['fechahoraangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Tipo de Procedimiento</th>
        <td id="td"><?php echo $dataRegistro['tipoprocedimientoangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Sitio de Punción</th>
        <td id="td"><?php echo $dataRegistro['sitiopuncionangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Lesiones Coronarias</th>
        <td id="td"><?php echo $dataRegistro['lesionescoronoangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Clasificación DUKE</th>
        <td id="td"><?php echo $dataRegistro['clasificaciondukeangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Clasificación Medina</th>
        <td id="td"><?php echo $dataRegistro['clasiificacionmedinaangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Clasificación ACC/AHA</th>
        <td id="td"><?php echo $dataRegistro['clasificacionaccahaangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Severidad Sintax</th>
        <td id="td"><?php echo $dataRegistro['severidadangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Protesis Endovascular</th>
        <td id="td"><?php echo $dataRegistro['protesisendovascularangio'] ?></td>
    </tr>
    <tr>
        <th id="th">1er Generación</th>
        <td id="td"><?php echo $dataRegistro['primerageneracionangio'] ?></td>
    </tr>
    <tr>
        <th id="th">2da Generación</th>
        <td id="td"><?php echo $dataRegistro['segundageneracionangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Número de Protesis</th>
        <td id="td"><?php echo $dataRegistro['numeroprotesisangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Revascularización</th>
        <td id="td"><?php echo $dataRegistro['revascularizacionangio'] ?></td>
    </tr>
    <tr>
        <th id="th">¿Procedimiento Exitoso?</th>
        <td id="td"><?php echo $dataRegistro['procedimientoexitosoangio'] ?></td>
    </tr>
    <tr>
        <th id="th">AIRBUS</th>
        <td id="td"><?php echo $dataRegistro['airbusangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Resultado de AIRBUS</th>
        <td id="td"><?php echo $dataRegistro['esultadoairbusangio'] ?></td>
    </tr>
    <tr>
        <th id="th">OCT</th>
        <td id="td"><?php echo $dataRegistro['octangio'] ?></td>
    </tr>
</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">LITOTRICIA INTRACORONARIA</div>
    <tr>
        <th id="th">SCHOCKWAVE C2</th>
        <td id="td"><?php echo $dataRegistro['schockwaveangio'] ?></td>
    </tr>
    <tr>
        <th id="th">Resultado de SCHOCKWAVE C2</th>
        <td id="td"><?php echo $dataRegistro['resultadoairbuslito'] ?></td>
    </tr>
</table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">MARCAPASOS TEMPORAL</div>
    <tr>
        <th id="th">Marca Pasos</th>
        <td id="td"><?php echo $dataRegistro['marcapasostratamiento'] ?></td>
    </tr>
    <tr>
        <th id="th">Soporte Ventricular</th>
        <td id="td"><?php echo $dataRegistro['soporteventricular'] ?></td>
    </tr>
</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">COMPLICACIONES</div>
    <tr>
        <th id="th">Arritmia</th>
        <td id="td"><?php echo $dataRegistro['arritimia'] ?></td>
    </tr>
    <tr>
        <th id="th">Bloqueo AV</th>
        <td id="td"><?php echo $dataRegistro['bloqueoav'] ?></td>
    </tr>
    <tr>
        <th id="th">Extrasístoles Ventriculares</th>
        <td id="td"><?php echo $dataRegistro['extrasistolesventri'] ?></td>
    </tr>
</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">SEGUIMIENTO POSTPROCEDIMIENTO</div>
    <tr>
        <th id="th">Fecha de Egreso</th>
        <td id="td"><?php echo $dataRegistro['fechaegresopost'] ?></td>
    </tr>
    <tr>
        <th id="th">Causa Defunción</th>
        <td id="td"><?php echo $dataRegistro['causadefuncionpost'] ?></td>
    </tr>
    <tr>
        <th id="th">Fecha Defunción</th>
        <td id="td"><?php echo $dataRegistro['fechadefuncionpost'] ?></td>
    </tr>
</table>
</div>



<?php
require 'modals/seguimientoPaciente.php';
?>


<script>
    function abrirseguimiento() {
        $('#seguimiento').modal('show')
    }
    function eliminarRegistro() {
        var id = $("#idcurp").val();
        var infarto = $("#infartopaciente").val();
        var nombrepaciente = $("#nombrepaciente").val();
        var mensaje = confirm("el registro se eliminara");
        let parametros = {
            id: id,
            infarto: infarto,
            nombrepaciente: nombrepaciente
        }
        if (mensaje == true) {
            $.ajax({
                data: parametros,
                url: 'aplicacion/eliminarRegistroinfarto.php',
                type: 'post',
                beforeSend: function() {
                    $("#mensaje").html("Procesando, espere por favor");
                },
                success: function(response) {
                    $("#mensaje").html(response);
                    $("#tabla_resultadobus").load('consultapacientes.php');
                    $("#tabla_resultado").load('consultaPacienteBusqueda.php');

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