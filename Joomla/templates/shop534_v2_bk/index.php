<?php
  defined('__JEXEC') or ('Access denied');
  $dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db
  $products_per_page=4;

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

  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
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
      <a class="navbar-brand" href="#"><img src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/images/logo03.png"></a>
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
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-edit"></span> Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid" style="margin:0">
  <div class="row">
    <div class="col-sm-2 promain elec"><a href="#">ELECTRONICS</a></div>
    <div class="col-sm-2 promain watc"><a href="#">WATCHES</a></div>
    <div class="col-sm-2 promain shoe"><a href="#">SHOES</a></div>
    <div class="col-sm-2 promain clot"><a href="#">CLOTHES</a></div>
    <div class="col-sm-2 promain movi"><a href="#">MOVIES</a></div>
    <div class="col-sm-2 promain furn"><a href="#">FURNITURES</a></div>
  </div>
</div>
<!-- <div class="container-fluid" style="margin:0 0 10px">
  <div class="row">
    <div class="col-sm-2"><a href="#">FLOWERS</a></div>
    <div class="col-sm-2"><a href="#">CAKES</a></div>
    <div class="col-sm-2"><a href="#">GIFTS</a></div>
    <div class="col-sm-2"><a href="#">AUTOMOBILES</a></div>
    <div class="col-sm-2"><a href="#">EVENTS</a></div>
    <div class="col-sm-2"><a href="#">SERVICES</a></div>
  </div>
</div> -->

<div class="container-fluid Electronics" style="margin:0 5px">
  <div class="row">
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">COMPUTERS</a>
          <div class="sublist">
            <ul>
              <li><a href="#">HP</a></li>
              <li><a href="#">DELL</a></li>
              <li><a href="#">SAMSUNG</a></li>
              <li><a href="#">LG</a></li>
              <li><a href="#">LENEVO</a></li>
              <li><a href="#">APPLE</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">LAPTOPS</a>
          <div class="sublist">
            <ul>
              <li><a href="#">HP</a></li>
              <li><a href="#">DELL</a></li>
              <li><a href="#">SAMSUNG</a></li>
              <li><a href="#">LG</a></li>
              <li><a href="#">LENEVO</a></li>
              <li><a href="#">APPLE</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">SMART PHONES</a>
          <div class="sublist">
            <ul>
              <li><a href="#">HTC</a></li>
              <li><a href="#">SAMSUNG</a></li>
              <li><a href="#">LG</a></li>
              <li><a href="#">APPLE</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">TELEVISIONS</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SAMSUNG</a></li>
              <li><a href="#">LG</a></li>
              <li><a href="#">SONY</a></li>
              <li><a href="#">APPLE</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">REFREGIRATORS</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SAMSUNG</a></li>
              <li><a href="#">LG</a></li>
              <li><a href="#">ELECTROLUX</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">MICROWAVE</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SAMSUNG</a></li>
              <li><a href="#">LG</a></li>
              <li><a href="#">ELECTROLUX</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 hideme">
        <!-- <img src="images/hideme.png" id="hideme"> -->
        <p id="hideme"></p>
    </div>
  </div>
</div>
<div class="container-fluid Watches" style="margin:0 5px">
  <div class="row">
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">CEIKO</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">GOLD PLATED</a></li>
              <li><a href="#">SILVER PLATED</a></li>
              <li><a href="#">WITH DIOMOND STONES</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">TITAN</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">GOLD PLATED</a></li>
              <li><a href="#">SILVER PLATED</a></li>
              <li><a href="#">WITH DIOMOND STONES</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">ROLEX</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">GOLD PLATED</a></li>
              <li><a href="#">SILVER PLATED</a></li>
              <li><a href="#">WITH DIOMOND STONES</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">DEISEL</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">GOLD PLATED</a></li>
              <li><a href="#">SILVER PLATED</a></li>
              <li><a href="#">WITH DIOMOND STONES</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 hideme">
        <!-- <img src="images/hideme.png" id="hideme"> -->
        <p id="hideme"></p>
    </div>
  </div>
</div>
<div class="container-fluid Shoes" style="margin:0 5px">
  <div class="row">
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">ADIDAS</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">RUNNING</a></li>
              <li><a href="#">MEN</a></li>
              <li><a href="#">WOMEN</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">NIKE</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">RUNNING</a></li>
              <li><a href="#">MEN</a></li>
              <li><a href="#">WOMEN</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">BATA</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">RUNNING</a></li>
              <li><a href="#">MEN</a></li>
              <li><a href="#">WOMEN</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">EXPLORER</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SPORTS</a></li>
              <li><a href="#">RUNNING</a></li>
              <li><a href="#">MEN</a></li>
              <li><a href="#">WOMEN</a></li>
              <li><a href="#">MOUNTAIN CLIMBING</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 hideme">
        <!-- <img src="images/hideme.png" id="hideme"> -->
        <p id="hideme"></p>
    </div>
  </div>
