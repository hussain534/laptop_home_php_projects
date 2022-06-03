<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;
    $target_dir = 'media/com_helloworld/images/clients';
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
    //echo $_SESSION['LAST_ACTIVITY'];

    if(isset($_SESSION["session_msg"]))
    {
        $messsage= $_SESSION["session_msg"];
        $err_code=2;
        unset($_SESSION["session_msg"]);
    }

    if($DEBUG_STATUS)
    {
        echo 'Error code:'.$err_code.'<br>';
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
<br>
<form method="post" action="index.php?view=shop&layout=additems" enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="true" />
	<div class="container">            
		<div class="row">
			<div class="col-sm-2 profileDtl">
				<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/unknown_user.png style="width:150px;" id="uploadImg" class="profileImage"/>
	            <label for="imgId">Upload / Edit</label>
                <p>Editar su imagines aqui : <b>https://pixlr.com/editor</b></p>
	            <input type="file" name="fileToUpload" id="fileToUpload">
			</div>
			<div class="col-sm-4 itemDtl">
				<label for="rn_item_desc">Description</label>
				<textarea name="rn_item_desc" class="form-control" maxlength=2500 placeholder="Product Description(Tamano maximo: 2500)" rows="23" autofocus></textarea>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-12 itemDtl">
						<label for="rn_item_name">Name</label>
                        <input type="text" class="form-control" maxlength=100 placeholder="Product Name(Tamano maximo: 100 :numeros o letras)"  name="rn_item_name" required>
					</div>
					<div class="col-sm-12 itemDtl">
						<label for="rn_price">Price</label>
                        <input type="text" class="form-control" id="price" maxlength=8 placeholder="Product Price(Tamano maximo: 8 con 2 digitos decimales :numeros)"  name="rn_price" required>
					</div>
					<div class="col-sm-12">
						<label for="rn_ename">Enable</label>
                        <input type="radio" name="rn_enable" value="Y" checked="true">SI
                        <input type="radio" name="rn_enable" value="N">NO
					</div>
					<div class="col-sm-12">
						<button type="submit" class="btn btn-success" onclick="return validatePrice()">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
}
?>
