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
				$url="index.php?view=shop&layout=userlogout&tipo=2";
				header("Location:$url"); 
			}
			else
                $_SESSION['LAST_ACTIVITY'] = time();
		}
		else
			$_SESSION['LAST_ACTIVITY'] = time();
        //$err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        #$messsage='User ID : '.$_SESSION["userid"];
        //$messsage='User Name : '.$_SESSION['userName'];
    
    	if(isset($_SESSION["clientid"]))
    	{
    		$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';
		    if($DEBUG_STATUS)
		    {
		        echo 'Error code:'.$err_code.'<br>';
		    } 
		    //echo JURI::root().'media/com_shop/images/clients/'.$_SESSION["clientid"].'/'.$_SESSION["clientid"].'-offer.jpg';
		    if(isset($_SESSION['clientid']))
		    	$clientId=$_SESSION['clientid'];
		    //echo $clientId;
		    if(isset($_POST['submitted']))
		    {
		    	$sqlOffer = "select rn_offer_desc,rn_offer_start_from,rn_offer_ends_on from rn_offers where rn_client_id=".$clientId." and DATE_FORMAT(now(),'%Y-%m-%d') <= rn_offer_ends_on";
				$result = mysqli_query($dbcon,$sqlOffer);
				if(mysqli_num_rows($result) > 0)  
				{
					$sqlOfferUpdate = "UPDATE rn_offers SET rn_offer_created_on=now(),rn_offer_keywords='".$_POST['rn_offer_keywords']."', 
					rn_offer_start_from=DATE_FORMAT('".$_POST['rn_offer_start_dt']."','%Y-%m-%d'),rn_offer_ends_on=DATE_FORMAT('".$_POST['rn_offer_end_dt']."','%Y-%m-%d'),
					rn_offer_desc='".$_POST['rn_item_desc']."' where rn_client_id='".$clientId."'";
		            if(mysqli_query($dbcon,$sqlOfferUpdate))
		            {
		            	$err_code=2;
		            	//echo $messsage="Offer Details Updated successfully";
		            	$_SESSION["session_msg"]="Offer Details Updated successfully.";
		            }
				}
				else
				{
					$sqlOfferInsert = "INSERT into rn_offers(rn_offer_desc,rn_offer_keywords,rn_offer_created_on,rn_offer_start_from,rn_offer_ends_on,rn_client_id) 
					values('".$_POST['rn_item_desc']."','".$_POST['rn_offer_keywords']."',now(),DATE_FORMAT('".$_POST['rn_offer_start_dt']."','%Y-%m-%d'),DATE_FORMAT('".$_POST['rn_offer_end_dt']."','%Y-%m-%d'),
					'".$clientId."')";
		            if(mysqli_query($dbcon,$sqlOfferInsert))
		            {
		            	$err_code=2;
		            	//echo $messsage="Offer Details Inserted successfully";
		            	$_SESSION["session_msg"]="Offer Details Inserted successfully.";
		            }
				}
				if(basename($_FILES["fileToUpload"]["name"]))
		        {
		            
		            /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
		            $target_file = $target_dir . $_SESSION["clientid"].'-offer.jpg';
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
		                    $_SESSION["session_msg"]="File is not an image.";
		                }
		            }
		            // Check if file already exists
		            /*if (file_exists($target_file)) 
		            {
		                echo "Sorry, file already exists.";
		                $uploadOk = 0;
		            }*/
		            // Check file size
		            if ($_FILES["fileToUpload"]["size"] > 500000) 
		            {
		                $messsage= "Sorry, your file is too large.";
		                $uploadOk = 0;
		                $_SESSION["session_msg"]="Sorry, your file is too large.";
		            }
		            // Allow certain file formats
		            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		            {
		                $messsage= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		                $uploadOk = 0;
		                $_SESSION["session_msg"]="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		            }
		            // Check if $uploadOk is set to 0 by an error
		            if ($uploadOk == 0) 
		            {
		                $messsage= "Sorry, your file was not uploaded.";
		                $_SESSION["session_msg"]="Sorry, your file was not uploaded.";
		                // if everything is ok, try to upload file
		            } 
		            else 
		            {
		                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		                {
		                    $messsage= "The profile image and data has been uploaded.";
		                    $_SESSION["session_msg"]="The offer image and data has been uploaded successfully.";
		                } 
		                else 
		                {
		                    $messsage= "Sorry, there was an error uploading your file.";
		                    $_SESSION["session_msg"]="Sorry, there was an error uploading your offer image.";
		                }
		            }
		        }
		    }
    	}
    	else
	    {
	    	$_SESSION["session_msg"]= "No client details found. Please Complete client profile first to add products.<a href='index.php?view=shop&amp;layout=clientprofile'>CLIENT PROFILE</a>";
		    $err_code=1;
		    	
	    }
	    


	    include_once('default_guestmainfilterpanel2.php'); 
	}  
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
            echo $_SESSION["session_msg"];
            unset($_SESSION["session_msg"]);
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
            echo $_SESSION["session_msg"];
            unset($_SESSION["session_msg"]);
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
			        	<li><a href='index.php?view=shop&amp;layout=userhome' class="userMenu-link"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
                        <li><a href='index.php?view=shop&amp;layout=userprofile' class="userMenu-link"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
                        <li><a href='index.php?view=shop&layout=managecart' class="userMenu-link"><span class='glyphicon glyphicon-shopping-cart'></span> CHECKOUT</a></li>
                          <li><a href='index.php?view=shop&layout=orderhistory' class="userMenu-link"><span class='glyphicon glyphicon-list-alt'></span> ORDERS</a></li>
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
    			            <li><a href="index.php?view=shop&layout=userprofile" class="userMenu-link"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
    			            <li><a href="index.php?view=shop&layout=clientprofile" class="userMenu-link"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
    			            <li><a href="index.php?view=shop&layout=manageitems&pagecount=0" class="userMenu-link"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=manageoffersform" class="userMenu-link-active"><span class='glyphicon glyphicon-tag'></span> Offer</a></li>
    			            <li><a href="index.php?view=shop&layout=clientorderhistory" class="userMenu-link"><span class='glyphicon glyphicon-tag'></span> My Orders</a></li>
    			        </ul>
    			    </div>	    
    			</div>
            </div>
        </div>
    </div>     
    <?php
}       
?>
<br>

