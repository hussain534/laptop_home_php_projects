<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;
	

	if(!isset($_SESSION["userid"]))
    {   
        if($DEBUG_STATUS)
        {
            echo "Invalid session<br>";    
        }        
        $err_code=1;
        $messsage= "Invalid credentials or you are accessing this page directly. Try with correct login details.<a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a>";
    }
    else
    {
    	$session_time=$session_expirry_time;
    	if(isset($_SESSION['LAST_ACTIVITY']))
	    {
			if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
			{
				$url="index.php?view=shop&layout=userLogout&tipo=2";
				header("Location:$url"); 
			}
            else
                $_SESSION['LAST_ACTIVITY'] = time();
		}
		else
			$_SESSION['LAST_ACTIVITY'] = time();
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
    }

    if(isset($_GET['imageId']))
    	$imageCode = $_GET['imageId'];
   	else
   		$imageCode = 0;


    if(isset($_SESSION["clientid"]))
    {
    	$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';
	    
	    if(isset($_SESSION["session_msg"]))
	    {
	    	$messsage= $_SESSION["session_msg"];
	    	$err_code=2;
	    	unset($_SESSION["session_msg"]);
	    }
	    if(isset($_POST['submitted']))
    	{
		    if(basename($_FILES["fileToUpload"]["name"]))
		    {
		        
		        /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
		        $target_file = $target_dir . $_SESSION["clientid"].'-'.$imageCode.'-'.mt_rand().'.jpg';
		        $uploadOk = 1;
		        
		        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		        

		        // Check if image file is a actual image or fake image
		        if(isset($_POST["submit"])) 
		        {
		        	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		            if($check !== false) 
		            {
		                $messsage= "File is an image - " . $check["mime"] . ".";
		                $uploadOk = 1;
		            } 
		            else 
		            {
		                echo "File is not an image.";
		                $uploadOk = 0;
		                $err_code=1;
		            }
		        }
		        
		        // Check file size
		        if ($_FILES["fileToUpload"]["size"] > 500000) 
		        {
		            $messsage= "Sorry, your file is too large.";
		            $uploadOk = 0;
		            $err_code=1;
		        }
		        // Allow certain file formats
		        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		        {
		            $messsage= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		            $uploadOk = 0;
		            $err_code=1;
		        }
		        // Check if $uploadOk is set to 0 by an error
		        if ($uploadOk == 0) 
		        {
		            $messsage= "Sorry, your file was not uploaded.";
		            // if everything is ok, try to upload file
		            $err_code=1;
		        } 
		        else 
		        {
		            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		            {
		                $messsage= "The profile image and data has been uploaded successfully.";
		                $err_code=2;
		            } 
		            else 
		            {
		                $messsage= "Sorry, there was an error uploading your file.";
		                $err_code=1;
		            }
		        }
		    }
		}	    
    }
    else
    {
    	$messsage= "No client details found. Please Complete client profile first to add products.<a href='index.php?view=shop&amp;layout=clientProfile'>CLIENT PROFILE</a>";
	    $err_code=1;
	    	
    }

   
    include_once('default_guestMainFilterPanel2.php');
?>



<div class="container">  
	<div class="row">
        <div class="col-sm-12">
        <?php 
           if ($err_code==2)
        {
            echo "<div class='alert alert-success shopAlert'>";
            ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $messsage;
            echo "</div>";
        }
        if($DEBUG_STATUS)
        {
        	echo '<br>err_code::'.$err_code;	
        }
        

        if ($err_code==1)
        {                          
        ?>
        <div class='alert alert-danger shopAlert'> 
            <?php
            echo $messsage;
            ?>             
            
        </div>
        </div>
    </div>
</div>
        <?php
        }
        if ($err_code==0 or $err_code==2)
        {
        ?>
        </div>
    </div>
</div>

<?php
if (($err_code==0 or $err_code==2) and $_SESSION['userRole']==2)
{
?>  
<div class="container">  
    <div class="row">
        <div class="col-sm-12">
	        <div class="header">	    
			    <div class="alert loginRegister">
			        <ul>
			        	<li><a href='index.php?view=shop&amp;layout=userHome' class="userMenu-link"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
                        <li><a href='index.php?view=shop&amp;layout=userProfile' class="userMenu-link"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
                        <li><a href='index.php?view=shop&layout=manageCart' class="userMenu-link"><span class='glyphicon glyphicon-shopping-cart'></span> CHECKOUT</a></li>
                          <li><a href='index.php?view=shop&layout=orderHistory' class="userMenu-link"><span class='glyphicon glyphicon-list-alt'></span> ORDERS</a></li>
			        </ul>
			    </div>	    
			</div>
        </div>
    </div>
</div>     
<?php
} 
else if (($err_code==0 or $err_code==2) and $_SESSION['userRole']==3)
{
    ?>    
    <div class="container">  
        <div class="row">
            <div class="col-sm-12">
                <div class="header">        
                    <div class="alert loginRegister">
    			        <ul>
    			        	<!-- <li><a href="index.php?view=shop&layout=userHome" class="userMenu-link"><span class='glyphicon glyphicon-home'></span> Home</a></li> -->
    			            <li><a href="index.php?view=shop&layout=userProfile" class="userMenu-link"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
    			            <li><a href="index.php?view=shop&layout=clientProfile" class="userMenu-link"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=manageItems&pagecount=0" class="userMenu-link-active"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
                            <li><a href="index.php?view=shop&layout=manageOffersForm" class="userMenu-link"><span class='glyphicon glyphicon-tag'></span> Offer</a></li>
    			        </ul>
    			    </div>	    
    			</div>
            </div>
        </div>
    </div>     
    <?php
}       
?>
                                            
        <div class="container">            
			<div class="row">
				<div class="col-sm-3 profileDtl">
					<form method="post" action=index.php?view=shop&layout=manageImages&imageId=<?php echo $imageCode;?> enctype="multipart/form-data">
						<input type="hidden" name="submitted" value="true" />
					<?php                                                     
                        if(file_exists($target_dir . $_SESSION["clientid"].'-'.$imageCode.'.jpg'))
                        {
                            ?>
                            <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $_SESSION["clientid"].'/'.$_SESSION["clientid"].'-'.$imageCode; ?>.jpg id="uploadImg" class="profileImage" />
                            <?php
                        }	                        
                    ?>
                    <label for="imgId">Upload / Edit(Tamano max: 500KB, Resolucion : 400*400)</label>
                    <p>Editar su imagines aqui : <b>https://pixlr.com/editor</b></p>
                    <input type="file" name="fileToUpload" id="fileToUpload"> 
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>                           
				</div>
				<div class="col-sm-9 itemDtl">
              		<div class="row">
                         <?php
                         	$filePattern='media/com_shop/images/clients/'.$_SESSION["clientid"].'/'.$_SESSION["clientid"].'-'.$imageCode.'*.jpg';
 							//echo $filePattern;
 							$imgid=0;
							foreach (glob($filePattern) as $filename) 
							{
								$imgid=$imgid+1;
								?>								
								<div class="col-sm-2" style="padding:10px;margin:0;border:1px solid #9d9d9d;border-radius:5px;min-height:200px;">
									<span class="badge"><?php echo $imgid;?></span>
	                    			<img class="imgClipsAdd" src= <?php echo $filename; ?> id=img<?php echo $imgid;?> onclick="changeImg(<?php echo $imgid;?>);"/>
								</div>
						<?php							    
							}
						?>
					</div>
			  	</div>
            </div>
		</div>
		<br>
		<br>
    <?php
}
?>

