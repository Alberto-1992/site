<?php
session_start();
$id = $_POST['id'];
require '../conexionCancer.php';
$sql_t = $conexionCancer->prepare("SELECT cancerpaciente.id_paciente, artritispaciente.id_paciente as id_artritis, dato_usuario.id as id_eliminar FROM cancerpaciente LEFT OUTER join artritispaciente on artritispaciente.id_paciente = cancerpaciente.id_paciente left OUTER join dato_usuario on dato_usuario.id = cancerpaciente.id_paciente where dato_usuario.id = $id");
$sql_t->execute();
$resultado = $sql_t->fetch();
$validacion = $resultado['id_artritis'];
if($validacion == $id){
    echo "<script>swal({
        title: 'ooho oho proceso fallido!',
        text: 'Error al eliminar los datos!',
        icon: 'error',
        
    });
    </script>";
}else if($validacion != $id){
 if (isset($_SESSION['usuarioAdmin'])) {
$usernameSesion = $_SESSION['usuarioAdmin'];
date_default_timezone_set("America/Monterrey");
    $id = $_POST['id'];
    $cancer = $_POST['cancer'];
    $nombrepaciente = $_POST['nombrepaciente'];
    $hora = date("Y-m-d h:i:sa");
        
    /*$sql = $conexion2->query("SELECT curp from dato_usuario where id = $id");
                $row = mysqli_fetch_assoc($sql);
                $curpusuario = $row['curp'];*/

        $sql = $conexionCancer->prepare("DELETE from dato_usuario where id = :id");
            $sql->bindParam(':id',$id, PDO::PARAM_INT);
            $sql->execute();

            /*$sql = $conexionCancer->prepare("DELETE from quirurgico where curpusuario = :curpusuario");
            $sql->bindParam(':curpusuario',$curpusuario, PDO::PARAM_STR);
            $sql->execute();*/
            

            
            $sql = $conexionCancer->prepare("INSERT INTO registroeliminado(detalleregistro, usuarioelimino, fechahoraelimino, nombrepaciente) values(:detalleregistro, :usuarioelimino, :fechahoraelimino, :nombrepaciente)");
                $sql->bindParam(':detalleregistro',$cancer, PDO::PARAM_STR);
                $sql->bindParam(':usuarioelimino',$usernameSesion, PDO::PARAM_STR);
                $sql->bindParam(':fechahoraelimino',$hora, PDO::PARAM_STR);
                $sql->bindParam(':nombrepaciente',$nombrepaciente, PDO::PARAM_STR);
                    $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Datos eliminados!',
    icon: 'success',
    
});
</script>";
}else{
    echo "<script>swal({
    title: 'ooho oho proceso fallido!',
    text: 'Error al eliminar los datos!',
    icon: 'error',
    
});
</script>";
}
}else if(isset($_SESSION['usuarioMedico'])) {
    $usernameSesion = $_SESSION['usuarioMedico'];
    date_default_timezone_set("America/Monterrey");
    require '../conexionCancer.php';
    $id = $_POST['id'];
    $cancer = $_POST['cancer'];
    $nombrepaciente = $_POST['nombrepaciente'];
     $hora = date("Y-m-d h:i:sa");
        
    /* $sql = $conexion2->query("SELECT curp from dato_usuario where id = $id");
                $row = mysqli_fetch_assoc($sql);
                $curpusuario = $row['curp'];*/

        $sql = $conexionCancer->prepare("DELETE from dato_usuario where id = :id");
            $sql->bindParam(':id',$id, PDO::PARAM_INT);
            $sql->execute();

           /* $sql = $conexionCancer->prepare("DELETE from quirurgico where curpusuario = :curpusuario");
            $sql->bindParam(':curpusuario',$curpusuario, PDO::PARAM_STR);
            $sql->execute();*/
            
            $sql = $conexionCancer->prepare("INSERT INTO registroeliminado(detalleregistro, usuarioelimino, fechahoraelimino, nombrepaciente) values(:detalleregistro, :usuarioelimino, :fechahoraelimino, :nombrepaciente)");
                $sql->bindParam(':detalleregistro',$cancer, PDO::PARAM_STR);
                $sql->bindParam(':usuarioelimino',$usernameSesion, PDO::PARAM_STR);
                $sql->bindParam(':fechahoraelimino',$hora, PDO::PARAM_STR);
                $sql->bindParam(':nombrepaciente',$nombrepaciente, PDO::PARAM_STR);
                    $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Datos eliminados!',
    icon: 'success',
    
});
</script>";
}else{
    echo "<script>swal({
    title: 'ooho oho proceso fallido!',
    text: 'Error al eliminar los datos!',
    icon: 'error',
    
});
</script>";
}
}else if(isset($_SESSION['residentes'])) {
    $usernameSesion = $_SESSION['residentes'];
    date_default_timezone_set("America/Monterrey");
    require '../conexionCancer.php';
    $id = $_POST['id'];
    $cancer = $_POST['cancer'];
    $nombrepaciente = $_POST['nombrepaciente'];
     $hora = date("Y-m-d h:i:sa");
        
    /* $sql = $conexion2->query("SELECT curp from dato_usuario where id = $id");
                $row = mysqli_fetch_assoc($sql);
                $curpusuario = $row['curp'];*/

        $sql = $conexionCancer->prepare("DELETE from dato_usuario where id = :id");
            $sql->bindParam(':id',$id, PDO::PARAM_INT);
            $sql->execute();

           /* $sql = $conexionCancer->prepare("DELETE from quirurgico where curpusuario = :curpusuario");
            $sql->bindParam(':curpusuario',$curpusuario, PDO::PARAM_STR);
            $sql->execute();*/
            
            $sql = $conexionCancer->prepare("INSERT INTO registroeliminado(detalleregistro, usuarioelimino, fechahoraelimino, nombrepaciente) values(:detalleregistro, :usuarioelimino, :fechahoraelimino, :nombrepaciente)");
                $sql->bindParam(':detalleregistro',$cancer, PDO::PARAM_STR);
                $sql->bindParam(':usuarioelimino',$usernameSesion, PDO::PARAM_STR);
                $sql->bindParam(':fechahoraelimino',$hora, PDO::PARAM_STR);
                $sql->bindParam(':nombrepaciente',$nombrepaciente, PDO::PARAM_STR);
                    $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Datos eliminados!',
    icon: 'success',
    
});
</script>";
}else{
    echo "<script>swal({
    title: 'ooho oho proceso fallido!',
    text: 'Error al eliminar los datos!',
    icon: 'error',
    
});
</script>";
}
}
}
?>