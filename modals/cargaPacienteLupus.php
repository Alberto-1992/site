<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerbucal">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--se agrega estilos para icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalLupus.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">


        <!-- Modal content-->
        <!-- Inicia Modal Header -->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalLupus">
                <span class="material-symbols-outlined" style="color: white;">
                    person_add
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <!-- Finaliza Modal Header -->




            <div class="modal-body">
                <div id="panel_editar">
                    <div class="modal-body">



                        <!-- Header inicial Datos del Paciente -->
                        <div class="form-header">
                            <h5 class="form-title" style="text-align: center;
                                    background-color:  #b763a2;
                                    color: aliceblue;
                                    margin-top:5px;">
                                DATOS DEL PACIENTE </h5>
                        </div>
                        <!-- Fin Header inicial Datos del Paciente -->





                        <form name="formulariocancerbucal" id="formulariocancerbucal" onSubmit="return limpiar()" autocomplete="off">
                            <div class="form-row">
                                <div id="mensaje"></div>
                                <script>
                                    $("#formulariocancerbucal").on("submit", function(e) {
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
                                            "formulariocancerbucal"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarpacienteCancerBucal.php",
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
                                    <input id="year" name="year" class="control form-control" type="hidden" value="2022" required="required" readonly>
                                </div>
                                <div class="col-md-12">
                                    <input id="cest" name="cest" type="hidden" class="form-control" value="cest">
                                </div>





                                <!-- Inicia formulario de Datos del Paciente-->
                                <div class="col-md-4">
                                    <strong>CURP</strong>
                                    <input list="curpusuario" id="curp" name="curp" type="text" class="control form-control" value="" onblur="curp2date();" minlength="18" maxlength="18" required>
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
                                    <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdad();" type="text" class="control form-control" value="" required>
                                </div>


                                <div class="col-md-4">
                                    <strong>Escolaridad</strong>
                                    <select id="escolaridad" name="escolaridad" class="form-control" style="font-size: 12px;">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        require 'conexionCancer.php';
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
                                    <strong>Fecha de nacimiento</strong>
                                    <input id="fecha" name="fecha" type="date" value="" onblur="curp2date();" class="control form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <strong>Edad</strong>
                                    <input id="edad" name="edad" type="text" class="control form-control" value="" readonly>
                                </div>

                                <div class="col-md-4">
                                    <strong>Sexo</strong>
                                    <input type="text" class="control form-control" id="sexo" onclick="curp2date();" name="sexo" readonly>

                                </div>


                                <script>
                                    /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#talla').mask('0.00');
                                    });
                                </script>

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

                                <!--
                                <div class="col-md-4">
                                    <strong>Estado de residencia</strong>

                                    <select name="cbx_estado" id="cbx_estado" class="form-control" style="width: 100%;" required>
                                        <option value="Sin registro" selected>Sin registro</option>
                                        <?php
                                        require 'conexionCancer.php';
                                        $query = "SELECT id_estado, estado FROM t_estado ";
                                        $resultado = $conexion2->query($query);
                                        while ($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['id_estado']; ?>">
                                                <?php echo $row['estado']; ?></option>
                                        <?php } ?>

                                        

                                    </select>

                                </div>
                                <div class="col-md-4">
                                    <strong>Delegación o Municipio</strong>
                                    <select name="cbx_municipio" id="cbx_municipio" class="form-control" style="width: 100%;">

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Referenciado</strong>
                                    <select name="referenciado" id="referenciado" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="medioreferencia">
                                    <strong>Unidad referencia</strong>
                                    <input list="referencias" name="unidadreferencia" id="unidadreferencia" class="form-control">
                                    <datalist id="referencias">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        require 'conexionCancer.php';
                                        $query = $conexionCancer->prepare("SELECT clues, unidad FROM hospitales");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['clues']; ?>">
                                                <?php echo $row['unidad']; ?></option>
                                        <?php } ?>

                                    </datalist>
                                </div>-->

                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de Antecedentes Personales Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center;
                                    background-color: #b763a2;
                                    color:aliceblue;
                                    margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES PERSONALES PATOLÓGICOS</strong>
                                </div>


                                <!-- Inicia Sección de Antecedentes Personales Patológicos-->
                                <div class="col-md-12">
                                    <strong>Antecedentes Personales Patológicos</strong>
                                    <select id="msapp" name="msapp[]" multiple="multiple" class="form-control">
                                        <option value="Alcoholismo"> Alcoholismo</option>
                                        <option value="Artritis Reumatoide"> Artritis Reumatoide</option>
                                        <option value="Diabetes Mellitus"> Diabetes Mellitus</option>
                                        <option value="Hipertension Arterial"> Hipertension Arterial</option>
                                        <option value="Obesidad"> Obesidad</option>
                                        <option value="Sx Antifosfolipidos"> Sx Antifosfolípidos</option>
                                    </select>
                                </div>


                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de Antecedentes Personales Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #b763a2;
                                    color:aliceblue; 
                                    margin-top: 5px; 
                                    font-size: 18px;">
                                    <strong>CLÍNICA</strong>
                                </div>
                                <br>


                                <!--Inicia la sección de ACTIVIDAD LÚPICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>ACTIVIDAD LÚPICA</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Actividad Articular</strong>
                                    <select name="actividadArticular" id="actividadArticular" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Actividad Cutánea</strong>
                                    <select name="actividadCutanea" id="actividadCutanea" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Actividad Hematología</strong>
                                    <select name="actividadHematologia" id="actividadHematologia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Actividad Inmunológica</strong>
                                    <select name="actividadInmuno" id="actividadInmuno" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Actividad Neurológica</strong>
                                    <select name="actividadNeurologica" id="actividadNeurologica" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Actividad Renal</strong>
                                    <select name="actividadRenal" id="actividadRenal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Inicia la sección de CALCULADORA SLEDAI-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>CALCULADORA SLEDAI</strong>
                                </div>

                                <div class="container" id="contenedor">
                                    <!-- <div class="form-check form-check-inline">-->
                                    <!-- <div class="form-check form-check-inline">-->
                                    <div class="custom-control custom-checkbox text-inline">

                                        <!--primera columna-->

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8Convulsion" id="convulsion">
                                            <label for="convulsion" class="form-check-label">Convulsión</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8Psicosis" id="Psicosis">
                                            <label for="Psicosis" class="form-check-label">Psicosis</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8Síndrome Cerebral Orgánico" id="sindromecerebralorganico">
                                            <label for="sindromecerebralorganico" class="form-check-label">Síndrome Cerebral Orgánico</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8AlteracionVisual" id="alteracionvisual">
                                            <label for="alteracionvisual" class="form-check-label">Alteración Visual</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8Trastorno De Los Nervios Craneales" id="tnervioscentrales">
                                            <label for="tnervioscentrales" class="form-check-label">Trastorno De Los Nervios Craneales</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8Dolor De Cabeza Por Lupus" id="dolorcabeza">
                                            <label for="dolorcabeza" class="form-check-label">Dolor De Cabeza Por Lupus</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8EVC" id="evc">
                                            <label for="evc" class="form-check-label">EVC</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="8Vasculitis" id="Vasculitis">
                                            <label for="Vasculitis" class="form-check-label">Vasculitis</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="4Artritis" id="aartritis">
                                            <label for="aartritis" class="form-check-label">Artritis</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="4Miositis" id="Miositis">
                                            <label for="Miositis" class="form-check-label">Miositis</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="4Cilindros Urinarios" id="cilindrosurinarios">
                                            <label for="cilindrosurinarios" class="form-check-label">Cilindros Urinarios</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="4Hematuria" id="hematuria">
                                            <label for="hematuria" class="form-check-label">Hematuria</label>
                                        </div>
                                    </div>

                                    <!--segunda columna-->
                                    <div class="col-md-6">

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="4Piuria" id="Piuria">
                                            <label for="Piuria" class="form-check-label">Piuria</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Proteinuria" id="Proteinuria">
                                            <label for="Proteinuria" class="form-check-label">Proteinuria</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Erupción" id="erupcion">
                                            <label for="erupcion" class="form-check-label">Erupción</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Úlceras De Las Mucosasa" id="ulceras">
                                            <label for="ulceras" class="form-check-label">Úlceras De Las Mucosas</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Pleuritis" id="Pleuritis">
                                            <label for="Pleuritis" class="form-check-label">Pleuritis</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Pericarditis" id="Pericarditis">
                                            <label for="Pericarditis" class="form-check-label">Pericarditis</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Bajo Complemento (C3,C4 O Ch50 Bajo)" id="bajocomplemento">
                                            <label for="bajocomplemento" class="form-check-label">Bajo com(C3,C4 O Ch50 Bajo)</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="2Aumento de la Unión al ADN" id="ADN">
                                            <label for="ADN" class="form-check-label">Aumento de la Unión al ADN</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="1Fiebre" id="fiebre">
                                            <label for="convulsion" class="form-check-label">Fiebre</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="1Trombocitopenia" id="Trombocitopenia">
                                            <label for="Trombocitopenia" class="form-check-label">Trombocitopenia</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="1Leucopenia" id="Leucopenia">
                                            <label for="Leucopenia" class="form-check-label">Leucopenia</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" value="1Alopecia" id="Alopecia">
                                            <label for="Alopecia" class="form-check-label">Alopecia</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"><br>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="resultadosledai"><strong>Resultado SLEDAI</strong></span>
                                        <input type="text" class="form-control" aria-describedby="resultadosledai" readonly value="">
                                    </div>



                                </div>

                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de LABORATORIO-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>LABORATORIOS</strong>
                                </div>


                                <div class="col-md-3">
                                    <strong>Albumina</strong>
                                    <input type="number" step="any" class="form-control" id="albumina" name="albumina" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>BUN</strong>
                                    <input type="number" step="any" class="form-control" id="bun" name="bun" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>C3</strong>
                                    <input type="number" step="any" class="form-control" id="c3" name="c3" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>C4</strong>
                                    <input type="number" step="any" class="form-control" id="c4" name="c4" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>Creatina</strong>
                                    <input type="number" step="any" class="form-control" id="creatina" name="creatina" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>Proteina</strong>
                                    <input type="number" step="any" class="form-control" id="proteina" name="proteina" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>Urea</strong>
                                    <input type="number" step="any" class="form-control" id="urea" name="urea" required>
                                </div>

                                <div class="col-md-3">
                                    <strong>Vitamina D</strong>
                                    <input type="number" step="any" class="form-control" id="vitaminad" name="vitamina4" required>
                                </div>


                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de BIOPSIA RENAL-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>BIOPSIA RENAL</strong>
                                </div>

                                <div class="col-md-6">
                                    <strong>Biopsia Renal</strong>
                                    <select name="biopsiaRenal" id="biopsiaRenal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-6" id="idtipobiopsia">
                                    <strong>Tipo</strong>
                                    <select name="tipobiopsia" id="tipobiopsia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="G. Focal Y Segmentaria">G. Focal Y Segmentaria</option>
                                        <option value="G. Membranosa">G. Membranosa</option>
                                        <option value="G. Proliferativa Difusa">G. Proliferativa Difusa</option>
                                        <option value="Glomerulos Normales">Glomerulos Normales</option>
                                        <option value="Mesangial Pura">Mesangial Pura</option>
                                    </select>
                                </div>

                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de DEFUNCION-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #b763a2;
                                    color:aliceblue; 
                                    margin-top: 5px; 
                                    font-size: 18px;">
                                    <strong>DEFUNCIÓN</strong>
                                </div>

                                <div class="col-md-6">
                                    <strong>Defunción</strong>
                                    <select name="defuncion" id="defuncion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>



                                <!--********************************************************************************************************************************************************************-->
                                <div class="col-md-12"></div>
                                <br>

                                <input type="submit" id="registrar" value="Guardar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                <input type="button" id="recargar" onclick="window.location.reload();" value="Cerrar formulario" style="width: 170px; height: 27px; color: white; background-color: #FA0000; float: left; margin-left: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">


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