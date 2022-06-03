<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        //echo 'inside<br>';
        $url="userlogin.php";
        $_SESSION["last_url"]='mispublicaciones.php';
        //echo $_SESSION["last_url"];
        header("Location:$url"); 
    }
    $controller = new controller();
    if(isset($_POST['submitted']))
    {
        $status=$controller->pagarConductor($databasecon,$_GET['codigo_viaje'],$_POST["vid"],$_POST["docPago"],$_POST["fechaPago"],$DEBUG_STATUS);
        //echo 'status:'.$status.'<br>';
        if($status==0)
            $message="PAGO REALIZADO CORRECTAMENTE";
        else
            $message="ERROR EN REALIZAR PAGO";
    }
    $pagos=$controller->getPagosConductorDtl($databasecon,$_GET['codigo_viaje'],$DEBUG_STATUS);
    
    
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
  include_once('header.php');

?>
<br>

<div class="container inner_body">
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
                <div class="col-sm-12">
                    <center><img src="images/icon_account.png"></center>
                    <h3 style="text-align:center;color:#222;margin-top:1px">PAGOS A CONDUCTOR</h3>
                </div>
            </div>
            <br>
            <?php 
                
                if(isset($message)) 
                {
            ?>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class='alert alert-success shopAlert text-center'>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php  
                            echo $message; 
                        ?>
                     </div>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <?php
                }
            ?>
            <br>
            <div id="message"></div>
            <div class="col-sm-12">
                <form method="post" action=pagarConductor.php?codigo_viaje=<?php echo $_GET['codigo_viaje'];?> enctype="multipart/form-data">
                    <input type="hidden" name="submitted" value="true" />
                    <div class="row">
                        <div class="col-sm-2">                
                        </div>
                        <div class="col-sm-8">  
                            <div class="row">            
                                <div class="col-sm-6 planificarviaje">        
                                        <div class="form-group">
                                            <span class="input-group-addon">VIAJE ID</span>
                                            <input type="text" class="form-control" name="vid" id="vid" value="<?php echo $pagos[0][0]; ?>"  readonly="true">
                                        </div>
                                </div>
                                <div class="col-sm-6 planificarviaje">        
                                        <div class="form-group">
                                            <span class="input-group-addon">CONDUCTOR ID</span>
                                            <input type="text" class="form-control" name="cid" id="cid" value="<?php echo $pagos[0][1]; ?>"  readonly="true">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 planificarviaje">        
                                    <div class="form-group">
                                        <span class="input-group-addon">NRO. CUENTA BANCO</span>
                                        <input type="text" class="form-control" name="nrocuenta" id="nrocuenta" value="<?php echo $pagos[0][2]; ?>"  readonly="true">
                                        <div class="errorMsg" id="error_nrocuenta"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 planificarviaje">        
                                    <div class="form-group">
                                        <span class="input-group-addon">BANCO</span>
                                        <input type="text" class="form-control" name="banco" id="banco" value="<?php echo $pagos[0][3]; ?>"  readonly="true">
                                        <div class="errorMsg" id="error_bancoId"></div>
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-sm-6 planificarviaje">        
                                    <div class="form-group">
                                        <span class="input-group-addon">TIPO CUENTA</span>
                                        <input type="text" class="form-control" name="tipocuenta" id="tipocuenta" value="<?php echo $pagos[0][4]; ?>"  readonly="true">
                                        <div class="errorMsg" id="error_bancoId"></div>
                                    </div>
                                </div>  
                                <div class="col-sm-6 planificarviaje">        
                                    <div class="form-group">
                                        <span class="input-group-addon">VALOR A PAGAR</span>
                                        <input type="text" class="form-control" name="valorPago" id="valorPago" value="<?php echo $pagos[0][5]; ?>"  readonly="true">
                                        <div class="errorMsg" id="error_bancoId"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6 planificarviaje">        
                                    <div class="form-group">
                                        <span class="input-group-addon">FECHA DE PAGO</span>
                                        <input type="date" class="form-control" name="fechaPago" id="fechaPago" value="<?php echo $pagos[0][7]; ?>" required>
                                        <div class="errorMsg" id="error_bancoId"></div>
                                    </div>
                                </div>   
                                <div class="col-sm-6 planificarviaje">        
                                    <div class="form-group">
                                        <span class="input-group-addon">NRO. DOCUMENTO DE PAGO</span>
                                        <input type="text" class="form-control" name="docPago" id="docPago" value="<?php echo $pagos[0][6]; ?>" required>
                                        <div class="errorMsg" id="error_bancoId"></div>
                                    </div>
                                </div>                         
                            </div>                        
                        </div>
                        <div class="col-sm-2">                
                        </div>
                    </div>
                    <div class="row">        
                        <button type="submit" class="btn btn-info btn_center">PAGAR <span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <br>            
</div>

<?php
    include_once('container_footer.php');
?>