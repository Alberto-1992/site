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








    <!-- Primera sección "Datos del Paciente, se agregan los campos que se solicitan en el formulario -->

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
        <th id="th">Raza:</th>
        <td id="td"><?php echo $dataRegistro['razabucal'] ?>
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
<!--Finaliza Datos del Paciente-->





<!--Inicia Antecedentes NO Patológicos-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">Antecedentes No Patológicos</div>
    <tr>
        <th id="th">Exposición Solar:</th>
        <td id="td"><?php echo $dataRegistro['exposicionsolarbucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Comidas al día:</th>
        <td id="td"><?php echo $dataRegistro['comidasbucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Higiene Bucal:</th>
        <td id="td"><?php echo $dataRegistro['higienebucal'] ?></td>
    </tr>
</table>
<!--Inicia Antecedentes Personales Patológicos-->






<!--Inicia Antecedentes Personales Patológicos-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">Antecedentes Personales Patológicos</div>

    <tr>
        <th id="th">Toxicomanias:</th>
        <td id="td"><?php while($dataReg= mysqli_fetch_assoc($sql_t))
{
echo '&nbsp&nbsp'.$dataReg['descripcionantecedentepatobucal'].'--'.'';} ?></td>
    </tr>

    <tr>
        <th id="th">Años Tabaquismo:</th>
        <td id="td"><?php echo $dataRegistro['tiempotabaquismobucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Cigarros al Día:</th>
        <td id="td"><?php echo $dataRegistro['cigarrosaldiabucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Frecuencia Alcoholismo:</th>
        <td id="td"><?php echo $dataRegistro['frecuenciaalcoholbucal'] ?></td>
    </tr>

    <tr>
        <th id="th">Hábitos:</th>
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
        <th id="th">Cáncer:</th>
        <td id="td"><?php while($dataRegi= mysqli_fetch_assoc($sql_c))
{
echo '&nbsp&nbsp'.$dataRegi['descripcioncancerpatobucal'].'--'.'';} ?></td>
    </tr>
</table>
<!--FINALIZA SECCIÓN DE ANTECEDENTES PERSONALES PATOLÓGICOS-->



<!-- INCIA AFECTACIONES ORALES-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr3">AFECTACIONES ORALES</div>

</table>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">Afectación Dental</div>
    <tr>
        <th id="th">Órgano Oral Lesionado:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Maxilar Superior Derecho:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Maxilar Inferior Derecho:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Maxilar Superior Izquierdo:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Maxilar Inferior Izquierdo:</th>
        <td id="td"></td>
    </tr>
</table>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">Lesiones Orales</div>
    <tr>
        <th id="th">¿Lesión Oral?:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Tipo Tejido:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Tipo Lesión:</th>
        <td id="td"></td>
    </tr>

    <tr>
        <th id="th">Coloración:</th>
        <td id="td"></td>
    </tr>
</table>

<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
    <div class="containerr4">Ubicación</div>

    <!--Subdivisión de AFECTACIONES ORALES / UBICACIÓN / UBICACIÓN DERECHA-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr5">Ubicación Derecha</div>
        <tr>
            <th id="th">Subsitio Anatómico:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Labios:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Lengua:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Paladar Blando:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Encia:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">¿Está relacionado con un órgano dental?:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Maxilar Superior Derecho</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Maxilar Inferior Derecho:</th>
            <td id="td"></td>
        </tr>
    </table>


    <!--Subdivisión de AFECTACIONES ORALES / UBICACIÓN / UBICACIÓN IZQUIERDA-->
    <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
        <div class="containerr5">Ubicación Izquierda</div>
        <tr>
            <th id="th">Subsitio Anatómico:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Labios:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Lengua:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Paladar Blando:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Encia:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">¿Está relacionado con un órgano dental?:</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Maxilar Superior Izquierdo</th>
            <td id="td"></td>
        </tr>

        <tr>
            <th id="th">Maxilar Inferior Izquierdo:</th>
            <td id="td"></td>
        </tr>
    </table>

    <!-- FINALIZA SECCIÓN USG HEPÁTICO-->





    <!--Inicia la sección ATENCIÓN CLINICA-->
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">ATENCIÓN CLINICA</div>

            <tr>
                <th id="th">Fecha primer atención</th>
                <td id="td"><?php echo $dataRegistro['fechaprimeratencionbucal']?></td>
            </tr>

            <tr>
                <th id="th">Estadío Clínico</th>
                <td id="td"><?php echo $dataRegistro['estadoclinicobucal']?></td>
            </tr>

            <tr>
                <th id="th">Etapa Clínica</th>
                <td id="td"><?php echo $dataRegistro['etapaclinicabucal']?></td>
            </tr>
            <tr>
                <th id="th">Tamaño tumoral</th>
                <td id="td"><?php echo $dataRegistro['tamaniotumoralbucal']?></td>
            </tr>
            <tr>
                <th id="th">Compromiso Linfático Nodal</th>
                <td id="td"><?php echo $dataRegistro['compromisolinfaticobucal']?></td>
            </tr>
            <tr>
                <th id="th">Metastasis</th>
                <td id="td"><?php echo $dataRegistro['metastasisbucal']?></td>
            </tr>
            <tr>
                <th id="th">Sitio metastasis</th>
                <td id="td"><?php ?></td>
            </tr>
            <tr>
                <th id="th">Calidad de vida ECOG</th>
                <td id="td"><?php echo $dataRegistro['calidadvidaecog']?></td>
            </tr>
        </table>


        <!--Inicia la sección HISTOPATOLOGÍA-->
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">HISTOPATOLOGÍA</div>

            <tr>
                <th id="th">Dx Histopatológico:</th>
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


        <!--Inicia la sección INMUNOHISTOQUÍMICA-->
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">INMUNOHISTOQUÍMICA</div>

            <tr>
                <th id="th">¿Se realizó PDL?</th>
                <td id="td"><?php echo $dataRegistro['realizoinmunobucal'] ?></td>
            </tr>

            <tr>
                <th id="th">PDL:</th>
                <td id="td"><?php echo $dataRegistro['descripcioninmunobucal'] ?></td>
            </tr>
        </table>


        <!--Inicia la sección TRATAMIENTO-->
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">TRATAMIENTO</div>

            <tr>
                <th id="th">Quirurgico:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Tipo de Cirugía:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Maxilectomia de Infraestructura:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Lugar:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Tipo:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Nivel Cervical:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Reconstrucción:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Tipo de Reconstrucción:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Radioterapia:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Fecha:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Complicaciones:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Momento RT:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Tx Complicaciones Orales:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Dosis:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Fracciones:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">No. Fracciones:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Técnica:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">OARS Dosis:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Dosis Máxima:</th>
                <td id="td"></td>
            </tr>

            <tr>
                <th id="th">Dosis Promedio:</th>
                <td id="td"></td>
            </tr>
        </table>



        <!--Inicia la sección DEFUNCIÓN-->
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">DEFUNCIÓN</div>

            <tr>
                <th id="th">¿Defunción?:</th>
                <td id="td"><?php echo $dataRegistro['defuncionbucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Fecha Defunción:</th>
                <td id="td"><?php echo $dataRegistro['fechadefuncionbucal'] ?></td>
            </tr>

            <tr>
                <th id="th">Causa:</th>
                <td id="td"><?php echo $dataRegistro['causadefuncionbucal'] ?></td>
            </tr>
        </table>



        <!--Inicia la sección CASO ÉXITOSO-->
        <table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
            <div class="containerr3">CASO ÉXITOSO</div>

            <tr>
                <th id="th">¿Caso éxitoso?:</th>
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