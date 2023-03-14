<script src="js/enviacurp.js"></script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="css/estilosMenu.css">


<?php
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$fecha_actual = new DateTime(date('Y-m-d'));


$id_paciente = $dataRegistro['id_bucal'];
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
require 'conexionCancer.php';
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
    require 'conexionCancer.php';
    $sql_busqueda = $conexionCancer->prepare("SELECT id_pacientebucal from seguimientocancerbucal where id_pacientebucal = $id_paciente");
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
    $validaid = $validacion['id_pacientebucal'];
    if ($dataRegistro['curpbucal'] != '') {
        if ($validaid != $id_paciente) { ?>
            <a href="#" class="mandaidbucal" id="<?php echo $id_paciente ?>" onclick="modalSeguimientoLupus();">Seguimiento</a> <?php } else { ?>
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
        if (isset($_SESSION['usuarioAdmin']) or isset($_SESSION['usuarioMedico'])) { ?>
            <a href="#" onclick="editarRegistro();" id="editarregistro">Editar registro</a>
        <?php }; ?>
        <a href="#" onclick="eliminarRegistro();" id="eliminarregistro">Eliminar registro</a>
    <?php
    } ?>
</div>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">








    <!-- Primera sección "Datos del Paciente, se agregan los campos que se solicitan en el formulario -->

    <div class="containerr2">DATOS DEL PACIENTE</div>

    <tr>
        <th id="th">CURP:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">Nombre:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">Escolaridad:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">Edad:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">Sexo:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">Talla:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">Peso:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    <tr>
        <th id="th">IMC:</th>
        <td id="td"><?php echo $dataRegistro[''] ?>
    </tr>

    </tr>
</table>
<!--Finaliza Datos del Paciente-->





<!--Inicia Antecedentes NO Patológicos-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">ANTECEDENTES PERSONALES PATOLÓGICOS</div>
    <tr>
        <th id="th">Toxicomanías:</th>
        <td id="td"><?php echo $dataRegistro[''] ?></td>
    </tr>
</table>
<!--Inicia Antecedentes Personales Patológicos-->






<!--Inicia CLINICA-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">CLÍNICA</div>

    <!--Inicia ACTIVIDAD LÚPICA-->
    <table class="table table-responsive table-bordered " cellspacing="0" width="100%">
        <div class="containerr4">Actividad Lúpica</div>

        <tr>
            <th id="th">Actividad Articular:</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Actividad Cutánea:</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Actividad Hematología:</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Actividad Inmunológica:</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Actividad Neurológica:</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Actividad Renal:</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
    </table>
    <!--FINALIZA ACTIVIDAD LÚPICA-->



    <!-- INCIA AFECTACIONES ORALES-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr4">CALCULADORA SLEDAI</div>
        <tr>
            <th id="th">Convulsión</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Psicosis</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Síndrome Cerebral Orgánico</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Alteración Visual</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Trastorno De Los Nervios Craneales</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
        <tr>
            <th id="th">Dolor De Cabeza Por Lupus</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">EVC</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Vasculitis</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Artritis</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Miositis</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
        <tr>
            <th id="th">Cilindros Urinarios</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Hematuria</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Piuria</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Proteinuria</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Erupción</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
        <tr>
            <th id="th">Úlceras De Las Mucosas</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Pleuritis</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Pericarditis</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Bajo complemento (C3,C4 O Ch50 Bajo)</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Aumento de la Unión al ADN</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
        <tr>
            <th id="th">Fiebre</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Trombocitopenia</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Leucopenia</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Alopecia</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Resultado SLEDAI</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
    </table>



    <!-- INCIA LABORATORIOS-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr4">LABORATORIOS</div>

        <tr>
            <th id="th">Albumina</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">BUN</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">C3</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">C4</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Creatina</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Proteina</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Urea</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Vitamina D</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
    </table>


    <!-- INCIA BIOPSIA RENAL-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr4">LABORATORIOS</div>

        <tr>
            <th id="th">Biopsia Renal</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>

        <tr>
            <th id="th">Tipo</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
    </table>





    <!--Inicia la sección DEFUNCIÓN-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr3">DEFUNCIÓN</div>

        <tr>
            <th id="th">Defunción</th>
            <td id="td"><?php echo $dataRegistro[''] ?></td>
        </tr>
    </table>



    <?php


    require 'modals/seguimientoLupus.php';

    ?>



    <script>
        function modalSeguimientoLupus() {

            $("#seguimientolupus").modal('show');
        }


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
                        $("#tabla_resultadobus").load('consultacancerbucal.php');
                        $("#tabla_resultado").load('consultaCancerBucalBusqueda.php');

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