<?php
	defined('__JEXEC') or ('Access denied');
	//session_start();
	session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	$DEBUG_STATUS = $PRINT_LOG;
	if(isset($_GET["terminal"]))
	{
		$terminal=$_GET["terminal"];
	}
	//echo $str.'<br>';
  	require 'dbcontroller.php';
?>
    <?php 
        $controller = new controller();
        $terminals = $controller->getTerminalMapDtl($databasecon,$terminal,$DEBUG_STATUS);
        echo $terminals;
        
    ?>
    