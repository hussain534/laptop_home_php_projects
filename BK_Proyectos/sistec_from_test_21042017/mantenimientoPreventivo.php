<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    /*if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }
    else
    {
        include_once('util.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time();*/
    include_once('util.php');

    include_once('menuPanel.php');
    $message='';
    if(isset($_SESSION["message"])) 
    {
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    if(isset($_POST['submitted']))
    {
        //echo 'id:'.$_POST["id"].'<br>';
        $updStatus = $controller->updateReport2($databasecon,$_POST["id"],$_POST["responsable"],$_POST["cargo"],
            $_POST["nombre_hostpital"],$_POST["pais"],$_POST["telefono"],$_POST["dir_fisica"],
            $_POST["rep_ventas"],$_POST["fecha_instalacion"],$_POST["fecha_problema"],$_POST["horas_uso"],
            $_POST["software_version"],$_POST["codigo_error"],$_POST["garantia"],$_POST["reportado_por"],
            $_POST["maquina_tipo"],$_POST["detalle"],$_POST["turnos_dia"],$_POST["fecha_ultimo_mantenimiento"],
            $_POST["freq_desinf"],$_POST["freq_desinc"],$_POST["oper_equipo"],$_POST["condicion_externa"],
            $_POST["sistemas_elec"],$_POST["verif_param"],$_POST["sistema_hidra"],$_POST["verif_func"],
            $_POST["sistema_apoyo"],$_POST["obser"],$_POST["nombre_recibe"],$_POST["hora_inicio"],$_POST["hora_final"],$_POST["fecha_act"],$_POST["equipo_apto"],$DEBUG_STATUS);
        //echo 'updStatus:'.$updStatus.'<br>';
        if($updStatus==0)
            $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";
        else
            $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";
    }
    


    $peticionId=0;
    if(isset($_GET["peticion"]))
        $peticionId=$_GET["peticion"];
    //echo 'peticionId:'.$peticionId.'<br>';
    $reportDtl = $controller->getReport2($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionHist = $controller->getPeticionComments2($databasecon,$peticionId,$DEBUG_STATUS);
    $peticionDtl = $controller->getPeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
    $cur_date = $controller->getCurDate($databasecon,$DEBUG_STATUS);
    $modelo="";
    $serie="";
    $created_by="";
    if(isset($peticionHist[0][7]))
        $modelo=$peticionHist[0][7];
    if(isset($peticionHist[0][6]))
        $serie=$peticionHist[0][6];
    if(isset($peticionHist[0][2]))
        $created_by=$peticionHist[0][2];
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2 sidebar">
            <?php include_once('menu.php');?>
        </div>
        <div class="col-sm-10">



            <div class="row">
                <div class="col-sm-12">
                    <?php include_once('mysession.php');?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page_title">GENERAR REPORTE - MANTENIMIENTO PREVENTIVO</h2>                    
                </div>
            </div>
            <br>
            <?php 
                if(isset($message) && strcmp($message, '')!=0)
                {
            ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="errblock">
                            <?php echo $message;?>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            <br>
            <?php
                include_once('cabeceraReporte.php');
            ?>
            <br>
            <form action="mantenimientoPreventivo.php?peticion=<?php echo $peticionId;?>" method="post">
                <input type="hidden" name="submitted" value="true">
                <input type="hidden" name="id" value="<?php echo $reportDtl[0][1];?>">
                
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="user_name">CLIENTE:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionDtl[0][2];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="responsable">RESPONSABLE:</label>
                        <input type="text" class="form-control bg_lightgreen" id="responsable" name="responsable" value="<?php echo $reportDtl[0][3];?>" required>
                        <div class="errmsg" id="error_responsable"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="cargo">CARGO:</label>
                        <input type="text" class="form-control bg_lightgreen" id="cargo" name="cargo" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="error_cargo"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="nombre_hostpital">NOMBRE DE HOSPITAL:</label>
                        <input type="text" class="form-control bg_lightgreen" id="nombre_hostpital" name="nombre_hostpital" value="<?php echo $reportDtl[0][5];?>" required>
                        <div class="errmsg" id="error_nombre_hostpital"></div>
                    </div>
                    <div class="col-sm-6">                         
                        <label for="telefono">TELEFONO:</label>
                        <input type="text" class="form-control bg_lightgreen" id="telefono" name="telefono" value="<?php echo $reportDtl[0][7];?>" required>
                        <div class="errmsg" id="error_telefono"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="color:#f5f5f5;">
                        <label for="dir_fisica">DIRECCION FISICA:</label>
                        <input type="text" class="form-control bg_lightgreen" id="dir_fisica" name="dir_fisica" value="<?php echo $reportDtl[0][8];?>" required>
                        <div class="errmsg" id="error_dir_fisica"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="pais">PAIS:</label>
                        <input type="text" class="form-control" id="pais" name="pais" value="ECUADOR" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_pais"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="rep_ventas">REP.VENTAS / DISTRI.:</label>
                        <input type="text" class="form-control bg_lightgreen" id="rep_ventas" name="rep_ventas" value="<?php echo $reportDtl[0][9];?>" required>
                        <div class="errmsg" id="error_rep_ventas"></div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <h4>IDENTIFICACION DEL EQUIPO</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="rep_ciclos">MODELO:</label>
                        <input type="text" class="form-control" id="rep_ciclos" value="<?php echo $modelo;?>"  style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_rep_ciclos"></div>
                    </div>
                    <div class="col-sm-6 text-left">
                        <label for="rep_ciclos">SERIE:</label>
                        <input type="text" class="form-control" id="rep_ciclos" value="<?php echo $serie;?>"  style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_rep_ciclos"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="desc_peticion">BREVE DESCRIPCION DEL INCIDENTE O REPORTE:</label>
                        <textarea class="form-control" id="desc_peticion" rows="10" style="background: lightgrey;" readonly="true"><?php echo $peticionDtl[0][6];?></textarea> 
                        <div class="errmsg" id="error_desc_peticion"></div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="fecha_instalacion">FECHA DE INSTALACION:</label>
                        <input type="date" name="fecha_instalacion" id="fecha_instalacion" class="form-control bg_lightgreen" value="<?php echo $reportDtl[0][10];?>" required>
                        <div class="errmsg" id="error_fecha_instalacion"></div>
                    </div>
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="fecha_problema">FECHA DEL PROBLEMA:</label>
                        <input type="date" name="fecha_problema" id="fecha_problema" class="form-control bg_lightgreen" value="<?php echo $reportDtl[0][11];?>" required>
                        <div class="errmsg" id="error_fecha_problema"></div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="horas_uso">HORAS_DE_USO:</label>
                        <input type="text" class="form-control bg_lightgreen" id="horas_uso" name="horas_uso" value="<?php echo $reportDtl[0][12];?>" required>
                        <div class="errmsg" id="error_horas_uso"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="software_version">VERSION SW:</label>
                        <input type="text" class="form-control bg_lightgreen" id="software_version" name="software_version" value="<?php echo $reportDtl[0][13];?>" required>
                        <div class="errmsg" id="error_software_version"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="codigo_error">CODIGO/ERROR:</label>
                        <input type="text" class="form-control bg_lightgreen" id="codigo_error" name="codigo_error" value="<?php echo $reportDtl[0][14];?>" required>
                        <div class="errmsg" id="error_codigo_error"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="turnos_dia">TURNOS POR DIA</label>
                        <select name="turnos_dia" class="form-control bg_lightgreen" id="turnos_dia" required>
                            <?php 
                            if($reportDtl[0][19]==1)
                            {
                            ?>
                            <option value="1" selected="true">1-2</option>
                            <option value="2">3-4</option>
                            <option value="3">MAS DE 4</option>
                            <option value="4">CONT.</option>
                            <?php
                            }
                            else if($reportDtl[0][19]==2)
                            {
                            ?>
                            <option value="1">1-2</option>
                            <option value="2" selected="true">3-4</option>
                            <option value="3">MAS DE 4</option>
                            <option value="4">CONT.</option>
                            <?php
                            }
                            else if($reportDtl[0][19]==3)
                            {
                            ?>
                            <option value="1">1-2</option>
                            <option value="2">3-4</option>
                            <option value="3" selected="true">MAS DE 4</option>
                            <option value="4">CONT.</option>
                            <?php
                            }
                            else if($reportDtl[0][19]==4)
                            {
                            ?>
                            <option value="1">1-2</option>
                            <option value="2">3-4</option>
                            <option value="3">MAS DE 4</option>
                            <option value="4" selected="true">CONT.</option>
                            <?php
                            }
                            else if($reportDtl[0][19]==0)
                            {
                            ?>
                            <option value="1">1-2</option>
                            <option value="2">3-4</option>
                            <option value="3">MAS DE 4</option>
                            <option value="4">CONT.</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_turnos_dia"></div>
                    </div>
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="sala">NUMERO / SALA:</label>
                        <input type="text" class="form-control" id="sala" name="sala" value="<?php echo $peticionDtl[0][5];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_sala"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="garantia">GARANTIA</label>
                        <select name="garantia" class="form-control bg_lightgreen" id="garantia" required>
                            <?php 
                            if($reportDtl[0][15]==1)
                            {
                            ?>
                            <option value="1" selected="true">SI</option>
                            <option value="2">NO</option>
                            <option value="3">NA</option>
                            <?php
                            }
                            else if($reportDtl[0][15]==2)
                            {
                            ?>
                            <option value="1">SI</option>
                            <option value="2" selected="true">NO</option>
                            <option value="3">NA</option>
                            <?php
                            }
                            else if($reportDtl[0][15]==3)
                            {
                            ?>
                            <option value="1">SI</option>
                            <option value="2">NO</option>
                            <option value="3" selected="true">NA</option>
                            <?php
                            }
                            else if($reportDtl[0][15]==0)
                            {
                            ?>
                            <option value="1" selected="true">SI</option>
                            <option value="2">NO</option>
                            <option value="3">NA</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_garantia"></div>
                    </div>
                     <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="reportado_por">REPORTADO POR:</label>
                        <input type="text" class="form-control bg_lightgreen" id="reportado_por" name="reportado_por" value="<?php echo $peticionDtl[0][11];?>" required>
                        <div class="errmsg" id="error_reportado_por"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="maquina_tipo">MAQUINA TIPO</label>
                        <select name="maquina_tipo" class="form-control bg_lightgreen" id="maquina_tipo" required>
                            <?php 
                            if($reportDtl[0][17]==1)
                            {
                            ?>
                            <option value="1" selected="true">NEGATIVA</option>
                            <option value="2">POSITIVA</option>
                            <?php
                            }
                            else if($reportDtl[0][17]==2)
                            {
                            ?>
                            <option value="1">NEGATIVA</option>
                            <option value="2" selected="true">POSITIVA</option>
                            <?php
                            }
                            else if($reportDtl[0][17]==0)
                            {
                            ?>
                            <option value="1">NEGATIVA</option>
                            <option value="2" selected="true">POSITIVA</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_maquina_tipo"></div>
                    </div>
                     <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="detalle">DETALLE</label>
                        <select name="detalle" class="form-control bg_lightgreen" id="detalle" required>
                            <?php 
                            if($reportDtl[0][18]==1)
                            {
                            ?>
                            <option value="1" selected="true">SALA</option>
                            <option value="2">UCI</option>
                            <option value="3">AMBULANCIA</option>
                            <?php
                            }
                            else if($reportDtl[0][18]==2)
                            {
                            ?>
                            <option value="1">SALA</option>
                            <option value="2" selected="true">UCI</option>
                            <option value="3">AMBULANCIA</option>
                            <?php
                            }
                            else if($reportDtl[0][18]==3)
                            {
                            ?>
                            <option value="1">SALA</option>
                            <option value="2">UCI</option>
                            <option value="3" selected="true">AMBULANCIA</option>
                            <?php
                            }
                            else if($reportDtl[0][18]==0)
                            {
                            ?>
                            <option value="1" selected="true">SALA</option>
                            <option value="2">UCI</option>
                            <option value="3">AMBULANCIA</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_detalle"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="fecha_ultimo_mantenimiento">FECHA DE ULTIMO MANTENIMIENTO:</label><div class="errorMsg" id="text_size"></div>
                        <input type="date" id="fecha_ultimo_mantenimiento" name="fecha_ultimo_mantenimiento" value="<?php echo $reportDtl[0][20];?>" class="form-control bg_lightgreen" required>
                        <div class="errmsg" id="error_fecha_ultimo_mantenimiento"></div>
                    </div>
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="peticion_id">REPORTE TECNICO NO::</label>
                        <input type="text" class="form-control" id="peticion_id" value="<?php echo $peticionId;?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_peticion_id"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="freq_desinf">FREQUENCIA DE DESINFECCION</label>
                        <select name="freq_desinf" class="form-control bg_lightgreen" id="freq_desinf" required>
                            <?php 
                            if($reportDtl[0][21]==1)
                            {
                            ?>
                            <option value="1" selected="true">DIARIA</option>
                            <option value="2">INTERDIALISIS</option>
                            <option value="0">NINGUNA</option>
                            <?php
                            }
                            else if($reportDtl[0][21]==2)
                            {
                            ?>
                            <option value="1">DIARIA</option>
                            <option value="2" selected="true">INTERDIALISIS</option>
                            <option value="0">NINGUNA</option>
                            <?php
                            }
                            else if($reportDtl[0][21]==0)
                            {
                            ?>
                            <option value="1">DIARIA</option>
                            <option value="2">INTERDIALISIS</option>
                            <option value="0" selected="true">NINGUNA</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_freq_desinf"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="freq_desinc">FREQUENCIA DE LA DESINCRUSTACION</label>
                        <select name="freq_desinc" class="form-control bg_lightgreen" id="freq_desinc" required>
                            <?php 
                            if($reportDtl[0][22]==1)
                            {
                            ?>
                            <option value="1" selected="true">DIARIA</option>
                            <option value="2">SEMANAL</option>
                            <option value="0">NINGUNA</option>
                            <?php
                            }
                            else if($reportDtl[0][22]==2)
                            {
                            ?>
                            <option value="1">DIARIA</option>
                            <option value="2" selected="true">SEMANAL</option>
                            <option value="0">NINGUNA</option>
                            <?php
                            }
                            else if($reportDtl[0][22]==0)
                            {
                            ?>
                            <option value="1">DIARIA</option>
                            <option value="2">SEMANAL</option>
                            <option value="0" selected="true">NINGUNA</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_freq_desinc"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="oper_equipo">OPERATIVIDAD GENERAL DEL EQUIPO</label>
                        <select name="oper_equipo" class="form-control bg_lightgreen" id="oper_equipo" required>
                            <?php 
                            if($reportDtl[0][23]==1)
                            {
                            ?>
                            <option value="1" selected="true">FUNCIONANDO</option>
                            <option value="2">FALLAS DEL SISTEMA</option>
                            <?php
                            }
                            else if($reportDtl[0][23]==2)
                            {
                            ?>
                            <option value="1">FUNCIONANDO</option>
                            <option value="2" selected="true">FALLAS DEL SISTEMA</option>
                            <?php
                            }
                            else if($reportDtl[0][23]==0)
                            {
                            ?>
                            <option value="1" selected="true">FUNCIONANDO</option>
                            <option value="2">FALLAS DEL SISTEMA</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_oper_equipo"></div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <h4>INSPECCION</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="oper_equipo">CONDICION EXTERNA</label>
                        <select name="condicion_externa" class="form-control bg_lightgreen" id="condicion_externa" required>
                            <?php 
                            if($reportDtl[0][24]==1)
                            {
                            ?>
                            <option value="1" selected="true">Conexión de tuberias</option>
                            <option value="2">Fugas y Goteos</option>
                            <option value="3">Daños estructurales</option>
                            <option value="4">Detección de Oxido y corrosion</option>
                            <option value="5">Ruedas de transporte</option>
                            <?php
                            }
                            else if($reportDtl[0][24]==2)
                            {
                            ?>
                            <option value="1">Conexión de tuberias</option>
                            <option value="2" selected="true">Fugas y Goteos</option>
                            <option value="3">Daños estructurales</option>
                            <option value="4">Detección de Oxido y corrosion</option>
                            <option value="5">Ruedas de transporte</option>
                            <?php
                            }
                            else if($reportDtl[0][24]==3)
                            {
                            ?>
                            <option value="1">Conexión de tuberias</option>
                            <option value="2">Fugas y Goteos</option>
                            <option value="3" selected="true">Daños estructurales</option>
                            <option value="4">Detección de Oxido y corrosion</option>
                            <option value="5">Ruedas de transporte</option>
                            <?php
                            }
                            else if($reportDtl[0][24]==4)
                            {
                            ?>
                            <option value="1">Conexión de tuberias</option>
                            <option value="2">Fugas y Goteos</option>
                            <option value="3">Daños estructurales</option>
                            <option value="4" selected="true">Detección de Oxido y corrosion</option>
                            <option value="5">Ruedas de transporte</option>
                            <?php
                            }
                            else if($reportDtl[0][24]==5)
                            {
                            ?>
                            <option value="1">Conexión de tuberias</option>
                            <option value="2">Fugas y Goteos</option>
                            <option value="3">Daños estructurales</option>
                            <option value="4">Detección de Oxido y corrosion</option>
                            <option value="5" selected="true">Ruedas de transporte</option>
                            <?php
                            }
                            else if($reportDtl[0][24]==0)
                            {
                            ?>
                            <option value="1" selected="true">Conexión de tuberias</option>
                            <option value="2">Fugas y Goteos</option>
                            <option value="3">Daños estructurales</option>
                            <option value="4">Detección de Oxido y corrosion</option>
                            <option value="5">Ruedas de transporte</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_condicion_externa"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="sistemas_elec">SISTEMAS ELECTRONICOS</label>
                        <select name="sistemas_elec" class="form-control bg_lightgreen" id="sistemas_elec" required>
                            <?php 
                            if($reportDtl[0][25]==1)
                            {
                            ?>
                            <option value="1" selected="true">Cable de alimentación electrica</option>
                            <option value="2">Toma corriente y bateria de respaldo</option>
                            <option value="3">Tarjetas de control</option>
                            <option value="4">Sensores y sistemas</option>
                            <option value="5">Corriente de fuga</option>
                            <?php
                            }
                            else if($reportDtl[0][25]==2)
                            {
                            ?>
                            <option value="1">Cable de alimentación electrica</option>
                            <option value="2" selected="true">Toma corriente y bateria de respaldo</option>
                            <option value="3">Tarjetas de control</option>
                            <option value="4">Sensores y sistemas</option>
                            <option value="5">Corriente de fuga</option>
                            <?php
                            }
                            else if($reportDtl[0][25]==3)
                            {
                            ?>
                            <option value="1">Cable de alimentación electrica</option>
                            <option value="2">Toma corriente y bateria de respaldo</option>
                            <option value="3" selected="true">Tarjetas de control</option>
                            <option value="4">Sensores y sistemas</option>
                            <option value="5">Corriente de fuga</option>
                            <?php
                            }
                            else if($reportDtl[0][25]==4)
                            {
                            ?>
                            <option value="1">Cable de alimentación electrica</option>
                            <option value="2">Toma corriente y bateria de respaldo</option>
                            <option value="3">Tarjetas de control</option>
                            <option value="4" selected="true">Sensores y sistemas</option>
                            <option value="5">Corriente de fuga</option>
                            <?php
                            }
                            else if($reportDtl[0][25]==5)
                            {
                            ?>
                            <option value="1">Cable de alimentación electrica</option>
                            <option value="2">Toma corriente y bateria de respaldo</option>
                            <option value="3">Tarjetas de control</option>
                            <option value="4">Sensores y sistemas</option>
                            <option value="5" selected="true">Corriente de fuga</option>
                            <?php
                            }
                            else if($reportDtl[0][25]==0)
                            {
                            ?>
                            <option value="1" selected="true">Cable de alimentación electrica</option>
                            <option value="2">Toma corriente y bateria de respaldo</option>
                            <option value="3">Tarjetas de control</option>
                            <option value="4">Sensores y sistemas</option>
                            <option value="5">Corriente de fuga</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_sistemas_elec"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="verif_param">VERIFICACION DE PARAMETROS</label>
                        <select name="verif_param" class="form-control bg_lightgreen" id="verif_param" required>
                            <?php 
                            if($reportDtl[0][26]==1)
                            {
                            ?>
                            <option value="1" selected="true">Ajustes y activación de alarmas</option>
                            <option value="2">Verificación de lavados/desinfección</option>
                            <option value="3">Calibración de conductividad</option>
                            <option value="4">Calibración de temperatura</option>
                            <option value="5">Exactitud de UF/Pres. Ven/Pres. Art.</option>
                            <?php
                            }
                            else if($reportDtl[0][26]==2)
                            {
                            ?>
                            <option value="1">Ajustes y activación de alarmas</option>
                            <option value="2" selected="true">Verificación de lavados/desinfección</option>
                            <option value="3">Calibración de conductividad</option>
                            <option value="4">Calibración de temperatura</option>
                            <option value="5">Exactitud de UF/Pres. Ven/Pres. Art.</option>
                            <?php
                            }
                            else if($reportDtl[0][26]==3)
                            {
                            ?>
                            <option value="1">Ajustes y activación de alarmas</option>
                            <option value="2">Verificación de lavados/desinfección</option>
                            <option value="3" selected="true">Calibración de conductividad</option>
                            <option value="4">Calibración de temperatura</option>
                            <option value="5">Exactitud de UF/Pres. Ven/Pres. Art.</option>
                            <?php
                            }
                            else if($reportDtl[0][26]==4)
                            {
                            ?>
                            <option value="1">Ajustes y activación de alarmas</option>
                            <option value="2">Verificación de lavados/desinfección</option>
                            <option value="3">Calibración de conductividad</option>
                            <option value="4" selected="true">Calibración de temperatura</option>
                            <option value="5">Exactitud de UF/Pres. Ven/Pres. Art.</option>
                            <?php
                            }
                            else if($reportDtl[0][26]==5)
                            {
                            ?>
                            <option value="1">Ajustes y activación de alarmas</option>
                            <option value="2">Verificación de lavados/desinfección</option>
                            <option value="3">Calibración de conductividad</option>
                            <option value="4">Calibración de temperatura</option>
                            <option value="5" selected="true">Exactitud de UF/Pres. Ven/Pres. Art.</option>
                            <?php
                            }
                            else if($reportDtl[0][26]==0)
                            {
                            ?>
                            <option value="1" selected="true">Ajustes y activación de alarmas</option>
                            <option value="2">Verificación de lavados/desinfección</option>
                            <option value="3">Calibración de conductividad</option>
                            <option value="4">Calibración de temperatura</option>
                            <option value="5">Exactitud de UF/Pres. Ven/Pres. Art.</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_verif_param"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="sistema_hidra">SISTEMA HIDRAULICO</label>
                        <select name="sistema_hidra" class="form-control bg_lightgreen" id="sistema_hidra" required>
                            <?php 
                            if($reportDtl[0][27]==1)
                            {
                            ?>
                            <option value="1" selected="true">Limpieza e integridad</option>
                            <option value="2">PR1</option>
                            <option value="3">BLD</option>
                            <option value="4">PG</option>
                            <option value="5">Valvulas de control</option>
                            <?php
                            }
                            else if($reportDtl[0][27]==2)
                            {
                            ?>
                            <option value="1">Limpieza e integridad</option>
                            <option value="2" selected="true">PR1</option>
                            <option value="3">BLD</option>
                            <option value="4">PG</option>
                            <option value="5">Valvulas de control</option>
                            <?php
                            }
                            else if($reportDtl[0][27]==3)
                            {
                            ?>
                            <option value="1">Limpieza e integridad</option>
                            <option value="2">PR1</option>
                            <option value="3" selected="true">BLD</option>
                            <option value="4">PG</option>
                            <option value="5">Valvulas de control</option>
                            <?php
                            }
                            else if($reportDtl[0][27]==4)
                            {
                            ?>
                            <option value="1">Limpieza e integridad</option>
                            <option value="2">PR1</option>
                            <option value="3">BLD</option>
                            <option value="4" selected="true">PG</option>
                            <option value="5">Valvulas de control</option>
                            <?php
                            }
                            else if($reportDtl[0][27]==5)
                            {
                            ?>
                            <option value="1">Limpieza e integridad</option>
                            <option value="2">PR1</option>
                            <option value="3">BLD</option>
                            <option value="4">PG</option>
                            <option value="5" selected="true">Valvulas de control</option>
                            <?php
                            }
                            if($reportDtl[0][27]==0)
                            {
                            ?>
                            <option value="1" selected="true">Limpieza e integridad</option>
                            <option value="2">PR1</option>
                            <option value="3">BLD</option>
                            <option value="4">PG</option>
                            <option value="5">Valvulas de control</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_sistema_hidra"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="verif_func">VERIFICACION DE FUNCIONAMIENTO</label>
                        <select name="verif_func" class="form-control bg_lightgreen" id="verif_func" required>
                            <?php 
                            if($reportDtl[0][28]==1)
                            {
                            ?>
                            <option value="1" selected="true">Bomba de sangre</option>
                            <option value="2">Bomba de heparina</option>
                            <option value="3">Touch screen/teclado de pantalla</option>
                            <option value="4">Lampara indicadora de estado</option>
                            <option value="5">Simulación de tratamiento</option>
                            <?php
                            }
                            else if($reportDtl[0][28]==2)
                            {
                            ?>
                            <option value="1">Bomba de sangre</option>
                            <option value="2" selected="true">Bomba de heparina</option>
                            <option value="3">Touch screen/teclado de pantalla</option>
                            <option value="4">Lampara indicadora de estado</option>
                            <option value="5">Simulación de tratamiento</option>
                            <?php
                            }
                            else if($reportDtl[0][28]==3)
                            {
                            ?>
                            <option value="1">Bomba de sangre</option>
                            <option value="2">Bomba de heparina</option>
                            <option value="3" selected="true">Touch screen/teclado de pantalla</option>
                            <option value="4">Lampara indicadora de estado</option>
                            <option value="5">Simulación de tratamiento</option>
                            <?php
                            }
                            else if($reportDtl[0][28]==4)
                            {
                            ?>
                            <option value="1">Bomba de sangre</option>
                            <option value="2">Bomba de heparina</option>
                            <option value="3">Touch screen/teclado de pantalla</option>
                            <option value="4" selected="true">Lampara indicadora de estado</option>
                            <option value="5">Simulación de tratamiento</option>
                            <?php
                            }
                            else if($reportDtl[0][28]==5)
                            {
                            ?>
                            <option value="1">Bomba de sangre</option>
                            <option value="2">Bomba de heparina</option>
                            <option value="3">Touch screen/teclado de pantalla</option>
                            <option value="4">Lampara indicadora de estado</option>
                            <option value="5" selected="true">Simulación de tratamiento</option>
                            <?php
                            }
                            else if($reportDtl[0][28]==0)
                            {
                            ?>
                            <option value="1" selected="true">Bomba de sangre</option>
                            <option value="2">Bomba de heparina</option>
                            <option value="3">Touch screen/teclado de pantalla</option>
                            <option value="4">Lampara indicadora de estado</option>
                            <option value="5">Simulación de tratamiento</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_verif_func"></div>
                    </div>
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <label for="sistema_apoyo">SISTEMA DE APOYO / OPCIONES</label>
                        <select name="sistema_apoyo" class="form-control bg_lightgreen" id="sistema_apoyo" required>
                            <?php 
                            if($reportDtl[0][29]==1)
                            {
                            ?>
                            <option value="1" selected="true">BPM</option>
                            <option value="2">Filtro de endotoxinas</option>
                            <option value="3">Red de computo/LAN</option>
                            <option value="4">Documentación de soporte</option>
                            <option value="5">Verificación de uso/operador.</option>
                            <?php
                            }
                            else if($reportDtl[0][29]==2)
                            {
                            ?>
                            <option value="1">BPM</option>
                            <option value="2" selected="true">Filtro de endotoxinas</option>
                            <option value="3">Red de computo/LAN</option>
                            <option value="4">Documentación de soporte</option>
                            <option value="5">Verificación de uso/operador.</option>
                            <?php
                            }
                            else if($reportDtl[0][29]==3)
                            {
                            ?>
                            <option value="1">BPM</option>
                            <option value="2">Filtro de endotoxinas</option>
                            <option value="3" selected="true">Red de computo/LAN</option>
                            <option value="4">Documentación de soporte</option>
                            <option value="5">Verificación de uso/operador.</option>
                            <?php
                            }
                            else if($reportDtl[0][29]==4)
                            {
                            ?>
                            <option value="1">BPM</option>
                            <option value="2">Filtro de endotoxinas</option>
                            <option value="3">Red de computo/LAN</option>
                            <option value="4" selected="true">Documentación de soporte</option>
                            <option value="5">Verificación de uso/operador.</option>
                            <?php
                            }
                            else if($reportDtl[0][29]==5)
                            {
                            ?>
                            <option value="1">BPM</option>
                            <option value="2">Filtro de endotoxinas</option>
                            <option value="3">Red de computo/LAN</option>
                            <option value="4">Documentación de soporte</option>
                            <option value="5" selected="true">Verificación de uso/operador.</option>
                            <?php
                            }
                            else if($reportDtl[0][29]==0)
                            {
                            ?>
                            <option value="1" selected="true">BPM</option>
                            <option value="2">Filtro de endotoxinas</option>
                            <option value="3">Red de computo/LAN</option>
                            <option value="4">Documentación de soporte</option>
                            <option value="5">Verificación de uso/operador.</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_sistema_apoyo"></div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <h4>INFORMACION ADICIONAL</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="obser">OBSERVACIONES:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control bg_lightgreen" name="obser" id="obser" value="123" rows="10" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 required><?php echo $reportDtl[0][30];?></textarea> 
                        <div class="errmsg" id="error_obser"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="nombre_tecnico">NOMBRE DE TECNICO:</label><div class="errorMsg" id="text_size"></div>
                        <input type="text" class="form-control" id="nombre_tecnico" name="nombre_tecnico" value="<?php echo $created_by;?>"  style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_nombre_tecnico"></div>
                    </div>
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="firma">FIRMA / SELLO:</label><div class="errorMsg" id="text_size"></div>    
                        <input type="text" class="form-control" id="firma" value=""  style="background: lightgrey;" readonly="true">                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="nombre_recibe">NOMBRE RECIBE:</label><div class="errorMsg" id="text_size"></div>
                        <input type="text" class="form-control bg_lightgreen" id="nombre_recibe" name="nombre_recibe" value="<?php echo $reportDtl[0][31];?>" required>
                        <div class="errmsg" id="error_nombre_recibe"></div>
                    </div>
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="firma">FIRMA / SELLO:</label><div class="errorMsg" id="text_size"></div>   
                        <input type="text" class="form-control" id="firma" value=""  style="background: lightgrey;" readonly="true">                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="hora_inicio">HORA DE INICIO:</label><div class="errorMsg" id="text_size"></div>
                        <input type="text" class="form-control bg_lightgreen" id="hora_inicio" name="hora_inicio" value="<?php echo $reportDtl[0][32];?>" required>
                        <div class="errmsg" id="error_hora_inicio"></div>
                    </div>
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="hora_final">HORA DE FINALIZACION:</label><div class="errorMsg" id="text_size"></div>
                        <input type="text" class="form-control bg_lightgreen" id="hora_final" name="hora_final" value="<?php echo $reportDtl[0][33];?>" required>
                        <div class="errmsg" id="error_hora_final"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="fecha_act">FECHA(DD-MM-AAAA):</label><div class="errorMsg" id="text_size"></div>
                        <input type="date" class="form-control" id="fecha_act" name="fecha_act" value="<?php echo $reportDtl[0][34];?>" required style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_fecha_act"></div>
                    </div>
                
                    <div class="col-sm-6 text-left" style="color:#f5f5f5;">
                        <label for="equipo_apto">EQUIPO APTO PARA UCO CON PACIENTE</label>
                        <select name="equipo_apto" class="form-control bg_lightgreen" id="equipo_apto" required>
                            <?php 
                            if($reportDtl[0][35]==1)
                            {
                            ?>
                            <option value="1" selected="true">SI</option>
                            <option value="2">NO</option>
                            <option value="3">RETENIDO</option>
                            <?php
                            }
                            else if($reportDtl[0][35]==2)
                            {
                            ?>
                            <option value="1">SI</option>
                            <option value="2" selected="true">NO</option>
                            <option value="3">RETENIDO</option>
                            <?php
                            }
                            else if($reportDtl[0][35]==3)
                            {
                            ?>
                            <option value="1">SI</option>
                            <option value="2">NO</option>
                            <option value="3" selected="true">RETENIDO</option>
                            <?php
                            }
                            else if($reportDtl[0][35]==0)
                            {
                            ?>
                            <option value="1" selected="true">SI</option>
                            <option value="2">NO</option>
                            <option value="3">RETENIDO</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="errmsg" id="error_estado_id"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 text-center">                        
                        <input type="submit" class="btn btn-small btn_center" value="GUARDAR">
                        <a href=exportPdfMantPreventivo.php?peticion=<?php echo $peticionId;?> target="_blank">
                            <input type="button" class="btn btn-small btn_center" value="EXPORTAR">  
                        </a>
                    </div>
                </div>
            </form>
            <br>

        </div>
    </div>
</div>
