<?php
  defined('__JEXEC') or ('Access denied');
  $dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db
  #$dbcon = mysqli_connect('localhost','hussain1_shop534','shop534','hussain1_homeshop') or die('Error:DB Connect error.');//IP,user,pwd,db
  $products_per_page=4;
  $most_view_limit=6;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <jdoc:include type="head" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/js/myjs.js" ></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  


  <script>

    function getLocation() 
    {
        //alert("Get Location");
        if (navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } 
        else 
        { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) 
    {
        //alert("HI");
        //alert("Set Location:LAT:"+position.coords.latitude);
        //alert("Set Location:LON:"+position.coords.longitude);
        document.getElementById('rn_latitude').value = position.coords.latitude;
        document.getElementById('rn_longitude').value = position.coords.longitude;
        //alert("HI-1");
        lat = position.coords.latitude;
        lon = position.coords.longitude;
        latlon = new google.maps.LatLng(lat, lon)
        //alert("HI-2");
        mapholder = document.getElementById('mapholder')
        mapholder.style.height = '250px';
        mapholder.style.width = '100%';
        //alert("HI-3");
        var myOptions = {
        center:latlon,zoom:14,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        mapTypeControl:false,
        navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
        }
        //alert("HI-4");
        var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
        var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
        //alert("HI-5");
    }

    function showError(error) 
    {
        switch(error.code) 
        {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }

    

    
    </script>



  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      padding-bottom: 5px;
    }

    a{
      text-decoration: none !important;
    }
    /*.navbar-inverse 
    {
      background-color: white;
      border-color: transparent;
    }*/
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }

    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

  </style>
</head>
<body>



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" title="Click to view home page"><img src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/images/logo03.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <!-- <ul class="nav navbar-nav">
        <li>
          <div class="inner-addon left-addon" style="margin-bottom:5px">
            <span class="glyphicon glyphicon-search"></span>
            <input type="text" class="form-control" id="email" placeholder="Search Here">
            <button type="button" class="btn btn-info">Go</button>
          </div>
        </li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#" id="login-btn"><span class="glyphicon glyphicon-user"></span> LOGIN</a></li>
        <li><a href="#" id="register-btn"><span class="glyphicon glyphicon-edit"></span> SIGN UP</a></li> -->
        <!-- <li title="Click to view all offers"><a href="index.php?view=shop&amp;layout=offers" class="link01 plans"><span class='glyphicon glyphicon-tags'></span> OFFERS</a></li> -->
          <!-- <?php
            $sqlcounter = "select count(distinct(ip)) visit_counter from rn_visits";
            $result = mysqli_query($dbcon,$sqlcounter);
            if(mysqli_num_rows($result) > 0)  
            {
              if($row = mysqli_fetch_assoc($result)) 
              {
                ?>              
                  <li title="Click to view the most visited pages"><a href="#" class="link01"><span class='glyphicon glyphicon-eye-open'></span> VISITORS <span class="badge"><?php echo $row["visit_counter"];?> </span></a></li>
                <?php
              }
            }
          ?>   -->        
          <!-- <li title="Click to contact with us or send your feedback"><a href="index.php?view=shop&amp;layout=contactus" class="link01 plans"><span class='glyphicon glyphicon-envelope'></span> CONTACT US</a></li> -->
        <?php
        if(isset($_SESSION['userid']))
        {
            
          echo "<li title='Click to view your profile'><a href='#'><span class='glyphicon glyphicon-user'></span> WELCOME ".$_SESSION['userName']."</a></li>";
          echo "<li title='Click to close your session'><a href='index.php?view=shop&amp;layout=userLogout&tipo=1'><span class='glyphicon glyphicon-log-out'></span> LOGOUT</a></li>";
        }
        else
        {
            echo "<li  title='Click to enter the portal and gain lots of benefits'><a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a></li>";
            echo "<li title='Click to register yourself with our portal and get lot of information'><a href='index.php?view=shop&amp;layout=registerForm'><span class='glyphicon glyphicon-edit'></span> SIGN UP</a></li>";
        }
        ?>
        
      </ul>
    </div>
  </div>
</nav>


<jdoc:include type="component" />

