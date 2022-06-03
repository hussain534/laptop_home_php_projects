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
        $updStatus = $controller->updateReport1($databasecon,$_POST["id"],$_POST["ost"],$_POST["fech_inst"],$_POST["serie"],$_POST["ver_soft"],
            $_POST["modelo"],$_POST["estado_equipo"],$_POST["notas"],$_POST["rep_recibido_por"],$DEBUG_STATUS);
        //print_r($_POST);
        $updStatus = $controller->updateChecklistReport1($databasecon,$_POST["id"],
                                    $_POST["checklist_codigo_0"],$_POST["checklist_codigo_1"],$_POST["checklist_codigo_2"],$_POST["checklist_codigo_3"],$_POST["checklist_codigo_4"],$_POST["checklist_codigo_5"],$_POST["checklist_codigo_6"],$_POST["checklist_codigo_7"],$_POST["checklist_codigo_8"],$_POST["checklist_codigo_9"],$_POST["checklist_codigo_10"],$_POST["checklist_codigo_11"],$_POST["checklist_codigo_12"],$_POST["checklist_codigo_13"],$_POST["checklist_codigo_14"],$_POST["checklist_codigo_15"],$_POST["checklist_codigo_16"],$_POST["checklist_codigo_17"],$_POST["checklist_codigo_18"],$_POST["checklist_codigo_19"],$_POST["checklist_codigo_20"],
                                    $_POST["turnos_dia_0"],$_POST["turnos_dia_1"],$_POST["turnos_dia_2"],$_POST["turnos_dia_3"],$_POST["turnos_dia_4"],$_POST["turnos_dia_5"],$_POST["turnos_dia_6"],$_POST["turnos_dia_7"],$_POST["turnos_dia_8"],$_POST["turnos_dia_9"],$_POST["turnos_dia_10"],$_POST["turnos_dia_11"],$_POST["turnos_dia_12"],$_POST["turnos_dia_13"],$_POST["turnos_dia_14"],$_POST["turnos_dia_15"],$_POST["turnos_dia_16"],$_POST["turnos_dia_17"],$_POST["turnos_dia_18"],$_POST["turnos_dia_19"],$_POST["turnos_dia_20"],
                                    $_POST["nota_0"],$_POST["nota_1"],$_POST["nota_2"],$_POST["nota_3"],$_POST["nota_4"],$_POST["nota_5"],$_POST["nota_6"],$_POST["nota_7"],$_POST["nota_8"],$_POST["nota_9"],$_POST["nota_10"],$_POST["nota_11"],$_POST["nota_12"],$_POST["nota_13"],$_POST["nota_14"],$_POST["nota_15"],$_POST["nota_16"],$_POST["nota_17"],$_POST["nota_18"],$_POST["nota_19"],$_POST["nota_20"],
                                    $DEBUG_STATUS);
        //echo 'updStatus:'.$updStatus.'<br>';
        if($updStatus==0)
            $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";
        else
            $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";
    }


    $peticionId=0;
    if(isset($_GET["peticion"]))
        $peticionId=$_GET["peticion"];

    $service_type=1;
    $reportDtl = $controller->getReport1($databasecon,$peticionId,$DEBUG_STATUS);
    $peticionDtl = $controller->getPeticionDtl1($databasecon,$peticionId,$DEBUG_STATUS);
    $peticionHist = $controller->getPeticionComments($databasecon,$peticionId,$DEBUG_STATUS);
    $checklist = $controller->getChecklist($databasecon,$peticionId,$DEBUG_STATUS);
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
                    <h2 class="page_title">GENERAR REPORTE - INSTALACION EQUIPO</h2>                    
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
            <form action="instalacionEquipo.php?peticion=<?php echo $peticionId;?>" method="post">
                <input type="hidden" name="submitted" value="true">
                <input type="hidden" name="id" value="<?php echo $reportDtl[0][1];?>">
                
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="responsable">CODIGO CLIENTE:</label>
                        <input type="text" class="form-control" id="cod_cliente" name="cod_cliente" value="<?php echo $peticionDtl[0][2];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_responsable"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="cargo">OST:</label>
                        <input type="text" class="form-control bg_lightgreen" id="ost" name="ost" value="<?php echo $reportDtl[0][3];?>" required>
                        <div class="errmsg" id="error_cargo"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>PROTOCOLO DE INSTALACIÓN MAQUINA DE HEMODIALISIS</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="responsable">HOSPITAL/CLINICA:</label>
                        <input type="text" class="form-control" id="cod_cliente" name="cod_cliente" value="<?php echo $peticionDtl[0][3];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_responsable"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="responsable">FECHA DE INSTALACION</label>
                        <input type="date" class="form-control bg_lightgreen" id="fech_inst" name="fech_inst" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="error_responsable"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="cargo">SERIE:</label>
                        <input type="text" class="form-control bg_lightgreen" id="serie" name="serie" value="<?php echo $reportDtl[0][5];?>" required>
                        <div class="errmsg" id="error_cargo"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="responsable">VERSION DE SOFTWARE</label>
                        <input type="text" class="form-control bg_lightgreen" id="ver_soft" name="ver_soft" value="<?php echo $reportDtl[0][7];?>" required>
                        <div class="errmsg" id="error_responsable"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="cargo">TIPO/MODELO:</label>
                        <input type="text" class="form-control bg_lightgreen" id="modelo" name="modelo" value="<?php echo $reportDtl[0][6];?>" required>
                        <div class="errmsg" id="error_cargo"></div>
                    </div>
                </div>
                <br>
                

                <!-- <div class="row">
                    <div class="col-sm-12 text-left cell_border1">
                        <h2 style="text-decoration: underline;">PUNTOS A VERIFICAR POR EL SERVICIO TECNICO</h2>
                    </div>
                </div>
                <?php 
                    for($x=0;$x<count($checklist);$x++)
                    {
                ?>
                
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <input type="hidden" class="form-control" id=<?='checklist_codigo_'.$x;?> name=<?='checklist_codigo_'.$x;?> value="<?=$checklist[$x][0];?>"  style="background: lightgrey;" readonly="true">
                        <label for="responsable" style="font-size:18px"><?=strtoupper($checklist[$x][1]);?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1 text-left" style="color:#f5f5f5;">
                    </div>
                    <div class="col-sm-2 text-left" style="color:#f5f5f5;">
                        <label for="responsable" style="font-size:14px">ESTADO</label>
                        <select name=<?='turnos_dia_'.$x;?> class="form-control bg_lightgreen" id=<?='turnos_dia_'.$x;?>>
                            <?php 
                            if($checklist[$x][2]==1)
                            {
                            ?>
                                <option value="1" selected="true">SI</option>
                                <option value="2">NO</option>
                            <?php
                            }
                            else if($checklist[$x][2]==2)
                            {
                            ?>
                                <option value="1">SI</option>
                                <option value="2" selected="true">NO</option>
                            <?php
                            }
                            else if($checklist[$x][2]==0)
                            {
                            ?>
                                <option value="1" selected="true">SI</option>
                                <option value="2">NO</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-1 text-left" style="color:#f5f5f5;">
                    </div>
                    <div class="col-sm-11 text-left" style="color:#f5f5f5;">
                        <label for="obser">NOTAS:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control bg_lightgreen" id=<?='nota_'.$x;?> name=<?='nota_'.$x;?> rows="5" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 required><?php echo $reportDtl[0][9];?></textarea> 
                        <div class="errmsg" id="error_obser"></div>
                    </div>
                </div>
                <br>
                <?php
                    }
                ?> -->

                <br>
                <br>
                <br>
                <div class="row" style="background:#284b5a;color:#fff">
                    <div class="col-sm-1 text-left cell_border1">
                        <h4>#</h4>
                    </div>
                    <div class="col-sm-5 text-left cell_border1">
                        <h4>PUNTOS A VERIFICAR POR EL SERVICIO TECNICO</h4>
                    </div>
                    <div class="col-sm-2 text-left cell_border1">
                        <h4>ESTADO</h4>
                    </div>
                    <div class="col-sm-4 text-left cell_border1">
                        <h4>NOTA</h4>
                    </div>
                </div>
                <br>
                <?php 
                    for($x=0;$x<count($checklist);$x++)
                    {
                ?>
                <div class="row">
                    <div class="col-sm-1 text-left cell_border1">
                        <input type="text" class="form-control" id=<?='checklist_codigo_'.$x;?> name=<?='checklist_codigo_'.$x;?> value="<?=$checklist[$x][0];?>"  style="background: lightgrey;" readonly="true">
                    </div>
                    <div class="col-sm-5 text-left cell_border1">
                        <input type="text" class="form-control" id=<?='checklist_desc_'.$x;?> name=<?='checklist_desc_'.$x;?> value="<?=$checklist[$x][1];?>"  style="background: lightgrey;" readonly="true">
                    </div>
                    <div class="col-sm-2 text-left cell_border1">
                        <select name=<?='turnos_dia_'.$x;?> class="form-control bg_lightgreen" id=<?='turnos_dia_'.$x;?>>
                            <?php 
                            if($checklist[$x][2]==1)
                            {
                            ?>
                                <option value="1" selected="true">SI</option>
                                <option value="2">NO</option>
                            <?php
                            }
                            else if($checklist[$x][2]==2)
                            {
                            ?>
                                <option value="1">SI</option>
                                <option value="2" selected="true">NO</option>
                            <?php
                            }
                            else if($checklist[$x][2]==0)
                            {
                            ?>
                                <option value="1" selected="true">SI</option>
                                <option value="2">NO</option>
                            <?php
                            }
                            ?>
                        </select>                         
                    </div>
                    <div class="col-sm-4 text-left cell_border1">
                        <textarea class="form-control bg_lightgreen" id=<?='nota_'.$x;?> name=<?='nota_'.$x;?> rows="5" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 required><?php echo $checklist[$x][3];?></textarea> 
                    </div>
                </div>
                <br>
                <?php
                    }
                ?>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="sistema_apoyo">NOTAS(SERVICIO TECNICO)</label>
                        <select name="estado_equipo" class="form-control bg_lightgreen" id="estado_equipo" required>
                            <?php 
                            if($reportDtl[0][8]==1)
                            {
                            ?>
                                <option value="1" selected="true">EQUIPO OPERATIVO</option>
                                <option value="2">EQUIPO AVERIADO</option>
                            <?php
                            }
                            else if($reportDtl[0][8]==2)
                            {
                            ?>
                                <option value="1">EQUIPO OPERATIVO</option>
                                <option value="2" selected="true">EQUIPO AVERIADO</option>
                            <?php
                            }
                            else if($reportDtl[0][8]==0)
                            {
                            ?>
                                <option value="1" selected="true">EQUIPO OPERATIVO</option>
                                <option value="2">EQUIPO AVERIADO</option>
                            <?php
                            }
                            ?>
                        </select>                         
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="obser">NOTAS POR EL CLIENTE(SI LO HAY):</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control bg_lightgreen" name="notas" id="notas" value="123" rows="10" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 required><?php echo $reportDtl[0][9];?></textarea> 
                        <div class="errmsg" id="error_obser"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12 text-center">       
                                <label for="rep_recibido_por">Firma aceptado/cliente</label><div class="errorMsg" id="text_size"></div>                    
                                <input type="text" class="form-control bg_lightgreen" id="rep_recibido_por" name="rep_recibido_por" value="<?php echo $reportDtl[0][11];?>" style="text-align: center;" required>
                                <div class="errmsg" id="error_rep_recibido_por"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <?php echo $peticionDtl[0][3];?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12 text-center">                            
                                <label for="permisos">Firma responsable de instalación:</label><div class="errorMsg" id="text_size"></div>                    
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
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">                        
                        <input type="submit" class="btn btn-small btn_center" value="GUARDAR">
                        <a href=exportPdfInstEquipos.php?peticion=<?php echo $peticionId;?> target="_blank">
                            <input type="button" class="btn btn-small btn_center" value="EXPORTAR">  
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


