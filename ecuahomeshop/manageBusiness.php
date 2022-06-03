<?php

       session_start();
   
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    //session_start();
    
    require 'dbcontroller.php';
    $showListPanel=true;
    $DEBUG_STATUS = $PRINT_LOG;
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


    if(isset($_GET['id']))
        $id=$_GET['id'];
    else
        $id='';
    include_once('util.php');    
    include_once('banner.php');
    include_once('menu.php');
    $_SESSION["currect_url"] = basename($_SERVER['REQUEST_URI']);


    $controller = new controller();
    $data = $controller->getAllBusinessData($databasecon,$id,0,0,0,$DEBUG_STATUS);
?>


<div class="container home-data">
    <br>
    <br>
    <div class="row">        
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 prolist">
            <?php
                include_once('listPanel.php');
            ?>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <div class="row">        
        <div class="col-sm-1">
        </div>
        <?php
            include_once('sidemenu.php');
        ?>
        <div class="col-sm-8 prolist">
            <div class="home-data-panel">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary button-style" id="btnOpenNewBusinessForm">+ NUEVO NEGOCIO</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php
                            for($x=1;$x<=count($data);$x++)
                            {
                        ?>
                        
                            <?php
                                if($x%6!=0)
                                {
                            ?>
                                <div class="col-sm-2 databox-img-2">
                                    <a href=editBusiness.php?business_id=<?=$data[$x-1][13] ?>><img src=<?=$data[$x-1][12].'?rand='.rand()?> width="100%"></a>
                                </div> 
                            <?php
                                }
                                else
                                {
                            ?>
                                    <div class="col-sm-2 databox-img-2">
                                        <a href=editBusiness.php?business_id=<?=$data[$x-1][13] ?>><img src=<?=$data[$x-1][12].'?rand='.rand()?> width="100%"></a>
                                    </div>
                                </div>
                                <div class="row">
                            <?php        
                                }
                            ?> 
                        
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
        include_once('footer.php');
    ?>
</div>