<?php
    session_start();

    if(!isset($_SESSION['LAST_LOGIN_TIME']))
    {
        session_destroy();
        $url='index.php';
        $_SESSION["res_code"]=$res_code_9998;
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    

?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            DASHBOARD
        </div>
    </div>  
</div>