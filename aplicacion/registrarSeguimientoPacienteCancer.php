<?php
include("../conexionCancer.php");

    extract($_POST);


        $sql = $conexionCancer->prepare("INSERT INTO seguimientocancer(calidadvidaecog, progresionenfermedad, fechadxprogresion, recurrenciaenfermedad, fecharecurrencia, ameritareintervencion, fechareintervencion, lateralidad, ameritanuevaqt, fechanuevaqt, tiponuevaqt, tratamientoqt, ameritaradioterapia,
        tiporadioterapia, fechainicioradio, numerosesiones, ameritabraquiterapia, fechainiciobraquiterapia, cuidadospaliativos, tipocuidadopaliativo, protocoloclinico, protocoloinvestigacion, id_paciente) values(:calidadvidaecog, :progresionenfermedad, :fechadxprogresion, :recurrenciaenfermedad, :fecharecurrencia, :ameritareintervencion, :fechareintervencion, :lateralidad, :ameritanuevaqt, :fechanuevaqt, :tiponuevaqt, :tratamientoqt, :ameritaradioterapia,
        :tiporadioterapia, :fechainicioradio, :numerosesiones, :ameritabraquiterapia, :fechainiciobraquiterapia, :cuidadospaliativos, :tipocuidadopaliativo, :protocoloclinico, :protocoloinvestigacion, :id_paciente)");
        
                $sql->execute(array(
                    ':calidadvidaecog'=>$calidadvidaecog,
                    ':progresionenfermedad'=>$progresionenfermedad,
                    ':fechadxprogresion'=>$fechadxprogresion,
                    ':recurrenciaenfermedad'=>$recurrencianenfermedad,
                    ':fecharecurrencia'=>$fecharecurrencia,
                    ':ameritareintervencion'=>$ameritareintervencion,
                    ':fechareintervencion'=>$fechareintenvencion,
                    ':lateralidad'=>$lateralidadreintervencion,
                    ':ameritanuevaqt'=>$ameritanuevaqt,
                    ':fechanuevaqt'=>$fechanuevaqt,
                    ':tiponuevaqt'=>$tipoqt,
                    ':tratamientoqt'=>$tratameintoqt,
                    ':ameritaradioterapia'=>$ameritaradioterapia,
                    ':tiporadioterapia'=>$tipoderadioterapia,
                    ':fechainicioradio'=>$fechadeinicioradio,
                    ':numerosesiones'=>$numerodesesiones,
                    ':ameritabraquiterapia'=>$ameritabraquiterapia,
                    ':fechainiciobraquiterapia'=>$fechabraquiterapia,
                    ':cuidadospaliativos'=>$cuidadospaliativos,
                    ':tipocuidadopaliativo'=>$clinicapaliativa,
                    ':protocoloclinico'=>$protocoloclinico,
                    ':protocoloinvestigacion'=>$protocoloinvestigacion,
                    ':id_paciente'=>$curps
                ));
                    
                    if($sql != false) {
					echo "<script>swal({
                                title: 'Good job!',
                                text: 'Seguimiento actualizado!',
                                icon: 'success',
                        });</script>";	
                     
					  }else {
                        
                        echo "<script>swal({
                                title: 'Fatal!',
                                text: 'Error al actualizar seguimiento!',
                                icon: 'error',
                                });</script>"; 
					    }

?>