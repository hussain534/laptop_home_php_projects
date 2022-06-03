<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $target_dir=$pics_location;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    $costo_uio_aero=$costo_quito_aeropuerto;
    $costo_aero_uio=$costo_aeropuerto_quito;
    if(isset($_SESSION['LAST_ACTIVITY']))
    {
        if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
        {
            $url="userlogin.php";
            header("Location:$url"); 
        }        
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }

    $tipoPago=0;
    $nroDocumentoPago=0;
    $fechaDocumentoPago="1999-12-31";
    $montoDocumentoPago=0;
    $doUploadFile=0;
    $controller = new controller();
    include_once('header.php');
    if(isset($_POST['submitted']))
    {
        if(isset($_POST["tipoPago"]))
            $tipoPago=$_POST["tipoPago"];
        if(isset($_POST["nroDocumentoPago"]))
            $nroDocumentoPago=$_POST["nroDocumentoPago"];
        if(isset($_POST["fechaDocumentoPago"]))
            $fechaDocumentoPago=$_POST["fechaDocumentoPago"];
        if(isset($_POST["montoDocumentoPago"]))
            $montoDocumentoPago=$_POST["montoDocumentoPago"];
        if(basename($_FILES["fileToUpload"]["name"]))
        {
            $target_file = $target_dir .'Pago-'.$nroDocumentoPago.'-'.$_SESSION["userid"].'.jpg';
            $doUploadFile=1;
        }
        else
            $target_file='';
        $codigoStr = $controller->registrarPago($databasecon,$_GET["tipo"],$_GET["codigo_pago"],$nroDocumentoPago,$tipoPago,$target_file,$fechaDocumentoPago,$montoDocumentoPago,$DEBUG_STATUS);
        echo $codigoStr;
        if($codigoStr==1 && $doUploadFile==1)
        {
            if(basename($_FILES["fileToUpload"]["name"]))
            {                
                $uploadOk = 1;                
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);               

                /*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) 
                {
                    $uploadOk = 0;
                    $messsage="ARCHIVO NO TIPO IMAGEN";
                }*/
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
                {
                    $messsage= $messsage."TIPO DE ARCHIVO DE PAGO INVALIDO";
                    $uploadOk = 0;
                }
                if ($_FILES["fileToUpload"]["size"] > $uploadSize) 
                {
                    $messsage= $messsage."TAMANO DE ARCHIVO EXCEEDE EL LIMITE DE 5MB";
                    $uploadOk = 0;
                }
                
                if ($uploadOk == 0) 
                {
                    $messsage= "ERROR EN CARGAR ARCHIVO DE PAGO. ".$messsage;
                } 
                else 
                {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                    {
                       $messsage= 'DETALLES DE PAGO GUARDAO CORRECTAMENTE Y PENDIENTE APROBACION DE VECTIOS.<br><br><br>';
                       $messsage=$messsage."<a href='misreservas.php'><button type='button' class='btn btn-info btn_center'>MIS VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a><br>";
                    } 
                    else 
                    {
                        $messsage="ERROR EN CARGAR ARCHIVO DE PAGO.";
                    }
                }
            }
        }
        /*else
        {
            $messsage="ERROR EN REGISTRAR DETALLES DE PAGO.";
        }*/
        else if($codigoStr==1)
        {
            $messsage= 'DETALLES DE PAGO GUARDAO CORRECTAMENTE Y PENDIENTE APROBACION DE VECTIOS.<br><br><br>';
            $messsage=$messsage."<a href='misreservas.php'><button type='button' class='btn btn-default btn_center'>MIS VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a><br>";
        }
        ?>
            <br>
            <div class="container inner_body" id="estadoReservarViaje">
                <br>
                <br>
                <?php
                    if(isset($_SESSION['userid']))
                            include_once('submenu.php');
                ?>
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10 inner_body-block">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8 text-center">
                                <div class='alert alert-success shopAlert'>
                                    <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                                    <?php  
                                        echo $messsage; 
                                    ?>
                                 </div>
                            </div>
                            <div class="col-sm-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                </div>
            </div>
        <?php
    }    
    else
    {
        $detallesPago = $controller->getDetallesPago($databasecon,$_GET["tipo"],$_GET["codigo_pago"],$DEBUG_STATUS);
        $micuenta=$controller->micuentaDtl($databasecon,1,$DEBUG_STATUS);
        $currDt=$controller->getCurDate($databasecon,$DEBUG_STATUS);
        
    ?>
        <br>
        <div class="container inner_body" id="estadoReservarViaje">
            <br>
            <br>
            <?php
                if(isset($_SESSION['userid']))
                        include_once('submenu.php');
            ?>
            
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10 inner_body-block"> 
                              
                    <div class="row">
                        <div class="col-sm-12 text-center" id="costoTotal">
                            <br>
                           <h1 style="background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF"><b>VALOR TOTAL A PAGAR : </b>$ <?=$detallesPago[0][0].'.00';?></h1>                                 
                        </div>
                    </div>
                    <div class="row">
                        <div data-mh="my-group" class="col-sm-12 pago">
                            <form method="post" action=<?=$_SERVER['REQUEST_URI'];?> enctype="multipart/form-data">  
                                <input type="hidden" name="submitted" value="true">
                                
                                <div class="row">
                                    <!-- <div class="col-sm-5">
                                        <br>
                                        <b>ELIGES SU TIPO DE PAGO</b>
                                        <br>
                                        <input type="radio" name="tipoPago" id="tipoPago" value="1" checked="true">   Transferencia Bancaria
                                        <br>
                                        <input type="radio" name="tipoPago" id="tipoPago" value="2">   Deposito en Banco
                                        <br>
                                        <input type="radio" name="tipoPago" value="3">   Tarjeta Debito
                                        <br>
                                        <input type="radio" name="tipoPago" value="4">   Tarjeta Credito
                                    </div> -->
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <div class="form-group test">
                                            <span class="input-group-addon">ELIGES SU TIPO DE PAGO</span>
                                            <select name="tipoPago" class="form-control" id="tipoPago" style="width:100%">
                                                <option value="1">Transferencia Bancaria</option>
                                                <option value="2">Deposito en Banco</option>
                                                <!-- <option value="3">Tarjeta Debito</option>
                                                <option value="4">Tarjeta Credito</option> -->
                                                <option value="5">PayPhone</option>
                                            </select>
                                            <div id="errorFecha" class="errorMsg"></div>
                                         </div>
                                    </div>
                                    <div class="col-sm-7" id="txnBanco">
                                        <div class="row">                                        
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="col-sm-12">  
                                                        <div class="form-group">
                                                            <span class="input-group-addon">NRO DOCUMENTO DE PAGO DEL BANCO</span>
                                                            <input type="text" class="form-control" name="nroDocumentoPago" id="nroDocumentoPago" placeholder="Ingresar nro de docuemnto de pago en su banco" required="true">
                                                            <div id="errorNroDocumentoPago" class="errorMsg"></div>
                                                        </div>                            
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-sm-12 text-center">                       
                                                        <div class="form-group">
                                                            <span class="input-group-addon">FECHA DE PAGO DEL BANCO</span>
                                                            <input type="date" class="form-control" max=<?php echo $currDt;?> name="fechaDocumentoPago" id="fechaDocumentoPago" placeholder="Ingresar fecha de pago en su banco" required="true">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <br> 
                                                <br>
                                                <br>
                                                <br>
                                                <div class="row" id="accountDtls">
                                                    <div class="col-sm-12 text-center">
                                                        <div class='alert alert-success shopAlert'>
                                                            <?php  echo 'Para confirmar su viaje, por favor realiza pago de su viaje en CUENTA: '.$micuenta[0][0],', del BANCO:'.$micuenta[0][1].' (TIPO CUENTA:'.$micuenta[0][2].') y carga su documento de pago aqui.' ?>
                                                         </div>
                                                    </div>
                                                </div>                                      
                                            </div>
                                            <div class="col-sm-4">
                                                <b>SUBE SU DOCUMENTO DE PAGO</b>
                                                <br>
                                                <img src=images/unknown_user.png id="uploadImg" class="profileImage"/>
                                                <input type="file" name="fileToUpload" id="fileToUpload"> 
                                                <div class="progress" id="progress">
                                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
                                                </div>
                                                <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p>
                                            </div>
                                        </div>
                                        <div class="row" id="btnRegistrarPago">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-4 text-center">
                                                <button type="submit" class="btn btn-info btn_center">REGISTRAR PAGO<span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>
                                            <div class="col-sm-4"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7" id="txnPayPhone">
                                        <div class="row">
                                            <div class="col-sm-4"></div>  
                                            <div data-mh="my-group" class="col-sm-4 text-center">
                                                <img src="images/payphone.png" style="width:100%">
                                            </div>
                                            <div class="col-sm-4"></div>   
                                        </div>
                                        <br>
                                        <div class="row"> 
                                            <div class="col-sm-4"></div>                                    
                                            <div data-mh="my-group" class="col-sm-4 text-center pago">
                                                <input type="hidden" name="codigo_pago" id="codigo_pago" value=<?php echo $_GET["codigo_pago"];?>>
                                                <input type="hidden" name="tipo" id="tipo" value=5>
                                                <a href=pagarPayPhone.php?codigo_pago=<?php echo $_GET["codigo_pago"];?>&tipo=5&doTxn=0><pre class="pre-pagar3">PAGAR CON PAYPHONE</pre></a>
                                            </div>
                                            <div class="col-sm-4"></div>  
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <br>
                                <br>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
                 <div class="col-sm-1">
                </div>
            </div>
            <br>
            <br>
        </div>
<?php
        }
include_once('container_footer.php');
?>