<?php
	$sqlOffer = "select rn_offer_desc,rn_offer_keywords,rn_offer_start_from,rn_offer_ends_on from rn_offers where rn_client_id=".$clientId." and DATE_FORMAT(now(),'%Y-%m-%d') <= rn_offer_ends_on";
	$result = mysqli_query($dbcon,$sqlOffer);
	if(mysqli_num_rows($result) > 0)  
	{
	    $err_code=0;
	    if($row = mysqli_fetch_assoc($result)) 
	    {
?>

		<form method="post" action="index.php?view=shop&layout=manageoffersform" enctype="multipart/form-data">
			<input type="hidden" name="submitted" value="true" />
			<div class="container">            
				<div class="row">
					<div class="col-sm-6 profileDtl">
						<img src=<?php echo JURI::root().'media/com_shop/images/clients/'.$_SESSION["clientid"].'/'.$_SESSION["clientid"];?>-offer.jpg style="width:550px;height:280px;" id="uploadImg" class="profileImage"/>
			            <label for="imgId">Upload / Edit</label>
			            <input type="file" name="fileToUpload" id="fileToUpload">
					</div>
					<div class="col-sm-6 itemDtl">
						<div class="row">
							<div class="col-sm-12 itemDtl">
								<label for="rn_item_desc">Description</label>
								<textarea name="rn_item_desc" class="form-control" maxlength=500 placeholder="Offer Description(Tamano maximo: 500)" rows="13" id="offerDesc" autofocus><?php echo $row['rn_offer_desc']; ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 itemDtl">
								<label for="rn_offer_start_dt">OFFER TAGS</label>                                 
		                        <input type="text" class="form-control" maxlength="200" size=25 name="rn_offer_keywords" value="<?php echo $row['rn_offer_keywords']; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 itemDtl">
								<!-- <label for="rn_offer_start_dt">OFFER ID</label>                                  -->
		                        <input type="hidden" class="form-control dateParam" size=25 value="<?php echo $clientId; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 itemDtl">
								<label for="rn_offer_start_dt">OFFER START FROM</label>                                 
		                        <input type="date" class="form-control dateParam" size=25 name="rn_offer_start_dt" id="offerValidFrom" value="<?php echo $row['rn_offer_start_from']; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 itemDtl">
								<label for="rn_offer_end_dt">OFFER END ON</label>                                 
		                        <input type="date" class="form-control dateParam" size=25 name="rn_offer_end_dt" id="offerValidTo" value="<?php echo $row['rn_offer_ends_on']; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success" onclick="return validateForm()">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php
		}
	}
	else 
	{
?>
	<form method="post" action="index.php?view=shop&layout=manageoffersform" enctype="multipart/form-data">
		<input type="hidden" name="submitted" value="true" />
		<div class="container">            
			<div class="row">
				<div class="col-sm-6 profileDtl">
					<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/no_image.jpg style="max-height:280px;" id="uploadImg" class="profileImage"/>
		            <label for="imgId">Upload / Edit</label>
		            <input type="file" name="fileToUpload" id="fileToUpload">
				</div>
				<div class="col-sm-6 itemDtl">
					<div class="row">
						<div class="col-sm-12 itemDtl">
							<label for="rn_item_desc">Description</label>
							<textarea name="rn_item_desc" class="form-control" rows="13" id="offerDesc"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 itemDtl">
							<label for="rn_offer_id">OFFER ID</label>                                 
	                        <input type="text" class="form-control" size=25 name="rn_offer_id" value="<?php echo $clientId; ?>" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 itemDtl">
							<label for="rn_offer_start_dt">OFFER START FROM</label>                                 
	                        <input type="date" class="form-control dateParam" size=25 name="rn_offer_start_dt" id="offerValidFrom">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 itemDtl">
							<label for="rn_offer_end_dt">OFFER END ON</label>                                 
	                        <input type="date" class="form-control dateParam" size=25 name="rn_offer_end_dt" id="offerValidTo">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<button type="submit" class="btn btn-success btn-success_style" onclick="return validateForm()">Submit</button>
						</div>		
					</div>										
				</div>
			</div>
		</div>
	</form>
		<?php
	}
	?>
<script>
	function validateForm()
	{
		//alert("validateForm()");
		var offerDesc = document.getElementById("offerDesc").value;
		var offerValidFrom = document.getElementById("offerValidFrom").value;
		var offerValidTo = document.getElementById("offerValidTo").value;
		//alert("offerDesc:"+offerDesc);
		//alert("offerValidFrom:"+offerValidFrom);
		//alert("offerValidTo:"+offerValidTo);

		if(offerDesc!="" || offerValidFrom!="" || offerValidTo!="")
		{
			//alert("Checking");
			if(offerDesc==null || offerDesc=="" || offerValidFrom==null || offerValidFrom=="" || offerValidTo==null || offerValidTo=="")
			{
				alert("Please enter Offer Details, Offer Start From and Offer Ends On dates correctly");
				return false;
			}
			if(offerValidFrom > offerValidTo)
			{
				alert("Offer start from date should be always greater than Offer Ends on date");
				return false;
			}
				
		}
		
		return true;
		
	}
</script>
<?php
}
?>
