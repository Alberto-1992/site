<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilosMenuNew.css">
</head>

<body>

    <nav class="main-menu">
        <ul>
            <li>
                <a href="principal">
                    <i class="fa fa-hospital-o fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        HRAE IXTAPALUCA
                    </span>
                </a>

            </li>

            <!--
            <hr>
            <li class="has-subnav">
                <a href="datosUsuario">
                    <i class="fa fa-user fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Mis Datos
                    </span>
                </a>
            </li>-->

            <hr>
            <li class="has-subnav">
                <a href="infarto">
                    <i class="fa fa-heartbeat" aria-hidden="true"></i>
                    <span class="nav-text">
                        Sindrome Coronario Agudo
                    </span>
                </a>
            </li>


            <hr>
            <li class="has-subnav">
                <a href="cancer">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    <span class="nav-text">
                        Cáncer
                    </span>
                </a>
            </li>

            <hr>
            <li class="has-subnav">
                <a href="artritis">
                    <i class="fa fa-hand-spock-o fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Artritis
                    </span>
                </a>
            </li>

            <hr>
            <li class="has-subnav">
                <a href="../cisfa/principal">
                    <i class="fa fa-medkit fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Cisfa
                    </span>
                </a>
            </li>

            <hr>
            <li class="has-subnav">
                <a href="lupus">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <span class=" nav-text">
                        Lupus
                    </span>
                </a>

            </li>
            <!--
            <hr>
            <li>
                <a href="#">
                    <i class="fa fa-tint" aria-hidden="true"></i>
                    <span class="nav-text">
                        Hemodinamia
                    </span>
                </a>

            </li>
            <hr>
            <li>
                <a href="#">
                    <i class="fa fa-wheelchair-alt fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Rehabilitación
                    </span>
                </a>

            </li>
            <li>
                <a href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true""></i>
                    <span class=" nav-text">
                        Evaluación del Desempeño
                        </span>
                </a>

            </li>-->
            <hr>
            <li>
                <a href="../bolsa/principal">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="nav-text">
                        Reclutamiento y Selección
                    </span>
                </a>

            </li>
            <hr>
            <li>
                <a href="../compatibilidad/principal">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <span class="nav-text">
                        Compatiblidad laboral
                    </span>
                </a>

            </li>
            <hr>
            <li>
                <a href="validar" target="_blank">
                    <i class="fa fa-id-card fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Registrar usuario
                    </span>
                </a>

            </li>
            <hr>
        </ul>
                <!--  <ul>
                            <li><a href="#" id="nav-text" data-toggle="modal"
                    data-target="#myModal_cargamedicamento">Cargar paciente</a></li>
                    </ul>-->
            </li>

            <?php
                }elseif($admin == 'antonioflores35@yahoo.com.mx') {
                    ?>
            <li class="has-subnav">
                <a href="../cisfa/principal">
                    <i class="fa fa-medkit fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Cisfa
                    </span>
                </a>

            </li>
            <?php

        }
    }
            ?>



        </ul>

        <ul class="logout">
            <li>
                <a href="close_sesion">
                    <i class="fa fa-power-off fa-2x" id="icon-color"></i>
                    <span class="nav-text">
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>