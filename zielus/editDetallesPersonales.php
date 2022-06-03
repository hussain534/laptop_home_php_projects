<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');

	session_start();
    include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	//session_start();
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if($DEBUG_STATUS)
	{
		echo 'USERID::'.$_SESSION['userid'].'<br>';
		echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
		//echo 'ROLE::'.$_SESSION['userRole'].'<br>';
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

    include_once('header.php');
?>
<br>
<br>

<form method="post" action=updateDetailsPersonal.php enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="true" />  
	<div class="container inner_body">
		<br>
		<br>
		<?php
			if(isset($_SESSION['userid']))
					include_once('submenu.php');
		?>
		<div class="row">
	        <div class="col-sm-1">
	        </div>
	        <div class="col-sm-10 bg-crimson">
	            <br>
	            <h3 style="text-align:center;color:#FFF;margin-top:1px">EDITAR MI PERFIL</h3>
	        </div>
	        <div class="col-sm-1">
	        </div>
	    </div>
	    <br>
		<div class="row">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-10 inner_body-block">
			    
			    <?php
			    	$controller = new controller();
			    	$usrDtl = $controller->getPerfil($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
			    	/*if(isset($usrDtl[7]) && strcmp($usrDtl[7], "")==0)
			    		$strProfilePicPath="images/unknown_user.png";*/
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
			                <legend><h3>Editar Detalles Presonales</h3></legend>
			                <br>
			                <br>
			            	<div class="row">
			            		<div class="col-sm-1">
			    	        		&nbsp;
			            		</div>
			            		<div class="col-sm-3">
			            			<?php 
			                        if(isset($usrDtl[6]) && file_exists($usrDtl[6]))
			                        {
			                        ?>
			                            <center><img src=<?php echo $usrDtl[6];?> id="uploadImg" class="profileImage" /></center>
			                        <?php
			                        }
			                        else
			                        {
			                            ?>
			                            <center><img src=images/unknown_user.png id="uploadImg" class="profileImage"/></center>
			                            <?php
			                        }   
			                        ?> 
			                        <center><input type="file" name="fileToUpload" id="fileToUpload">   
			                        <!-- <label for="imgId">Upload </label> -->
			                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
			            		</div>
			            		<div class="col-sm-1">
			    	        		&nbsp;
			            		</div>
			            		<div class="col-sm-6">
			            			<div class="row">
			            				<div class="col-sm-12 planificarviaje">
			            					<div class="form-group">
                                                <span class="input-group-addon">ID</span>
			                                	<input type="text" class="form-control" name="user_id" value="<?php echo $usrDtl[0]; ?>" readonly="true" >
			                                </div>
			            				</div>
			            				<div class="col-sm-12 planificarviaje">
			            					<div class="form-group">
                                                <span class="input-group-addon">NOMBRE COMPLETO</span>
			                                	<input type="text" maxlength="100" class="form-control" name="user_name" value="<?php echo $usrDtl[1]; ?>" required>
			                                </div>
			            				</div><!-- 
			            				<div class="col-sm-12 itemDtl">
			            					<label for="user_role">TIPO PERFIL</label>
			                                <input type="text" class="form-control" name="user_role" value="<?php echo $usrDtl[2]; ?>" readonly="true" >
			            				</div> -->
			            				<div class="col-sm-12 planificarviaje">
			            					<div class="form-group">
                                                <span class="input-group-addon">NRO CELULAR</span>
			                                	<input type="text" maxlength="15" class="form-control" name="user_celular" id="user_celular" value="<?php echo $usrDtl[2]; ?>" required>
			                                	<span id="user_celular_errmsg"></span>
			                                </div>
			            				</div>
			            				<div class="col-sm-12 planificarviaje">
			            					<div class="form-group">
                                                <span class="input-group-addon">NRO TELEFONO</span>
			                                	<input type="text" maxlength="15" class="form-control" name="user_landline" id="user_landline" value="<?php echo $usrDtl[3]; ?>">
			                                	<span id="user_landline_errmsg"></span>
			                                </div>
			            				</div>
			            				<div class="col-sm-12 planificarviaje">
			            					<div class="form-group">
                                                <span class="input-group-addon">NRO CEDULA</span>
			                                	<input type="text" maxlength="10" class="form-control" name="user_cedula" id="user_cedula" value="<?php echo $usrDtl[4]; ?>" required>
			                                	<span id="user_cedula_errmsg"></span>
			                                </div>
			            				</div>
			            				<div class="col-sm-12 planificarviaje">
			                                <div class="form-group">
                                                <span class="input-group-addon">NRO LICENCIA</span>
			                                	<input type="text" maxlength="50" class="form-control" name="user_licence" id="user_licence" value="<?php echo $usrDtl[5]; ?>">
			                                </div>
			                            </div>
			            				
			            				<div class="col-sm-12 planificarviaje">
			            					<button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
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
			</div>
		</div>
		<br>
		<br>
	</div>
</form>



<?php
	include_once('container_footer.php');
?>
