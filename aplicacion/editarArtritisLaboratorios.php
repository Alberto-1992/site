<?php
include("../conexionCancer.php");
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);	

    $sql = $conexionCancer->prepare("UPDATE laboratoriosartritis SET plaquetas = :plaquetas,frbasal = :frbasal,frnominal = :frnominal,pcr = :pcr,vitaminadbasal = :vitaminadbasal,vitaminadnominal = :vitaminadnominal,anticppbasal = :anticppbasal,anticppnominal = :anticppnominal,vsg = :vsg,
    tgobasal = :tgobasal,tgonominal = :tgonominal,tgpbasal = :tgpbasal,tgpnominal = :tgpnominal,glucosa = :glucosa,colesterol = :colesterol,trigliceridos = :trigliceridos,fib4 = :fib4,resultadofib4 = :resultadofib4 WHERE id_paciente = :id_paciente");
                $sql->execute(array(
                    ':plaquetas'=>$plaquetasedit,
                    ':frbasal'=>$frbasaledit,
                    ':frnominal'=>$frnominaledit,
                    ':pcr'=>$pcredit,
                    ':vitaminadbasal'=>$vitaminaDBasaledit,
                    ':vitaminadnominal'=>$vitaminaDNominaledit,
                    ':anticppbasal'=>$anticppbasaledit,
                    ':anticppnominal'=>$anticppnominaledit,
                    ':vsg'=>$vsgedit,
                    ':tgobasal'=>$tgobasaledit,
                    ':tgonominal'=>$tgonominaledit,
                    ':tgpbasal'=>$tgpbasaledit,
                    ':tgpnominal'=>$tgpnominaledit,
                    ':glucosa'=>$glucosaedit,
                    ':colesterol'=>$colesteroledit,
                    ':trigliceridos'=>$trigliceridosedit,
                    ':fib4'=>$fib4edit,
                    ':resultadofib4'=>$resultadofibedit,
                    ':id_paciente'=>$id_paciente
                ));
    if($sql != false) {
        echo "<script>swal({
                    title: 'Good job!',
                    text: 'Datos guardados exitosamente!',
                    icon: 'success',
                    timer: 1500,
showConfirmButton: false
                    
            });
            </script>";	
        
        }else {
            
            echo "<script>swal({
                    title: 'Fatal!',
                    text: 'Error al guardar informacion!',
                    icon: 'error',
                    timer: 1500,
showConfirmButton: false
                    });</script>";
                
            
            }
?>