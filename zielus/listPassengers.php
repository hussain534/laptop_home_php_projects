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
    $passengerList=$controller->getPassengerList($databasecon,$_GET['viajeId'],$DEBUG_STATUS);
    //$solicitudDtl=$controller->misSolicitudes($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
    
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">DETALLES PASAJEROS</h3>
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
                    <?php  if(isset($message)) 
                        {
                    ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class='alert alert-success shopAlert'>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php  echo $message; ?>
                             </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <h6>SE ENCUENTRO <?php echo count($passengerList);?> PASAJEROS PRINCIPALES</h6>
                    </div>
                    <div class="row">                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="success_row">
                                        <th>FOTO</th>
                                        <th>NOMBRE</th>
                                        <th>CEDULA</th>
                                        <th>NRO. PASAJES</th>
                                        <th>CELULAR</th>
                                        <th>CONVENCIONAL</th>                                    
                                        <th>DIRECCION</th>
                                        <th>REFERENCIA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($x=0;$x<count($passengerList);$x++) 
                                        {
                                            echo '<tr class="warning myrow">
                                                    <td><img src='.$passengerList[$x][0].' width="75px" height="75px"></td>
                                                    <td>'.$passengerList[$x][1].'</td>
                                                    <td>'.$passengerList[$x][2].'</td>
                                                    <td>'.$passengerList[$x][3].'</td>
                                                    <td>'.$passengerList[$x][4].'</td>
                                                    <td>'.$passengerList[$x][5].'</td>
                                                    <td>'.$passengerList[$x][6].'</td>
                                                    <td>'.$passengerList[$x][7].'</td>
                                                </tr>'; 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
