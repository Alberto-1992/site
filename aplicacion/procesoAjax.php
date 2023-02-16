<?php 
require '../conexionCancer.php';
date_default_timezone_set('America/Mexico_City');
$hoy = date("d-m-Y");
    extract($_POST);
$id_unico = uniqid();
	//buscamos el email	
$sql = $conexionCancer->prepare("SELECT tipo, lateralidad, curpusuario from quirurgico where curpusuario = :curpusuario and tipo = :tipo and lateralidad = :lateralidad");
    $sql->execute(array(
        ':curpusuario'=>$curp,
        ':tipo'=>$quirurgicotipo,
        ':lateralidad'=>$lateralidadsegundo
    ));
        $row_S = $sql->fetch();
        $validacionQX = $row_S['tipo'];
        $curpvalidacion = $row_S['curpusuario'];
        $lateralidadvalida = $row_S['lateralidad'];
        if($validacionQX != $quirurgicotipo && $curpvalidacion != $curp && $lateralidadvalida != $lateralidadsegundo ){
    $sql = $conexionCancer->prepare("INSERT into quirurgico(realizoquirurgico, lateralidad, tipo, curpusuario)
            values(:realizoquirurgico, :lateralidad, :tipo, :curpusuario)");

            $sql->bindParam(':realizoquirurgico',$quirurgico,PDO::PARAM_STR, 10);
            $sql->bindParam(':lateralidad',$lateralidadsegundo,PDO::PARAM_STR,50);
            $sql->bindParam(':tipo',$quirurgicotipo,PDO::PARAM_STR,25);
            $sql->bindParam(':curpusuario',$curp,PDO::PARAM_STR, 25);
                $sql->execute();
            }else{
                echo "<script>swal({
                    title: 'Error!',
                    text: 'Error proceso duplicado!',
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: false
                    
                });
                </script>";
                return false;
            }
            
            $sql = $conexionCancer->prepare("SELECT id_quirurgico from quirurgico where curpusuario = :curpusuario and tipo = :tipo and lateralidad = :lateralidad");
            $sql->execute(array(
        ':curpusuario'=>$curp,
        ':tipo'=>$quirurgicotipo,
        ':lateralidad'=>$lateralidadsegundo
    ));
        $row = $sql->fetch();
        $id_quiru = $row['id_quirurgico'];
        

            if($quirurgicotipo === 'Mastectomia'){
        

                $sql = $conexionCancer->prepare("INSERT into mastecto(tipomastecto, fecha, id_tipo)
                values(:tipomastecto, :fecha, :id_tipo)");
    
                $sql->bindParam(':tipomastecto',$mastectomiatipo,PDO::PARAM_STR, 50);
                $sql->bindParam(':fecha',$fechatipomastecto,PDO::PARAM_STR);
                $sql->bindParam(':id_tipo',$id_quiru,PDO::PARAM_INT);

        
                        if($sql->execute() !=false){
                        echo "<script>swal({
                            title: 'Dato guardado!',
                            text: 'Informaión guardada!',
                            icon: 'success',
                            timer: 1500,
                    showConfirmButton: false
                            
                        });
                        </script>";
                        $sql = $conexionCancer->prepare("SELECT tipomastecto, id_mastecto from mastecto where id_tipo = :id_tipo");
                        $sql->execute(array(
                    ':id_tipo'=>$id_quiru
                ));
                    $row = $sql->fetch();
                    $tipodemastecto = $row['tipomastecto'];
                    $id_mastec = $row['id_mastecto'];
                                
                        if($mastectomiatipo === $tipodemastecto && $reconstruccionsino === 'Si'){
                            
            
                                $sql = $conexionCancer->prepare("INSERT into reconstruccion(reconstruccion, tiporeconstruccion, fecha, id_mastecto_ganglio)
                                    values(:reconstruccion, :tiporeconstruccion, :fecha, :id_mastecto_ganglio)");
            
                                    $sql->bindParam(':reconstruccion',$reconstruccionsino,PDO::PARAM_STR,10);
                                    $sql->bindParam(':tiporeconstruccion',$reconstrucciontipo,PDO::PARAM_STR,50);
                                    $sql->bindParam(':fecha',$fechatiporeconstruccion,PDO::PARAM_STR);
                                    $sql->bindParam(':id_mastecto_ganglio',$id_mastec,PDO::PARAM_INT);
                                        $sql->execute();
                                
                                
                                }else{
                                    
                                }
                    }else{
                        echo "<script>swal({
                            title: 'Hooho error!',
                            text: 'Error al guardar los datos!',
                            icon: 'error',
                            timer: 1500,
                    showConfirmButton: false
                            
                        });
                        </script>";
                        }
                        return false;
            
                    
                    
}elseif($quirurgicotipo === 'Ganglionar'){
            
            
                    $sql = $conexionCancer->prepare("INSERT into ganglionar(tipoganglionar, fecha, id_tipo)
                    values(:tipoganglionar, :fecha, :id_tipo)");
        
                    $sql->bindParam(':tipoganglionar',$ganglionartipo,PDO::PARAM_STR, 50);
                    $sql->bindParam(':fecha',$fechatipoganglio,PDO::PARAM_STR);
                    $sql->bindParam(':id_tipo',$id_quiru,PDO::PARAM_INT);
    
                    if($sql->execute() !=false){
                        echo "<script>swal({
                            title: 'Dato guardado!',
                            text: 'Informaión guardada!',
                            icon: 'success',
                            timer: 1500,
                    showConfirmButton: false
                            
                        });
                        </script>";
                        $sql = $conexionCancer->prepare("SELECT tipoganglionar, id_ganglionar from ganglionar where id_tipo = :id_tipo");
                        $sql->execute(array(
                    ':id_tipo'=>$id_quiru
                ));
                    $row = $sql->fetch();
                    $tipogangli = $row['tipoganglionar'];
                    $id_ganli = $row['id_ganglionar'];
                                
                        if($ganglionartipo === $tipogangli && $reconstruccionsino === 'Si'){
                            
            
                                $sql = $conexionCancer->prepare("INSERT into reconstruccion(reconstruccion, tiporeconstruccion, fecha, id_mastecto_ganglio)
                                    values(:reconstruccion, :tiporeconstruccion, :fecha, :id_mastecto_ganglio)");
            
                                    $sql->bindParam(':reconstruccion',$reconstruccionsino,PDO::PARAM_STR,10);
                                    $sql->bindParam(':tiporeconstruccion',$reconstrucciontipo,PDO::PARAM_STR,50);
                                    $sql->bindParam(':fecha',$fechatiporeconstruccion,PDO::PARAM_STR);
                                    $sql->bindParam(':id_mastecto_ganglio',$id_ganli,PDO::PARAM_INT);
                                        $sql->execute();
                                
                                
                                }else{
                                    
                                }
                    }else{
                        echo "<script>swal({
                            title: 'Hooho error!',
                            text: 'Error al guardar los datos!',
                            icon: 'error',
                            timer: 1500,
                    showConfirmButton: false
                            
                        });
                        </script>";
                        }
                        return false;
            }
        
        
                
        

                
            
                if($sql->execute() != false ){

        

echo "<script>swal({
    title: 'Good job!',
    text: 'Datos guardados exitosamente!',
    icon: 'success',
    timer: 1500,
                    showConfirmButton: false
    
});
</script>";	
}else{
                    echo "<script>swal({
                        title: 'Error!',
                        text: 'Error al guardar los datos!',
                        icon: 'error',
                        timer: 1500,
                    showConfirmButton: false
                        
                    });
                    </script>";
                
                }
    
            
?>