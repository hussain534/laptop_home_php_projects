<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('header.php');
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <div class="row">
        <div class="col-sm-12">
            <img src="images/graph-examples1.png" class="graph">
        </div>
    </div>
</div>