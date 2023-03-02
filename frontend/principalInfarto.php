<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/estilosMenuNew.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!--<script defer src="https://app.embed.im/snow.js"></script>-->
    <title>Plataforma HRAEI.</title>
</head>

<body>

    <style>
    a {
        text-decoration: none;
    }
    </style>

    <header class="header">

        <span id="cabecera">HRAEI-GESTIÓN DIGITAL EN SALUD</span>

    </header>

    <div class="gallery">

        <?php
        if (isset($_SESSION['usuarioAdmin'])) {
            $usernameSesion = $_SESSION['usuarioAdmin'];
            require '../cisfa/conexion.php';
            $statement = $conexion->prepare("SELECT correo_electronico, nombre_trabajador, rol_acceso FROM login WHERE correo_electronico= :correo_electronico AND rol_acceso = :rol_acceso");
            $statement->execute(array(
                ':correo_electronico' => $usernameSesion,
                ':rol_acceso' => 5
            ));
            $rw = $statement->fetch();
            if ($rw != false) {


                require 'menu/menuPrincipal.php';

        ?>

        <article class="card" id="datosTrabajador">
            <a href="datosUsuario">


                <hr id="hr1datostrabajador">
                <p>Datos de usuario</p>
                <a id="linkdatostrabajador" href="datosUsuario" class="btn btn-success">Datos usuario</a>

            </a>
        </article>
        <article class="card" id="cardio1">
            <a href="infarto">

                <hr id="hrinfarto">
                <p>Sindrome Coronario Agudo(SCA)</p>
                <a id="link" href="infarto" class="btn btn-danger">S.C.A</a>
            </a>
        </article>
        <article class="card" id="cancer">
            <a href="cancer">
                <hr id="hrcancermama">
                <p>Clinicas/Cancer</p>
                <a id="linkcancer" href="cancer" class="btn btn-warning">Cancer</a>
            </a>
        </article>
 <article class="card" id="reconstruccioncraneal">
            <a href="ace.php">
                <hr id="hr4">
                <p>Reconstrucción Craneal</p>
                <a id="link" href="iam" class="btn btn-dark">R.C</a>

            </a>
        </article>
        
        <article class="card" id="esclerosis">
            <a href="../esclerosis/principal">
                <hr id="hr3">
                <p>Esclerosis Multiple</p>
                <a id="link" href="../esclerosis/principal" class="btn btn-info">Esclerosis</a>

            </a>
        </article>
        
       
        <article class="card" id="lupus">
            <a href=".#">
                <hr id="hr7">
                <p>Lupus</p>
                <a id="link" href="#" class="btn btn-warning">Lupus</a>
            </a>
        </article>
        <!--
        <article class="card" id="creheer">
            <a href=".#">
                <hr id="hr7">
                <p>CREHER</p>
                <a id="link" href="#" class="btn btn-info">CREHER</a>
            </a>
        </article>
        -->
        <article class="card" id="artritis">
            <a href="artritis">
                <hr id="hr7">
                <p>Artritis</p>
                <a id="link" href="artritis" class="btn btn-warning">Artritis</a>
            </a>
        </article>
        <article class="card" id="carnetdigital">
            <a href="#">
                <hr id="hr2">
                <p>Mi carnet digital</p>
                <a id="link" href="#" class="btn btn-primary">Mi carnet digital</a>

            </a>
        </article>
        <article class="card" id="cisfa">
            <a href="../cisfa/principal">
                <hr id="hr2">
                <p>CISFA</p>
                <a id="link" href="../cisfa/principal" class="btn btn-primary">CISFA</a>

            </a>
        </article>
         <!--    
        <article class="card" id="hemodinamia">
            <a href="ace.php">
                <hr id="hr4">
                <p>Hemodinamia</p>
                <a id="link" href="iam" class="btn btn-dark">Hemodinamia</a>

            </a>
        </article>
       
        <article class="card" id="rehabilitacion">
            <a href="api">
                <hr id="hr5">
                <p>Rehabilitación</p>
                <a id="link" href="iam" class="btn btn-secondary">Rehabilitación</a>

            </a>
        </article>
            -->
        <article class="card" id="evaluacion">
            <a href="../rh/principal">
                <hr id="hr6">
                <p>Evaluación del Desempeño</p>
                <a id="link" href="../rh/principal" class="btn btn-success">Evaluación</a>
            </a>
        </article>

        <article class="card" id="reclutamiento">
            <a href="../bolsa/principal">
                <hr id="hr7">
                <p>Reclutamiento y Selección</p>
                <a id="link" href="../bolsa/principal" class="btn btn-success">Reclutamiento</a>
            </a>
        </article>

        <article class="card" id="compatibilidad">
            <a href="../compatibilidad/principal">
                <hr id="hr7">
                <p>Compatibilidad laboral</p>
                <a id="link" href="../compatibilidad/principal" class="btn btn-success">Compatibilidad</a>
            </a>
        </article>
        <article class="card" id="buzon">
            <a href="#">
                <hr id="hr7">
                <p>Buzón Institucinal</p>
                <a id="link" href="#" class="btn btn-primary">SUG</a>
            </a>
        </article>
        <article class="card" id="estructura-organizacional">
            <a href="../rh/admin">
                <hr id="hrestructura-organizacional">
                <p>Modulo usuarios</p>
                <a id="linkestructura" href="../rh/admin" class="btn btn-secondary">Estructura</a>
            </a>
        </article>
        <article class="card" id="activostecnologia">
            <a href="activosti">
                <hr id="hr5">
                <p>Control de activos T.I</p>
                <a id="link" href="activosti" class="btn btn-secondary">Activos T.I</a>

            </a>
        </article>

        <?php
            }
        } else if (isset($_SESSION['usuarioDatos'])) {
            require 'menu/menuPersonal.php';

            ?>

        <article class="card" id="datosTrabajador">

            <hr id="hr1datostrabajador">
            <p>Mis datos personales</p>
            <!--<a id="linkdatostrabajador" href="misDatos" class="btn btn-success">Mis datos</a>-->

        </article>
        <!--
        <article class="card" id="cursosDiplomas">

            <hr id="hr2">
            <p>Mis cursos y diplomas</p>
            <a id="link" href="misCursos" class="btn btn-warning">Mis cursos</a>

        </article>
        <article class="card" id="solicitudCursos">

            <hr id="hr1">
            <p>Solicitud de curso</p>
            <a id="link" href="misSolicitudes" class="btn btn-info">Solicitud de curso</a>

        </article>
        <article class="card">

            <hr id="hr3">
            <p>Formato de incidencia</p>
            <a id="link" href="formatoIncidencia" class="btn btn-danger">Ver Información</a>

        </article>-->
        <article class="card" id="evaluacion">
            <a href="../rh/principal">
                <hr id="hr6">
                <p>Evaluación del Desempeño</p>
                <a id="link" href="../rh/principal" class="btn btn-success">Evaluación</a>
            </a>
        </article>
        <?php
        if (isset($_SESSION['usuarioDatos'])) {
            $usernameSesion = $_SESSION['usuarioDatos'];
            require '../cisfa/conexion.php';
            $statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeo WHERE correo= '$usernameSesion' AND rol = 7");
            $statement->execute(array(
                ':correo' => $usernameSesion
            ));
            $rw = $statement->fetch();
            $admin = $rw['correo'];
            if ($admin == 'msandoval@hraei.gob.mx' or $admin == 'bramirez@gmail.com') {
                ?>
        <article class="card" id="estructura-organizacional">
            <a href="../rh/admin">
                <hr id="hr6">
                <p>Modulo usuarios</p>

                <a id="linkestructura" href="../rh/admin" class="btn btn-secondary">Estructura</a>
            </a>
        </article>
        <br>
        <?php
                }
        }
            ?>


        <?php

        } else if (isset($_SESSION['usuarioJefe'])) {
            require 'menu/menuPersonal.php';
        ?>


        <article class="card" id="datosTrabajador">

            <hr id="hr1datostrabajador">
            <p>Mis datos personales</p>
            <!--<a id="linkdatostrabajador" href="misDatos" class="btn btn-success">Mis datos</a>-->

        </article>
        <!--
        <article class="card" id="cursosDiplomas">

            <hr id="hr2">
            <p>Mis cursos y diplomas</p>
            <a id="link" href="misCursos" class="btn btn-warning">Mis cursos</a>

        </article>
        <article class="card" id="solicitudCursos">

            <hr id="hr1">
            <p>Solicitud de curso</p>
            <a id="link" href="misSolicitudes" class="btn btn-info">Solicitud de curso</a>

        </article>
        <article class="card">

            <hr id="hr3">
            <p>Formato de incidencia</p>
            <a id="link" href="formatoIncidencia" class="btn btn-danger">Ver Información</a>

        </article>
        -->
        <article class="card" id="cursosDiplomas">

            <hr id="hr6">
            <p>Evaluación del Desempeño</p>

            <a id="link" href="../rh/principal" class="btn btn-secondary">Evaluar</a>


        </article>
        <?php
        if (isset($_SESSION['usuarioJefe'])) {
            $usernameSesion = $_SESSION['usuarioJefe'];
            require '../cisfa/conexion.php';
            $statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeojefes WHERE correo= '$usernameSesion' AND rol = 4");
            $statement->execute(array(
                ':correo' => $usernameSesion
            ));
            $rw = $statement->fetch();
            $admin = $rw['correo'];
            if ($admin == 'bramirez699@gmail.com') {
                ?>
        <article class="card" id="estructura-organizacional">
            <a href="../rh/admin">
                <hr id="hr6">
                <p>Modulo usuarios</p>

                <a id="linkestructura" href="../rh/admin" class="btn btn-secondary">Estructura</a>
            </a>
        </article>
        <?php
        
            $usernameSesion = $_SESSION['usuarioJefe'];
            require '../cisfa/conexion.php';
            $statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeojefes WHERE correo= '$usernameSesion' AND rol = 4");
            $statement->execute(array(
                ':correo' => $usernameSesion
            ));
            $rw = $statement->fetch();
            $admin = $rw['correo'];
        }else if ($admin == 'drraulguzman@gmail.com') {
                ?>
        <article class="card" id="cancer">
            <a href="cancer">
                <hr id="hrcancermama">
                <p>Cancer</p>
                <a id="linkcancer" href="cancer" class="btn btn-warning">Cancer</a>
            </a>
        </article>
        <br>
        <?php
        $usernameSesion = $_SESSION['usuarioJefe'];
        require '../cisfa/conexion.php';
        $statement = $conexion->prepare("SELECT correo_electronico, nombre_trabajador, rol_acceso FROM login WHERE correo_electronico= :correo_electronico AND rol_acceso = :rol_acceso");
        $statement->execute(array(
            ':correo_electronico' => $usernameSesion,
            ':rol_acceso' => 5
        ));
        $rw = $statement->fetch();
                 }else if($admin == 'antonioflores35@yahoo.com.mx') {

                    ?>
                    <article class="card" id="cisfa">
            <a href="../cisfa/principal">
                <hr id="hr2">
                <p>CISFA</p>
                <a id="link" href="../cisfa/principal" class="btn btn-primary">CISFA</a>

            </a>
        </article>
        <?php
                 }
        }
            ?>

        <?php

        } else if (isset($_SESSION['usuarioMedico'])) {
            require 'menu/menuMedico.php';
        ?>


        <article class="card" id="datosTrabajador">

            <hr id="hr1datostrabajador">
            <p>Mis datos personales</p>
            <a id="linkdatostrabajador" href="#" class="btn btn-success">Mis datos</a>

        </article><!--
        <article class="card" id="cancer-mama">
            <a href="cancerMama">
                <hr id="hrcancermama">
                <p>Cancer</p>
                <a id="link" href="cancerMama" class="btn btn-warning">Cancer</a>
            </a>
        </article>
        <article class="card" id="cardio1">
            <a href="infarto">

                <hr id="hrinfarto">
                <p>Sindrome Coronario Agudo(SCA)</p>
                <a id="link" href="infarto" class="btn btn-danger">S.C.A</a>
            </a>
        </article>
        
        <article class="card" id="cursosDiplomas">

            <hr id="hr2">
            <p>Mis cursos y diplomas</p>
            <a id="link" href="misCursos" class="btn btn-warning">Mis cursos</a>

        </article>
        <article class="card" id="solicitudCursos">

            <hr id="hr1">
            <p>Solicitud de curso</p>
            <a id="link" href="misSolicitudes" class="btn btn-info">Solicitud de curso</a>

        </article>
        <article class="card">

            <hr id="hr3">
            <p>Formato de incidencia</p>
            <a id="link" href="formatoIncidencia" class="btn btn-danger">Ver Información</a>

        </article>-->
        <article class="card">

            <hr id="hr6">
            <p>Evaluación del Desempeño</p>

            <a id="link" href="../rh/principal" class="btn btn-secondary">Evaluar</a>

        </article>
        <br>
        <?php
        
        //include 'footer.php';
            
        } else if (isset($_SESSION['residentes'])) {
            require 'menu/menuResidentes.php';

            ?>
            
<article class="card" id="cancer">
            <a href="cancer">
                <hr id="hrcancermama">
                <p>Clinicas/Cancer</p>
                <a id="linkcancer" href="cancer" class="btn btn-warning">Cancer</a>
            </a>
        </article>


            <?php
        }else if (isset($_SESSION['artritis'])) {
            require 'menu/menuArtritis.php';

            ?>
            
<article class="card" id="artritis">
            <a href="artritis">
                <hr id="hr7">
                <p>Artritis</p>
                <a id="link" href="artritis" class="btn btn-warning">Artritis</a>
            </a>
        </article>
            
            <br>


            <?php
        }
            ?>
    </div>
</body>

</html>