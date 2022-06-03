<?php

defined('_JEXEC') or die('Restricted access');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
$dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db

?>
<div class="container-fluid" style="margin:10px 0 10px">
  <div class="row">
    <div class="col-sm-12">
          <div class="inner-addon left-addon" style="margin-bottom:5px">
            <form method="post" action="index.php?view=shop&amp;layout=searchGuest">
              <span class="glyphicon glyphicon-search"></span>
              <input type="text" class="form-control" id="email" name="searchGuestParam" placeholder="Let me help you search what you are looking today">
              <button type="submit" class="btn btn-info">Go</button>
            </form>
          </div>
       
    </div>
  </div>
</div>

<div class="container-fluid category" style="margin:0">
  <div class="row">
    <div class="col-sm-2 promain elec"><a href="index.php?view=shop&layout=categoryContainer&pagecount=0&category=1">ELECTRONICS</a></div>
    <div class="col-sm-2 promain watc"><a href="index.php?view=shop&layout=categoryContainer&pagecount=0&category=4">WATCHES</a></div>
    <div class="col-sm-2 promain shoe"><a href="index.php?view=shop&layout=categoryContainer&pagecount=0&category=5">SHOES</a></div>
    <div class="col-sm-2 promain clot"><a href="index.php?view=shop&layout=categoryContainer&pagecount=0&category=7">CLOTHES</a></div>
    <div class="col-sm-2 promain movi"><a href="index.php?view=shop&layout=categoryContainer&pagecount=0&category=6">MOVIES</a></div>
    <div class="col-sm-2 promain furn"><a href="index.php?view=shop&layout=categoryContainer&pagecount=0&category=2">FURNITURES</a></div>
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



