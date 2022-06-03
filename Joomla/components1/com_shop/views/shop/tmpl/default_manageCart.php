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
        if(!isset($_SESSION["Order_id"]))
		{
			$_SESSION["Order_id"]=mt_rand();
		}

		if(isset($_SESSION["session_add_to_cart_msg"]))
		{
			$messsage=$_SESSION["session_add_to_cart_msg"];
			$err_code=2;
			unset($_SESSION["session_add_to_cart_msg"]);
		}
		
		if(isset($_SESSION["message_product_delete"]))
		{
			$messsage=$_SESSION["message_product_delete"];
			$err_code=2;
			unset($_SESSION["message_product_delete"]);
		}

		if(isset($_SESSION["message"]))
		{
			$messsage=$_SESSION["message"];
			$err_code=2;
			unset($_SESSION["message"]);
		}

        if(isset($_POST['submitted']))
    	{
    		//echo 'cart data:'.$_POST['cart-data'].'<br>';
    		//echo $_POST['cart-data'].'<br>';
    		//echo count(explode("|",$_POST['cart-data'])).'<br>';
    		//echo $_SESSION["Order_id"].'<br>';
    		$sqlDelete = "DELETE FROM RN_ORDER_MANAGEMENT WHERE order_num=".$_SESSION['Order_id'];
    		mysqli_query($dbcon,$sqlDelete);
    		$dataItems = explode("|",$_POST['cart-data']);
    		//echo count($dataItems).'<br>';
    		for($x=0;$x<count($dataItems)-1;)
    		{
    			//echo 'dataItems::'.$dataItems[$x];    			
    			$data = explode("~",$dataItems[$x]);
    			//echo 'data count::'.count($data).'<br>';
    			
    			$sqlInsert = "INSERT INTO RN_ORDER_MANAGEMENT(order_num,user_id,user_name,item_id,item_name,client_id,client_name,
    							price_per_unit,total_units,total_price,registration_portal)
    						  VALUES(".$_SESSION['Order_id'].",'".$_SESSION['userid']."','".$_SESSION['userName']."',".$data[0].",'".$data[1]."',".$data[2].",'".$data[3]."',
    						  		".$data[4].",".$data[5].",".$data[6].",now())";
				//echo $sqlInsert;
    			if(mysqli_query($dbcon,$sqlInsert))
    			{
    				$messsage="Your Cart has been saved successfully";
    				$doShowCurrentItem=1;

    			}
    			else
    			{
    				$messsage="Error while saving your cart. Please try later.";	
    			}
    			$err_code=2;
    			$x=$x+1;
    		}
    		if($_POST['confirm-cart-data']==1)
			{
				$sqlUpdate = "UPDATE RN_ORDER_MANAGEMENT SET STATUS_PORTAL=1 WHERE order_num=".$_SESSION['Order_id'];
				if(mysqli_query($dbcon,$sqlUpdate))
    			{
    				$to = $_SESSION['userEmail'];
					$subject = "NEW ORDER REQUEST - ".$_SESSION['Order_id'];
					$txt = "Hello ".$_SESSION['userName']."!\n\n";
					$txt=$txt."Your order :".$_SESSION['Order_id']." recieved successfully\n\n";
					$txt=$txt."NOTE: If you didnot placed this order, please contact to our customer care.\n";
					$headers = "From: webmaster@shop534.com";
					$res=mail($to,$subject,$txt,$headers);

    				$messsage="Your order is confirmed.Your Order ID is:".$_SESSION['Order_id'].". Please keep this order 
    				number safe with you. We will call you shortly to confirm the order and start delivery.";
    				$doShowCurrentItem=1;
    				$_SESSION["session_msg"]=$messsage;
    				$cartId = $_SESSION['Order_id'];
    				unset($_SESSION['Order_id']);
    				$_SESSION["Order_id"]=mt_rand();

    				//echo $_SESSION['Order_id'].'<br>';
    				//echo $cartId.'<br>';
    				$url = "index.php?view=shop&layout=cartConfirmation&cartId=".$cartId;
    				header("Location:$url");

    			}
    			else
    			{
    				$messsage="Error while confirming your order. Please try later.";	
    			}
			}
    		
    	}
    }

    if(isset($_GET['itemId']))
    	$itemId = $_GET['itemId'];
   	else
   		$itemId = 0;

   	

   	$newItemId="";
   	$newItemName="";
   	$newItemClientId="";
   	$newItemClientName="";
   	$newItemPricePerUnit="";
   	$newItemQty="1";

   	$sqlNewItemQuery = "select ri.rn_id,ri.rn_item_name,rc.rn_client_id,rc.rn_client_name,ri.rn_price from rn_items ri, rn_clients rc 
   						where ri.rn_client_id=rc.rn_client_id and ri.rn_id=".$itemId;
   	$resultNewItemQuery = mysqli_query($dbcon,$sqlNewItemQuery);
	if(mysqli_num_rows($resultNewItemQuery) > 0)  
	{
		while($rowNewItemQuery = mysqli_fetch_assoc($resultNewItemQuery)) 
		{  
			$newItemId = $rowNewItemQuery['rn_id'];
			$newItemName=$rowNewItemQuery['rn_item_name'];
		   	$newItemClientId=$rowNewItemQuery['rn_client_id'];
		   	$newItemClientName=$rowNewItemQuery['rn_client_name'];
		   	$newItemPricePerUnit=$rowNewItemQuery['rn_price'];
		}
	}
	//echo $_SESSION["Order_id"].'<br>';
	//echo $doShowCurrentItem.'<br>';
   
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
                        <li class="userMenu-active"><a href='index.php?view=shop&layout=manageCart' class="userMenu-link"><span class='glyphicon glyphicon-shopping-cart'></span> CHECKOUT</a></li>
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
		<form method="post" action=index.php?view=shop&amp;layout=manageCart&itemId=<?php echo $itemId;?>>
			<input type="hidden" name="submitted" value="true" />
			<input type="hidden" name="cart-data" id="cart-data" />
			<input type="hidden" name="confirm-cart-data" id="confirm-cart-data" value="0"/>
			<div class="container">
				<div class="row order">
					<div class="col-sm-12 order_title">
						<b>ORDER-ID:</b>
						<?php echo $_SESSION["Order_id"];?>
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
								<th class="order_item_title" style="text-align:center">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($doShowCurrentItem==0 and  $itemId>0)
								{
							?>
							<tr>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $newItemId;?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" class="form-control" value="<?php echo $newItemName;?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" class="form-control" value="<?php echo $newItemClientId;?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" class="form-control" value="<?php echo $newItemClientName;?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $newItemPricePerUnit;?>" readonly></td>
								<td><input type="text" class="form-control" size="3" value="<?php echo $newItemQty;?>" onchange="ValidateQty();"></td>
								<td><input type="text" class="form-control text_style_02" style="text-align:right" size="5" value="<?php echo $newItemQty*$newItemPricePerUnit;?>" readonly></td>
							</tr>
							<?php
								}
									$sqlSelect = "SELECT item_id,item_name,client_id,client_name,price_per_unit, total_units,
									total_price FROM RN_ORDER_MANAGEMENT WHERE order_num=".$_SESSION['Order_id'];
									$resultSelect = mysqli_query($dbcon,$sqlSelect);
									if(mysqli_num_rows($resultSelect) > 0)  
									{
										while($rowSelect = mysqli_fetch_assoc($resultSelect)) 
										{	
							?>

							<tr>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['item_id'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" class="form-control" value="<?php echo $rowSelect['item_name'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" class="form-control" value="<?php echo $rowSelect['client_id'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" class="form-control" value="<?php echo $rowSelect['client_name'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['price_per_unit'];?>" readonly></td>
								<td><input type="text" class="form-control" size="3" value="<?php echo $rowSelect['total_units'];?>" onchange="ValidateQty();"></td>
								<td><input type="text" class="form-control text_style_02" style="text-align:right" size="5" value="<?php echo $rowSelect['total_price'];?>" readonly></td>								
								<td><a href=index.php?view=shop&layout=productCancel&prodId=<?php echo $rowSelect['item_id'];?>&orderId=<?php echo $_SESSION['Order_id'];?> class="submit_button" onclick="return confirmDeleteProd('<?php echo $rowSelect['item_name'];?>');"><button type="button" class="btn btn-success" title="Click to delete this product from cart"><span class='glyphicon glyphicon-remove'></span></button></a></td>
							</tr>
							<?php
										}
									}
							?>
						</tbody>
					</table>
				</div>
				<div class="row order">
					<div class="col-sm-12 order_title">
						<input type="text" class="form-control text_style_02" size="10" id="total" style="text-align:right;font-weight:bold" readonly>
					</div>
				</div>
				<div class="row order">
					<div class="col-sm-12 order_title" id="manageCartBtns">
						<button type="submit" id="saveCart" class="btn btn-success loginSubmit" title="Click to save your order" onclick="return beforeSubmit();">SAVE YOUR ORDER</button>
						<button type="submit" id="confirmCart" class="btn btn-success loginSubmit" title="Click to confirm your order" onclick="return confirmCart1();">CONFIRM YOUR ORDER</button>
						<a href=index.php?view=shop&layout=cartCancel&orderId=<?php echo $_SESSION['Order_id'];?> id="cancelCart" class="submit_button" onclick="return cancelCart1();"><button type="button" class="btn btn-success" title="Click to cancel your order">CANCEL YOUR ORDER</button></a>						
					</div>
				</div>
			</div>
		</form>
		<br>
		<br>
	<script type="text/javascript">
		function ValidateQty()
		{
			var total=0;
			for(i=1;i<document.getElementById("t0").rows.length;i++)
			{
				if(isNaN(document.getElementById("t0").rows[i].cells[5].childNodes[0].value))
				{
					alert('Please enter a numeric quantity.');
					document.getElementById("t0").rows[i].cells[5].childNodes[0].value=1;
				}	
				document.getElementById("t0").rows[i].cells[6].childNodes[0].value = parseFloat(parseFloat(document.getElementById("t0").rows[i].cells[4].childNodes[0].value)*parseFloat(document.getElementById("t0").rows[i].cells[5].childNodes[0].value)).toFixed(2);
				total = total+parseFloat(document.getElementById("t0").rows[i].cells[6].childNodes[0].value);
			}
			document.getElementById("total").value='TOTAL : '+total;
		}

		function beforeSubmit()
		{
			document.getElementById("cart-data").value='';
			//alert("Rows:"+document.getElementById("t0").rows.length);
			for(i=1;i<document.getElementById("t0").rows.length;i++)
			{
				for(j=0;j<document.getElementById("t0").rows[i].cells.length;j++)
				{
					if(j<(document.getElementById("t0").rows[i].cells.length-1))
					{
						document.getElementById("cart-data").value=document.getElementById("cart-data").value+
							document.getElementById("t0").rows[i].cells[j].childNodes[0].value+'~';	
					}
					else
					{
						document.getElementById("cart-data").value=document.getElementById("cart-data").value+
							document.getElementById("t0").rows[i].cells[j].childNodes[0].value+'|';	
					}
					
				}
			}
			

		}

		function confirmCart1()
		{
			//alert("inside confirmCart");
			beforeSubmit();
			//alert("cart-data in text field:"+document.getElementById("cart-data").value);
			document.getElementById("confirm-cart-data").value='1';
		}

		function cancelCart1()
		{
			//alert("inside confirmCart");
			beforeSubmit();
			return confirm("Are you sure to drop this order.")
			//alert("cart-data in text field:"+document.getElementById("cart-data").value);
			//document.getElementById("confirm-cart-data").value='1';
		}
		
        function confirmDeleteProd(prodName)
        {
            return confirm("Are you sure to delete '"+prodName+"' from your cart");
        }
        
	</script>
    <?php
}
?>

