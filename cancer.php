<?php session_start();
     if(isset($_SESSION['usuarioAdmin'])){
        $usernameSesion = $_SESSION['usuarioAdmin'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo_electronico, nombre_trabajador, rol_acceso FROM login WHERE correo_electronico= '$usernameSesion' AND rol_acceso = 5");
                 $statement->execute(array(
                        ':correo_electronico' => $usernameSesion
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                         //$_SESSION['usuarioAdmin'] = $usernameSesion;
                            require 'frontend/cancer.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');
                        </script>;";
                         require 'close_sesion.php';
                    }
    }else if(isset($_SESSION['usuarioJefe'])){
        $usernameSesion = $_SESSION['usuarioJefe'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo, rol, password FROM usuarioslogeojefes WHERE correo= '$usernameSesion' and rol = 4 and eliminado = 0");
                 $statement->execute(array(
                        ':correo' => $usernameSesion
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                         //$_SESSION['usuarioJefe'] = $usernameSesion;
                            require 'frontend/cancer.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');
                        </script>;";
                         require 'close_sesion.php';
                    }
                }else if(isset($_SESSION['residentes'])){
                    $usernameSesion = $_SESSION['residentes'];
            require '../cisfa/conexion.php';
			$statement = $conexion->prepare("SELECT correo_electronico, nombre_trabajador, rol_acceso FROM login WHERE correo_electronico= :correo_electronico AND rol_acceso = :rol_acceso");
                $statement->execute(array(
                        ':correo_electronico' => $usernameSesion,
                        ':rol_acceso'=>0
                    ));
                    $rw = $statement->fetch();
                    if($rw != false){
                        $_SESSION['residentes'] = $usernameSesion;
                            require 'frontend/cancer.php';
                    }else{
                        echo "<script>alert('No tienes acceso a este apartado');window.history.back();
                        </script>;";
                                }
    
  
    }else{
         header ('location: index');
    }
        
?>