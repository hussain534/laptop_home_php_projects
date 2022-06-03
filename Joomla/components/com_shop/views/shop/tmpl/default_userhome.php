<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

    $err_code=0;

    if(!isset($_SESSION["userid"]))
    {   
        if($DEBUG_STATUS)
        {
            echo "Invalid session<br>";    
        }
        
        $err_code=1;
        $messsage= "Invalid credentials or you are accessing this page directly. Try with correct login details.";
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
    }
    if($DEBUG_STATUS)
    {
        echo 'Error code:'.$err_code.'<br>';
    }

    

    $pageTitle='USER';
    //include_once('default_template.php');

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
            echo $_SESSION["session_msg"];
            unset($_SESSION["session_msg"]);
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
            <a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a>
        </div>
        </div>
    </div>
</div>
        <?php
        }
        if ($err_code==0)
        {
        ?>
        </div>
    </div>
</div>
    <?php
        if ($err_code==0 and $_SESSION['userRole']==2)
        {
	    ?>  
        <div class="container">  
            <div class="row">
                <div class="col-sm-12">
        	        <div class="header">	    
        			    <div class="alert loginRegister">
        			        <ul>
        			        	<li class="userMenu-active"><a href='index.php?view=shop&amp;layout=userhome' class="userMenu-link-active"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
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
        else if ($err_code==0 and $_SESSION['userRole']==3)
        {
        ?>    
	     <div class="container">  
            <div class="row">
                <div class="col-sm-12">
                    <div class="header">        
                        <div class="alert loginRegister">
        			        <ul>
        			        	<!-- <li class="userMenu-active"><a href="index.php?view=shop&layout=userHome"  class="userMenu-link-active"><span class='glyphicon glyphicon-home'></span> Home</a></li> -->
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

    <?php

    //$sql="select distinct rn.rn_category from rn_clients rn order by rn.rn_category";
    $sql="select rn.id,rn.description rn_category from rn_category rn order by rn.id,rn.description";
    $resultCat = mysqli_query($dbcon,$sql);
    if(mysqli_num_rows($resultCat) > 0)  
    {
        while($row = mysqli_fetch_assoc($resultCat))
        {
            $viewMoreCategory = $row["id"];
            ?>


            <div class="container"> 
                <div class="row">
                    <div class="col-sm-12">          
                          <p class="sectionHeader"><?php echo strtoupper($row["rn_category"]); ?></p>       
                    </div>
                </div>   
                <div class="row">

                <?php 
                /*$sql="select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,ri.rn_rate item_rate,
                        rc.rn_show_price,(select description from rn_categories where id=ri.rn_item_category) rn_category,  
                        rn_offer, rn_offer_start_dt, rn_offer_end_dt
                        from rn_items ri, rn_clients rc where ri.rn_client_id=rc.rn_client_id 
                        and rc.rn_category='".$row["rn_category"]."'
                        order by rc.rn_rate,ri.rn_rate desc limit 0,".$products_per_page;*/

                $sql="select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,ri.rn_stock_qty,ri.rn_delivery_time,
                        (select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) item_rate,
                        rc.rn_show_price,(select description from rn_category where id=ri.rn_item_category) rn_category,rn_item_category,  
                        case 
                        when (DATE_FORMAT(now(),'%Y-%m-%d') <= DATE_FORMAT(rn_offer_end_dt,'%Y-%m-%d')) then rn_offer
                        else ''
                        end as rn_offer, rn_offer_start_dt, rn_offer_end_dt
                        from rn_items ri, rn_clients rc where ri.rn_client_id=rc.rn_client_id 
                        and ri.rn_item_category='".$row["id"]."'
                        order by item_rate desc limit 0,".$products_per_page;

                $result = mysqli_query($dbcon,$sql);
                $i=0;
                $j=0;
                if(mysqli_num_rows($result) > 0)  
                {

                    while($row = mysqli_fetch_assoc($result)) 
                    {  
                        $i=$i+1;
                        $j=$j+1;  
                        ?>

                        <div class="col-sm-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="container-item-name"><a href=index.php?view=shop&layout=itemcontainer&itemId=<?php echo $row["rn_id"];?> style="color:white;"><?php echo $row["rn_item_name"];?></a></p>
                                    
                                    <?php 
                                    if(strcmp($row["rn_offer"], ""))
                                    {
                                        echo "<div class='offer' title='".$row['rn_offer']."'>
                                            <div class='offerInside'>
                                                <div class='offerHeading'>OFERTA</div>    
                                            </div>
                                        </div>";
                                    }
                                    else
                                      echo "<div class='emptyoffer'></div>";
                                    ?>
                                </div>
                                <div class="panel-body">
                                    <a href=index.php?view=shop&layout=itemcontainer&itemId=<?php echo $row["rn_id"];?> style="color:white;">
                                        <?php 
                                            if(file_exists('media/com_shop/images/clients/'.$row["rn_client_id"].'/'.$row["rn_client_id"].'-'.$row["rn_id"].'.jpg'))
                                            {
                                          ?>
                                        <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $row["rn_client_id"];?>/<?php echo $row["rn_client_id"].'-'.$row["rn_id"].'.jpg';?> style="width:100%">
                                        <?php
                                        }
                                        else
                                        {
                                      ?>
                                      <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/unknown_user.png id="uploadImg" class="profileImage"/>
                                      <?php
                                        }
                                      ?>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    <p class="container-item-price"><b>PRICE(With IVA):</b> $ <?php echo $row["rn_price"];?></p>                        
                                      <p class="container-item-price"><b>IN STOCK:</b> <?php echo $row["rn_stock_qty"];?></p>
                                      <p class="container-item-price"><b>DELIVERY TIME(Days):</b> <?php echo $row["rn_delivery_time"];?></p>                    
                                    <p class="container-item-rating">
                                        <?php 
                                            $rating_value =$row["item_rate"];
                                            $rating_star_def=0.5;
                                            $rating_inicial = 0;                            
                                        while($rating_value > ($rating_star_def*$rating_inicial))
                                        {
                                            if($rating_inicial%2==0)
                                                echo "<img src='".JURI::root()."media/com_shop/images/star_left_fill.png' />";
                                            else
                                                echo "<img src='".JURI::root()."media/com_shop/images/star_right_fill.png' />";
                                            $rating_inicial = $rating_inicial+1;
                                        }
                                        while($rating_inicial<10)
                                        {
                                            if($rating_inicial%2==0)
                                                echo "<img src='".JURI::root()."media/com_shop/images/star_left_empty.png' />";
                                            else
                                                echo "<img src='".JURI::root()."media/com_shop/images/star_right_empty.png' />";
                                            $rating_inicial = $rating_inicial+1;  
                                        } 
                                        ?>
                                    </p>
                                    <p class="container-item-clientName"><a href=index.php?view=shop&layout=clientcontainer&pagecount=0&clientId=<?php echo $row["rn_client_id"];?>><?php echo $row["rn_client_name"];?></a></p>
                                    <p class="container-item-category"><a href=index.php?view=shop&layout=categorycontainer&pagecount=0&category=<?php echo $row["rn_item_category"];?>><?php echo $row["rn_category"];?></p>
                                    <p class="container-item-details"><a href=index.php?view=shop&layout=itemcontainer&itemId=<?php echo $row["rn_id"];?>>View Details</a></p> 
                                </div>
                            </div>
                        </div>
                        <?php
                        if($i%4==0)
                        {
                            ?>
                                </div>
                            </div>
                            <div class="container">    
                                <div class="row">
                            <?php
                        }
                    }
                }
                    ?>
            </div>
                <div class="row">
                    <div class="col-sm-12">          
                        <?php
                            if($j>=4)
                            {
                        ?>       
                        <p class="viewMore"><a href=index.php?view=shop&layout=categorycontainer&pagecount=0&category=<?php echo $viewMoreCategory;?>><button type="button" class="btn btn-success btn-success_style">Click to view more</button></a></p>
                            <?php
                            }
                            else
                            {
                                ?>       
                                <p class="viewMore"><button type="button" class="btn btn-warning">No products available</button></a></p>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div><br>
            <?php
            
        }
    
    }
?>
<?php
        
}
?>  
