<?php
session_start();

 if (isset($_SESSION['usuarioAdmin'])) {
$usernameSesion = $_SESSION['usuarioAdmin'];
date_default_timezone_set("America/Monterrey");
    require '../conexionCancer.php';
    $id = $_POST['id'];
    $cancer = $_POST['cancer'];
    $nombrepaciente = $_POST['nombrepaciente'];
    $hora = date("Y-m-d h:i:sa");
        
        $sql = $conexionCancer->prepare("UPDATE dato_usuario set abandonopaciente = 1 where id = :id");
            $sql->bindParam(':id',$id, PDO::PARAM_INT);
            $sql->execute();
            
            $sql = $conexionCancer->prepare("INSERT INTO registroeditable(detalleregistro, usuarioedito, fechahoraedito, nombrepaciente) values(:detalleregistro, :usuarioedito, :fechahoraedito, :nombrepaciente)");
                $sql->bindParam(':detalleregistro',$cancer, PDO::PARAM_STR);
                $sql->bindParam(':usuarioedito',$usernameSesion, PDO::PARAM_STR);
                $sql->bindParam(':fechahoraedito',$hora, PDO::PARAM_STR);
                $sql->bindParam(':nombrepaciente',$nombrepaciente, PDO::PARAM_STR);
                    $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Edicion habilitada!',
    icon: 'success',
    
});
</script>";
}else{
    echo "<script>swal({
    title: 'ooho oho proceso fallido!',
    text: 'Error al editar los datos!',
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
        
     $sql = $conexionCancer->prepare("UPDATE dato_usuario set abandonopaciente = 1 where id = :id");
     $sql->bindParam(':id',$id, PDO::PARAM_INT);
     $sql->execute();
            
            $sql = $conexionCancer->prepare("INSERT INTO registroeditable(detalleregistro, usuarioedito, fechahoraedito, nombrepaciente) values(:detalleregistro, :usuarioedito, :fechahoraedito, :nombrepaciente)");
            $sql->bindParam(':detalleregistro',$cancer, PDO::PARAM_STR);
            $sql->bindParam(':usuarioedito',$usernameSesion, PDO::PARAM_STR);
            $sql->bindParam(':fechahoraedito',$hora, PDO::PARAM_STR);
            $sql->bindParam(':nombrepaciente',$nombrepaciente, PDO::PARAM_STR);
                $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Edicion habilitada!',
    icon: 'success',
    
});
</script>";
}else{
    echo "<script>swal({
    title: 'ooho oho proceso fallido!',
    text: 'Error al editar los datos!',
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
        
     $sql = $conexionCancer->prepare("UPDATE dato_usuario set abandonopaciente = 1 where id = :id");
     $sql->bindParam(':id',$id, PDO::PARAM_INT);
     $sql->execute();
            
            $sql = $conexionCancer->prepare("INSERT INTO registroeditable(detalleregistro, usuarioedito, fechahoraedito, nombrepaciente) values(:detalleregistro, :usuarioedito, :fechahoraedito, :nombrepaciente)");
            $sql->bindParam(':detalleregistro',$cancer, PDO::PARAM_STR);
            $sql->bindParam(':usuarioedito',$usernameSesion, PDO::PARAM_STR);
            $sql->bindParam(':fechahoraedito',$hora, PDO::PARAM_STR);
            $sql->bindParam(':nombrepaciente',$nombrepaciente, PDO::PARAM_STR);
                $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Edicion habilitada!',
    icon: 'success',
    
});
</script>";
}else{
    echo "<script>swal({
    title: 'ooho oho proceso fallido!',
    text: 'Error al editar los datos!',
    icon: 'error',
    
});
</script>";
}
}
?>