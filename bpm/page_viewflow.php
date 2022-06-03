<?php
defined('__JEXEC') or ('Access denied');
    //session_start();
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    //require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(!isset($_SESSION['userEmail']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url="index.php?msgId=9";
        //$_SESSION["last_url"]='misreservas.php';
        header("Location:$url"); 
    }
    
    
    $_SESSION['LAST_ACTIVITY'] = time();

    $controller = new controller();
    //$nodes = $controller->getNodeDtlsByFlowId($databasecon,$_GET["flowId"],$DEBUG_STATUS);  
    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
    include_once('util.php');

?>


<div class="container">
    <div class="row data">
        <div class="col-sm-12 flujo">
            <div class="canvas" id="mainCanvas">
                <?php
                    include_once('canvas_viewflow.php');
                ?>
            </div>
        </div>          
    </div>
</div>
<!-- 
<?php
    include_once("footer.php")
?>   -->  