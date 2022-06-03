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

    $ene = $controller->getUserDashboard($databasecon,'01',$DEBUG_STATUS);
    $feb = $controller->getUserDashboard($databasecon,'02',$DEBUG_STATUS);
    $mar = $controller->getUserDashboard($databasecon,'03',$DEBUG_STATUS);
    $abr = $controller->getUserDashboard($databasecon,'04',$DEBUG_STATUS);
    $may = $controller->getUserDashboard($databasecon,'05',$DEBUG_STATUS);
    $jun = $controller->getUserDashboard($databasecon,'06',$DEBUG_STATUS);
    $jul = $controller->getUserDashboard($databasecon,'07',$DEBUG_STATUS);
    $ago = $controller->getUserDashboard($databasecon,'08',$DEBUG_STATUS);
    $sep = $controller->getUserDashboard($databasecon,'09',$DEBUG_STATUS);
    $oct = $controller->getUserDashboard($databasecon,'10',$DEBUG_STATUS);
    $nov = $controller->getUserDashboard($databasecon,'11',$DEBUG_STATUS);
    $dic = $controller->getUserDashboard($databasecon,'12',$DEBUG_STATUS);

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
                    <p style="font-size:36px">DASHBOARD</p>
                </div>
            </div>     
            <hr>
            <br>

            
            
            <div class="row">
                <div class="col-sm-12 text-right">
                    <div class="relative">
                      <img src="images/shield3.png" alt="">
                      <p class="absolute-text"><?=$puntos;?></p>
                      <?php
                            if($_SESSION["user_perfil"]==3)
                            {                    
                        ?>
                      <p class="absolute-text2">posicion: <?=$position;?></p>
                      <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            
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
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-blue1.png" alt="">
                          <p class="absolute-text3">ENE</p>
                          <p class="absolute-text4"><?=$ene;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-green1.png" alt="">
                          <p class="absolute-text3">FEB</p>
                          <p class="absolute-text4"><?=$feb;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-blue1.png" alt="">
                          <p class="absolute-text3">MAR</p>
                          <p class="absolute-text4"><?=$mar;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-green1.png" alt="">
                          <p class="absolute-text3">ABR</p>
                          <p class="absolute-text4"><?=$abr;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-blue1.png" alt="">
                          <p class="absolute-text3">MAY</p>
                          <p class="absolute-text4"><?=$may;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-green1.png" alt="">
                          <p class="absolute-text3">JUN</p>
                          <p class="absolute-text4"><?=$jun;?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-blue1.png" alt="">
                          <p class="absolute-text3">JUL</p>
                          <p class="absolute-text4"><?=$jul;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-green1.png" alt="">
                          <p class="absolute-text3">AGO</p>
                          <p class="absolute-text4"><?=$ago;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-blue1.png" alt="">
                          <p class="absolute-text3">SEP</p>
                          <p class="absolute-text4"><?=$sep;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-green1.png" alt="">
                          <p class="absolute-text3">OCT</p>
                          <p class="absolute-text4"><?=$oct;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-blue1.png" alt="">
                          <p class="absolute-text3">NOV</p>
                          <p class="absolute-text4"><?=$nov;?></p>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="relative1">
                          <img src="images/postit-green1.png" alt="">
                          <p class="absolute-text3">DIC</p>
                          <p class="absolute-text4"><?=$dic;?></p>
                        </div>
                    </div>
                </div>
            <br>
               
        </div>
    </div>
</div>


<?php
    include_once('footer.php');
?>