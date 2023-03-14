<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/estilosMenuNew.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!--<script defer src="https://app.embed.im/snow.js"></script>-->
    <title>SCA</title>
</head>

<body>
    <style>
        a {
            text-decoration: none;
        }

        P {
            font-size: 13px;
        }
    </style>

    <header class="header">

        <span id="cabecera">SINDROME CORONARIO AGUDO</span>

    </header>




    <div class="gallery">

        <?php
        if (isset($_SESSION['usuarioAdmin'])) {

            require 'menu/menuPrincipal.php';

        ?>
            <article class="card" id="infartoelevacion">
                <a href="iam">
                    <hr id="hrinfarto">
                    <p>S.C.A</p>
                    <a id="link" href="iam" class="btn btn-success">Ver Información</a>
                </a>
            </article>


            <article class="card" id="tresmeses">
                <a href="">
                    <hr id="hr3">
                    <p>Seguimiento 3 meses</p>
                    <a id="link" href="seguimiento3meses" class="btn btn-info">Ver Información</a>
                </a>
            </article>

            <article class="card" id="seismeses">
                <a href="seguimientoseismeses">
                    <hr id="hr3">
                    <p>Seguimiento 6 meses</p>
                    <a id="link" href="seguimientoseismeses" class="btn btn-info">Ver Información</a>

                </a>
            </article>

            <article class="card" id="oneyear">
                <a href="segumientooneyear">
                    <hr id="hr3">
                    <p>Seguimiento 1 año</p>
                    <a id="link" href="segumientooneyear" class="btn btn-info">Ver Información</a>

                </a>
            </article>

        <?php

        } else if (isset($_SESSION['usuarioMedico'])) {

            require 'menu/menuMedico.php';

        ?>


        <?php
        }

        ?>
    </div>
</body>

</html>