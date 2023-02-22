<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="js/getCatalogos.js"></script>

    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
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
   

</style>
<script>
    function Edad(FechaNacimiento) {

var fechaNace = new Date(FechaNacimiento);
var fechaActual = new Date()

var mes = fechaActual.getMonth();
var dia = fechaActual.getDate();
var año = fechaActual.getFullYear();

fechaActual.setDate(dia);
fechaActual.setMonth(mes);
fechaActual.setFullYear(año);

edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

return edad;


}

function calcularEdadEdit() {
var fecha = document.getElementById('fechaedit').value;


var edad = Edad(fecha);
document.formularioedicion.edadedit.value = edad;

}
function curp2dateEdit(curpedit) {
var miCurp = document.getElementById('curpedit').value.toUpperCase();
var sexo = miCurp.substr(-8, 1);
var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
//miFecha = new Date(año,mes,dia) 
var anyo = parseInt(m[1], 10) + 1900;
if (anyo < 1940) anyo += 100;
var mes = parseInt(m[2], 10) - 1;
var dia = parseInt(m[3], 10);
document.formularioedicion.fechaedit.value = (new Date(anyo, mes, dia));
if (sexo == 'M') {
    document.formularioedicion.sexoedit.value = 'Femenino';
} else if (sexo == 'H') {
    document.formularioedicion.sexoedit.value = 'Masculino';
} else if (sexo != 'M' || 'H') {
    alert('Error de CURP');
}

}
Date.prototype.toString = function() {
    var anyo = this.getFullYear();
    var mes = this.getMonth() + 1;
    if (mes <= 9) mes = "0" + mes;
    var dia = this.getDate();
    if (dia <= 9) dia = "0" + dia;
    return anyo + "-" + mes + "-" + dia;
}
window.addEventListener('DOMContentLoaded', (evento) => {
    const hoy_fecha = new Date().toISOString().substring(0, 10);
    document.querySelector("input[name='fechaedit']").max = hoy_fecha;

});
function calculaIMCEdit() {

let talla = document.getElementById('tallaedit').value;
let peso = document.getElementById('pesoedit').value;


imccalculo = Math.pow(talla, 2);
let limitimcalculo = imccalculo.toFixed(2);
let calculoimc = peso / limitimcalculo;
let limitcalculofinal = calculoimc.toFixed(1);

document.formularioedicion.imcedit.value = limitcalculofinal;

}
$(document).ready(function() {

$('#mscanceredit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});
$(document).ready(function() {

$('#mspatoedit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});
$(document).ready(function() {

$('#sitiometastasis2edit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});
$(document).ready(function() {

$('#mamaseleccionedit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});

function limpiar() {

setTimeout('document.formularioedicion.reset()', 1000);



return false;
}
function limpiarcancer() {

setTimeout('document.formularioedicioncancer.reset()', 1000);


return false;
}
function limpiarpato() {

setTimeout('document.formularioedicionpato.reset()', 1000);

return false;
}

</script>
<div id="mensaje"></div>

<div class="modal fade in" role="dialog"  data-bs-keyboard="false" id="editarDatosPersonalescancerdeMama">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
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

                            <form name="formularioedicion" id="formularioedicion" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicion").on("submit", function(e) {
                                
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicion"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editardatospaciente.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosPersonalescancerdeMama").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosPersonalescancerdeMama").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosPersonalescancerdeMama").modal('hide');
                                            }
                                        
                                        })
                                        
                                    })
                                    
                                    
                                    </script>
                                    <div class="col-md-12" autocomplete="off">

                                        <input id="year" name="year" class="form-control" type="hidden" value="2022"
                                            required="required" readonly>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-6">
                                        <strong>CURP</strong>
                                        <input type="text" id="curpedit" name="curpedit" type="text" class="form-control" value="<?php echo $dataRegistro['curp'] ?>"
                                        onblur="curp2dateEdit();" minlength="18" maxlength="18" required >
                                    
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Nombre Completo</strong>
                                        <input id="nombrecompletoedit" name="nombrecompletoedit" onblur="calcularEdadEdit();"
                                            type="text" class="form-control" value="<?php echo $dataRegistro['nombrecompleto'] ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Población indigena</strong>
                                        <select name="poblacionindigenaedit" id="poblacionindigenaedit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['poblacionindigena'] ?>" selected><?php echo $dataRegistro['poblacionindigena'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <strong>Discapacidad</strong>
                                        <select name="discapacidadedit" id="discapacidadedit" class="form-control">
                                    
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Escolaridad</strong>
                                        <select id="escolaridadedit" name="escolaridadedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['escolaridad'] ?>" selected><?php echo $dataRegistro['escolaridad'] ?></option>
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
                                        <input id="fechaedit" name="fechaedit" type="date" value="<?php echo $dataRegistro['fechanacimiento'] ?>" onblur="curp2dateEdit();"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Edad</strong>
                                        <input id="edadedit" name="edadedit" type="text" class="form-control" value="<?php echo $dataRegistro['edad'] ?>" readonly>
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Sexo</strong>
                                        <input type="text" class="form-control" id="sexoedit" value="<?php echo $dataRegistro['sexo'] ?>" onclick="curp2dateEdit();"
                                            name="sexoedit" readonly>

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Raza</strong>
                                        <input type="text" class="form-control" id="razaedit" onclick="curp2dateEdit();"
                                            name="razaedit" value="<?php echo $dataRegistro['raza'] ?>">

                                    </div>
                                    <!--
                                    <div class="col-md-3">
                                        <strong>Frecuencia cardiaca</strong>
                                        <input type="text" class="form-control col-md-12" id="frecuenciacardiaca"
                                            name="frecuenciacardiaca">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Presión arterial</strong>
                                        <input type="text" class="form-control col-md-12" id="presionarterial"
                                            name="presionarterial">

                                    </div>
                                    -->
                                    <script>
                                        /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#tallaedit').mask('0.00');
                                    });
                                    </script>
                                    <div class="col-md-2">
                                        <strong>Talla</strong>
                                        <input type="number" step="any" class="form-control" id="tallaedit" name="tallaedit"
                                            required value="<?php echo $dataRegistro['talla'] ?>">

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Peso</strong>
                                        <input type="number" step="any" class="form-control" id="pesoedit"
                                            onblur="calculaIMCEdit();" name="pesoedit" required value="<?php echo $dataRegistro['peso'] ?>">

                                    </div>
                                    <div class="col-md-2">
                                        <strong>IMC</strong>
                                        <input type="text" class="form-control" id="imcedit" onblur="calculaIMCEdit();"
                                            name="imcedit" readonly value="<?php echo $dataRegistro['imc'] ?>">

                                    </div>

                                    <div class="col-md-6">
                                        <strong>Estado de residencia</strong>

                                        <select name="cbx_estadoedit" id="cbx_estadoedit" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="<?php echo $rows['id_estado'] ?>" selected><?php echo $rows['estado'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
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
                                        
                                        <select name="cbx_municipioedit" id="cbx_municipioedit" class="form-control"
                                            style="width: 100%;">
                                            <option value="<?php echo $rowsm['id_municipio'] ?>" selected><?php echo $rowsm['municipio'] ?></option>
                                        </select>
                                    </div>
                                    
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                    
                        </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosReferencia">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarcancer();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionreferencia" id="formularioedicionreferencia" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionreferencia").on("submit", function(e) {
                                        
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionreferencia"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarreferencia.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosReferencia").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosReferencia").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosReferencia").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">DATOS DE REFERECNIA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                <div class="col-md-6" >
                                        <strong>Referenciado</strong>
                                        <select name="referenciadoedit" id="referenciadoedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['referenciado'] ?>" ><?php echo $dataRegistro['referenciado'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" >
                                        <strong>Unidad referencia</strong>
                                        <input list="referencias" name="unidadreferenciaedit" id="unidadreferenciaedit"
                                            class="form-control" value="<?php echo $rown['unidad']; ?>">
                                        <datalist id="referencias">
                                            <option value="<?php echo $rown['unidad']; ?>" selected><?php echo $rown['unidad']; ?></option>
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
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                    
                                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosCancer">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarcancer();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicioncancer" id="formularioedicioncancer" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicioncancer").on("submit", function(e) {
                                        
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicioncancer"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarcancermama.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosCancer").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosCancer").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosCancer").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES HEREDOFAMILIARES</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-6">
                                        <strong>Cancer</strong>
                                        <select name="tipodecanceredit" id="tipodecanceredit" class="form-control">
                                        
                                            <option value="Sin antecedentes">Sin antecedentes</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6" >
                                        <strong>Familiar(es)</strong>
                                        <select id="mscanceredit" name="mscanceredit[]" multiple="multiple"
                                            class="form-control">
                                            
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
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                    
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosPersonalesPatologicos">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionpato" id="formularioedicionpato" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionpato").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionpato"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/antecedentespersonalespato.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosPersonalesPatologicos").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosPersonalesPatologicos").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosPersonalesPatologicos").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES PERSONALES PATOLOGICOS</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <!--<div class="col-md-12">
                                        <strong>Antecedentes</strong>
                                        <select id="mspatoedit" name="check_listapatoedit[]" multiple="multiple"
                                            class="form-control">

                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionantecedente FROM antecedentespersonalespatologicos");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionantecedente']; ?>">
                                                <?php echo $row['descripcionantecedente']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>-->
                                
                                    <fieldset class="col-md-12" style="margin-top: 15px; font-size: 15px;">
                                
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Tabaquismo" >&nbsp;Tabaquismo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Hipertencion Arterial" >&nbsp;Hipertensión
                                        Arterial&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Enfermedad Renal Cronica">&nbsp;Enfermedad Renal
                                        Cronica&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Diabetes Mellitus" >&nbsp;Diabetes Mellitus&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Conocida con Gen BRCA 1">&nbsp;Conocida con Gen BRCA
                                        1&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Conocida con Gen BRCA 2">&nbsp;Conocida con Gen BRCA
                                        2&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapatoedit[]" id="check_listapatoedit[]"
                                            class="check" value="Ninguno de los anteriores">&nbsp;Ninguno de los anteriores&nbsp;&nbsp;                                 
                                    </fieldset>
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                    
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosAntecedentesGineco">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioediciongineco" id="formularioediciongineco" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioediciongineco").on("submit", function(e) {
                                        
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioediciongineco"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarantecedentesgineco.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosAntecedentesGineco").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosAntecedentesGineco").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosAntecedentesGineco").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                        <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES GINECOOBSTETRICOS</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-2">
                                        <strong>Menarca</strong>
                                        <input type="text" class="form-control" id="menarcaedit" name="menarcaedit" value="<?php echo $dataRegistro['menarca'] ?>">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Ultima menstruación</strong>
                                        <input type="date" class="form-control" id="fechaultimamestruacionedit"
                                            name="fechaultimamestruacionedit" onblur="calcularmestruacionedit();" value="<?php echo $dataRegistro['ultimamestruacion'] ?>">

                                    </div>
                                    <div class="col-md-3" >
                                        <strong>Cuenta con:</strong>
                                        <input type="text" class="form-control" id="menopauseaedit" name="menopauseaedit"
                                            readonly value="<?php echo $dataRegistro['cuentacon'] ?>">

                                    </div>

                                    <div class="col-md-2">
                                        <strong>Gestas</strong>
                                        <select name="gestasedit" id="gestasedit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['gestas'] ?>" selected><?php echo $dataRegistro['gestas'] ?></option>
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
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" id="partoidedit">
                                        <strong>Paras</strong>
                                        <input type="number" class="form-control" id="partoedit" onblur="validapartoedit();"
                                            name="partoedit" value="<?php echo $dataRegistro['parto'] ?>">

                                    </div>
                                    <div class="col-md-3" id="abortoidedit">
                                        <strong>Aborto</strong>
                                        <input type="number" class="form-control" id="abortoedit" onblur="validapartoedit();"
                                            name="abortoedit" value="<?php echo $dataRegistro['aborto'] ?>">

                                    </div>
                                    <div class="col-md-3" id="cesareaidedit">
                                        <strong>Cesarea</strong>
                                        <input type="number" class="form-control" id="cesareaedit" onblur="validapartoedit();"
                                            name="cesareaedit" value="<?php echo $dataRegistro['cesarea'] ?>">

                                    </div>
                                    <script>
                                
                                    $(document).ready(function () {
                                        
    $("#embarazadaedit").change(function (e) {
            let valor = $("#embarazadaedit").val()
        if (valor == 'Si') {

            $('#probablepartoedit').prop("hidden", false);
            $('#fechaprobablepartoedit').prop("required", true);

        } else if (valor == 'No') {
            $('#probablepartoedit').prop("hidden", true);
            $('#fechaprobablepartoedit').val('');
            $('#fechaprobablepartoedit').prop("required", false);

        }
    })
});
$(document).ready(function () {
                                        
        let valor = $("#embarazadaedit").val()
            if (valor == 'Si') {
                                    
                    $('#probablepartoedit').prop("hidden", false);
                    $('#fechaprobablepartoedit').prop("required", true);             
            } else if (valor == 'No') {
                    $('#probablepartoedit').prop("hidden", true);
                    $('#fechaprobablepartoedit').prop("required", false);                 
                                    
                    }
                                        
            });

