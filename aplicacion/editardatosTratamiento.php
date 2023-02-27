<?php   
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql_d = $conexionCancer->prepare("DELETE from quirurgico where id_paciente = :id_paciente");
        $sql_d->execute(array(
            ':id_paciente'=>$id_paciente
        ));
        $sql_f = $conexionCancer->prepare("DELETE from mastecto_gaglionar where id_paciente = :id_paciente");
        $sql_f->execute(array(
            ':id_paciente'=>$id_paciente
        ));
    
                        $sql_m = $conexionCancer->prepare("INSERT into quirurgico(realizoquirurgico, lateralidad, id_paciente)
                                                                                                values(:realizoquirurgico, :lateralidad, :id_paciente)");
    
                                                                                                        $sql_m->execute(array(
                                                                                                            ':realizoquirurgico'=>$quirurgicoedit,
                                                                                                            ':lateralidad'=>$lateralidadsegundoedit,
                                                                                                            ':id_paciente'=>$id_paciente
                                                                                                        ));
                                                                                            $sql_id = $conexionCancer->prepare("SELECT id_quirurgico from quirurgico where id_paciente = :id_paciente");
                                                                                                        $sql_id->execute(array(
                                                                                                            ':id_paciente'=>$id_paciente
                                                                                                        ));
                                                                                                        $row_id = $sql_id->fetch();
                                                                                                        $ultimoid = $row_id['id_quirurgico'];
                                                                                                            
                                                                    
                                                            foreach($quirurgicotipoedit as $heredoquirurgicoedit) {
                                                                $sql_f = $conexionCancer->prepare("INSERT into quirugicotipo(descripciontipoquirurgico, id_quirurgico) 
                                                                                                        
                                                                values(:descripciontipoquirurgico, :id_quirurgico)");
                                                                                                    
                                                                $sql_f->execute(array(
                                                                    ':descripciontipoquirurgico'=>$heredoquirurgicoedit,
                                                                    ':id_quirurgico'=>$ultimoid
                                                                                                    
                                                                ));
                                                            } 
                                                            $sql = $conexionCancer->prepare("INSERT into mastecto_gaglionar(tipomastecto, fecha_mastecto, tipoganglionar, fechatipogaglionar, id_paciente)
                                                            values(:tipomastecto, :fecha_mastecto, :tipoganglionar, :fechatipogaglionar, :id_paciente)");  
                                                                    $sql->execute(array(
                                                                        ':tipomastecto'=>$mastectomiatipoedit,
                                                                        ':fecha_mastecto'=>$fechatipomastectoedit,
                                                                        ':tipoganglionar'=>$ganglionartipoedit,
                                                                        ':fechatipogaglionar'=>$fechatipoganglioedit,
                                                                        ':id_paciente'=>$id_paciente
                                                                    ));
                                                            $sql = $conexionCancer->prepare("INSERT into reconstruccion(reconstruccion, tiporeconstruccion, fecha, id_quirurgico)
                                                                            values(:reconstruccion, :tiporeconstruccion, :fecha, :id_quirurgico)");
                                                                                $sql->execute(array(
                                                                                    ':reconstruccion'=>$reconstruccionsinoedit,
                                                                                    ':tiporeconstruccion'=>$reconstrucciontipoedit,
                                                                                    ':fecha'=>$fechatiporeconstruccionedit,
                                                                                    ':id_quirurgico'=>$ultimoid
                                                                                ));
                                            if($sql) {
                                                $sql = mysqli_affected_rows($conexionCancer);
                                                echo "<script>swal({
                                                            title: 'Good job!',
                                                            text: 'Datos actualizados exitosamente!',
                                                            icon: 'success',
                                                            timer: 1500,
                                                    showConfirmButton: false
                                                            
                                                    });
                                                    </script>";	
                                                
                                                }else {
                                                    
                                                    echo "<script>swal({
                                                            title: 'Fatal!',
                                                            text: 'Error al actualizar informacion!',
                                                            icon: 'error',
                                                            timer: 1500,
                                                    showConfirmButton: false
                                                            });</script>";
                                                        
                                                    
                                                    }
                                    ?>