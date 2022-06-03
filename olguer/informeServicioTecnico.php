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
        $updStatus = $controller->updateInformeST($databasecon,$_POST["id"],$_GET["peticion"],$_POST["ciclos"],$_POST["contacto"],$_POST["desde"],$_POST["hasta"],$_POST["horaViaje"],$_POST["check_valida"],$_POST["recibe"],$_POST["trabajo_terminada"],$DEBUG_STATUS);
        $updCtrStatus=0;
        if($updStatus>0)
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
        //echo 'updStatus:'.$updStatus.'<br>';
        /*if($updStatus>0)
            $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";
        else
            $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";*/
        
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
    $reportDtl = $controller->getInformeST($databasecon,$peticionId,$DEBUG_STATUS);
    $partesDtl = $controller->getInformeSTPartes($databasecon,$peticionId,$DEBUG_STATUS);
    $detalle = $controller->getDetallesForInformeST($databasecon,$peticionId,$DEBUG_STATUS);
    //echo'<br>COUNT-DETALLES::'.count($detalle);
    //echo '<br>RESPONSABLE'.$detalle[0][1];
    
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
                    <h2 class="page_title">INFORME DE SERVICIO TECNICO - <?php if(isset($detalle[0][8])) echo $detalle[0][8];?></h2>                    
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
            <form action="informeServicioTecnico.php?peticion=<?php echo $peticionId;?>&report=<?php echo $reportDtl[0][0];?>" method="post"  enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?php echo $reportDtl[0][1];?>">
                
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="report_id">ORDEN DE SERVICIO:</label>
                        <input type="text" class="form-control" id="report_id" value="<?php echo $reportDtl[0][0];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_report_id"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <h4>DATOS DEL EQUIPO</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="responsable">INGENIERO RESPONSABLE:</label>
                        <input type="text" class="form-control" id="responsable" value="<?php echo $detalle[0][1];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_responsable"></div>
                    </div>
                    <div class="col-sm-6 text-left">
                        <label for="ciudad">CIUDAD:</label>
                        <input type="text" class="form-control" id="ciudad" value="<?php echo $detalle[0][2];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_ciudad"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="cliente">CLIENTE:</label>
                        <input type="text" class="form-control" id="cliente" value="<?php echo $detalle[0][3];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_cliente"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="equipo">EQUIPO:</label>
                        <input type="text" class="form-control" id="equipo" value="<?php echo $detalle[0][4];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_equipo"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="serie">NRO SERIE</label>
                        <input type="text" class="form-control" id="serie" value="<?php echo $detalle[0][5];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_serie"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="ciclos">NRO DE CICLOS</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="10" id="ciclos" name="ciclos" value="<?php echo $reportDtl[0][3];?>" required>
                        <div class="errmsg" id="error_ciclos"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="contacto">NOMBRE DEL CONTACTO:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="50" id="contacto" name="contacto" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="error_contacto"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="rep_fecha">FECHA</label>
                        <input type="date" class="form-control bg_lightgreen" id="rep_fecha" name="rep_fecha" value="<?php echo $detalle[0][7];?>" required>
                        <div class="errmsg" id="error_rep_fecha"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="desde">DESDE</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="10" id="desde" name="desde" value="<?php echo $reportDtl[0][5];?>" required>
                        <div class="errmsg" id="error_desde"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="hasta">HASTA</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="10" id="hasta" name="hasta" value="<?php echo $reportDtl[0][6];?>" required>
                        <div class="errmsg" id="error_hasta"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="horaViaje">HORA VIAJE</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="10" id="horaViaje" name="horaViaje" value="<?php echo $reportDtl[0][7];?>" required>
                        <div class="errmsg" id="error_horaViaje"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <h4>DIAGNOSTICO Y/O FALLA REPORTADA</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="id_servicio">CODIGO DEL SERVICIO:</label>
                        <input type="text" class="form-control" id="id_servicio" value="<?php echo $detalle[0][0];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="errorid_servicio"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="id_servicio">DESCRIPCION DEL SERVICIO</label>
                        <textarea cols="100%" rows="10" class="form-control" style="background: lightgrey;" readonly="true"><?php echo $detalle[0][6];?></textarea>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="user_name">El equipo ha sido validado siguiendo las especificaciones de fábrica del mantenimiento preventivo y/o correctivo</label>
                        <?php
                            if($reportDtl[0][8]==1)
                            {
                        ?>
                        <input type="radio" name="check_valida" checked value="1">SI
                        <input type="radio" name="check_valida" value="0">NO
                        <?php
                            }
                            else
                            {
                        ?>
                        <input type="radio" name="check_valida" value="1">SI
                        <input type="radio" name="check_valida" checked value="0">NO
                        <?php  
                            }
                        ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-8 text-left" style="color:#f5f5f5;">
                        <h4>PARTES UTILIZADAS EN EL SERVICIO</h4>
                    </div>                    
                    <div class="col-sm-4 text-right" style="color:#f5f5f5;">
                        <input type="hidden" name="nroPartes" id="nroPartes" value="0">
                        <input type="hidden" name="partesData" id="partesData" value="">
                        <input type="button" class="btn btn-small btn_center"  data-toggle="modal" data-target="#myModal" value="AGREGAR DETALLES PARTES">
                    </div>
                </div>

                <div class="row tbl_row_heading">
                    <div class="col-sm-4 text-left" style="color:#f5f5f5;">
                        <h6>NOMBRE PARTE</h6>
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
                
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="recibe">NOMBRE RECIBE:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="50" id="recibe" name="recibe" value="<?php echo $reportDtl[0][9];?>" required>
                        <div class="errmsg" id="errorid_recibe"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-left">
                        <label for="ciudad">TRABAJO TERMINADO:</label>
                        <?php
                            if($reportDtl[0][10]==1)
                            {
                        ?>
                        <input type="radio" name="trabajo_terminada" checked value="1">SI
                        <input type="radio" name="trabajo_terminada" value="0">NO
                        <?php
                            }
                            else
                            {
                        ?>
                        <input type="radio" name="trabajo_terminada" value="1">SI
                        <input type="radio" name="trabajo_terminada" checked value="0">NO
                        <?php  
                            }
                        ?>
                    </div>
                </div>
                <br>
                <br>
                <br>

            
                <div class="row">
                    <div class="col-sm-12 text-center">       
                        <?php
                        if(empty($reportDtl[0][3]))
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
                                <a href=exportInformeServicioTecnico.php?peticion=<?php echo $peticionId;?> target="_blank">
                                    <input type="button" class="btn btn-small btn_center" value="EXPORTAR">  
                                </a>
                            </div>
                            
                                <input type="hidden" name="submittedFile" value="true">
                                <div class="col-sm-4 text-center">
                                    <label for="fileToUpload" class="btn btn-small btn_center"><span class="glyphicon glyphicon-download-alt" style="font-size:16px;"></span> ELIGE PDF</label>
                                    <input type="file" name="fileToUpload" id="fileToUpload" style="visibility:hidden">
                                </div>
                                <div class="col-sm-4 text-center">
                                    <input type="submit" class="btn btn-small btn_center" value="ALMACENAR">
                                </div>
                            
                        </div>







                        <?php
                        }
                        ?>
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
                <h4 class="modal-title">PARTES UTILIZADAS EN EL SERVICIO</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <label for="nombre_parte">NOMBRE DEL PARTE:</label>
                        <input type="text" class="form-control bg_lightgreen" maxlength="500" id="nombre_parte" value="<?php echo $reportDtl[0][4];?>" required>
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
                        <input type="text" class="form-control bg_lightgreen" maxlength="500" id="desc_parte" value="<?php echo $reportDtl[0][4];?>" required>
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
