<?php
    session_start();

    if(!isset($_SESSION['LAST_LOGIN_TIME']))
    {
        session_destroy();
        $url='index.php';
        $_SESSION["res_code"]=$res_code_9998;
        header("Location:$url");
    }
    include_once('000_util.php');
    include_once('000_header.php');
    include_once('000_config.php');
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
    include_once('001_sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            DASHBOARD
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
                if(isset($_SESSION["res_code"]))
                {
            ?>
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION["res_code"];?>
                    </div>
            <?php
                    unset($_SESSION["res_code"]);
                }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>