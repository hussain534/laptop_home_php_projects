<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php'); 
    
    $DEBUG_STATUS = $PRINT_LOG;
    $session_time = $session_expirry_time;

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
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    require 'dbcontroller.php';
    $controller = new controller();
        
?>
<style>
    body
    {
        background-color: #2b3e50;
    }
</style>
<div class="container"  id="home">    
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
    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title text-center">
                            <a data-toggle="collapse" href="#collapse1">LINEAMIENTOS GENERALES BUSHIDO</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <li><a href="documentos.php"><img src="images/apple-icon-72x72.png" style="width:35px;margin:10px;">LINEAMINETOS DEL BUSHIDO</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title text-center">
                            <a data-toggle="collapse" href="#collapse2">CAMINO DEL SAMURAI</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <li><a href="puntos.php"><img src="images/Mi_Puntaje.jpg" style="width:35px;margin:10px;">MI PUNTAJE</a></li>                        
                            </ul>                    
                            <h5>AQUI SE REGISTRAN LOS PUNTOS GANADOS POR LOS COLABORADORES</h5>
                        </div>
                    </div>
                </div>
                <?php
                    if($_SESSION["user_perfil"]<3)
                    {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title text-center">
                            <a data-toggle="collapse" href="#collapse3">RRHH</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <li><a href="recursos.php"><img src="images/business-male-team.png" style="width:35px;margin:10px;">PERSONA</a></li>                        
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
    include_once('footer.php');
?>