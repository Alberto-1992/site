<style>
    .ver-info:hover{
        background: grey;
        color: white;
        cursor: pointer;
    }
    </style>
<div id="lista-comentarios">
<?php 

	require 'conexionCancer.php';
    $sqlQueryComentarios  = $conexion2->query("SELECT dato_usuario.id  FROM dato_usuario");
    $total_registro       = mysqli_num_rows($sqlQueryComentarios);
    
	$sql = "SELECT COUNT(*) total FROM dato_usuario";
    $result = mysqli_query($conexion2, $sql);
    $fila = mysqli_fetch_assoc($result);

    $query= $conexionCancer->prepare("SELECT dato_usuario.id, dato_usuario.curp, dato_usuario.nombrecompleto, dato_usuario.poblacionindigena, dato_usuario.escolaridad, dato_usuario.fechanacimiento, dato_usuario.edad, dato_usuario.sexo, dato_usuario.raza, dato_usuario.estado, dato_usuario.municipio FROM dato_usuario order by dato_usuario.id DESC LIMIT 5 ");
    if(isset($_POST['pacientes']))
{
	$q=$conexion2->real_escape_string($_POST['pacientes']);
	$query=$conexionCancer->prepare("SELECT dato_usuario.id, dato_usuario.curp, dato_usuario.nombrecompleto, dato_usuario.poblacionindigena, dato_usuario.escolaridad, dato_usuario.fechanacimiento, dato_usuario.edad, dato_usuario.sexo, dato_usuario.raza, dato_usuario.estado, dato_usuario.municipio FROM dato_usuario  where
		dato_usuario.id LIKE '%".$q."%' OR
        dato_usuario.nombrecompleto LIKE '%".$q."%' OR
		dato_usuario.fechanacimiento LIKE '%".$q."%' OR
		dato_usuario.edad LIKE '%".$q."%' OR
		dato_usuario.sexo LIKE '%".$q."%' OR
		dato_usuario.curp LIKE '%".$q."%' group by dato_usuario.id");
}
        ?>
<input type="submit" id="totalregistro" value="<?php echo $fila['total']; ?>">

<input type="submit" data-bs-toggle="modal" data-bs-target="#artritis" value="+Cargar Paciente"
    id="boton_artritis">
    <hr id="hrinicial">
 
        <input type="hidden" name="total_registro" id="total_registro" value="<?php echo $total_registro; ?>" />
        <?php
        
        
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        while($dataRegistro= $query->fetch())
        { ?>
        <div class="item-comentario" id="<?php echo $dataRegistro['id']; ?>" >
            <?php
            $id = $dataRegistro['id'];
            ?>
            <div id='<?php echo $id ?>' class='ver-info' >
            
                    <?php echo '<strong style="font-family: monospace; white-space: nowrap; font-size: 12px; margin-left: 7px; text-transform: uppercase;">&nbsp'.$dataRegistro['nombrecompleto'].'</strong>'.'<br>'.'<strong style="font-size: 9px; margin-left: 7px;">&nbsp'.$dataRegistro['curp'].'</strong>'.'<br>'.'<strong style="float:right; font-size: 8px; margin-top: -20px; margin-right: 8px;">&nbsp'.$dataRegistro['sexo'].'</strong>' ?>
                    </div> 
            <hr>
            </div>
            <?php 
        }?>
    
</script>

<div class="col-md-12 col-sm-12">
    <div class="ajax-loader text-center">
        <img src="img/cargando.svg">
        <br>
        Cargando más Registros...
    </div>
</div>


<script>
$(function() {

$('.item-comentario').on('click', '.ver-info', function() {

    var id = $(this).prop('id');
      
    let ob = {
        id: id
    };

    $.ajax({
        type: "POST",
        url: "consultaArtritisBusqueda.php",
        data: ob,
        beforeSend: function() {

        },
        success: function(data) {

            $("#tabla_resultado").html(data);

        }
    });

});
});
$(document).ready(function() {
$('.item-comentario').on('click', '.ver-info', function() {
//const nombre = document.querySelector(".ver-info");
//nombre.style.color = "blue";
    //Añadimos la imagen de carga en el contenedor
    $('#tabla_resultado').html(
        '<div id="tabla_resultado" style="position: fixed;  top: 0px; left: 0px;  width: 100%; height: 100%; z-index: 9999;  opacity: .7; background: url(imagenes/loader2.gif) 50% 50% no-repeat rgb(249,249,249);"><br/></div>'
    );


    return false;
});
});


$(document).ready(function() {
pageScroll();

$('.ajax-loader').hide();

});

document.addEventListener('keydown', (event) => {

if (event.keyCode == 8 || event.keyCode == 46) {
    $("#tabla_resultadobus").off("scroll");
}
}, false);

function pageScroll() {
    $("#tabla_resultadobus").on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPos = $("#tabla_resultadobus").height() + $("#tabla_resultadobus").scrollTop();
        var totalregistro = $("#total_registro").val();

        if ((((scrollHeight - 250) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 300) >=
                scrollPos) / scrollHeight == 0) || (((scrollHeight - 350) >= scrollPos) / scrollHeight ==
                0) || (((scrollHeight - 400) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 450) >=
                scrollPos) / scrollHeight == 0) || (((scrollHeight - 500) >= scrollPos) / scrollHeight ==
                0)) {
            if ($(".item-comentario").length < $("#total_registro").val()) {
                var utimoId = $(".item-comentario:last").attr("id");


                $("#tabla_resultadobus").off("scroll");
                $.ajax({
                    url: 'obteniedoMasDatosCancerMama.php?utimoId=' + utimoId + '&totalregistro' +
                        totalregistro,
                    type: "get",
                    beforeSend: function() {
                        $('.ajax-loader').show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('.ajax-loader').hide();
                            $("#lista-comentarios").append(data);
                            pageScroll();
                        }, 1000);
                    }
                });


            } else {

            }
        }
    });
}
</script>