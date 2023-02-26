<script src="js/enviacurp.js"></script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="css/estilosMenu.css">
<?php
error_reporting(0);
date_default_timezone_set('America/Monterey');
        $fecha_actual = new DateTime(date('Y-m-d'));

        
            $id_paciente = $dataRegistro['id'];
            $curp = $dataRegistro['curp'];
            $id = $dataRegistro['id_paciente'];
            $municipio = $dataRegistro['municipio'];
            $estado = $dataRegistro['estado'];
            $idquirurgico = $dataRegistro['id_quirurgico'];
            require 'conexionCancer.php';
            
            $clues = $dataRegistro['clues'];
            $sql_f = $conexion2->query("SELECT unidad from hospitales where clues = '$clues'");
            $rown = mysqli_fetch_assoc($sql_f);
                
            $sql = $conexion2->query("SELECT id_paciente, datoantecedentefamiliar
            FROM antecedentesfamiliarescancer
            WHERE id_paciente
            IN (SELECT id_paciente
            FROM antecedentesfamiliarescancer
            GROUP BY id_paciente
            HAVING count(id_paciente) >= 1)
            and id_paciente = $id_paciente
            ORDER BY id_paciente");
            
            $sql_m = $conexion2->query("SELECT id_paciente, descripcioncancer
            FROM cancerpaciente
            WHERE id_paciente
            IN (SELECT id_paciente
            FROM cancerpaciente
            GROUP BY id_paciente
            HAVING count(id_paciente) >= 1)
            and id_paciente = $id_paciente
            ORDER BY id_paciente");
        

            $sql_r = $conexion2->query("SELECT id_paciente, descripcionantecedente
            FROM antecedentespatopersonales
            WHERE id_paciente
            IN (SELECT id_paciente
            FROM antecedentespatopersonales
            GROUP BY id_paciente
            HAVING count(id_paciente) >= 1)
            and id_paciente = $id_paciente
            ORDER BY id_paciente");
            
            $sql_q = $conexion2->query("SELECT id_quirurgico, descripciontipoquirurgico
            FROM quirugicotipo 
            WHERE id_paciente
            IN (SELECT id_quirurgico FROM quirurgicotipo
            GROUP BY id_quirurgico
            HAVING count(id_quirurgico) >= 1)
            and id_quirurgico = '$idquirurgico'
            ORDER BY id_quirurgico");
            
                
                
                
                
            
        
            //$fecha1 = new DateTime($dataRegistro['iniciosintomas']);//fecha inicial
           // $fecha2 = new DateTime($dataRegistro['fechaterminotrombolisis']);//fecha de cierre
            
            //$intervalo = $fecha1->diff($fecha2);
            
           // $diasDiferencia = $intervalo->format('%d days %H horas %i minutos');
            $imccalculo = $dataRegistro['imc'];
            $imcbajo = "IMC bajo";
            $imcok= "IMC ok";
            $imcsobre = "Sobrepeso";
            $obe1 = "Obesidad I";
            $obe2 = "Obesidad II";
            $obe3 = "<i class='lnr lnr-flag'></i>";
            $obe4 = "<i class='lnr lnr-flag'></i>";
        if($imccalculo <= 18.5 ){
            $showimc = "<span class='imcbajo'> $imcbajo";
        }elseif($imccalculo > 18.5 and $imccalculo <= 24.9 ){
            $showimc = "<span class='imcok'> $imcok";
        }elseif($imccalculo > 25 and $imccalculo <= 29.9 ){
            $showimc = "<span class='imcsobre'> $imcsobre";
        }elseif($imccalculo > 30 and $imccalculo <= 34.9 ){
            $showimc = "<span class='obesidad1'> $obe1";
        }elseif($imccalculo > 35 and $imccalculo <= 39.9 ){
            $showimc = "<span class='obesidad2'> $obe2";
        }
            require 'conexionCancer.php';
            $sqls = $conexion2->query("SELECT * from t_estado where id_estado = $estado");
            $rows = mysqli_fetch_assoc($sqls);
            
            $sqlsm = $conexion2->query("SELECT * from t_municipio where id_municipio = $municipio");
            $rowsm = mysqli_fetch_assoc($sqlsm);

                   
        
        ?>

<div id="mensaje"></div>
<input type="hidden" id="idcurp" value="<?php echo $id_paciente; ?>">
<input type="hidden" id="cancer" value="<?php echo $dataRegistro['descripcioncancer']; ?>">
<input type="hidden" id="curpvalidar" value="<?php echo $dataRegistro['curp']; ?>">
<input type="hidden" id="nombrepaciente" value="<?php echo $dataRegistro['nombrecompleto']; ?>">
<div class="containerr">
    <?php

        $sql_busqueda = $conexionCancer->prepare("SELECT id_paciente from seguimientocancer where id_paciente = $id_paciente");
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
        $validaid = $validacion['id_paciente'];
    if($dataRegistro['curp'] != ''){ 
        if($validaid != $id_paciente){ ?>
<input type="submit" class="mandaid" id="<?php echo $id_paciente ?>" value="Seguimiento"> <?php }else{ ?>
            <input type="hidden" value="<?php echo $id_paciente ?>" id="seguimiento">
            <input type="submit" onclick="seguimiento();"  id="verseguimiento" value="Ver seguimiento">
            <?php }?>
           <script>
            function seguimiento(){

            let id = $("#seguimiento").val();

        let ob = {
            id: id
        };
        $.ajax({
            type: "POST",
            url: "consultaCancerdeMamaBusquedaSeguimiento.php",
            data: ob,
            beforeSend: function() {

            },
            success: function(data) {

                $("#tabla_resultado").html(data);

            }
        });

    };
    </script>
    
            <?php session_start();
                if (isset($_SESSION['usuarioAdmin']) or isset($_SESSION['usuarioMedico'])) { 
                    if($dataRegistro['editopaciente'] == 0 ) {?>
                    
            <input type="submit" onclick="editarRegistro();" id="editarregistro" value="Editar registro">
                <?php }else{ ?>
                    <input type="submit" onclick="finalizarEdicion();" id="editarregistro" value="Finalizar Edicion">

                <?php }
            };?>
            <input type="submit" onclick="eliminarRegistro();" id="eliminarregistro" value="Eliminar registro">
            <?php
    }?>
                </div>
                <style>
                    .table:hover {
                            background: #EBEBEB;
                    }
                </style>
<table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatos();" <?php } }?> >

    <div class="containerr2">Datos Personales</div>
    <tr>
        <th id="th">Nombre:</th>
        <td id="td"><?php echo $dataRegistro['nombrecompleto']?></td></tr>
        <tr>
        <th id="th">CURP:</th>
        <td id="td"><?php echo $dataRegistro['curp'] ?></td></tr>
        <tr>
        <th id="th">Edad:</th>
        <td id="td"><?php echo $dataRegistro['edad'] ?></td></tr>
        <tr>
        <th id="th">Sexo:</th>
        <td id="td"><?php echo $dataRegistro['sexo'] ?></td></tr>
        <tr>
        <th id="th">Estado:</th>
        <td id="td"><?php echo $rows['estado'] ?></td></tr>
        <tr>
        <th id="th">Municipio:</th>
        <td id="td"><?php echo $rowsm['municipio'] ?>
        
            <?php
        if($validaid == $id_paciente and $id_paciente != ''){ 
            ?><a href="#" style="color: red; float: right; margin-right: 10px; font-size: 12px; font-style: arial;">En seguimiento</a><?php }?>
            
        </td></tr>
    </tr></table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosreferencia();" <?php } }?>>        
    
    <div class="containerr3">Unidad de refernecia</div>
    <tr>
        <th id="th">Referenciado:</th>  
        <td id="td"><?php echo $dataRegistro['referenciado'] ?></td>
        <tr>
            <th id="th">Unidad de referencia</th>
            <td id="td"><?php echo $rown['unidad']; ?></td>
        </tr>
        </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatoscancer();" <?php } }?>>        
    <div class="containerr3">Cancer</div>
    <tr>
        <th id="th">Tipo de cancer:</th>
        <td style="color: red;" id="td">
        <?php if($id_paciente != ''){ 
            ?>
            Cancer de mama
        </td>
            <?php }else {

            }?>
        </tr>
         
    <tr>
        <th id="th">Antecedentes Heredofamiliares:</th>
        <td id="td">
            <?php while($dataRegi= mysqli_fetch_assoc($sql_m))
        {
        echo '&nbsp&nbsp'.$dataRegi['descripcioncancer'].'--'.'';} ?></td>
    </tr>
      
    <tr>
        <th id="th">Linea Heredofamiliar:</th>

        <td id="td">
        <?php while($dataRegis= mysqli_fetch_assoc($sql))
        {
        echo '&nbsp&nbsp'.$dataRegis['datoantecedentefamiliar'].'--'.'';} ?></td>

    </tr></table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatospersonalespatologicos();" <?php } }?>>        
    <tr>
    <div class="containerr3">Antecedentes personales patologicos</div>

        <th id="th">Antecedentes Personales Patologicos:</th>

        <td id="td"><?php while($dataRegist= mysqli_fetch_assoc($sql_r))
{
echo '&nbsp&nbsp'.$dataRegist['descripcionantecedente'].'--'.'';} ?></td>

    </tr></table>

    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        
   
    <div class="containerr3">Somatometria</div>
     <tr>
        <th id="th">Talla:</th>
        <td id="td"><?php echo $dataRegistro['talla']?></td></tr>
        <tr>
        <th id="th">Peso:</th>
        <td id="td"><?php echo $dataRegistro['peso']?></td></tr>
        <tr>
        <th id="th">I.M.C:</th>
        <td id="td"><?php echo $dataRegistro['imc'].'&nbsp'; if($id_paciente != ''){ echo $showimc;}?></td></tr>
    </table>

    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosantecedentesgineco();" <?php } }?>>         
    <div class="containerr3">Antecedentes gineco obstetricos</div>
    <tr>
        <th id="th">Menarca:</th>
            <td id="td"><?php echo $dataRegistro['menarca'] ?></td>
        </tr>
        <tr>
        <th id="th">Ultima mestruación:</th>
            <td id="td"><?php echo $dataRegistro['ultimamestruacion'] ?></td>
            </tr>
        <tr>
        <th id="th">Cuenta con:</th>
            <td id="td"><?php echo $dataRegistro['cuentacon'] ?></td>
            </tr>
        <tr>
        <th id="th">Gestas:</th>
            <td id="td"><?php echo $dataRegistro['gestas'] ?></td>
            </tr>
        <tr>
        <th id="th">Parto:</th>
            <td id="td"><?php echo $dataRegistro['parto'] ?></td>
            </tr>
        <tr>
        <th id="th">Aborto</th>
            <td id="td"><?php echo $dataRegistro['aborto'] ?></td>
            </tr>
        <tr>
        <th id="th">Cesarea:</th>
            <td id="td"><?php echo $dataRegistro['cesarea'] ?></td>
            </tr>
        <tr>
        <th id="th">Embarazada:</th>
            <td id="td"><?php echo $dataRegistro['embarazada'] ?></td>
            </tr>
        <tr>
        <th id="th">F.P.P</th>
            <td id="td"><?php echo $dataRegistro['fpp'] ?></td>
            </tr>
        <tr>
            <th id="th">Terapia reemplazo hormonal</th>
            <td id="td"><?php echo $dataRegistro['terapiareemplazohormonal'] ?></td>
            </tr>
         <tr>
             <th id="th">Lactancia</th>
             <td id="td"><?php echo $dataRegistro['lactancia'] ?></td>
         </tr>  
         <tr>
             <th id="th">Tiempo lactancia</th>
             <td id="td"><?php echo $dataRegistro['tiempolactancia'] ?></td>
         </tr>
        
        </table>


    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosatencionclinica();" <?php } }?>>        
    <div class="containerr3">Atención clinica</div>
        <tr>
        <th id="th">Fecha de atención inicial:</th>
        <td id="td"><?php echo $dataRegistro['fechaatencioninicial']?>
        </td></tr>
        <tr>
            <th id="th">BIRADS de referencia:</th>
            <td id="td"><?php echo $dataRegistro['biradsreferencia']?></td>
        </tr>
        <tr>
            <th id="th">BIRADS HRAEI:</th>
            <td id="td"><?php echo $dataRegistro['biradshraei']?></td>
        </tr>
        <tr>
            <th id="th">Lateralidad:</th>
            <td id="td"><?php echo $dataRegistro['lateralidadmama']?></td>
        </tr>
        <tr>
            <th id="th">Estado clinico:</th>
            <td id="td"><?php echo $dataRegistro['estadioclinico']?></td>
        </tr>
        <tr>
            <th id="th">Etapa clinca:</th>
            <td id="td"><?php echo $dataRegistro['etapaclinica']?></td>
        </tr>
        <tr>
            <th id="th">Tamaño tumoral:</th>
            <td id="td"><?php echo $dataRegistro['tamaniotumoral']?></td>
        </tr>
        <tr>
            <th id="th">Compromiso linfatico nodal:</th>
            <td id="td"><?php echo $dataRegistro['compromisolenfatico']?></td>
        </tr>
        <tr>
            <th id="th">Metastasis:</th>
            <td id="td"><?php echo $dataRegistro['metastasis']?></td>
        </tr>
        <tr>
            <th id="th">Sito Metastasis:</th>
            <td id="td"></td>
        </tr>
        
        <tr>
            <th id="th">Calidad de vida ECOG:</th>
            <td id="td"><?php echo $dataRegistro['calidaddevidaecog']?></td>
        </tr>
        <tr>
            <th id="th">Mastectomia extrainstitucional:</th>
            <td id="td"><?php echo $dataRegistro['mastectoextrainstituto'] ?></td>
        </tr>
        <tr>
            <th id="th">Lateralidad Mastectomia extrainstitucional:</th>
            <td id="td"><?php echo $dataRegistro['lateralidadmastectoextrainstituto'] ?></td>
        </tr>
        <tr>
            <th id="th">Fecha Mastectomia extrainstitucional:</th>
            <td id="td"><?php echo $dataRegistro['fechamastectoextrainstituto'] ?></td>
        </tr>
        
        </table>

    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatoshistopatomamaderecha();" <?php } }?>>        
   
    <div class="containerr3">Histopatologia mama derecha</div>
        <tr>
        <th id="th">DX histopatologico MMD:</th>
        <td id="td"><?php echo $dataRegistro['dxhistopatologico'] ?>
        </td></tr>
        <tr>
            <th id="th">Fecha DX histopatologico:</th>
            <td id="td"><?php echo $dataRegistro['fechadxhistopatologico'] ?></td>
        </tr>
        <tr>
            <th id="th">Nottinghan MMD:</th>
            <td id="td"><?php echo $dataRegistro['nottingham'] ?></td>
        </tr>
        <tr>
            <th id="th">ESCALA SBR (SCARLET-BLOOM-RICHARDSON)::</th>
            <td id="td"><?php echo $dataRegistro['escalasbr'] ?></td>
        </tr>
    
        </table>
        <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatoshistopatorgmamader();" <?php } }?>>        

    <div class="containerr3">Histopatologia Region ganglionar mama derecha</div>
        <tr>
        <th id="th">DX histopatologico MMD:</th>
        <td id="td"><?php echo $dataRegistro['dxhistopatologicorgd'] ?>
        </td></tr>
        <tr>
            <th id="th">Fecha DX histopatologico:</th>
            <td id="td"><?php echo $dataRegistro['fechadxhistopatologicorgd'] ?></td>
        </tr>
        <tr>
            <th id="th">Nottinghan MMD:</th>
            <td id="td"><?php echo $dataRegistro['nottinghamrgd'] ?></td>
        </tr>
        <tr>
            <th id="th">ESCALA SBR (SCARLET-BLOOM-RICHARDSON)::</th>
            <td id="td"><?php echo $dataRegistro['escalasbrrgd'] ?></td>
        </tr>
    
        </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatoshistopatomamaiz();" <?php } }?>>        
    
    <div class="containerr3">Histopatologia mama izquierda</div>
        <tr>
        <th id="th">DX histopatologico MMI:</th>
        <td id="td"><?php echo $dataRegistro['dxhistopatologicoiz'] ?>
        </td></tr>
        <tr>
            <th id="th">Fecha DX histopatologico:</th>
            <td id="td"><?php echo $dataRegistro['fechadxhistopatologicoiz'] ?></td>
        </tr>
        <tr>
            <th id="th">Nottinghan MMI:</th>
            <td id="td"><?php echo $dataRegistro['nottinghamiz'] ?></td>
        </tr>
        <tr>
            <th id="th">ESCALA SBR (SCARLET-BLOOM-RICHARDSON)::</th>
            <td id="td"><?php echo $dataRegistro['escalasbriz'] ?></td>
        </tr></table>
        <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatoshistopatorgmamaiz();" <?php } }?>>        
    
    <div class="containerr3">Histopatologia Region ganglionar mama izquierda</div>
        <tr>
        <th id="th">DX histopatologico MMI:</th>
        <td id="td"><?php echo $dataRegistro['dxhistopatologicorgi'] ?>
        </td></tr>
        <tr>
            <th id="th">Fecha DX histopatologico:</th>
            <td id="td"><?php echo $dataRegistro['fechadxhistopatologicorgi'] ?></td>
        </tr>
        <tr>
            <th id="th">Nottinghan MMI:</th>
            <td id="td"><?php echo $dataRegistro['nottinghamrgi'] ?></td>
        </tr>
        <tr>
            <th id="th">ESCALA SBR (SCARLET-BLOOM-RICHARDSON)::</th>
            <td id="td"><?php echo $dataRegistro['escalasbrrgi'] ?></td>
        </tr></table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosinmunomamaderecha();" <?php } }?>>        
   
    <div class="containerr3">Inmunohistoquimica mama derecha</div>
     <tr>
        <th id="th">Receptores de estrogenos (RE):</th>
        <td id="td"><?php echo $dataRegistro['receptoresestrogenos']?>
        </td>
    </tr>
    <tr>
        <th id="th">Receptores de progesterona (RP):</th>
        <td id="td"><?php echo $dataRegistro['receptoresprogesterona'] ?></td>
    </tr>
    <tr>
        <th id="th">KI-67:</th>
        <td id="td"><?php echo $dataRegistro['ki67'] ?></td>
    </tr>
    <tr>
        <th id="th">P 53:</th>
        <td id="td"><?php echo $dataRegistro['p53'] ?></td>
    </tr>
    <tr>
        <th id="th">Triple negativo:</th>
        <td id="td"><?php echo $dataRegistro['triplenegativo'] ?></td>
    </tr>
    <tr>
        <th id="th">Aplico PDL:</th>
        <td id="td"><?php echo $dataRegistro['aplicopdl'] ?></td>
    </tr>
    <tr>
        <th id="th">PDL:</th>
        <td id="td"><?php echo $dataRegistro['descripcionpdl'] ?></td>
    </tr>
    <tr>
        <th id="th">Oncogen HER2:</th>
        <td id="td"><?php echo $dataRegistro['oncogenher2'] ?></td>
    </tr>
    <tr>
        <th id="th">Fish:</th>
        <td id="td"><?php echo $dataRegistro['fish'] ?></td>
    </tr>
    
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosinmunorgdmamaderecha();" <?php } }?>>        
   
    <div class="containerr3">Inmunohistoquimica Region ganglionar mama derecha</div>
     <tr>
        <th id="th">Receptores de estrogenos (RE):</th>
        <td id="td"><?php echo $dataRegistro['receptoresestrogenosrgd']?>
        </td>
    </tr>
    <tr>
        <th id="th">Receptores de progesterona (RP):</th>
        <td id="td"><?php echo $dataRegistro['receptoresprogesteronargd'] ?></td>
    </tr>
    <tr>
        <th id="th">KI-67:</th>
        <td id="td"><?php echo $dataRegistro['ki67rgd'] ?></td>
    </tr>
    <tr>
        <th id="th">P 53:</th>
        <td id="td"><?php echo $dataRegistro['p53rgd'] ?></td>
    </tr>
    <tr>
        <th id="th">Triple negativo:</th>
        <td id="td"><?php echo $dataRegistro['triplenegativorgd'] ?></td>
    </tr>
    <tr>
        <th id="th">Aplico PDL:</th>
        <td id="td"><?php echo $dataRegistro['aplicopdlrgd'] ?></td>
    </tr>
    <tr>
        <th id="th">PDL:</th>
        <td id="td"><?php echo $dataRegistro['descripcionpdlrgd'] ?></td>
    </tr>
    <tr>
        <th id="th">Oncogen HER2:</th>
        <td id="td"><?php echo $dataRegistro['oncogenher2rgd'] ?></td>
    </tr>
    <tr>
        <th id="th">Fish:</th>
        <td id="td"><?php echo $dataRegistro['fishrgd'] ?></td>
    </tr>
    
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosinmunomamaiz();" <?php } }?>>        
    
    <div class="containerr3">Inmunohistoquimica mama izquierda</div>
        <tr>
        <th id="th">Receptores de estrogenos (RE):</th>
        <td id="td"><?php echo $dataRegistro['receptoresestrogenosiz']?>
        </td>
    </tr>
    <tr>
        <th id="th">Receptores de progesterona (RP):</th>
        <td id="td"><?php echo $dataRegistro['receptoresprogesteronaiz'] ?></td>
    </tr>
    <tr>
        <th id="th">KI-67:</th>
        <td id="td"><?php echo $dataRegistro['ki67iz'] ?></td>
    </tr>
    <tr>
        <th id="th">P 53:</th>
        <td id="td"><?php echo $dataRegistro['p53iz'] ?></td>
    </tr>
    <tr>
        <th id="th">Triple negativo:</th>
        <td id="td"><?php echo $dataRegistro['triplenegativoiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Aplico PDL:</th>
        <td id="td"><?php echo $dataRegistro['aplicopdliz'] ?></td>
    </tr>
    <tr>
        <th id="th">PDL:</th>
        <td id="td"><?php echo $dataRegistro['descripcionpdliz'] ?></td>
    </tr>
    <tr>
        <th id="th">Oncogen HER2:</th>
        <td id="td"><?php echo $dataRegistro['oncogenher2iz'] ?></td>
    </tr>
    <tr>
        <th id="th">Fish:</th>
        <td id="td"><?php echo $dataRegistro['fishiz'] ?></td>
    </tr></table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosinmunorgimamaiz();" <?php } }?>>        
    
    <div class="containerr3">Inmunohistoquimica Region ganglionar mama izquierda</div>
        <tr>
        <th id="th">Receptores de estrogenos (RE):</th>
        <td id="td"><?php echo $dataRegistro['receptoresestrogenosrgiz']?>
        </td>
    </tr>
    <tr>
        <th id="th">Receptores de progesterona (RP):</th>
        <td id="td"><?php echo $dataRegistro['receptoresprogesteronargiz'] ?></td>
    </tr>
    <tr>
        <th id="th">KI-67:</th>
        <td id="td"><?php echo $dataRegistro['ki67rgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">P 53:</th>
        <td id="td"><?php echo $dataRegistro['p53rgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Triple negativo:</th>
        <td id="td"><?php echo $dataRegistro['triplenegativorgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Aplico PDL:</th>
        <td id="td"><?php echo $dataRegistro['aplicopdlrgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">PDL:</th>
        <td id="td"><?php echo $dataRegistro['descripcionpdlrgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Oncogen HER2:</th>
        <td id="td"><?php echo $dataRegistro['oncogenher2rgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Fish:</th>
        <td id="td"><?php echo $dataRegistro['fishrgiz'] ?></td>
    </tr></table>
    
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editarmolecularmamaderecha();" <?php } }?>>        
    
    <div class="containerr3">Molecular mama derecha</div>
    <tr>
        <th id="th">Luminal A:</th>
        <td id="td"><?php echo $dataRegistro['luminala'] ?></td>
    </tr>
    <tr>
        <th id="th">Luminal B:</th>
        <td id="td"><?php echo $dataRegistro['luminalb'] ?></td>
    </tr>
    <tr>
        <th id="th">Enriquecido HER 2:</th>
        <td id="td"><?php echo $dataRegistro['enriquecidoher2'] ?></td>
    </tr>
    <tr>
        <th id="th">Basal:</th>
        <td id="td"><?php echo $dataRegistro['basal'] ?></td>
    </tr>
   
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        
    
    <div class="containerr3">Molecular Region ganglionar mama derecha</div>
    <tr>
        <th id="th">Luminal A:</th>
        <td id="td"><?php echo $dataRegistro['luminalargd'] ?></td>
    </tr>
    <tr>
        <th id="th">Luminal B:</th>
        <td id="td"><?php echo $dataRegistro['luminalbrgd'] ?></td>
    </tr>
    <tr>
        <th id="th">Enriquecido HER 2:</th>
        <td id="td"><?php echo $dataRegistro['enriquecidoher2rgd'] ?></td>
    </tr>
    <tr>
        <th id="th">Basal:</th>
        <td id="td"><?php echo $dataRegistro['basalrgd'] ?></td>
    </tr>
   
    </table>
    
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editarmolecularmamaizquierda();" <?php } }?>>        
    
    <div class="containerr3">Molecular mama izquierda</div>
        <tr>
        <th id="th">Luminal A:</th>
        <td id="td"><?php echo $dataRegistro['luminalaiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Luminal B:</th>
        <td id="td"><?php echo $dataRegistro['luminalbiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Enriquecido HER 2:</th>
        <td id="td"><?php echo $dataRegistro['enriquecidoher2iz'] ?></td>
    </tr>
    <tr>
        <th id="th">Basal:</th>
        <td id="td"><?php echo $dataRegistro['basaliz'] ?></td>
    </tr>
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        
    
    <div class="containerr3">Molecular Region ganglionar mama izquierda</div>
        <tr>
        <th id="th">Luminal A:</th>
        <td id="td"><?php echo $dataRegistro['luminalargiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Luminal B:</th>
        <td id="td"><?php echo $dataRegistro['luminalbrgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Enriquecido HER 2:</th>
        <td id="td"><?php echo $dataRegistro['enriquecidoher2rgiz'] ?></td>
    </tr>
    <tr>
        <th id="th">Basal:</th>
        <td id="td"><?php echo $dataRegistro['basalrgiz'] ?></td>
    </tr>
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatostratamiento();" <?php } }?>>        
    
    <div class="containerr3" >Tratamiento</div>
    
    <tr>
    <th id="th">Quirurgico:</th>
    <td id="td"><?php echo $dataRegistro['realizoquirurgico'] ?></td>
    </tr>
    <tr>
        <th id="th">Lateralidad:</th>
        <td id="td"><?php echo $dataRegistro['lateralidad'] ?></td>
    </tr>

    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editardatosmastectomia();" <?php } }?>>        

    <div class="containerr3">Mastectomia</div>
    <tr>
        <th id="th">Tipo mastectomia:</th>
        <td id="td"><?php echo $dataRegistro['tipomastecto'] ;?>
        </td>
    </tr>
    <tr>
        <th id="th">Fecha:</th>
        <td id="td"><?php echo $dataRegistro['fecha_mastecto'] ?></td>
    </tr>
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        
    <div class="containerr3">Ganglionar</div>
    <tr>
        <th id="th">Tipo ganglionar:</th>
        <td id="td"><?php echo $dataRegistro['tipoganglionar'] ;?>
        </td>
    </tr>
    <tr>
        <th id="th">Fecha:</th>
        <td id="td"><?php echo $dataRegistro['fechatipogaglionar']?></td>
    </tr>
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        

    <div class="containerr3">Reconstrucción mastectomia</div>
    <tr>
        <th id="th">Reconstruccion:</th>
        <td id="td"><?php echo $dataRegistro['reconstruccion'];?>
        </td>
    </tr>
    <tr>
        <th id="th">Tipo reconstruccion:</th>
        <td id="td"><?php echo $dataRegistro['tiporeconstruccion'] ?></td>
    </tr>
    <tr>
        <th id="th">Fecha:</th>
        <td id="td"><?php echo $dataRegistro['fecha'] ?></td>
    </tr>
    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editaradioterapia();" <?php } }?>>        
    
    <div class="containerr3">Radioterapia</div>
    <tr>
        <th id="th">Se aplico radioterapia:</th>
        <td id="td"><?php echo $dataRegistro['aplicoradio'];?>
        </td>
    </tr>
    <tr>
        <th id="th">Tipo radioterapia:</th>
        <td id="td"><?php echo $dataRegistro['decripcionradio']?></td>
    </tr>
    <tr>
        <th id="th">Fecha de incio de radioterapia:</th>
        <td id="td"><?php echo $dataRegistro['fecharadio']?></td>
    </tr>
    <tr>
        <th id="th">N° de sesiones:</th>
        <td id="td"><?php echo $dataRegistro['numerodesesiones']?></td>
    </tr></table>

    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%" <?php if (isset($_SESSION['usuarioAdmin'])) { if($dataRegistro['editopaciente'] == 1 ) { ?> onclick="editarquimioterapia();" <?php } }?>>        
    
    <div class="containerr3">Quimioterapia</div>
    <tr>
        <th id="th">Se aplico quimioterapia:</th>
        <td id="td"><?php echo $dataRegistro['aplicoquimio'];?>
        </td>
    </tr>
    <tr>
        <th id="th">Fecha:</th>
        <td id="td"><?php echo $dataRegistro['fechainicio'];?></td>
    </tr>
    <tr>
        <th id="th">1ra linea QT</th>
        <td id="td"><?php echo $dataRegistro['primeralinea'];?></td>
    </tr>
    <tr>
        <th id="th">Ciclos 1ra linea</th>
        <td id="td"><?php echo $dataRegistro['ciclosprimerlineaqt'];?></td>
    </tr>
    <tr>
        <th id="th">2da linea QT</th>
        <td id="td"><?php echo $dataRegistro['segundalinea'];?></td>
    </tr>
    <tr>
        <th id="th">Ciclos 2da linea</th>
        <td id="td"><?php echo $dataRegistro['ciclossegundalineaqt'];?></td>
    </tr>
    <tr>
        <th id="th">Antraciclinas</th>
        <td id="td"><?php echo $dataRegistro['antraciclinas'];?></td>
    </tr>
    <tr>
        <th id="th">Momento de la QT:</th>
        <td id="td"><?php echo $dataRegistro['momentodelaqt'];?></td>
    </tr>
    <tr>
        <th id="th">Hormonoterapia:</th>
        <td id="td"><?php echo $dataRegistro['hormonoterapia'];?></td>
    </tr>
    <tr>
        <th id="th">Tipo hormonoterapia:</th>
        <td id="td"><?php echo $dataRegistro['tipohormonoterapia'];?></td>
    </tr>
    <tr>
        <th id="th">Momento hormonoterapia:</th>
        <td id="td"><?php echo $dataRegistro['momentohormonoterapia'];?></td>
    </tr>
    <tr>
        <th id="th">Her 2++</th>
        <td id="td"><?php echo $dataRegistro['her2'];?></td>
    </tr>
    <tr>
        <th id="th">Esquema Her 2++</th>
        <td id="td"><?php echo $dataRegistro['esquemaher2'];?></td>
    </tr>
    <tr>
        <th id="th">Triple negativo:</th>
        <td id="td"><?php echo $dataRegistro['triplenegativo']; ?></td>
    </tr>
    <tr>
        <th id="th">Esquema triple negativo:</th>
        <td id="td"><?php echo $dataRegistro['esquematrilpenegativo']; ?></td>
    </tr>
    <tr>
        <th id="th">Hormonosensible:</th>
        <td id="td"><?php echo $dataRegistro['hormonosensible']; ?></td>
    </tr>
    <tr>
        <th id="th">Esquema hormonosensible:</th>
        <td id="td"><?php echo $dataRegistro['esquemahormonosensible']; ?></td>
    </tr>
    <tr>
        <th id="th">Tipo tratameinto:</th>
        <td id="td"><?php echo $dataRegistro['tipotratamiento']; ?></td>
    </tr>
    <tr>
        <th id="th">Completo quimio:</th>
        <td id="td"><?php echo $dataRegistro['completoquimio']; ?></td>
    </tr>
    <tr>
        <th id="th">Causa quimio incompleta:</th>
        <td id="td"><?php echo $dataRegistro['causaqtincompleta']; ?></td>
    </tr>
    <tr>
        <th id="th">Fecha evento adverso:</th>
        <td id="td"><?php echo $dataRegistro['fechaeventoadverso']; ?></td>
    </tr>
    <tr>
        <th id="th">Fecha progresión:</th>
        <td id="td"><?php echo $dataRegistro['fechaprogresion']; ?></td>
    </tr>
    <tr>
        <th id="th">Fecha recurrencia:</th>
        <td id="td"><?php echo $dataRegistro['fecharecurrencia']; ?></td>
    </tr>
    <tr>
        <th id="th">Fecha fallecio:</th>
        <td id="td"><?php echo $dataRegistro['fechafallecio']; ?></td>
    </tr>
    <tr>
        <th id="th">Causa fallecio:</th>
        <td id="td"><?php echo $dataRegistro['causafallecio']; ?></td>
    </tr>
    <tr>
        <th id="th">Especifique:</th>
        <td id="td"><?php echo $dataRegistro['especifique']; ?></td>
    </tr>

    </table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        
    
    <div class="containerr3">Braquiterapia</div>
    <tr>
        <th id="th">Se aplico braquiterapia:</th>
        <td id="td"><?php echo $dataRegistro['aplicobraquiterapia'];?>
        </td>
    </tr>
    <tr>
        <th id="th">Fecha:</th>
        <td id="td"><?php echo $dataRegistro['fechabraquiterapia']?></td>
    </tr></table>
    <table  class="table table-responsive  table-bordered " cellspacing="0" width="100%">        
    
    <div class="containerr3">Defunción paciente</div>
    <tr>
        <th id="th">Defunción Paciente:</th>
        <td id="td"><?php echo $dataRegistro['defuncion'];?>
        </td>
    </tr>
    <tr>
        <th id="th">Fecha:</th>
        <td id="td"><?php echo $dataRegistro['fechadefuncion']?></td>
    </tr>
    <tr>
        <th id="th">Causa defunción:</th>
        <td id="td"><?php echo $dataRegistro['causadefuncion']?></td>
    </tr>

</table>
</div>
<?php

require 'modals/editarDatosPaciente.php';
?>
<script>
function eliminarRegistro() {
    var id = $("#idcurp").val();
    var cancer = $("#cancer").val();
    var nombrepaciente = $("#nombrepaciente").val();
    var mensaje = confirm("el registro se eliminara");
    let parametros = {
        id: id, cancer:cancer, nombrepaciente:nombrepaciente
    }
    if (mensaje == true) {
        $.ajax({
            data: parametros,
            url: 'aplicacion/eliminarRegistroCancer.php',
            type: 'post',
            beforeSend: function() {
                $("#mensaje").html("Procesando, espere por favor");
            },
            success: function(response) {
                $("#mensaje").html(response);
                $("#tabla_resultadobus").load('consultacancerdemama.php');
                $("#tabla_resultado").load('consultaCancerdeMamaBusqueda.php');

            }
        });
    } else {
        swal({
            title: 'Cancelado!',
            text: 'Proceso cancelado',
            icon: 'warning',

        });
    }
}
function editardatos() {

$("#editarDatosPersonalescancerdeMama").modal('show');
}
function editardatoscancer() {

$("#editarDatosCancer").modal('show');
}
function editardatospersonalespatologicos(){
  $("#editarDatosPersonalesPatologicos").modal('show');
}
function editardatosantecedentesgineco(){
  $("#editarDatosAntecedentesGineco").modal('show');
}
function editardatosatencionclinica(){
  $("#editarDatosAtencionClinica").modal('show');
}
function editardatosreferencia(){
  $("#editarDatosReferencia").modal('show');
}
function editardatoshistopatomamaderecha(){
  $("#editarDatosHistopatologiaMamaDer").modal('show');
}
function editardatoshistopatorgmamader() {
    $("#editarDatosRgMamaDer").modal('show');
    
}
function editardatoshistopatomamaiz(){
    $("#editarDatosMamaIz").modal('show');
}
function editardatoshistopatorgmamaiz() {
    $("#editarDatosRgmamaIz").modal('show');
    
}
function editardatosinmunomamaderecha() {
    $("#editarInmunohistoMamaDer").modal('show');
}
function editardatosinmunorgdmamaderecha() {
    $("#editarInmunohistorgdMamaDer").modal('show');
}
function editardatosinmunomamaiz() {
    $("#editarInmunohistoMamaIz").modal('show');
}
function editardatosinmunorgimamaiz(){
    $("#editarInmunohistoRgizMamaIz").modal('show');
}
function editarquimioterapia() {
    $("#editardatosQuimio").modal('show');
}
function editaradioterapia() {
    $("#editardatosRadioterapia").modal('show');
}
function editarmolecularmamaderecha() {
    $("#editardatosMolecular").modal('show');
}
function editarmolecularmamaizquierda() {
    $("#editardatosMolecularMamaIz").modal('show');
}
function editardatostratamiento() {
    $("#editardatostratamiento").modal('show');
}
function editardatosmastectomia() {
    $("#editardatosmastectomia").modal('show');
}
function editarRegistro(){
        var id = $("#idcurp").val();
    var cancer = $("#cancer").val();
    var nombrepaciente = $("#nombrepaciente").val();
    var mensaje = confirm("Desea continuar con la edición de los datos");
    let parametros = {
        id: id, cancer:cancer, nombrepaciente:nombrepaciente
    }
            if(mensaje == true){
                $.ajax({
            data: parametros,
            url: 'aplicacion/editarRegistroCancer.php',
            type: 'post',
            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#idcurp").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            
                                                            
                                                            }
                                                            
                                                    });
                                                
                                            }
        });
            }else{
                alert('proceso cancelado')
            }
    }
    function finalizarEdicion(){
        var id = $("#idcurp").val();
    var cancer = $("#cancer").val();
    var nombrepaciente = $("#nombrepaciente").val();
    var mensaje = confirm("Desea finalizar con la edición de los datos");
    let parametros = {
        id: id, cancer:cancer, nombrepaciente:nombrepaciente
    }
            if(mensaje == true){
                $.ajax({
            data: parametros,
            url: 'aplicacion/finalizarEdicion.php',
            type: 'post',
        
            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#idcurp").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            
                                                            
                                                            }
                                                            
                                                    });
                                                
                                            }
        });
            }else{
                alert('proceso cancelado')
            }
    }
</script>

