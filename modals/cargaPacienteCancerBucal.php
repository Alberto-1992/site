<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerbucal">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--se agrega estilos para icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionBucal.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">


        <!-- Modal content-->
        <!-- Inicia Modal Header -->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalBucal">
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
                                    background-color: #d9a4a5;
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
                                <div class="col-md-3">
                                    <strong>Raza</strong>
                                    <input type="text" class="form-control" id="raza" onclick="curp2date();" name="raza">
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

                                <div class="col-md-3">
                                    <strong>Talla</strong>
                                    <input type="number" step="any" class="form-control" id="talla" name="talla" required>

                                </div>
                                <div class="col-md-3">
                                    <strong>Peso</strong>
                                    <input type="number" step="any" class="form-control" id="peso" onblur="calculaIMC();" name="peso" required>

                                </div>
                                <div class="col-md-3">
                                    <strong>IMC</strong>
                                    <input type="text" class="form-control" id="imc" onblur="calculaIMC();" name="imc" value="" readonly>

                                </div>

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

                                        <!--<option value="1">Otro</option>-->

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
                                </div>





                                <!-- Inicia Sección de Antecedentes No Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES NO PATOLOGICOS</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Exposición Solar</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Comidas al día</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="unacomida">1</option>
                                        <option value="doscomidas">2</option>
                                        <option value="trescomidas">3 o más</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Higiene Bucal</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="unavez">1 vez al día</option>
                                        <option value="dosveces">2 veces al día</option>
                                        <option value="tresveces">3 o más veces al día</option>
                                    </select>
                                </div>
                                <!-- Finaliza Sección de Antecedentes No Patológicos-->




                                <!--********************************************************************************************************************************************************************-->

                                <!--Inicia la sección de Antecedentes Personales Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES PERSONALES PATOLÓGICOS</strong>
                                </div>


                                <!-- Inicia Sección de Toxicomanias-->
                                <div class="col-md-4" id="tipodetoxicomanias">
                                    <strong>Toxicomanias</strong>
                                    <select id="mstoxicomanias" name="mstoxicomanias[]" multiple="multiple" class="form-control">
                                        <option value="alcoholismo"> Alcoholismo</option>
                                        <option value="cocaina"> Cocaina</option>
                                        <option value="marihuana"> Marihuana</option>
                                        <option value="medicamentoscontrolados"> Medicamentos Controlados</option>
                                        <option value="solventes"> Solventes</option>
                                        <option value="tabaquismo"> Tabaquismo</option>
                                    </select>
                                </div>
                                <!-- si selecciona SÍ en Tabaquismo, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-4" id="anostabaquismo">
                                    <strong>Años Tabaquismo:</strong>
                                    <input id="anostabaquismo" name="anostabaquismo" type="number" class="form-control" placeholder="Ingrese años..." value="" required>
                                </div>
                                <div class="col-md-4" id="cigarrosdia">
                                    <strong>Cigarros al día:</strong>
                                    <input id="cigarrosdia" name="cigarrosdia" type="number" class="form-control" placeholder="Ingrese cigarros al día..." value="" required>
                                </div>
                                <!-- si selecciona SÍ en ALCOHOLISMO, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-4">
                                    <strong>Frecuencia Alcoholismo:</strong>
                                    <select name="frecuenciaal" id="frecuenciaal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="social">Social</option>
                                        <option value="embriaguez">Embriaguez</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Sección de Toxicomanias-->


                                <!-- Select múltiple HÁBITOS-->
                                <div class="col-md-4" id="tipodehabitos">
                                    <strong>Hábitos</strong>
                                    <select id="mshabitos" name="mshabitos[]" multiple="multiple" class="form-control">
                                        <option value="autolesiones"> Autolesiones</option>
                                        <option value="bruxismo"> Bruxismo</option>
                                        <option value="interposicionlingual"> Interposición Lingual</option>
                                        <option value="onicofagia"> Onicofagía</option>
                                        <option value="queilofagia"> Queilofagía</option>
                                        <option value="respiracionoral"> Respiración Oral</option>
                                        <option value="succionlabial"> Succión Labial</option>
                                        <option value="succiondigital"> Succión Digital</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple HÁBITOS-->


                                <!-- Select múltiple  Virus-->
                                <div class="col-md-4" id="tipodevirus">
                                    <strong>Virus</strong>
                                    <select id="msvirus" name="msvirus[]" multiple="multiple" class="form-control">
                                        <option value="vih"> VIH </option>
                                        <option value="vph"> VPH</option>
                                        <option value="ieb"> I. Epstein Barr</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple  Virus-->


                                <!-- Select múltiple  CÁNCER-->
                                <div class="col-md-4" id="tipodecancer">
                                    <strong>Cáncer</strong>
                                    <select id="mscancer" name="mscancer[]" multiple="multiple" class="form-control">
                                        <option value="colon"> Colon y Recto </option>
                                        <option value="endometrio"> Endometrio</option>
                                        <option value="gastrico"> Gastrico</option>
                                        <option value="higado"> Hígado </option>
                                        <option value="leucemia"> Leucemia</option>
                                        <option value="linfoma"> Linfoma No Hodgkin</option>
                                        <option value="mama"> Mama </option>
                                        <option value="melanoma"> Melanoma</option>
                                        <option value="ovario"> Ovario</option>
                                        <option value="pancreas"> Páncreas </option>
                                        <option value="prostata"> Prostata</option>
                                        <option value="pulmon"> Pulmón</option>
                                        <option value="rinon"> Riñón </option>
                                        <option value="testiculo"> Testículo</option>
                                        <option value="tiroides"> Tiroides</option>
                                        <option value="vejiga"> Vejiga</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple CÁNCER-->




                                <!--Inicia la sección de AFECTACIONES ORALES-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #d9a4a5;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>AFECTACIONES ORALES</strong>
                                </div>

                                <!-- FINALIZA Select múltiple AFECTACIONES ORALES-->
                                <div class="col-md-12" id="tipodeao">
                                    <strong>Afectaciones Orales</strong>
                                    <select id="msao" name="msao[]" multiple="multiple" class="form-control">
                                        <option value="eperiodontal"> Afectación Dental </option>
                                        <option value="odf"> Lesiones Orales</option>
                                        <option value="protesisfd"> Ubicación</option>
                                    </select>
                                </div>


                                <!--inicia Afectación Dental-->
                                <div class="col-md-12" id="tituloafectaciondental" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>AFECTACIÓN DENTAL</strong>
                                </div>

                                <!-- Select múltiple AFECTACIONES ORALES-->
                                <div class="col-md-12" id="tipodeodf">
                                    <strong>Órgano Oral Lesionado</strong>
                                    <select id="msodf" name="msodf[]" multiple="multiple" class="form-control">
                                        <option value="eperiodontal"> Enfermedad Periodontal </option>
                                        <option value="odf"> Órgano Dental Fracturado</option>
                                        <option value="protesisfd"> Protesis Fija Desajustada</option>
                                        <option value="protesisff"> Protesis Fija Fracturada</option>
                                        <option value="protesisrd"> Protesis Removible Desajustada </option>
                                        <option value="protesisrf"> Protesis Removible Fracturada</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple AFECTACIONES ORALES-->


                                <!--Si selecciona ORGANO DENTAL FRACTURADO, se deben habilitar los siguientes 4 multi select:-->

                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxilarsd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxilarsuperiorderecho" name="msmaxilarsuperiorderecho[]" multiple="multiple" class="form-control">
                                        <option value="once"> 11</option>
                                        <option value="doce"> 12</option>
                                        <option value="trce"> 13</option>
                                        <option value="catorce"> 14</option>
                                        <option value="quince"> 15</option>
                                        <option value="dieciseis"> 16</option>
                                        <option value="diecisiete"> 17</option>
                                        <option value="dieciocho"> 18</option>
                                    </select>
                                </div>

                                <!--Inferior derecho-->
                                <div class="col-md-3" id="maxilarid">
                                    <strong>Maxilar Inferior Derecho</strong>
                                    <select id="msmaxilarinferiorderecho" name="msmaxilarinferiorderecho[]" multiple="multiple" class="form-control">
                                        <option value="41"> 41</option>
                                        <option value="42"> 42</option>
                                        <option value="43"> 43</option>
                                        <option value="44"> 44</option>
                                        <option value="45"> 45</option>
                                        <option value="46"> 46</option>
                                        <option value="47"> 47</option>
                                        <option value="48"> 48</option>
                                    </select>
                                </div>

                                <!--Superior izquierdo-->
                                <div class="col-md-3" id="maxilarsd">
                                    <strong>Maxilar Superior Izquierdo</strong>
                                    <select id="msmaxilarsuperiorizquierdo" name="msmaxilarsuperiorizquierdo[]" multiple="multiple" class="form-control">
                                        <option value="21"> 21</option>
                                        <option value="22"> 22</option>
                                        <option value="23"> 23</option>
                                        <option value="24"> 24</option>
                                        <option value="25"> 25</option>
                                        <option value="26"> 26</option>
                                        <option value="27"> 27</option>
                                        <option value="28"> 28</option>
                                    </select>
                                </div>

                                <!--Inferior izquierdo -->
                                <div class="col-md-3" id="maxilarid">
                                    <strong>Maxilar Inferior Izquierdo</strong>
                                    <select id="msmaxilarinferiorizquierdo" name="msmaxilarinferiorizquierdo[]" multiple="multiple" class="form-control">
                                        <option value="31"> 31</option>
                                        <option value="32"> 32</option>
                                        <option value="33"> 33</option>
                                        <option value="34"> 34</option>
                                        <option value="35"> 35</option>
                                        <option value="36"> 36</option>
                                        <option value="37"> 37</option>
                                        <option value="38"> 38</option>
                                    </select>
                                </div>
                                <!--Finalizan los 4 multi select-->


                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>LESIONES ORALES</strong>
                                </div>

                                <!--Select simple de tipo de tejido:-->
                                <div class="col-md-4" id="">
                                    <strong>Tipo de Tejido:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="blando">Blando</option>
                                        <option value="duro">Duro</option>
                                    </select>
                                </div>


                                <!--Select múltiple de tipo de lesión -->
                                <div class="col-md-4" id="tipolesion">
                                    <strong>Tipo Lesión:</strong>
                                    <select id="mstipodelesion" name="mstipodelesion[]" multiple="multiple" class="form-control">
                                        <option value="melatonica"> Melatónica</option>
                                        <option value="nodulo"> Nodulo</option>
                                        <option value="pigmentada"> Pigmentada</option>
                                        <option value="tumor">Tumor</option>
                                        <option value="ulcera"> Ulcera</option>
                                        <option value="verruga"> Verruga</option>
                                        <option value="vesicula"> Vesicula</option>

                                    </select>
                                </div>


                                <!--Si se selecciona la opción PIGMENTADA se debe habilitar el siguiente select simple-->
                                <div class="col-md-4" id="">
                                    <strong>Coloración:</strong>
                                    <select name="colorpigmentada" id="colorpigmentada" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="blanca">Blanca</option>
                                        <option value="roja">Roja</option>
                                        <option value="blancaroja">Blanca / Roja</option>
                                    </select>
                                </div>



                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>UBICACIÓN</strong>
                                </div>


                                <!--Select múltiple de ubicación -->
                                <div class="col-md-4" id="ubicacion">
                                    <strong>Tipo Lesión:</strong>
                                    <select id="msubicacion" name="msubicacion[]" multiple="multiple" class="form-control">
                                        <option value="melatonica"> Melatónica</option>
                                        <option value="nodulo"> Nodulo</option>
                                        <option value="pigmentada"> Pigmentada</option>
                                    </select>
                                </div>


                                <!--********************************************************************************************************************************************************************-->

                                <div class="col-md-12"></div>
                                <br>


                                <input type="submit" id="registrar" value="Registrar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
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