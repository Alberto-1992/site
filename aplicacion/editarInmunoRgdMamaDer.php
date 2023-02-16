<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql = $conexionCancer->prepare("UPDATE inmunohistoquimicargd set receptoresestrogenosrgd = :receptoresestrogenosrgd, receptoresprogesteronargd = :receptoresprogesteronargd, ki67rgd = :ki67rgd,
    p53rgd = :p53rgd, triplenegativorgd = :triplenegativorgd, aplicopdlrgd = :aplicopdlrgd, descripcionpdlrgd = :descripcionpdlrgd, oncogenher2rgd = :oncogenher2rgd, fishrgd = :fishrgd where id_paciente = :id_paciente");
            

                                    $sql->execute(array(
                                        ':receptoresestrogenosrgd'=>$receptoresestrogenosrgdedit,
                                        ':receptoresprogesteronargd'=>$receptoresprogesteronargdedit,
                                        ':ki67rgd'=>$ki67rgdedit,
                                        ':p53rgd'=>$p53rgdedit,
                                        ':triplenegativorgd'=>$triplenegativorgdedit,
                                        ':aplicopdlrgd'=>$pdlrealizorgdedit,
                                        ':descripcionpdlrgd'=>$pdlrgdedit,
                                        ':oncogenher2rgd'=>$oncogenrgdedit,
                                        ':fishrgd'=>$fishrgdedit,
                                        ':id_paciente'=>$id_paciente
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