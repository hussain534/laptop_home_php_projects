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
<form method="post" action=updateDocumentosPasajero.php enctype="multipart/form-data">
    <input type="hidden" name="submitted" value="true" />  
    <div class="container">
    	<br>
        <div class="col-sm-12" style="text-align:center">
            <span style="padding:0 10px;border:2px solid teal;color:teal;font-size:28px;border-radius:5px">PERFIL DEL 
            <?php
                if(isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
                {
            ?>
            CONDUCTOR
            <?php       
                }
                else
                {
            ?>
            PASAJERO
            <?php
                }
            ?>

            </span>
        </div>
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
        

    	<?php
        $controller = new controller();
    	$docDtl = $controller->getDocuments($databasecon,$_SESSION['userEmail'],$DEBUG_STATUS);
        if($DEBUG_STATUS)
    	   echo $docDtl[0][2];
        ?>
    	<div class="row">
            <div class="col-sm-12">
                 <fieldset class="servicepanel">
                    <legend><h3>Documentos del Usuario</h3></legend>
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
                                <center><input type="file" name="fileToUpload" id="fileToUpload">   
                                <!-- <label for="imgId">Upload </label> -->
                                <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                <input type="hidden" name="docId" value=<?php echo $docDtl[0][0];?> />  
                                <div class="col-sm-12 itemDtl">
                                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                </div>
                            <?php
                            }
                            else
                            {
                                ?>
                                <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                <p style="text-align:center">CEDULA</p>
                                <center><input type="file" name="fileToUpload" id="fileToUpload">   
                                <!-- <label for="imgId">Upload </label> -->
                                <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                <input type="hidden" name="docId" value="0" />  
                                <div class="col-sm-12 itemDtl">
                                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                </div>
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
</form>
    










<?php
	include_once('container_footer.php');
?>