<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="artritis">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Fin de la liga-->

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionCancerMama.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalArtritis">
                <!--Se agrega icon de Agregar persona-->
                <span class="material-symbols-outlined">
                    person_add
                </span>
                <!--Finaliza icon-->
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <!--Finaliza Modal header-->


            <!--Inicia Modal Body-->
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- Titulo de Datos del Paciente -->
                            <div class="form-header">
                                <h4 class="form-title" style="text-align: center;
                                    color:aliceblue  ;
                                    background-color:#A9DFBF;
                                    margin-top: 5px;">
                                    DATOS DEL PACIENTE</h4>
                            </div>

                            <form name="formulario" id="formulario" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formulario").on("submit", function(e) {
                                            if ($('input[name=curp]').val().length == 0 || $(
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
                                    <!-- Finaliza Titulo de Datos del Paciente -->





                                    <!--Inicia el formulario de Datos del Paciente-->
                                    <div class="col-md-4">
                                        <strong>CURP</strong>
                                        <input list="curpusuario" id="curp" name="curp" type="text" class="form-control" value="" onblur="curp2date();" minlength="18" maxlength="18" required>
                                        <datalist id="curpusuario">
                                            <option value="">Seleccione</option>
                                            <?php
                                            require 'conexionCancer.php';
                                            $query = $conexionCancer->prepare("SELECT curp FROM dato_usuario ");
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $query->fetch()) { ?>
                                                <option value="<?php echo $row['curp']; ?>">
                                                    <?php echo $row['curp']; ?></option>
                                            <?php } ?>
                                        </datalist>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Nombre Completo</strong>
                                        <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdad();" type="text" class="form-control" value="" required>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Escolaridad</strong>
                                        <select id="escolaridad" name="escolaridad" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = $conexionCancer->prepare("SELECT id_escolaridad, gradoacademico FROM escolaridad");
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $query->fetch()) { ?>
                                                <option value="<?php echo $row['gradoacademico']; ?>">
                                                    <?php echo $row['gradoacademico']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Fecha de Nacimiento</strong>
                                        <input id="fecha" name="fecha" type="date" value="" onblur="curp2date();" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Edad</strong>
                                        <input id="edad" name="edad" type="text" class="form-control" value="" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Sexo</strong>
                                        <input type="text" class="form-control" id="sexo" onclick="curp2date();" name="sexo" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Talla</strong>
                                        <input type="number" step="any" class="form-control" id="talla" name="talla" required>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Peso</strong>
                                        <input type="number" step="any" class="form-control" id="peso" onblur="calculaIMC();" name="peso" required>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>IMC</strong>
                                        <input type="text" class="form-control" id="imc" onblur="calculaIMC();" name="imc" value="" readonly>
                                    </div>
                                    <!--FINALIZA FORMULARIO DE DATOS PERSONALES-->





                                    <!--Inicia formulario de Antecedentes Personales Patológicos-->
                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        ANTECEDENTES PERSONALES PATOLÓGICOS
                                    </div>

                                    <div class="col-md-12">
                                        <strong>Antecedentes Personales Patológicos</strong>
                                        <!-- En el select se deben reemplazar los datos de la tabla 'antecedentescancer' por los siguientes datos,
                                        también debe considerarse que es un múltiple select:
                                            Tabaquismo
                                            Alcoholismo
                                            Esteatosis Hepatica
                                            Diabetes Mellitus
                                            Hipertensión Arterial
                                            Obesidad
                                            Hiperlipidemia
                                        -->

                                        <select id="mscancer" name="mscancer[]" multiple="multiple" class="form-control">
                                            <?php
                                            $query = $conexionCancer->prepare("SELECT relacion FROM antecedentescancer");
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $query->fetch()) { ?>
                                                <option value="<?php echo $row['relacion']; ?>">
                                                    <?php echo $row['relacion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!--Finaliza formulario de Antecedentes Personales Patológicos-->





                                    <!--Inicia sección de Laboratorios, aquí el usuario deberá poder capturar los valores de cada estudio realizado al paciente-->
                                    <div class="col-md-12">
                                        <div class="form-title" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 18px;">
                                            LABORATORIOS
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <strong>Plaquetas</strong>
                                        <input type="number" step="any" class="form-control" id="plaquetas" name="plaquetas" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Basal</strong>
                                        <input type="number" step="any" class="form-control" id="frbasal" name="frbasal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Nominal</strong>
                                        <input type="number" step="any" class="form-control" id="frnominal" name="frbasal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>PCR</strong>
                                        <input type="number" step="any" class="form-control" id="pcr" name="pcr" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Vitamina D Basal</strong>
                                        <input type="number" step="any" class="form-control" id="vitaminaDBasal" name="vitaminaDBasal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Vitamina D Nominal</strong>
                                        <input type="number" step="any" class="form-control" id="vitaminaDNominal" name="vitaminaDNominal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>AC Anticpp Basal</strong>
                                        <input type="number" step="any" class="form-control" id="anticppbasal" name="anticppbasal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>AC Anticpp Nominal</strong>
                                        <input type="number" step="any" class="form-control" id="anticppnominal" name="anticppnominal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>VSG</strong>
                                        <input type="number" step="any" class="form-control" id="vsg" name="vsg" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGO Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgobasal" name="tgobasal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGO Nominal</strong>
                                        <input type="number" step="any" class="form-control" id="tgonominal" name="tgonominal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGP Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgpbasal" name="tgpbasal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGP Nominal</strong>
                                        <input type="number" step="any" class="form-control" id="tgpnominal" name="tgpnominal" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Glucosa</strong>
                                        <input type="number" step="any" class="form-control" id="glucosa" name="glucosa" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Colesterol</strong>
                                        <input type="number" step="any" class="form-control" id="colesterol" name="colesterol" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Trigliceridos</strong>
                                        <input type="number" step="any" class="form-control" id="trigliceridos" name="trigliceridos " required>
                                    </div>
                                    <!--Finaliza sección de Laboratorio-->





                                    <!--Inicia sección USG HEPÁTICO-->
                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        USG HEPÁTICO
                                    </div>

                                    <!-- Los siguientes tres select son de selección simple-->
                                    <div class="col-md-4">
                                        <strong>USG Hepático</strong>
                                        <select name="usghepatico" id="usghepatico" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario Selecciona Sí en USG Hepático, se debe abrir el siguiente select-->

                                    <div class="col-md-4">
                                        <strong>Hallazgo USG</strong>
                                        <select name=" hallazgousg" id="hallazgousg" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="normal">Normal</option>
                                            <option value="cirrosishepatica">Cirrosis Hepática</option>
                                            <option value="esteatosis">Esteatosis</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>
                                            Clasificación Esteatosis</strong>
                                        <select name="clasificacionesteatosis" id="clasificacionesteatosis" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="leve">Leve</option>
                                            <option value="moderada">Moderada</option>
                                            <option value="severa">Severa</option>
                                        </select>
                                    </div>
                                    <!--Finalizan los Select simples-->
                                    <!--Finaliza USG Hepático-->





                                    <!--Inicia la sección Clinica-->
                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        CLINICA
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="articulacionesInflamadasSJC28"> <strong>
                                                    Articulaciones Inflamadas SJC28
                                                </strong></label>
                                            <input type="number" class="form-control" id="articulacionesInflamadasSJC28" placeholder="Ingrese valor...">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="articulacionesDolorosasSJC28"> <strong>
                                                    Articulaciones Dolorosas TJC28
                                                </strong></label>
                                            <input type="number" class="form-control" id="articulacionesDolorosasTJC28" placeholder="Ingrese valor...">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="evglobalpga"> <strong>
                                                    Evaluación Global PGA
                                                </strong></label>
                                            <input type="number" class="form-control" id="evglobalpga" placeholder="Ingrese valor...">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="evega"> <strong>
                                                    Evaluación del Evaluador EGA
                                                </strong></label>
                                            <input type="number" class="form-control" id="evega" placeholder="Ingrese valor...">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="evapaciente"> <strong>
                                                    EVA Paciente
                                                </strong></label>
                                            <input type="number" class="form-control" id="evapaciente" placeholder="Ingrese valor...">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="evamedico"> <strong>
                                                    EVA Médico
                                                </strong></label>
                                            <input type="number" class="form-control" id="evamedico" placeholder="Ingrese valor...">
                                        </div>
                                    </div>-->


                                    <!--Finaliza la Sección Clinica-->





                                    <!-- Inicia sección Tratamiento-->
                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        TRATAMIENTO
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-3">
                                        <strong>Metrotexate</strong>
                                        <br>
                                        <input type="radio" name="metrotexate" id="metrotexate1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="metrotexate" id="metrotexate2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-3" id="dosisSemanal">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanal" name="dosisSemanal" type="text" class="form-control" value="" required>
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-3">
                                        <strong>Leflunomide</strong>
                                        <br>
                                        <input type="radio" name="leflunomide" id="leflunomide1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="leflunomide" id="leflunomide2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-3" id="dosisSemanal">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanal" name="dosisSemanal" type="text" class="form-control" value="" required>
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-3">
                                        <strong>Sulfazalasina</strong>
                                        <br>
                                        <input type="radio" name="sulfazalasina" id="sulfazalasina1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="sulfazalasina" id="sulfazalasina2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-3" id="dosisSemanal">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanal" name="dosisSemanal" type="text" class="form-control" value="" required>
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-3">
                                        <strong>Tocoferol</strong>
                                        <br>
                                        <input type="radio" name="tecoferol" id="tecoferol1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="tecoferol" id="tecoferol2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-3" id="dosisSemanal">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanal" name="dosisSemanal" type="text" class="form-control" value="" required>
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-4">
                                        <strong>Glucocorticoide</strong>
                                        <br>
                                        <input type="radio" name="glucocorticoide" id="glucocorticoide1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="glucocorticoide" id="glucocorticoide2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <!--Si el usuario selecciona Sí en la opción Glucocorticoide, se deben mostrar los siguientes dos selects-->
                                    <div class="col-md-4">
                                        <strong>Tratamiento</strong>
                                        <select name="usghepatico" id="usghepatico" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="deflazacort">Deflazacort</option>
                                            <option value="prednisona">Prednisona</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4" id="dosisSemanal">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanal" name="dosisSemanal" type="text" class="form-control" value="" required>
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-3">
                                        <strong>Vitamina D</strong>
                                        <br>
                                        <input type="radio" name="vitaminaD" id="vitaminaD1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="vitaminaD" id="vitaminaD2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-3" id="dosisSemanal">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanal" name="dosisSemanal" type="text" class="form-control" value="" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>
                                            Biológico</strong>
                                        <select name="gestas" id="gestas" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario selecciona Sí en la opción Biológico, se deben mostrar los siguientes dos selects-->
                                    <div class="col-md-3">
                                        <strong>Tratamiento</strong>
                                        <select name="usghepatico" id="usghepatico" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="rituximab">Rituximab</option>
                                            <option value="abatacept">Abatacept</option>
                                            <option value="aalimumab">Adalimumab</option>
                                            <option value="tocilizumab">Tocilizumab</option>
                                            <option value="pertuzumab">Pertuzumab</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>
                                            Apego a Tratamiento</strong>
                                        <select name="gestas" id="gestas" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="parcial">Parcial</option>
                                            <option value="total">Total</option>
                                            <option value="sinapego">Sin Apego</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <br>
                                        <br>
                                        <!--Se cambia value=Finalizar por value=Cancelar-->
                                        <input type="button" id="recargarArtritis" onclick="window.location.reload();" value="Cancelar">
                                        <!--Se cambia value=Registrar por value=Guardar-->
                                        <input type="submit" id="registrarArtritis" value="Guardar">
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