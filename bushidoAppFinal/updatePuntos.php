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

    if(isset($_GET["id"]))
        $id=$_GET["id"];

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        $err_code = $controller->updatePuntos($databasecon,$_POST["id"],$_POST["fecha_actividad"],$_POST["motivo"],$_POST["puntaje"],$_POST["postulante"],$_POST["ganador"],$DEBUG_STATUS);
        //echo 'SQL:'.$err_code.'<br>';
        if($err_code==1)
        {
            $message="REGISTRO ACTUALIZADO CORRECTAMENTE";
        }
        else if($err_code==2)
        {
            $message="REGISTRO ACTUALIZADO CORRECTAMENTE, PERO ERROR OCURIDO EN ENVIAR CORREO ELECTRONICO";
        }
        else
        {
            $message="ERROR EN ACTUALIZAR REGISTRO";   
        }
    }

    $userList = $controller->getUserPuntosById($databasecon,$id,$DEBUG_STATUS);    
    echo 'FECHA:'.$userList[0][0].'<br>';   
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
                    <form action="updatePuntos.php?id=<?php echo $id;?>" method="post">
                        <input type="hidden" name="submitted" value="true">
                        <input type="hidden" name="id" value="<?=$userList[0][8];?>">

                        <label for="fecha_actividad">FECHA DE LA ACTIVIDAD (DD/MM/AAAA)</label>
                        <input type="date" class="form-control" id="fecha_actividad" maxlength=10 value="<?=$userList[0][0];?>" name="fecha_actividad" placeholder="NRO CONTACTO" required>
                        <div class="errmsg" id="error_fecha_actividad"></div>
                        <br>

                        <label for="motivo">MOTIVO</label>
                        <textarea class="form-control" name="motivo" placeholder="Escribe su mensaje" maxlength="500" rows="4" required><?=$userList[0][2];?></textarea>
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
                                        if($userList[0][3]==$puntaje[$x][0])
                                            echo "<option value='".$puntaje[$x][0]."' selected=true>".$puntaje[$x][3]."</option>";
                                        else
                                            echo "<option value='".$puntaje[$x][0]."'>".$puntaje[$x][3]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <br>

                        <label for="impacto">IMPACTO</label>
                        <?php
                            if($userList[0][3]==1)
                            {
                        ?>
                                <input type="text" class="form-control" id="impacto" maxlength=100 name="impacto" value="SHURIKEN" readonly="true">
                        <?php
                            }
                            else if($userList[0][3]==2)
                            {
                        ?>
                                <input type="text" class="form-control" id="impacto" maxlength=100 name="impacto" value="BAJO IMPACTO" readonly="true">
                        <?php
                            }
                            else if($userList[0][3]==3)
                            {
                        ?>
                                <input type="text" class="form-control" id="impacto" maxlength=100 name="impacto" value="MEDIANO IMPACTO" readonly="true">
                        <?php
                            }
                            else if($userList[0][3]==4)
                            {
                        ?>
                                <input type="text" class="form-control" id="impacto" maxlength=100 name="impacto" value="ALTO IMPACTO" readonly="true">
                        <?php
                            }
                        ?>
                        <!-- <input type="text" class="form-control" id="impacto" maxlength=100 name="impacto" value="-45" readonly="true">
                        <div class="errmsg" id="error_impacto"></div>
                        <br> -->

                        <label for="emblema">EMBLEMA</label>
                        <div id="emblema">
                            <?php
                                if($userList[0][3]==1)
                                {
                            ?>
                                    <img src="images/Shuriken_(-45).jpg"/>
                            <?php
                                }    
                                else if($userList[0][3]==2)
                                {
                            ?>
                                    <img src="images/Bajo_Impacto.jpg"/>
                            <?php
                                }    
                                else if($userList[0][3]==3)
                                {
                            ?>
                                    <img src="images/Mediano_Impacto.jpg"/>
                            <?php
                                }    
                                else if($userList[0][3]==4)
                                {
                            ?>
                                    <img src="images/Alto_Impacto.jpg"/>
                            <?php
                                }
                            ?>
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
                                        if($userList[0][6]==$postulante[$x][0])
                                            echo "<option value='".$postulante[$x][0]."' selected=true>".$postulante[$x][1].' '.$postulante[$x][2]."</option>";
                                        else
                                            echo "<option value='".$postulante[$x][0]."'>".$postulante[$x][1].' '.$postulante[$x][2]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <br>

                        <label for="ganador">GANADOR</label>
                        <select name="ganador" class="form-control" id="ganador"  required>
                                <option value="0">Elige GANADOR</option>
                            <?php
                                $ganador = $controller->getUserList($databasecon,0,$current_page,$pagination_count,$strBusqueda,$DEBUG_STATUS);
                                if(isset($ganador) && count($ganador)>0)
                                {
                                    for($x=0;$x<count($ganador);$x++)
                                    {
                                        if($userList[0][7]==$ganador[$x][0])
                                            echo "<option value='".$ganador[$x][0]."' selected=true>".$ganador[$x][1].' '.$ganador[$x][2]."</option>";
                                        else
                                            echo "<option value='".$ganador[$x][0]."'>".$ganador[$x][1].' '.$ganador[$x][2]."</option>";
                                    }
                                }
                            ?>
                        </select>
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