<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
	$pageTitle='FPWD';
    //include_once('default_template.php');
    if(isset($_SESSION["userid"]))
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
	}

    if (!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else
    {
        $ip = $_SERVER["REMOTE_ADDR"];
    }

    $user_visit= isset($_SESSION['userid'])?$_SESSION['userid']:'Guest';
    $sqlVisit = "insert into rn_visits(ip,user_id,page_id,visited_on)
                values ('".$_SERVER['REMOTE_ADDR']."','".$user_visit."','".$pageTitle."',now())";
    mysqli_query($dbcon,$sqlVisit);

	$err_code=1;
	$messsage="";
	$DEBUG_STATUS=false;
	if(isset($_POST['submitted']))
    {

    	if(isset($_POST['userId']))
        {
        	$userIDPwd = $_POST['userId'];
        	$sql = "SELECT ru_username,ru_email_id FROM RN_USUARIO WHERE ru_userid='".$userIDPwd."'";

        	$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
            	 if($row = mysqli_fetch_assoc($result))                     
            	 {

	            	$email_pwd_change=$row["ru_email_id"];
	            	$uname_pwd_change=$row["ru_username"];
	            }
            	//echo $email_pwd_change.'<br>'.$uname_pwd_change.'<br>';
            	$random_pwd = mt_rand();
            
	            $sql = "INSERT INTO RN_RETRIEVE_PWD_REQ(USER_ID, REQ_ON, RANDOM_PWD) VALUES('$userIDPwd',NOW(),'$random_pwd')";
	            if(mysqli_query($dbcon,$sql))
	            {
	                $sql = "UPDATE RN_LOGIN SET RN_PWD='".$random_pwd."' WHERE RN_USERID='".$userIDPwd."'";
	                if(mysqli_query($dbcon,$sql))
	                {
	                	$to = $email_pwd_change;
						$subject = "PASSWORD CHANGE REQUEST";
						$txt = "Hello ".$uname_pwd_change."!\n\n\n";
						$txt=$txt."Your new password is :".$random_pwd."\n\n\n";
						$txt=$txt."NOTE: If you didnot requested for password change, please contact to our customer care.\n";
						$headers = "From: webmaster@example.com";

						$res=mail($to,$subject,$txt,$headers);
						if($res==true)
						{
							$messsage = "New password has been sent to your registered email id. Please check your mail.";
	                    	$err_code=0;	
						}
						else
						{
							$messsage = "Password sending failed. Please Try again later.";
							$err_code=1;	
						}
	                    
	                        
	                }
	                else
	                {
	                    $err_code=1;
	                    //mysqli_close($dbcon);
	                    $messsage= "Password sending failed. Please Try again later.";
	                }                
	            }
	            else
	            {
	                $err_code=1;
	                //mysqli_close($dbcon);
	                $messsage= "Password sending failed. Please Try again later.";
	            }  
            }
            else
	        {
	            $err_code=1;
	            $messsage= "User not exists. Please enter correct User.";   
	        }
        }
          
    }
    else
    {
    	$userId= "";
    	
    }
    mysqli_close($dbcon);  


?>
<script type="text/javascript">
  $(".category").hide();
</script>

<div class="container">  
	<div class="row">
        <div class="col-sm-12">
        <?php 
            
        if($DEBUG_STATUS)
        {
        	echo '<br>err_code::'.$err_code;	
        }
        

        if ($err_code==0)
        {             

        echo "<div class='alert alert-success shopAlert'>";
            ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $messsage;
                       
        ?>
            <!-- <a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a> -->
            <a href=index.php?view=shop&amp;layout=login class="submit_button"><button type="button" class="btn btn-success">LOGIN</button></a>
        </div>
        </div>
    </div>
</div>
        <?php
        }
        if ($err_code==1)
        {
        	if($messsage!=null)
        	{
        	echo "<div class='alert alert-danger shopAlert'>";
            ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            
            echo $messsage;
            echo "</div>";
            }
        ?>
        </div>
    </div>
</div>

<div class="container"> 
	<div class="row">
		<div class="col-sm-12"> 
		</div>
	</div>
</div>






















<script type="text/javascript">
  $(".category").hide();
</script>
<form method="post" action="index.php?view=shop&amp;layout=forgetPwd">
	<input type="hidden" name="submitted" value="true" />
	<div class="container login" id="login">  
		<div class="row">
			<div class="col-sm-12">
				<p class="sectionHeader">RETRIEVE PASSWORD</span></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <span class="glyphicon glyphicon-user"></span>
				            <input type="text" class="form-control" id="userId" placeholder="User Name" name="userId" required autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col12  style-text-center">
						<button type="submit" class="btn btn-info loginSubmit">Submit</button>
						<a href="index.php?view=shop&amp;layout=login" class="link01">LOGIN</a><span class="separatorKey">|</span><a href="index.php?view=shop&amp;layout=registerForm" class="link01">REGISTER</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
			</div>
			<!-- <div class="col-sm-6">
				<div class="row logindetails">
					<div class="col-sm-12">
						<div class="details">
							<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/rewards.png>				
							<label for="ben01" class="label-01">Gain Credit Points</label>	
						</div>
						<div class="details">
							<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/reviews.png>				
							<label for="ben01" class="label-01">Post Comments</label>	
						</div>
						<div class="details">
							<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/cart.png>
							<label for="ben01" class="label-01">Purchase Online</label>	
						</div>
						
					</div>
				</div>
			</div> -->
		</div>
		<div class="row style-text-center">
			<br>
			<div class="col-sm-12">
				<label for="ben01" class="label-01">Why Should I Register Myself?</label>
			</div>
			<div class="col-sm-12">
				<label for="ben01" class="link01">You should register yourself to:</label>
			</div>
			<div class="col-sm-12">
				<div class="details">
					<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/rewards.png>				
					<label for="ben01" class="label-01">Gain Credit Points</label>	
				</div>
				<div class="details">
					<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/reviews.png>				
					<label for="ben01" class="label-01">Post Comments</label>	
				</div>
				<div class="details">
					<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/cart.png>
					<label for="ben01" class="label-01">Purchase Online</label>	
				</div>						
			</div>
		</div>
	</div>
</form>
<?php

}
?>
