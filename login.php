<?php session_start();
error_reporting(0);
/*if(isset($_SESSION['usuarioDatos'])) {
    header('location: index');
}
if(isset($_SESSION['usuarioAdmin'])) {
    header('location: index');
}
if(isset($_SESSION['usuarioJefe'])) {
    header('location: index');
}
if(isset($_SESSION['usuarioMedico'])) {
    header('location: index');
}
if(isset($_SESSION['rh'])) {
    header('location: indexRh');
}
if(isset($_SESSION['controlados'])) {
    header('location: indexControlados');
}
*/
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $correo = $_POST['usuario'];
    $password = $_POST['password'];
    $password = hash('sha512', $password);
    

// Caracteres prohibidos porque en algunos sistemas operativos no son admitidos como nombre de fichero
$forbidden_chars = array(
    "?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&",
    "$", "#", "*", "(", ")" , "|", "~", "`", "!", "{", "}", "%", "+" , chr(0));

// Caracteres que queremos reemplazar por otros que hacen el texto igualmente legible
$replace_chars = array(
    'áéíóúäëïöüàèìòùñ ',
    'aeiouaeiouaeioun_'
);

// Convertimos el texto a analizar a minúsculas
$correo = strtolower($correo);

//Comprobamos cada carácterIdit1611

for( $i=0 ; $i < strlen($correo) ; $i++ ) {
  $sane_char = $source_char = $correo[$i];
  if ( in_array( $source_char, $forbidden_chars ) ) {
    $sane_char = "_";
    $sane .= $sane_char;
    continue;
  }
  $pos = strpos( $replace_chars[0], $source_char);
  if ( $pos !== false ) {
    $sane_char = $replace_chars[1][$pos];
    $sane .= $sane_char;
    continue;
  }
  if ( ord($source_char) < 32 || ord($source_char) > 128 ) {
    //Todos los caracteres codificados por debajo de 32 o encima de 128 son especiales
    $sane_char = "_";
    $sane .= $sane_char;
    continue;
  }
  // Si ha pasado todos los controles, aceptamos el carácter
  $correosanitizado .= $sane_char;
}
    include("../cisfa/conexion.php");

    $statement = $conexion->prepare('SELECT correo, rol, password FROM usuarioslogeo WHERE correo= :correo AND password = :password and rol = :rol and eliminado = :eliminado'
    );
    $statement->execute(array(
        
        ':correo' => $correosanitizado,
        ':password' => $password,
        ':rol'=>7,
        ':eliminado'=>0
    ));

    $resultado = $statement->fetch();
    if ($resultado != false){
        $_SESSION['usuarioDatos'] = $correosanitizado;
        header('location: principal');
    
    
    }else{
    $statement2 = $conexion->prepare('SELECT correo, rol, password FROM usuarioslogeo WHERE correo= :usuario and password = :password and rol = 9 and eliminado = 0');
    $statement2->execute(array(
        
        ':usuario' => $correosanitizado,
        ':password' => $password
    ));
    $resultado2 = $statement2->fetch();
    
        if ($resultado2 != false){
        $_SESSION['usuarioMedico'] = $correosanitizado;
        
        header('location: principal');
    
    
    }else{
        $statement3 = $conexion->prepare('SELECT correo_electronico, clave_acceso, rol_acceso from login where correo_electronico = :usuario  AND clave_acceso = :password and rol_acceso = 2');
        $statement3->execute(array(
            
            ':usuario' => $correo,
            ':password' => $password
        ));
        $resultado3 = $statement3->fetch();
        
            if ($resultado3 != false){
            $_SESSION['residentes'] = $correo;
        header('location: principal');
        /*
    }else{
        $statement4 = $conexion->prepare('SELECT correo_electronico, clave_acceso, rol_acceso from login where correo_electronico = :usuario  AND clave_acceso = :password and rol_acceso = 4');
        $statement4->execute(array(
            
            ':usuario' => $correo,
            ':password' => $password
        ));
        $resultado4 = $statement4->fetch();
        
            if ($resultado4 != false){
            $_SESSION['controlados'] = $correo;
        header('location: controlados');
            */
    }else{
        $statement4 = $conexion->prepare('SELECT correo, rol, password FROM usuarioslogeojefes WHERE correo= :correo AND password = :password and rol = :rol and eliminado = :eliminado');
        $statement4->execute(array(
            
            ':correo' => $correosanitizado,
            ':password' => $password,
            ':rol'=>4,
            ':eliminado'=>0
        ));
        $resultado4 = $statement4->fetch();
        
            if ($resultado4 != false){
            $_SESSION['usuarioJefe'] = $correosanitizado;
        header('location: principal');
            
            
    }else{
        $statement4 = $conexion->prepare('SELECT correo_electronico, clave_acceso, rol_acceso from login where correo_electronico = :correo_electronico  AND clave_acceso = :clave_acceso and rol_acceso = :rol_acceso');

        $statement4->execute(array(
            
            ':correo_electronico' => $correosanitizado,
            ':clave_acceso' => $password,
            ':rol_acceso'=>5
        ));
    
        $resultado4 = $statement4->fetch();
        
            if ($resultado4 != false){
            $_SESSION['usuarioAdmin'] = $correosanitizado;
        header('location: principal');
            
    }else{
        
    
    }
    
        echo "<script>alert('Error de usuario o contraseña');</script>";
                    }
                }
        }
    }   
}
    /* }
    }
}
}*/
require 'frontend/login-vista.html';

?>