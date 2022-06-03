<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/animate.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Amita" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">

  <script type="text/javascript" src="js/myjs.js" ></script>
  

  

</head>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
<?php
	//session_start();
	if(isset($_POST['submitted']))
    {
    	//echo 'TO:'.$_POST['contact_email'];
    	//echo 'NOMBRE:'.$_POST['contact_user'];
    	//echo 'MESSAGE:'.$_POST['contact_msg'];
		$to = 'juan.bajana@nexosafe.com';
		$subject = 'NUEVO MENSAJE ENVIADO POR '.strtoupper($_POST['contact_user']);
		$txt = 'Ha recibido un nueve mensaje'."!\n\n\n";
		$txt=$txt.'Email Cliente:'.$_POST['contact_email']."\n\n\n";
		$txt=$txt.'Mensaje:'.$_POST['contact_msg']."\n\n\n";		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
		$headers = 'From: PORTAL NEXOSAFE <webadmin@nexosafe.com>';

		$res=mail($to,$subject,$txt,$headers);
		if($res==true)
		{
		    echo '<h4 style="color:red">SU MENSAJE FUE ENVIADO CORRECTAMENTE</h4>';
		}
		else
		{
		    echo '<h4 style="color:red">ERROR ENVIAR SU MENSAJE.INTENTA NUEVAMENTE</h4>';

		}

		//$url='http://nexosafe.com/#container06';
		//header("Location:$url");
	}
?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<a href="http://nexosafe.com"><button type="submit" class="btn btn-default"  style="margin:5px" onclick="return validateEmail();">REGRESAR</button></a>			
		</div>
	</div>
</div>


