<?php

    defined('_JEXEC') or die('Restricted access');
    $doc=JFactory::getDocument();
    $doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');

    include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $rn_id=0;

    $rn_client_id=0;
    $rn_item_name="";
    $rn_item_desc="";
    $rn_rate=0;
    $rn_price=0;
   
    
    if(isset($_GET["searchGuest"]))
        $searchGuest=$_GET["searchGuest"];
    else
        $searchGuest="";
    if($DEBUG_STATUS)
    {
        echo 'searchGuest::'.$searchGuest.'<br>';    
    } 
    $pageTitle='SEAR';
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
                values ('".$_SERVER['REMOTE_ADDR']."','".$user_visit."','".$pageTitle.':'.$searchGuest."',now())";
    mysqli_query($dbcon,$sqlVisit);


    if(isset($_POST['submitted']) and isset($_POST['notificarEmail']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted notificarEmail<br>";
        }
        $sqlInsert = "insert into rn_notificar(description,email,created_on)
                      values('".$_GET["searchGuest"]."','".$_POST['notificarEmail']."',now())";

        //echo $sqlInsert;
        if(mysqli_query($dbcon,$sqlInsert))
        { 
          #$_SESSION['userName']=$userName; 
          //$messsage='Commnets updated successfully'; 
          ?>

          <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-success shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Thanks. We will notify you soon if we found any products related to your search.';
                    echo "</div>";
          ?>
          </div>
          <?php

        }
        else
        {
          ?>
              <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-danger shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Error while registering the details to notify. Please try later.';
                    echo "</div>";

              ?>
            </div>
            <?php
        }
    }

    $notificarEmail='';
    $sqlGetEmail = "select ru_email_id from rn_usuario where ru_userid='".(isset($_SESSION["userid"])?$_SESSION["userid"]:"")."'";
    //echo $sqlGetEmail.'<br>';
	$result = mysqli_query($dbcon,$sqlGetEmail);
	if(mysqli_num_rows($result) > 0)  
	{
		while($row = mysqli_fetch_assoc($result)) 
		{  
			$notificarEmail=$row["ru_email_id"];
		}
	}




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

    $searchArr = split(" ",$searchGuest);
    $x=0;
    $sqlQuery ="";
    while(sizeof($searchArr)>$x)
    {
    	if($x>0)
    	{
    		$sqlQuery = $sqlQuery ." union ";	
    	}
    	$sqlQuery = $sqlQuery ."(select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,
            (select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) item_rate,
            rc.rn_show_price,
            (select description from rn_category where id=ri.rn_item_category) rn_category, rn_item_category,
            case 
            when (DATE_FORMAT(now(),'%Y-%m-%d') <= DATE_FORMAT(rn_offer_end_dt,'%Y-%m-%d')) then rn_offer
            else ''
            end as rn_offer, rn_offer_start_dt, rn_offer_end_dt from rn_items ri, rn_clients rc,rn_category rct,rn_subcategory rsct
            where 
            ri.rn_client_id=rc.rn_client_id and ri.rn_item_category=rct.id and ri.rn_subcategory=rsct.id
            and ( ri.rn_item_name like '%".strtoupper($searchArr[$x])."%' or 
                  ri.rn_item_desc like '%".strtoupper($searchArr[$x])."%' or 
                  rc.rn_client_name like '%".strtoupper($searchArr[$x])."%' or
                  ri.rn_tags like '%".strtoupper($searchArr[$x])."%'or
                  rct.description like '%".strtoupper($searchArr[$x])."%'or
                  rsct.description like '%".strtoupper($searchArr[$x])."%') 
					) ";
		$x=$x+1;
    } 

    $sql = $sqlQuery." order by item_rate desc";

    /*(select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) item_rate,*/
     /*$sql = "select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,
     (select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) item_rate,
            rc.rn_show_price,
            rc.rn_category,
            rn_offer, rn_offer_start_dt, rn_offer_end_dt from rn_items ri, rn_clients rc,rn_category rct,rn_subcategory rsct 
            where ri.rn_client_id=rc.rn_client_id and ri.rn_item_category=rct.id and ri.rn_subcategory=rsct.id
            and ( ri.rn_item_name like '%".strtoupper($searchGuest)."%' or 
                  ri.rn_item_desc like '%".strtoupper($searchGuest)."%' or 
                  rc.rn_client_name like '%".strtoupper($searchGuest)."%' or
                  ri.rn_tags like '%".strtoupper($searchGuest)."%'or
                  rct.description like '%".strtoupper($searchGuest)."%'or
                  rsct.description like '%".strtoupper($searchGuest)."%')";*/
    
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


    /*$sql = "select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,
            (select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) item_rate,
            rc.rn_show_price,
            (select description from rn_category where id=ri.rn_item_category) rn_category, rn_item_category,
            rn_offer, rn_offer_start_dt, rn_offer_end_dt from rn_items ri, rn_clients rc,rn_category rct,rn_subcategory rsct
            where 
            ri.rn_client_id=rc.rn_client_id and ri.rn_item_category=rct.id and ri.rn_subcategory=rsct.id
            and ( ri.rn_item_name like '%".strtoupper($searchGuest)."%' or 
                  ri.rn_item_desc like '%".strtoupper($searchGuest)."%' or 
                  rc.rn_client_name like '%".strtoupper($searchGuest)."%' or
                  ri.rn_tags like '%".strtoupper($searchGuest)."%'or
                  rct.description like '%".strtoupper($searchGuest)."%'or
                  rsct.description like '%".strtoupper($searchGuest)."%')
            order by rc.rn_rate,ri.rn_rate desc";*/
    $sql = $sql." limit ".$current_page*$products_per_page.",".$products_per_page;  

    //echo $sql;
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
      <div class="add_button">          
      		<div class='alert alert-success shopAlert'>           
                <a href="#" class="close" data-dismiss="alert" aria-label="close"  title="Click to hide this message">&times;</a> 
                <p style="float:left;padding:0 15px;color:darkcyan;">Did you found your product - <strong><?php echo $_GET["searchGuest"];?></strong>. If not, let us help you notify through email.</p>          
          		<div class="row">
          			<form method="post" action=index.php?view=shop&amp;layout=searchGuestContainer&searchGuest=<?php echo rawurlencode($_GET["searchGuest"]);?>>
          				<input type="hidden" name="submitted" value="true" />
	  					<div class="col-sm-10">
	  						<?php 
	  							if(isset($notificarEmail) and strcmp($notificarEmail, "")!=0)
	  							{
	  						?>
	          						<input type="email" class="form-control" name="notificarEmail" placeholder="You are not registered with us. Please enter your email to notify" value="<?php echo $notificarEmail; ?>" readonly="true"  style="background:grey !important;color:white !important">
	          				<?php
	          					}
	          					else
	          					{
	          				?>
	          						<input type="email" class="form-control" name="notificarEmail" placeholder="You are not registered with us. Please enter your email to notify"  required>
	          				<?php
	          					}
	          				?>
	          			</div>
	          			<div class="col-sm-2">
	          				<button type="submit" class="btn btn-info loginSubmit">Notify Me</button>
	          			</div>
	          		</form>
          		</div>
			</div>      
      </div>
    </div>
  </div>
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
          <a href=index.php?view=shop&layout=searchGuestContainer&pagecount=0&searchGuest=<?php echo rawurlencode($_GET["searchGuest"]);?> style="float:left;padding:0 15px;">First</a>
        <?php }
        else { ?>
        <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">First</a>
        <?php }
        if($current_page>0) { ?>
        <a href=index.php?view=shop&layout=searchGuestContainer&pagecount=<?php echo $current_page-1; ?>&searchGuest=<?php echo rawurlencode($_GET["searchGuest"]);?> style="float:left;padding:0 15px;">Prev</a>
        <?php } 
        else { ?>
        <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Prev</a>
        <?php }
        if($current_page<$last_page) { ?>
        <a href=index.php?view=shop&layout=searchGuestContainer&pagecount=<?php echo $current_page+1; ?>&searchGuest=<?php echo rawurlencode($_GET["searchGuest"]);?> style="float:left;padding:0 15px;">Next</a>
        <?php } 
        else { ?>
        <a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Next</a>
        <?php }
        if($current_page<$last_page) { ?>
        <a href=index.php?view=shop&layout=searchGuestContainer&pagecount=<?php echo $last_page; ?>&searchGuest=<?php echo rawurlencode($_GET["searchGuest"]);?> style="float:left;padding:0 15px;">Last</a>
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
        