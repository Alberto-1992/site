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
$municipio = $dataRegistro['municipiobucal'];
$estado = $dataRegistro['estadobucal'];
require 'conexionCancer.php';

$clues = $dataRegistro['cluesbucal'];
$sql_f = $conexion2->query("SELECT unidad from hospitales where clues = '$clues'");
$rown = mysqli_fetch_assoc($sql_f);

$sql_c = $conexion2->query("SELECT id_pacientebucal, descripcioncancerpatobucal
            FROM cancerpatopatobucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM cancerpatopatobucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");

$sql_m = $conexion2->query("SELECT id_pacientebucal, descripcionviruspatobucal
            FROM viruspatobucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM viruspatobucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");


$sql_r = $conexion2->query("SELECT id_pacientebucal,descripcionhabitopatobucal
            FROM habitospersonalespatobucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM habitospersonalespatobucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");

$sql_t = $conexion2->query("SELECT id_pacientebucal,descripcionantecedentepatobucal
            FROM antecedentespersonalespatotoxicobucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM antecedentespersonalespatotoxicobucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_afd = $conexion2->query("SELECT id_pacientebucal,descripcionafectacionoral
            FROM afectacionesoralesbucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM afectacionesoralesbucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_msd = $conexion2->query("SELECT id_pacientebucal,descripcionorganorallesionado
            FROM afectaciondentalorganoorallesionado
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM afectaciondentalorganoorallesionado
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_maxisupder = $conexion2->query("SELECT id_pacientebucal,descripcionmaxisupdere
            FROM maxisupderecho
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM maxisupderecho
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_maxiinfder = $conexion2->query("SELECT id_pacientebucal,descripcionmaxinfderecho
            FROM maxinfderecho
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM maxinfderecho
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_maxsupizq = $conexion2->query("SELECT id_pacientebucal,descripcionmaxsupizquierdo
            FROM maxsupizquierdo
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM maxsupizquierdo
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_maxinfizq = $conexion2->query("SELECT id_pacientebucal,descripcionmaxinfizquierdo
            FROM maxinfizquierdo
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM maxinfizquierdo
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_tipolesion = $conexion2->query("SELECT id_pacientebucal,descripciontipolesionoral
            FROM tipolesionoral
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM tipolesionoral
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_ubicoral = $conexion2->query("SELECT id_pacientebucal,descripcionubicacionoral
            FROM ubicacionesoralesdentales
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM tipolesionoral
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_subatomico = $conexion2->query("SELECT id_pacientebucal,descripcionubicderechasubatomico
            FROM ubicacionderechasubsitioatomico
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM ubicacionderechasubsitioatomico
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_ubisupdere = $conexion2->query("SELECT id_pacientebucal,descripcionubisupdere
            FROM ubicaderemazsupdere
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM ubicaderemazsupdere
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_ubiinfdere = $conexion2->query("SELECT id_pacientebucal,descripcionubicainfdere
            FROM ubicaderemazinfdere
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM ubicaderemazinfdere
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_subizquierda = $conexion2->query("SELECT id_pacientebucal,descripcionubicizquierdasubatomico
            FROM ubicacionizquierdasubsitioatomico
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM ubicacionizquierdasubsitioatomico
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_ubiinfderecha = $conexion2->query("SELECT id_pacientebucal,descripcionubisupizquierda
            FROM ubicaderemazsupizquierda
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM ubicaderemazsupizquierda
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_ubiinfizquierda = $conexion2->query("SELECT id_pacientebucal,descripcionubicainfizquierda
            FROM ubicaderemazinfizquierda
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM ubicaderemazinfizquierda
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_tiporeconstruccion = $conexion2->query("SELECT id_pacientebucal,descripccionreconstruccionbucal
            FROM tipodereconstruccionbucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM tipodereconstruccionbucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_complicacionrt = $conexion2->query("SELECT id_pacientebucal,descripcionrtbucal
            FROM complicacionesrtbucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM complicacionesrtbucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_sitiometastasis = $conexion2->query("SELECT id_pacientebucal,descripcionmetastasisbucal
            FROM sitiometastasisbucal
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM sitiometastasisbucal
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
$sql_dosisoars = $conexion2->query("SELECT id_pacientebucal,descripcionoarsbucal
            FROM oarsdosis
            WHERE id_pacientebucal
            IN (SELECT id_pacientebucal
            FROM oarsdosis
            GROUP BY id_pacientebucal
            HAVING count(id_pacientebucal) >= 1)
            and id_pacientebucal = $id_paciente
            ORDER BY id_pacientebucal");
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
            <input type="submit" class="mandaidbucal" id="<?php echo $id_paciente ?>" value="Seguimiento" onclick="aplicarSeguimientoBucal();"> <?php } else { ?>
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

    <div class="containerr2">Datos del Paciente</div>

    <tr>
        <th id="th">CURP:</th>
        <td id="td"><?php echo $dataRegistro['curpbucal'] ?>
    </tr>

    <tr>
        <th id="th">Nombre:</th>
        <td id="td"><?php echo $dataRegistro['nombrecompletobucal'] ?>
    </tr>

    <tr>
        <th id="th">Escolaridad:</th>
        <td id="td"><?php echo $dataRegistro['escolaridadbucal'] ?>
    </tr>

    <tr>
        <th id="th">Edad:</th>
        <td id="td"><?php echo $dataRegistro['edadbucal'] ?>
    </tr>

    <tr>
        <th id="th">Sexo:</th>
        <td id="td"><?php echo $dataRegistro['sexobucal'] ?>
    </tr>
    <tr>
        <th id="th">Talla:</th>
        <td id="td"><?php echo $dataRegistro['tallabucal'] ?>
    </tr>

    <tr>
        <th id="th">Peso:</th>
        <td id="td"><?php echo $dataRegistro['pesobucal'] ?>
    </tr>

    <tr>
        <th id="th">IMC:</th>
        <td id="td"><?php echo $dataRegistro['imcbucal'] ?>
    </tr>

    <th id="th">Estado:</th>
        <td id="td"><?php echo $rows['estado'] ?></td></tr>
        <tr>
    <th id="th">Municipio:</th>
        <td id="td"><?php echo $rowsm['municipio'] ?>
    </tr>
</table>
<table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" >        
    
    <div class="containerr3">Unidad de refernecia</div>
    <tr>
        <th id="th">Referenciado:</th>  
        <td id="td"><?php echo $dataRegistro['referenciadobucal'] ?></td>
        <tr>
            <th id="th">Unidad de referencia</th>
            <td id="td"><?php echo $rown['unidad']; ?></td>
        </tr>
        </table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">Antecedentes No Patol??gicos</div>
    <tr>
        <th id="th">Exposici??n Solar:</th>
        <td id="td"><?php echo $dataRegistro['exposicionsolarbucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Comidas al d??a:</th>
        <td id="td"><?php echo $dataRegistro['comidasbucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Higiene Bucal:</th>
        <td id="td"><?php echo $dataRegistro['higienebucal'] ?></td>
    </tr>
</table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">Antecedentes Personales Patol??gicos</div>

    <tr>
        <th id="th">Toxicomanias:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_t))
{
echo '&nbsp&nbsp'.$dataReg['descripcionantecedentepatobucal'].'--'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">A??os Tabaquismo:</th>
        <td id="td"><?php echo $dataRegistro['tiempotabaquismobucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Cigarros al D??a:</th>
        <td id="td"><?php echo $dataRegistro['cigarrosaldiabucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Frecuencia Alcoholismo:</th>
        <td id="td"><?php echo $dataRegistro['frecuenciaalcoholbucal'] ?></td>
    </tr>

    <tr>
        <th id="th">H??bitos:</th>
        <td id="td"><?php while($dataRegist= mysqli_fetch_assoc($sql_r))
{
echo '&nbsp&nbsp'.$dataRegist['descripcionhabitopatobucal'].'--'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">Virus:</th>
        <td id="td"><?php while($dataRegis= mysqli_fetch_assoc($sql_m))
{
echo '&nbsp&nbsp'.$dataRegis['descripcionviruspatobucal'].'--'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">C??ncer:</th>
        <td id="td"><?php while($dataRegi= mysqli_fetch_assoc($sql_c))
{
echo '&nbsp&nbsp'.$dataRegi['descripcioncancerpatobucal'].'--'.'';} ?></td>
    </tr>
</table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">AFECTACIONES ORALES</div>

</table>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">Afectaci??n Dental</div>
    <tr>
        <th id="th">Afectaci??n oral:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_afd))
{
echo '&nbsp&nbsp'.$dataReg['descripcionafectacionoral'].'-'.'';} ?></td>
    </tr>
    <tr>
        <th id="th">??rgano Oral Lesionado:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_msd))
{
echo '&nbsp&nbsp'.$dataReg['descripcionorganorallesionado'].'-'.'';} ?></td>
    </tr>
    <tr>
        <th id="th">Maxilar Superior Derecho:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_maxisupder))
{
echo '&nbsp&nbsp'.$dataReg['descripcionmaxisupdere'].'-'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">Maxilar Inferior Derecho:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_maxiinfder))
{
echo '&nbsp&nbsp'.$dataReg['descripcionmaxinfderecho'].'-'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">Maxilar Superior Izquierdo:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_maxsupizq))
{
echo '&nbsp&nbsp'.$dataReg['descripcionmaxsupizquierdo'].'-'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">Maxilar Inferior Izquierdo:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_maxinfizq))
{
echo '&nbsp&nbsp'.$dataReg['descripcionmaxinfizquierdo'].'-'.'';} ?></td>
    </tr>
</table>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">Lesiones Orales</div>
    <tr>
        <th id="th">??Lesi??n Oral?:</th>
        <td id="td"><?php echo $dataRegistro['lesionoral'] ?></td>
    </tr>

    <tr>
        <th id="th">Tipo Tejido:</th>
        <td id="td"><?php echo $dataRegistro['tipotejido'] ?></td>
    </tr>

    <tr>
        <th id="th">Tipo Lesi??n:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_tipolesion))
{
echo '&nbsp&nbsp'.$dataReg['descripciontipolesionoral'].'-'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">Coloraci??n:</th>
        <td id="td"><?php echo $dataRegistro['coloracionbucal'] ?></td>
    </tr>
</table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">Ubicaciones orales</div>
    <tr>
            <th id="th">Ubicaci??n:</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_ubicoral))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubicacionoral'].'-'.'';} ?></td>
        </tr>
    </table>
    <!--Subdivisi??n de AFECTACIONES ORALES / UBICACI??N / UBICACI??N DERECHA-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr5">Ubicaci??n Derecha</div>
        <tr>
            <th id="th">Subsitio Anat??mico:</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_subatomico))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubicderechasubatomico'].'-'.'';} ?></td>
        </tr>

        <tr>
            <th id="th">Labios:</th>
            <td id="td"><?php echo $dataRegistro['labios'] ?></td>
        </tr>

        <tr>
            <th id="th">Lengua:</th>
            <td id="td"><?php echo $dataRegistro['lengua'] ?></td>
        </tr>

        <tr>
            <th id="th">Paladar Blando:</th>
            <td id="td"><?php echo $dataRegistro['paladarblando'] ?></td>
        </tr>
        <tr>
            <th id="th">Paladar Duro:</th>
            <td id="td"><?php echo $dataRegistro['paladarduro'] ?></td>
        </tr>
        <tr>
            <th id="th">Encia:</th>
            <td id="td"><?php echo $dataRegistro['encia'] ?></td>
        </tr>
        <tr>
            <th id="th">Encia inferior:</th>
            <td id="td"><?php echo $dataRegistro['enciainferior'] ?></td>
        </tr>
        <tr>
            <th id="th">??Est?? relacionado con un ??rgano dental?:</th>
            <td id="td"><?php echo $dataRegistro['relacionadoconorganodental'] ?></td>
        </tr>

        <tr>
            <th id="th">Maxilar Superior Derecho</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_ubisupdere))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubisupdere'].'-'.'';} ?></td>
        </tr>

        <tr>
            <th id="th">Maxilar Inferior Derecho:</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_ubiinfdere))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubicainfdere'].'-'.'';} ?></td>
        </tr>
    </table>
    <!--Subdivisi??n de AFECTACIONES ORALES / UBICACI??N / UBICACI??N IZQUIERDA-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr5">Ubicaci??n Izquierda</div>
        <tr>
            <th id="th">Subsitio Anat??mico:</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_subizquierda))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubicizquierdasubatomico'].'-'.'';} ?></td>
        </tr>

        <tr>
            <th id="th">Labios:</th>
            <td id="td"><?php echo $dataRegistro['labiosiz'] ?></td>
        </tr>

        <tr>
            <th id="th">Lengua:</th>
            <td id="td"><?php echo $dataRegistro['lenguaiz'] ?></td>
        </tr>

        <tr>
            <th id="th">Paladar Blando:</th>
            <td id="td"><?php echo $dataRegistro['paladarblandoiz'] ?></td>
        </tr>
        <tr>
            <th id="th">Paladar Duro:</th>
            <td id="td"><?php echo $dataRegistro['paladarduroiz'] ?></td>
        </tr>

        <tr>
            <th id="th">Encia:</th>
            <td id="td"><?php echo $dataRegistro['enciaiz'] ?></td>
        </tr>
        <tr>
            <th id="th">Encia inferior:</th>
            <td id="td"><?php echo $dataRegistro['enciaizinferior'] ?></td>
        </tr>
        <tr>
            <th id="th">??Est?? relacionado con un ??rgano dental?:</th>
            <td id="td"><?php echo $dataRegistro['relacionadoconorganodentaliz'] ?></td>
        </tr>

        <tr>
            <th id="th">Maxilar Superior Izquierdo</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_ubiinfderecha))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubisupizquierda'].'-'.'';} ?></td>
        </tr>

        <tr>
            <th id="th">Maxilar Inferior Izquierdo:</th>
            <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_ubiinfizquierda))
{
echo '&nbsp&nbsp'.$dataReg['descripcionubicainfizquierda'].'-'.'';} ?></td>
        </tr>
    </table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">ATENCI??N CLINICA</div>

            <tr>
                <th id="th">Fecha primer atenci??n</th>
                <td id="td"><?php echo $dataRegistro['fechaprimeratencionbucal']?></td>
            </tr>

            <tr>
                <th id="th">Estad??o Cl??nico</th>
                <td id="td"><?php echo $dataRegistro['estadoclinicobucal']?></td>
            </tr>

            <tr>
                <th id="th">Etapa Cl??nica</th>
                <td id="td"><?php echo $dataRegistro['etapaclinicabucal']?></td>
            </tr>
            <tr>
                <th id="th">Tama??o tumoral</th>
                <td id="td"><?php echo $dataRegistro['tamaniotumoralbucal']?></td>
            </tr>
            <tr>
                <th id="th">Compromiso Linf??tico Nodal</th>
                <td id="td"><?php echo $dataRegistro['compromisolinfaticobucal']?></td>
            </tr>
            <tr>
                <th id="th">Metastasis</th>
                <td id="td"><?php echo $dataRegistro['metastasisbucal']?></td>
            </tr>
            <tr>
                <th id="th">Sitio metastasis</th>
                <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_sitiometastasis))
{
echo '&nbsp&nbsp'.$dataReg['descripcionmetastasisbucal'].'-'.'';} ?></td>
            </tr>
            <tr>
                <th id="th">Calidad de vida ECOG</th>
                <td id="td"><?php echo $dataRegistro['calidadvidaecog']?></td>
            </tr>
        </table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">HISTOPATOLOG??A</div>

            <tr>
                <th id="th">Dx Histopatol??gico:</th>
                <td id="td"><?php echo $dataRegistro['dxhistopatologicobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Fecha de Reporte:</th>
                <td id="td"><?php echo $dataRegistro['fechareportebucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Tipo:</th>
                <td id="td"><?php echo $dataRegistro['tipobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Maligno:</th>
                <td id="td"><?php echo $dataRegistro['malignobucal'] ?></td>
            </tr>
        </table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">INMUNOHISTOQU??MICA</div>

            <tr>
                <th id="th">??Se realiz?? PDL?</th>
                <td id="td"><?php echo $dataRegistro['realizoinmunobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">PDL:</th>
                <td id="td"><?php echo $dataRegistro['descripcioninmunobucal'] ?></td>
            </tr>
        </table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">TRATAMIENTO</div>
            <tr>
                <th id="th">Quirurgico:</th>
                <td id="td"><?php echo $dataRegistro['quirurgicobucal'] ?></td>
            </tr>
            <tr>
                <th id="th">Tipo de Cirug??a:</th>
                <td id="td"><?php echo $dataRegistro['tipocirugiabucal'] ?></td>
            </tr>
            <tr>
                <th id="th">Maxilectomia de Infraestructura:</th>
                <td id="td"><?php echo $dataRegistro['maxilectomiadeinfraestructura'] ?></td>
            </tr>
            <tr>
                <th id="th">Lugar:</th>
                <td id="td"><?php echo $dataRegistro['lugardrmc'] ?></td>
            </tr>
            <tr>
                <th id="th">Tipo:</th>
                <td id="td"><?php echo $dataRegistro['tipodrmc'] ?></td>
            </tr>
            <tr>
                <th id="th">Nivel Cervical:</th>
                <td id="td"><?php echo $dataRegistro['nivelcervical'] ?></td>
            </tr>
            <tr>
                <th id="th">Reconstrucci??n:</th>
                <td id="td"><?php echo $dataRegistro['reconstruccionbucal'] ?></td>
            </tr>
            <tr>
                <th id="th">Tipo de Reconstrucci??n:</th>
                <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_tiporeconstruccion))
{
echo '&nbsp&nbsp'.$dataReg['descripccionreconstruccionbucal'].'-'.'';} ?></td>
            </tr>

            <tr>
                <th id="th">Radioterapia:</th>
                <td id="td"><?php echo $dataRegistro['radioterapiabucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Fecha:</th>
                <td id="td"><?php echo $dataRegistro['fecharadioterapiabucal'] ?></td>
            </tr>
            <tr>
                <th id="th">Complicaciones:</th>
                <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_complicacionrt))
{
echo '&nbsp&nbsp'.$dataReg['descripcionrtbucal'].'-'.'';} ?></td>
            </tr>

            <tr>
                <th id="th">Momento RT:</th>
                <td id="td"><?php echo $dataRegistro['momentortradiobucal'] ?></td>
            </tr>
            <tr>
                <th id="th">Dosis:</th>
                <td id="td"><?php echo $dataRegistro['dosisradiobucal']?></td>
            </tr>

            <tr>
                <th id="th">Fracciones:</th>
                <td id="td"><?php echo $dataRegistro['fraccionesradiobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">No. Fracciones:</th>
                <td id="td"><?php echo $dataRegistro['numfraccionesradiobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">T??cnica:</th>
                <td id="td"><?php echo $dataRegistro['tecnicaradiobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">OARS Dosis:</th>
                <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_dosisoars))
{
echo '&nbsp&nbsp'.$dataReg['descripcionoarsbucal'].'-'.'';} ?></td>
            </tr>

            <tr>
                <th id="th">Dosis M??xima:<br><br></th>
                <td id="td"><?php echo 'Dosis M??x Cavidad Oral: '.$dataRegistro['dosismaxcavidadoral'].' | Dosis M??x Cocleas: '.$dataRegistro['dosismaxcocleas'].' | Dosis M??x Cristalinos: '.$dataRegistro['dosismaxcristalinos'].' | Dosis M??x Es??fago: '.$dataRegistro['dosismaxesofago'].' | Dosis M??x Labios: '.$dataRegistro['dosismaxlabios'].' | Dosis M??x Laringe: '.$dataRegistro['dosismaxlaringe'].' | Dosis M??x Mandibula: '.$dataRegistro['dosismaxmandibula'].' | Dosis M??x M??dula: '.$dataRegistro['dosismaxmedula'].'<br>Dosis M??x Nervio ??ptico: '.$dataRegistro['dosismaxnerviooptico'].' | Dosis M??x Ojos: '.$dataRegistro['dosismaxojos'].' | Dosis M??x PFP: '.$dataRegistro['dosismaxpfp'].' | Dosis M??x Parotidas: '.$dataRegistro['dosismaxparotidas'].' | Dosis M??x Sublinguales: '.$dataRegistro['dosismaxsubli'].' | Dosis M??x Tallo: '.$dataRegistro['dosismaxtallo'].' | Dosis M??x Tiroides: '.$dataRegistro['dosismaxtiroides'] ?></td>
            </tr>

            <tr>
                <th id="th">Dosis Promedio:<br><br></th>
                <td id="td"><?php echo 'Dosis Prom Cavidad Oral: '.$dataRegistro['dosispromcavidadoral'].' | Dosis Prom Cocleas: '.$dataRegistro['dosispromediococlelas'].' | Dosis Prom Cristalinos: '.$dataRegistro['dosispromediocristalinos'].' | Dosis Prom Es??fago: '.$dataRegistro['dosispromedioesofago'].' | Dosis Prom Labios: '.$dataRegistro['dosispromediolabios'].' | Dosis Prom Laringe: '.$dataRegistro['dosispromediolaringe'].' | Dosis Prom Mandibula: '.$dataRegistro['dosispromediomandibula'].' | Dosis Prom M??dula: '.$dataRegistro['dosispromediomedula'].'<br>Dosis Prom Nervio ??ptico: '.$dataRegistro['dosispromedionerviooptico'].' | Dosis Prom Ojos: '.$dataRegistro['dosispromedioojos'].' | Dosis Prom PFP:'.$dataRegistro['dosispromediopfp'].' | Dosis Prom Parotidas: '.$dataRegistro['dosispromedioparotidas'].' | Dosis Prom Sublinguales: '.$dataRegistro['dosispromediosubli'].' | Dosis Prom Tallo: '.$dataRegistro['dosispromediotallo'].' | Dosis Prom Tiroides:'.$dataRegistro['dosispromediotiroides'] ?></td>
            </tr>
        </table>
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">DEFUNCI??N</div>

            <tr>
                <th id="th">??Defunci??n?:</th>
                <td id="td"><?php echo $dataRegistro['defuncionbucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Fecha Defunci??n:</th>
                <td id="td"><?php echo $dataRegistro['fechadefuncionbucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Causa:</th>
                <td id="td"><?php echo $dataRegistro['causadefuncionbucal'] ?></td>
            </tr>
        </table>
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">CASO ??XITOSO</div>

            <tr>
                <th id="th">??Caso ??xitoso?:</th>
                <td id="td"><?php echo $dataRegistro['exitosobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Respuesta al Tratamiento:</th>
                <td id="td"><?php echo $dataRegistro['respiuestatratamientobucal'] ?></td>
            </tr>

        </table>

        <script>
            function aplicarSeguimientoBucal() {
                $("#seguimientobucal").modal('show');
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
                        url: 'aplicacion/eliminarCancerbucal.php',
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