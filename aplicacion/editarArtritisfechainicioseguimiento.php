<?php
session_start();
 if (isset($_SESSION['usuarioAdmin'])) {
$usernameSesion = $_SESSION['usuarioAdmin'];
date_default_timezone_set("America/Monterrey");
    require '../conexionCancer.php';
    extract($_POST);
        
        $sql = $conexionCancer->prepare("UPDATE seguimientoartritis set fechaseguimiento = :fechaseguimiento where id_seguimientoartritis = :id_seguimientoartritis");
            $sql->bindParam(':id_seguimientoartritis',$id_seguimientoartritis, PDO::PARAM_INT);
            $sql->bindParam(':fechaseguimiento',$fechaeditseguimiento, PDO::PARAM_STR);
            $sql->execute();
            
    
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Edicion bloqueada!',
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
    extract($_POST);
    $sql = $conexionCancer->prepare("UPDATE seguimientoartritis set fechaseguimiento = :fechaseguimiento where id_seguimientoartritis = :id_seguimientoartritis");
    $sql->bindParam(':id_seguimientoartritis',$id_seguimientoartritis, PDO::PARAM_INT);
    $sql->bindParam(':fechaseguimiento',$fechaeditseguimiento, PDO::PARAM_STR);
    $sql->execute();
            
        if($sql != false){

echo "<script>swal({
    title: 'Proceso exitoso!',
    text: 'Edicion bloqueada!',
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
}else  if (isset($_SESSION['artritis'])) {
    $usernameSesion = $_SESSION['artritis'];
    date_default_timezone_set("America/Monterrey");
        require '../conexionCancer.php';
        extract($_POST);
        $sql = $conexionCancer->prepare("UPDATE seguimientoartritis set fechaseguimiento = :fechaseguimiento where id_seguimientoartritis = :id_seguimientoartritis");
        $sql->bindParam(':id_seguimientoartritis',$id_seguimientoartritis, PDO::PARAM_INT);
        $sql->bindParam(':fechaseguimiento',$fechaeditseguimiento, PDO::PARAM_STR);
        $sql->execute();
                
            if($sql != false){
    
    echo "<script>swal({
        title: 'Proceso exitoso!',
        text: 'Edicion bloqueada!',
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