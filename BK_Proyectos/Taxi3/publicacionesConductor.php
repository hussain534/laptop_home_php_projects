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

    if(isset($_POST['submitted']) && isset($_POST['searchUserId']) && isset($_POST['estado']))
    {
        $estado = $_POST['estado'];
        $userId=$_POST['searchUserId'];
    }
    else
    {
        $estado=0;
        $userId=0;
    }
    $viajeDtl=$controller->publicacionesConductor($databasecon,$userId,$estado,$DEBUG_STATUS);
    
    
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
                    <center><img src="images/icon_publicaciones.png"></center>
                    <h3 style="text-align:center;color:#222;margin-top:1px">PUBLICACIONES DE VIAJES</h3>
                </div>
            </div>
            <form method="post" action=publicacionesConductor.php enctype="multipart/form-data">
                    <input type="hidden" name="submitted" value="true" />
                    <div class="row">
                        <div class="col-sm-1">    
                        </div>  
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select name="estado" class="form-control" id="estado">
                                    <option value="99">ELIGE ESTADO DE VIAJE</option>
                                    <option value="99">TODOS</option>
                                    <option value="1">PUBLICADO</option>
                                    <option value="2">PROGRAMADO</option>
                                    <option value="3">EN EJECUCION</option>
                                    <option value="4">TERMINADO</option>
                                    <option value="5">CANCELADO</option>
                                    <option value="6">PAGO PENDIENTE</option>
                                    <option value="7">PAGADO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <input type="text" class="form-control" name="searchUserId" value="" placeholder="INGRESAR CODIGO DE CONDUCTOR">
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary" style="margin:0;padding:0;min-width:50px !important"><img src="images/search.png" style="width:62%"></button>
                        </div>
                    </div>
                </form>
            <div class="col-sm-12">
                <div class="row">
                    <h6>SE ENCUENTRO 
                        <?php 
                            echo count($viajeDtl).' VIAJES ';
                            if($estado==1)
                                echo 'PUBLICADO';
                            else if($estado==2)
                                echo 'PROGRAMADO';
                            else if($estado==3)
                                echo 'EN EJECUCION';
                            else if($estado==4)
                                echo 'TERMINADO';
                            else if($estado==5)
                                echo 'CANCELADO';
                            else if($estado==6)
                                echo 'PAGO PENDIENTE';
                            else if($estado==7)
                                echo 'PAGADO';
                        ?> 
                    </h6>
                </div>
                <div class="row">                                
                    <div class="table-responsive">
                        <table class="table" style="border:1px solid darkgrey">
                            <thead>
                                <tr class="success_row" style="border:1px solid darkgrey">
                                    <th>VIAJE ID</th>
                                    <th>NOMBRE CONDUCTOR</th>
                                    <th>DESDE</th>
                                    <th>HASTA</th>                                    
                                    <th>FECHA SALIDA</th>
                                    <th>ESTADO</th>
                                    <th>COSTO<br>( $ )</th>
                                    <th>ASIENTOS PUBLICADO</th>
                                    <th>ASIENTOS OCUPADO</th>
                                    <th>FECHA PUBLICADO</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for($x=0;$x<count($viajeDtl);$x++) 
                                    {
                                        if(strcmp($viajeDtl[$x][4],'TERMINADO')==0 || strcmp($viajeDtl[$x][4],'PAGADO')==0)
                                        {
                                            $str='<a href=pagarConductor.php?codigo_viaje='.$viajeDtl[$x][10].'>PAGAR CONDUCTOR</a>';
                                        }
                                        else
                                            $str='';
                                        echo '<tr class="warning myrow"><td>'.$viajeDtl[$x][9].'</td><td>'.$viajeDtl[$x][0].'</td><td>'.$viajeDtl[$x][1].'</td><td>'.$viajeDtl[$x][2].'</td><td>'.$viajeDtl[$x][3].'</td><td>'.$viajeDtl[$x][4].'</td><td>'.$viajeDtl[$x][5].'</td><td>'.$viajeDtl[$x][6].'</td><td>'.$viajeDtl[$x][7].'</td><td>'.$viajeDtl[$x][8].'</td><td>'.$str.'</td></tr>';    
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <a href="#" id="top"><span class="glyphicon glyphicon-arrow-up" style="float:right;margin:5px 10px; color:#01c5c5">TOP</span></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>

<?php
include_once('container_footer.php');
?>
