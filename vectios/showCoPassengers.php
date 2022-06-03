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

    if(isset($_GET["addContactId"]))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }
        $updStatus = $controller->addContact($databasecon,$_GET["addContactId"],$DEBUG_STATUS);

        if($DEBUG_STATUS)
            echo $updStatus.'<br>';
        if($updStatus==0)
        {
            $_SESSION["session_msg"]= 'CONTACTO GUARDADO CORRECTAMENTE';
        }
        else
        {
            $_SESSION["session_msg"]= 'ERROR EN GUARDAR CONTACTO';
        }
    }
    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    $passengerList=$controller->getPassengerListToPassenger($databasecon,$_GET['viajeId'],$DEBUG_STATUS);
    
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
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h6>SE ENCUENTRO <?php echo count($passengerList);?> PASAJEROS PRINCIPALES</h6>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row">                        
                        <!-- <div class="table-responsive">
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
                        </div> -->
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
                                <!-- <div class="col-sm-3 planificarviaje">
                                    <div class="form-group">
                                        <span class="input-group-addon">NOMBRE COMPLETO</span>
                                        <input type="text" class="form-control" name="user_name" value="<?php echo $passengerList[$x][1]; ?>" readonly="true" >
                                    </div>
                                </div> -->
                                <div class="col-sm-8">
                                    <input type="hidden">
                                    <div class="passenger-block"><p><?php echo strtoupper($passengerList[$x][1]); ?></p></div>
                                    <div class="passenger-block"><span>INTERESES PERSONAL:<br></span><?php echo $passengerList[$x][8]; ?></div>
                                    <div class="passenger-block"><span>INTERESES DE NEGOCIOS:<br></span><?php echo $passengerList[$x][9]; ?></div>
                                    <?php 
                                        if($passengerList[$x][11]==0)
                                        {
                                        ?>
                                            <div class="passenger-block"><a href=showCoPassengers.php?viajeId=<?php echo $_GET['viajeId'];?>&addContactId=<?php echo $passengerList[$x][10]; ?> style="border-radius: 5px;"><button type="button"  class="btn btn-sm btn-info" style="border-radius: 5px">AGREGAR CONTACTO <img src="images/addFriend.png" style="width: 36px;top: -3px;position: relative;"></button></a></div>
                                        <?php 
                                        }
                                        else if($passengerList[$x][11]==1)
                                        {
                                        ?>
                                            <div class="passenger-block"><button type="button"  class="btn btn-sm btn-warning" style="border-radius: 5px">APROBACION PENDIENTE <img src="images/addFriend.png" style="width: 36px;top: -3px;position: relative;"></button></div>
                                        <?php 
                                        }
                                        else if($passengerList[$x][11]==2)
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
