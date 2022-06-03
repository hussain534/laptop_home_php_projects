<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
      

    if(isset($_GET["id"]))
    {
        $controller = new controller();
        $resultado = $controller->activarCuenta($databasecon,$_GET["id"],$DEBUG_STATUS);
?>
    <br>    
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 text-center">
            <div class='alert alert-success shopAlert'>
                <?php
                    if($resultado==0)
                        echo '<h3>Felicitaciones!</h3>Su cuenta esta activado.';
                    else
                    {
                        echo '<h3>Disculpa!</h3> No se ha podido activar su cuenta en este momento.<br>Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@zielus.com';
                                                
                    }
                    echo '<br><br><a href="userLogin.php"><input type="button" value="INICAR SESION" class="btn btn-warning btn-small"></a>';
                ?>
             </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
<?php
    }
    ?>