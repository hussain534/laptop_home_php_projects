<?php

    defined('_JEXEC') or die('Restricted access');
    $doc=JFactory::getDocument();
    $doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');

    include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $pageTitle='CLIE';
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

    $rn_id=0;
    $rn_client_id=0;
    $rn_item_name="";
    $rn_item_desc="";
    $rn_rate=0;
    $rn_price=0;
   

    if(isset($_GET["clientId"]))
        $clientId=$_GET["clientId"];
    else
        $clientId=0;
    if($DEBUG_STATUS)
    {
        echo 'Client Id::'.$clientId.'<br>';    
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
                values ('".$_SERVER['REMOTE_ADDR']."','".$user_visit."','".$pageTitle.':'.$clientId."',now())";
    mysqli_query($dbcon,$sqlVisit);

    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;
    if($DEBUG_STATUS)
    {
        echo 'Current Page::'.$current_page.'<br>';    
    }
 
    $total_count=0;

    $first_page=0;
    $last_page=0;
    $prev_page_count=0;
    $next_page_count=0;
    
    if($DEBUG_STATUS)
    {
        echo 'Current page no::'.$current_page.'<br>';    
    }        
    $sql = "SELECT rn_id, rn_client_id, rn_item_name, rn_item_desc, rn_rate, rn_price, rn_approved_by, rn_is_approved,
            rn_created_on, rn_modified_on, rn_created_by, rn_modified_by, rn_enable, rn_lang_id
            FROM RN_ITEMS WHERE rn_client_id=".$clientId;
   
    if($result = mysqli_query($dbcon,$sql))
    {
        $total_count=mysqli_num_rows($result);                
    }
    else
        $total_count=0;
    
    $products_per_page=4;
    $total_pages=ceil($total_count/$products_per_page);
    $last_page = $total_pages-1;
    if($DEBUG_STATUS)
    {
        echo 'total_count::'.$total_count.'<br>';
        echo 'total_pages::'.$total_pages.'<br>';
        echo 'first_page::'.$first_page.'<br>';
        echo 'last_page::'.$last_page.'<br>';    
    }       


    $sql = "select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,
            (select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) item_rate,
            rc.rn_show_price,
            (select description from rn_category where id=ri.rn_item_category) rn_category, rn_item_category,
            case 
            when (DATE_FORMAT(now(),'%Y-%m-%d') <= DATE_FORMAT(rn_offer_end_dt,'%Y-%m-%d')) then rn_offer
            else ''
            end as rn_offer, rn_offer_start_dt, rn_offer_end_dt from rn_items ri, rn_clients rc 
            WHERE rc.rn_client_id=".$clientId." and ri.rn_client_id=rc.rn_client_id 
            order by rc.rn_rate,ri.rn_rate desc
            limit ".$current_page*$products_per_page.",".$products_per_page; 
    include_once('default_guestMainFilterPanel2.php'); 

?>

<?php
      if (isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
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
        else if (isset($_SESSION['userRole']) and $_SESSION['userRole']==3)
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


<div class="container">            
  <div class="row">
    <div class="col-sm-12">
      <div class="add_button" style="width:90%;">
          <p style="float:left;padding:0 15px;color:darkcyan;"><?php echo 'Showing('.($current_page+1).'/'.$total_pages.')';?></p>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="navi" style="width:90%;">
          <?php 
          if($current_page>0) { ?>
          <a href=index.php?view=shop&layout=clientContainer&pagecount=0&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">First</a>
          <?php }
          else { ?>
          <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">First</a>
          <?php }
          if($current_page>0) { ?>
          <a href=index.php?view=shop&layout=clientContainer&pagecount=<?php echo $current_page-1; ?>&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">Prev</a>
          <?php } 
          else { ?>
          <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Prev</a>
          <?php }
          if($current_page<$last_page) { ?>
          <a href=index.php?view=shop&layout=clientContainer&pagecount=<?php echo $current_page+1; ?>&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">Next</a>
          <?php } 
          else { ?>
          <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Next</a>
          <?php }
          if($current_page<$last_page) { ?>
          <a href=index.php?view=shop&layout=clientContainer&pagecount=<?php echo $last_page; ?>&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">Last</a>
          <?php } 
          else { ?>
          <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Last</a>
          <?php }
          
          ?>
      </div>
    </div>
  </div>
</div>
        <div class="container"> 
           
          <div class="row">

          <?php 
     
            $result = mysqli_query($dbcon,$sql);
            $i=0;
            if(mysqli_num_rows($result) > 0)  
            {

              while($row = mysqli_fetch_assoc($result)) 
              {  
                $i=$i+1;  
                ?>

                <div class="col-sm-3">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="container-item-name" title="Click to view this product details"><a href=index.php?view=shop&layout=itemContainer&itemId=<?php echo $row["rn_id"];?> style="color:white;"><?php echo $row["rn_item_name"];?></a></p>
                        
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
                    <div class="panel-body" title="Click to view this product details">
                      <a href=index.php?view=shop&layout=itemContainer&itemId=<?php echo $row["rn_id"];?> style="color:white;">
                      <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $row["rn_client_id"];?>/<?php echo $row["rn_client_id"].'-'.$row["rn_id"].'.jpg';?> style="width:100%">
                      </a>
                    </div>
                    <div class="panel-footer">
                      <p class="container-item-price">$ <?php echo $row["rn_price"];?></p>                        
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
                        <p class="container-item-clientName" title="Click to view all products from this client"><a href=index.php?view=shop&layout=clientContainer&pagecount=0&clientId=<?php echo $row["rn_client_id"];?>><?php echo $row["rn_client_name"];?></a></p>
                        <p class="container-item-category" title="Click to view all products of this category"><a href=index.php?view=shop&layout=categoryContainer&pagecount=0&category=<?php echo $row["rn_item_category"];?>><?php echo $row["rn_category"];?></p>
                        <p class="container-item-details" title="Click to view this product details"><a href=index.php?view=shop&layout=itemContainer&itemId=<?php echo $row["rn_id"];?>>View Details</a></p> 
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
        </div><br>
        