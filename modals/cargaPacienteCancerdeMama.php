<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerdeMama">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="js/getCatalogos.js"></script>
    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="js/scriptModalvalidacionCancerMama.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
<style>
    #datos_paciente{
        display: block;
        font-family: arial;
        
        font-size: 22px;

        /*animation: typing 2s steps(18),
        blink .5s infinite step-end alternate;
        overflow: hidden;*/
    }


   .form-title{
        display: block;
        font-family: arial;
       /* white-space: nowrap;*/
        
        width: 100%;
        font-size: 28px;
        text-align: center; color:blueviolet; background-color:antiquewhite; 
        margin-top: 5px;
        /*animation: typing 2s steps(18),
        blink .5s infinite step-end alternate;
        overflow: hidden; */
    }
    strong{
        font-family: arial;
        font-size: 13px;
        /*white-space: nowrap;*/ 
    }
    #inmuno-title{
        font-family: arial;
        font-size: 13px;
    }
   
    #titulos{
        font-size: 14px;
    }
    .control{
        border: .5px solid grey;
        border-radius: 5px 5px 5px 5px;
        outline: none;
        font-size: 11px;
        color: black;
    }

</style>
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                <span class="material-symbols-outlined">
                    person_add
                </span>

                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
             
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                            <div class="form-header">
                                <h3 class="form-title"
                                    >
                                    FICHA DE DATOS</h3>

                            </div>

                            <form name="formulario" id="formulario" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formulario").on("submit", function(e) {
                                            if($('input[name=curp]').val().length == 0 || $(
                                                'input[name=nombrecompleto]')
                                            .val().length == 0 || $('select[name=cbx_estado]').val().length == 0
                                        ) {
                                            alert('Ingrese los datos requeridos');

                                            return false;
                                            
                                        }
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formulario"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarpacienteCancer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);

                                            }
                                        })
                                    })
                                    </script>
                                    
                                    <div class="col-md-6" autocomplete="off">

                                        <input id="year" name="year" class="form-control" type="hidden" value="2022"
                                            required="required" readonly>
                                    </div>
                                    <div class="col-md-12">

                                        <input id="cest" name="cest" type="hidden" class="form-control" value="cest">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>CURP</strong>
                                        <input list="curpusuario" id="curp" name="curp" type="text" class="control col-md-12" value=""
                                            onblur="curp2date();" minlength="18" maxlength="18" required onkeypress="return soloLetras(event);" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">
                                            <datalist id="curpusuario">
                                            <option value="">Seleccione</option>
                                            <?php 
                                            require 'conexionCancer.php';
				        $query = $conexionCancer->prepare("SELECT curp FROM dato_usuario ");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['curp']; ?>">
                                                <?php echo $row['curp']; ?></option>
                                            <?php } ?>

                                        </datalist>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Nombre Completo</strong>
                                        <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdad();"
                                            type="text" class="control control col-md-12" value="" required>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Población indigena</strong>
                                        <select name="poblacionindigena" id="poblacionindigena" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                   
                                    <div class="col-md-3">
                                        <strong>Discapacidad</strong>
                                        <select name="discapacidad" id="discapacidad" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Escolaridad</strong>
                                        <select id="escolaridad" name="escolaridad" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				    require 'conexionInfarto.php';
				        $query = $conexionCancer->prepare("SELECT id_escolaridad, gradoacademico FROM escolaridad");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['gradoacademico']; ?>">
                                                <?php echo $row['gradoacademico']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Fecha de nacimiento</strong>
                                        <input id="fecha" name="fecha" type="date" value="" onblur="curp2date();"
                                            class="control control col-md-12" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Edad</strong>
                                        <input id="edad" name="edad" type="text" class="control control col-md-12" value="" readonly>
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Sexo</strong>
                                        <input type="text" class="control control col-md-12" id="sexo" onclick="curp2date();"
                                            name="sexo" readonly>

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Raza</strong>
                                        <input type="text" class="control control col-md-12" id="raza" onclick="curp2date();"
                                            name="raza" value="Sin registro">

                                    </div>
                                    <!--
                                    <div class="col-md-3">
                                        <strong>Frecuencia cardiaca</strong>
                                        <input type="text" class="control control col-md-12" id="frecuenciacardiaca"
                                            name="frecuenciacardiaca">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Presión arterial</strong>
                                        <input type="text" class="control control col-md-12" id="presionarterial"
                                            name="presionarterial">

                                    </div>
                                    -->
                                    <script>
                                        /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#talla').mask('0.00');
                                    });
                                    </script>
                                    <div class="col-md-2">
                                        <strong>Talla</strong>
                                        <input type="number" step="any" class="control control col-md-12" id="talla" name="talla"
                                            required>

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Peso</strong>
                                        <input type="number" step="any" class="control control col-md-12" id="peso"
                                            onblur="calculaIMC();" name="peso" required>

                                    </div>
                                    <div class="col-md-2">
                                        <strong>IMC</strong>
                                        <input type="text" class="control control col-md-12" id="imc" onblur="calculaIMC();"
                                            name="imc" value="" readonly>

                                    </div>

                                    <div class="col-md-6">
                                        <strong>Estado de residencia</strong>

                                        <select name="cbx_estado" id="cbx_estado" class="control control col-md-12"
                                            style="width: 100%;" required>
                                            <option value="Sin registro" selected>Sin registro</option>
                                            <?php 
				    require '../esclerosis/conexion.php';
				  $query = "SELECT id_estado, estado FROM t_estado ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['id_estado']; ?>">
                                                <?php echo $row['estado']; ?></option>
                                            <?php } ?>

                                            <!--<option value="1">Otro</option>-->

                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <strong>Delegación o Municipio</strong>
                                        <select name="cbx_municipio" id="cbx_municipio" class="control control col-md-12"
                                            style="width: 100%;">

                                        </select>
                                    </div>
                                    <div class="col-md-6" >
                                        <strong>Referenciado</strong>
                                        <select name="referenciado" id="referenciado" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="medioreferencia">
                                        <strong>Unidad referencia</strong>
                                        <input list="referencias" name="unidadreferencia" id="unidadreferencia"
                                            class="control control col-md-12">
                                        <datalist id="referencias">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT clues, unidad FROM hospitales");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['clues']; ?>">
                                                <?php echo $row['unidad']; ?></option>
                                            <?php } ?>

                                        </datalist>
                                    </div>
                                    <div class="col-md-12"></div>
                                 

                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES HEREDOFAMILIARES</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Cancer</strong>
                                        <select name="tipodecancer" id="tipodecancer" class="control control col-md-12">
                                            <option value="Sin antecedentes">Sin antecedentes</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6" id="familiarescancer">
                                        <strong>Familiar(es)</strong>
                                        <select id="mscancer" name="mscancer[]" multiple="multiple"
                                            class="control control col-md-12">
                                            <optgroup style="margin-left: 5px;" label="Cancer de mama">
                                                <option value="Madre CM">Madre</option>
                                                <option value="Hermana CM">Hermana</option>
                                                <option value="Abuela materna CM">Abuela materna</option>
                                                <option value="Abuela paterna CM">Abuela paterna</option>
                                                <option value="Tia paterna CM">Tia paterna</option>
                                                <option value="Tia materna CM">Tia materna</option>
                                                <option value="Prima paterna CM">Prima paterna</option>
                                                <option value="Prima materna CM">Prima materna</option>
                                    </optgroup>
                                            <optgroup label="Cancer de ovario">
                                                <option value="Madre CO">Madre</option>
                                                <option value="Hermana CO">Hermana</option>
                                                <option value="Abuela materna CO">Abuela materna</option>
                                                <option value="Abuela paterna CO">Abuela paterna</option>
                                                <option value="Tia paterna CO">Tia paterna</option>
                                                <option value="Tia materna CO">Tia materna</option>
                                                <option value="Prima paterna CO">Prima paterna</option>
                                                <option value="Prima materna CO">Prima materna</option>
                                            
                                    </optgroup>
                                        </select>
                                    </div>
                                    

                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES GINECOOBSTETRICOS</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Menarca</strong>
                                        <input type="text" class="control control col-md-12" id="menarca" name="menarca">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Ultima menstruación</strong>
                                        <input type="date" class="control control col-md-12" id="fechaultimamestruacion"
                                            name="fechaultimamestruacion" onblur="calcularmestruacion();">

                                    </div>
                                    <div class="col-md-3" id="menopauperimenopau">
                                        <strong>Cuenta con:</strong>
                                        <input type="text" class="control control col-md-12" id="menopausea" name="menopausea"
                                            readonly>

                                    </div>

                                    <div class="col-md-2">
                                        <strong>Gestas</strong>
                                        <select name="gestas" id="gestas" class="control control col-md-12" >
                                            <option value="0">Ninguna</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" id="partoid">
                                        <strong>Paras</strong>
                                        <input type="number" class="control control col-md-12" id="parto" onblur="validaparto();"
                                            name="parto" >

                                    </div>
                                    <div class="col-md-2" id="abortoid">
                                        <strong>Aborto</strong>
                                        <input type="number" class="control control col-md-12" id="aborto" onblur="validaparto();"
                                            name="aborto" >

                                    </div>
                                    <div class="col-md-2" id="cesareaid">
                                        <strong>Cesarea</strong>
                                        <input type="number" class="control control col-md-12" id="cesarea" onblur="validaparto();"
                                            name="cesarea" >

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Esta embarazada</strong>
                                        <select name="embarazada" id="embarazada" class="control control col-md-12" >
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                    

                                        </select>
                                    </div>
                                    <div class="col-md-2" id="probableparto">
                                        <strong>F.P.P</strong>
                                        <input type="date" class="control control col-md-12" id="fechaprobableparto"
                                            name="fechaprobableparto" value="0000/00/00">

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Terapia de remplazo hormonal</strong>
                                        <select name="planificacionfamiliar" id="planificacionfamiliar"
                                            class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="si">si</option>
                                            <option value="no">no</option>

                                        </select>
                                    </div>

                                    <div class="col-md-2" id="tipolactancia">
                                        <strong>Lactancia</strong>
                                        <select name="lactancia" id="lactancia" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" id="tiempodelactancia">
                                        <strong>Tiempo</strong>
                                        <input type="text" class="control control col-md-12" id="tiempolactancia"
                                            name="tiempolactancia">

                                    </div>

                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES PERSONALES PATOLOGICOS</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Antecedentes</strong>
                                        <select id="mspato" name="check_listapato[]" multiple="multiple"
                                            class="control control col-md-12">

                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionantecedente FROM antecedentespersonalespatologicos");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionantecedente']; ?>">
                                                <?php echo $row['descripcionantecedente']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <!--
                                    <fieldset class="col-md-12">

                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Tabaquismo">&nbsp;Tabaquismo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Hipertencion Arterial">&nbsp;Hipertensión
                                        Arterial&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Enfermedad Renal Cronica">&nbsp;Enfermedad Renal
                                        Cronica&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Diabetes Mellitus">&nbsp;Diabetes Mellitus&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Conocida con Gen BRCA 1">&nbsp;Conocida con Gen BRCA
                                        1&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Conocida con Gen BRCA 2">&nbsp;Conocida con Gen BRCA
                                        2&nbsp;&nbsp;

                                    </fieldset>
                                    -->
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ATENCIÓN CLINICA</strong>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Fecha primer atencion</strong>
                                        <input type="date" id="fechaatencioninicial" name="fechaatencioninicial"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>BIRADS de referencia</strong>
                                        <select name="biradsreferencia" id="biradsreferencia" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				            $query = $conexionCancer->prepare("SELECT descripcionbrad FROM birads_atencion_inicial");
                                $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionbrad']; ?>">
                                                <?php echo $row['descripcionbrad']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>BIRADS HRAEI</strong>
                                        <select name="biradshraei" id="biradshraei" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				            $query = $conexionCancer->prepare("SELECT descripcionbrad FROM birads_atencion_inicial");
                                $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionbrad']; ?>">
                                                <?php echo $row['descripcionbrad']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="lateralidadinicio">
                                        <strong>Lateralidad</strong>
                                        <select name="lateralidadprimero" id="lateralidadprimero" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Derecha">Derecha</option>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Bilateral">Bilateral</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="lateralidadinicio">
                                        <strong>Estadio clinico</strong>
                                        <select name="estadioclinico" id="estadioclinico" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="0">0</option>
                                            <option value="I">I</option>
                                            <option value="II A">II A</option>
                                            <option value="II B">II B</option>
                                            <option value="III A">III A</option>
                                            <option value="III B">III B</option>
                                            <option value="III C">III C</option>
                                            <option value="IV">IV</option>
                                         

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Etapa clinica</strong>
                                        <select name="etapasclinicas" id="etapasclinicas" class="control control col-md-12" readonly>
                                            <option value="TNM" selected>TNM</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Tamaño tumoral</strong>
                                        <select name="tamaniotumoral" id="tamaniotumoral" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_size_tumoral FROM size_tumoral");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_size_tumoral']; ?>">
                                                <?php echo $row['descripcion_size_tumoral']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Compromiso linfatico nodal</strong>
                                        <select name="linfaticonodal" id="linfaticonodal" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_linfatico_nodal FROM compromiso_linfatico_nodal");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_linfatico_nodal']; ?>">
                                                <?php echo $row['descripcion_linfatico_nodal']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Metastasis</strong>
                                        <select name="metastasis" id="metastasis" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="MX: No se pueden evaluar metastasis distantes">MX: No se pueden evaluar metastasis distante</option>
                                            <option value="M0 Sin enfermedad a distancia">M0 Sin enfermedad a distancia</option>
                                            <option value="M1 Con enfermedad metastasica">M1 Con enfermedad metastasica</option>
                                            

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="metastasissitio">
                                        <strong>Sitio de metastasis</strong>
                                        <select name="sitiometastasis[]" id="sitiometastasis2" multiple="multiple" class="category control col-md-12">
                                           
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionsitiometastasis FROM sitiometastasis");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionsitiometastasis']; ?>">
                                                <?php echo $row['descripcionsitiometastasis']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="etapas">
                                        <strong>Clasificación etapas</strong>
                                        <select name="clasificaciondeetapas" id="clasificaciondeetapas"
                                            class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT etapaclasificacion FROM clasificacionetapas");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['etapaclasificacion']; ?>">
                                                <?php echo $row['etapaclasificacion']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Calidad de vida ECOG</strong>
                                        <select name="calidaddevidaecog" id="calidaddevidaecog" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionecog FROM calidadvidaecog");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionecog']; ?>">
                                                <?php echo $row['descripcionecog']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" >
                                        <strong>Mastectomia Extrainstitucional</strong>
                                        <select name="mastectomiaextrainstitucional" id="mastectomiaextrainstitucional"
                                            class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="mstectoextra1">
                                        <strong>Lateralidad Mastectomia</strong>
                                        <select name="lateralidadextrainstitucional" id="lateralidadextrainstitucional"
                                            class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Mama Derecha">Mama Derecha</option>
                                            <option value="Mama Izquierda">Mama Izquierda</option>
                                            <option value="Ambas Mamas">Ambas Mamas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="mstectoextra2">
                                        <strong>Fecha</strong>
                                        <input type="date" class="control control col-md-12" id="fechamastectoextra"
                                            name="fechamastectoextra">

                                    </div>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">HISTOPATOLOGIA</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Seleccione la mama</strong>
                                        <select name="mamaseleccion[]" multiple="multiple" id="mamaseleccion"
                                            class="control control col-md-12">
                                            <option value="Mama Derecha">Mama Derecha</option>
                                            <option value="Region ganglionar derecha">Region ganglionar derecha</option>
                                            <option value="Mama Izquierda">Mama Izquierda</option>
                                            <option value="Region ganglionar izquierda">Region ganglionar izquierda</option>
                                        </select>
                                    </div>
                                <!--inicia mama derecha-->
                                <div class="col-md-12" id="titulomamaderecha"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Mama derecha</strong>
                                    </div>
                                    <div class="col-md-4" id="dxhisto">
                                        <strong>Dx histopatologico MMD</strong>
                                        <select name="dxhistopatologico" id="dxhistopatologico" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_dx_histopalogico FROM dxhistopalogico");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_dx_histopalogico']; ?>">
                                                <?php echo $row['descripcion_dx_histopalogico']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadx">
                                        <strong>Fecha dx histopatologico MMD</strong>
                                        <input type="date" id="fechadxhistopatologico" name="fechadxhistopatologico"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-4" id="nothin">
                                        <strong>Nottinghan MMD</strong>
                                        <select name="nottingham" id="nottingham" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12" id="escala">
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) MMD</strong>
                                        <select name="escalasbr" id="escalasbr" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionescalasbr FROM escalasbr");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionescalasbr']; ?>">
                                                <?php echo $row['descripcionescalasbr']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                <!--finaliza mama derecha-->
                                <!-- inicia region ganglionar derecha-->
                                <div class="col-md-12" id="titulomamaderechargd"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Region ganglionar derecha</strong>
                                    </div>
                                    <div class="col-md-4" id="dxhistorgd">
                                        <strong>Dx histopatologico RGD</strong>
                                        <select name="dxhistopatologicorgd" id="dxhistopatologicorgd" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_dx_histopalogico FROM dxhistopalogico");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_dx_histopalogico']; ?>">
                                                <?php echo $row['descripcion_dx_histopalogico']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadxrgd">
                                        <strong>Fecha dx histopatologico RGD</strong>
                                        <input type="date" id="fechadxhistopatologicorgd" name="fechadxhistopatologicorgd"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-4" id="nothinrgd">
                                        <strong>Nottinghan RGD</strong>
                                        <select name="nottinghamrgd" id="nottinghamrgd" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12" id="escalargd">
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) RGD</strong>
                                        <select name="escalasbrrgd" id="escalasbrrgd" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionescalasbr FROM escalasbr");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionescalasbr']; ?>">
                                                <?php echo $row['descripcionescalasbr']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <!--finaliza region ganglionar izquierda-->
                                  <!--inicia mama izquierda--> 
                                  <div class="col-md-12" id="titulomamaizquierda"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Mama izquierda</strong>
                                    </div>
                                    <div class="col-md-4" id="dxhistoiz">
                                        <strong>Dx histopatologico MMI</strong>
                                        <select name="dxhistopatologicoiz" id="dxhistopatologicoiz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_dx_histopalogico FROM dxhistopalogico");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_dx_histopalogico']; ?>">
                                                <?php echo $row['descripcion_dx_histopalogico']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadxiz">
                                        <strong>Fecha dx histopatologico MMI</strong>
                                        <input type="date" id="fechadxhistopatologicoiz" name="fechadxhistopatologicoiz"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-4" id="nothiniz">
                                        <strong>Nottinghan MMI</strong>
                                        <select name="nottinghamiz" id="nottinghamiz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12" id="escalaiz">
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) MMI</strong>
                                        <select name="escalasbriz" id="escalasbriz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionescalasbr FROM escalasbr");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionescalasbr']; ?>">
                                                <?php echo $row['descripcionescalasbr']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                <!--finaliza mama izquierda -->
                                <!-- inicia region ganglionar IZQUIERDA-->
                                <div class="col-md-12" id="titulomamaderechargi"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Region ganglionar izquierda</strong>
                                    </div>
                                    <div class="col-md-4" id="dxhistorgi">
                                        <strong>Dx histopatologico RGI</strong>
                                        <select name="dxhistopatologicorgi" id="dxhistopatologicorgi" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_dx_histopalogico FROM dxhistopalogico");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_dx_histopalogico']; ?>">
                                                <?php echo $row['descripcion_dx_histopalogico']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadxrgi">
                                        <strong>Fecha dx histopatologico RGI</strong>
                                        <input type="date" id="fechadxhistopatologicorgi" name="fechadxhistopatologicorgi"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-4" id="nothinrgi">
                                        <strong>Nottinghan RGI</strong>
                                        <select name="nottinghamrgi" id="nottinghamrgi" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12" id="escalargi">
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) RGI</strong>
                                        <select name="escalasbrrgi" id="escalasbrrgi" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionescalasbr FROM escalasbr");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionescalasbr']; ?>">
                                                <?php echo $row['descripcionescalasbr']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <!--finaliza region ganglionar izquierda-->
                                <!--inicia mama derecha inmuno-->
                                    <div class="col-md-12"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">INMUNOHISTOQUIMICA</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Seleccione la mama</strong>
                                        <select name="mamaseleccioninmuno[]" multiple="multiple" id="mamaseleccioninmuno"
                                            class="control control col-md-12">
                                            <option value="Mama Derecha">Mama Derecha</option>
                                            <option value="Region ganglionar derecha">Region ganglionar derecha</option>
                                            <option value="Mama Izquierda">Mama Izquierda</option>
                                            <option value="Region ganglionar izquierda">Region ganglionar izquierda</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-12" id="tituloinmunomamaderecha"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Mama derecha</strong>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="input-group pull-left" id="inmunoderecha1">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenos" name="receptoresestrogenos"
                                                placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="inmunoderecha2">
                                        <div class="input-group pull-left">
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesterona"
                                                name="receptoresprogesterona" placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderecha3">
                                        <div class="input-group pull-left">
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67" name="ki67" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div><!--
                                    <div class="col-md-2" id="inmunoderecha4">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="k" name="k" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2" id="inmunoderecha5">
                                        <div class="input-group pull-left">
                                            <strong>P 53</strong>
                                            <input type="number" name="p53" id="p53" class="control control col-md-12">
                                                
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderecha6">
                                        <div class="input-group pull-left">
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativo" id="triplenegativo" class="control control col-md-12">
                                                <option value="Sin registro" selected>Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                        </div>
                                    </div>
                                    <fieldset class="col-md-2" id="inmunoderecha7">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizo" id="pdlrealizo1"
                                                onclick="aplicopdlsi();" class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizo" id="pdlrealizo2"
                                                onclick="aplicopdlno();" class="check" checked value="no">   
                                    </fieldset>
                                    <div class="col-md-2" id="inmunoderecha8">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdl" name="pdl" placeholder="%"
                                                class="control control col-md-12" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-2" id="inmunoderecha9">
                                        <div class="input-group pull-left">
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogen" id="oncogen" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderecha10">
                                    <div class="input-group pull-left">
                                        <strong>FISH</strong>
                                        <select name="fish" id="fish" class="control control col-md-12">
                                            <option value="0">Seleccione</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    </div>
                                    </div>
                                    <!--finaliza mama derecha inmuno-->
                                    <!-- region ganglionar derecha inicio-->
                                    
                                    
                                    <div class="col-md-12" id="tituloinmunomamaderechargd"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Region ganglionar derecha</strong>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group pull-left" id="inmunoderecha1rgd">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosrgd" name="receptoresestrogenosrgd"
                                                placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="inmunoderecha2rgd">
                                        <div class="input-group pull-left">
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronargd"
                                                name="receptoresprogesteronargd" placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderecha3rgd">
                                        <div class="input-group pull-left">
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67rgd" name="ki67rgd" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div><!--
                                    <div class="col-md-2" id="inmunoderecha4rgd">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="krgd" name="krgd" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2" id="inmunoderecha5rgd">
                                        <div class="input-group pull-left">
                                            <strong>P 53</strong>
                                            <input type="number" name="p53rgd" id="p53rgd" class="control control col-md-12">
                                                
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderecha6rgd">
                                        <div class="input-group pull-left">
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativorgd" id="triplenegativorgd" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                        </div>
                                    </div>
                                    <fieldset class="col-md-2" id="inmunoderecha7rgd">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizorgd" id="pdlrealizo1rgd"
                                                onclick="aplicopdlsirgd();" class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizorgd" id="pdlrealizo2rgd"
                                                onclick="aplicopdlnorgd();" class="check" checked value="no">   
                                    </fieldset>
                                    <div class="col-md-2" id="inmunoderecha8rgd">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdlrgd" name="pdlrgd" placeholder="%"
                                                class="control control col-md-12" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-2" id="inmunoderecha9rgd">
                                        <div class="input-group pull-left">
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogenrgd" id="oncogenrgd" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderecha10rgd">
                                    <div class="input-group pull-left">
                                        <strong>FISH</strong>
                                        <select name="fishrgd" id="fishrgd" class="control control col-md-12">
                                            <option value="0">Seleccione</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    </div>
                                    </div>
                                    <!--finaliza regiona ganglionar izquierda-->
                                    <!--inicia mama izquierda inmuno-->
                                    
                                    <div class="col-md-12" id="tituloinmunomamaizquierda"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Mama izquierda</strong>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group pull-left" id="inmunoderechaiz1">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosiz" name="receptoresestrogenosiz"
                                                placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="inmunoderechaiz2">
                                        <div class="input-group pull-left">
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronaiz"
                                                name="receptoresprogesteronaiz" placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderechaiz3">
                                        <div class="input-group pull-left">
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67iz" name="ki67iz" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-2" id="inmunoderechaiz4">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="kiz" name="kiz" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2" id="inmunoderechaiz5">
                                        <div class="input-group pull-left">
                                            <strong>P 53</strong>
                                            <input type="number" name="p53iz" id="p53iz" class="control control col-md-12">
                                                
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderechaiz6">
                                        <div class="input-group pull-left">
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativoiz" id="triplenegativoiz" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                        </div>
                                    </div>
                                    <fieldset class="col-md-2" id="inmunoderechaiz7">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizoiz" id="pdlrealizo1iz"
                                                onclick="aplicopdlsimmiz();" class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizoiz" id="pdlrealizo2iz"
                                                onclick="aplicopdlnommiz();" class="check" checked value="no">   
                                    </fieldset>
                                    <div class="col-md-2" id="inmunoderechaiz8">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdliz" name="pdliz" placeholder="%"
                                                class="control control col-md-12" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-2" id="inmunoderechaiz9">
                                        <div class="input-group pull-left">
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogeniz" id="oncogeniz" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderechaiz10">
                                    <div class="input-group pull-left">
                                        <strong>FISH</strong>
                                        <select name="fishiz" id="fishiz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    </div>
                                    </div>
                                    <!--finaliza mama izquierda inmuno-->
                                    <!--region ganglionar izquierda inmuno-->
                                    <div class="col-md-12" id="tituloinmunomamaizquierdargi"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Region ganglionar izquierda</strong>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group pull-left" id="inmunoderechaiz1rgi">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosizrgi" name="receptoresestrogenosizrgi"
                                                placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="inmunoderechaiz2rgi">
                                        <div class="input-group pull-left">
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronaizrgi"
                                                name="receptoresprogesteronaizrgi" placeholder="%" class="control control col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderechaiz3rgi">
                                        <div class="input-group pull-left">
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67izrgi" name="ki67izrgi" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-2" id="inmunoderechaiz4rgi">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="kizrgi" name="kizrgi" placeholder="%"
                                                class="control control col-md-12">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2" id="inmunoderechaiz5rgi">
                                        <div class="input-group pull-left">
                                            <strong>P 53</strong>
                                            <input type="number" name="p53izrgi" id="p53izrgi" class="control control col-md-12">
                                                
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderechaiz6rgi">
                                        <div class="input-group pull-left">
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativoizrgi" id="triplenegativoizrgi" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                        </div>
                                    </div>
                                    <fieldset class="col-md-2" id="inmunoderechaiz7rgi">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizoizrgi" id="pdlrealizo1izrgi"
                                                onclick="aplicopdlsirgiz();" class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizoizrgi" id="pdlrealizo2izrgi"
                                                onclick="aplicopdlnorgiz();" class="check" checked value="no">   
                                    </fieldset>
                                    <div class="col-md-2" id="inmunoderechaiz8rgi">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdlizrgi" name="pdlizrgi" placeholder="%"
                                                class="control control col-md-12" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-2" id="inmunoderechaiz9rgi">
                                        <div class="input-group pull-left">
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogenizrgi" id="oncogenizrgi" class="control control col-md-12">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="inmunoderechaiz10rgi">
                                    <div class="input-group pull-left">
                                        <strong>FISH</strong>
                                        <select name="fishizrgi" id="fishizrgi" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    </div>
                                    </div>
                                    <!--finaliza region ganglionar inzquierda inmuno-->
                                    <!--Inicia mama molecular derecha-->
                                    <hr>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">MOLECULAR</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Seleccione la mama</strong>
                                        <select name="mamaseleccionmolecular[]" multiple="multiple" id="mamaseleccionmolecular"
                                            class="control control col-md-12">
                                            <option value="Mama Derecha">Mama Derecha</option>
                                            <option value="Region ganglionar derecha">Region ganglionar derecha</option>
                                            <option value="Mama Izquierda">Mama Izquierda</option>
                                            <option value="Region ganglionar izquierda">Region ganglionar izquierda</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="titulomolecularmamaderecha"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Mama derecha</strong>
                                    </div>
                                    <fieldset class="col-md-3" id="luminal1">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminala" id="luminala"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminala" id="luminala"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal1">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal A</strong>
                                            <input type="number" id="luminala" name="luminala" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal2">
                                            <strong>&nbsp;&nbsp;Luminal B</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalb" id="luminalb"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalb" id="luminalb"
                                                class="check" checked value="no">   
                                    </fieldset>
                            
                                    <!--<div class="col-md-3" id="luminal2">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal B</strong>
                                            <input type="number" id="luminalb" name="luminalb" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal3">
                                            <strong>&nbsp;&nbsp;Enriquecido en Her 2 +</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="enriquecidoherdos" id="enriquecidoherdos"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="enriquecidoherdos" id="enriquecidoherdos"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal3">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Enriquecido en Her 2 +</strong>
                                            <input type="number" id="enriquecidoherdos" name="enriquecidoherdos" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal4">
                                            <strong>&nbsp;&nbsp;Basal</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="basal" id="basal"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="basal" id="basal"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal4">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Basal</strong>
                                            <input type="number" id="basal" name="basal" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <!--Finaliza mama molecular derecha-->
                                    <!-- Inicia mama molecular region ganglionar derecha-->
                                    <div class="col-md-12" id="titulomolecularmamaderechammrgd"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Region ganglionar derecha</strong>
                                    </div>
                                    <fieldset class="col-md-3" id="luminal1mmrgd">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalammrgd" id="luminalammrgd"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalammrgd" id="luminalammrgd"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal1mmrgd">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal A</strong>
                                            <input type="number" id="luminalammrgd" name="luminalammrgd" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal2mmrgd">
                                            <strong>&nbsp;&nbsp;Luminal B</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalbmmrgd" id="luminalbmmrgd"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalbmmrgd" id="luminalbmmrgd"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal2mmrgd">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal B</strong>
                                            <input type="number" id="luminalbmmrgd" name="luminalbmmrgd" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal3mmrgd">
                                            <strong>&nbsp;&nbsp;Enriquecido en Her 2 +</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="enriquecidoherdosmmrgd" id="enriquecidoherdosmmrgd"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="enriquecidoherdosmmrgd" id="enriquecidoherdosmmrgd"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal3mmrgd">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Enriquecido en Her 2 +</strong>
                                            <input type="number" id="enriquecidoherdosmmrgd" name="enriquecidoherdosmmrgd" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal4mmrgd">
                                            <strong>&nbsp;&nbsp;Basal</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="basalmmrgd" id="basalmmrgd"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="basalmmrgd" id="basalmmrgd"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal4mmrgd">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Basal</strong>
                                            <input type="number" id="basalmmrgd" name="basalmmrgd" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <!--finaliza mama molecular region ganglionar derecha-->
                                    <!--Inicia mama molecular izquierda-->
                                    <div class="col-md-12" id="titulomolecularmamaizquierda"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Mama izquierda</strong>
                                    </div>
                                    <fieldset class="col-md-3" id="luminal5">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalaiz" id="luminalaiz"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalaiz" id="luminalaiz"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal5">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal A</strong>
                                            <input type="number" id="luminalaiz" name="luminalaiz" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                        <fieldset class="col-md-3" id="luminal6">
                                            <strong>&nbsp;&nbsp;Luminal B</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalbiz" id="luminalbiz"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalbiz" id="luminalbiz"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal6">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal B</strong>
                                            <input type="number" id="luminalbiz" name="luminalbiz" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal7">
                                            <strong>&nbsp;&nbsp;Enriquecido en Her 2 +</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="enriquecidoherdosiz" id="enriquecidoherdosiz"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="enriquecidoherdosiz" id="enriquecidoherdosiz"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal7">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Enriquecido en Her 2 +</strong>
                                            <input type="number" id="enriquecidoherdosiz" name="enriquecidoherdosiz" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal8">
                                            <strong>&nbsp;&nbsp;Basal</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="basaliz" id="basaliz"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="basaliz" id="basaliz"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal8">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Basal</strong>
                                            <input type="number" id="basaliz" name="basaliz" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <!--Finaliza mama molecular izquierda-->
                                    <!-- inicia mama molecular region ganglionar izquierda-->
                                    <div class="col-md-12" id="titulomolecularmamaizquierdammrgi"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">Region ganglionar izquierda</strong>
                                    </div>
                                    <fieldset class="col-md-3" id="luminal5mmrgi">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalaizmmrgi" id="luminalaizmmrgi"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalaizmmrgi" id="luminalaizmmrgi"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal5mmrgi">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal A</strong>
                                            <input type="number" id="luminalaizmmrgi" name="luminalaizmmrgi" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal6mmrgi">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalbizmmrgi" id="luminalbizmmrgi"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalbizmmrgi" id="luminalbizmmrgi"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal6mmrgi">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Luminal B</strong>
                                            <input type="number" id="luminalbizmmrgi" name="luminalbizmmrgi" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal7mmrgi">
                                            <strong>&nbsp;&nbsp;Enriquecido en Her 2 +</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="enriquecidoherdosizmmrgi" id="enriquecidoherdosizmmrgi"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="enriquecidoherdosizmmrgi" id="enriquecidoherdosizmmrgi"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal7mmrgi">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Enriquecido en Her 2 +</strong>
                                            <input type="number" id="enriquecidoherdosizmmrgi" name="enriquecidoherdosizmmrgi" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <fieldset class="col-md-3" id="luminal8mmrgi">
                                            <strong>&nbsp;&nbsp;Basal</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="basalizmmrgi" id="basalizmmrgi"
                                                 class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="basalizmmrgi" id="basalizmmrgi"
                                                class="check" checked value="no">   
                                    </fieldset>
                                    <!--<div class="col-md-3" id="luminal8mmrgi">
                                        <div class="input-group pull-left">
                                            <strong id="inmuno-title">Basal</strong>
                                            <input type="number" id="basalizmmrgi" name="basalizmmrgi" placeholder="%"
                                                class="control control col-md-12" value="">
                                        </div>
                                    </div>-->
                                    <!--finaliza mama molecular region ganglionar izquierda-->
                                    <hr>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">TRATAMIENTO</strong>
                                    </div>
                                    <div class="col-md-12" style="color: #BD9FD6; ">
                                        <strong>QUIRURGICO</strong>
                                        <select name="quirurgico" id="quirurgico" class="control control col-md-12">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="lateralidad">
                                        <strong>Lateralidad Qx</strong>
                                        <select name="lateralidadsegundo" id="lateralidadsegundo" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Derecha">Derecha</option>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Bilateral">Bilateral</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="tipoquirurgico">
                                        <strong>Tipo</strong>
                                        <select name="quirurgicotipo" id="quirurgicotipo" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Mastectomia">Mastectomia</option>
                                            <option value="Ganglionar">Ganglionar</option>

                                        </select>
                                    </div>

                                    <div class="col-md-4" id="tipomastectomia">
                                        <strong>Tipo de mastectomia</strong>
                                        <select name="mastectomiatipo" id="mastectomiatipo" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Mastectomia conservadora">Mastectomia conservadora</option>
                                            <option value="Mastectomia paliativa">Mastectomia paliativa</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="tipoganglionar">
                                        <strong>Tipo de ganglionar</strong>
                                        <select name="ganglionartipo" id="ganglionartipo" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="GANGLIO CENTINELA">GANGLIO CENTINELA</option>
                                            <option value="DISECCION AXILAR">DISECCION AXILAR</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="fechatipomastectomia">
                                        <strong>Fecha</strong>
                                        <input type="date" id="fechatipomastecto" name="fechatipomastecto"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3" id="fechatipoganglionar">
                                        <strong>Fecha</strong>
                                        <input type="date" id="fechatipoganglio" name="fechatipoganglio"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3" id="reconstruccion">
                                        <strong>Reconstruccion</strong>
                                        <select name="reconstruccionsino" id="reconstruccionsino" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="tiporeconstruccion">
                                        <strong>Tipo</strong>
                                        <select name="reconstrucciontipo" id="reconstrucciontipo" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Expansor tisular">Expansor tisular</option>
                                            <option value="Implante mamario">Implante mamario</option>
                                            <option value="Colgajo">Colgajo</option>

                                        </select>
                                    </div>

                                    <div class="col-md-3" id="reconstrucciontipofecha">
                                        <strong>Fecha</strong>
                                        <input type="date" id="fechatiporeconstruccion" name="fechatiporeconstruccion"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="button" name="enviar" value="Guardar Tratamiento" onclick="Hola();"
                                        id="guardaApartado"
                                        style="width: 170px; height: 27px; font-size: 12px; color: white; background-color: #00B6FF; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                    <script>
                                    function Hola() {

                                        if ($('input[name=curp]').val().length == 0 || $('input[name=nombrecompleto]')
                                            .val().length == 0 || $('select[name=cbx_estado]').val().length == 0) {
                                            swal({
                                                title: 'Hooho error!',
                                                text: 'Ingresa los datos requeridos!',
                                                icon: 'warning',

                                            });

                                            return false;
                                        }
                                        let quirurgico = $("#quirurgico").val();
                                        let lateralidadsegundo = $("#lateralidadsegundo").val();
                                        let quirurgicotipo = $("#quirurgicotipo").val();
                                        let curp = $("#curp").val();
                                        let mastectomiatipo = $("#mastectomiatipo").val();
                                        let fechatipomastecto = $("#fechatipomastecto").val();
                                        let ganglionartipo = $("#ganglionartipo").val();
                                        let fechatipoganglio = $("#fechatipoganglio").val();
                                        let reconstruccionsino = $("#reconstruccionsino").val();
                                        let reconstrucciontipo = $("#reconstrucciontipo").val();
                                        let fechatiporeconstruccion = $("#fechatiporeconstruccion").val();

                                        let parametros = {
                                            quirurgico: quirurgico,
                                            lateralidadsegundo: lateralidadsegundo,
                                            quirurgicotipo: quirurgicotipo,
                                            curp: curp,
                                            mastectomiatipo: mastectomiatipo,
                                            fechatipomastecto: fechatipomastecto,
                                            ganglionartipo: ganglionartipo,
                                            fechatipoganglio: fechatipoganglio,
                                            reconstruccionsino: reconstruccionsino,
                                            reconstrucciontipo: reconstrucciontipo,
                                            fechatiporeconstruccion: fechatiporeconstruccion
                                        }
                                        $.ajax({
                                            data: parametros,
                                            url: 'aplicacion/procesoAjax.php',
                                            type: 'post',
                                            beforeSend: function() {
                                                $("#mensaje").html("Procesando, espere por favor");
                                            },
                                            success: function(response) {
                                                $("#mensaje").html(response);
                                            }
                                        });
                                    }
                                    </script>

                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">QUIMIOTERAPIA</strong>
                                    </div>
                                    <div class="col-md-12" style="color: #BD9FD6;">
                                        <strong>QUIMIOTERAPIA</strong>
                                        <select name="aplicoquimio" id="aplicoquimio" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechainicioquimio">
                                        <strong>Fecha inicio</strong>
                                        <input type="date" id="fechadeinicioquimio" name="fechadeinicioquimio"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-4" id="atracicilassi">
                                        <strong>Antraciclinas</strong>
                                        <select name="antraciclinas" id="antraciclinas" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion FROM atraciclina");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion']; ?>">
                                                <?php echo $row['descripcion']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="quimiomomento">
                                        <strong>Momento de la QT</strong>
                                        <select name="momentoquimio" id="momentoquimio" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Neoadyuvante">Neoadyuvante</option>
                                            <option value="Coadyuvante">Coadyuvante</option>
                                            <option value="Paliativo">Paliativo</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-2" id="quimiono">
                                        <strong>HER 2 +++</strong><br>
                                        <input type="radio" name="her" id="her1" onclick="aplicoher();" class="check"
                                            value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="her" id="her2" onclick="aplicoherno();" class="check"
                                            checked value="noaplico">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-3" id="esquemaher">
                                        <strong style="color:red;">Esquema HER 2 +++</strong>
                                        <select name="esquemaherdos" id="esquemaherdos" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="TRASTUZUMAB/PERTUZUMAB">TRASTUZUMAB/PERTUZUMAB</option>
                                            <option value="TRASTUZUMAB/EMTANSINA">TRASTUZUMAB/EMTANSINA</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-2" id="quimiono2">
                                        <strong>Triple negativo</strong><br>
                                        <input type="radio" name="triplenegativo" id="triplenegativo1"
                                            onclick="triplesi();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="triplenegativo" id="triplenegativo2"
                                            onclick="tripleno();" class="check" checked value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-3" id="tripleesquema">
                                        <strong style="color:red;">Esquema triple negativo</strong>
                                        <select name="esquematriple" id="esquematriple" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="ATEZOLIZUMAB">ATEZOLIZUMAB</option>
                                            <option value="PEMBROLIZUMAB">PEMBROLIZUMAB</option>
                                            <option value="OLAPARIB">OLAPARIB</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-2" id="quimiono3">
                                        <strong>Hormonosensible</strong><br>
                                        <input type="radio" name="hormonosensibles" id="hormonosensibles1"
                                            onclick="hormonosi();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="hormonosensibles" id="hormonosensibles2"
                                            onclick="hormonono();" class="check" checked value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-3" id="hormonoesquema">
                                        <strong style="color:red;">Inhibidores de ciclinas</strong>
                                        <select name="esquemahormonosensible" id="esquemahormonosensible"
                                            class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="PALBOCICLIB">PALBOCICLIB</option>
                                            <option value="RIBOCICLIB">RIBOCICLIB</option>
                                            <option value="ABEMACICLIB">ABEMACICLIB</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="quimiono4">
                                        <strong>Tipo de tratamiento</strong>
                                        <select name="tipotratamiento" id="tipotratamiento"
                                            class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Adyuvante">Adyuvante</option>
                                            <option value="Coadyuvante">Coadyuvante</option>
                                            <option value="Paliativo">Paliativo</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-2" id="quimiono5">
                                        <strong>Completo quimio</strong><br>
                                        <input type="radio" name="completoquimio" id="completoquimio1"
                                            onclick="quimiocompletosi();" class="check" checked value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="completoquimio" id="completoquimio2"
                                            onclick="quimiocompletono();" class="check" value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-4" id="esquemaquimio">
                                        <strong style="color:red;">Causa QT incompleta</strong>
                                        <select name="quimioesquema" id="quimioesquema" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="EVENTO ADVERSO">EVENTO ADVERSO</option>
                                            <option value="PROGRESION DE LA ENFERMEDAD">PROGRESION DE LA ENFERMEDAD
                                            </option>
                                            <option value="RECURRENCIA DE LA ENFERMEDAD">RECURRENCIA DE LA ENFERMEDAD
                                            </option>
                                            <option value="ABANDONO DEL PACIENTE">ABANDONO DEL PACIENTE</option>
                                            <option value="FALLECIO">FALLECIO</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="eventoadverso">
                                        <strong style="color:red;">Fecha evento adverso</strong>
                                        <input type="date" id="fechaeventoadverso" name="fechaeventoadverso"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3" id="eventoprogresivo">
                                        <strong style="color:red;">Fecha progresion</strong>
                                        <input type="date" id="fechaprogresion" name="fechaprogresion"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3" id="eventorecurrencia">
                                        <strong style="color:red;">Fecha recurrencia</strong>
                                        <input type="date" id="fecharecurrencia" name="fecharecurrencia"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3" id="eventodefuncion">
                                        <strong style="color:red;">Fecha fallecio</strong>
                                        <input type="date" id="fechadefuncion" name="fechadefuncion"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-3" id="causaonco">
                                        <strong style="color:red;">Causa</strong>
                                        <select name="otracausa" id="otracausa" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="ONCOLOGICA">ONCOLOGICA</option>
                                            <option value="EVENTO ADVERSO">EVENTO ADVERSO</option>
                                            <option value="OTRA">OTRA</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="especausa">
                                        <strong style="color:red;">Especifique</strong>
                                        <input type="text" id="especifiquecausa" name="especifiquecausa"
                                            class="control control col-md-12">
                                    </div>

                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">RADIOTERAPIA</strong>
                                    </div>
                                    <div class="col-md-12" style="color: #BD9FD6; ">
                                        <strong>RADIOTERAPIA</strong>
                                        <select name="radioterapia" id="radioterapia" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="seaplicoradio">
                                        <strong>Tipo Radioterapia</strong>
                                        <select name="aplicoradioterapia" id="aplicoradioterapia" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="CICLO MAMARIO COMPLETO">CICLO MAMARIO COMPLETO</option>
                                            <option value="TANGENCIAL">TANGENCIAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadelaradio">
                                        <strong>Fecha de inicio</strong>
                                        <input type="date" id="fechainicioradio" name="fechainicioradio"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-4" id="sesionescantidad">
                                        <strong>N° de sesiones</strong>
                                        <input type="number" id="numerosesiones" name="numerosesiones"
                                            class="control control col-md-12">
                                    </div>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">BRAQUITERAPIA</strong>
                                    </div>
                                    <div class="col-md-3" style="color: #BD9FD6; ">
                                        <strong>BRAQUITERAPIA</strong>
                                        <select name="braquiterapia" id="braquiterapia" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="fechabraquiterapia">
                                        <strong>Fecha braquiterapia</strong>
                                        <input type="date" id="fechadebraquiterapia" name="fechadebraquiterapia"
                                            class="control control col-md-12" >
                                    </div>
                                
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">DEFUNCIÓN</strong>
                                    </div>
                                    
                                     <fieldset class="col-md-2">
                                         <strong>Defunción</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="defunsi" id="defunsionsi"
                                                onclick="defusi();" class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="defunsi" id="defunsionno"
                                                onclick="defuno();" class="check" value="no" checked>   
                                    </fieldset>
                                    <div class="col-md-3" id="defuncionfecha">
                                        <strong>Fecha defunción</strong>
                                        <input type="date" name="fechadeladefuncion" id="fechadeladefuncion" class="control control col-md-12" value="0000/00/00">
                                          
                                    </div>
                                    <div class="col-md-3" id="defuncioncausa">
                                     
                                        <strong>Causa</strong>
                                        <select name="causadefuncion" id="causadefuncion" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Oncologica">Oncologica</option>
                                            <option value="No oncologica">No oncologica</option>
                                        </select>
                                    </div>
                                </div>
                                    
                                <div class="col-md-12"></div>
                                <br>


                                <input type="submit"  value="Registrar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                <input type="button" onclick="window.location.reload();"
                                    value="Cerrar formulario" style="width: 170px; height: 27px; color: white; background-color: #FA0000; float: left; margin-left: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">


                                <br>
                        </div>
                                    </form>
                     <div id="tabla_resultado2"></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>