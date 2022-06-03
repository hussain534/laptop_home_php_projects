<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;
    $target_dir=$pdf_location;

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
    

    if(isset($_POST['submitted']))
    {
        //echo 'id:'.$_POST["id"].'<br>';
        //$updStatus = $controller->updateReport5($databasecon,$_POST["id"],$_POST["rep_hora_entrada"],$_POST["rep_hora_salida"],$_POST["rep_ciclos"],$_POST["rep_desc"],$_POST["rep_codigo"],$_POST["rep_cantidad"],$_POST["rep_obser"],$_POST["rep_recibido_por"],$DEBUG_STATUS);
        $updStatus = $controller->updateReport5($databasecon,$_POST["id"],$_POST["rep_hora_entrada"],$_POST["rep_hora_salida"],$_POST["rep_ciclos"],'','','',$_POST["rep_obser"],$_POST["rep_recibido_por"],$DEBUG_STATUS);
        //echo 'updStatus:'.$updStatus.'<br>';
        /*if($updStatus==0)
            $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";
        else
            $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";*/


        $updCtrStatus=0;
        if($updStatus==0)
        {
            $partesForUpdate = explode("|", $_POST["partesData"]);
            for($i=0;$i<count($partesForUpdate)-1;$i++)
            {
                $partesValues=explode("~", $partesForUpdate[$i]);
                
                $c=$controller->updateInformeSTPartes($databasecon,$_GET["peticion"],$partesValues[0],$partesValues[1],$partesValues[2],$DEBUG_STATUS);
                $updCtrStatus=$updCtrStatus+$c;

            }
            if($updCtrStatus==$_POST["nroPartes"])
                $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";
            else
                $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";
        }

    }

    if(isset($_POST['submittedFile']))
    {
        if(basename($_FILES["fileToUpload"]["name"]))
        {            
            /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
            $target_file = $target_dir .$_GET["peticion"].'.pdf';
            $uploadOk = 1;
            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);            

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) 
            {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) 
                {
                    $messsage= "File is an pdf - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } 
                else 
                {
                    echo "File is not a pdf.";
                    $uploadOk = 0;
                    $_SESSION["message"]="ARCHIVO NO ES PDF";
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) 
            {
                /*echo "Sorry, file already exists.".'<br>';
                if (!unlink($target_file))
                {
                    echo ("Error deleting $target_file").'<br>';
                    $uploadOk = 0;
                }
                else
                {
                    echo ("Deleted $target_file").'<br>';
                }*/                
            }
            // Check file size
            if($imageFileType != "pdf") 
            {
                $messsage= "ARCHIVO NO ES PDF. SOLO ARCHIVOS TIPO PDF PERMITIDO ALMACENAR EN SITIO";
                $uploadOk = 0;
            }
            
            
            if ($uploadOk == 0) 
            {
                $_SESSION["message"]="ERROR: ".$messsage;
                
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                    $_SESSION["message"]="PDF ALMACENADO EN SITIO";
                else
                    $_SESSION["message"]="ERROR ALMACENAR PDF EN SITIO";
            }
        }
        if ($uploadOk != 0)
        {
            $updStatus = $controller->uploadPdfInWeb($databasecon,$_GET["peticion"],$DEBUG_STATUS);

            if($DEBUG_STATUS)
                echo $updStatus.'<br>';
            if($updStatus==0)
                $_SESSION["message"]= "PDF ALMACENADO EN SITIO.";
            else
                $_SESSION["message"]= 'ERROR ALMACENAR PDF EN SITIO.';
        } 
        
    }
    
    if(isset($_SESSION["message"])) 
    {
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }


    $peticionId=0;
    if(isset($_GET["peticion"]))
        $peticionId=$_GET["peticion"];
    $reportDtl = $controller->getReport5($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionHist = $controller->getPeticionComments2($databasecon,$peticionId,$DEBUG_STATUS);
    $peticionDtl = $controller->getPeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
    $cur_date = $controller->getCurDate($databasecon,$DEBUG_STATUS);
    $partesDtl = $controller->getInformeSTPartes($databasecon,$peticionId,$DEBUG_STATUS);
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
            <form action="mantenimientoCorrectivo.php?peticion=<?php echo $peticionId;?>&report=<?php echo $reportDtl[0][0];?>" method="post"  enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?php echo $reportDtl[0][1];?>">
                
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="user_name">CLIENTE:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionDtl[0][2];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>
                    <div class="col-sm-6 text-left">
                        <label for="report_id">NRO. REPORTE:</label>
                        <input type="text" class="form-control" id="report_id" value="<?php echo $reportDtl[0][0];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_report_id"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="user_name">CIUDAD:</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $peticionDtl[0][3];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>

                    <div class="col-sm-6 text-left">
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
                <!-- <div class="row">
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
                </div> -->
                <div class="row">
                    <div class="col-sm-8 text-left" style="color:#f5f5f5;">
                        <h4>REPUESTOS UTILIZADOS</h4>
                    </div>                    
                    <div class="col-sm-4 text-right" style="color:#f5f5f5;">
                        <input type="hidden" name="nroPartes" id="nroPartes" value="0">
                        <input type="hidden" name="partesData" id="partesData" value="">
                        <input type="button" class="btn btn-small btn_center"  data-toggle="modal" data-target="#myModal" value="AGREGAR DETALLES PARTES">
                    </div>
                </div>


                <div class="row tbl_row_heading">
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <h6>NOMBRE/CODIGO PARTE</h6>
                    </div>
                     <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <h6>CANTIDAD PARTE</h6>
                    </div>
                     <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <h6>DESCRIPCION PARTE</h6>
                    </div>
                </div>
                <div id="partes">

                <?php
                    for($z=0;$z<count($partesDtl);$z++)
                    {
                ?>
                    <div class='row tbl_row_data_static' style='font-size:12px'>
                        <div class='col-sm-4 text-left'><?php echo $partesDtl[$z][0];?></div>
                        <div class='col-sm-4 text-left'><?php echo $partesDtl[$z][1];?></div>
                        <div class='col-sm-4 text-left'><?php echo $partesDtl[$z][2];?></div>
                    </div>
                <?php
                    }
                ?>
                </div>
                
                <br>


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
                        <input type="hidden" name="submitted" value="true">
                        <input type="submit" class="btn btn-small btn_center" value="GUARDAR">
            
                        <?php
                        }  
                        else
                        {  
                        ?>                 
                        
                        


                        <br>
                        <br>
        
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <a href=exportPdfMantCorrectivo.php?peticion=<?php echo $peticionId;?> target="_blank">
                                    <input type="button" class="btn btn-small btn_center" value="EXPORTAR">  
                                </a>
                            </div>
                            
                                <input type="hidden" name="submittedFile" value="true">
                                <div class="col-sm-4 text-center">
                                    <label for="fileToUpload" class="btn btn-small btn_center"><span class="glyphicon glyphicon-download-alt" style="font-size:16px;"></span> ELIGE PDF</label>
                                    <input type="file" name="fileToUpload" id="fileToUpload" style="visibility:hidden">
                                </div>
                                <div class="col-sm-4 text-center">
                                    <input type="submit" class="btn btn-small btn_center" value="ALMACENAR"></center>
                                </div>
                            
                        </div>







                        <?php
                        }
                        ?>
                    </div>
                </div>
                </div>
            </form>
            <br>

        </div>
    </div>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background:darkgrey !important">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">REPUESTOS UTILIZADOS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="nombre_parte">NOMBRE DEL REPUESTO:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="20" id="nombre_parte" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="error_nombre_parte"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="cantidad_parte">CANTIDAD:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="10" id="cantidad_parte" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="error_cantidad_parte"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="desc_parte">DESCRIPCION:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="60" id="desc_parte" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="desc_parte"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="agregarPartes" class="btn btn-default" data-dismiss="modal" onclick=addPartDetails()>AGREGAR</button>
            </div>
        </div>

    </div>
</div>