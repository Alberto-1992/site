<?php session_start();
    if(isset($_SESSION['usuarioDatos'])){
        $usernameSesion = $_SESSION['usuarioDatos'];
        $id = $_GET['id'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeo WHERE correo= :correo AND rol = :rol");
                    $statement->execute(array(
                        ':correo' => $usernameSesion,
                        ':rol'=>7
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                        $_SESSION['usuarioDatos'] = $usernameSesion;
                            require 'frontend/principalInfarto.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');window.history.back();
                        </script>;";
                    }
    }else if(isset($_SESSION['usuarioAdmin'])){
        $usernameSesion = $_SESSION['usuarioAdmin'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo_electronico, nombre_trabajador, rol_acceso FROM login WHERE correo_electronico= :correo_electronico AND rol_acceso = :rol_acceso");
                $statement->execute(array(
                        ':correo_electronico' => $usernameSesion,
                        ':rol_acceso'=>5
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                        $_SESSION['usuarioAdmin'] = $usernameSesion;
                            require 'frontend/principalInfarto.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');window.history.back();
                        </script>;";
                    }
    }else if(isset($_SESSION['usuarioJefe'])){
        $usernameSesion = $_SESSION['usuarioJefe'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeojefes WHERE correo= :correo and rol = :rol and eliminado = :eliminado");
                $statement->execute(array(
                        ':correo' => $usernameSesion,
                        ':rol'=>4,
                        ':eliminado'=>0
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                        $_SESSION['usuarioJefe'] = $usernameSesion;
                            require 'frontend/principalInfarto.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');window.history.back();
                        </script>;";
                    }
    }else if(isset($_SESSION['usuarioMedico'])){
        $usernameSesion = $_SESSION['usuarioMedico'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeo WHERE correo= :correo and rol = :rol and eliminado = :eliminado");
                $statement->execute(array(
                        ':correo' => $usernameSesion,
                        ':rol'=>9,
                        ':eliminado'=>0
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                        $_SESSION['usuarioMedico'] = $usernameSesion;
                            require 'frontend/principalInfarto.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');window.history.back();
                        </script>;";
                    }
                }else if(isset($_SESSION['residentes'])){
                    $usernameSesion = $_SESSION['residentes'];
                        require '../cisfa/conexion.php';
                        $statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeo WHERE correo= :correo and rol = :rol and eliminado = :eliminado");
                            $statement->execute(array(
                                    ':correo' => $usernameSesion,
                                    ':rol'=>0,
                                    ':eliminado'=>0
                                ));
                                $rw = $statement->fetch();
                                if($rw != false){
                                    $_SESSION['usuarioMedico'] = $usernameSesion;
                                        require 'frontend/principalInfarto.php';
                                }else{
                                    echo "<script>alert('No tienes acceso a este apartado');window.history.back();
                                    </script>;";
                                }
    }else{
        header ('location: index');
    }
        
?>