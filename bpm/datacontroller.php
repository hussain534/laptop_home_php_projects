<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();
	if(isset($_GET["dojob"]))
	{
		
		if($_GET["dojob"]==0 && $_GET["metodo"]==0)
		{	
			//echo $_POST['user_email'];
			$errCode = $controller->doLogin($databasecon,$_POST['user_email'],$_POST['user_pwd'],$DEBUG_STATUS);	
			//echo $_SESSION['userEmail'];
			if($errCode==0)
			{
				$url="page_procesos.php?msgId=2";
			}
			else
			{
				$url="index.php?msgId=1";
			}
			header("Location:$url");
		}
		else if($_GET["dojob"]==0 && $_GET["metodo"]==2)
		{	
			$errCode = $controller->doLogout($databasecon,$DEBUG_STATUS);	
			//echo $_SESSION['userEmail'];
			if($errCode==0)
			{
				$url="index.php?msgId=0";
				//$_SESSION["session_msg"]="USER LOGGED OUT SUCCESSFULLy.";
				header("Location:$url");
			}
			
		}	
		else if($_GET["dojob"]==1 && $_GET["metodo"]==1)
		{	
			//echo $_POST['user_email'];
			$errCode = $controller->createApplication($databasecon,$_POST['process_name'],$_POST['process_desc'],$DEBUG_STATUS);	
			//echo $_SESSION['userEmail'];
			if($errCode==0)
			{				
				$_SESSION["session_msg"]='APPLICATION <b>'.strtoupper($_POST['process_name']).' </b> CREATED SUCCESSFULLY';
			}
			else
			{
				$_SESSION["session_msg"]='ERROR WHILE CREATING APPLICATION <b>'.strtoupper($_POST['process_name']).'</b>';
			}
			$url="page_createProcess.php";
			header("Location:$url");
		}



		else if($_GET["dojob"]==2 && $_GET["metodo"]==0)
		{	
			//echo $_POST['user_email'];
			$errCode = $controller->createFlow($databasecon,$_POST['flow_name'],$_POST['flow_desc'],$_POST['applId'],$DEBUG_STATUS);	
			//echo $_SESSION['userEmail'];
			if($errCode==0)
			{				
				$_SESSION["session_msg"]='FLOW <b>'.strtoupper($_GET['flow_name']).' </b> CREATED SUCCESSFULLY';
			}
			else
			{
				$_SESSION["session_msg"]='ERROR WHILE CREATING FLOW <b>'.strtoupper($_GET['flow_name']).'</b>';
			}
			$url="page_flows.php?applId=".$_POST['applId'];
			header("Location:$url");
		}
		else if($_GET["dojob"]==2 && $_GET["metodo"]==1)
		{	
			//echo $_POST['user_email'];
			$errCode = $controller->addnode($databasecon,$_GET['node_id'],$_GET['node_name'],$_GET['node_desc'],$_GET['node_type'],$_GET['flow_id'],$DEBUG_STATUS);	
			//echo $_SESSION['userEmail'];
			//$_SESSION["session_msg"]='<br>'.$errCode;
			if($errCode==0)
			{				
				$_SESSION["session_msg"]= 'NODE <b>'.strtoupper($_GET['node_name']).' </b> CREATED SUCCESSFULLY';
			}
			else
			{
				$_SESSION["session_msg"]= 'ERROR WHILE CREATING NODE <b>'.strtoupper($_GET['node_name']).'</b>';
			}
		}
		else if($_GET["dojob"]==2 && $_GET["metodo"]==2)
		{	
			//echo $_POST['user_email'];
			$errCode = $controller->addConnector($databasecon,$_GET['from_node'],$_GET['to_node'],$_GET['conn_label'],$_GET['conn_type'],$_GET['flow_id'],$DEBUG_STATUS);	
			//echo $_SESSION['userEmail'];
			//$_SESSION["session_msg"]='<br>'.$errCode;
			if($errCode==0)
			{				
				$_SESSION["session_msg"]= 'CONNECTOR CREATED SUCCESSFULLY';
			}
			else
			{
				$_SESSION["session_msg"]= 'ERROR WHILE CREATING CONNECTOR';
			}
		}
	}
	
?>
						