</script>
                                    <div class="col-md-3">
                                        <strong>Esta embarazada</strong>
                                        <select name="embarazadaedit" id="embarazadaedit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['embarazada'] ?>" selected><?php echo $dataRegistro['embarazada'] ?></option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                    

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="probablepartoedit">
                                        <strong>F.P.P</strong>
                                        <input type="date" class="form-control" id="fechaprobablepartoedit"
                                            name="fechaprobablepartoedit" value="<?php echo $dataRegistro['fpp'] ?>" >

                                    </div>
                                    

                                    <div class="col-md-3" id="tipolactancia">
                                        <strong>Lactancia</strong>
                                        <select name="lactanciaedit" id="lactanciaedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['lactancia'] ?>" selected><?php echo $dataRegistro['lactancia'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="tiempodelactancia">
                                        <strong>Tiempo</strong>
                                        <input type="text" class="form-control" id="tiempolactanciaedit"
                                            name="tiempolactanciaedit" value="<?php echo $dataRegistro['tiempolactancia'] ?>">

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Terapia de remplazo hormonal</strong>
                                        <select name="planificacionfamiliaredit" id="planificacionfamiliaredit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['terapiareemplazohormonal'] ?>" selected><?php echo $dataRegistro['terapiareemplazohormonal'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <script>
                                        
                                        $(document).ready(function () {
                                        
                                        $("#lactanciaedit").change(function (e) {
                                                let valor = $("#lactanciaedit").val()
                                            if (valor == 'Si') {
                                    
                                                $('#tiempodelactancia').prop("hidden", false);
                                                $('#tiempolactanciaedit').prop("required", true); 
                                    
                                            } else if (valor == 'No') {
                                                $('#tiempodelactancia').prop("hidden", true);
                                                $('#tiempolactanciaedit').prop("required", false);
                                                $('#tiempolactanciaedit').val('');
                                    
                                            }
                                        })
                                    });
                                                                    $(document).ready(function () {
                                        
                                                        let valor = $("#lactanciaedit").val()
                                            if (valor == 'Si') {
                                                                    
                                                    $('#tiempodelactancia').prop("hidden", false);
                                                    $('#tiempolactanciaedit').prop("required", true);             
                                            } else if (valor == 'No') {
                                                    $('#tiempodelactancia').prop("hidden", true);
                                                    $('#tiempolactanciaedit').prop("required", false);                 
                                                                    
                                                    }
                                                                        
                                            });
                                    </script>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosAtencionClinica">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionatencionclinica" id="formularioedicionatencionclinica" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionatencionclinica").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionatencionclinica"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/atencionclinicacancer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosAtencionClinica").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosAtencionClinica").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosAtencionClinica").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ATENCIÓN CLINICA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-3">
                                        <strong>Fecha primer atencion</strong>
                                        <input type="date" id="fechaatencioninicialedit" name="fechaatencioninicialedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechaatencioninicial']?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>BIRADS de referencia</strong>
                                        <select name="biradsreferenciaedit" id="biradsreferenciaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['biradsreferencia']?>" selected><?php echo $dataRegistro['biradsreferencia']?></option>
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
                                        <select name="biradshraeiedit" id="biradshraeiedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['biradshraei']?>" selected><?php echo $dataRegistro['biradshraei']?></option>
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
                                    <div class="col-md-3" id="lateralidadinicioedit">
                                        <strong>Lateralidad</strong>
                                        <select name="lateralidadprimeroedit" id="lateralidadprimeroedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['lateralidadmama']?>" selected><?php echo $dataRegistro['lateralidadmama']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Derecha">Derecha</option>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Bilateral">Bilateral</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="lateralidadinicioedit">
                                        <strong>Estadio clinico</strong>
                                        <select name="estadioclinicoedit" id="estadioclinicoedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['estadioclinico']?>" selected><?php echo $dataRegistro['estadioclinico']?></option>
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
                                        <select name="etapasclinicasedit" id="etapasclinicasedit" class="form-control" readonly>
                                            <option value="TNM" selected>TNM</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Tamaño tumoral</strong>
                                        <select name="tamaniotumoraledit" id="tamaniotumoraledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['tamaniotumoral']?>" selected><?php echo $dataRegistro['tamaniotumoral']?></option>
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
                                        <select name="linfaticonodaledit" id="linfaticonodaledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['compromisolenfatico']?>" selected><?php echo $dataRegistro['compromisolenfatico']?></option>
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
                                    <script>
                                
                                    $(document).ready(function () {
                                        
    $("#metastasisedit").change(function (e) {
            let valor = $("#metastasisedit").val()
        if (valor == 'M1 Con enfermedad metastasica') {

            $('#metastasissitioedit').prop("hidden", false);
            $('#sitiometastasis2edit').prop("required", true);

        } else if (valor == 'MX: No se pueden evaluar metastasis distantes' || valor == 'M0 Sin enfermedad a distancia' || valor == 'Sin registro') {
            $('#metastasissitioedit').prop("hidden", true);
            $('#sitiometastasis2edit').prop("required", false);
            

        }
    })
});
$(document).ready(function () {
                                        
        let valor = $("#metastasisedit").val()
            if (valor == 'M1 Con enfermedad metastasica') {
                                    
                $('#metastasissitioedit').prop("hidden", false);
                $('#sitiometastasis2edit').prop("required", true);            
            } else {
                $('#metastasissitioedit').prop("hidden", true);
                $('#sitiometastasis2edit').prop("required", false);                 
                                    
                    }
                                        
            });

</script>
                                    <div class="col-md-4">
                                        <strong>Metastasis</strong>
                                        <select name="metastasisedit" id="metastasisedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['metastasis']?>" selected><?php echo $dataRegistro['metastasis']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="MX: No se pueden evaluar metastasis distantes">MX: No se pueden evaluar metastasis distante</option>
                                            <option value="M0 Sin enfermedad a distancia">M0 Sin enfermedad a distancia</option>
                                            <option value="M1 Con enfermedad metastasica">M1 Con enfermedad metastasica</option>
                                            

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="metastasissitioedit">
                                        <strong>Sitio de metastasis</strong>
                                        <select name="sitiometastasisedit[]" id="sitiometastasis2edit" multiple="multiple" class="form-control">
                                           
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
                                    

                                    <div class="col-md-4">
                                        <strong>Calidad de vida ECOG</strong>
                                        <select name="calidaddevidaecogedit" id="calidaddevidaecogedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['calidaddevidaecog']?>" selected><?php echo $dataRegistro['calidaddevidaecog']?></option>
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
                                    <script>
                                
                                    $(document).ready(function () {
                                        
    $("#mastectomiaextrainstitucionaledit").change(function (e) {
            let valor = $("#mastectomiaextrainstitucionaledit").val()
        if (valor == 'Si') {

            $('#mstectoextra1edit').prop("hidden", false);
            $('#mstectoextra2edit').prop("hidden", false);
            $('#ateralidadextrainstitucionaledit').prop("required", true);
            $('#fechamastectoextraedit').prop("required", true);

        } else if (valor == 'No') {
            $('#mstectoextra1edit').prop("hidden", true);
            $('#mstectoextra2edit').prop("hidden", true);
            $('#ateralidadextrainstitucionaledit').prop("required", false);
            $('#fechamastectoextraedit').prop("required", false);
            $('#lateralidadextrainstitucionaledit').prop("selectedIndex", 0);
            $('#fechamastectoextraedit').val('');
            

        }else if (valor == 'Sin registro') {
            $('#mstectoextra1edit').prop("hidden", true);
            $('#mstectoextra2edit').prop("hidden", true);
            $('#ateralidadextrainstitucionaledit').prop("required", false);
            $('#fechamastectoextraedit').prop("required", false);
            $('#lateralidadextrainstitucionaledit').prop("selectedIndex", 0);
            $('#fechamastectoextraedit').val('');
        }
    })
});
$(document).ready(function () {
                                        
        let valor = $("#mastectomiaextrainstitucionaledit").val()
        if (valor == 'Si') {

$('#mstectoextra1edit').prop("hidden", false);
$('#mstectoextra2edit').prop("hidden", false);


} else if (valor == 'No') {
$('#mstectoextra1edit').prop("hidden", true);
$('#mstectoextra2edit').prop("hidden", true);



}else if (valor == 'Sin registro') {
$('#mstectoextra1edit').prop("hidden", true);
$('#mstectoextra2edit').prop("hidden", true);

}
                                        
            });

</script>
                                    <div class="col-md-4" >
                                        <strong>Mastectomia Extrainstitucional</strong>
                                        <select name="mastectomiaextrainstitucionaledit" id="mastectomiaextrainstitucionaledit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['mastectoextrainstituto']?>" selected><?php echo $dataRegistro['mastectoextrainstituto']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="mstectoextra1edit">
                                        <strong>Lateralidad Mastectomia</strong>
                                        <select name="lateralidadextrainstitucionaledit" id="lateralidadextrainstitucionaledit"
                                            class="form-control">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="<?php echo $dataRegistro['lateralidadmastectoextrainstituto']?>" selected><?php echo $dataRegistro['lateralidadmastectoextrainstituto']?></option>
                                            
                                            <option value="Mama Derecha">Mama Derecha</option>
                                            <option value="Mama Izquierda">Mama Izquierda</option>
                                            <option value="Ambas Mamas">Ambas Mamas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="mstectoextra2edit">
                                        <strong>Fecha</strong>
                                        <input type="date" class="form-control" id="fechamastectoextraedit"
                                            name="fechamastectoextraedit" value="<?php echo $dataRegistro['fechamastectoextrainstituto']?>">

                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosHistopatologiaMamaDer">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionhistomamader" id="formularioedicionhistomamader" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionhistomamader").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionhistomamader"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarDatosHistopatologia.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosHistopatologiaMamaDer").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosHistopatologiaMamaDer").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosHistopatologiaMamaDer").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">HISTOPATOLOGIA MAMA DERECHA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                <!--inicia mama derecha-->
                                    <div class="col-md-4">
                                        <strong>Dx histopatologico MMD</strong>
                                        <select name="dxhistopatologicoedit" id="dxhistopatologicoedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['dxhistopatologico'] ?>"><?php echo $dataRegistro['dxhistopatologico'] ?></option>
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
                                    <div class="col-md-4">
                                        <strong>Fecha dx histopatologico MMD</strong>
                                        <input type="date" id="fechadxhistopatologicoedit" name="fechadxhistopatologicoedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechadxhistopatologico'] ?>">
                                    </div>
                                    <div class="col-md-4" >
                                        <strong>Nottinghan MMD</strong>
                                        <select name="nottinghamedit" id="nottinghamedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['nottingham'] ?>"><?php echo $dataRegistro['nottingham'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) MMD</strong>
                                        <select name="escalasbredit" id="escalasbredit" class="form-control">
                                            <option value="<?php echo $dataRegistro['escalasbr'] ?>"><?php echo $dataRegistro['escalasbr'] ?></option>
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
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosRgMamaDer">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionhistopatogrd" id="formularioedicionhistopatogrd" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionhistopatogrd").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionhistopatogrd"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarDatosRgMamaDer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosRgMamaDer").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosRgMamaDer").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosRgMamaDer").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">HISTOPATOLOGIA REGION GANGLIONAR MAMA DERECHA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                        <strong>Dx histopatologico RGD</strong>
                                        <select name="dxhistopatologicorgdedit" id="dxhistopatologicorgdedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['dxhistopatologicorgd'] ?>"><?php echo $dataRegistro['dxhistopatologicorgd'] ?></option>
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
                                    <div class="col-md-4">
                                        <strong>Fecha dx histopatologico RGD</strong>
                                        <input type="date" id="fechadxhistopatologicorgdedit" name="fechadxhistopatologicorgdedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechadxhistopatologicorgd'] ?>">
                                    </div>
                                    <div class="col-md-4" >
                                        <strong>Nottinghan RGD</strong>
                                        <select name="nottinghamrgdedit" id="nottinghamrgdedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['nottinghamrgd'] ?>"><?php echo $dataRegistro['nottinghamrgd'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12" >
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) RGD</strong>
                                        <select name="escalasbrrgdedit" id="escalasbrrgdedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['escalasbrrgd'] ?>"><?php echo $dataRegistro['escalasbrrgd'] ?></option>
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
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                <!--finaliza region ganglionar izquierda-->
                                <!--inicia mama izquierda--> 
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosMamaIz">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionmamaizquierda" id="formularioedicionmamaizquierda" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionmamaizquierda").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionmamaizquierda"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarDatosMamaIz.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosMamaIz").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosMamaIz").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosMamaIz").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">HISTOPATOLOGIA MAMA IZQUIERDA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                        <strong>Dx histopatologico MMI</strong>
                                        <select name="dxhistopatologicoizedit" id="dxhistopatologicoizedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['dxhistopatologicoiz'] ?>"><?php echo $dataRegistro['dxhistopatologicoiz'] ?></option>
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
                                    <div class="col-md-4" >
                                        <strong>Fecha dx histopatologico MMI</strong>
                                        <input type="date" id="fechadxhistopatologicoizedit" name="fechadxhistopatologicoizedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechadxhistopatologicoiz'] ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Nottinghan MMI</strong>
                                        <select name="nottinghamizedit" id="nottinghamizedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['nottinghamiz'] ?>"><?php echo $dataRegistro['nottinghamiz'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12" >
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) MMI</strong>
                                        <select name="escalasbrizedit" id="escalasbrizedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['escalasbriz'] ?>"><?php echo $dataRegistro['escalasbriz'] ?></option>
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
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                                <!--finaliza mama izquierda -->
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosRgmamaIz">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionrgmamaiz" id="formularioedicionrgmamaiz" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionrgmamaiz").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionrgmamaiz"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarDatosRgMamaiz.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosRgmamaIz").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosRgmamaIz").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosRgmamaIz").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <!-- inicia region ganglionar IZQUIERDA-->
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">HISTOPATOLOGIA REGION GANGLIONAR MAMA IZQUIERDA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                        <strong>Dx histopatologico RGI</strong>
                                        <select name="dxhistopatologicorgiedit" id="dxhistopatologicorgiedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['dxhistopatologicorgi'] ?>"><?php echo $dataRegistro['dxhistopatologicorgi'] ?></option>
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
                                    <div class="col-md-4">
                                        <strong>Fecha dx histopatologico RGI</strong>
                                        <input type="date" id="fechadxhistopatologicorgiedit" name="fechadxhistopatologicorgiedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechadxhistopatologicorgi'] ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Nottinghan RGI</strong>
                                        <select name="nottinghamrgiedit" id="nottinghamrgiedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['nottinghamrgi'] ?>"><?php echo $dataRegistro['nottinghamrgi'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                            <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                            <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>
                                           

                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) RGI</strong>
                                        <select name="escalasbrrgiedit" id="escalasbrrgiedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['escalasbrrgi'] ?>"><?php echo $dataRegistro['escalasbrrgi'] ?></option>
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
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarInmunohistoMamaDer">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="editarInmunoMamaDer" id="editarInmunoMamaDer" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#editarInmunoMamaDer").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "editarInmunoMamaDer"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarInmunoMamaDer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarInmunohistoMamaDer").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarInmunohistoMamaDer").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarInmunohistoMamaDer").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>     
                                    <div class="col-md-12"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">INMUNOHISTOQUIMICA MAMA DERECHA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                        
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosedit" name="receptoresestrogenosedit"
                                                placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresestrogenos']?>">
                                        </div>
                                    
                                    <div class="col-md-4">
                                        
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronaedit"
                                                name="receptoresprogesteronaedit" placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresprogesterona'] ?>">
                                    
                                    </div>
                                    <div class="col-md-2">
                                        
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67edit" name="ki67edit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['ki67'] ?>">
                                    
                                    </div><!--
                                    <div class="col-md-2" id="inmunoderecha4">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="k" name="k" placeholder="%"
                                                class="form-control">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2">
                                        
                                            <strong>P 53</strong>
                                            <input type="number" name="p53edit" id="p53edit" class="form-control" value="<?php echo $dataRegistro['p53'] ?>">
                                        
                                    </div>
                                    <div class="col-md-2">
                                        
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativoedit" id="triplenegativoedit" class="form-control">
                                                <option value="<?php echo $dataRegistro['triplenegativo'] ?>"><?php echo $dataRegistro['triplenegativo'] ?></option>
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                    
                                    </div>
                                    <script>
                                    $(document).ready(function () {
                                        
                                        $("#pdlrealizoedit1").click(function (e) {
                                            let valor = $("#pdlrealizoedit1").val();
                                                if (valor == 'si') {

                                                        $('#pdledit').prop("disabled", false);

                                                    } 
                                                })
                                            });
                                            $(document).ready(function () {
                                        
                                        $("#pdlrealizoedit2").click(function (e) {
                                            let valor2 = $("#pdlrealizoedit2").val();
                                            if (valor2 == 'no') {
                                                        $('#pdledit').prop("disabled", true);
                                                        $('#pdledit').val('');
                                                        
                                                    }
                                                })
                                            });

                                    $(document).ready(function () {
                                        
                                            let valor = $("#pdlrealizoedit1").val();
                                            
                                        if (valor == 'si') {

                                            $('#pdledit').prop("disabled", false);
                                                } 
                                        
                                                });

                                                $(document).ready(function () {
                                        
                                        let valor2 = $("#pdlrealizoedit2").val();
                                    if(valor2 == 'no') {
                                        $('#pdledit').prop("disabled", true);
                                        
                                            }
                                    
                                            });
                                        </script>
                                    <fieldset class="col-md-2">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizoedit" id="pdlrealizoedit1"
                                                class="check" value="si" <?php echo $dataRegistro['aplicopdl'] ?>
                                                <?php if ($dataRegistro['aplicopdl'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizoedit" id="pdlrealizoedit2"
                                                class="check" value="no" <?php echo $dataRegistro['aplicopdl'] ?>
                                                <?php if ($dataRegistro['aplicopdl'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>

                                    <div class="col-md-2" id="pdledicion">
                                        
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdledit" name="pdledit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['descripcionpdl'] ?>">
                                        
                                    </div>
                                    <script>
                                    $(document).ready(function () {
                                        
                                        $("#oncogenedit").change(function (e) {
                                            let valor = $("#oncogenedit").val();
                                            if (valor == 'Dos cruces') {

                                                    $('#editfish').prop("hidden", false);
                                                        } else {
                                                $('#editfish').prop("hidden", true);
                                                $('#fishedit').prop('selectedIndex',0);
                                                        }
                                                    });
                                    });
                                    $(document).ready(function () {
                                        
                                            let valor = $("#oncogenedit").val();
                                            
                                        if (valor == 'Dos cruces') {

                                            $('#editfish').prop("hidden", false);
                                                } else {
                                            $('#editfish').prop("hidden", true);
                                            $('#fishedit').prop('selectedIndex',0);
                                                }
                                        
                                    });
                                        </script>
                                    <div class="col-md-2">
                                        
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogenedit" id="oncogenedit" class="form-control">
                                                
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="<?php echo $dataRegistro['oncogenher2'] ?>" selected><?php echo $dataRegistro['oncogenher2'] ?></option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        
                                    </div>
                                    <div class="col-md-2" id="editfish">
                                    
                                        <strong>FISH</strong>
                                        <select name="fishedit" id="fishedit" class="form-control">
                                            
                                            <option value="0">Seleccione</option>
                                            <option value="<?php echo $dataRegistro['fish'] ?>" selected><?php echo $dataRegistro['fish'] ?></option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    
                                    </div> 
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarInmunohistorgdMamaDer">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="editarInmunoMamaRgdDer" id="editarInmunoMamaRgdDer" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#editarInmunoMamaRgdDer").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "editarInmunoMamaRgdDer"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarInmunoRgdMamaDer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarInmunohistorgdMamaDer").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarInmunohistorgdMamaDer").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarInmunohistorgdMamaDer").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script> 
                                    <div class="col-md-12" 
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">REGIÓN GANGLIONAR MAMA DERECHA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosrgdedit" name="receptoresestrogenosrgdedit"
                                                placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresestrogenosrgd']?>">
                                        
                                    </div>
                                    <div class="col-md-4">
                                        
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronargdedit"
                                                name="receptoresprogesteronargdedit" placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresprogesteronargd'] ?>">
                                        
                                    </div>
                                    <div class="col-md-2">
                                        
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67rgdedit" name="ki67rgdedit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['ki67rgd'] ?>">
                                        
                                    </div><!--
                                    <div class="col-md-2" id="inmunoderecha4rgd">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="krgd" name="krgd" placeholder="%"
                                                class="form-control">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2">
                                        
                                            <strong>P 53</strong>
                                            <input type="number" name="p53rgdedit" id="p53rgdedit" class="form-control" value="<?php echo $dataRegistro['p53rgd'] ?>">
                                        
                                    </div>
                                    <div class="col-md-2">
                                        
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativorgdedit" id="triplenegativorgdedit" class="form-control">
                                                <option value="<?php echo $dataRegistro['triplenegativorgd'] ?>"><?php echo $dataRegistro['triplenegativorgd'] ?></option>
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                    
                                    </div>
                                    <script>
                                    $(document).ready(function () {
                                        
                                        $("#pdlrealizo1rgdedit").click(function (e) {
                                            let valor = $("#pdlrealizo1rgdedit").val();
                                                if (valor == 'si') {

                                                        $('#pdlrgdedit').prop("disabled", false);

                                                    } 
                                                })
                                            });
                                            $(document).ready(function () {
                                        
                                        $("#pdlrealizo2rgdedit").click(function (e) {
                                            let valor2 = $("#pdlrealizo2rgdedit").val();
                                                if (valor2 == 'no') {
                                                        $('#pdlrgdedit').prop("disabled", true);
                                                        $('#pdlrgdedit').val('');
                                                    }
                                                })
                                            });

                                    $(document).ready(function () {
                                        
                                            let valor = $("#pdlrealizo1rgdedit").val();
                                            
                                        if (valor == 'si') {

                                            $('#pdlrgdedit').prop("disabled", false);
                                                } 
                                        
                                                });

                                                $(document).ready(function () {
                                        
                                        let valor2 = $("#pdlrealizo2rgdedit").val();
                                    if(valor2 == 'no') {
                                        $('#pdlrgdedit').prop("disabled", true);
                        
                                            }
                                    
                                            });
                                        </script>
                                    <fieldset class="col-md-2" >
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizorgdedit" id="pdlrealizo1rgdedit"
                                                class="check" value="si" <?php echo $dataRegistro['aplicopdlrgd'] ?>
                                                <?php if ($dataRegistro['aplicopdlrgd'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizorgdedit" id="pdlrealizo2rgdedit"
                                                class="check" value="no" <?php echo $dataRegistro['aplicopdlrgd'] ?>
                                                <?php if ($dataRegistro['aplicopdlrgd'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                                    <div class="col-md-2" id="pdleditarrgd">
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdlrgdedit" name="pdlrgdedit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['descripcionpdlrgd'] ?>">
                                        
                                    </div>
                                    <script>
                                    $(document).ready(function () {
                                        
                                        $("#oncogenrgdedit").change(function (e) {
                                            let valor = $("#oncogenrgdedit").val();
                                            if (valor == 'Dos cruces') {

                                                    $('#fisheditregionderecha').prop("hidden", false);
                                                    $('#fishrgdedit').prop("required", true);
                                                        } else {
                                                $('#fisheditregionderecha').prop("hidden", true);
                                                $('#fishrgdedit').prop('selectedIndex',0);
                                                        }
                                                    });
                                    });
                                    $(document).ready(function () {
                                        
                                            let valor = $("#oncogenrgdedit").val();
                                            
                                        if (valor == 'Dos cruces') {

                                            $('#fisheditregionderecha').prop("hidden", false);
                                                } else {
                                            $('#fisheditregionderecha').prop("hidden", true);
                                            $('#fishrgdedit').prop('selectedIndex',0);
                                                }
                                        
                                    });
                                        </script>
                                    <div class="col-md-2">
                                        
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogenrgdedit" id="oncogenrgdedit" class="form-control">
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="<?php echo $dataRegistro['oncogenher2rgd'] ?>" selected><?php echo $dataRegistro['oncogenher2rgd'] ?></option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        
                                    </div>
                                    <div class="col-md-2" id="fisheditregionderecha">
                                    
                                        <strong>FISH</strong>
                                        <select name="fishrgdedit" id="fishrgdedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['fishrgd'] ?>"><?php echo $dataRegistro['fishrgd'] ?></option>
                                            <option value="0">Seleccione</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarInmunohistoMamaIz">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="editarInmunoMamaIz" id="editarInmunoMamaIz" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#editarInmunoMamaIz").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "editarInmunoMamaIz"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarInmunoMamaIz.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarInmunohistoMamaIz").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarInmunohistoMamaIz").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarInmunohistoMamaIz").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script> 
                                    <div class="col-md-12"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">MAMA IZQUIERDA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosizedit" name="receptoresestrogenosizedit"
                                                placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresestrogenosiz']?>">
                                    
                                    </div>
                                    <div class="col-md-4">
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronaizedit"
                                                name="receptoresprogesteronaizedit" placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresprogesteronaiz'] ?>">
                                        
                                    </div>
                                    <div class="col-md-2">                                      
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67izedit" name="ki67izedit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['ki67iz'] ?>">
                                        
                                    </div>
                                    <!--
                                    <div class="col-md-2" id="inmunoderechaiz4">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="kiz" name="kiz" placeholder="%"
                                                class="form-control">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2">                                       
                                            <strong>P 53</strong>
                                            <input type="number" name="p53izedit" id="p53izedit" class="form-control" value="<?php echo $dataRegistro['p53rgiz'] ?>">                               
                                    </div>
                                    <div class="col-md-2">
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativoizedit" id="triplenegativoizedit" class="form-control">
                                                <option value="<?php echo $dataRegistro['triplenegativoiz'] ?>"><?php echo $dataRegistro['triplenegativoiz'] ?></option>
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                        
                                    </div>
                                    <fieldset class="col-md-2">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizoizedit" id="pdlrealizo1izedit"
                                                onclick="aplicopdlsimmizedit();" class="check" value="si">
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizoizedit" id="pdlrealizo2izedit"
                                                onclick="aplicopdlnommizedit();" class="check" checked value="no">   
                                    </fieldset>
                                    <div class="col-md-2">
                                        
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdlizedit" name="pdlizedit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['descripcionpdliz'] ?>">
                                    
                                    </div>

                                    <div class="col-md-2">
                                        
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogenizedit" id="oncogenizedit" class="form-control">
                                                <option value="<?php echo $dataRegistro['oncogenher2iz'] ?>"><?php echo $dataRegistro['oncogenher2iz'] ?></option>
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        
                                    </div>
                                    <div class="col-md-2">
                                    
                                        <strong>FISH</strong>
                                        <select name="fishizedit" id="fishizedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['fishiz'] ?>"><?php echo $dataRegistro['fishiz'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarInmunohistoRgizMamaIz">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="editarInmunoMamaRgIz" id="editarInmunoMamaRgIz" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#editarInmunoMamaRgIz").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "editarInmunoMamaRgIz"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarInmunoRgMamaIz.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarInmunohistoRgizMamaIz").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarInmunohistoRgizMamaIz").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarInmunohistoRgizMamaIz").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script> 
                                <div class="col-md-12"
                                        style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                        <strong id="titulos">REGIÓN GANGLIONAR MAMA IZQUIERDA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                            <strong>Receptores de estrogenos (RE)</strong>
                                            <input type="number" id="receptoresestrogenosizrgiedit" name="receptoresestrogenosizrgiedit"
                                                placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresestrogenosrgiz']?>">
                                    
                                    </div>
                                    <div class="col-md-4">
                                            <strong>Receptores de progesterona (RP)</strong>
                                            <input type="number" id="receptoresprogesteronaizrgiedit"
                                                name="receptoresprogesteronaizrgiedit" placeholder="%" class="form-control" value="<?php echo $dataRegistro['receptoresprogesteronargiz'] ?>">
                                        
                                    </div>
                                    <div class="col-md-2">
                                            <strong>KI-67</strong>
                                            <input type="number" id="ki67izrgiedit" name="ki67izrgiedit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['ki67rgiz'] ?>">
                                        
                                    </div>
                                    <!--
                                    <div class="col-md-2" id="inmunoderechaiz4rgi">
                                        <div class="input-group pull-left">
                                            <strong>K</strong>
                                            <input type="number" id="kizrgi" name="kizrgi" placeholder="%"
                                                class="form-control">
                                        </div>
                                    </div>-->
                                    <div class="col-md-2">
                                        
                                            <strong>P 53</strong>
                                            <input type="number" name="p53izrgiedit" id="p53izrgiedit" class="form-control" value="<?php echo $dataRegistro['p53rgiz'] ?>">
                                        
                                    </div>
                                    <div class="col-md-2">
                                        
                                            <strong>Triple negativo</strong>
                                            <select name="triplenegativoizrgiedit" id="triplenegativoizrgiedit" class="form-control">
                                                <option value="<?php echo $dataRegistro['triplenegativorgiz'] ?>"><?php echo $dataRegistro['triplenegativorgiz'] ?></option>
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>

                                            </select>
                                        
                                    </div>
                                    <fieldset class="col-md-2">
                                            <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="pdlrealizoizrgiedit" id="pdlrealizo1izrgiedit"
                                                onclick="aplicopdlsirgiz();" class="check" value="si" >
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="pdlrealizoizrgiedit" id="pdlrealizo2izrgiedit"
                                                onclick="aplicopdlnorgiz();" class="check" checked value="no">   
                                    </fieldset>
                                    <div class="col-md-2">
                                        
                                            <strong id="inmuno-title">PDL</strong>
                                            <input type="number" id="pdlizrgiedit" name="pdlizrgiedit" placeholder="%"
                                                class="form-control" value="<?php echo $dataRegistro['descripcionpdlrgiz'] ?>">
                                        
                                    </div>

                                    <div class="col-md-2">
                                        
                                            <strong>Oncogen HER2</strong>
                                            <select name="oncogenizrgiedit" id="oncogenizrgiedit" class="form-control">
                                                <option value="<?php echo $dataRegistro['oncogenher2rgiz'] ?>"><?php echo $dataRegistro['oncogenher2rgiz'] ?></option>
                                                <option value="Sin registro">Sin registro</option>
                                                <option value="Una cruz">+</option>
                                                <option value="Dos cruces">++</option>
                                                <option value="Tres cruces">+++</option>

                                            </select>
                                        
                                    </div>
                                    <div class="col-md-2">
                                    
                                        <strong>FISH</strong>
                                        <select name="fishizrgiedit" id="fishizrgiedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['fishrgiz'] ?>"><?php echo $dataRegistro['fishrgiz'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editardatosQuimio">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="editarqumioterapia" id="editarqumioterapia" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#editarqumioterapia").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "editarqumioterapia"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editardatosQumioterapia.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editardatosQuimio").modal('hide');
                                                                    }, 1500);
                                                                    $("#editardatosQuimio").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editardatosQuimio").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script> 
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-12" style="color: #BD9FD6;">
                                        <strong>QUIMIOTERAPIA</strong>
                                        <select name="aplicoquimioedit" id="aplicoquimioedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['aplicoquimio'];?>"><?php echo $dataRegistro['aplicoquimio'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Fecha inicio</strong>
                                        <input type="date" id="fechadeinicioquimioedit" name="fechadeinicioquimioedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechainicio'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>1er Linea QT</strong>
                                        <select name="primerlineaedit" id="primerlineaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['primeralinea'];?>"><?php echo $dataRegistro['primeralinea'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionprimeralinea FROM primeralinea");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionprimeralinea']; ?>">
                                                <?php echo $row['descripcionprimeralinea']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Ciclos 1er linea</strong>
                                        <input type="number" id="ciclosprimerlineaqtedit" name="ciclosprimerlineaqtedit"
                                            class="form-control" value="<?php echo $dataRegistro['ciclosprimerlineaqt'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>2da Linea QT</strong>
                                        <select name="segundalineaedit" id="segundalineaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['segundalinea'];?>"><?php echo $dataRegistro['segundalinea'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionsegundalinea FROM segundalinea");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionsegundalinea']; ?>">
                                                <?php echo $row['descripcionsegundalinea']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Ciclos 2da linea</strong>
                                        <input type="number" id="ciclossegundalineaqtedit" name="ciclossegundalineaqtedit"
                                            class="form-control" value="<?php echo $dataRegistro['ciclossegundalineaqt'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Antraciclinas</strong>
                                        <select name="antraciclinasedit" id="antraciclinasedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['antraciclinas'];?>"><?php echo $dataRegistro['antraciclinas'];?></option>
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
                                    <div class="col-md-4">
                                        <strong>Momento de la QT</strong>
                                        <select name="momentoquimioedit" id="momentoquimioedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['momentodelaqt'];?>"><?php echo $dataRegistro['momentodelaqt'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Neoadyuvante">Neoadyuvante</option>
                                            <option value="Coadyuvante">Coadyuvante</option>
                                            <option value="Paliativo">Paliativo</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-2" >
                                        <strong>Hormonoterapia</strong><br>
                                        <input type="radio" name="hormonoterapiaedit" id="hormonoterapia1edit" onclick="aplicohormonosiedit();" class="check"
                                            value="Si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="hormonoterapiaedit" id="hormonoterapia2edit" onclick="aplicohormononoedit();" class="check"
                                            checked value="No">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-3">
                                        <strong style="color:red;">Tipo Hormonoterapia</strong>
                                        <select name="tipohormonoterapiaedit" id="tipohormonoterapiaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['tipohormonoterapia'] ?>"><?php echo $dataRegistro['tipohormonoterapia'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Letrazol">Letrazol</option>
                                            <option value="Anastrazol">Anastrazol</option>
                                            <option value="Tomoxifeno">Tomoxifeno</option>
                                            <option value="Exemetastino">Exemetastino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong style="color:red;">Momento Hormonoterapia</strong>
                                        <select name="momentohormonoterapiaedit" id="momentohormonoterapiaedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['momentohormonoterapia'] ?>"><?php echo $dataRegistro['momentohormonoterapia'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Adyuvante">Adyuvante</option>
                                            <option value="Neoadyuvante">Neoadyuvante</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-4">
                                        <strong>HER 2 +++</strong><br>
                                        <input type="radio" name="heredit" id="her1edit" onclick="aplicoher();" class="check"
                                            value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="heredit" id="her2edit" onclick="aplicoherno();" class="check"
                                            checked value="noaplico">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-4">
                                        <strong style="color:red;">Esquema HER 2 +++</strong>
                                        <select name="esquemaherdosedit" id="esquemaherdosedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['esquemaher2'];?>"><?php echo $dataRegistro['esquemaher2'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="TRASTUZUMAB/PERTUZUMAB">TRASTUZUMAB/PERTUZUMAB</option>
                                            <option value="TRASTUZUMAB/EMTANSINA">TRASTUZUMAB/EMTANSINA</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-4">
                                        <strong>Triple negativo</strong><br>
                                        <input type="radio" name="triplenegativoedit" id="triplenegativo1edit"
                                            onclick="triplesi();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="triplenegativoedit" id="triplenegativo2edit"
                                            onclick="tripleno();" class="check" checked value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>
                                    <div class="col-md-4">
                                        <strong style="color:red;">Esquema triple negativo</strong>
                                        <select name="esquematripleedit" id="esquematripleedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['esquematrilpenegativo']; ?>"><?php echo $dataRegistro['esquematrilpenegativo']; ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="ATEZOLIZUMAB">ATEZOLIZUMAB</option>
                                            <option value="PEMBROLIZUMAB">PEMBROLIZUMAB</option>
                                            <option value="OLAPARIB">OLAPARIB</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-4">
                                        <strong>Hormonosensible</strong><br>
                                        <input type="radio" name="hormonosensiblesedit" id="hormonosensibles1edit"
                                            onclick="hormonosi();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="hormonosensiblesedit" id="hormonosensibles2edit"
                                            onclick="hormonono();" class="check" checked value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-4">
                                        <strong style="color:red;">Inhibidores de ciclinas</strong>
                                        <select name="esquemahormonosensibleedit" id="esquemahormonosensibleedit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['esquemahormonosensible']; ?>"><?php echo $dataRegistro['esquemahormonosensible']; ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="PALBOCICLIB">PALBOCICLIB</option>
                                            <option value="RIBOCICLIB">RIBOCICLIB</option>
                                            <option value="ABEMACICLIB">ABEMACICLIB</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Tipo de tratamiento</strong>
                                        <select name="tipotratamientoedit" id="tipotratamientoedit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['tipotratamiento']; ?>"><?php echo $dataRegistro['tipotratamiento']; ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Adyuvante">Adyuvante</option>
                                            <option value="Coadyuvante">Coadyuvante</option>
                                            <option value="Paliativo">Paliativo</option>
                                        </select>
                                    </div>
                                    <fieldset class="col-md-4">
                                        <strong>Completo quimio</strong><br>
                                        <input type="radio" name="completoquimioedit" id="completoquimio1edit"
                                            onclick="quimiocompletosi();" class="check" checked value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                        <input type="radio" name="completoquimioedit" id="completoquimio2edit"
                                            onclick="quimiocompletono();" class="check" value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-4">
                                        <strong style="color:red;">Causa QT incompleta</strong>
                                        <select name="quimioesquemaedit" id="quimioesquemaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['causaqtincompleta']; ?>"><?php echo $dataRegistro['causaqtincompleta']; ?></option>
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
                                    <div class="col-md-4">
                                        <strong style="color:red;">Fecha evento adverso</strong>
                                        <input type="date" id="fechaeventoadversoedit" name="fechaeventoadversoedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechaeventoadverso']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong style="color:red;">Fecha progresion</strong>
                                        <input type="date" id="fechaprogresionedit" name="fechaprogresionedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechaprogresion']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong style="color:red;">Fecha recurrencia</strong>
                                        <input type="date" id="fecharecurrenciaedit" name="fecharecurrenciaedit"
                                            class="form-control" value="<?php echo $dataRegistro['fecharecurrencia']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong style="color:red;">Fecha fallecio</strong>
                                        <input type="date" id="fechadefuncionedit" name="fechadefuncionedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechafallecio']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong style="color:red;">Causa</strong>
                                        <select name="otracausaedit" id="otracausaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['causafallecio']; ?>"><?php echo $dataRegistro['causafallecio']; ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="ONCOLOGICA">ONCOLOGICA</option>
                                            <option value="EVENTO ADVERSO">EVENTO ADVERSO</option>
                                            <option value="OTRA">OTRA</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <strong style="color:red;">Especifique</strong>
                                        <input type="text" id="especifiquecausaedit" name="especifiquecausaedit"
                                            class="form-control" value="<?php echo $dataRegistro['especifique']; ?>">
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editardatosRadioterapia">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="editarradioterapia" id="editarradioterapia" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#editarradioterapia").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "editarradioterapia"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editardatosRadio.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editardatosRadioterapia").modal('hide');
                                                                    }, 1500);
                                                                    $("#editardatosRadioterapia").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editardatosRadioterapia").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script> 
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">RADIOTERAPIA</strong>
                                    </div>
                                    <div class="col-md-12" style="color: #BD9FD6; ">
                                        <strong>RADIOTERAPIA</strong>
                                        <select name="radioterapiaedit" id="radioterapiaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['aplicoradio'];?>"><?php echo $dataRegistro['aplicoradio'];?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Tipo Radioterapia</strong>
                                        <select name="aplicoradioterapiaedit" id="aplicoradioterapiaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['decripcionradio']?>"><?php echo $dataRegistro['decripcionradio']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="CICLO MAMARIO COMPLETO">CICLO MAMARIO COMPLETO</option>
                                            <option value="TANGENCIAL">TANGENCIAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Fecha de inicio</strong>
                                        <input type="date" id="fechainicioradioedit" name="fechainicioradioedit"
                                            class="form-control" value="<?php echo $dataRegistro['fecharadio']?>">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>N° de sesiones</strong>
                                        <input type="number" id="numerosesionesedit" name="numerosesionesedit"
                                            class="form-control" value="<?php echo $dataRegistro['numerodesesiones']?>">
                                    </div>
                                
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editardatosMolecular">

<div class="modal-dialog modal-lg">

    <!-- Modal content-->

    <div class="modal-content">
        <div class="modal-header" id="cabeceraModalMama">
            
            <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
        
        </div>
        <div class="modal-body">

            <div id="panel_editar">

                <div class="contrato-nuevo">
                    <div class="modal-body">

                        <!-- form start -->
                    

                        <form name="editarmolecular" id="editarmolecular" onSubmit="return limpiar()" autocomplete="off">
                            <div class="form-row">
                                <div id="mensaje"></div>
                                <script>
                                $("#editarmolecular").on("submit", function(e) {
                                    checked = this.querySelectorAll('input[type=checkbox]:checked');
                                    e.preventDefault();

                                    var formData = new FormData(document.getElementById(
                                        "editarmolecular"));
                                    formData.append("dato", "valor");

                                    $.ajax({

                                        url: "aplicacion/editardatosMolecular.php",
                                        type: "post",
                                        dataType: "html",
                                        data: formData,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        success: function(datos) {
                                            $("#mensaje").html(datos);
                                            let id = $("#id_paciente").val();
                                            let ob = {
                                                        id: id
                                                        };

                                                $.ajax({
                                                        type: "POST",
                                                        url: "consultaCancerdeMamaBusqueda.php",
                                                        data: ob,
                                                
                                                    success: function(data) {

                                                        $("#tabla_resultado").html(data);
                                                        //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                        setTimeout(function(){
                                                            $("#editardatosMolecular").modal('hide');
                                                                }, 1500);
                                                                $("#editardatosMolecular").modal('hide');
                                                        
                                                        }
                                                        
                                                });
                                                $("#editardatosMolecular").modal('hide');
                                        }
                                    })
                                })
                            
                                
                                </script> 
                                <div class="col-md-12">
                                        <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                    </div>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">MOLECULAR MAMA DERECHA</strong>
                                    </div>
                                    
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalaedit" id="luminalaedit"
                                                class="check" value="si" <?php echo $dataRegistro['luminala'] ?>
                                                <?php if ($dataRegistro['luminala'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalaedit" id="luminalaedit"
                                                class="check"  value="no" <?php echo $dataRegistro['luminala'] ?>
                                                <?php if ($dataRegistro['luminala'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                            
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Luminal B</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalbedit" id="luminalbedit"
                                                class="check" value="si" <?php echo $dataRegistro['luminalb'] ?>
                                                <?php if ($dataRegistro['luminalb'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalbedit" id="luminalbedit"
                                                class="check" value="no" <?php echo $dataRegistro['luminalb'] ?>
                                                <?php if ($dataRegistro['luminalb'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                            
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Enriquecido en Her 2 +</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="enriquecidoherdosedit" id="enriquecidoherdosedit"
                                                class="check" value="si" <?php echo $dataRegistro['enriquecidoher2'] ?>
                                                <?php if ($dataRegistro['enriquecidoher2'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="enriquecidoherdosedit" id="enriquecidoherdosedit"
                                                class="check" value="no" <?php echo $dataRegistro['enriquecidoher2'] ?>
                                                <?php if ($dataRegistro['enriquecidoher2'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                                    
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Basal</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="basaledit" id="basaledit"
                                                class="check" value="si" <?php echo $dataRegistro['basal'] ?>
                                                <?php if ($dataRegistro['basal'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="basaledit" id="basaledit"
                                                class="check" value="no" <?php echo $dataRegistro['basal'] ?>
                                                <?php if ($dataRegistro['basal'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editardatosMolecularMamaIz">

<div class="modal-dialog modal-lg">

    <!-- Modal content-->

    <div class="modal-content">
        <div class="modal-header" id="cabeceraModalMama">
            
            <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
        
        </div>
        <div class="modal-body">

            <div id="panel_editar">

                <div class="contrato-nuevo">
                    <div class="modal-body">

                        <!-- form start -->
                    

                        <form name="editarmoleculariz" id="editarmoleculariz" onSubmit="return limpiar()" autocomplete="off">
                            <div class="form-row">
                                <div id="mensaje"></div>
                                <script>
                                $("#editarmoleculariz").on("submit", function(e) {
                                    checked = this.querySelectorAll('input[type=checkbox]:checked');
                                    e.preventDefault();

                                    var formData = new FormData(document.getElementById(
                                        "editarmoleculariz"));
                                    formData.append("dato", "valor");

                                    $.ajax({

                                        url: "aplicacion/editardatosMolecularIz.php",
                                        type: "post",
                                        dataType: "html",
                                        data: formData,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        success: function(datos) {
                                            $("#mensaje").html(datos);
                                            let id = $("#id_paciente").val();
                                            let ob = {
                                                        id: id
                                                        };

                                                $.ajax({
                                                        type: "POST",
                                                        url: "consultaCancerdeMamaBusqueda.php",
                                                        data: ob,
                                                
                                                    success: function(data) {

                                                        $("#tabla_resultado").html(data);
                                                        //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                        setTimeout(function(){
                                                            $("#editardatosMolecularMamaIz").modal('hide');
                                                                }, 1500);
                                                                $("#eeditardatosMolecularMamaIz").modal('hide');
                                                        
                                                        }
                                                        
                                                });
                                                $("#editardatosMolecularMamaIz").modal('hide');
                                        }
                                    })
                                })
                            
                                
                                </script> 
                                <div class="col-md-12">
                                        <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                    </div>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">MOLECULAR MAMA IZQUIERDA</strong>
                                    </div>
                                    
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Luminal A</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalaeditiz" id="luminalaeditiz"
                                                class="check" value="si" <?php echo $dataRegistro['luminalaiz'] ?>
                                                <?php if ($dataRegistro['luminalaiz'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalaeditiz" id="luminalaeditiz"
                                                class="check"  value="no" <?php echo $dataRegistro['luminalaiz'] ?>
                                                <?php if ($dataRegistro['luminalaiz'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                            
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Luminal B</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="luminalbeditiz" id="luminalbeditiz"
                                                class="check" value="si" <?php echo $dataRegistro['luminalbiz'] ?>
                                                <?php if ($dataRegistro['luminalbiz'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="luminalbeditiz" id="luminalbeditiz"
                                                class="check" value="no" <?php echo $dataRegistro['luminalbiz'] ?>
                                                <?php if ($dataRegistro['luminalbiz'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                            
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Enriquecido en Her 2 +</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="enriquecidoherdoseditiz" id="enriquecidoherdoseditiz"
                                                class="check" value="si" <?php echo $dataRegistro['enriquecidoher2iz'] ?>
                                                <?php if ($dataRegistro['enriquecidoher2iz'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="enriquecidoherdoseditiz" id="enriquecidoherdoseditiz"
                                                class="check" value="no" <?php echo $dataRegistro['enriquecidoher2iz'] ?>
                                                <?php if ($dataRegistro['enriquecidoher2iz'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                                    
                                    <fieldset class="col-md-3">
                                            <strong>&nbsp;&nbsp;Basal</strong><br>
                                            &nbsp;<strong>Si</strong>
                                            <input type="radio" name="basaleditiz" id="basaleditiz"
                                                class="check" value="si" <?php echo $dataRegistro['basaliz'] ?>
                                                <?php if ($dataRegistro['basaliz'] == "si") echo 'checked="checked"' ?>>
                                            &nbsp;<strong>No</strong>
                                            <input type="radio" name="basaleditiz" id="basaleditiz"
                                                class="check" value="no" <?php echo $dataRegistro['basaliz'] ?>
                                                <?php if ($dataRegistro['basaliz'] == "no") echo 'checked="checked"' ?>>   
                                    </fieldset>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
