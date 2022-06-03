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

	if(isset($_POST['searchOfferParam']))
		$searchKey = $_POST['searchOfferParam'];
	else
		$searchKey = "";
	//echo $searchKey;
    
?>

<div class="container-fluid category" style="margin:0 0 10px 0">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<div class="inner-addon left-addon" style="margin-bottom:5px">
						<form method="post" action="index.php?view=shop&amp;layout=offers">
							<span class="glyphicon glyphicon-search"></span>
							<input type="text" class="form-control" id="email" name="searchOfferParam" placeholder="Ejemplo: Laptop kfc pizza marathon" value=
							"<?php echo isset($_POST['searchOfferParam'])?$_POST['searchOfferParam']:'';?>"
							required>
							<button type="submit" class="btn btn-success">Go</button>
						</form>
					</div>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
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


<div class="container login" id="login" style="background:white;border:none;">  
	<div class="row">
		<div class="col-sm-12">
			<p class="sectionHeader">OFFERS</span></p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
	<?php
		//echo $searchKey.'<br>';

		if(isset($searchKey) and strlen($searchKey)>0)
		{
			$searchArr = split(" ",$searchKey);
			//echo sizeof($searchArr).'<br>';
		    $x=0;
		    $sqlQuery ="select ro.rn_offer_keywords,ro.rn_offer_desc,ro.rn_client_id,ro.rn_offer_start_from,ro.rn_offer_ends_on,
					rc.rn_client_name from rn_offers ro,rn_clients rc 
					where DATE_FORMAT(now(),'%Y-%m-%d') <= ro.rn_offer_ends_on ";
		    while(sizeof($searchArr)>$x)
		    {	    	
		    	if($x==0)
		    		$sqlQuery = $sqlQuery ." and (rn_offer_keywords like '%".strtoupper($searchArr[$x])."%' or rc.rn_client_name like '%".strtoupper($searchArr[$x])."%'";
		    	else 
		    		$sqlQuery = $sqlQuery ." or rn_offer_keywords like '%".strtoupper($searchArr[$x])."%' or rc.rn_client_name like '%".strtoupper($searchArr[$x])."%'";
		    	
				$x=$x+1;
		    } 
		    if($x>0)
		    		$sqlQuery = $sqlQuery .")";

		    $sqlOffer = $sqlQuery." and ro.rn_client_id=rc.rn_client_id order by ro.rn_offer_created_on desc";
		}
		else
		{
			$sqlOffer = "select ro.rn_offer_desc,ro.rn_client_id,ro.rn_offer_start_from,ro.rn_offer_ends_on,
				rc.rn_client_name from rn_offers ro,rn_clients rc 
				where DATE_FORMAT(now(),'%Y-%m-%d') <= ro.rn_offer_ends_on and ro.rn_client_id=rc.rn_client_id 
				order by ro.rn_offer_created_on desc";
		}

		$i=0;
		
		//echo $sqlOffer;
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