</div>
<div class="container-fluid Clothes" style="margin:0 5px">
  <div class="row">
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">LEVIS</a>
          <div class="sublist">
            <ul>
              <li><a href="#">T-SHIRTS</a></li>
              <li><a href="#">JEANS</a></li>
              <li><a href="#">SHIRTS</a></li>
              <li><a href="#">CAPS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">AMERICANINO</a>
          <div class="sublist">
            <ul>
              <li><a href="#">T-SHIRTS</a></li>
              <li><a href="#">JEANS</a></li>
              <li><a href="#">SHIRTS</a></li>
              <li><a href="#">CAPS</a></li>
              <li><a href="#">JACKETS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">PEPE</a>
          <div class="sublist">
            <ul>
              <li><a href="#">T-SHIRTS</a></li>
              <li><a href="#">JEANS</a></li>
              <li><a href="#">SHIRTS</a></li>
              <li><a href="#">CAPS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">PINTO</a>
          <div class="sublist">
            <ul>
              <li><a href="#">T-SHIRTS</a></li>
              <li><a href="#">JEANS</a></li>
              <li><a href="#">SHIRTS</a></li>
              <li><a href="#">CAPS</a></li>
              <li><a href="#">SWEATERS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">UMO VENETTO</a>
          <div class="sublist">
            <ul>
              <li><a href="#">T-SHIRTS</a></li>
              <li><a href="#">JEANS</a></li>
              <li><a href="#">SHIRTS</a></li>
              <li><a href="#">CAPS</a></li>
              <li><a href="#">TIES</a></li>
              <li><a href="#">BELTS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">TOMMY HILFIGER</a>
          <div class="sublist">
            <ul>
              <li><a href="#">T-SHIRTS</a></li>
              <li><a href="#">JEANS</a></li>
              <li><a href="#">SHIRTS</a></li>
              <li><a href="#">CAPS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 hideme">
        <!-- <img src="images/hideme.png" id="hideme"> -->
        <p id="hideme"></p>
    </div>
  </div>
</div>
<div class="container-fluid Movies" style="margin:0 5px">
  <div class="row">
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">ACTION</a>
          <div class="sublist">
            <ul>
              <li><a href="#">MISSION IMPOSIBLE 1-5</a></li>
              <li><a href="#">DIE HARD 1-3</a></li>
              <li><a href="#">JAMES BOND 1-6</a></li>
              <li><a href="#">JACKIE CHAN MOVIES</a></li>
              <li><a href="#">JET LI MOVIES</a></li>
              <li><a href="#">SALT</a></li>
              <li><a href="#">WANTED</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">ADVENTURE</a>
          <div class="sublist">
            <ul>
              <li><a href="#">PIRATES OF CARRIBEAN 1-4</a></li>
              <li><a href="#">ALICE IN WONDERLAND</a></li>
              <li><a href="#">NATIONAL TREASURE 1-2</a></li>
              <li><a href="#">INDIANA JONES 1-6</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">ROMANCE</a>
          <div class="sublist">
            <ul>
              <li><a href="#">PS I LOVE YOU</a></li>
              <li><a href="#">IF ONLY</a></li>
              <li><a href="#">NOTEBOOK</a></li>
              <li><a href="#">AUSTRALIA</a></li>
              <li><a href="#">JUST MARRIED</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">THRILLER</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SEVEN</a></li>
              <li><a href="#">LOST</a></li>
              <li><a href="#">BURRIED</a></li>
              <li><a href="#">VOLVARINE</a></li>
              <li><a href="#">PELHAM 123</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">DRAMA</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SCHINDELERS LIST</a></li>
              <li><a href="#">ELI-BOOK OF LIES</a></li>
              <li><a href="#">DEVELS ADVOCATE</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">COMEDY</a>
          <div class="sublist">
            <ul>
              <li><a href="#">CRAZY FOR MARY</a></li>
              <li><a href="#">ME AND MARLEY</a></li>
              <li><a href="#">BABYS DAY OUT</a></li>
              <li><a href="#">HOME ALONE 1-4</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 hideme">
        <!-- <img src="images/hideme.png" id="hideme"> -->
        <p id="hideme"></p>
    </div>
  </div>
</div>
<div class="container-fluid Furnitures" style="margin:0 5px">
  <div class="row">
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">DRAWING ROOM</a>
          <div class="sublist">
            <ul>
              <li><a href="#">SOFA</a></li>
              <li><a href="#">TV STAND</a></li>
              <li><a href="#">CUP BOARDS</a></li>
              <li><a href="#">CHAIRS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-sm-2 prochild">
      <ul>
        <li>
          <a href="#">BEDROOM</a>
          <div class="sublist">
            <ul>
              <li><a href="#">BED 4*2</a></li>
              <li><a href="#">MASTER BED</a></li>
              <li><a href="#">DRESSING TABLE</a></li>
              <li><a href="#">ALMIRAS</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 hideme">
        <!-- <img src="images/hideme.png" id="hideme"> -->
        <p id="hideme"></p>
    </div>
  </div>
</div>

<jdoc:include type="component" />

<footer class="container-fluid text-center">
  <p>MERAKI MINDS CIA LTDA &copy;2015. All rights reserved.</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-info">Sign Up</button>
  </form>
</footer>

</body>
</html>
