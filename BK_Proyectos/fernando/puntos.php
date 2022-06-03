<?php
    defined('__JEXEC') or ('Access denied');
    session_start();

    //PARAMETROS COMUNES PARA PAGINAS EN SESSION
    include_once('config.php'); 
    $DEBUG_STATUS = $PRINT_LOG;
    $session_time = $session_expirry_time;
    
    //PARAMETROS DE PAGINACION
    $pagination_count=$dataPorPagina;
    $total_count=0;
    $first_page=0;
    $last_page=0;
    $prev_page_count=0;
    $next_page_count=0;
    $total_pages=1;
    $nombre_pagina='puntos.php';
    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;


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

    $userList = $controller->getUserPuntos($databasecon,0,$current_page,$pagination_count,null,$DEBUG_STATUS);
    $puntos=0;
    $position=0;
    if(count($userList)>0)
    {
         $puntos=$userList[0][9];
         $position=$userList[0][10];
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
                    <p style="font-size:36px">PUNTAJES</p>
                </div>
                <div class="col-sm-5 text-right">
                     <form action="puntos.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="str-busqueda" placeholder="BUSQUEDA RAPIDA">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>     
            <hr>
            <br>

            
            <!-- <div class="row">
                <div class="col-sm-12 text-right">
                        <p><?=$userList[0][9];?></p>
                        <img src="images/puntajes.png" style="width:400px">

                </div>
            </div> 
            <br> -->
            <?php
                if($_SESSION["user_perfil"]==3)
                {
            ?>
            <div class="row">
                <div class="col-sm-12 text-right">
                    <div class="relative">
                      <img src="images/shield3.png" alt="">
                      <p class="absolute-text"><?=$puntos;?></p>
                      <p class="absolute-text2">posicion: <?=$position;?></p>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>


            <!-- BOTONES -->
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <?php
                            if($_SESSION["user_perfil"]<3)
                            {
                        ?>
                        <a href="adminPuntos.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-plus-sign my-glyphicon"></span>CREAR</button></a>                        
                        <a href="exportExcel.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-download-alt my-glyphicon"></span>EXPORTAR EXCEL</button></a>                        
                        <?php
                            }
                        ?>
                        <a href="dashboard.php"><button type="button" class="btn btn-lg"><i class="fa fa-line-chart" my-glyphicon></i>DASHBOARD</button></a>

                    </div>    
                </div>
            </div> 
            <hr>
            <br>
            

            <!-- VISTA DE TABLA -->
            <div class="table-responsive">          
              <table class="table">
                <thead>
                  <tr>
                    <th>FECHA DEL ACTIVIDAD</th>
                    <th>FECHA INGRESO</th>
                    <th>MOTIVO</th>
                    <th>PUNTAJE</th>
                    <th>IMPACTO</th>
                    <th>EMBLEMA</th>
                    <th>POSTULANTE</th>
                    <th>GANADOR</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_POST["str-busqueda"]))
                            $strBusqueda=$_POST["str-busqueda"];
                        else
                            $strBusqueda=null;
                        $userList = $controller->getUserPuntos($databasecon,0,$current_page,$pagination_count,$strBusqueda,$DEBUG_STATUS);
                        if(isset($userList) && count($userList)>0)
                        {
                            $total_pages=ceil(count($userList)/$pagination_count);
                            $last_page = $total_pages-1;
                            $userList = $controller->getUserPuntos($databasecon,1,$current_page,$pagination_count,$strBusqueda,$DEBUG_STATUS);
                            for($x=0;$x<count($userList);$x++)
                            {
                    ?>
                              <tr class="rowdata">
                                <td class="data"><?=$userList[$x][0];?></td>
                                <td class="data"><?=$userList[$x][1];?></td>
                                <td class="data"><?=$userList[$x][2];?></td>
                                <td class="data"><?=$userList[$x][3];?></td>
                                <td class="data"><?=$userList[$x][4];?></td>
                                <td class="data"><div id="emblema_list"><img src=<?=$userList[$x][5];?>></div></td>
                                <td class="data"><?=$userList[$x][6];?></td>
                                <td class="data"><?=$userList[$x][7];?></td>
                                <td class="data">
                                    <?php
                                        if($_SESSION["user_perfil"]<3)
                                        {
                                    ?>
                                    <a href=updatePuntos.php?id=<?php echo $userList[$x][8];?>><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" onclick=delPuntos('<?php echo $userList[$x][8];?>','<?php echo $userList[$x][3];?>','<?php echo urlencode($userList[$x][7]);?>')><span class="glyphicon glyphicon-remove"></span></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                              </tr>
                  <?php            
                            }
                        }
                   ?>
                </tbody>
              </table>
            </div>


            <!-- CARGAR CONTROLES DE PAGINAS -->
            <?php
                include_once('configPagination.php');
            ?>
               
        </div>
    </div>
</div>


<?php
    include_once('footer.php');
?>