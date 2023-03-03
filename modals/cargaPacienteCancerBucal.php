<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerbucal">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
                                    <input list="curpusuario" id="curp" name="curp" type="text" class="control form-control" onblur="curp2datebucal();" minlength="18" maxlength="18" required>
                                    <datalist id="curpusuario">
                                        <option value="">Seleccione</option>
                                        <?php
                                        require 'conexionCancer.php';
                                        $query = $conexionCancer->prepare("SELECT curpbucal FROM dato_usuariobucal ");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['curpbucal']; ?>">
                                                <?php echo $row['curpbucal']; ?></option>
                                        <?php } ?>
                                    </datalist>
                                </div>


                                <div class="col-md-4">
                                    <strong>Nombre Completo</strong>
                                    <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdadbucal();" type="text" class="control form-control" required>
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
                                    <input id="fecha" name="fecha" type="date" onblur="curp2datebucal();" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <strong>Edad</strong>
                                    <input id="edad" name="edad" type="text" class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <strong>Sexo</strong>
                                    <input type="text" class="form-control" id="sexo" onclick="curp2datebucal();" name="sexo" readonly>

                                </div>
                                <div class="col-md-3">
                                    <strong>Raza</strong>
                                    <input type="text" class="form-control" id="raza" onclick="curp2datebucal();" name="raza">
                                </div>

                                <script>
                                    /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#tallabucal').mask('0.00');
                                    });
                                </script>

                                <div class="col-md-3">
                                    <strong>Talla</strong>
                                    <input type="number" step="any" class="form-control" id="tallabucal" name="tallabucal" required>

                                </div>
                                <div class="col-md-3">
                                    <strong>Peso</strong>
                                    <input type="number" step="any" class="form-control" id="pesobucal" onblur="calculaIMC();" name="pesobucal" required>

                                </div>
                                <div class="col-md-3">
                                    <strong>IMC</strong>
                                    <input type="text" class="form-control" id="imcbucal" onblur="calculaIMC();" name="imcbucal" value="" readonly>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3 o más</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Higiene Bucal</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="1 vez al dia">1 vez al día</option>
                                        <option value="2 veces al dia">2 veces al día</option>
                                        <option value="3 o mas veces al dia">3 o más veces al día</option>
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
                                <div class="col-md-12" id="tipodetoxicomanias">
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
                                <div class="col-md-4" id="yearstabaquismo">
                                    <strong>Años Tabaquismo:</strong>
                                    <input id="anostabaquismo" name="anostabaquismo" type="number" class="form-control" placeholder="Ingrese años..." value="" required>
                                </div>
                                <div class="col-md-4" id="diacigarros">
                                    <strong>Cigarros al día:</strong>
                                    <input id="cigarrosdia" name="cigarrosdia" type="number" class="form-control" placeholder="Ingrese cigarros al día..." value="" required>
                                </div>
                                <!-- si selecciona SÍ en ALCOHOLISMO, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-4">
                                    <strong>Frecuencia Alcoholismo:</strong>
                                    <select name="frecuenciaal" id="frecuenciaal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Social">Social</option>
                                        <option value="Embriaguez">Embriaguez</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Sección de Toxicomanias-->


                                <!-- Select múltiple HÁBITOS-->
                                <div class="col-md-3" id="tipodehabitos">
                                    <strong>Hábitos</strong>
                                    <select id="mshabitos" name="mshabitos[]" multiple="multiple" class="form-control">
                                        <option value="Autolesiones"> Autolesiones</option>
                                        <option value="Bruxismo"> Bruxismo</option>
                                        <option value="Interposicion Lingual"> Interposición Lingual</option>
                                        <option value="Onicofagia"> Onicofagía</option>
                                        <option value="Queilofagia"> Queilofagía</option>
                                        <option value="Respiracion Oral"> Respiración Oral</option>
                                        <option value="Succion Labial"> Succión Labial</option>
                                        <option value="Succion Digital"> Succión Digital</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple HÁBITOS-->


                                <!-- Select múltiple  Virus-->
                                <div class="col-md-3" id="tipodevirus">
                                    <strong>Virus</strong>
                                    <select id="msvirus" name="msvirus[]" multiple="multiple" class="form-control">
                                        <option value="VIH"> VIH </option>
                                        <option value="VPH"> VPH</option>
                                        <option value="I. Epstein Barr"> I. Epstein Barr</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple  Virus-->


                                <!-- Select múltiple  CÁNCER-->
                                <div class="col-md-3" id="tipodecancer">
                                    <strong>Cáncer</strong>
                                    <select id="mscancer" name="mscancer[]" multiple="multiple" class="form-control">
                                        <option value="Colon y Recto"> Colon y Recto </option>
                                        <option value="Endometrio"> Endometrio</option>
                                        <option value="Gastrico"> Gastrico</option>
                                        <option value="Higado"> Hígado </option>
                                        <option value="Leucemia"> Leucemia</option>
                                        <option value="Linfoma No Hodgkin"> Linfoma No Hodgkin</option>
                                        <option value="Mama"> Mama </option>
                                        <option value="Melanoma"> Melanoma</option>
                                        <option value="Ovario"> Ovario</option>
                                        <option value="Pancreas"> Páncreas </option>
                                        <option value="Prostata"> Próstata</option>
                                        <option value="Pulmon"> Pulmón</option>
                                        <option value="Rinon"> Riñón </option>
                                        <option value="Testiculo"> Testículo</option>
                                        <option value="Tiroides"> Tiroides</option>
                                        <option value="Vejiga"> Vejiga</option>
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
                                        <option value="Afectacion Dental"> Afectación Dental </option>
                                        <option value="Lesiones Orales"> Lesiones Orales</option>
                                        <option value="Ubicacion"> Ubicación</option>
                                    </select>
                                </div>


                                <!-- del select múltiple de Afectaciones Orales, si se selecciona Afectación Dental, se debe abrir la siguiente sección-->
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
                                        <option value="Enfermedad Periodontal"> Enfermedad Periodontal </option>
                                        <option value="Organo Dental Fracturado"> Órgano Dental Fracturado</option>
                                        <option value="Protesis Fija Desajustada"> Protesis Fija Desajustada</option>
                                        <option value="Protesis Fija Fracturada"> Protesis Fija Fracturada</option>
                                        <option value="Protesis Removible Desajustada"> Protesis Removible Desajustada </option>
                                        <option value="Protesis Removible Fracturada"> Protesis Removible Fracturada</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple AFECTACIONES ORALES-->


                                <!--Si selecciona ORGANO DENTAL FRACTURADO, se deben habilitar los siguientes 4 multi select:-->
                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxilarsd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxilarsuperiorderecho" name="msmaxilarsuperiorderecho[]" multiple="multiple" class="form-control">
                                        <option value="11"> 11</option>
                                        <option value="12"> 12</option>
                                        <option value="13"> 13</option>
                                        <option value="14"> 14</option>
                                        <option value="15"> 15</option>
                                        <option value="16"> 16</option>
                                        <option value="17"> 17</option>
                                        <option value="18"> 18</option>
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
                                <div class="col-md-3" id="maxilarsd2">
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
                                <div class="col-md-3" id="maxilarid2">
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
                                <!--Finaliza la sección ORGANO DENTAL FRACTURADO-->




                                <!-- del select múltiple de Afectaciones Orales, si se selecciona LESIONES ORALES, se debe abrir la siguiente sección-->
                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>LESIONES ORALES</strong>
                                </div>

                                <!--Seleccion de sí o no en lesión oral:-->
                                <div class="col-md-3" id="">
                                    <strong>¿Lesión Oral?:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Sí">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Sí hay lesión oral, se hablitan:-->
                                <div class="col-md-3" id="">
                                    <strong>Tipo de Tejido:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Blando">Blando</option>
                                        <option value="Duro">Duro</option>
                                    </select>
                                </div>

                                <!--Select múltiple de tipo de lesión -->
                                <div class="col-md-3" id="tipolesion">
                                    <strong>Tipo Lesión:</strong>
                                    <select id="mstipodelesion" name="mstipodelesion[]" multiple="multiple" class="form-control">
                                        <option value="Melatonica"> Melatónica</option>
                                        <option value="Nodulo"> Nodulo</option>
                                        <option value="Pigmentada"> Pigmentada</option>
                                        <option value="Tumor">Tumor</option>
                                        <option value="Ulcera"> Ulcera</option>
                                        <option value="Verruga"> Verruga</option>
                                        <option value="Vesicula"> Vesicula</option>

                                    </select>
                                </div>

                                <!--Si se selecciona la opción PIGMENTADA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Coloración:</strong>
                                    <select name="colorpigmentada" id="colorpigmentada" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Blanca">Blanca</option>
                                        <option value="Roja">Roja</option>
                                        <option value="Blanca y Roja">Blanca / Roja</option>
                                    </select>
                                </div>
                                <!-- Fin sección LESIONES ORALES-->



                                <!-- del select múltiple de Afectaciones Orales, si se selecciona UBICACIÓN, se debe abrir la siguiente sección-->
                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>UBICACIÓN</strong>
                                </div>


                                <!--Select múltiple de ubicación -->
                                <div class="col-md-12" id="ubicacion">
                                    <strong>Ubicación:</strong>
                                    <select id="msubicacion" name="msubicacion[]" multiple="multiple" class="form-control">
                                        <option value="Derecha"> Derecha</option>
                                        <option value="Izquierda"> Izquierda</option>
                                    </select>
                                </div>


                                <!---->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #b3cefd;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>Ubicación Derecha</strong>
                                </div>

                                <div class="col-md-12" id="">
                                    <strong>Subsitio Anatómico:</strong>
                                    <select id="msqueva" name="msqueva[]" multiple="multiple" class="form-control">
                                        <option value="Cuerpo Mandibular"> Cuerpo Mandibular</option>
                                        <option value="Encia Superior"> Encia Superior</option>
                                        <option value="Labios"> Labios</option>
                                        <option value="Lengua"> Lengua</option>
                                        <option value="Encia Inferior"> Encia Inferior </option>
                                        <option value="Maxilar Posterior"> Maxilar Posterior</option>
                                        <option value="Mucosa Bucal"> Mucosa Bucal</option>
                                        <option value="Paladar Blando"> Paladar Blando</option>
                                        <option value="Paladar Duro"> Paladar Duro</option>
                                        <option value="Piso"> Piso</option>
                                        <option value="Premaxilar"> Premaxilar</option>
                                        <option value="Proceso Alveolar"> Proceso Alveolar</option>
                                        <option value="Rama Mandibular"> Rama Mandibular</option>
                                        <option value="Trigono Retromolar"> Trigono Retromolar</option>
                                    </select>
                                </div>


                                <!--Si se selecciona la opción LABIOS se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Labios:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Labio Inferior">Labio Inferior</option>
                                        <option value="Labio Superior">Labio Superior</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción LENGUA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Lengua:</strong>
                                    <select name="lengua" id="lengua" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Borde Lateral">Borde Lateral</option>
                                        <option value="Cara Ventral">Cara Ventral</option>
                                        <option value="Dorso">Dorso</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción PALADAR BLANDO se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Paladar Blando:</strong>
                                    <select name="paladarblando" id="paladarblando" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Boveda de Paladar">Boveda de Paladar</option>
                                        <option value="Velo de Paladar">Velo de Paladar</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción ENCIA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Encia:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bucal">Bucal</option>
                                        <option value="Interpapilar">Interpapilar</option>
                                        <option value="Lingual">Lingual</option>
                                        <option value="Paladar">Paladar</option>
                                    </select>
                                </div>


                                <!-- esta pendiente definir con qué campo se relaciona-->
                                <div class="col-md-6" id="">
                                    <strong>¿Está relacionado con un órgano dental?:</strong>
                                    <select name="relacion" id="relacion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div><br><br>

                                <!--Si SÍ está comprometido con un órgano dental, se deben mostrar los siguientes MS-->
                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxisd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxisd" name="msmaxisd[]" multiple="multiple" class="form-control">
                                        <option value="11"> 11</option>
                                        <option value="12"> 12</option>
                                        <option value="13"> 13</option>
                                        <option value="14"> 14</option>
                                        <option value="15"> 15</option>
                                        <option value="16"> 16</option>
                                        <option value="17"> 17</option>
                                        <option value="18"> 18</option>
                                    </select>
                                </div>

                                <!--Inferior derecho-->
                                <div class="col-md-3" id="maxiid">
                                    <strong>Maxilar Inferior Derecho</strong>
                                    <select id="msmaxiid" name="msmaxiid[]" multiple="multiple" class="form-control">
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


                                <!---->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #b3cefd;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>Ubicación Izquierda</strong>
                                </div>


                                <div class="col-md-12" id="">
                                    <strong>Subsitio Anatómico:</strong>
                                    <select id="msqueva2" name="msqueva2[]" multiple="multiple" class="form-control">
                                        <option value="Cuerpo Mandibular"> Cuerpo Mandibular</option>
                                        <option value="Encia Superior"> Encia Superior</option>
                                        <option value="Labios"> Labios</option>
                                        <option value="Lengua"> Lengua</option>
                                        <option value="Encia Inferior"> Encia Inferior </option>
                                        <option value="Maxilar Posterior"> Maxilar Posterior</option>
                                        <option value="Mucosa Bucal"> Mucosa Bucal</option>
                                        <option value="Paladar Blando"> Paladar Blando</option>
                                        <option value="Paladar Duro"> Paladar Duro</option>
                                        <option value="Piso"> Piso</option>
                                        <option value="Premaxilar"> Premaxilar</option>
                                        <option value="Proceso Alveolar"> Proceso Alveolar</option>
                                        <option value="Rama Mandibular"> Rama Mandibular</option>
                                        <option value="Trigono Retromolar"> Trigono Retromolar</option>
                                    </select>
                                </div>


                                <!--Si se selecciona la opción LABIOS se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Labios:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Labio Inferior">Labio Inferior</option>
                                        <option value="Labio Superior">Labio Superior</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción LENGUA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Lengua:</strong>
                                    <select name="lengua" id="lengua" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Borde Lateral">Borde Lateral</option>
                                        <option value="Cara Ventral">Cara Ventral</option>
                                        <option value="Dorso">Dorso</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción PALADAR BLANDO se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Paladar Blando:</strong>
                                    <select name="paladarblando" id="paladarblando" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Boveda de Paladar">Boveda de Paladar</option>
                                        <option value="Velo de Paladar">Velo de Paladar</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción ENCIA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Encia:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bucal">Bucal</option>
                                        <option value="Interpapilar">Interpapilar</option>
                                        <option value="Lingual">Lingual</option>
                                        <option value="Paladar">Paladar</option>
                                    </select>
                                </div><br><br>

                                <!-- esta pendiente definir con qué campo se relaciona-->
                                <div class="col-md-6" id="">
                                    <strong>¿Está relacionado con un órgano dental?:</strong>
                                    <select name="relacion" id="relacion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div><br><br>


                                <!--Si SÍ está comprometido con un órgano dental, se deben mostrar los siguientes MS-->
                                <!--Superior izquierdo-->
                                <div class="col-md-3" id="maxisi">
                                    <strong>Maxilar Superior Izquierdo</strong>
                                    <select id="msmaxisi" name="msmaxisi[]" multiple="multiple" class="form-control">
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
                                <div class="col-md-3" id="maxiiz">
                                    <strong>Maxilar Inferior Izquierdo</strong>
                                    <select id="msmaxiiz" name="msmaxiiz[]" multiple="multiple" class="form-control">
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



                                <!--********************************************************************************************************************************************************************-->

                                <!--Inicia la sección de ATENCIÓN CLINICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ATENCIÓN CLINICA</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Fecha primer atención:</strong>
                                    <input type="date" id="fechaatencioninicial" name="fechaatencioninicial" class="form-control">
                                </div>

                                <div class="col-md-4" id="estadiocli">
                                    <strong>Estadío Clinico</strong>
                                    <select name="estadioclinico" id="estadioclinico" class="form-control">
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
                                    <select name="etapaclinica" id="etapaclinica" class="form-control" readonly>
                                        <option value="TNM" selected>TNM</option>

                                    </select>
                                </div>



                                <div class="col-md-4">
                                    <strong>Tamaño tumoral</strong>
                                    <select name="tamaniotumoral" id="tamaniotumoral" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="TX: Tumor primario no puede ser evaluado">TX: Tumor primario no puede ser evaluado </option>
                                        <option value="Tis: Carcinoma insitu">Tis: Carcinoma insitu </option>
                                        <option value="T1 Menor o igual a 2cm">T1 Menor o igual a 2cm</option>
                                        <option value="T3 mas de 5cm">T3 mas de 5cm </option>
                                        <option value="T4 cualquier tamaño extension a piel o pared toracica">T4 cualquier tamaño extension a piel o pared toracica</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Compromiso Linfático Nodal</strong>
                                    <select name="tamaniotumoral" id="tamaniotumoral" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="NX: No puede ser evaluado por falta de datos">NX: No puede ser evaluado por falta de datos </option>
                                        <option value="N0:Ausencia de adenopatias palpables">N0:Ausencia de adenopatias palpables</option>
                                        <option value="N1: Mets. Axilar homolateral movil palpable">N1: Mets. Axilar homolateral movil palpable</option>
                                        <option value="N2. Mets. Axilar homolateral fija o mets en mamaria interna detectable por imagen o por E.F. en ausencia clinica de mets en axila">N2. Mets. Axilar homolateral fija o mets en mamaria interna detectable por imagen o por E.F. en ausencia clinica de mets en axila </option>
                                        <option value="N3. Metastasis en ganglios infra o supraclaviculares">N3. Metastasis en ganglios infra o supraclaviculares</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Metástasis</strong>
                                    <select name="tamaniotumoral" id="tamaniotumoral" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="MX: No se pueden evaluar metastasis distantes">MX: No se pueden evaluar metastasis distantes</option>
                                        <option value="M0 Sin enfermedad a distancia">M0 Sin enfermedad a distancia</option>
                                        <option value="M1 Con enfermedad metastasica">M1 Con enfermedad metastasica</option>
                                    </select>
                                </div>

                                <!-- SI SE SELECCIONA M1 EN METÁSTASIS, SE DEBE HABILITAR EL SIGUIENTE SELECT MÚLTIPLE-->
                                <div class="col-md-4">
                                    <strong>Sitio Metástasis</strong>
                                    <select id="mssitiometastasis" name="mssitiometastasis[]" multiple="multiple" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Hepatica">Hepatica</option>
                                        <option value="Pulmonar">Pulmonar</option>
                                        <option value="Cerebrales">Cerebrales</option>
                                        <option value="Oseas">Óseas</option>
                                        <option value="Cervicouterino">Cervicouterino</option>
                                        <option value="Mediastino">Mediastino</option>
                                        <option value="Suprarrenal">Suprarrenal</option>
                                        <option value="Tiroidea">Tiroidea</option>
                                        <option value="Ganglionar">Ganglionar</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Calidad de vida ECOG</strong>
                                    <select name="tamaniotumoral" id="tamaniotumoral" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Ecog 0  Desempeño Funcional Normal">Ecog 0 Desempeño Funcional Normal</option>
                                        <option value="Ecog 1 Desempeño Leve">Ecog 1 Desempeño Leve</option>
                                        <option value="Ecog 2 El 50% Del Tiempo Postrado">Ecog 2 El 50% Del Tiempo Postrado</option>
                                        <option value="Ecog 3 Mas Del 50% Postrado">Ecog 3 Mas Del 50% Postrado </option>
                                        <option value="Ecog 4 Dependiente Al 100% Para Vida Basica">Ecog 4 Dependiente Al 100% Para Vida Basica</option>
                                        <option value="Ecog 5 Fallecio">Ecog 5 Fallecio</option>
                                    </select>
                                </div>

                                <!--********************************************************************************************************************************************************************-->





                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de HISTOPATOLOGÍA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>HISTOPATOLOGÍA</strong>
                                </div>


                                <div class="col-md-12" id="estadiocli">
                                    <strong>Dx Histopatologico</strong>
                                    <select name="dxhistopatologico" id="dxhistopatologico" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Adenocarcinoma">Adenocarcinoma</option>
                                        <option value="Adenoideoquistico">Adenoideoquistico</option>
                                        <option value="Basocelular">Basocelular</option>
                                        <option value="Carcinoma Ameloblastico">Carcinoma Ameloblastico</option>
                                        <option value="Epidermoide o Celulas Escamosas (Verrucoso o Basaloide)">Epidermoide o Celulas Escamosas (Verrucoso o Basaloide)</option>
                                        <option value="Linfoma">Linfoma</option>
                                        <option value="Melanoma">Melanoma</option>
                                        <option value="Metastasico">Metastásico</option>
                                        <option value="Neuroendocrino">Neuroendocrino</option>
                                        <option value="Sarcoma de Kaposi">Sarcoma de Kaposi</option>
                                        <option value="Sarcomatoide">Sarcomatoide</option>
                                    </select>
                                </div>



                                <div class="col-md-4">
                                    <strong>Fecha de Reporte:</strong>
                                    <input type="date" id="fechareporte" name="fechareporte" class="form-control">
                                </div>


                                <div class="col-md-4" id="">
                                    <strong>Tipo:</strong>
                                    <select name="tipohisto" id="tipohisto" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Benigno">Benigno</option>
                                        <option value="Maligno">Maligno</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Maligno, se debe mostrar el siguiente select-->
                                <div class="col-md-4" id="">
                                    <strong>Maligno:</strong>
                                    <select name="maligno" id="maligno" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bien Diferenciado">Bien Diferenciado</option>
                                        <option value="Poco Diferenciado">Poco Diferenciado</option>
                                        <option value="Indefinido">Indefinido</option>
                                    </select>
                                </div>



                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de INMUNOHISTOQUIMICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>INMUNOHISTOQUÍMICA</strong>
                                </div>

                                <div class="col-md-4" id="">
                                    <strong>¿Se realizó PDL?</strong>
                                    <select name="pdl" id="pdl" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si sí se realizó PDL se debe habilitar el siguiente campo-->

                                <div class="col-md-4">
                                    <strong id="inmuno-title">PDL</strong>
                                    <input type="number" id="pdl" name="pdl" placeholder="%" class="form-control" value="%">
                                </div>



                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de TRATAMIENTO, en esta sección se deben ver, de inicio solo tres campos QUIRURGICO, RECONSTRUCCIÓN Y RADIOTERAPIA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>TRATAMIENTO</strong>
                                </div>

                                <!--PRIMER SELECT VISIBLE DE INICIO, QUIRURGICO-->
                                <div class="col-md-12" id="idquirurgico">
                                    <strong>*Quirurgico</strong>
                                    <select name="quirurgico" id="quirurgico" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si selecciona que sí en QUIRURGICO, se debe habilitar lo siguiente-->
                                <div class="col-md-4" id="idtipoquirurgico">
                                    <strong>Tipo de Cirugía</strong>
                                    <select name="tipoquirurgico" id="tipoquirurgico" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Amigdalectomia">Amigdalectomía</option>
                                        <option value="Comando">Comando</option>
                                        <option value="Diseccion Radical Modificada de Cuello">Disección Radical Modificada de Cuello</option>
                                        <option value="Excision Local Amplia">Excision Local Amplia</option>
                                        <option value="Glosectomia Parcial">Glosectomía Parcial</option>
                                        <option value="Hemiglosectomia">Hemiglosectomía</option>
                                        <option value="Mandibulectomia (Parcial, Segmentaria, Maginal)">Mandibulectomía (Parcial, Segmentaria, Maginal)</option>
                                        <option value="Maxilectomia de Infraestructura">Maxilectomia de Infraestructura</option>
                                        <option value="Maxilectomia de Superestructura">Maxilectomia de Superestructura</option>
                                        <option value="Reseccion de Glandula Salival Menor">Resección de Glándula Salival Menor</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Maxilectomia de Infraestructura, se debe mostrar lo siguiente-->
                                <div class="col-md-8" id="idmaxinfra">
                                    <strong>Maxilectomia de Infraestructura</strong>
                                    <select name="maxinfra" id="maxinfra" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Clase I. Reseccion quirurgica clasica del maxilar que abarca paladar duro y dentición hasta la linea media, es unilateral.">Clase I. Resección quirúrgica clásica del maxilar que abarca paladar duro y dentición hasta la línea media, es unilateral.</option>
                                        <option value="Clase II. Incluye defectos que mantienen la denticion del lado contralateral. Es unilateral posterior que no abarca hasta la linea media.">Clase II . Incluye defectos que mantienen la dentición del lado contralateral. Es unilateral posterior que no abarca hasta la línea media.</option>
                                        <option value="Clase III. Implica un defecto en la línea media del paladar duro y puede incluir una porcion del velo del paladar, sin involucrar proceso alveolar ni organos dentarios">Clase III. Implica un defecto en la línea media del paladar duro y puede incluir una porción del velo del paladar, sin involucrar proceso alveolar ni órganos dentarios</option>
                                        <option value="Clase IV. Es un defecto extenso bilateral anterior, involucra dientes anteriores y posteriores.">Clase IV. Es un defecto extenso bilateral anterior, involucra dientes anteriores y posteriores.</option>
                                        <option value="Clase V. Defecto bilateral posterior, situado por detras de los dientes remanentes.">Clase V. Defecto bilateral posterior, situado por detrás de los dientes remanentes.</option>
                                        <option value="Clase VI. Defecto bilateral de la zona anterior sin involucrar dientes posteriores.">Clase VI. Defecto bilateral de la zona anterior sin involucrar dientes posteriores.</option>
                                    </select>
                                </div>


                                <!--Si se selecciona DISECCION RADICAL MODIFICADA DE CUELLO, se deben mostrar los siguientes 3 select: LUGAR, TIPO Y NIVEL CERVICAL-->
                                <div class="col-md-4" id="idlugar">
                                    <strong>Lugar DRMC </strong>
                                    <select name="maxinfra" id="maxinfra" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bilateral">Bilateral</option>
                                        <option value="Unilateral">Unilateral</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idtipo">
                                    <strong>Tipo DRMC</strong>
                                    <select name="maxinfra" id="maxinfra" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Selectiva">Selectiva</option>
                                        <option value="Superselectiva">Superselectiva</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idnivelcervical">
                                    <strong>Nivel Cervical</strong>
                                    <select name="nivelcervical" id="nivelcervical" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                    </select>
                                </div>
                                <!--Aquí finalizan los select que se habilitan/muestran si se selecciona DISECCION RADICAL MODIFICADA DE CUELLO -->






                                <!--SEGUNDO SELECT VISIBLE DE INICIO, RECONSTRUCCIÓN-->
                                <div class="col-md-6" id="idqreconstruccion">
                                    <strong>*Reconstrucción</strong>
                                    <select name="reconstruccion" id="reconstruccion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si selecciona SÍ en reconstrucción, se debe mostrar lo siguiente-->
                                <div class="col-md-6" id="idtiporeconstruccion">
                                    <strong>Tipo de Reconstrucción</strong>
                                    <select name="tiporeconstruccion" id="tiporeconstruccion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Colgajo Microvascular">Colgajo Microvascular</option>
                                        <option value="Injerto Oseo Autologo o Cadaverico">Injerto Óseo Autólogo o Cadavérico</option>
                                        <option value="Material de Osteosintesis">Material de Osteosíntesis</option>
                                        <option value="Rotacion de Colgajo">Rotación de Colgajo</option>
                                        <option value="Toma y Aplicacion de Injerto">Toma y Aplicación de Injerto</option>
                                    </select>
                                </div>





                                <!--TERCER SELECT VISIBLE DE INICIO, RECONSTRUCCIÓN-->
                                <div class="col-md-12" id="idradio">
                                    <strong>*Radioterapia</strong>
                                    <select name="radio" id="radio" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Sí">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si se selecciona SÍ en RADIOTERAPIA, se deben mostrar: FECHA, COMPLICACIONJES, MOMENTO RT-->
                                <div class="col-md-4">
                                    <strong>Fecha:</strong>
                                    <input type="date" id="fecharadio" name="fecharadio" class="form-control">
                                </div>



                                <div class="col-md-4" id="idmomentort">
                                    <strong>Momento RT</strong>
                                    <select name="moentort" id="momentort" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Adyuvante">Adyuvante</option>
                                        <option value="Paliativa">Paliativa</option>
                                        <option value="Radical">Radical</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idcomplicaciones">
                                    <strong>Complicaciones RT</strong>
                                    <select id="mscomplicaciones" name="mscomplicaciones[]" multiple="multiple" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Caries">Caries</option>
                                        <option value="Disgeusia">Disgeusia</option>
                                        <option value="Dolor">Dolor</option>
                                        <option value="Fractura">Fractura</option>
                                        <option value="Infeccion">Infeccion</option>
                                        <option value="Hemorragias">Hemorragias</option>
                                        <option value="Mucositis">Mucositis</option>
                                        <option value="Osteonecrosis">Osteonecrosis</option>
                                        <option value="Parestesia">Parestesia</option>
                                        <option value="Propios">Propios De La Anestesia Local</option>
                                        <option value="Radiodermitis">Radiodermitis</option>
                                        <option value="Reaccionalergica">Reaccion Alergica</option>
                                        <option value="Trismus">Trismus</option>
                                        <option value="Xerostomia">Xerostomia</option>
                                    </select>
                                </div>

                                <!--AQUI FINALIZAN LOS COMBOS QUE SE MUESTRAN SI SE SELECCIONA SÍ EN RADIOTERAPIA-->

                                <!--AQUI FALTA REVISAR SI ESTOS COMBOS SE VAN A MOSTRAR DESDE UN INICIO O SI DEPENDEN DE UNA SELECCION (TX COMPLICACIONES ORALES, DOSIS, FRACCIONES, TECNICA,OARS DOSIS)-->


                                <div class="col-md-3" id="idtxcomplicaciones">
                                    <strong>Tx Complicaciones</strong>
                                    <select name="txcomplicaciones" id="txcomplicaciones" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacológico</option>
                                        <option value="Laser">Láser</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <strong>Dosis</strong>
                                    <input type="number" class="form-control" id="dosis" name="dosis" placeholder="Ingrese cG...">
                                </div>

                                <div class="col-md-3" id="idfracciones">
                                    <strong>Fracciones</strong>
                                    <select name="fracciones" id="fracciones" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Convencional">Convencional</option>
                                        <option value="Hiperfraccionamiento">Hiperfraccionamiento</option>
                                        <option value="Hipofraccionamiento">Hipofraccionamiento</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <strong>No. Fracciones</strong>
                                    <input type="number" class="form-control" id="fracciones" name="fracciones" placeholder="Ingrese..." readonly>
                                </div>

                                <div class="col-md-3" id="idtecnica">
                                    <strong>Tecnica</strong>
                                    <select name="tecnica" id="tecnica" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="3D Conformal">3D Conformal</option>
                                        <option value="Braquiterapia">Braquiterapia</option>
                                        <option value="IMRT">IMRT</option>
                                    </select>
                                </div>


                                <!--Select multiple-->
                                <div class="col-md-5" id="idoars">
                                    <strong>OARS Dosis</strong>
                                    <select name="oarsdosis" id="oarsdosis" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Cavidad Oral">Cavidad Oral</option>
                                        <option value="Cocleas">Cocleas</option>
                                        <option value="Crsitalinos">Crsitalinos</option>
                                        <option value="Esofago">Esófago</option>
                                        <option value="Labios">Labios</option>
                                        <option value="Laringe">Laringe</option>
                                        <option value="Mandibula">Mandibula</option>
                                        <option value="Medula">Médula </option>
                                        <option value="Nervio Óptico">Nervio Óptico</option>
                                        <option value="Ojos">Ojos</option>
                                        <option value="Pared Faringea Posterior">Pared Faringea Posterior</option>
                                        <option value="Parotidas">Parotidas</option>
                                        <option value="Sublinguales">Sublinguales</option>
                                        <option value="Tallo">Tallo</option>
                                        <option value="Tiroides">Tiroides</option>
                                    </select>
                                </div>


                                <!--DE CADA OARS dosis se debe habilitar dosis max y prom-->
                                <div class="col-md-2">
                                    <strong>Dosis Máxima</strong>
                                    <input type="number" class="form-control" id="dosismaxima" name="dosismaxima" placeholder="Ingrese...">
                                </div>

                                <div class="col-md-2">
                                    <strong>Dosis Promedio</strong>
                                    <input type="number" class="form-control" id="dosispromedio" name="dosispromedio" placeholder="Ingrese...">
                                </div>

                                <!--********************************************************************************************************************************************************************-->





                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de DEFUNCIÓN-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>DEFUNCIÓN</strong>
                                </div>


                                <fieldset class="col-md-2">
                                    <strong>Defunción</strong><br>
                                    &nbsp;<strong>Si</strong>
                                    <input type="radio" name="defunsi" id="defunsionsi" onclick="defusi();" class="check" value="si">
                                    &nbsp;<strong>No</strong>
                                    <input type="radio" name="defunsi" id="defunsionno" onclick="defuno();" class="check" value="no" checked>
                                </fieldset>

                                <!--En caso de seleccionar que sí, se deben mostrar/habilitar fecha y Causa-->

                                <div class="col-md-5" id="defuncionfecha">
                                    <strong>Fecha Defunción</strong>
                                    <input type="date" name="fechadeladefuncion" id="fechadeladefuncion" class="form-control" value="0000/00/00">
                                </div>

                                <div class="col-md-5" id="defuncioncausa">
                                    <strong>Causa</strong>
                                    <select name="causadefuncion" id="causadefuncion" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Oncologica">Oncologica</option>
                                        <option value="No oncologica">No oncologica</option>
                                    </select>
                                </div>
                            </div>



                            <!--********************************************************************************************************************************************************************-->
                            <!--Inicia la sección de CASO ÉXITOSO-->
                            <div class="col-md-12"></div>
                            <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                <strong>CASO ÉXITOSO</strong>
                            </div>

                            <fieldset class="col-md-2">
                                <strong>Caso Éxitoso</strong><br>
                                &nbsp;<strong>Si</strong>
                                <input type="radio" name="exitosi" id="casoexitososi" onclick="exitosi();" class="check" value="si">
                                &nbsp;<strong>No</strong>
                                <input type="radio" name="exitosi" id="casoexitosono" onclick="exitono();" class="check" value="no" checked>
                            </fieldset>


                            <div class="col-md-5" id="idrespuestatratamiento">
                                <strong>Respuesta al Tratamiento</strong>
                                <select name="respuestatratamiento" id="respuestatratamiento" class="form-control">
                                    <option value="Sin registro">Sin registro</option>
                                    <option value="Completa">Completa</option>
                                    <option value="Nula">Nula</option>
                                    <option value="Parcial">Parcial</option>
                                </select>
                            </div>
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