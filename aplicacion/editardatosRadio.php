<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);
$sql_r = $conexionCancer->prepare("UPDATE radioterapia SET aplicoradio = :aplicoradio where id_paciente = :id_paciente");

                                        $sql_r->execute(array(
                                            ':aplicoradio'=>$radioterapiaedit,
                                            ':id_paciente'=>$id_paciente
));
                                            
                                    
                                            $sql_s = $conexionCancer->prepare("SELECT id_radio from radioterapia where id_paciente = :id_paciente");
                            $sql_s->execute(array(
            
                                ':id_paciente' => $id_paciente
                            
                            ));
                            $row = $sql_s->fetch();
                            $id_deradio = $row['id_radio'];
                                    $sql_f = $conexionCancer->prepare("SELECT id_radio from tiporadioterapia where id_radio = :id_radio");
                                        $sql_f->execute(array(
                                            ':id_radio'=>$id_deradio
                                        ));
                                        $row_f = $sql_f->fetch();
                                            $validaidradio = $row_f['id_radio'];
                                            if($validaidradio != ''){
                                            $sql = $conexionCancer->prepare("UPDATE tiporadioterapia SET decripcionradio = :decripcionradio, fecharadio = :fecharadio, numerodesesiones = :numerodesesiones WHERE id_radio = :id_radio");
                                                
                                                        $sql->execute(array(
                                                            ':decripcionradio'=>$aplicoradioterapiaedit,
                                                            ':fecharadio'=>$fechainicioradioedit,
                                                            ':numerodesesiones'=>$numerosesionesedit,
                                                            ':id_radio'=>$id_deradio
                                                        ));
                                                    
                                                            if($sql || $sql_s || $sql_f) {

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
                                                                }else{
                                                                $sql = $conexionCancer->prepare("INSERT into tiporadioterapia(decripcionradio, fecharadio, numerodesesiones, id_radio)
                                                                    values(:decripcionradio, :fecharadio, :numerodesesiones, :id_radio)");
                                                                            $sql->execute(array(
                                                                                ':decripcionradio'=>$aplicoradioterapiaedit,
                                                                                ':fecharadio'=>$fechainicioradioedit,
                                                                                ':numerodesesiones'=>$numerosesionesedit,
                                                                                ':id_radio'=>$id_deradio
                                                                            ));

                                                                            if($sql || $sql_s || $sql_f) {

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

                                                                }
                                                    ?>