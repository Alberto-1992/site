<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <link rel="stylesheet" href="css/multiple-select.css" />
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <!--<script defer src="https://app.embed.im/snow.js"></script>-->
    <title>Infarto Agudo al Miocardio</title>
</head>

<body>

    <div class="box1">
        <header class="headerinfarto">
            <span id="cabecera">Sindrome Coronario Agudo</span>

        </header>

        <?php
require 'menu/menuInfarto.php';

?>

        <script>
            $.ajax({
                url: 'consultaPacienteBusqueda.php',
                type: 'POST',
                dataType: 'html',
            })

            .done(function(resultado) {
                $("#tabla_resultado").html(resultado);
            })
        $(obtener_registros());

        function obtener_registros(paciente) {
            $.ajax({
                    url: 'consultapacientes.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        pacientes: paciente
                    },
                })

                .done(function(resultado) {
                    $("#tabla_resultadobus").html(resultado);
                })
        }
        $(document).on('keyup', '#busqueda', function() {
            var valorBusqueda = $(this).val();
            if (valorBusqueda != "") {
                obtener_registros(valorBusqueda);
            } else {
                obtener_registros();
            }
        });
        </script>
                                    <style>
                                        .control{
                                            border: none;
                                            outline: none;
                                            border-bottom: 1px solid grey;
                                            font-size: 18px;
                                            height: 35px;
                                            text-transform: uppercase;
                                        }
                                        </style>
        <div class="autoheight">
<input type="text" class="form-control col-md-12" id="busqueda" name="busqueda" value="" placeholder="Buscar..." >
            <div id="tabla_resultadobus">

            </div>
            <div id="tabla_resultado" class="adaptar"></div>
        </div>
    </div>
    <?php

require 'modals/cargarPacienteCE.php';
require 'modals/seguimientoPaciente.php';

?>

</body>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'>
</script>
<script src="js/multiple-select.js"></script>
<script src="js/multiple-select-factores.js"></script>

</html>