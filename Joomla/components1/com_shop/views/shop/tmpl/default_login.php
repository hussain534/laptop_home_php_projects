<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;


?>
<script type="text/javascript">
  $(".category").hide();
</script>
<?php
	if(isset($_GET['tipo']) and $_GET['tipo']==2)
	{
		$err_code=1;
		$messsage="Session Expired. Please login again.";
	}
	else if(isset($_GET['tipo']) and $_GET['tipo']==3)
	{
		$err_code=2;
		$messsage="Invalid credentials or you are accessing this page directly. Try with correct login details.";
	}
	else if(isset($_GET['tipo']) and $_GET['tipo']==1)
	{
		$err_code=2;
		$messsage="You have successfully logout.Thanks for using our portal.";
	}
?>


<form method="post" action="index.php?view=shop&amp;layout=doLogin">
	<input type="hidden" name="submitted" value="true" />
	<div class="container login" id="login">  
		<div class="row">
			<div class="col-sm-12">
				<p class="sectionHeader">LOGIN</span></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
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
		            echo "<div class='alert alert-success shopAlert'>";
		            ?>
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            <?php
		            echo $messsage;
		            echo "</div>";
		        }
		        ?>
		    </div>
		    <div class="col-sm-3">
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
				            <input type="text" class="form-control" id="email" placeholder="User ID" name="userId" required autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="inner-addon left-addon" style="margin-bottom:5px">
				            <span class="glyphicon glyphicon-pencil"></span>
				            <input type="password" class="form-control" id="email" placeholder="Password" name="pwd" required>				            
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col12 style-text-center">
						<a href="index.php?view=shop&amp;layout=terms" class="link01">READ OUR TERMS OF USE</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col12  style-text-center">
						<button type="submit" class="btn btn-info loginSubmit" title="Click to enter our portal">LOG IN</button>
						<a href="index.php?view=shop&amp;layout=forgetPwd" class="link01" title="Click to request your password">FORGET PASSWORD</a><span class="separatorKey">|</span><a href="index.php?view=shop&amp;layout=registerForm" class="link01">REGISTER</a>
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

