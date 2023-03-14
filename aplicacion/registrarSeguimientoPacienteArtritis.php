<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');

    extract($_POST);
        $sql = $conexionCancer->prepare("INSERT into seguimientoartritis(fechaseguimiento,fechainicioseguiartritis,curpseguiart,tallaseguiart,pesoartsegui,imcseguiart,plaquetasseguiart,frbasalseguiart,frnominalseguiart,pcrseguiart,vitaminadbasalseguiart,
        vitaminadnominalseguiart,anticppbasalseguiart,anticppnominalseguiart,vsgseguiart,tgobasalseguiart,tgonominalseguiart,tgpbasalseguiart,tgpnominalseguiart,glucosaseguiart,colesteroseguiart,trigliceridosseguiart,fib4seguiart,
        resultadofib4seguiart,detalleusghepaticoseguiart,hallazgousgseguiart,clasificacionesteatosisseguiart,articulacionesinflamadassjc28seguiart,articulacionesdolorosastjc28seguiart,evglobalpgaseguiart,evegaseguiart,resultadocdaiseguiart,
        resultadosdaiseguiart,metrotexateseguiart,dosissemanalmetroseguiart,leflunomideseguiart,dosissemanalfemuaseguiart,sulfazalasinaseguiart,dosissemanalsulfaseguiart,tecoferolseguiart,dosissemanaltecoseguiart,glucocorticoideseguiart,
        usghepaticoseguiart,dosissemanaltrataseguiart,vitaminadseguiart,dosissemanalvitadseguiart,biologicoseguiart,tratamientobiologicoseguiart,apegotratamientoseguiart,id_paciente)

            values(:fechaseguimiento,:fechainicioseguiartritis,:curpseguiart,:tallaseguiart,:pesoartsegui,:imcseguiart,:plaquetasseguiart,:frbasalseguiart,:frnominalseguiart,:pcrseguiart,:vitaminadbasalseguiart,
        :vitaminadnominalseguiart,:anticppbasalseguiart,:anticppnominalseguiart,:vsgseguiart,:tgobasalseguiart,:tgonominalseguiart,:tgpbasalseguiart,:tgpnominalseguiart,:glucosaseguiart,:colesteroseguiart,:trigliceridosseguiart,:fib4seguiart,
        :resultadofib4seguiart,:detalleusghepaticoseguiart,:hallazgousgseguiart,:clasificacionesteatosisseguiart,:articulacionesinflamadassjc28seguiart,:articulacionesdolorosastjc28seguiart,:evglobalpgaseguiart,:evegaseguiart,:resultadocdaiseguiart,
        :resultadosdaiseguiart,:metrotexateseguiart,:dosissemanalmetroseguiart,:leflunomideseguiart,:dosissemanalfemuaseguiart,:sulfazalasinaseguiart,:dosissemanalsulfaseguiart,:tecoferolseguiart,:dosissemanaltecoseguiart,:glucocorticoideseguiart,
        :usghepaticoseguiart,:dosissemanaltrataseguiart,:vitaminadseguiart,:dosissemanalvitadseguiart,:biologicoseguiart,:tratamientobiologicoseguiart,:apegotratamientoseguiart,:id_paciente)");

            $sql->execute(array(
                ':fechaseguimiento'=>$fechaseguimientoart,
                ':fechainicioseguiartritis'=>$fechahoy,
                ':curpseguiart'=>$curpseguiart,
                ':tallaseguiart'=>$tallaseguiart,
                ':pesoartsegui'=>$pesoseguiart,
                ':imcseguiart'=>$imcsegui,
                ':plaquetasseguiart'=>$plaquetassegui,
                ':frbasalseguiart'=>$frbasalsegui,
                ':frnominalseguiart'=>$frnominalsegui,
                ':pcrseguiart'=>$pcrsegui,
                ':vitaminadbasalseguiart'=>$vitaminaDBasalsegui,
                ':vitaminadnominalseguiart'=>$vitaminaDNominalsegui,
                ':anticppbasalseguiart'=>$anticppbasalsegui,
                ':anticppnominalseguiart'=>$anticppnominalsegui,
                ':vsgseguiart'=>$vsgsegui,
                ':tgobasalseguiart'=>$tgobasalsegui,
                ':tgonominalseguiart'=>$tgonominal,
                ':tgpbasalseguiart'=>$tgpbasalsegui,
                ':tgpnominalseguiart'=>$tgpnominalsegui,
                ':glucosaseguiart'=>$glucosasegui,
                ':colesteroseguiart'=>$colesterolsegui,
                ':trigliceridosseguiart'=>$trigliceridossegui,
                ':fib4seguiart'=>$fibsegui,
                ':resultadofib4seguiart'=>$resultadofib4segui,
                ':detalleusghepaticoseguiart'=>$usghepaticosegui,
                ':hallazgousgseguiart'=>$hallazgousgsegui,
                ':clasificacionesteatosisseguiart'=>$clasificacionesteatosissegui,
                ':articulacionesinflamadassjc28seguiart'=>$articulacionesInflamadasSJC28segui,
                ':articulacionesdolorosastjc28seguiart'=>$articulacionesDolorosasTJC28segui,
                ':evglobalpgaseguiart'=>$evglobalpgasegui,
                ':evegaseguiart'=>$evegasegui,
                ':resultadocdaiseguiart'=>$resultadocdaisegui,
                ':resultadosdaiseguiart'=>$resultadosdaisegui,
                ':metrotexateseguiart'=>$metrotexatesegui,
                ':dosissemanalmetroseguiart'=>$dosisSemanalmetrosegui,
                ':leflunomideseguiart'=>$leflunomidesegui,
                ':dosissemanalfemuaseguiart'=>$dosisSemanalfemuasegui,
                ':sulfazalasinaseguiart'=>$sulfazalasinasegui,
                ':dosissemanalsulfaseguiart'=>$dosisSemanalsulfasegui,
                ':tecoferolseguiart'=>$tecoferolsegui,
                ':dosissemanaltecoseguiart'=>$dosisSemanaltecosegui,
                ':glucocorticoideseguiart'=>$glucocorticoidesegui,
                ':usghepaticoseguiart'=>$tratamientoglucosegui,
                ':dosissemanaltrataseguiart'=>$dosisSemanaltratasegui,
                ':vitaminadseguiart'=>$vitaminaDsegui,
                ':dosissemanalvitadseguiart'=>$dosisSemanalvitadsegui,
                ':biologicoseguiart'=>$biologicosegui,
                ':tratamientobiologicoseguiart'=>$tratamientobiologicosegui,
                ':apegotratamientoseguiart'=>$apegotratamientosegui,
                ':id_paciente'=>$seguiart

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