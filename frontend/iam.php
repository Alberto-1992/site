<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/estilosMenuNew.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!--<script defer src="https://app.embed.im/snow.js"></script>-->
    <title>Sindrome Coronario Agudo</title>
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

        <span id="cabecera">Infarto Agudo al Miocardio</span>

    </header>




    <div class="gallery">

        <?php
    if(isset($_SESSION['usuarioAdmin'])){

require 'menu/menuPrincipal.php';

?>
        <article class="card" id="infartoelevacion">
            <a href="iam">
                <hr id="hrinfarto">
                <p>S.C.A</p>
                <a id="link" href="iam" class="btn btn-success">Ver Información</a>

            </a>
        </article>
<!--
        <article class="card" id="infartosinelevacion">
            <a href="iamse">
                <hr id="hr2">
                <p>IAM sin elevación del ST</p>
                <a id="link" href="iamse" class="btn btn-warning">Ver Información</a>

            </a>
        </article>
        <article class="card" id="angina">
            <a href="angina">
                <hr id="hr3">
                <p>Angina</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>
-->
        <article class="card" id="tresmeses">
            <a href="seguimiento3meses">
                <hr id="hr3">
                <p>Seguimiento 3 meses</p>
                <a id="link" href="seguimiento3meses" class="btn btn-info">Ver Información</a>

            </a>
        </article>
        <article class="card" id="seismeses">
            <a href="seguimientoseismeses">
                <hr id="hr3">
                <p>Seguimiento 6 meses</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>
        <article class="card" id="oneyear">
            <a href="segumientooneyear">
                <hr id="hr3">
                <p>Seguimiento 1 año</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>

        <?php

    }else if(isset($_SESSION['usuarioMedico'])){

require 'menu/menuMedico.php';

?>
        <article class="card" id="infartoelevacion">
            <a href="iam">
                <hr id="hrinfarto">
                <p>Infarto agudo al miocardio con elevacion del ST (IAMCEST)</p>
                <a id="link" href="iam" class="btn btn-success">Ver Información</a>

            </a>
        </article>

        <article class="card" id="infartosinelevacion">
            <a href="iamse">
                <hr id="hr2">
                <p>Infarto agudo al miocardio sin elevación del ST</p>
                <a id="link" href="iamse" class="btn btn-warning">Ver Información</a>

            </a>
        </article>
        <article class="card" id="angina">
            <a href="angina">
                <hr id="hr3">
                <p>Angina</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>
        <article class="card" id="angina">
            <a href="angina">
                <hr id="hr3">
                <p>Seguimiento 3 meses</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>
        <article class="card" id="angina">
            <a href="angina">
                <hr id="hr3">
                <p>Seguimiento 6 meses</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>
        <article class="card" id="angina">
            <a href="angina">
                <hr id="hr3">
                <p>Seguimiento 1 año</p>
                <a id="link" href="angina" class="btn btn-info">Ver Información</a>

            </a>
        </article>


        <!--
<div class="cardio6">

    <hr id="hr6">
     <p>Primer contacto</p>
    
       <a id="link" href="#" class="btn btn-secondary">Ver Información</a>
  
</div>

<div class="cardio7">

    <hr id="hr7">
     <p>Puerta balón</p>
     <a id="link" href="#" class="btn btn-dark">Ver Información</a>
   
</div>

<div class="cardio8">

    <hr id="hr8">
     <p>Tiempo isquemia total</p>
     <a id="link" href="#" class="btn btn-success">Ver Información</a>
     
</div>

<div class="cardio9">

    <hr id="hr9">
     <p>Tiempo puerta aguda</p>
     <a id="link" href="#" class="btn btn-warning">Ver Información</a>

</div>

<div class="cardio10">

    <hr id="hr10">
     <p>Estrategia ACTP</p>
     <a id="link" href="#" class="btn btn-danger">Ver Información</a>
</div> 
-->
        <?php
       }
    
       ?>
    </div>

</body>

</html>