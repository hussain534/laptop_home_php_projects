<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

$err_code=1;
	$messsage="";
	$DEBUG_STATUS=false;

	if(isset($_GET['tipo']) and $_GET['tipo']==4)
	{
		$err_code=1;
		$messsage = isset($_GET['msg'])?$_GET['msg']:"";
	}
	/*if(isset($_POST['submitted']))
    {
    	
    	if(isset($_POST['userId']))
        	$userId= $_POST['userId'];
        $userName = $_POST['userName'];
        $pwd = $_POST['pwd'];
        $cnfPwd = $_POST['cnfPwd'];
        $emailId = $_POST['emailId'];
        $mobile = $_POST['mobile'];
        $userType = $_POST['userType'];

        if(strcmp($userId,"")==0)
        {
        	$messsage =  'Please Enter User ID!';
        }
        else if(strcmp($userName,"")==0)
        {
        	$messsage =  'Please Enter User Name!';
        }
        else if(strcmp($pwd,"")==0)
        {
        	$messsage =  'Please Enter Password!';
        }
        else if(strcmp($cnfPwd,"")==0)
        {
        	$messsage =  'Please Enter Confirm Password!';
        }
        else if(strcmp($emailId,"")==0)
        {
        	$messsage =  'Please Enter Email ID!';
        }
        else if(strcmp($mobile,"")==0)
        {
        	$messsage =  'Please Enter Mobile Number!';
        }
        else if(strcmp($userType,"")==0)
        {
        	$messsage =  'Please Enter User Type!';
        }
        else if(strcmp($pwd,$cnfPwd)==0)
        {
            
            $sql = "INSERT INTO RN_USUARIO VALUES('$userId','$userName',$userType,0,'$emailId','$mobile',now(),now(),'$userId','$userId','0')";
            if(mysqli_query($dbcon,$sql))
            {
                $sql = "INSERT INTO RN_LOGIN(RN_USERID,RN_PWD, RN_FAILED_ATTEMPTS, RN_FIRST_LOGIN,RN_USER_BLOCKED) 
                VALUES('$userId','$pwd',0,'Y','N')";
                if(mysqli_query($dbcon,$sql))
                {
                    $messsage = "Congratulations! Your details registered successfully";
                    
                    $err_code=0;     
                }
                else
                {
                    $err_code=1;
                    
                    $messsage= "Error registering your details. Try again later.";
                }                
            }
            else
            {
                $err_code=1;
                
                $messsage= "Error registering your details. Try again later.";
            }  

            if($err_code==1)
            {
            	if(strlen($userId)>0)
		        {
		        	$sql = "SELECT ru_userid, ru_username,ru_credits, ru_roleid FROM RN_USUARIO, RN_LOGIN 
		                    WHERE ru_userid='".$userId."' and ru_userid=rn_userid";
		            $result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
		                
		                if($row = mysqli_fetch_assoc($result)) 
		                {
		                	
		                	$messsage= "User Already exists.Use other user id.";
		                }
		            }
		        }
            }   
        }
        else
        {
            $err_code=1;
            $messsage= "Passwords mismatch. Please fill correct details.";   
        }  
    }
    else
    {*/
    	$userId= "";
    	$userName="";
    	$pwd="";
    	$cnfPwd="";
    	$emailId="";
    	$mobile="";
    	$userType="";
    /*}
    mysqli_close($dbcon);  */


?>
<script type="text/javascript">
  $(".category").hide();
</script>

<div>  
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
        	<a href=index.php?view=shop&amp;layout=login class="submit_button"><button type="button" class="btn btn-success">LOGIN</button></a>            
            <!-- <a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a> -->
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

<br>
<br>
<br>
<form method="post" action="index.php?view=shop&amp;layout=dologin">
	<input type="hidden" name="submitted" value="true" />
	<input type="hidden" name="activity" value="REGISTER">
	<div class="container register" id="register">  
		<div class="row">
			<div class="col-sm-12">
				<p class="sectionHeader">REGISTER</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="text" class="form-control" id="email" maxlength=10 placeholder="User ID(tamano maximo: 10 : numeros o letras)" name="userId" value="<?php echo htmlentities($userId); ?>" required autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="text" class="form-control" id="email" maxlength=60 placeholder="User Name(tamano maximo: 60 :solo letras)" name="userName" value="<?php echo htmlentities($userName); ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="password" class="form-control" id="email" maxlength=15 placeholder="Password(tamano maximo: 15 :numeros o letras o caracteres especiales)" name="pwd" value="<?php echo htmlentities($pwd); ?>" required>				            
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="password" class="form-control" id="email" maxlength=15 placeholder="Confirm Password" name="cnfPwd" value="<?php echo htmlentities($cnfPwd); ?>" required>				            
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="email" class="form-control" id="contact_email" maxlength=50 placeholder="Enter Email Id(tamano maximo: 50)" name="emailId" value="<?php echo htmlentities($emailId); ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="text" class="form-control" id="email" maxlength=15 placeholder="Enter mobile number(tamano maximo: 10 :solo numeros)" name="mobile" value="<?php echo htmlentities($mobile); ?>" required>
						</div>
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
							<label for="selplan">Select Plan:</label>
							<select class="form-control" id="selplan" name="selplan" value="<?php echo htmlentities($selplan); ?>">
					            <option value='1'>$20  : Basico - 1 month</option>
		                        <option value='2'>$54  : Basico - 3 month($18/month)</option>
		                        <option value='3'>$96  : Basico - 6 month($16/month)</option>
		                        <option value='4'>$180 : Basico - 1 year($15/month)</option>
		                        <option value='5'>$40  : Intermedio - 1 month</option>
		                        <option value='6'>$108 : Intermedio - 3 months($36/month)</option>
		                        <option value='7'>$192 : Intermedio - 6 months($32/month)</option>
		                        <option value='8'>$360 : Intermedio -1 Year($30/month)</option>
		                        <option value='9'>$80  : Mega - 1 month</option>
		                        <option value='10'>$216 : Mega - 3 months($72/month)</option>
		                        <option value='11'>$384 : Mega - 6 months($64/month)</option>
		                        <option value='12'>$720 : Mega - 1 year($60/month)</option>
		                    </select>
						</div>
					</div>
				</div> -->
				<div class="row">
					<div class="col-sm-12 style-text-center">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <input type="radio" name="userType" value="2" checked="true"><span class="label label-01" style="position: relative;top: -2px;margin: 0 15px 0 0;">Register as User</span>
	                        <input type="radio" name="userType" value="3"><span class="label label-01" style="position: relative;top: -2px;margin: 0 15px 0 0;">Register as Client</span>	                        
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col12 style-text-center">
						<input type="checkbox" id="terms"><span class="label label-01"><a href="index.php?view=shop&amp;layout=terms" class="link01" style="position:relative;top:-2px !important;margin:0 5px;">DID YOU READ OUR TERMS OF USE</a></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col12 style-text-center">
						<button type="submit" class="btn btn-success registerSubmit" onclick="return validateForm()">REGISTER</button>
						<a href="index.php?view=shop&amp;layout=login" class="link01"><button type="button" class="btn btn-success loginSubmit" title="Click to enter our portal">LOG IN</button></a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
			
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
<script>
	function validateForm()
	{
		//alert("1");
		//alert("Terms checked:"+document.getElementById("terms").checked);
		if(document.getElementById("terms").checked)
		{
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
		else
		{
			alert("Tick the check box if you read our terms of use!!");
			return false;
		}


		
	}

	
</script>	

<?php
}
?>