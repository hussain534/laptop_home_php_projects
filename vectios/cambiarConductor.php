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
        $status=$controller->cambiarConductor($databasecon,$_POST["conductor"],$_POST["vid"],$DEBUG_STATUS);
        //echo 'status:'.$status.'<br>';
        if($status==0)
            $message="CONDUTOR CAMBIADO CORRECTAMENTE";
        else
            $message="ERROR EN CAMBIAR CONDUCTOR";
    }
    $pagos=$controller->detallesParaCambiarConductor($databasecon,$_GET['codigoViaje'],$DEBUG_STATUS);
    
    
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
                    <h3 style="text-align:center;color:#222;margin-top:1px">CAMBIAR CONDUCTOR</h3>
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
                <form method="post" action=cambiarConductor.php?codigoViaje=<?php echo $_GET['codigoViaje'];?> enctype="multipart/form-data">
                    <input type="hidden" name="submitted" value="true" />
                    <div class="row">
                        <div class="col-sm-4">                
                        </div>
                        <div class="col-sm-4">
                            
                            <!-- <input type="text" class="form-control" name="from_airport" id="from_airport" value="<?php if($pagos[0][12]!=1) echo '0'; else echo $pagos[0][12]; ?>"  readonly="true">   -->
                            <div class="row">            
                                <div class="col-sm-12 planificarviaje">        
                                        <div class="form-group">
                                            <span class="input-group-addon">VIAJE ID</span>
                                            <input type="text" class="form-control" name="vid" id="vid" value="<?php echo $pagos[0][0]; ?>"  readonly="true">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 planificarviaje">        
                                        <div class="form-group">
                                            <span class="input-group-addon">CONDUCTOR ID</span>
                                            <input type="text" class="form-control" name="cid" id="cid" value="<?php echo $pagos[0][9]; ?>"  readonly="true">
                                        </div>
                                </div>
                            </div>
                            <div class="row">            
                                <div class="col-sm-12 planificarviaje">        
                                        <div class="form-group">
                                            <span class="input-group-addon">FECHA HORA SALIDA</span>
                                            <input type="text" class="form-control" name="fecha_viaje" id="fecha_viaje" value="<?php echo $pagos[0][3]; ?>"  readonly="true">
                                        </div>
                                </div>
                            </div>          
                            <div class="row">
                                <div class="col-sm-12 planificarviaje">
                                    <div class="form-group">
                                        <span class="input-group-addon">NUEVO CONDUCTOR</span>
                                        <select name="conductor" class="form-control" id="conductor">
                                            <option value="0:0:0">Elige un conductor</option>
                                            <?php 
                                                //$controller = new controller();
                                                if($pagos[0][12]!=1)
                                                    $conductor = $controller->getConductorsConCorrectDocuments($databasecon,$pagos[0][3],0,$DEBUG_STATUS);
                                                else  
                                                    $conductor = $controller->getConductorsConCorrectDocuments($databasecon,$pagos[0][3],1,$DEBUG_STATUS);
                                                for($x=0;$x<count($conductor);$x++)
                                                {
                                                    echo "<option value='".$conductor[$x][0]."'>".strtoupper($conductor[$x][1]).'      ['.$conductor[$x][2].']'."</option>";
                                                    /*echo "<option value='".$conductor[$x][0].':8'."'>".$conductor[$x][1].'      [8]'."</option>";*/
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                                                   
                        </div>
                        <div class="col-sm-4">                
                        </div>
                    </div>
                    <br>
                    <div class="row">        
                        <button type="submit" class="btn btn-info btn_center">CAMBIAR <span class="glyphicon glyphicon-chevron-right"></span></button>
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