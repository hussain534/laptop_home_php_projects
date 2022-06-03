<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;
	$doShowCurrentItem=0;

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
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        if(isset($_GET["cartId"]))
        	$cartId = $_GET["cartId"];
        else
        	$cartId = 0;
        $err_code=2;
        $messsage = $_SESSION["session_msg"];
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
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=manageitems&pagecount=0" class="userMenu-link-active"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
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
			<div class="container">
				<div class="row order">
					<div class="col-sm-12 order_title">
						<b>ORDER-ID:</b>
						<?php echo $cartId;?>
					</div>
				</div>
				<div class="row order">
					<div class="col-sm-12 order_title">
						<b>DATE:</b>
						<?php echo date('D d-m-Y H:i:s');?>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table" id="t0">
				    	<thead class="order_item">
							<tr>
								<th class="order_item_title">ITEM ID</th>
								<th class="order_item_title">ITEM NAME</th>
								<th class="order_item_title">CLIENT ID</th>
								<th class="order_item_title">CLIENT NAME</th>
								<th class="order_item_title">PRICE/QTY</th>
								<th class="order_item_title">QTY</th>
								<th class="order_item_title">TOTAL PRICE</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
								$sqlSelect = "SELECT item_id,item_name,client_id,client_name,price_per_unit, total_units,
									total_price FROM rn_order_management WHERE order_num=".$cartId;
									$resultSelect = mysqli_query($dbcon,$sqlSelect);
									if(mysqli_num_rows($resultSelect) > 0)  
									{
										while($rowSelect = mysqli_fetch_assoc($resultSelect)) 
										{	
							?>
							<tr>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['item_id'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" value="<?php echo $rowSelect['item_name'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['client_id'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" value="<?php echo $rowSelect['client_name'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['price_per_unit'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="3" value="<?php echo $rowSelect['total_units'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" style="text-align:right" value="<?php echo $rowSelect['total_price'];?>" readonly></td>
							</tr>
							<?php
										}
									}
								//}
							?>
						</tbody>
					</table>
				</div>
				<div class="row order">
					<div class="col-sm-12 order_title">
						<input type="text" class="form-control text_style_02" size="10" id="total" style="text-align:right;font-weight:bold" readonly>
					</div>
				</div>
				
			</div>

		<br>
		<br>
	
    <?php
}
?>

