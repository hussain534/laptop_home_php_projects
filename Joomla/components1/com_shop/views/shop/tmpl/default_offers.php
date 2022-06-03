<?php
	defined('_JEXEC') or die('Restricted access');	

	$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

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
        //$err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        #$messsage='User ID : '.$_SESSION["userid"];
        //$messsage='User Name : '.$_SESSION['userName'];
    
	    //$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';
	    if($DEBUG_STATUS)
	    {
	        echo 'Error code:'.$err_code.'<br>';
	    } 
	    //echo JURI::root().'media/com_shop/images/clients/'.$_SESSION["clientid"].'/'.$_SESSION["clientid"].'-offer.jpg';
	    if(isset($_SESSION['clientid']))
	    	$clientId=$_SESSION['clientid'];
	    //echo $clientId;
	    
	    //include_once('default_guestMainFilterPanel2.php'); 
	}  
    
?>


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
    			            <li><a href="index.php?view=shop&layout=manageItems&pagecount=0" class="userMenu-link"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=manageOffersForm" class="userMenu-link-active"><span class='glyphicon glyphicon-tag'></span> Offer</a></li>
    			        </ul>
    			    </div>	    
    			</div>
            </div>
        </div>
    </div>     
    <?php
}       
?>


<div class="container login" id="login">  
	<div class="row">
		<div class="col-sm-12">
			<p class="sectionHeader">OFFERS</span></p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
	<?php
		$i=0;
		$sqlOffer = "select ro.rn_offer_desc,ro.rn_client_id,ro.rn_offer_start_from,ro.rn_offer_ends_on,rc.rn_client_name from rn_offers ro,rn_clients rc where DATE_FORMAT(now(),'%Y-%m-%d') <= ro.rn_offer_ends_on and ro.rn_client_id=rc.rn_client_id order by ro.rn_offer_created_on desc";
		$result = mysqli_query($dbcon,$sqlOffer);
		if(mysqli_num_rows($result) > 0)  
		{
		    $err_code=0;
		    while($row = mysqli_fetch_assoc($result)) 
		    {
		    	$i=$i+1;
					if($i%2==0)
					{
	?>
						<div class="col-sm-6 offer-block" style="background: <?php echo '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)]; ?>;">
							<div class="offer_desc_panel">
								<p><?php echo $row["rn_client_name"];?></p>
							</div>
							<img src=<?php echo JURI::root().'media/com_shop/images/clients/'.$row["rn_client_id"].'/'.$row["rn_client_id"];?>-offer.jpg id="uploadImg" class="profileImage" title="<?php echo $row["rn_offer_desc"];?>" />								
						</div>
					</div>

	<?php
					}
					else
					{
	?>	
					<div class="row">
						<div class="col-sm-6 offer-block" style="background: <?php echo '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)]; ?>;">
							<div class="offer_desc_panel">
								<p><?php echo $row["rn_client_name"];?></p>
							</div>
							<img src=<?php echo JURI::root().'media/com_shop/images/clients/'.$row["rn_client_id"].'/'.$row["rn_client_id"];?>-offer.jpg id="uploadImg" class="profileImage" title="<?php echo $row["rn_offer_desc"];?>" />								
						</div>
	<?php
					}
			}
			if($i%2==1)
			{
	?>
				</div>
	<?php			
			}
		}
	?>
		</div>
	</div>

	

</div>