<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);
		
	//buscamos el email	
    
	$sql_busqueda = $conexionCancer->prepare("SELECT curp, id from dato_usuario where curp = :curp");
	    $sql_busqueda->bindParam(':curp',$curp,PDO::PARAM_STR);
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
        $validaCurp = $validacion['curp'];
        $id_check = $validacion['id'];
        
         $sql = $conexionCancer->prepare("SELECT id_paciente from cancerpaciente where id_paciente = :id_paciente limit 1");
                            $sql->execute(array(
            
                                ':id_paciente' => $id_check
                            
                            ));
                            $row = $sql->fetch();
                            $id_valida = $row['id_paciente'];
    if($id_valida != false){
        echo "<script>swal({
            title: 'Fatal!',
            text: 'Error!! ya existe un paciente con este CURP y registro de cancer!',
            icon: 'error',
            });</script>";
        
    }else{
	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO
        if($validaCurp != $curp){
        
	$sql = $conexionCancer->prepare("INSERT into dato_usuario(curp, nombrecompleto, poblacionindigena, escolaridad, fechanacimiento, edad, sexo, raza, estado, municipio, year) 
    
                                    values (:curp, :nombrecompleto, :poblacionindigena, :escolaridad, :fechanacimiento, :edad, :sexo, :raza, :estado, :municipio, :year)");
                    
                                $sql->bindParam(':curp', $curp, PDO::PARAM_STR, 25);
                                $sql->bindParam(':nombrecompleto',$nombrecompleto, PDO::PARAM_STR, 100);
                                $sql->bindParam(':poblacionindigena',$poblacionindigena, PDO::PARAM_STR, 100);
                                $sql->bindParam(':escolaridad',$escolaridad, PDO::PARAM_STR, 100);
                                $sql->bindParam(':fechanacimiento',$fecha, PDO::PARAM_STR); 
                                $sql->bindParam(':edad',$edad, PDO::PARAM_INT); 
                                $sql->bindParam(':sexo',$sexo, PDO::PARAM_STR, 10); 
                                $sql->bindParam(':raza',$raza, PDO::PARAM_STR, 100); 
                                $sql->bindParam(':estado',$cbx_estado, PDO::PARAM_INT); 
                                $sql->bindParam(':municipio',$cbx_municipio, PDO::PARAM_INT); 
                                $sql->bindParam(':year',$hoy, PDO::PARAM_STR);
                            $sql->execute(); 

                            $sql = $conexionCancer->prepare("SELECT id from dato_usuario where curp = :curp");
                            $sql->execute(array(
            
                                ':curp' => $curp
                            
                            ));
                            $row = $sql->fetch();
                            $id_usuario = $row['id'];
                            
                            $sql = $conexionCancer->prepare("INSERT into unidadreferenciado(referenciado, clues, id_paciente) 
    
                                    values (:referenciado, :clues, :id_paciente)");
                                    
                                $sql->bindParam(':referenciado',$referenciado, PDO::PARAM_STR, 10);
                                $sql->bindParam(':clues',$unidadreferencia, PDO::PARAM_STR, 40);
                                $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                            $sql->execute();

                            $sql = $conexionCancer->prepare("INSERT into signosvitales(talla, peso, imc, id_paciente) 
    
                                    values (:talla, :peso, :imc, :id_paciente)");
                                    
                                $sql->bindParam(':talla',$talla, PDO::PARAM_STR, 10);
                                $sql->bindParam(':peso',$peso, PDO::PARAM_STR, 10);
                                $sql->bindParam(':imc',$imc, PDO::PARAM_STR); 
                                $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                            $sql->execute(); 

                            $sql = $conexionCancer->prepare("INSERT into antecedentesgineco(menarca, ultimamestruacion, cuentacon, gestas, parto, aborto, cesarea, embarazada, fpp, terapiareemplazohormonal, lactancia, tiempolactancia, id_paciente) 
    
                                    values (:menarca, :ultimamestruacion, :cuentacon, :gestas, :parto, :aborto, :cesarea, :embarazada, :fpp, :terapiareemplazohormonal, :lactancia, :tiempolactancia, :id_paciente)");
                    
                                $sql->bindParam(':menarca', $menarca, PDO::PARAM_STR, 100);
                                $sql->bindParam(':ultimamestruacion',$fechaultimamestruacion, PDO::PARAM_STR);
                                $sql->bindParam(':cuentacon',$menopausea, PDO::PARAM_STR, 100);
                                $sql->bindParam(':gestas',$gestas, PDO::PARAM_INT);
                                $sql->bindParam(':parto',$parto, PDO::PARAM_INT); 
                                $sql->bindParam(':aborto',$aborto, PDO::PARAM_INT);
                                $sql->bindParam(':cesarea',$cesarea, PDO::PARAM_INT);
                                $sql->bindParam(':embarazada',$embarazada, PDO::PARAM_STR, 10);
                                $sql->bindParam(':fpp',$fechaprobableparto, PDO::PARAM_STR);
                                $sql->bindParam(':terapiareemplazohormonal',$planificacionfamiliar, PDO::PARAM_STR, 10);
                                $sql->bindParam(':lactancia',$lactancia, PDO::PARAM_STR, 10);
                                $sql->bindParam(':tiempolactancia',$tiempolactancia, PDO::PARAM_STR, 35);
                                $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                            $sql->execute(); 

                            
                            $sql = $conexionCancer->prepare("INSERT INTO cancerpaciente(descripcioncancer, id_paciente)
                                        values(:descripcioncancer, :id_paciente)");
                                        $sql->bindParam(':descripcioncancer',$tipodecancer,PDO::PARAM_STR,20);
                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                    $sql->execute();
                                    
                            $checked_contador = count($check_listapato);
                            //echo "<p>Has seleccionado los siguientes ".$checked_contador." opcione(s):</p> <br/>";
                            // Bucle para almacenar y visualizar valores activados checkbox.
                            foreach($check_listapato as $seleccion) {
                                $sql_s = $conexionCancer->prepare("INSERT into antecedentespatopersonales(descripcionantecedente, id_paciente) 
                
                                            values('".$seleccion."', '".$id_usuario."')");

                                                $sql_s->execute(array(
                                                    ':descripcionantecedente'=>$seleccion,
                                                    ':id_paciente'=>$id_usuario
                                    ));
                            }
                            

                                    $ms_contador = count($mscancer);
                            foreach($mscancer as $heredo) {
                                $sql_s = $conexionCancer->prepare("INSERT into antecedentesfamiliarescancer(datoantecedentefamiliar, id_paciente) 
                
                                values(:datoantecedentefamiliar, :id_paciente)");
            
                                $sql_s->execute(array(
                                    ':datoantecedentefamiliar'=>$heredo,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }
                            $sql = $conexionCancer->prepare("INSERT into atencionclinica(fechaatencioninicial, biradsreferencia, biradshraei, lateralidadmama, estadioclinico, etapaclinica, tamaniotumoral, compromisolenfatico, metastasis, calidadvidaecog, mastectoextrainstituto, lateralidadmastectoextrainstituto, fechamastectoextrainstituto, id_usuario)
                            values(:fechaatencioninicial, :biradsreferencia, :biradshraei, :lateralidadmama, :estadioclinico, :etapaclinica, :tamaniotumoral, :compromisolenfatico, :metastasis, :calidadvidaecog, :mastectoextrainstituto, :lateralidadmastectoextrainstituto, :fechamastectoextrainstituto, :id_usuario)");

                            $sql->bindParam(':fechaatencioninicial',$fechaatencioninicial, PDO::PARAM_STR);
                            $sql->bindParam(':biradsreferencia',$biradsreferencia,PDO::PARAM_STR,100);
                            $sql->bindParam(':biradshraei',$biradshraei,PDO::PARAM_STR,100);
                            $sql->bindParam(':lateralidadmama',$lateralidadprimero,PDO::PARAM_STR,100);
                            $sql->bindParam(':estadioclinico',$estadioclinico,PDO::PARAM_STR,30);
                            $sql->bindParam(':etapaclinica',$etapasclinicas,PDO::PARAM_STR,20);
                            $sql->bindParam(':tamaniotumoral',$tamaniotumoral,PDO::PARAM_STR,100);
                            $sql->bindParam(':compromisolenfatico',$linfaticonodal,PDO::PARAM_STR,150);
                            $sql->bindParam(':metastasis',$metastasis,PDO::PARAM_STR,150);
                            $sql->bindParam(':calidadvidaecog',$calidaddevidaecog,PDO::PARAM_STR,100);
                            $sql->bindParam(':mastectoextrainstituto',$mastectomiaextrainstitucional,PDO::PARAM_STR,10);
                            $sql->bindParam(':lateralidadmastectoextrainstituto',$lateralidadextrainstitucional,PDO::PARAM_STR, 50);
                            $sql->bindParam(':fechamastectoextrainstituto',$fechamastectoextra,PDO::PARAM_STR);
                            $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                        $sql->execute();
                                    
                                    $ms_sitiometa = count($sitiometastasis);
                            foreach($sitiometastasis as $heredositiometa) {
                                $sql_s = $conexionCancer->prepare("INSERT into atencionclinicasitiometastasis(descripcionsitiometastasisi, id_paciente) 
                
                                values(:descripcionsitiometastasisi, :id_paciente)");
            
                                $sql_s->execute(array(
                                    ':descripcionsitiometastasisi'=>$heredositiometa,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }
                                    
                                    $ms_histo = count($mamaseleccion);
                            foreach($mamaseleccion as $heredohistopato) {
                                $sql_s = $conexionCancer->prepare("INSERT into mamahistopatologia(mamahistopato, id_paciente) 
                
                                values(:mamahistopato, :id_paciente)");
            
                                $sql_s->execute(array(
                                    ':mamahistopato'=>$heredohistopato,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }

                            $sql = $conexionCancer->prepare("INSERT into histopatologia(dxhistopatologico, fechadxhistopatologico, nottingham, escalasbr, id_usuario)
                                        values(:dxhistopatologico, :fechadxhistopatologico, :nottingham, :escalasbr, :id_usuario)");

                                        $sql->bindParam(':dxhistopatologico',$dxhistopatologico,PDO::PARAM_STR,50);
                                        $sql->bindParam(':fechadxhistopatologico',$fechadxhistopatologico,PDO::PARAM_STR);
                                        $sql->bindParam(':nottingham',$nottingham,PDO::PARAM_STR,100);
                                        $sql->bindParam(':escalasbr',$escalasbr,PDO::PARAM_STR,150);
                                        $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                                            $sql->execute();
                            
                                            $sql = $conexionCancer->prepare("INSERT into histopatoregionganglioderecha(dxhistopatologicorgd, fechadxhistopatologicorgd, nottinghamrgd, escalasbrrgd, id_paciente)
                                            values(:dxhistopatologicorgd, :fechadxhistopatologicorgd, :nottinghamrgd, :escalasbrrgd, :id_paciente)");
    
                                            $sql->bindParam(':dxhistopatologicorgd',$dxhistopatologicorgd,PDO::PARAM_STR,50);
                                            $sql->bindParam(':fechadxhistopatologicorgd',$fechadxhistopatologicorgd,PDO::PARAM_STR);
                                            $sql->bindParam(':nottinghamrgd',$nottinghamrgd,PDO::PARAM_STR,100);
                                            $sql->bindParam(':escalasbrrgd',$escalasbrrgd,PDO::PARAM_STR,150);
                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                $sql->execute();
                                            
                            $sql = $conexionCancer->prepare("INSERT into histopatologiaizquierda(dxhistopatologicoiz, fechadxhistopatologicoiz, nottinghamiz, escalasbriz, id_paciente)
                                        values(:dxhistopatologicoiz, :fechadxhistopatologicoiz, :nottinghamiz, :escalasbriz, :id_paciente)");

                                        $sql->bindParam(':dxhistopatologicoiz',$dxhistopatologicoiz,PDO::PARAM_STR,50);
                                        $sql->bindParam(':fechadxhistopatologicoiz',$fechadxhistopatologicoiz,PDO::PARAM_STR);
                                        $sql->bindParam(':nottinghamiz',$nottinghamiz,PDO::PARAM_STR,100);
                                        $sql->bindParam(':escalasbriz',$escalasbriz,PDO::PARAM_STR,150);
                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                         $sql->execute();

                                         $sql = $conexionCancer->prepare("INSERT into histopatoregionganglionariz(dxhistopatologicorgi, fechadxhistopatologicorgi, nottinghamrgi, escalasbrrgi, id_paciente)
                                            values(:dxhistopatologicorgi, :fechadxhistopatologicorgi, :nottinghamrgi, :escalasbrrgi, :id_paciente)");
    
                                            $sql->bindParam(':dxhistopatologicorgi',$dxhistopatologicorgi,PDO::PARAM_STR,50);
                                            $sql->bindParam(':fechadxhistopatologicorgi',$fechadxhistopatologicorgi,PDO::PARAM_STR);
                                            $sql->bindParam(':nottinghamrgi',$nottinghamrgi,PDO::PARAM_STR,100);
                                            $sql->bindParam(':escalasbrrgi',$escalasbrrgi,PDO::PARAM_STR,150);
                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                $sql->execute();

                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimica(receptoresestrogenos, receptoresprogesterona, ki67, p53, triplenegativo, aplicopdl, descripcionpdl, oncogenher2, fish, id_usuario)
                                                        values(:receptoresestrogenos, :receptoresprogesterona, :ki67, :p53, :triplenegativo, :aplicopdl, :descripcionpdl, :oncogenher2, :fish, :id_usuario)");

                                                        $sql->bindParam(':receptoresestrogenos',$receptoresestrogenos,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesterona',$receptoresprogesterona,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67',$ki67,PDO::PARAM_STR,100);
                                                        $sql->bindParam(':p53',$p53,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativo',$triplenegativo,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdl',$pdlrealizo,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdl',$pdl,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2',$oncogen,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fish',$fish,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();

                                                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimicargd(receptoresestrogenosrgd, receptoresprogesteronargd, ki67rgd, p53rgd, triplenegativorgd, aplicopdlrgd, descripcionpdlrgd, oncogenher2rgd, fishrgd, id_paciente)
                                                        values(:receptoresestrogenosrgd, :receptoresprogesteronargd, :ki67rgd, :p53rgd, :triplenegativorgd, :aplicopdlrgd, :descripcionpdlrgd, :oncogenher2rgd, :fishrgd, :id_paciente)");

                                                        $sql->bindParam(':receptoresestrogenosrgd',$receptoresestrogenosrgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesteronargd',$receptoresprogesteronargd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67rgd',$ki67rgd,PDO::PARAM_STR,100);                                                
                                                        $sql->bindParam(':p53rgd',$p53rgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativorgd',$triplenegativorgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdlrgd',$pdlrealizorgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdlrgd',$pdlrgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2rgd',$oncogenrgd,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fishrgd',$fishrgd,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();
                                                            
                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimicaiz(receptoresestrogenosiz, receptoresprogesteronaiz, ki67iz, p53iz, triplenegativoiz, aplicopdliz, descripcionpdliz, oncogenher2iz, fishiz, id_usuario)
                                                        values(:receptoresestrogenosiz, :receptoresprogesteronaiz, :ki67iz, :p53iz, :triplenegativoiz, :aplicopdliz, :descripcionpdliz, :oncogenher2iz, :fishiz, :id_usuario)");

                                                        $sql->bindParam(':receptoresestrogenosiz',$receptoresestrogenosiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesteronaiz',$receptoresprogesteronaiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67iz',$ki67iz,PDO::PARAM_STR,100);
                                                    
                                                        $sql->bindParam(':p53iz',$p53iz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativoiz',$triplenegativoiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdliz',$pdlrealizoiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdliz',$pdliz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2iz',$oncogeniz,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fishiz',$fishiz,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();

                                                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimicargiz(receptoresestrogenosrgiz, receptoresprogesteronargiz, ki67rgiz, p53rgiz, triplenegativorgiz, aplicopdlrgiz, descripcionpdlrgiz, oncogenher2rgiz, fishrgiz, id_paciente)
                                                        values(:receptoresestrogenosrgiz, :receptoresprogesteronargiz, :ki67rgiz, :p53rgiz, :triplenegativorgiz, :aplicopdlrgiz, :descripcionpdlrgiz, :oncogenher2rgiz, :fishrgiz, :id_paciente)");

                                                        $sql->bindParam(':receptoresestrogenosrgiz',$receptoresestrogenosizrgi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesteronargiz',$receptoresprogesteronaizrgi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67rgiz',$ki67izrgi,PDO::PARAM_STR,100);
                                                    
                                                        $sql->bindParam(':p53rgiz',$p53izrgi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativorgiz',$triplenegativoizrgi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdlrgiz',$pdlrealizoizrgi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdlrgiz',$pdlizrgi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2rgiz',$oncogenizrgi,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fishrgiz',$fishizrgi,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();

                                            $ms_molecular = count($mamaseleccionmolecular);
                                                            foreach($mamaseleccionmolecular as $heredomolecular) {
                                                                $sql_s = $conexionCancer->prepare("INSERT into mamamolecular(mamaseleccion, id_paciente) 
                                                
                                                                values(:mamaseleccion, :id_paciente)");
                                            
                                                                $sql_s->execute(array(
                                                                    ':mamaseleccion'=>$heredomolecular,
                                                                    ':id_paciente'=>$id_usuario
                                            
                                                                ));
                                                            }           
                                                            
                                                            $sql = $conexionCancer->prepare("INSERT into molecular(luminala, luminalb, enriquecidoher2, basal, id_paciente) values(:luminala, :luminalb, :enriquecidoher2, :basal, :id_paciente)");
                                                            $sql->bindParam(':luminala',$luminala,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':luminalb',$luminalb,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':enriquecidoher2',$enriquecidoherdos,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':basal',$basal,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                $sql->execute();
                                
                                                                                                $sql = $conexionCancer->prepare("INSERT into molecularrgd(luminalargd, luminalbrgd, enriquecidoher2rgd, basalrgd, id_paciente) values(:luminalargd, :luminalbrgd, :enriquecidoher2rgd, :basalrgd, :id_paciente)");
                                                            $sql->bindParam(':luminalargd',$luminalammrgd,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':luminalbrgd',$luminalbmmrgd,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':enriquecidoher2rgd',$enriquecidoherdosmmrgd,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':basalrgd',$basalmmrgd,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                $sql->execute();
                                
                                                            $sql = $conexionCancer->prepare("INSERT into molecularizquierda(luminalaiz, luminalbiz, enriquecidoher2iz, basaliz, id_paciente) values(:luminalaiz, :luminalbiz, :enriquecidoher2iz, :basaliz, :id_paciente)");
                                                                                            $sql->bindParam(':luminalaiz',$luminalaiz,PDO::PARAM_STR,20);
                                                                                            $sql->bindParam(':luminalbiz',$luminalbiz,PDO::PARAM_STR,20);
                                                                                            $sql->bindParam(':enriquecidoher2iz',$enriquecidoherdosiz,PDO::PARAM_STR,20);
                                                                                            $sql->bindParam(':basaliz',$basaliz,PDO::PARAM_STR,20);
                                                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                    $sql->execute();
                                
                                                                                                    $sql = $conexionCancer->prepare("INSERT into molecularrgiz(luminalargiz, luminalbrgiz, enriquecidoher2rgiz, basalrgiz, id_paciente) values(:luminalargiz, :luminalbrgiz, :enriquecidoher2rgiz, :basalrgiz, :id_paciente)");
                                                            $sql->bindParam(':luminalargiz',$luminalaizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':luminalbrgiz',$luminalbizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':enriquecidoher2rgiz',$enriquecidoherdosizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':basalrgiz',$basalizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                $sql->execute();

                            $sql = $conexionCancer->prepare("INSERT into quimioterapia(aplicoquimio, fechainicio, primeralinea, ciclosprimerlineaqt, segundalinea, ciclossegundalineaqt, antraciclinas, momentodelaqt, her2, esquemaher2, triplenegativo, esquematrilpenegativo, hormonosensible, 
                            esquemahormonosensible, tipotratamiento, completoquimio, causaqtincompleta, fechaeventoadverso, fechaprogresion, fecharecurrencia, fechafallecio, causafallecio, especifique, id_paciente) 
                            values(:aplicoquimio, :fechainicio, :primeralinea, :ciclosprimerlineaqt, :segundalinea, :ciclossegundalineaqt, :antraciclinas, :momentodelaqt, :her2, :esquemaher2, :triplenegativo, :esquematrilpenegativo, :hormonosensible, 
                            :esquemahormonosensible, :tipotratamiento, :completoquimio, :causaqtincompleta, :fechaeventoadverso, :fechaprogresion, :fecharecurrencia, :fechafallecio, :causafallecio, :especifique, :id_paciente)");
                                                                $sql->bindParam(':aplicoquimio',$aplicoquimio,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':fechainicio',$fechadeinicioquimio,PDO::PARAM_STR);
                                                                $sql->bindParam(':primeralinea',$primerlinea,PDO::PARAM_STR, 10);
                                                                $sql->bindParam(':ciclosprimerlineaqt',$ciclosprimerlineaqt,PDO::PARAM_INT);
                                                                $sql->bindParam(':segundalinea',$segundalinea,PDO::PARAM_STR);
                                                                $sql->bindParam(':ciclossegundalineaqt',$ciclossegundalineaqt,PDO::PARAM_INT);
                                                                $sql->bindParam(':antraciclinas',$antraciclinas,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':momentodelaqt',$momentoquimio,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':her2',$her,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':esquemaher2',$esquemaherdos,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':triplenegativo',$triplenegativo,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':esquematrilpenegativo',$esquematriple,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':hormonosensible',$hormonosensibles,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':esquemahormonosensible',$esquemahormonosensible,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':tipotratamiento',$tipotratamiento,PDO::PARAM_STR,25);
                                                                $sql->bindParam(':completoquimio',$completoquimio,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':causaqtincompleta',$quimioesquema,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':fechaeventoadverso',$fechaeventoadverso,PDO::PARAM_STR);
                                                                $sql->bindParam(':fechaprogresion',$fechaprogresion,PDO::PARAM_STR);
                                                                $sql->bindParam(':fecharecurrencia',$fecharecurrencia,PDO::PARAM_STR);
                                                                $sql->bindParam(':fechafallecio',$fechadefuncion,PDO::PARAM_STR);
                                                                $sql->bindParam(':causafallecio',$otracausa,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':especifique',$especifiquecausa,PDO::PARAM_STR);
                                                                $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                    $sql->execute();



                            $sql = $conexionCancer->prepare("INSERT into radioterapia(aplicoradio, id_paciente)
                                        values(:aplicoradio, :id_paciente)");

                                        $sql->bindParam(':aplicoradio',$radioterapia,PDO::PARAM_STR,10);
                                        $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                                            $sql->execute();
                                            
                                        if($radioterapia == 'Si'){
                                            $sql = $conexionCancer->prepare("SELECT id_radio from radioterapia where id_paciente = :id_paciente");
                            $sql->execute(array(
            
                                ':id_paciente' => $id_usuario
                            
                            ));
                            $row = $sql->fetch();
                            $id_deradio = $row['id_radio'];
                                            $sql = $conexionCancer->prepare("INSERT into tiporadioterapia(decripcionradio, fecharadio, numerosesiones, id_radio)
                                                values(:decripcionradio, :fecharadio, :numerosesiones, :id_radio)");
                                                        $sql->bindParam(':decripcionradio',$aplicoradioterapia,PDO::PARAM_STR,100);
                                                        $sql->bindParam(':fecharadio',$fechainicioradio,PDO::PARAM_STR);
                                                        $sql->bindParam(':numerosesiones',$numerosesiones,PDO::PARAM_INT);
                                                        $sql->bindParam(':id_radio',$id_deradio,PDO::PARAM_INT);
                                                            $sql->execute();

                                        }
                                        $sql = $conexionCancer->prepare("INSERT into braquiterapia(aplicobraquiterapia, fechabraquiterapia, id_paciente) values(:aplicobraquiterapia, :fechabraquiterapia, :id_paciente)");
                                                        $sql->bindParam(':aplicobraquiterapia',$braquiterapia,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':fechabraquiterapia',$fechadebraquiterapia,PDO::PARAM_STR);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();
                                                            
                                        $sql = $conexionCancer->prepare("INSERT into defencionpaciente(defuncion, fechadefuncion, causadefuncion, id_paciente) values(:defuncion, :fechadefuncion, :causadefuncion, :id_paciente)");
                                                        $sql->bindParam(':defuncion',$defunsi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':fechadefuncion',$fechadeladefuncion,PDO::PARAM_STR);
                                                        $sql->bindParam(':causadefuncion',$causadefuncion,PDO::PARAM_STR);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();
        }else{
            $sql = $conexionCancer->prepare("SELECT id from dato_usuario where curp = :curp");
                            $sql->execute(array(
            
                                ':curp' => $curp
                            
                            ));
                            $row = $sql->fetch();
                            $id_usuario = $row['id'];
                            
                            $sql = $conexionCancer->prepare("INSERT into unidadreferenciado(referenciado, clues, id_paciente) 
    
                                    values (:referenciado, :clues, :id_paciente)");
                                    
                                $sql->bindParam(':referenciado',$referenciado, PDO::PARAM_STR, 10);
                                $sql->bindParam(':clues',$unidadreferencia, PDO::PARAM_STR, 40);
                                $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                            $sql->execute();

                            $sql = $conexionCancer->prepare("INSERT into signosvitales(talla, peso, imc, id_paciente) 
    
                                    values (:talla, :peso, :imc, :id_paciente)");
                                    
                                $sql->bindParam(':talla',$talla, PDO::PARAM_STR, 10);
                                $sql->bindParam(':peso',$peso, PDO::PARAM_STR, 10);
                                $sql->bindParam(':imc',$imc, PDO::PARAM_STR); 
                                $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                            $sql->execute(); 

                            $sql = $conexionCancer->prepare("INSERT into antecedentesgineco(menarca, ultimamestruacion, cuentacon, gestas, parto, aborto, cesarea, embarazada, fpp, terapiareemplazohormonal, lactancia, tiempolactancia, id_paciente) 
    
                                    values (:menarca, :ultimamestruacion, :cuentacon, :gestas, :parto, :aborto, :cesarea, :embarazada, :fpp, :terapiareemplazohormonal, :lactancia, :tiempolactancia, :id_paciente)");
                    
                                $sql->bindParam(':menarca', $menarca, PDO::PARAM_STR, 100);
                                $sql->bindParam(':ultimamestruacion',$fechaultimamestruacion, PDO::PARAM_STR);
                                $sql->bindParam(':cuentacon',$menopausea, PDO::PARAM_STR, 100);
                                $sql->bindParam(':gestas',$gestas, PDO::PARAM_INT);
                                $sql->bindParam(':parto',$parto, PDO::PARAM_INT); 
                                $sql->bindParam(':aborto',$aborto, PDO::PARAM_INT);
                                $sql->bindParam(':cesarea',$cesarea, PDO::PARAM_INT);
                                $sql->bindParam(':embarazada',$embarazada, PDO::PARAM_STR, 10);
                                $sql->bindParam(':fpp',$fechaprobableparto, PDO::PARAM_STR);
                                $sql->bindParam(':terapiareemplazohormonal',$planificacionfamiliar, PDO::PARAM_STR, 10);
                                $sql->bindParam(':lactancia',$lactancia, PDO::PARAM_STR, 10);
                                $sql->bindParam(':tiempolactancia',$tiempolactancia, PDO::PARAM_STR, 35);
                                $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                            $sql->execute(); 
                            $tipocancer = count($tipodecancer);
                            foreach($tipodecancer as $heredocancer) {
                                $sql = $conexionCancer->prepare("INSERT INTO cancerpaciente(descripcioncancer, id_paciente)
                                        values(:descripcioncancer, :id_paciente)");
            
                                $sql->execute(array(
                                    ':descripcioncancer'=>$heredocancer,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }
                            
                            /*$sql = $conexionCancer->prepare("INSERT INTO cancerpaciente(descripcioncancer, id_paciente)
                                        values(:descripcioncancer, :id_paciente)");
                                        $sql->bindParam(':descripcioncancer',$tipodecancer,PDO::PARAM_STR,100);
                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                    $sql->execute();*/
                                    
                            $checked_contador = count($check_listapato);
                            //echo "<p>Has seleccionado los siguientes ".$checked_contador." opcione(s):</p> <br/>";
                            // Bucle para almacenar y visualizar valores activados checkbox.
                            foreach($check_listapato as $seleccion) {
                                $sql_s = $conexionCancer->prepare("INSERT into antecedentespatopersonales(descripcionantecedente, id_paciente) 
                
                                            values('".$seleccion."', '".$id_usuario."')");

                                                $sql_s->execute(array(
                                                    ':descripcionantecedente'=>$seleccion,
                                                    ':id_paciente'=>$id_usuario
                                    ));
                            }
                            

                                    $ms_contador = count($mscancer);
                            foreach($mscancer as $heredo) {
                                $sql_s = $conexionCancer->prepare("INSERT into antecedentesfamiliarescancer(datoantecedentefamiliar, id_paciente) 
                
                                values(:datoantecedentefamiliar, :id_paciente)");
            
                                $sql_s->execute(array(
                                    ':datoantecedentefamiliar'=>$heredo,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }
                            $sql = $conexionCancer->prepare("INSERT into atencionclinica(fechaatencioninicial, biradsreferencia, biradshraei, lateralidadmama, estadioclinico, etapaclinica, tamaniotumoral, compromisolenfatico, metastasis, calidadvidaecog, mastectoextrainstituto, lateralidadmastectoextrainstituto, fechamastectoextrainstituto, id_usuario)
                            values(:fechaatencioninicial, :biradsreferencia, :biradshraei, :lateralidadmama, :estadioclinico, :etapaclinica, :tamaniotumoral, :compromisolenfatico, :metastasis, :calidadvidaecog, :mastectoextrainstituto, :lateralidadmastectoextrainstituto, :fechamastectoextrainstituto, :id_usuario)");

                            $sql->bindParam(':fechaatencioninicial',$fechaatencioninicial, PDO::PARAM_STR);
                            $sql->bindParam(':biradsreferencia',$biradsreferencia,PDO::PARAM_STR,100);
                            $sql->bindParam(':biradshraei',$biradshraei,PDO::PARAM_STR,100);
                            $sql->bindParam(':lateralidadmama',$lateralidadprimero,PDO::PARAM_STR,100);
                            $sql->bindParam(':estadioclinico',$estadioclinico,PDO::PARAM_STR,30);
                            $sql->bindParam(':etapaclinica',$etapasclinicas,PDO::PARAM_STR,20);
                            $sql->bindParam(':tamaniotumoral',$tamaniotumoral,PDO::PARAM_STR,100);
                            $sql->bindParam(':compromisolenfatico',$linfaticonodal,PDO::PARAM_STR,150);
                            $sql->bindParam(':metastasis',$metastasis,PDO::PARAM_STR,150);
                            $sql->bindParam(':calidadvidaecog',$calidaddevidaecog,PDO::PARAM_STR,100);
                            $sql->bindParam(':mastectoextrainstituto',$mastectomiaextrainstitucional,PDO::PARAM_STR,10);
                            $sql->bindParam(':lateralidadmastectoextrainstituto',$lateralidadextrainstitucional,PDO::PARAM_STR, 50);
                            $sql->bindParam(':fechamastectoextrainstituto',$fechamastectoextra,PDO::PARAM_STR);
                            $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                        $sql->execute();
                                    
                                $ms_sitiometa = count($sitiometastasis);
                            foreach($sitiometastasis as $heredositiometa) {
                                $sql_s = $conexionCancer->prepare("INSERT into atencionclinicasitiometastasis(descripcionsitiometastasisi, id_paciente) 
                
                                values(:descripcionsitiometastasisi, :id_paciente)");
            
                                $sql_s->execute(array(
                                    ':descripcionsitiometastasisi'=>$heredositiometa,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }
                                    
                                    $ms_histo = count($mamaseleccion);
                            foreach($mamaseleccion as $heredohistopato) {
                                $sql_s = $conexionCancer->prepare("INSERT into mamahistopatologia(mamahistopato, id_paciente) 
                
                                values(:mamahistopato, :id_paciente)");
            
                                $sql_s->execute(array(
                                    ':mamahistopato'=>$heredohistopato,
                                    ':id_paciente'=>$id_usuario
            
                                ));
                            }

                            $sql = $conexionCancer->prepare("INSERT into histopatologia(dxhistopatologico, fechadxhistopatologico, nottingham, escalasbr, id_usuario)
                                        values(:dxhistopatologico, :fechadxhistopatologico, :nottingham, :escalasbr, :id_usuario)");

                                        $sql->bindParam(':dxhistopatologico',$dxhistopatologico,PDO::PARAM_STR,50);
                                        $sql->bindParam(':fechadxhistopatologico',$fechadxhistopatologico,PDO::PARAM_STR);
                                        $sql->bindParam(':nottingham',$nottingham,PDO::PARAM_STR,100);
                                        $sql->bindParam(':escalasbr',$escalasbr,PDO::PARAM_STR,150);
                                        $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                                            $sql->execute();

                                            $sql = $conexionCancer->prepare("INSERT into histopatoregionganglioderecha(dxhistopatologicorgd, fechadxhistopatologicorgd, nottinghamrgd, escalasbrrgd, id_paciente)
                                            values(:dxhistopatologicorgd, :fechadxhistopatologicorgd, :nottinghamrgd, :escalasbrrgd, :id_paciente)");
    
                                            $sql->bindParam(':dxhistopatologicorgd',$dxhistopatologicorgd,PDO::PARAM_STR,50);
                                            $sql->bindParam(':fechadxhistopatologicorgd',$fechadxhistopatologicorgd,PDO::PARAM_STR);
                                            $sql->bindParam(':nottinghamrgd',$nottinghamrgd,PDO::PARAM_STR,100);
                                            $sql->bindParam(':escalasbrrgd',$escalasbrrgd,PDO::PARAM_STR,150);
                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                $sql->execute();
                                            
                            $sql = $conexionCancer->prepare("INSERT into histopatologiaizquierda(dxhistopatologicoiz, fechadxhistopatologicoiz, nottinghamiz, escalasbriz, id_paciente)
                                        values(:dxhistopatologicoiz, :fechadxhistopatologicoiz, :nottinghamiz, :escalasbriz, :id_paciente)");

                                        $sql->bindParam(':dxhistopatologicoiz',$dxhistopatologicoiz,PDO::PARAM_STR,50);
                                        $sql->bindParam(':fechadxhistopatologicoiz',$fechadxhistopatologicoiz,PDO::PARAM_STR);
                                        $sql->bindParam(':nottinghamiz',$nottinghamiz,PDO::PARAM_STR,100);
                                        $sql->bindParam(':escalasbriz',$escalasbriz,PDO::PARAM_STR,150);
                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                            $sql->execute();

                                            $sql = $conexionCancer->prepare("INSERT into histopatoregionganglionariz(dxhistopatologicorgi, fechadxhistopatologicorgi, nottinghamrgi, escalasbrrgi, id_paciente)
                                            values(:dxhistopatologicorgi, :fechadxhistopatologicorgi, :nottinghamrgi, :escalasbrrgi, :id_paciente)");
    
                                            $sql->bindParam(':dxhistopatologicorgi',$dxhistopatologicorgi,PDO::PARAM_STR,50);
                                            $sql->bindParam(':fechadxhistopatologicorgi',$fechadxhistopatologicorgi,PDO::PARAM_STR);
                                            $sql->bindParam(':nottinghamrgi',$nottinghamrgi,PDO::PARAM_STR,100);
                                            $sql->bindParam(':escalasbrrgi',$escalasbrrgi,PDO::PARAM_STR,150);
                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                $sql->execute();

                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimica(receptoresestrogenos, receptoresprogesterona, ki67, p53, triplenegativo, aplicopdl, descripcionpdl, oncogenher2, fish, id_usuario)
                                                        values(:receptoresestrogenos, :receptoresprogesterona, :ki67, :p53, :triplenegativo, :aplicopdl, :descripcionpdl, :oncogenher2, :fish, :id_usuario)");

                                                        $sql->bindParam(':receptoresestrogenos',$receptoresestrogenos,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesterona',$receptoresprogesterona,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67',$ki67,PDO::PARAM_STR,100);
                                                
                                                        $sql->bindParam(':p53',$p53,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativo',$triplenegativo,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdl',$pdlrealizo,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdl',$pdl,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2',$oncogen,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fish',$fish,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();

                                                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimicargd(receptoresestrogenosrgd, receptoresprogesteronargd, ki67rgd, p53rgd,  triplenegativorgd, aplicopdlrgd, descripcionpdlrgd, oncogenher2rgd, fishrgd, id_paciente)
                                                        values(:receptoresestrogenosrgd, :receptoresprogesteronargd, :ki67rgd, :p53rgd, :triplenegativorgd, :aplicopdlrgd, :descripcionpdlrgd, :oncogenher2rgd, :fishrgd, :id_paciente)");

                                                        $sql->bindParam(':receptoresestrogenosrgd',$receptoresestrogenosrgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesteronargd',$receptoresprogesteronargd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67rgd',$ki67rgd,PDO::PARAM_STR,100);
                                                        $sql->bindParam(':p53rgd',$p53rgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativorgd',$triplenegativorgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdlrgd',$pdlrealizorgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdlrgd',$pdlrgd,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2rgd',$oncogenrgd,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fishrgd',$fishrgd,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();

                    
                                                            
                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimicaiz(receptoresestrogenosiz, receptoresprogesteronaiz, ki67iz, p53iz, triplenegativoiz, aplicopdliz, descripcionpdliz, oncogenher2iz, fishiz, id_usuario)
                                                        values(:receptoresestrogenosiz, :receptoresprogesteronaiz, :ki67iz, :p53iz, :triplenegativoiz, :aplicopdliz, :descripcionpdliz, :oncogenher2iz, :fishiz, :id_usuario)");

                                                        $sql->bindParam(':receptoresestrogenosiz',$receptoresestrogenosiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':receptoresprogesteronaiz',$receptoresprogesteronaiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':ki67iz',$ki67iz,PDO::PARAM_STR,100);
                                                    
                                                        $sql->bindParam(':p53iz',$p53iz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':triplenegativoiz',$triplenegativoiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':aplicopdliz',$pdlrealizoiz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':descripcionpdliz',$pdliz,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':oncogenher2iz',$oncogeniz,PDO::PARAM_STR,15);
                                                        $sql->bindParam(':fishiz',$fishiz,PDO::PARAM_STR,25);
                                                        $sql->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();

                                                            $sql = $conexionCancer->prepare("INSERT into inmunohistoquimicargiz(receptoresestrogenosrgiz, receptoresprogesteronargiz, ki67rgiz, p53rgiz, triplenegativorgiz, aplicopdlrgiz, descripcionpdlrgiz, oncogenher2rgiz, fishrgiz, id_paciente)
                                                            values(:receptoresestrogenosrgiz, :receptoresprogesteronargiz, :ki67rgiz, :p53rgiz, :triplenegativorgiz, :aplicopdlrgiz, :descripcionpdlrgiz, :oncogenher2rgiz, :fishrgiz, :id_paciente)");
    
                                                            $sql->bindParam(':receptoresestrogenosrgiz',$receptoresestrogenosizrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':receptoresprogesteronargiz',$receptoresprogesteronaizrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':ki67rgiz',$ki67izrgi,PDO::PARAM_STR,100);
                                                        
                                                            $sql->bindParam(':p53rgiz',$p53izrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':triplenegativorgiz',$triplenegativoizrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':aplicopdlrgiz',$pdlrealizoizrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':descripcionpdlrgiz',$pdlizrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':oncogenher2rgiz',$oncogenizrgi,PDO::PARAM_STR,15);
                                                            $sql->bindParam(':fishrgiz',$fishizrgi,PDO::PARAM_STR,25);
                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                $sql->execute();
                            
                                $ms_molecular = count($mamaseleccionmolecular);
                                                    foreach($mamaseleccionmolecular as $heredomolecular) {
                                                            $sql_s = $conexionCancer->prepare("INSERT into mamamolecular(mamaseleccion, id_paciente) 
                                                
                                                            values(:mamaseleccion, :id_paciente)");
                                            
                                                                $sql_s->execute(array(
                                                                    ':mamaseleccion'=>$heredomolecular,
                                                                    ':id_paciente'=>$id_usuario
                                            
                                                                ));
                                                            }
                                                            
                            $sql = $conexionCancer->prepare("INSERT into molecular(luminala, luminalb, enriquecidoher2, basal, id_paciente) values(:luminala, :luminalb, :enriquecidoher2, :basal, :id_paciente)");
                            $sql->bindParam(':luminala',$luminala,PDO::PARAM_STR,10);
                            $sql->bindParam(':luminalb',$luminalb,PDO::PARAM_STR,10);
                            $sql->bindParam(':enriquecidoher2',$enriquecidoherdos,PDO::PARAM_STR,10);
                            $sql->bindParam(':basal',$basal,PDO::PARAM_STR,10);
                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                $sql->execute();

                                                                $sql = $conexionCancer->prepare("INSERT into molecularrgd(luminalargd, luminalbrgd, enriquecidoher2rgd, basalrgd, id_paciente) values(:luminalargd, :luminalbrgd, :enriquecidoher2rgd, :basalrgd, :id_paciente)");
                            $sql->bindParam(':luminalargd',$luminalammrgd,PDO::PARAM_STR,10);
                            $sql->bindParam(':luminalbrgd',$luminalbmmrgd,PDO::PARAM_STR,10);
                            $sql->bindParam(':enriquecidoher2rgd',$enriquecidoherdosmmrgd,PDO::PARAM_STR,10);
                            $sql->bindParam(':basalrgd',$basalmmrgd,PDO::PARAM_STR,10);
                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                $sql->execute();

                            $sql = $conexionCancer->prepare("INSERT into molecularizquierda(luminalaiz, luminalbiz, enriquecidoher2iz, basaliz, id_paciente) values(:luminalaiz, :luminalbiz, :enriquecidoher2iz, :basaliz, :id_paciente)");
                                                            $sql->bindParam(':luminalaiz',$luminalaiz,PDO::PARAM_STR,20);
                                                            $sql->bindParam(':luminalbiz',$luminalbiz,PDO::PARAM_STR,20);
                                                            $sql->bindParam(':enriquecidoher2iz',$enriquecidoherdosiz,PDO::PARAM_STR,20);
                                                            $sql->bindParam(':basaliz',$basaliz,PDO::PARAM_STR,20);
                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                    $sql->execute();

                                                                    $sql = $conexionCancer->prepare("INSERT into molecularrgiz(luminalargiz, luminalbrgiz, enriquecidoher2rgiz, basalrgiz, id_paciente) values(:luminalargiz, :luminalbrgiz, :enriquecidoher2rgiz, :basalrgiz, :id_paciente)");
                                                            $sql->bindParam(':luminalargiz',$luminalaizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':luminalbrgiz',$luminalbizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':enriquecidoher2rgiz',$enriquecidoherdosizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':basalrgiz',$basalizmmrgi,PDO::PARAM_STR,10);
                                                            $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                $sql->execute();

                                                                    

                            $sql = $conexionCancer->prepare("INSERT into quimioterapia(aplicoquimio, fechainicio, primeralinea, ciclosprimerlineaqt, segundalinea, ciclossegundalineaqt, antraciclinas, momentodelaqt, her2, esquemaher2, triplenegativo, esquematrilpenegativo, hormonosensible, 
                            esquemahormonosensible, tipotratamiento, completoquimio, causaqtincompleta, fechaeventoadverso, fechaprogresion, fecharecurrencia, fechafallecio, causafallecio, especifique, id_paciente) 
                            values(:aplicoquimio, :fechainicio, :primeralinea, :ciclosprimerlineaqt, :segundalinea, :ciclossegundalineaqt, :antraciclinas, :momentodelaqt, :her2, :esquemaher2, :triplenegativo, :esquematrilpenegativo, :hormonosensible, 
                            :esquemahormonosensible, :tipotratamiento, :completoquimio, :causaqtincompleta, :fechaeventoadverso, :fechaprogresion, :fecharecurrencia, :fechafallecio, :causafallecio, :especifique, :id_paciente)");
                                                                $sql->bindParam(':aplicoquimio',$aplicoquimio,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':fechainicio',$fechadeinicioquimio,PDO::PARAM_STR);
                                                                $sql->bindParam(':primeralinea',$primerlinea,PDO::PARAM_STR, 10);
                                                                $sql->bindParam(':ciclosprimerlineaqt',$ciclosprimerlineaqt,PDO::PARAM_INT);
                                                                $sql->bindParam(':segundalinea',$segundalinea,PDO::PARAM_STR);
                                                                $sql->bindParam(':ciclossegundalineaqt',$ciclossegundalineaqt,PDO::PARAM_INT);
                                                                $sql->bindParam(':antraciclinas',$antraciclinas,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':momentodelaqt',$momentoquimio,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':her2',$her,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':esquemaher2',$esquemaherdos,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':triplenegativo',$triplenegativo,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':esquematrilpenegativo',$esquematriple,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':hormonosensible',$hormonosensibles,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':esquemahormonosensible',$esquemahormonosensible,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':tipotratamiento',$tipotratamiento,PDO::PARAM_STR,25);
                                                                $sql->bindParam(':completoquimio',$completoquimio,PDO::PARAM_STR,10);
                                                                $sql->bindParam(':causaqtincompleta',$quimioesquema,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':fechaeventoadverso',$fechaeventoadverso,PDO::PARAM_STR);
                                                                $sql->bindParam(':fechaprogresion',$fechaprogresion,PDO::PARAM_STR);
                                                                $sql->bindParam(':fecharecurrencia',$fecharecurrencia,PDO::PARAM_STR);
                                                                $sql->bindParam(':fechafallecio',$fechadefuncion,PDO::PARAM_STR);
                                                                $sql->bindParam(':causafallecio',$otracausa,PDO::PARAM_STR,50);
                                                                $sql->bindParam(':especifique',$especifiquecausa,PDO::PARAM_STR);
                                                                $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                                                                    $sql->execute();



                            $sql = $conexionCancer->prepare("INSERT into radioterapia(aplicoradio, id_paciente)
                                        values(:aplicoradio, :id_paciente)");

                                        $sql->bindParam(':aplicoradio',$radioterapia,PDO::PARAM_STR,10);
                                        $sql->bindParam(':id_paciente',$id_usuario, PDO::PARAM_INT);
                                            $sql->execute();
                                            
                                        if($radioterapia == 'Si'){
                                            $sql = $conexionCancer->prepare("SELECT id_radio from radioterapia where id_paciente = :id_paciente");
                            $sql->execute(array(
            
                                ':id_paciente' => $id_usuario
                            
                            ));
                            $row = $sql->fetch();
                            $id_deradio = $row['id_radio'];
                                            $sql = $conexionCancer->prepare("INSERT into tiporadioterapia(decripcionradio, fecharadio, numerosesiones, id_radio)
                                                values(:decripcionradio, :fecharadio, :numerosesiones, :id_radio)");
                                                        $sql->bindParam(':decripcionradio',$aplicoradioterapia,PDO::PARAM_STR,100);
                                                        $sql->bindParam(':fecharadio',$fechainicioradio,PDO::PARAM_STR);
                                                        $sql->bindParam(':numerosesiones',$numerosesiones,PDO::PARAM_INT);
                                                        $sql->bindParam(':id_radio',$id_deradio,PDO::PARAM_INT);
                                                            $sql->execute();

                                        }
                                        $sql = $conexionCancer->prepare("INSERT into braquiterapia(aplicobraquiterapia, fechabraquiterapia, id_paciente) values(:aplicobraquiterapia, :fechabraquiterapia, :id_paciente)");
                                                        $sql->bindParam(':aplicobraquiterapia',$braquiterapia,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':fechabraquiterapia',$fechadebraquiterapia,PDO::PARAM_STR);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();
                                                            
                                        $sql = $conexionCancer->prepare("INSERT into defencionpaciente(defuncion, fechadefuncion, causadefuncion, id_paciente) values(:defuncion, :fechadefuncion, :causadefuncion, :id_paciente)");
                                                        $sql->bindParam(':defuncion',$defunsi,PDO::PARAM_STR,10);
                                                        $sql->bindParam(':fechadefuncion',$fechadeladefuncion,PDO::PARAM_STR);
                                                        $sql->bindParam(':causadefuncion',$causadefuncion,PDO::PARAM_STR);
                                                        $sql->bindParam(':id_paciente',$id_usuario,PDO::PARAM_INT);
                                                            $sql->execute();
        }
                            if($sql != false) {
                                echo "<script>swal({
                                            title: 'Good job!',
                                            text: 'Datos guardados exitosamente!',
                                            icon: 'success',
                                            
                                    });
                                    </script>";	
                                
                                }else {
                                    
                                    echo "<script>swal({
                                            title: 'Fatal!',
                                            text: 'Error al guardar informacion!',
                                            icon: 'error',
                                            });</script>";
                                        
                                    
                                    }
    
}
                                
                            ?>