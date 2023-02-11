<script src="js/enviacurp.js"></script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="css/estilosMenu.css">
<?php
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
        $fecha_actual = new DateTime(date('Y-m-d'));
        
            $id_paciente = $dataRegistro['id'];
            $id = $dataRegistro['id_paciente'];
            $municipio = $dataRegistro['municipio'];
            $estado = $dataRegistro['estado'];
            
            $fecha1 = new DateTime($dataRegistro['iniciosintomas']);//fecha inicial
            $fecha2 = new DateTime($dataRegistro['fechaterminotrombolisis']);//fecha de cierre
            
            $intervalo = $fecha1->diff($fecha2);
            
            $diasDiferencia = $intervalo->format('%d days %H horas %i minutos');
            $imccalculo = $dataRegistro['imc'];
            $imcbajo = "IMC bajo";
            $imcok= "IMC ok";
            $imcsobre = "Sobrepeso";
            $obe1 = "Obesidad I";
            $obe2 = "Obesidad II";
            $obe3 = "<i class='lnr lnr-flag'></i>";
            $obe4 = "<i class='lnr lnr-flag'></i>";
        if($imccalculo <= 18.5 ){
            $showimc = "<span class='imcbajo'> $imcbajo";
        }elseif($imccalculo > 18.5 and $imccalculo <= 24.9 ){
            $showimc = "<span class='imcok'> $imcok";
        }elseif($imccalculo > 25 and $imccalculo <= 29.9 ){
            $showimc = "<span class='imcsobre'> $imcsobre";
        }elseif($imccalculo > 30 and $imccalculo <= 34.9 ){
            $showimc = "<span class='obesidad1'> $obe1";
        }elseif($imccalculo > 35 and $imccalculo <= 39.9 ){
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
<a href="#" class="mandaid" id="<?php echo $id_paciente ?>"
            >Seguimiento</a>
            <a href="consultaExpediente?id=<?php echo $id_paciente ?>" class="" id="expediente"
            >Expediente</a>
            <?php session_start();
                if (isset($_SESSION['usuarioAdmin']) or isset($_SESSION['usuarioMedico'])) { ?>
            <a href="#" onclick="editarRegistro();" id="editarregistro"
            >Editar registro</a>
                <?php };?>
            <a href="#" onclick="eliminarRegistro();" id="eliminarregistro"
            >Eliminar registro</a>
                </div>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">
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
        <td id="td"><?php  ?>
    </tr>

    <tr>
        <th id="th">Edad:</th>
        <td id="td"><?php echo $dataRegistro['edad'] ?>
    </tr>
    <tr>
        <th id="th">Sexo:</th>
        <td id="td"><?php echo $dataRegistro['sexo'] ?>
    </tr>
</table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">Somatometria</div>
    <tr>
        <th id="th">Peso</th>
        <td><?php echo $dataRegistro['peso'] ?></td>
    </tr>
    <tr>
        <th id="th">Talla</th>
        <td><?php echo $dataRegistro['talla'] ?></td>
    </tr>
    <tr>
        <th id="th">IMC</th>
        <td><?php echo $dataRegistro['imc'].'&nbsp'.$showimc ?></td>
    </tr>
    </table>
<table class="table table-responsive  table-bordered " cellspacing="0" width="100%">

    <div class="containerr3">Atnecion clinica</div>
    <tr>
        <th id="th">Killip Kimball</th>
        <td><?php echo $dataRegistro['killipkimball'] ?></td>
    </tr>
    <tr>
        <th id="th">Fevi</th>
        <td><?php echo $dataRegistro['fevi'] ?></td>
    </tr>
    <tr>
        <th id="th">Choque cardiogenico</th>
        <td><?php echo $dataRegistro['choquecardogenico'] ?></td>
    </tr>
    <tr>
        <th id="th">Revascularización previa</th>
        <td><?php echo $dataRegistro['revascularizacionprevia'] ?></td>
    </tr>
    <tr>
        <th id="th">Revascularización</th>
        <td><?php echo $dataRegistro['revascularizacion'] ?></td>
    </tr>
    <tr>
        <th id="th">Localización</th>
        <td><?php echo $dataRegistro['localizacion'] ?></td>
    </tr>
    <tr>
        <th id="th">Inicio de sintomas</th>
        <td><?php echo $dataRegistro['iniciosintomas'] ?></td>
    </tr>
    <tr>
        <th id="th">Inicio de triage</th>
        <td><?php echo $dataRegistro['primercontacto'] ?></td>
    </tr>
    <tr>
        <th id="th">Termino de triage</th>
        <td><?php echo $dataRegistro['puertabalon'] ?></td>
    </tr>
    <tr>
        <th id="th">Trombolisis</th>
        <td><?php echo $dataRegistro['trombolisis']; ?></td>
    </tr>
    <tr>
        <th id="th">Fecha/hora inicio trombolisis</th>
        <td><?php echo $dataRegistro['fechainiciotrombolisis']; ?></td>
    </tr>
    <tr>
        <th id="th">Fecha/hora termino trombolisis</th>
        <td><?php echo $dataRegistro['fechaterminotrombolisis']; ?></td>
    </tr>
    <tr>
        <th id="th">Tiempo inicio sintomas/finalizo trombolisis</th>
        <td style="color: red;"><?php echo $diasDiferencia; ?></td>
    </tr>
    <tr>
        <th id="th">Disección</th>
        <td><?php echo $dataRegistro['diseccion']; ?></td>
    </tr>
    <tr>
        <th id="th">IAM periprocedimiento</th>
        <td><?php echo $dataRegistro['iam_periprocedimiento']; ?></td>
    </tr>
    <tr>
        <th id="th">Complicaciones</th>
        <td><?php echo $dataRegistro['complicaciones']; ?></td>
    </tr>
    <tr>
        <th id="th">Flujo microvascular TMP</th>
        <td><?php echo $dataRegistro['flujo_microvascular_tmp'] ?></td>
    </tr>
    <tr>
        <th id="th">Fujo final TFG</th>
        <td><?php echo$dataRegistro['flujo_final_tfj'] ?></td>
    </tr>
    <tr>
        <th id="th">Trombosis definitiva</th>
        <td><?php echo $dataRegistro['trombosis_definitiva']; ?></td>
    </tr>
    <tr>
        <th id="th">Marca pasos temporal</th>
        <td><?php echo $dataRegistro['marcapasos_temporal']; ?></td>
    </tr>
    <tr>
        <th id="th">Estancia hospitalaria</th>
        <td><?php echo $dataRegistro['estancia_hospitalaria']; ?></td>
    </tr>
    <tr>
        <th id="th">Reestenosis</th>
        <td><?php echo $dataRegistro['reestenosis_instrastent']; ?></td>
    </tr>
    <tr>
        <th id="th">Reehopitalización 1 año</th>
        <td><?php echo $dataRegistro['reehospitalizacion_one_year']; ?></td>
    </tr>
    <tr>
        <th id="th">Escalas de riesgo</th>
        <td><?php echo $dataRegistro['escalas_riesgo']; ?></td>
    </tr>
    <tr>
        <th id="th">IAM tres años</th>
        <td><?php echo $dataRegistro['iam_tres_years']; ?></td>
    </tr>
    <tr>
        <th id="th">CRUC tres años</th>
        <td><?php echo $dataRegistro['cruc_tres_years']; ?></td>
    </tr>
    <tr>
        <th id="th">Defuncion</th>
        <td><?php echo $dataRegistro['defuncion']; ?></td>
    </tr>
    <tr>
        <th id="th">Causa defunción</th>
        <td><?php echo $dataRegistro['causadefuncion']; ?></td>
    </tr>

</table>
</div>


<script>
function eliminarRegistro() {
    var id = $("#idcurp").val();
    if(id == ''){
        swal({
            title: Error!',
            text: 'Seleccione un paciente a eliminar',
            icon: 'error',

            });
    }else{
    //var mensaje = confirm("el registro se eliminara")
    let parametros = {
        id: id
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
}

</script>