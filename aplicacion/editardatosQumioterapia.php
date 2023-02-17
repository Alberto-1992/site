<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql = $conexionCancer->prepare("UPDATE quimioterapia SET aplicoquimio=:aplicoquimio, fechainicio=:fechainicio, primeralinea=:primeralinea, ciclosprimerlineaqt=:ciclosprimerlineaqt, segundalinea=:segundalinea,
    ciclossegundalineaqt=:ciclossegundalineaqt, antraciclinas=:antraciclinas, momentodelaqt=:momentodelaqt, her2=:her2, esquemaher2=:esquemaher2, triplenegativo=:triplenegativo, esquematrilpenegativo=:esquematrilpenegativo,
    hormonosensible=:hormonosensible, esquemahormonosensible=:esquemahormonosensible, tipotratamiento=:tipotratamiento, completoquimio=:completoquimio, causaqtincompleta=:causaqtincompleta, fechaeventoadverso=:fechaeventoadverso,
    fechaprogresion=:fechaprogresion, fecharecurrencia=:fecharecurrencia, fechafallecio=:fechafallecio, causafallecio=:causafallecio, especifique=:especifique WHERE id_paciente = :id_paciente"); 
    
                                        $sql->execute(array(
                                            ':aplicoquimio'=>$aplicoquimioedit,
                                            ':fechainicio'=>$fechadeinicioquimioedit,
                                            ':primeralinea'=>$primerlineaedit,
                                            ':ciclosprimerlineaqt'=>$ciclosprimerlineaqtedit,
                                            ':segundalinea'=>$segundalineaedit,
                                            ':ciclossegundalineaqt'=>$ciclossegundalineaqtedit,
                                            ':antraciclinas'=>$antraciclinasedit,
                                            ':momentodelaqt'=>$momentoquimioedit,
                                            ':her2'=>$heredit,
                                            ':esquemaher2'=>$esquemaherdosedit,
                                            ':triplenegativo'=>$triplenegativoedit,
                                            ':esquematrilpenegativo'=>$esquematripleedit,
                                            ':hormonosensible'=>$hormonosensiblesedit,
                                            ':esquemahormonosensible'=>$esquemahormonosensibleedit,
                                            ':tipotratamiento'=>$tipotratamientoedit,
                                            ':completoquimio'=>$completoquimioedit,
                                            ':causaqtincompleta'=>$quimioesquemaedit,
                                            ':fechaeventoadverso'=>$fechaeventoadversoedit,
                                            ':fechaprogresion'=>$fechaprogresionedit,
                                            ':fecharecurrencia'=>$fecharecurrenciaedit,
                                            ':fechafallecio'=>$fechadefuncionedit,
                                            ':causafallecio'=>$otracausaedit,
                                            ':especifique'=>$especifiquecausaedit,
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
