<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
    
    

	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;

    $target_dir = 'media/com_shop/images/clients/';
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
		if(isset($_SESSION['clientid']))
        	$rn_client_id = $_SESSION['clientid'];
        else
        	$rn_client_id = 0;
        //$err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        #$messsage='User ID : '.$_SESSION["userid"];
        //$messsage='User Name : '.$_SESSION['userName'];
    }

    if(isset($_POST['submitted']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }
        /*$userId= $_POST['userId'];
        $userName = $_POST['userName'];
        $userEmail = $_POST['emailId'];
        $userMobile = $_POST['mobile'];*/
        if($DEBUG_STATUS)
        {
        	echo 'Client ID:'.$_POST['rn_client_id'].'<br>';
        	echo 'Clinet ID Len'.strlen($_POST['rn_client_id']).'<br>';
        }

        
        if(strlen($_POST['rn_client_id'])>0)
        {
            //echo $_POST['rn_website'].'<br>';
            //echo $_POST['rn_facebook'].'<br>';
        	$sql = "UPDATE rn_clients set rn_user_id='".$_SESSION['userid']."',
        		rn_client_name='".$_POST['rn_client_name']."',
        		rn_address='".$_POST['rn_address']."',
        		rn_mobile='".$_POST['rn_mobile']."',
        		rn_tollFree='".$_POST['rn_tollFree']."',
        		rn_phone='".$_POST['rn_phone']."',
        		rn_show_price='".$_POST['rn_show_price']."',
				rn_plan_id=".$_POST['rn_plan_id'].",
				rn_is_approved='".$_POST['rn_is_approved']."',
				rn_description='".str_replace("'", "",$_POST['rn_description'])."',
				rn_latitude='".$_POST['rn_latitude']."',
				rn_longitude='".$_POST['rn_longitude']."',
				rn_country='".$_POST['rn_country']."',
				rn_state='".$_POST['rn_state']."',
				rn_city='".$_POST['rn_city']."',
				rn_category='".$_POST['rn_category']."',
				rn_subcategory='".$_POST['rn_subcategory']."',
                rn_website='".$_POST['rn_website']."',
                rn_facebook='".$_POST['rn_facebook']."'
				where rn_client_id='".$_POST['rn_client_id']."'";	
        }
        else
        {
        	$sql="INSERT INTO rn_clients(rn_client_name,rn_address,rn_mobile,rn_tollFree,rn_phone,rn_show_price,
        		rn_plan_id,rn_user_id,rn_is_approved,rn_created_on,rn_modified_on,rn_modified_by,rn_enable,
        		rn_description,rn_latitude,rn_longitude,rn_country,rn_state,rn_city,rn_category,rn_subcategory,rn_website,rn_facebook)  
        	VALUES('".$_POST['rn_client_name']."','".$_POST['rn_address']."','".$_POST['rn_mobile']."',
        		'".$_POST['rn_tollFree']."','".$_POST['rn_phone']."','".$_POST['rn_show_price']."',
        		".$_POST['rn_plan_id'].",'".$_SESSION['userid']."','".$_POST['rn_is_approved']."',now(),now(),
        		'".$_SESSION['userid']."','N','".$_POST['rn_description']."','".$_POST['rn_latitude']."',
        		'".$_POST['rn_longitude']."','".$_POST['rn_country']."','".$_POST['rn_state']."',
        		'".$_POST['rn_city']."','".$_POST['rn_category']."','".$_POST['rn_subcategory']."','".$_POST['rn_website']."','".$_POST['rn_facebook']."')";
        }

        /*echo 'SQL:'.$sql.'<br>';*/
        
	    if(mysqli_query($dbcon,$sql))
	    { 
	        #$_SESSION['userName']=$userName; 
	        $err_code=2;
	        $messsage='Client Details updated successfully';   


	        if(isset($_SESSION["userid"]))
		    {
		    	$userId1= $_SESSION["userid"];
			    $sql = "SELECT rn_client_id,rn_client_name,rn_address,rn_mobile,rn_tollFree,rn_phone,rn_rate,rn_show_price,
						rn_plan_id, rn_is_approved,rn_description,rn_latitude,rn_longitude,rn_country,rn_state,rn_city,
						rn_category,rn_subcategory,rn_website,rn_facebook
						FROM rn_usuario, rn_clients WHERE ru_userid='".$userId1."' and rn_user_id=ru_userid";
			    $result = mysqli_query($dbcon,$sql);
			    if(mysqli_num_rows($result) > 0)  
			    {
			    	 while($row = mysqli_fetch_assoc($result)) 
					{
				     	//$err_code=0; 
				     	$rn_client_id1=$row["rn_client_id"];
				     }
				 }
			}



	        /* image upload starts*/
            #echo 'upload file::'.basename($_FILES["fileToUpload"]["name"]).'<br>';
            #echo 'directory to create:'.$target_dir.$rn_client_id1.'<br>';
            if(!is_dir($target_dir.$rn_client_id1))
            {
                #echo 'Creating dir'.$target_dir.$rn_client_id1.'<br>';
                mkdir($target_dir.$rn_client_id1);
            }
            if(basename($_FILES["fileToUpload"]["name"]))
            {
                
                /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
                $target_file = $target_dir . $rn_client_id1.'.jpg';
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
            
            /* image upload end*/



	    }
	    else
	    {
	        $messsage= "Sorry, there was an error uploading your data.Please contact out contact center";
			$err_code=1;
	    }
    }



    if($DEBUG_STATUS)
    {
        echo 'Error code:'.$err_code.'<br>';
    }

    $rn_client_id="";
	$rn_client_name="";
	$rn_address="";
	$rn_mobile="";
	$rn_tollFree="";
	$rn_phone="";
	$rn_rate="0";
	$rn_show_price="N";
	$rn_plan_id="2";
	$rn_is_approved="N";
	$rn_description="";
	$rn_latitude="";
	$rn_longitude="";
	$rn_country="";
	$rn_state="";
	$rn_city="";
	$rn_category="";
	$rn_subcategory="";
    $rn_website="";
    $rn_facebook="";

    if(isset($_SESSION["userid"]))
    {
    	$userId= $_SESSION["userid"];
	    $sql = "SELECT rn_client_id,rn_client_name,rn_address,rn_mobile,rn_tollFree,rn_phone,rn_rate,rn_show_price,
				rn_plan_id, rn_is_approved,rn_description,rn_latitude,rn_longitude,rn_country,rn_state,rn_city,
				rn_category,rn_subcategory,rn_website,rn_facebook
				FROM rn_usuario, rn_clients WHERE ru_userid='".$userId."' and rn_user_id=ru_userid";
		
	    $result = mysqli_query($dbcon,$sql);
	    if(mysqli_num_rows($result) > 0)  
	    {
	    	 while($row = mysqli_fetch_assoc($result)) 
			{
		     	//$err_code=0; 
		     	$rn_client_id=$row["rn_client_id"];
		     	$_SESSION["clientid"]=$rn_client_id;
				$rn_client_name=$row['rn_client_name'];
				$rn_address=$row["rn_address"];
				$rn_mobile=$row["rn_mobile"];
				$rn_tollFree=$row["rn_tollFree"];
				$rn_phone=$row["rn_phone"];
				$rn_rate=$row["rn_rate"];
				$rn_show_price=$row["rn_show_price"];
				$rn_plan_id=$row["rn_plan_id"];
				$rn_is_approved=$row["rn_is_approved"];
				$rn_description=$row["rn_description"];
				$rn_latitude=$row["rn_latitude"];
				$rn_longitude=$row["rn_longitude"];
				$rn_country=$row["rn_country"];
				$rn_state=$row["rn_state"];
				$rn_city=$row["rn_city"];
				$rn_category=$row["rn_category"];
				$rn_subcategory=$row["rn_subcategory"];  
                $rn_website=$row["rn_website"]; 
                $rn_facebook=$row["rn_facebook"]; 
		     	if($DEBUG_STATUS)
		    	{
			        echo "Client Id: ".$row["rn_client_id"]."<br>";
			        echo "Client Name: ".$row['rn_client_name']."<br>";
			        echo "Client Address: ".$row["rn_address"]."<br>";
			        echo "Client Mobile: ".$row["rn_mobile"]."<br>";
			        echo "Client Toll Free: ".$row["rn_tollFree"]."<br>";
			        echo "Client Phone: ".$row["rn_phone"]."<br>";
			        echo "Client Rate: ".$row["rn_rate"]."<br>";
			        echo "Client Show Price: ".$row["rn_show_price"]."<br>";
			        echo "Client Plan: ".$row["rn_plan_id"]."<br>";
			        echo "Client Is Approved: ".$row["rn_is_approved"]."<br>";
			        echo "Client Description: ".$row["rn_description"]."<br>";
			        echo "Client Latitude: ".$row["rn_latitude"]."<br>";
			        echo "Client Longitude: ".$row["rn_longitude"]."<br>";
			        echo "Client Country: ".$row["rn_country"]."<br>";
			        echo "Client State: ".$row["rn_state"]."<br>";
			        echo "Client City: ".$row["rn_city"]."<br>";
			        echo "Client Category: ".$row["rn_category"]."<br>";
			        echo "Client Sub-Category: ".$row["rn_subcategory"]."<br>";
                    echo "Client Website: ".$row["rn_website"]."<br>";
			        echo "Client Facebook: ".$row["rn_facebook"]."<br>";
		        }  
	        } 
	    }	
    }


    $sql = "SELECT id,name FROM countries order by id";         
    $result = mysqli_query($dbcon,$sql);

    include_once('default_catalogs.php');
    $statesArray=$countries_state_catalog;
    $citiesArray=$state_city_catalog;




    include_once('default_guestmainfilterpanel2.php');
