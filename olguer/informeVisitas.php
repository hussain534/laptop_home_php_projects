<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    //include_once('util.php');
    include_once('config.php');    
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
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

    
    if(isset($_GET["eid"]))
        $peticiones = $controller->getPeticionesInformeVisitas($databasecon,$_GET["eid"],$DEBUG_STATUS);


    
    
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2 sidebar">
            <?php include_once('menu.php');?>
        </div>
        <div class="col-sm-10">



            <div class="row">
                <div class="col-sm-12">
                    <?php include_once('mysession.php');?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page_title">INFORME VISITAS DE CONTROL</h2>
                </div>
            </div>
            
            <br>
            
            
            
            <div class="row">
                <div class="col-sm-12">
                                            
                    <?php
                        if(isset($peticiones) && count($peticiones)>0)
                            echo '<label for="permisos">SE ENCUENTRA '.count($peticiones).' PETICIONES:</label><br>';
                        else
                            echo '<label for="permisos">SE ENCUENTRA 0 PETICIONES:</label><br>';
                        ?>
                        <div class="row tbl_row_heading">
                            <div class="col-sm-2">
                                <h6>ID</h6>
                            </div>                
                            <div class="col-sm-2">
                                <h6>NOMBRE TECNICO</h6>
                            </div>                        
                            <div class="col-sm-2">                        
                                <h6>FECHA DE CIERRE</h6>
                            </div>
                            <div class="col-sm-3">                        
                                <h6>TIPO SERVICIO</h6>
                            </div>
                            <div class="col-sm-2">                        
                                <h6>ESTADO</h6>
                            </div>
                            <div class="col-sm-1">                        
                                <h6>INFORME</h6>
                            </div>
                        </div>
                        <?php 
                        
                        if(isset($peticiones) && count($peticiones)>0)
                        {
                            for($x=0;$x<count($peticiones);$x++)
                            {
                        ?>
                                <div class="row tbl_row_data_static" style="font-size:12px;line-height: 20px;">
                                    <div class="col-sm-2">                                        
                                        <?php echo $peticiones[$x][0];?>
                                    </div>                
                                    <div class="col-sm-2">        
                                        <?php echo $peticiones[$x][1];?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php echo $peticiones[$x][2];?>
                                    </div>
                                    <div class="col-sm-3">                                    
                                        <?php echo $peticiones[$x][3];?>
                                    </div>
                                    <div class="col-sm-2">                                    
                                        <?php echo $peticiones[$x][4];?>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        <!-- <a href=viewPdf.php?fileId=<?php echo $peticiones[$x][0].'.pdf';?> target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a> -->
                                        <?php
                                            if(isset($peticiones[$x][0]) && file_exists('pdf/'.$peticiones[$x][0].'.pdf'))
                                            {
                                        ?>
                                                <a href=<?php echo 'pdf/'.$peticiones[$x][0].'.pdf';?> target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                                <span class="glyphicon glyphicon-list-alt" style="opacity:0.2"></span>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                        <?php    
                                }    
                            }
                        ?>
                    </div>
                </div>    
            </div>    
            <div class="errmsg" id="error_equipos"></div>        
            <br>            
            <br>







        </div>
    </div>
</div>
