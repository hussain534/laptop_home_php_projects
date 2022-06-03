<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');

	include_once('util.php'); 
	$session_time=$session_expirry_time;
	session_start();
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if($DEBUG_STATUS)
	{
		echo 'USERID::'.$_SESSION['userid'].'<br>';
		echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
		echo 'ROLE::'.$_SESSION['userRole'].'<br>';
	}
	if(isset($_SESSION['LAST_ACTIVITY']))
    {
		if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="index.php?view=shop&layout=userlogout&tipo=2";
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
?>

<?php
    /*include_once('login.php');
    include_once('logopanel.php');*/
    include_once('header.php');
?>
<br>
<?php
    if(isset($_SESSION['userid']))
            include_once('submenu.php');
?>

<div class="container">
	<br>
    <div class="row">
        <div class="col-sm-12" style="text-align:center">
        	<span style="padding:0 10px;border:2px solid teal;color:teal;font-size:28px;border-radius:5px">PERFIL DEL PASAJERO</span>
        </div>
    </div>
    <?php
    	$controller = new controller();
    	$usrDtl = $controller->getPerfil($databasecon,$_SESSION['userEmail'],$DEBUG_STATUS);
    	if(isset($usrDtl[7]) && strcmp($usrDtl[7], "")==0)
    		$strProfilePicPath="images/unknown_user.png";
    ?>
    <?php  if(isset($message)) 
            {
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class='alert alert-success shopAlert'>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php  echo $message; ?>
                 </div>
            </div>
        </div>
        <?php
            }
        ?>
    <div class="row">
        <div class="col-sm-12">
        	<!-- <div class="row">
		        <div class="col-sm-12" style="text-align:center">
		        	<H3>Detalles Presonales</H3>
		        </div>
		    </div> -->
             <fieldset class="servicepanel">
                <legend><h3>Detalles Presonales</h3></legend>
                <a href="editDetallesPersonales.php"><span>EDIT</span></a>
                <br>
                <br>
            	<div class="row">
            		<div class="col-sm-1">
    	        		&nbsp;
            		</div>
            		<div class="col-sm-2">
            			<?php 
                        if(isset($usrDtl[7]) && file_exists($usrDtl[7]))
                        {
                        ?>
                            <center><img src=<?php echo $usrDtl[7];?> id="uploadImg" class="profileImage" /></center>
                        <?php
                        }
                        else
                        {
                            ?>
                            <center><img src=images/unknown_user.png id="uploadImg" class="profileImage"/></center>
                            <?php
                        }   
                        ?> 
            		</div>
            		<div class="col-sm-1">
    	        		&nbsp;
            		</div>
            		<div class="col-sm-7">
            			<div class="row">
            				<div class="col-sm-12 itemDtl">
            					<label for="user_id">ID</label>
                                <input type="text" class="form-control" name="user_id" value="<?php echo $usrDtl[0]; ?>" readonly="true" >
            				</div>
            				<div class="col-sm-12 itemDtl">
            					<label for="user_name">NAME</label>
                                <input type="text" class="form-control" name="user_name" value="<?php echo $usrDtl[1]; ?>" readonly="true" >
            				</div><!-- 
            				<div class="col-sm-12 itemDtl">
            					<label for="user_role">TIPO PERFIL</label>
                                <input type="text" class="form-control" name="user_role" value="<?php echo $usrDtl[2]; ?>" readonly="true" >
            				</div> -->
            				<div class="col-sm-12 itemDtl">
            					<label for="user_celular">CELULAR</label>
                                <input type="text" class="form-control" name="user_celular" value="<?php echo $usrDtl[2]; ?>" readonly="true" >
            				</div>
            				<div class="col-sm-12 itemDtl">
            					<label for="user_landline">CONVENTIONAL</label>
                                <input type="text" class="form-control" name="user_landline" value="<?php echo $usrDtl[3]; ?>" readonly="true" >
            				</div>
            				<div class="col-sm-12 itemDtl">
            					<label for="user_cedula">CEDULA</label>
                                <input type="text" class="form-control" name="user_cedula" value="<?php echo $usrDtl[4]; ?>" readonly="true" >
            				</div>
            			</div>
            		</div>
            		<div class="col-sm-1">
    	        		&nbsp;
            		</div>
            	</div>
            </fieldset>
        </div>
	</div>






	<?php
	$docDtl = $controller->getDocuments($databasecon,$_SESSION['userEmail'],$DEBUG_STATUS);
    if($DEBUG_STATUS)
	   echo $docDtl[0][2];
    ?>
	<div class="row">
        <div class="col-sm-12">
        	<!-- <div class="row">
		        <div class="col-sm-12" style="text-align:center">
		        	<H3>Documentos del Usuario</H3>
		        </div>
		    </div> -->
             <fieldset class="servicepanel">
                <legend><h3>Documentos del Usuario</h3></legend>
                <a href="editDocumentosPasajero.php"><span>EDIT</span></a>
                <br>
                <br>
            	<div class="row">
            		<div class="col-sm-4">
    	        		&nbsp;
            		</div>
            		<div class="col-sm-4">
            			<?php 
                        if(isset($docDtl[0][2]) && file_exists($docDtl[0][2]))
                        {
                        ?>
                            <center><img src=<?php echo $docDtl[0][2];?> id="uploadImg" class="docImage" /></center>
                            <p style="text-align:center"><?php echo $docDtl[0][1];?></p>
                        <?php
                        }
                        else
                        {
                            ?>
                            <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                            <p style="text-align:center">CEDULA</p>
                            <?php
                        }   
                        ?> 
            		</div>
            		<div class="col-sm-4">
            			&nbsp;
            		</div>
            	</div>
            </fieldset>
        </div>
	</div>     
</div>










<?php
	include_once('container_footer.php');
?>