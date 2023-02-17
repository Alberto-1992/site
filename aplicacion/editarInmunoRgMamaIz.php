<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);
$sql = $conexionCancer->prepare("UPDATE inmunohistoquimicargiz SET receptoresestrogenosrgiz=:receptoresestrogenosrgiz, receptoresprogesteronargiz=:receptoresprogesteronargiz, ki67rgiz=:ki67rgiz, p53rgiz=:p53rgiz, triplenegativorgiz=:triplenegativorgiz,
                                        aplicopdlrgiz=:aplicopdlrgiz, descripcionpdlrgiz=:descripcionpdlrgiz, oncogenher2rgiz=:oncogenher2rgiz, fishrgiz=:fishrgiz WHERE id_paciente = :id_paciente");
                                                        
    
                                                            $sql->execute(array(
                                                                ':receptoresestrogenosrgiz'=>$receptoresestrogenosizrgiedit,
                                                                ':receptoresprogesteronargiz'=>$receptoresprogesteronaizrgiedit,
                                                                ':ki67rgiz'=>$ki67izrgiedit,
                                                                ':p53rgiz'=>$p53izrgiedit,
                                                                ':triplenegativorgiz'=>$triplenegativoizrgiedit,
                                                                ':aplicopdlrgiz'=>$pdlrealizoizrgiedit,
                                                                ':descripcionpdlrgiz'=>$pdlizrgiedit,
                                                                ':oncogenher2rgiz'=>$oncogenizrgiedit,
                                                                ':fishrgiz'=>$fishizrgiedit,
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