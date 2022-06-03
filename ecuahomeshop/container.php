<?php

    session_start();
   
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    //session_start();
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;

    //PARAMETROS DE PAGINACION
    $pagination_count=$dataPorPagina;
    $total_count=0;
    $first_page=0;
    $last_page=0;
    $prev_page_count=0;
    $next_page_count=0;
    $total_pages=1;
    $nombre_pagina='index.php';
    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;

    if($DEBUG_STATUS)
    {
        echo 'USERID::'.$_SESSION['userid'].'<br>';
        echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
        //echo 'ROLE::'.$_SESSION['userRole'].'<br>';
    }
    if(isset($_SESSION['LAST_ACTIVITY']))
    {
        if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
        {
            $url="index.php";
            session_start();
            session_destroy();
            header("Location:$url"); 
        }
        else
              $_SESSION['LAST_ACTIVITY'] = time();
    }
    else
        $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }


    if(isset($_GET['business_id']))
        $business_id=$_GET['business_id'];
    else
        $business_id='';
    include_once('util.php');    
    include_once('banner.php');
    include_once('menu.php');
    $_SESSION["currect_url"] = basename($_SERVER['REQUEST_URI']);


    $controller = new controller();
    $data = $controller->getAllBusinessData($databasecon,$business_id,0,$current_page,$pagination_count,$DEBUG_STATUS);
    
?>
<br>
<div class="row">        
    <div class="col-sm-1">
    </div>
    <?php
        include_once('sidemenu.php');
    ?>
    <div class="col-sm-8 databox">
        <!-- <div class="row">
            <div class="col-sm-12 databox-title">GASTRONOMIA</div>
        </div> -->
        <div class="row bg-01">
            <div class="col-sm-12 databox-count"><?=count($data);?> NEGOCIOS ENCONTRADO</div>
        </div>
        <?php
            if(isset($data) && count($data)>0)
            {
                $total_pages=ceil(count($data)/$pagination_count);
                $last_page = $total_pages-1;
                //echo 'total_pages:'.$total_pages.'<br>';
                //echo 'last_page:'.$last_page.'<br>';
                $data = $controller->getAllBusinessData($databasecon,$business_id,1,$current_page,$pagination_count,$DEBUG_STATUS);
                include('configPagination.php');
                for($x=0;$x<count($data);$x++)
                {
        ?>
        <?php
            
        ?>
        <div class="row databox">
            <div class="col-sm-2 databox-img">
                <img src=<?=$data[$x][12].'?rand='.rand()?> width="100%">
            </div>
            <div class="col-sm-10 databox-data">
                <div class="row">
                    <div class="col-sm-3 databox-label">NOMBRE</div>
                    <div class="col-sm-9 databox-desc"><?=$data[$x][0];?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 databox-label">CATEGORIA</div>
                    <div class="col-sm-9 databox-desc"><?=$data[$x][1];?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 databox-label">QUE ENCUNETRAS</div>
                    <div class="col-sm-9 databox-desc"><?=$data[$x][2];?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 databox-label">DIRECCION</div>
                    <div class="col-sm-9 databox-desc"><?=$data[$x][3];?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 databox-label">CONTACTOS</div>
                    <div class="col-sm-9 databox-desc">
                        <i class="glyphicon glyphicon-earphone glyphicon-style"></i>  <?=$data[$x][4];?>
                        <i class="glyphicon glyphicon-phone-alt glyphicon-style" style="padding-left:15px"></i>  <?=$data[$x][5];?>
                        <i class="glyphicon glyphicon-envelope glyphicon-style" style="padding-left:15px"></i>  <?=$data[$x][6];?>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-sm-3 databox-label">HORARIOS</div>
                    <div class="col-sm-9 databox-desc">
                        <i class="glyphicon glyphicon-time"></i> Lun - Vie : 09H00 - 19H00,Sab : 10H00 - 17H00, Dom : 10H00 - 14H00
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 databox-label">MAPA</div>
                    <div class="col-sm-9 databox-desc"><a href="#"><i class="glyphicon glyphicon-map-marker"></i></a></div>
                </div> -->
                <div class="row">
                    <div class="col-sm-3 databox-label">DESCRIPCION</div>
                    <div class="col-sm-9 databox-desc">
                        <i class="glyphicon glyphicon-list-alt glyphicon-style"></i>
                        <?=$data[$x][9];?>
                    </div>
                </div>
            </div>
        </div>

        <?php
            }
            echo '<br>';
            include('configPagination.php');
        }
        ?>
    </div>
    <div class="col-sm-1">
    </div>
</div>
<br>