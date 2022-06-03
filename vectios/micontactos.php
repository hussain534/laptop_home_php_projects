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
        $_SESSION["last_url"]='misreservas.php';
        //echo $_SESSION["last_url"];
        header("Location:$url"); 
    }
    $controller = new controller();
    
    //$solicitudDtl=$controller->misSolicitudes($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
    
    $_SESSION['LAST_ACTIVITY'] = time();
    $passengerList=$controller->getMiContactos($databasecon,$DEBUG_STATUS);
    
  include_once('header.php');

?>
<br>
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
        <div class="col-sm-10 bg-crimson">
            <br>
            <h3 style="text-align:center;color:#FFF;margin-top:1px">MI CONTACTOS</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 inner_body-block">
            <div class="row">                
                <div class="col-sm-12">
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h6>SE ENCUENTRO <?php echo count($passengerList);?> CONTACTOS</h6>
                        </div>
                    </div>
                    <br>
                    <br>
                    
                    <br>
                    <div class="row">
                        <?php
                            for($x=0;$x<count($passengerList);$x++) 
                            {
                                if($x>0 && $x%1==0)
                                {
                                    echo '</div><br><br><br><br><div class="row">';
                                }
                        ?>
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-2">
                                    <img src='<?php echo $passengerList[$x][0];?>' width="140px" height="140px">
                                </div>
                                <div class="col-sm-8">
                                    <div class="passenger-block"><p><?php echo strtoupper($passengerList[$x][1]); ?><span id=estadoAprobacion_<?php echo $x;?> style="float:right"></span></p></div>
                                    <input type="hidden" value="<?php echo $passengerList[$x][6];?>" id=solicitante_<?php echo $x;?>>
                                    <div class="passenger-block"><span>INTERESES PERSONAL:<br></span><?php echo $passengerList[$x][2]; ?></div>
                                    <div class="passenger-block"><span>INTERESES DE NEGOCIOS:<br></span><?php echo $passengerList[$x][3]; ?></div> 
                                    <div id="btnChange">   
                                    <?php
                                        if($passengerList[$x][4]==1 && $passengerList[$x][5]==$_SESSION['userid'])
                                        {
                                        ?>
                                            <div class="passenger-block"><button type="button"  class="btn btn-sm btn-info" style="border-radius: 5px" onclick="aprobarContacto(<?php echo $x;?>)">APROBAR CONTACTO <img src="images/addFriend.png" style="width: 36px;top: -3px;position: relative;"></button></div>
                                        <?php 
                                        }
                                        else if($passengerList[$x][4]==1)
                                        {
                                        ?>
                                            <div class="passenger-block"><button type="button"  class="btn btn-sm btn-warning" style="border-radius: 5px">APROBACION PENDIENTE <img src="images/addFriend.png" style="width: 36px;top: -3px;position: relative;"></button></div>
                                        <?php 
                                        }
                                        else if($passengerList[$x][4]==2)
                                        {
                                        ?>
                                            <div class="passenger-block"><button type="button"  class="btn btn-sm btn-success" style="border-radius: 5px">ESTA EN CONTACTO <img src="images/addFriend.png" style="width: 36px;top: -3px;position: relative;"></button></div>
                                        <?php 
                                        }
                                        else
                                        {
                                        ?>
                                            <div class="passenger-block"><button type="button"  class="btn btn-sm btn-danger" style="border-radius: 5px">ESTA BLOQUEADO / ELIMINADO <img src="images/inContacto.png" style="width: 36px;top: -3px;position: relative;"> </button></div>
                                        <?php    
                                        }
                                    ?>  
                                    </div>                              
                                </div>
                                <div class="col-sm-1">
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>
</div>

<?php
include_once('container_footer.php');
?>
