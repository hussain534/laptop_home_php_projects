<?php
    defined('__JEXEC') or ('Access denied');
    session_start();

    //PARAMETROS COMUNES PARA PAGINAS EN SESSION
    include_once('config.php'); 
    $DEBUG_STATUS = $PRINT_LOG;
    $session_time = $session_expirry_time;
    
    


    //VALIDAR SESSION
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


    //CARGAR MENU PRINCIPAL
    include_once('menuPanel.php');

    //PARAMETROS DE MENSAJE/ERRORES
    $message='';
    if(isset($_SESSION["message"])) 
    {
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    //CARGAR CLASE DE BDD
    require 'dbcontroller.php';
    $controller = new controller();

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        //echo 'FECHA:'.$_POST["fecha_actividad"].'<br>';
        //$err_code = $controller->asignarPuntos($databasecon,$_POST["fecha_actividad"],$_POST["motivo"],$_POST["puntaje"],$_POST["postulante"],$_POST["ganador"],$DEBUG_STATUS);
        
        $arrGanador=explode(",", $_POST["id_equipos"]);
        for($t=1;$t<count($arrGanador);$t++)
        {
            $err_code = $controller->asignarPuntos($databasecon,$_POST["fecha_actividad"],$_POST["motivo"],$_POST["puntaje"],$_POST["postulante"],$arrGanador[$t],$DEBUG_STATUS);
            
            //echo 'SQL:'.$err_code.'<br>';
            if($err_code==1)
            {
                $message="REGISTRO GRABADO CORRECTAMENTE";
            }
            else if($err_code==2)
            {
                $message="REGISTRO GRABADO CORRECTAMENTE, PERO ERROR OCURIDO EN ENVIAR CORREO ELECTRONICO";
            }
            else
            {
                $message="ERROR EN GRABAR REGISTRO";   
            }
        }
    }
        
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
        <div class="col-sm-12">
            <!-- TITULO -->
            <div class="row">
                <div class="col-sm-1 text-right">
                    <img src="images/Mi_Puntaje.jpg" style="width:50px;">
                </div>
                <div class="col-sm-6">
                    <p style="font-size:36px">ADMINISTRAR PUNTOS</p>
                </div>
            </div>     
            <hr>
            <br>

            <!-- BOTONES -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <a href="adminPuntos.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-plus-sign my-glyphicon"></span>CREAR</button></a>                        
                        <a href="exportExcel.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-download-alt my-glyphicon"></span>EXPORTAR EXCEL</button></a>                        
                        <a href="dashboard.php"><button type="button" class="btn btn-lg"><i class="fa fa-line-chart" my-glyphicon></i>DASHBOARD</button></a>
                        <a href="puntos.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-arrow-left my-glyphicon"></span>ATRAS</button></a>
                    </div>    
                </div>
            </div> 
            <hr>
            <br>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <form action="adminPuntos.php" method="post">
                        <input type="hidden" name="submitted" value="true">

                        <label for="fecha_actividad">FECHA DE LA ACTIVIDAD (DD/MM/AAAA)</label>
                        <input type="date" class="form-control" id="fecha_actividad" maxlength=10 name="fecha_actividad" placeholder="NRO CONTACTO" required>
                        <div class="errmsg" id="error_fecha_actividad"></div>
                        <br>

                        <label for="motivo">MOTIVO</label>
                        <textarea class="form-control" name="motivo" placeholder="Escribe su mensaje" maxlength="500" rows="4" required></textarea>
                        <div class="errmsg" id="error_motivo"></div>
                        <br>

                        <label for="puntaje">PUNTAJE</label>
                        <select name="puntaje" class="form-control" id="puntaje" onchange="getImpactoEmblema()" required>
                            <?php
                                $puntaje = $controller->getCatalogPuntaje($databasecon,$DEBUG_STATUS);
                                if(isset($puntaje) && count($puntaje)>0)
                                {
                                    for($x=0;$x<count($puntaje);$x++)
                                    {
                                        echo "<option value='".$puntaje[$x][0]."'>".$puntaje[$x][3]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <br>

                        <label for="impacto">IMPACTO</label>
                        <input type="text" class="form-control" id="impacto" maxlength=100 name="impacto" value="SHURIKEN" readonly="true">
                        <div class="errmsg" id="error_impacto"></div>
                        <br>

                        <label for="emblema">EMBLEMA</label>
                        <div id="emblema">
                            <img src="images/Shuriken_(-45).jpg"/>
                        </div>
                        <br>

                        <label for="postulante">POSTULANTE</label>
                        <select name="postulante" class="form-control" id="postulante"  required>
                                <option value="0">Elige Postulante</option>
                            <?php
                                $postulante = $controller->getUserList($databasecon,0,$current_page,$pagination_count,$strBusqueda,$DEBUG_STATUS);
                                if(isset($postulante) && count($postulante)>0)
                                {
                                    for($x=0;$x<count($postulante);$x++)
                                    {
                                        echo "<option value='".$postulante[$x][0]."'>".$postulante[$x][1].' '.$postulante[$x][2]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <br>

                        <!-- <label for="ganador">GANADOR</label>
                        <select name="ganador" class="form-control" id="ganador"  required>
                                <option value="0">Elige GANADOR</option>
                            <?php
                                $ganador = $controller->getUserList($databasecon,0,$current_page,$pagination_count,$strBusqueda,$DEBUG_STATUS);
                                if(isset($ganador) && count($ganador)>0)
                                {
                                    for($x=0;$x<count($ganador);$x++)
                                    {
                                        echo "<option value='".$ganador[$x][0]."'>".$ganador[$x][1].' '.$ganador[$x][2]."</option>";
                                    }
                                }
                            ?>
                        </select> -->
                        <input type="hidden" id="id_equipos" name="id_equipos" value="0" size="500">                        
                        <label for="ganador"> ELIGE GANADOR</label>
                                <?php
                                    $ganador = $controller->getUserList($databasecon,0,0,0,null,$DEBUG_STATUS);
                                    if(isset($ganador) && count($ganador)>0)
                                    {
                                        for($x=0;$x<count($ganador);$x++)
                                        {
                                ?>
                                    <div class="row">
                                        <div class="col-sm-5 bg-ganador">
                                            <?php echo '<input type="checkbox" onchange=addToListList("'.$ganador[$x][0].'")>';?>
                                            <?php echo $ganador[$x][1].' '.$ganador[$x][2];?>
                                        </div>
                                    </div>
                                <?php
                                        }
                                    }
                                ?>
                        <br>

                        <button type="submit" class="btn btn-small btn_center">GRABAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                        <br>
                    </form>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <br>
            <br>
               
        </div>
    </div>
</div>
<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("user_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
        {
            alert("ERROR FORMATO EMAIL");
            return false;
        }
        else
            return true;
}
</script>

<?php
    include_once('footer.php');
?>