?>

<input type="hidden" id="statesarr" value="<?php echo $statesArray;?>">
<input type="hidden" id="citiesarr" value="<?php echo $citiesArray;?>">
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
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=clientprofile" class="userMenu-link-active"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
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




<div class="container profileContainer"> 
		<div class="row">
			<br>
			<div class="col-sm-12">
				<div class="row clientCont">
				        <form method="post" action="index.php?view=shop&layout=clientprofile" enctype="multipart/form-data">
					        <input type="hidden" name="submitted" value="true" />
                            <div class="col-sm-12">
                                <div class="row">
					                <div class="col-sm-3 profileDtl">
                                        <?php 
                                        if(file_exists($target_dir . $rn_client_id.'.jpg'))
                                        {
                                            ?>
                                            <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $rn_client_id; ?>.jpg?rand=<?php echo rand(); ?>" id="uploadImg" class="profileImage" />
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
                                        <?php 
                                        	if($rn_client_id)
                                        	{
                                        ?>
                                        	<br>
                                        	<a href="index.php?view=shop&layout=manageitems&pagecount=0" class="submit_button"><button type="button" class="btn btn-success btn-success_style">View Products</button></a>
                                        <?php
                                        	}
                                        ?> 
                                    </div>
        							<div class="col-sm-9 itemDtl">										
                                        <label for="rn_description">Description</label>
                                        <textarea class="form-control" rows="19" maxlength="2000" name="rn_description" placeholder="Description(Tamano Mximo:2000 caracteres)" required><?php echo $rn_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">							
                                    <div class="col-sm-12 itemDtl">
                                        <label for="rn_client_id">Id</label>
                                        <input type="text" class="form-control" maxlength=9 name="rn_client_id" value="<?php echo $rn_client_id; ?>" readonly="true" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_client_name">Name</label>
                                        <input type="text" class="form-control" maxlength=100 placeholder="Name of client(Tamano maximo:100 :caracteres o numeros)" name="rn_client_name" value="<?php echo $rn_client_name; ?>" required>
                                    </div>
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_category">Category</label>
                                        <input type="text" class="form-control" maxlength=30 placeholder="Primary Category(Tamano maximo:30 :caracteres)" name="rn_category" value="<?php echo $rn_category; ?>" required>
                                    </div>
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_subcategory">Sub-Category</label>
                                        <input type="text" class="form-control" maxlength=300 placeholder="Primary Category(Tamano maximo:300 :caracteres)" name="rn_subcategory" value='<?php echo $rn_subcategory; ?>' required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_mobile">Mobile</label>
                                        <input type="text" class="form-control" maxlength=15 name="rn_mobile" placeholder="Numero celular(Tamanno max:15, solo numeros)" value="<?php echo $rn_mobile; ?>" required>
                                    </div>
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_tollFree">Toll-Free</label>
                                        <input type="text" class="form-control" maxlength=20 name="rn_tollFree" placeholder="Toll Free(Tamanno max:20, solo numeros)" value="<?php echo $rn_tollFree; ?>" required>
                                    </div>
                                    <div class="col-sm-4 ">
                                        <label for="rn_show_price">Show Price</label>
                                        <?php                                             
                                        if(strcmp($rn_show_price,"Y")==0) 
                                        {
                                        ?>
                                            <input type="radio" name="rn_show_price" value="Y" checked="true">SI
                                            <input type="radio" name="rn_show_price" value="N">NO
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <input type="radio" name="rn_show_price" value="Y">SI
                                            <input type="radio" name="rn_show_price" value="N" checked="true">NO
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_phone">Phone</label>
                                        <input type="text" class="form-control" maxlength=30 name="rn_phone" placeholder="Numero Telefono(Tamanno max:30, solo numeros)" value="<?php echo $rn_phone; ?>" required>
                                    </div>
                                     <div class="col-sm-4 itemDtl">
                                        <label for="rn_website">Website Url</label>
                                        <input type="text" class="form-control" size=100 name="rn_website" placeholder="URL del sitio web(Tamanno max:100)" value="<?php echo $rn_website; ?>">
                                    </div>
                                     <div class="col-sm-4 itemDtl">
                                        <label for="rn_facebook">Facebook Url</label>
                                        <input type="text" class="form-control" size=100 name="rn_facebook" placeholder="URL del Facebook(Tamanno max:100)" value="<?php echo $rn_facebook; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_rate">Rating</label>
                                        <input type="text" class="form-control" size=25 name="rn_rate" value=<?php echo $rn_rate; ?>  readonly="true" >
                                    </div>
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_plan_id">Plan Id</label>
                                        <input type="text" class="form-control" size=25 name="rn_plan_id" value=<?php echo $rn_plan_id; ?>  readonly="true" >
                                    </div>
                                    <div class="col-sm-4 itemDtl">
                                        <label for="rn_is_approved">Is Approved</label>
                                        <input type="text" class="form-control" size=25 name="rn_is_approved" value=<?php echo $rn_is_approved; ?>  readonly="true" >
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 itemDtl">
                                        <label for="rn_country">Country</label>
                                        <!-- <input type="text" class="form-control" size=25 name="rn_country" value=<?php echo $rn_country; ?> required> -->
                                        <input type="hidden" class="form-control" size=25 name="rn_country" id="country-Id" value=<?php echo $rn_country; ?>>
                                        <select name="country" class="form-control countries" id="countryId"  onchange="getStates()" required>
                                            <option value="">Select Country</option>
                                            <?php
                                                if(mysqli_num_rows($result) > 0)  
                                                {
                                                    while($row = mysqli_fetch_assoc($result)) 
                                                    {
                                                        echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 itemDtl">
                                        <label for="rn_state">State</label>
                                        <!-- <input type="text" class="form-control" size=25 name="rn_state" value="<?php echo $rn_state; ?>" required> -->
                                        <input type="hidden" class="form-control" size=25 name="rn_state" id="state-Id" value="<?php echo $rn_state; ?>">
                                        <select name="state" class="form-control states" id="stateId" onchange="getCities()" required>
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 itemDtl">
                                        <label for="rn_city">City</label>
                                        <!-- <input type="text" class="form-control" size=25 name="rn_city" value=<?php echo $rn_city; ?> required> -->
                                        <input type="hidden" class="form-control" size=25 name="rn_city" id="city-Id" value=<?php echo $rn_city; ?>>
                                         <select name="city" class="form-control cities" id="cityId"  onchange="setCity()" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 itemDtl">
                                        <label for="rn_address">Street</label>
                                        <input type="text" class="form-control" maxlength=100 name="rn_address" id="street" placeholder="Calle/Street(Tamanno max:100)" value="<?php echo $rn_address; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-sm-12 itemDtl">                                   
                                        <div class="row"> -->                                    
                                            <div class="col-sm-5 itemDtl">
                                                <label for="rn_latitude">Latitude</label>
                                                <input type="text" class="form-control" size=25 name="rn_latitude" id="rn_latitude" value="<?php echo $rn_latitude; ?>" readonly="true"  required>
                                            </div>
                                            <div class="col-sm-5 itemDtl">
                                                <label for="rn_longitude">Longitude</label>
                                                <input type="text" class="form-control" size=25 name="rn_longitude" id="rn_longitude" value="<?php echo $rn_longitude; ?>" readonly="true"  required>
                                            </div>
                                            <div class="col-sm-2 itemDtl">
                                                <!-- <button type="button" class="btn btn-success" onclick="getLocation()">Get Location</button> -->
                                                <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-map-marker" onclick="getLocation()" title="Click to get geological Location"></span></button>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <!-- <label for="rn_longitude">MAP URL</label> -->
                                        <div id="mapholder">                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <button type="submit" class="btn btn-success btn-success_style">Submit</button>
                                    </div>
                                </div>
                            </div>
					    </form>
		             
			    </div>
			</div>
		</div>
	</div>


<?php
}

?>