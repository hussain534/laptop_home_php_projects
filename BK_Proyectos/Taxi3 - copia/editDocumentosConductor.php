<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	
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

    include_once('header.php');
?>
<br>

<form method="post" action=updateDocumentosConductor.php enctype="multipart/form-data">
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
            <div class="col-sm-10 inner_body-block">
                <div class="col-sm-12" style="text-align:center">
                    <center><img src="images/icon_modify.png"><img src="images/icon_document.png" class="sub-img"></center>
                    <h3 style="text-align:center;color:#222;margin-top:1px">EDITAR DOCUMENTOS</h3>
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
                
                $controller = new controller();
            	$docDtl = $controller->getDocuments($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
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
                        		<div class="col-sm-6 text-center">
                        			<?php 
                                    if(isset($docDtl[0][2]) && file_exists($docDtl[0][2]))
                                    {
                                    ?>
                                        <p style="text-align:center">VERIFICACION : <?php if($docDtl[0][3]==0) echo 'APROBADO'; else if($docDtl[0][3]==1) echo 'RECHAZADO';else if($docDtl[0][3]==9) echo 'PENDIENTE';?></p>
                                        <center><img src=<?php echo $docDtl[0][2].'?rand='.rand();?> id="uploadImg" class="docImage" /></center>
                                        <p style="text-align:center"><?php echo $docDtl[0][1];?></p>
                                        <center><input type="file" name="fileToUpload" id="fileToUpload">   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId" value=<?php echo $docDtl[0][0];?> />  
                                        
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
                                        
                                    <?php
                                    }   
                                    ?> 
                                    
                        		</div>
                                <div class="col-sm-6">
                                    <?php 
                                    if(isset($docDtl[1][2]) && file_exists($docDtl[1][2]))
                                    {
                                    ?>
                                        <p style="text-align:center">VERIFICACION : <?php if($docDtl[1][3]==0) echo 'APROBADO'; else if($docDtl[1][3]==1) echo 'RECHAZADO';else if($docDtl[1][3]==9) echo 'PENDIENTE';?></p>
                                        <center><img src=<?php echo $docDtl[1][2].'?rand='.rand();?> id="uploadImg2" class="docImage" /></center>
                                        <p style="text-align:center"><?php echo $docDtl[1][1];?></p>
                                        <center><input type="file" name="fileToUpload2" id="fileToUpload2">   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId2" value=<?php echo $docDtl[1][0];?> />  
                                        
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <center><img src=images/imageNotAvailable.png id="uploadImg2" class="docImage"/></center>
                                        <p style="text-align:center">LICENCIA</p>
                                        <center><input type="file" name="fileToUpload2" id="fileToUpload2">   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId2" value="0" />  
                                        
                                    <?php
                                    }   
                                    ?> 
                                    
                                </div>
                        	</div>
                            <div class="row">
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-sm-12 itemDtl">
                                        <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
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