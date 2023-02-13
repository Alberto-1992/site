<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="pacienteconelevacion">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionCE.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalInfarto">
            
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">




                        <div class="modal-body">

                            <!-- form start -->


                            <div class="form-header">
                                <h3 class="form-title"
                                    style="text-align: center; color: white; background-color:#CD114E;">FICHA DE
                                    DATOS</h3>

                            </div>
                            <style>
                            #fecha,
                            #curp,
                            #nombrecompleto,
                            #edad {
                                text-transform: uppercase;
                            }
                            </style>
                            <form name="formulario" id="formulario" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formulario").on("submit", function(e) {
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById("formulario"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarpacienteCE.php",
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
                                    <div class="col-md-12">
                                        <strong>CURP</strong>
                                        <input list="curpusuario" id="curp" name="curp" type="text" class="form-control" value=""
                                            onblur="curp2date();" minlength="18" maxlength="18" required>
                                            <datalist id="curpusuario">
                                            <option value="">Seleccione</option>
                                            <?php 
                                            require 'conexionCancer.php';
				        $query = $conexionCancer->prepare("SELECT curp FROM dato_usuario");
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
                                            type="text" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Población indigena</strong>
                                        <input id="poblacionindigena" name="poblacionindigena" type="text"
                                            class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Escolaridad</strong>
                                        <select id="escolaridad" name="escolaridad" class="form-control">
                                            <option value="0">Seleccione </option>
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
                                            class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Edad</strong>
                                        <input id="edad" name="edad" type="text" class="form-control" value="" readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Sexo</strong>
                                        <input type="text" class="form-control" id="sexo" onclick="curp2date();"
                                            name="sexo" readonly>

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Raza</strong>
                                        <input type="text" class="form-control" id="raza" onclick="curp2date();"
                                            name="raza">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Frecuencia cardiaca</strong>
                                        <input type="text" class="form-control" id="frecuenciacardiaca"
                                            name="frecuenciacardiaca">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Presión arterial</strong>
                                        <input type="text" class="form-control" id="persionarterial"
                                            name="persionarterial">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Talla</strong>
                                        <input type="number" step="any" class="form-control" id="talla" name="talla"
                                            required>

                                    </div>
                                    <script>
                                         $(document).ready(function() {
                                        $('#talla').mask('0.00');
                                    });
                                     $(document).ready(function() {
                                        $('#persionarterial').mask('000/00');
                                    });
                                    </script>
                                   
                                    <div class="col-md-3">
                                        <strong>Peso</strong>
                                        <input type="number" step="any" class="form-control" id="peso"
                                            onblur="calculaIMC();" name="peso" required>

                                    </div>
                                    <div class="col-md-3">
                                        <strong>IMC</strong>
                                        <input type="text" class="form-control" id="imc" onblur="calculaIMC();"
                                            name="imc" value="" readonly>

                                    </div>

                                    <div class="col-md-6">
                                        <strong>Selecciona el estado</strong>

                                        <select name="cbx_estado" id="cbx_estado" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="0">Seleccionar Estado</option>
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
                                        <select name="cbx_municipio" id="cbx_municipio" class="form-control"
                                            style="width: 100%;" required>

                                        </select>
                                    </div><br><br><br>
                                    <div class="col-md-12"
                                        style="text-align: center; color: white; background-color:#CD114E;">
                                        <strong>FACTORES DE RIESGO</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Seleccione los factores</strong>
                                        <select id="msfactores" name="check_lista[]" multiple="multiple"
                                            class="form-control">

                                            <?php 
				                    require 'conexionInfarto.php';
				            $query = $conexion->prepare("SELECT * FROM factor_riesgocombo");
                                $query->execute();
                                    $query->setFetchMode(PDO::FETCH_ASSOC);
				                        while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_factor']; ?>">
                                                <?php echo $row['descripcion_factor']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div><br>
                                    <!--
                                    <fieldset class="col-md-12">

                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Diabetes">&nbsp;Diabetes&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Hipertencion">&nbsp;Hipertensión&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Tabaquismo">&nbsp;Tabaquismo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Enfermedad renal cronica">&nbsp;Enfermedad renal cronica&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Hiperuricemia">&nbsp;Hiperuricemia&nbsp;&nbsp;<br>
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Obesidad">&nbsp;Obesidad&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="IAM Previo">&nbsp;IAM Previo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Revascularización Cardiaca Previa">&nbsp;Revascularización Cardiaca
                                        Previa&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Enfermedad multivaso">&nbsp;Enfermedad multivaso&nbsp;&nbsp;<br>
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Ectasia Coronaria">&nbsp;Ectasia Coronaria&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Cardiomiopatia de Takotsubo">&nbsp;Cardiomiopatia de
                                        Takotsubo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista[]" id="check_lista[]" class="check"
                                            value="Hiperlipidemia">&nbsp;Hiperlipidemia&nbsp;&nbsp;

                                    </fieldset>--><br><br>
                                    <div class="col-md-12"
                                        style="text-align: center; color: white; background-color:#CD114E;">
                                        <strong>ATENCIÓN CLINICA</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Inicio de sintomas</strong>
                                        <input id="fechasintomas" name="fechasintomas" type="datetime-local" value=""
                                            class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Caracteristica dolor</strong>
                                        <select name="caractipicasatipicas" id="caractipicasatipicas"
                                            class="form-control">
                                            <option value="">Selecciona</option>
                                            <option value="tipicas">Tipicas</option>
                                            <option value="atipicas">Atipicas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Inicio de triage</strong>
                                        <input type="datetime-local" id="primercontacto" name="primercontacto"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Termino de triage</strong>
                                        <input type="datetime-local" id="puertabalon" name="puertabalon"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <fieldset id="tipicascombos" class="col-md-12">
                                        <strong>Caracteristicas tipicas</strong><br>
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Dolor retroesternal">&nbsp;Dolor retroesternal&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Opresivo">&nbsp;Opresivo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Irradacion brazo izquierdo">&nbsp;Irradacion brazo
                                        izquierdo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Mas de 10 minutos">&nbsp;Mas de 10 minutos
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Nauseas">&nbsp;Nauseas&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Diaforesis">&nbsp;Diaforesis&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista2[]" id="check_lista2[]" class="check"
                                            value="Sincupe">&nbsp;Sincope&nbsp;&nbsp;

                                    </fieldset>

                                    <fieldset id="tipicascombos2" class="col-md-12">
                                        <strong>Intensidad del dolor</strong><br>
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="1/10">&nbsp;1/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="2/10">&nbsp;2/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="3/10">&nbsp;3/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="4/10">&nbsp;4/10
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="5/10">&nbsp;5/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="6/10">&nbsp;6/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="7/10">&nbsp;7/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="7/10">&nbsp;8/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="7/10">&nbsp;9/10&nbsp;&nbsp;
                                        <input type="radio" name="check_lista5[]" id="check_lista5[]" class="check"
                                            value="7/10">&nbsp;10/10&nbsp;&nbsp;

                                    </fieldset>

                                    <fieldset id="atipicascombos" class="col-md-12">
                                        <strong>Caracteristicas atipicas</strong><br>
                                        <input type="checkbox" name="check_lista3[]" id="check_lista3[]" class="check"
                                            value="Dolor epigastrio">&nbsp;Dolor epigastrio&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista3[]" id="check_lista3[]" class="check"
                                            value="Punzante">&nbsp;Punzante&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista3[]" id="check_lista3[]" class="check"
                                            value="Pleuritico">&nbsp;Pleuritico&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista3[]" id="check_lista3[]" class="check"
                                            value="Disnea">&nbsp;Disnea&nbsp;
                                        <input type="checkbox" name="check_lista3[]" id="check_lista3[]" class="check"
                                            value="Palpitación">&nbsp;Palpitación&nbsp;&nbsp;
                                        <input type="checkbox" name="check_lista3[]" id="check_lista3[]" class="check"
                                            value="Sincupe">&nbsp;Sincope&nbsp;&nbsp;


                                    </fieldset>
                                    <div class="col-md-6" >
                                        <strong>Electrocardiograma</strong>
                                        <select name="" id="" class="form-control">
                                            <option value="">Seleccione una opción</option>
                                            <option value="Normal">Normal</option>
                                            <option value="lesion">Lesión</option>
                                            <option value="Isquemia">Isquemia</option>
                                            <option value="Necrosis">Necrosis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Localización Electrocardiograma</strong>

                                        <select name="localizacion" id="localizacion" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="0">Seleccionar</option>
                                            <?php 
				    require 'conexionInfarto.php';
				  $query = "SELECT id_localizacion, nombre_localizacion FROM localizacion ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombre_localizacion']; ?>">
                                                <?php echo $row['nombre_localizacion']; ?></option>
                                            <?php } ?>

                                            <!--<option value="1">Otro</option>-->

                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <strong>Con o sin elevación</strong>
                                        <select name="identificador" id="identificador" class="form-control" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="cest">Con elevación del ST</option>
                                            <option value="sest">Sin elevacion del ST</option>

                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <strong>Killip Kimball</strong>
                                        <select name="choque" id="choque" class="form-control" style="width: 100%;"
                                            required>
                                            <option value="0">Selecciona</option>
                                            <?php 
				   
				  $query = "SELECT * FROM choquecardiogenico ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombre_choque']; ?>">
                                                <?php echo $row['nombre_choque']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div><br><br><br>
                                    <div class="col-md-12"
                                        style="text-align: center; color: white; background-color:#CD114E;">
                                        <strong>PARACLINICOS</strong>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group pull-left">
                                            <span id="paraclinic">CK</span>&nbsp;&nbsp;
                                            <input type="text" id="ck" name="ck" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">CK-MB</span>&nbsp;&nbsp;
                                            <input type="text" id="ckmb" name="ckmb" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">TROPONINAS</span>&nbsp;&nbsp;
                                            <input type="text" id="troponinas" name="troponinas" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">GlUCOSA</span>&nbsp;&nbsp;
                                            <input type="text" id="glucosa" name="glucosa" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">UREA</span>&nbsp;&nbsp;
                                            <input type="text" id="urea" name="urea" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">CREATININA</span>&nbsp;&nbsp;
                                            <input type="text" id="creatinina" name="creatinina" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">COLESTEROL</span>&nbsp;&nbsp;
                                            <input type="text" id="colesterol" name="colesterol" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">TRIGLICERIDOS</span>&nbsp;&nbsp;
                                            <input type="text" id="trigliceridos" name="trigliceridos"
                                                placeholder="Describa" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">ACIDO URICO</span>&nbsp;&nbsp;
                                            <input type="text" id="acidourico" name="acidourico" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">HB GLUCOSILADA</span>&nbsp;&nbsp;
                                            <input type="text" id="hbglucosilada" name="hbglucosilada"
                                                placeholder="Describa" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">PROTEINAS</span>&nbsp;&nbsp;
                                            <input type="text" id="proteinas" name="proteinas" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">COLESTEROL TOTAL</span>&nbsp;&nbsp;
                                            <input type="text" id="colesteroltotal" name="colesteroltotal"
                                                placeholder="Describa" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">LDL</span>&nbsp;&nbsp;
                                            <input type="text" id="ldl" name="ldl" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group pull-left">
                                            <span id="paraclinic">HDL</span>&nbsp;&nbsp;
                                            <input type="text" id="hdl" name="hdl" placeholder="Describa"
                                                class="form-control">
                                        </div>
                                    </div><br><br><br>
                                    <style>
                                        #paraclinic{
                                            font-size: 12px;
                                            margin-top: 5px;
                                        }
                                    </style>
                                    <div class="col-md-12"
                                        style="text-align: center; color: white; background-color:#CD114E;">
                                        <strong>TRATAMIENTO</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Trombolisis</strong>
                                        <select name="trombolisis" id="trombolisis" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="iniciotromb">
                                        <strong>Fecha/hora inicio</strong>
                                        <input type="datetime-local" id="iniciotrombolisis" name="iniciotrombolisis"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <div class="col-md-3" id="finalizotromb">
                                        <strong>Fecha/hora finaliza</strong>
                                        <input type="datetime-local" id="finalizotrombolisis" name="finalizotrombolisis"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <div class="col-md-3" id="fibrinolitico">
                                        <strong>Tipo de fibrinolitico</strong>
                                        <select name="fibrinoliticos" id="fibrinoliticos" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="tecnecteplasa">Tecnecteplasa</option>
                                            <option value="Alteplasa">Alteplasa</option>
                                            <option value="Estreptoginasa">Estreptoquinasa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Lesiones coronarias</strong>
                                        <select name="lesionescoronarias" id="lesionescoronarias"
                                            class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="si">Si</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Clasificación DUKE</strong>
                                        <select name="clasificacionduke" id="clasificacionduke"
                                            class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Clasificación Medina</strong>
                                        <select name="clasificacionmedina" id="clasificacionmedina"
                                            class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="MEDINA 1,0,0">MEDINA 1,0,0</option>
                                            <option value="MEDINA 0,1,0">MEDINA 0,1,0</option>
                                            <option value="MEDINA 1,1,0">MEDINA 1,1,0</option>
                                            <option value="MEDINA 1,1,1">MEDINA 1,1,1</option>
                                            <option value="MEDINA 0,0,1">MEDINA 0,0,1</option>
                                            <option value="MEDINA 1,0,1">MEDINA 1,0,1</option>
                                            <option value="MEDINA 0,1,1">MEDINA 0,1,1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>CLASIFICACION ACC/AHA</strong>
                                        <select name="lesionangeo" id="lesionangeo" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <?php 
				   
				  $query = "SELECT * FROM lesionangeografica";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['tipolesion']; ?>">
                                                <?php echo $row['tipolesion']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <!--<a href="img/clasificacion cardio 1.png" style="color: red" target="_blank">
                                            Consultar referencia</a>-->
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <strong>Procedimiento</strong>
                                        <select name="procedimientorealizado" id="procedimientorealizado"
                                            class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="si">Si</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="tipoprocedimiento">
                                        <strong>Tipo de procedimiento</strong>
                                        <select name="tipodeprocedimiento" id="tipodeprocedimiento"
                                            class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                        
                                            $query = "SELECT * FROM procedimiento";
	                    $resultado=$conexion2->query($query);
				            while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombreprocedimiento']; ?>">
                                                <?php echo $row['nombreprocedimiento']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="iniciodeprocedimiento">
                                        <strong>Fecha/hora</strong>
                                        <input type="datetime-local" id="inicioprocedimiento" name="inicioprocedimiento"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <div class="col-md-3" id="procedimientofueexitoso">
                                        <strong>Procedimiento exitoso</strong>
                                        <select name="procedimientoexitoso" id="procedimientoexitoso"
                                            class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="si">Si</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <!--
                                    <div class="col-md-4" id="idestrategia">
                                        <strong>Estrategia</strong>
                                        <select name="estrategia" id="estrategia" class="form-control">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                        
                                            $query = "SELECT * FROM estrategia";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombreestrategia']; ?>">
                                                <?php echo $row['nombreestrategia']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                -->
                                    <div class="col-md-3" id="idsitiopuncion">
                                        <strong>Sitio de punción</strong>
                                        <select name="sitiodepuncion" id="sitiodepuncion" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                        
                                            $query = "SELECT * FROM sitiopuncion";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['lugarsitiopuncion']; ?>">
                                                <?php echo $row['lugarsitiopuncion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="idstend">
                                        <strong>Stent</strong>
                                        <select name="stent" id="stent" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                        
                                            $query = "SELECT * FROM stend";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['tipostend']; ?>">
                                                <?php echo $row['tipostend']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <div class="col-md-3" id="idstend">
                                        <strong>N° stent implantados</strong>
                                        <select name="stent" id="stent" class="form-control">
                                            <option value="0">Seleccione</option>
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
                                            <option value="Mas de 10">Mas de 10</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idolusion">
                                        <strong>Vasos comprometidos</strong>
                                        <select name="olusion" id="olusion" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                          
                                            $query = "SELECT * FROM olusionesdistalescronicas";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombreolusion']; ?>">
                                                <?php echo $row['nombreolusion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="idseveridad">
                                        <strong>Clasificacion severidad</strong>
                                        <select name="severidad" id="severidad" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="OTC">OTC</option>
                                            <option value="SINTAX">SINTAX</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idotc">
                                        <strong>Nivel de OTC</strong>
                                        <select name="otc" id="otc" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="0 a 1">0 a 1</option>
                                            <option value="2 a 3">2 a 3</option>
                                            <option value="4 a 5">4 a 5</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idsintax">
                                        <strong>Nivel de SINTAX</strong>
                                        <select name="sintax" id="sintax" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="Menos de 22">Menos de 22</option>
                                            <option value="23 a 32">23 a 32</option>
                                            <option value="Mas de 33">Mas de 33</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idolusion2">
                                        <strong>Olusiones distales cronicas</strong>
                                        <select name="olusion2" id="olusion2" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                         
                                            $query = "SELECT * FROM olusionesdistalescronicas";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombreolusion']; ?>">
                                                <?php echo $row['nombreolusion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idtratamientovaso">
                                        <strong>Tratamiento del vaso</strong>
                                        <select name="tratamientovaso" id="tratamientovaso" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="Lesion culpable">Lesion culpable</option>
                                            <option value="Todas las lesiones">Todas las lesiones</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idtromboaspiracion">
                                        <strong>Trombo aspiración</strong>
                                        <select name="tromboaspiracion" id="tromboaspiracion" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="idtipoinjerto">
                                        <strong>Tipo de Injerto</strong>
                                        <input type="text" id="tipodeinjerto" name="tipodeinjerto"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <div class="col-md-3" id="idmediocontraste">
                                        <strong>Medio de contraste</strong>
                                        <input type="text" id="mediodecontraste" name="mediodecontraste"
                                            placeholder="Describa" class="form-control">
                                    </div>
                              

                                    <div class="col-md-3" id="iniciofibri">
                                        <strong>Fecha/hora inicio</strong>
                                        <input type="datetime-local" id="iniciofibrilonitico" name="iniciofibrilonitico"
                                            placeholder="Describa" class="form-control">
                                    </div>
                                    <div class="col-md-3" id="finalizofibri">
                                        <strong>Fecha/hora finaliza</strong>
                                        <input type="datetime-local" id="finalizofibrilonitico"
                                            name="finalizofibrilonitico" placeholder="Describa" class="form-control">
                                    </div>

                                    <div class="col-md-3" id="revasculariza">
                                        <strong>Revascularización</strong>
                                        <select name="revascularizacion" id="revascularizacion" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php 
				   
				  $query = "SELECT * FROM revascularizacion ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombre_revascularizacion']; ?>">
                                                <?php echo $row['nombre_revascularizacion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>

                                    <div class="col-md-12"
                                        style="text-align: center; color: white; background-color:#CD114E;">
                                        <strong>COMPLICACIONES</strong>
                                    </div>

                                    <div class="col-md-12">
                                        <strong>Seleccione las complicaciones</strong>
                                        <select id="mscancer" name="mscancer[]" multiple="multiple"
                                            class="form-control">

                                            <?php 
				
				            $query = $conexion->prepare("SELECT * FROM complicaciones ");
                                $query->execute();
                                    $query->setFetchMode(PDO::FETCH_ASSOC);
				                        while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['nombre_compliacion']; ?>">
                                                <?php echo $row['nombre_compliacion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>

                                    <div class="col-md-3" id="arritmias">
                                        <strong>Tipo de Arritmia</strong>
                                        <select name="arritmia" id="arritmia" class="form-control" style="width: 100%;"
                                            required>
                                            <option value="0">Selecciona</option>
                                            <?php 
				
				  $query = "SELECT * FROM arritmia";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['descripcion']; ?>">
                                                <?php echo $row['descripcion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>

                                    <div class="col-md-3" id="tipobloqueo">
                                        <strong>Tipo de bloqueo</strong>
                                        <select name="bloqueo" id="bloqueo" class="form-control" style="width: 100%;"
                                            required>
                                            <option value="0">Selecciona</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12"
                                        style="text-align: center; color: white; background-color:#CD114E; margin-top: 15px;">
                                        <strong>SEGUIMIENTO POSTPROCEDIMIENTO</strong>
                                    </div>

                                    <!--
                                    <div class="col-md-3">
                                        <strong>Marca pasos temporal</strong>
                                        <select name="marcapasostemporal" id="marcapasostemporal" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php 
				  
				  $query = "SELECT * FROM marcapasos_temporal ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['descripcion']; ?>">
                                                <?php echo $row['descripcion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
-->
<div class="col-md-3">
                                        <!-- moverlos -->
                                        <strong>MACE Hospitalario</strong>
                                        <select name="killip" id="killip" class="form-control" style="width: 100%;"
                                            required>
                                            <option value="0">Selecciona</option>
                                            <?php 
			
				  $query = "SELECT * FROM killip_kimball ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombre_killip']; ?>">
                                                <?php echo $row['nombre_killip']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                  
                                    <div class="col-md-3" >
                                        <strong>Causa defunción</strong>
                                        <select name="causadefuncion" id="causadefuncion" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php 
			
				  $query = "SELECT * FROM causa ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['nombre_causa']; ?>">
                                                <?php echo $row['nombre_causa']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                    <div class="col-md-3" >
                                        <strong>Fecha defuncion</strong>
                                        <input type="datetime-local" name="fechadefuncion" id="fechadefuncion"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Fecha de egreso</strong>
                                        <input type="date" id="fechadeegreso" name="fechadeegreso"
                                            placeholder="Describa" class="form-control" rows="2"></input>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <br>


                                    <input type="submit" id="registrar" value="Registrar">&nbsp;&nbsp;
                                    <input type="button" id="recargar" onclick="window.location.reload();"
                                        value="Finalizar">

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
<?php

   ?>