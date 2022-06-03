<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }
    else
    {
        include_once('util.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time();

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
        $updStatus = $controller->updateReport5($databasecon,$_POST["id"],$_POST["rep_hora_entrada"],$_POST["rep_hora_salida"],$_POST["rep_ciclos"],$_POST["rep_desc"],$_POST["rep_codigo"],$_POST["rep_cantidad"],$_POST["rep_obser"],$_POST["rep_recibido_por"],$DEBUG_STATUS);
        //echo 'updStatus:'.$updStatus.'<br>';
        if($updStatus==0)
            $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";
        else
            $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";
    }
    


    $peticionId=0;
    if(isset($_GET["peticion"]))
        $peticionId=$_GET["peticion"];
    $reportDtl = $controller->getReport5($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionHist = $controller->getPeticionComments2($databasecon,$peticionId,$DEBUG_STATUS);
    $peticionDtl = $controller->getPeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
    $cur_date = $controller->getCurDate($databasecon,$DEBUG_STATUS);
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
                    <h2 class="page_title">GENERAR REPORTE - MANTENIMIENTO CORRECTIVO</h2>                    
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
            <!-- <?php
                include_once('cabeceraReporte.php');
            ?> -->
            <br>
            <form action="mantenimientoCorrectivo.php?peticion=<?php echo $peticionId;?>" method="post">
                <input type="hidden" name="submitted" value="true">
                <input type="hidden" name="id" value="<?php echo $reportDtl[0][1];?>">
                
                <div class="row">
                    <div class="col-sm-4 text-left">
                        <label for="user_name">CLIENTE:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionDtl[0][2];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>

                    <div class="col-sm-4 text-left">
                        <label for="user_name">CIUDAD:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionDtl[0][3];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>

                    <div class="col-sm-4 text-left">
                        <label for="user_name">TELEFONO:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionDtl[0][10];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="rep_fecha">FECHA(DDMMAAAA):</label>
                        <input type="text" class="form-control" id="rep_fecha" value="<?php echo $cur_date;?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_rep_fecha"></div>
                    </div>
                    <div class="col-sm-6">
                         <div class="row">
                            <div class="col-sm-6" style="color:#f5f5f5;">
                                <label for="rep_hora_entrada">HORA ENTRADA(HH:MM AM/PM):</label>
                                <input type="text" class="form-control bg_lightgreen" maxlength="10" id="rep_hora_entrada" name="rep_hora_entrada" value="<?php echo $reportDtl[0][3];?>" required>
                                <div class="errmsg" id="error_rep_hora_entrada"></div>
                            </div>
                            <div class="col-sm-6" style="color:#f5f5f5;">
                                <label for="rep_hora_salida">HORA SALIDA(HH:MM AM/PM):</label>
                                <input type="text" class="form-control bg_lightgreen" maxlength="10" id="rep_hora_salida" name="rep_hora_salida" value="<?php echo $reportDtl[0][4];?>" required>
                                <div class="errmsg" id="error_rep_hora_salida"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4 text-left">
                        <label for="user_name">EQUIPO:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionHist[0][3];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>

                    <div class="col-sm-4 text-left">
                        <label for="user_name">SERIE:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionHist[0][6];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>

                    <div class="col-sm-4 text-left">
                        <label for="rep_ciclos"># CICLOS:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="50" id="rep_ciclos" name="rep_ciclos" value="<?php echo $reportDtl[0][5];?>" required>
                        <div class="errmsg" id="error_rep_ciclos"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="permisos">MOTIVO DE LLAMADA:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control" name="obser" id="obser" rows="10" style="background: lightgrey;" readonly="true"><?php echo $peticionDtl[0][6];?></textarea> 
                        <div class="errmsg" id="error_obser"></div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="permisos">ACCION TOMADA:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control" name="obser" id="obser" rows="10" style="background: lightgrey;" readonly="true"><?php echo $peticionHist[0][0];?></textarea> 
                        <div class="errmsg" id="error_obser"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <h4>REPUESTOS UTILIZADOS</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="rep_desc">DESCRIPCION:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control bg_lightgreen" name="rep_desc" id="rep_desc" maxlength="200" value="" rows="10" onkeypress="countTextSize()" placeholder="Ingresardescripcion-200 caracteres" maxlength=200 required><?php echo $reportDtl[0][6];?></textarea> 
                        <div class="errmsg" id="error_rep_desc"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="rep_codigo">CODIGO:</label><div class="errorMsg" id="text_size"></div>
                        <input type="text" class="form-control bg_lightgreen" maxlength="50" id="rep_codigo" name="rep_codigo" value="<?php echo $reportDtl[0][7];?>" required>
                        <div class="errmsg" id="error_rep_codigo"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="rep_cantidad">CANTIDAD:</label><div class="errorMsg" id="text_size"></div>
                        <input type="text" class="form-control bg_lightgreen" maxlength="10" id="rep_cantidad" name="rep_cantidad" value="<?php echo $reportDtl[0][8];?>" required>
                        <div class="errmsg" id="error_rep_cantidad"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="rep_obser">OBSERVACION:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control bg_lightgreen" name="rep_obser" maxlength="200" id="rep_obser" value="" rows="10" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 required><?php echo $reportDtl[0][9];?></textarea> 
                        <div class="errmsg" id="error_rep_obser"></div>
                    </div>
                </div>
                <br>
                <br>
                <br>



                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12 text-center">       
                                <label for="rep_recibido_por">NOMBRE DE LA PERSONA QUE RECIBE:</label><div class="errorMsg" id="text_size"></div>                    
                                <input type="text" class="form-control bg_lightgreen" maxlength="100" id="rep_recibido_por" name="rep_recibido_por" value="<?php echo $reportDtl[0][10];?>" style="text-align: center;" required>
                                <div class="errmsg" id="error_rep_recibido_por"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <?php echo $peticionDtl[0][2];?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12 text-center">                            
                                <label for="permisos">NOMBRE DEL TECNICO QUE ATENDIO LA PETICION</label><div class="errorMsg" id="text_size"></div>                    
                                <input type="text" class="form-control" id="user_name" value="<?php echo $peticionHist[0][2];?>" style="background: lightgrey;text-align: center;" readonly="true">
                                <div class="errmsg" id="error_obser"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <img src="images/logo.png" style="width:20%">
                            </div>
                        </div>
                    </div>
                <!-- <div class="row">
                    <div class="col-sm-12 text-center">                        
                        <input type="submit" class="btn btn-small btn_center" value="GUARDAR">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="errblock" style="background:transparent">
                            <a href=exportPdfMantCorrectivo.php?peticion=<?php echo $peticionId;?> target="_blank">EXPORTAR</a>
                        </div>                        
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-sm-12 text-center">       
                        <?php
                        if(empty($reportDtl[0][5]))
                        {
                        ?>
                         <input type="submit" class="btn btn-small btn_center" value="GUARDAR">
                        <?php
                        }    
                        ?>                 
                        
                        <a href=exportPdfMantCorrectivo.php?peticion=<?php echo $peticionId;?> target="_blank">
                            <input type="button" class="btn btn-small btn_center" value="EXPORTAR">  
                        </a>
                    </div>
                </div>
                </div>
            </form>
            <br>

        </div>
    </div>
</div>
