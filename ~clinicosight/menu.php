<div id="topbar">
  <div class="wrapper">
    <div id="topnav">
      <ul>
        <li <?php if($menu== 0) { echo  "class='active'"; } ?>><a href="index.php">Home</a></li>
        <li <?php if($menu== 1) { echo  "class='active'"; } ?>><a href="appointment.php">Appointment</a></li>
        <li><a href="full-width.html">Full Width</a></li>
        <li><a href="#">DropDown</a>
          <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
        </li>
        <li class="last"><a href="#">A Long Link Text</a></li>
      </ul>
    </div>
    <div id="search">
      <form action="#" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" value="Search Our Website&hellip;"  onfocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>