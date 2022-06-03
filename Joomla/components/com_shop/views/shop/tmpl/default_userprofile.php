<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;


    $err_code=0;
	$target_dir = 'media/com_shop/images/users/';
	
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
        $err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        #$messsage='User ID : '.$_SESSION["userid"];
        #$messsage='User Name : '.$_SESSION['userName'];
    }

    if(isset($_POST['submitted']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }
        $userId= $_POST['userId'];
        $userName = $_POST['userName'];
        $userEmail = $_POST['emailId'];
        $userMobile = $_POST['mobile'];
        $newPwd = $_POST['newPassword'];
        

        $sql = "UPDATE rn_usuario SET ru_username='".$userName."',ru_email_id='".$userEmail."',
        	ru_mobile='".$userMobile."'  where ru_userid='".$_SESSION["userid"]."'";
	    if(mysqli_query($dbcon,$sql))
	    { 
            $messsage= "Data has been saved successfully.";
            $err_code=2;
	        $_SESSION['userName']=$userName; 
	        #$messsage='User Name : '.$_SESSION['userName']; 

            if($newPwd)
            {
                $sql = "UPDATE rn_login SET rn_pwd='".$newPwd."' where rn_userid='".$_SESSION["userid"]."'";
                if(mysqli_query($dbcon,$sql))
                { 
                    $err_code=2;
                    $messsage= "Data has been saved successfully.";
                } 
                else
                {
                    $err_code=1;
                    $messsage= "Error in uploading Data. Please contact our administrator.";
                }   
            }
            




            /* image upload starts*/
            #echo 'upload file::'.basename($_FILES["fileToUpload"]["name"]).'<br>';
            if(basename($_FILES["fileToUpload"]["name"]))
            {
                
                /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
                $target_file = $target_dir . $_SESSION["userid"].'.jpg';
                $uploadOk = 1;
                
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) 
                {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    echo $check;
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
                    $err_code=1;
                    // if everything is ok, try to upload file
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
            
            /* image upload end*/
            




	    }
	    else
	    {
	        #mysqli_close($dbcon);
            $err_code=1;
            $messsage= "Error in uploading Data. Please contact our administrator.";
	    }
    }



    
    if(isset($_SESSION["userid"]))
    {
    	$userId= $_SESSION["userid"];
	    $sql = "SELECT ru_userid, ru_username,ru_email_id,ru_mobile FROM rn_usuario WHERE ru_userid='".$userId."'";
	    $result = mysqli_query($dbcon,$sql);
	    if(mysqli_num_rows($result) > 0)  
	    {
	     	//$err_code=0;      
	    }	
    }
    if($DEBUG_STATUS)
    {
        echo 'Finally Error code:'.$err_code.'<br>';
    }
    include_once('default_guestmainfilterpanel2.php');
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
        if (($err_code==0 or $err_code==2) )
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
                        <li class="userMenu-active"><a href='index.php?view=shop&amp;layout=userprofile' class="userMenu-link-active"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
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
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=userprofile" class="userMenu-link-active"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
    			            <li><a href="index.php?view=shop&layout=clientprofile" class="userMenu-link"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
    			            <li><a href="index.php?view=shop&layout=manageitems&pagecount=0" class="userMenu-link"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
                            <li><a href="index.php?view=shop&layout=manageoffersform" class="userMenu-link"><span class='glyphicon glyphicon-tag'></span> Offer</a></li>
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

<?php
if(mysqli_num_rows($result) > 0) 
{
?>

	<div class="container profileContainer"> 
		<div class="row">
			<br>
			<div class="col-sm-12">
				<div class="row">
					<?php
				    while($row = mysqli_fetch_assoc($result)) 
				    {
				    	if($DEBUG_STATUS)
				    	{
					        echo "User Id: ".$row["ru_userid"]."<br>";
					        echo "User Name: ".$row['ru_username']."<br>";
					        echo "User Email: ".$row["ru_email_id"]."<br>";
					        echo "User Mobile: ".$row["ru_mobile"]."<br>";
				        }
				        ?>
		                
				        <form method="post" action="index.php?view=shop&layout=userprofile" enctype="multipart/form-data">
					        <input type="hidden" name="submitted" value="true" />
					        <div class="col-sm-2 profileDtl">
                				
                                    <?php 
                                    	
                                        if(file_exists($target_dir . $_SESSION["userid"].'.jpg'))
                                        {
                                            ?>
                                            <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/users/<?php echo $_SESSION["userid"]; ?>.jpg?rand=<?php echo rand(); ?>" id="uploadImg" class="profileImage" />
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/unknown_user.png id="uploadImg" class="profileImage"/>
                                            <?php
                                        }
                                            
                                     ?>
                                        
                                    <label for="imgId">Upload / Edit(Tamano max: 500KB, Resolucion : 400*400)</label>
                                    <p>Editar su imagines aqui : <b>https://pixlr.com/editor</b></p>
                                    <input type="file" name="fileToUpload" id="fileToUpload" title=" hello">                                                
                                
							</div>
							<div class="col-sm-10">
                				<div class="row">
                					<div class="col-sm-6 itemDtl">										
                                        <label for="userId">User Id</label>
                                        <input type="text" class="form-control" size=25 name="userId" value=<?php echo $row['ru_userid']; ?> readonly="true">
		                            </div>
		                            <div class="col-sm-6 itemDtl">										
                                        <label for="userName">User Name</label>
                                        <input type="text" class="form-control" maxlength=60 name="userName" maxlength=60 placeholder="User Name(tamano maximo: 60 :solo letras)" name="userName" value="<?php echo $row['ru_username']; ?>" required>
		                            </div>
                                </div>                            
                				<div class="row">
                                    <div class="col-sm-6 itemDtl">
                                        <label for="emailId">Email Id</label>
                                        <input type="text" class="form-control" maxlength=50 placeholder="Enter Email Id(tamano maximo: 50)" id="contact_email" name="emailId" value=<?php echo $row['ru_email_id']; ?> required>
                                    </div>
                                    <div class="col-sm-6 itemDtl">
                                        <label for="mobile">Celular</label>
                                        <input type="text" class="form-control" maxlength=15 placeholder="Enter mobile number(tamano maximo: 10 :solo numeros)" name="mobile" value=<?php echo $row['ru_mobile']; ?> required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 itemDtl">
                                        <label for="new password">New Password</label>
                                        <input type="text" class="form-control" maxlength=15 placeholder="New password(Tamano:15,numeros,letras o caracteres especiales)" name="newPassword" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <button type="submit" class="btn btn-success btn-success_style" onclick="return validateEmail()();">Submit</button>
                                    </div>
                                </div>
                            </div>
					    </form>
		                    
				        <?php





				    }
				    ?>
			    </div>
			</div>
		</div>
	</div>

    <script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("contact_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            alert("Please enter valid e-mail address");
            return false;
        }
        else
            return true;
}
</script>
    <?php
	}
}
?>