<footer class="container-fluid text-center">

  <div class="row">
    <?php    
        $sqlCategory="select ri.rn_id,ri.rn_item_name,count(page_id) counter from rn_visits rv, rn_items ri where substring(rv.page_id,6)=ri.rn_id and page_id like 'ITEM:%' group by rn_id order by count(page_id) desc limit 0,".$most_view_limit;
    ?>
      <div class="col-sm-12 mostViewedCategory">      
          <span style="color:#337ab7">MOST VIEWED PRODUCTS: </span>
            <?php
                $resultCat = mysqli_query($dbcon,$sqlCategory);
                if(mysqli_num_rows($resultCat) > 0)  
                {
                    while($row = mysqli_fetch_assoc($resultCat))
                    {
                      ?>
                          <a class="list-child" href=index.php?view=shop&layout=itemcontainer&itemId=<?php echo $row["rn_id"];?> title="Click to view all products of this sub category"><p><?php echo $row["rn_item_name"];?> </p></a><span style="color:#337ab7;padding:0 0 0 15px;">|</span>
                        <?php
                    }
                }
        ?>
          
       </div> 
    </div>
    <!-- <div class="row">
    <?php    
        $sqlCategory="select rc.id,rc.Description,count(page_id) counter from rn_visits rv, rn_category rc where substring(rv.page_id,6)=rc.id and page_id like 'CATE:%' group by rc.id order by count(page_id) desc limit 0,".$most_view_limit;
    ?>
      <div class="col-sm-12 mostViewedCategory">      
          <span style="color:#337ab7">MOST VIEWED CATEGORIES: </span>
            <?php
                $resultCat = mysqli_query($dbcon,$sqlCategory);
                if(mysqli_num_rows($resultCat) > 0)  
                {
                    while($row = mysqli_fetch_assoc($resultCat))
                    {
                      ?>
                          <a class="list-child" href=index.php?view=shop&layout=categorycontainer&pagecount=0&category=<?php echo $row["id"];?> title="Click to view all products of this sub category"><p><?php echo $row["Description"];?> </p></a><span style="color:#337ab7;padding:0 0 0 15px;">|</span>
                        <?php
                    }
                }
        ?>
          
       </div> 
    </div> -->
    <div class="row">
    <?php    
        $sqlCategory="select rc.rn_client_id,rc.rn_client_name,count(page_id) counter from rn_visits rv, rn_clients rc where substring(rv.page_id,6)=rc.rn_client_id and page_id like 'CLIE:%' group by rn_client_id order by count(page_id) desc limit 0,".$most_view_limit;
    ?>
      <div class="col-sm-12 mostViewedCategory">      
          <span style="color:#337ab7">MOST VIEWED CLIENTS: </span>
            <?php
                $resultCat = mysqli_query($dbcon,$sqlCategory);
                if(mysqli_num_rows($resultCat) > 0)  
                {
                    while($row = mysqli_fetch_assoc($resultCat))
                    {
                      ?>
                          <a class="list-child" href=index.php?view=shop&layout=clientcontainer&pagecount=0&clientId=<?php echo $row["rn_client_id"];?> title="Click to view all products of this client"><p><?php echo $row["rn_client_name"];?> </p></a><span style="color:#337ab7;padding:0 0 0 15px;">|</span>
                        <?php
                    }
                }
        ?>
          
       </div> 
    </div>
  <div class="row">
    <?php
      
        $sqlCategory="select  rc.id cat_id,rc.description cat_name,rs.id subcat_id,rs.Description subcat_name
                    from rn_category rc, rn_subcategory rs where 
                    rc.id=rs.id_category and (rc.id,rs.id) in
                    (select distinct ri.rn_item_category,ri.rn_subcategory from rn_items ri)
                    order by rc.Description,rs.Description";
    ?>
      

      <div class="col-sm-12 filter-panel">
      <div class="row">
        <ul>
          <?php
              $resultCat = mysqli_query($dbcon,$sqlCategory);
              $cat_prev="NA";
              if(mysqli_num_rows($resultCat) > 0)  
              {
                 /* while($row = mysqli_fetch_assoc($resultCat))
                  {
                if($row["cat_id"]!=$cat_prev)
                {
                  $cat_prev=$row["cat_id"];
          ?> 

                  <br>
                  </div>
                  <div class="col-sm-2 category-01">
                      <a class="category-list list-parent" href=index.php?view=shop&layout=categorycontainer&pagecount=0&category=<?php echo $row["cat_id"];?>  title="Click to view all products of this category"><p><b><?php echo strtoupper($row["cat_name"]);?></b></p></a>
                      <a class="category-list list-child" href=index.php?view=shop&layout=searchguestcontainer&pagecount=0&searchGuest=<?php echo $row["subcat_name"];?> title="Click to view all products of this sub category"><p><?php echo $row["subcat_name"];?></p></a>
          <?php
                      }
                      else
                      {
            ?>
                          <a class="category-list list-child" href=index.php?view=shop&layout=searchguestcontainer&pagecount=0&searchGuest=<?php echo $row["subcat_name"];?> title="Click to view all products of this sub category"><p><?php echo $row["subcat_name"];?></p></a>
            <?php 
                }
                  }*/
              }
            ?>
        </ul>
      </div>
    </div>
    <!-- <div class="col-sm-12">
      <div class="col-sm-12 hideme">
        <p id="hideme"><span class="glyphicon glyphicon-menu-down" title="Click to open/close rapid search panel"></span></p>
      </div>
      </div> -->
     
  </div>




  <p>MERAKI MINDS CIA LTDA &copy;2015. All rights reserved.</p>  
  <form class="form-inline" method="post" action="index.php?view=shop&layout=subscribe" enctype="multipart/form-data">
    <input type="email" class="form-control" size="50" placeholder="Register your email to recieve deals and offer information" name="subscriber_email">
    <button type="submit" class="btn btn-info">Subscribe</button>
  </form>
  <br>
  <a href="index.php?view=shop&amp;layout=terms" class="link01" style="color:#5bc0de;font-size:11px;">READ OUR TERMS OF USE</a>
</footer>

</body>
</html>
