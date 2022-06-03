<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $target_dir=$pics_location;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	if(isset($_SESSION['LAST_ACTIVITY']))
    {
    	/*if(isset($_SESSION['userid']))
    		echo 'TRUE<br>';
    	else
    		echo 'FALSE<br>';
    	echo $_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'].'<br>';*/
		if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			//echo 'inside<br>';
			$url="userlogin.php";
			/*if(isset($_GET["idviaje"]))
				$_SESSION["last_url"]=$_SERVER['REQUEST_URI'];*/
			//echo $_SESSION["last_url"];
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();


  
?>
<br>

	<?php
		$controller = new controller();
        //echo 'hello';
		//$err_code = $controller->eliminarCuenta($databasecon,$_GET["obser"],$_SESSION["userid"],$DEBUG_STATUS);
        $err_code = $controller->eliminarCuenta($databasecon,$_POST["obser"],$_SESSION["userid"],$DEBUG_STATUS);
	    //echo $id;
        if(isset($err_code) and $err_code==0)
        {
            $url='userlogin.php?msgid=99';
            // remove all session variables
            session_unset(); 

            // destroy the session 
            session_destroy(); 
            $_SESSION["session_msg"]="Su cuenta eliminada correctamente. En unos minutos recibira confirmacion por email.";
        }
        
        header("Location:$url"); 
    ?>
    <!-- <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class='alert alert-success shopAlert'>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    if($err_code==0)
                        echo 'Su cuenta eliminado correctamente.';
                    else
                        echo 'Error en cerrar su cuenta. Por favor intertar nuevamente.';
                ?>
             </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div> -->