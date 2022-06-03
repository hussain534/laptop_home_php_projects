<?php
    defined('__JEXEC') or ('Access denied');
    //session_start();
    session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;
    if(isset($_GET["idciudad"]))
    {
        $str=$_GET["idciudad"];
    }
    //echo $str.'<br>';
      require 'dbcontroller.php';
?>


    <option value="0">ELIGE SU PARROQUIA</option>
    <?php 
        $controller = new controller();
        $terminals = $controller->getTerminalsBySector($databasecon,1,$_GET["sector"],$DEBUG_STATUS);
        for($x=0;$x<count($terminals);$x++)
        {
            echo "<option value='".$terminals[$x][0]."'>".$terminals[$x][1]."</option>";
        }
    ?>
    