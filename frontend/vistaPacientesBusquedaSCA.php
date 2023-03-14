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




<!--LA MODIFICACIÓN INICIA AQUÍ-->
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
</table>


<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">TRATAMIENTO</div>
    <tr>
        <th id="th">Anticoagulantes</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Betabloqueadores</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">IECA</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

    <tr>
        <th id="th">Calcioantagonistas</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

    <tr>
        <th id="th">ARA II</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

    <tr>
        <th id="th">Estatinas</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

    <tr>
        <th id="th">Fibratos</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
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

    <div class="containerr3">VIABILIDAD Y PERFUSIÓN MIOCARDIA</div>
</table>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr4">PET</div>
    <tr>
        <th id="th">PET</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Patrón</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Segmento Match</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Segmento Mismatch</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
</table>




<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">GAMMAGRAMA CARDIACO</div>
    <tr>
        <th id="th">Gammagrama Cardiaco</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Resultado de Gammagrama Cardiaco</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Localización</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr4">Ergometría</div>
    <tr>
        <th id="th">Ergometría</th>
        <td id="td">Protocolo Bruce</td>
    </tr>

    <tr>
        <th id="th">Etapa 1</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Etapa 2</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Etapa 3</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Etapa 4</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Etapa 5</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Etapa 6</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Etapa 7</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

    <tr>
        <th id="th">Suspención de Estudio</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>

</table>



<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr4">ECOCARDIOGRAMA</div>
    <tr>
        <th id="th">Diastólico</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Sistólico</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">FEVI</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Movilidad</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Segmento</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
</table>




<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">DEFUNCIÓN</div>
    <tr>
        <th id="th">Defunción</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    <tr>
        <th id="th">Causa</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
    
</table>

<!--FINALIZA EDICIÓN-->
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