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
    }

    if(isset($_SESSION["clientid"]))
    {
    	$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';
	    if($DEBUG_STATUS)
	    {
	        echo 'Error code:'.$err_code.'<br>';
	    }

	    if(isset($_SESSION["session_msg"]))
	    {
	    	$messsage= $_SESSION["session_msg"];
	    	$err_code=2;
	    	unset($_SESSION["session_msg"]);
	    }	   

	    if(isset($_SESSION["userid"]))
	    {
	        $userId= $_SESSION["userid"];
	        $clientId=$_SESSION["clientid"];

	    }

	    $sqlGetCategory="SELECT id, description FROM rn_category";
	    $resultCategory = mysqli_query($dbcon,$sqlGetCategory);
	    include_once('default_catalogs.php');
	    $subcategoryArray=$category_sucategory_catalog;
    }
    else
    {
    	$messsage= "No client details found. Please Complete client profile first to add products.<a href='index.php?view=shop&amp;layout=clientprofile'>CLIENT PROFILE</a>";
	    $err_code=1;	    	
    }   


    include_once('default_guestmainfilterpanel2.php');

?>


<input type="hidden" id="subcategoryarr" value="<?php echo $subcategoryArray;?>">
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

<form method="post" action=index.php?view=shop&layout=addnewitem enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="true" />                                        
    <div class="container">            
		<div class="row">
			<div class="col-sm-3 profileDtl">						
                <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/unknown_user.png id="uploadImg" class="profileImage"/>
                <label for="imgId">Upload / Edit(Tamano max: 500KB, Resolucion : 400*400)</label>
                <p>Editar su imagines aqui : <b>https://pixlr.com/editor</b></p>
                <input type="file" name="fileToUpload" id="fileToUpload">   
                <br>                        
			</div>
			<div class="col-sm-9 itemDtl">
                <div class="row">
                    <div class="col-sm-12 profileDtl">
				        <label for="rn_description">Description</label>
				        <textarea name="rn_item_desc" class="form-control" maxlength=2500 placeholder="Description(Tamano maximo: 2500)" rows="16"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 profileDtl">
                        <label for="rn_item_name">Stock Qty</label>
                        <input type="text" class="form-control" maxlength=10 placeholder="Available Qty(Tamano maximo: 5 :numeros)"  name="rn_stock_qty" id="stk_qty" onchange="return checkQty();" required>
                    </div>
                    <div class="col-sm-6 profileDtl">
                        <label for="rn_item_name">Delivery Time</label>
                        <input type="text" class="form-control" maxlength=10 placeholder="Delivery Time(Tamano maximo: 2 :numeros)"  name="rn_delivery_time" id="del_time" onchange="return checkDeliveryTime();" required>
                    </div>
                </div>
			</div>
        </div>
        <div class="row">
            <div class="col-sm-4 itemDtl">
                <label for="rn_item_name">Name</label>
                <input type="text" class="form-control" maxlength=100 placeholder="Product Name(Tamano maximo: 100 :numeros o letras)"  name="rn_item_name" required>
            </div>
			<div class="col-sm-4 itemDtl">
				<label for="rn_client_id">Client Id</label>
                <input type="text" class="form-control" size=25 name="rn_client_id" readonly="true" value="<?php echo $clientId;?>">
			</div>                            
            <div class="col-sm-4 itemDtl">
                <label for="rn_rate">Rating</label>                                   
                <input type="text" class="form-control" size=25 name="rn_rate" readonly="true" value="0">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 itemDtl">
                <label for="rn_item_category">Category</label>
                <input type="hidden" class="form-control" size=25 name="rn_item_category" id="category-Id" >
                <select name="category" class="form-control countries" id="categoryId"  onchange="getSubCategories()" required>
                    <option value="">Select Category</option>
                    <?php
                        if(mysqli_num_rows($resultCategory) > 0)  
                        {
                            while($rowCategory = mysqli_fetch_assoc($resultCategory)) 
                            {
                                echo $rowCategory["id"].'<br>';
                                echo $rowCategory["description"].'<br>';
                                echo "<option value='".$rowCategory["id"]."'>".$rowCategory["description"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-6 itemDtl">
                <label for="rn_state">Sub Category</label>
                <!-- <input type="text" class="form-control" size=25 name="rn_state" value="<?php echo $rn_state; ?>" required> -->
                <input type="hidden" class="form-control" size=25 name="rn_subcategory" id="subcategory-Id">
                <select name="subcategory" class="form-control states" id="subcategoryId" onchange="setSubCategory()" required>
                    <option value="">Select Sub Category</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 itemDtl">
                <label for="rn_tags">Tags</label>                                  
                <input type="text" class="form-control" maxlength=200 placeholder="Keywords(tamano maximo: 100 :numeros o letras)"  name="rn_tags" id="rn_tags" required>
            </div>
			<div class="col-sm-4 itemDtl">
				<label for="rn_price">Price(with IVA 12%)</label>                                  
                <input type="text" class="form-control" size=25 id="price" name="rn_price" required>
			</div>							
            <div class="col-sm-4">
                <label for="rn_enable">Enable</label>
                <input type="radio" name="rn_enable" value="Y" checked="true">SI
                <input type="radio" name="rn_enable" value="N">NO                                    
            </div>
        </div>
        <div class="row">
			<div class="col-sm-12 itemDtl">
				<label for="rn_item_desc">OFFER DETAILS</label>
				<textarea name="rn_offer" class="form-control" rows="3" maxlength=500 placeholder="Offer Descption(Tamano maximo: 500)" id="offerDesc"></textarea>
			</div> 
        </div>
        <div class="row">
			<div class="col-sm-6 itemDtl">
				<label for="rn_offer_start_dt">OFFER START FROM</label>                                 
                <input type="date" class="form-control dateParam" size=25 name="rn_offer_start_dt" id="offerValidFrom">
			</div>
			<div class="col-sm-6 itemDtl">
				<label for="rn_offer_end_dt">OFFER END ON</label>                                 
                <input type="date" class="form-control dateParam" size=25 name="rn_offer_end_dt" id="offerValidTo">
			</div> 
        </div>
        <div class="row">
            <div class="col-sm-5 itemDtl">
            </div>
            <div class="col-sm-2 itemDtl">
                <button type="submit" class="btn btn-success" onclick="return validateForm()">SUBMIT</button></a>
            </div>
            <div class="col-sm-5 itemDtl">
            </div>
        </div>
        
	</div>
</form>
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
 /*   if(!isNaN(document.getElementById("stk_qty").value)
    {
        return false;    
    }
    if(isNaN(document.getElementById("del_time").value))
    {
        return true;
    }*/

    

	return validatePrice();
	
}

function checkQty()
{
    if(isNaN(document.getElementById("stk_qty").value))
    {
        alert("STOCK QTY: Please enter only number value not > 99999");
        document.getElementById("stk_qty").value=1;
        return false;
    }
}
function checkDeliveryTime()
{
    if(isNaN(document.getElementById("del_time").value))
    {
        alert("DELIVERY TIME: Please enter only number value not > 99");
        document.getElementById("del_time").value=1;
        return false;
    }
}
</script>
<?php
}
?>