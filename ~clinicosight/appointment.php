<?php 
session_start();
$menu= 1;
include("header.php");
include("dbconnection.php");
if(isset($_GET["docid"]))
{
	$_SESSION["appdocid"] = $_GET["docid"]; 
	$_SESSION["appdocname"] = $_GET["docname"];
	$_SESSION["appdocsptype"] = $_GET["sptype"];
	header("Location: makeappoint.php");
}

?>
<!-- ####################################################################################################### -->
<?php include("menu.php"); ?>
<!-- ####################################################################################################### -->
<div id="breadcrumb">
  <div class="wrapper">
    <ul>
      <li class="first">You Are Here</li>
      <li>&#187;</li>
      <li><a href="#">Home</a></li>
      <li>&#187;</li>
      <li><a href="#">Grand Parent</a></li>
      <li>&#187;</li>
      <li><a href="#">Parent</a></li>
      <li>&#187;</li>
      <li class="current"><a href="#">Child</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div id="container">
  <div class="wrapper">
    <div id="content">
      <h1>Appointment </h1>
      <h2>Doctors Record</h2>
      <table summary="Summary Here" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Specialist in</th>
            <th>Timings</th>
            <th>Appointment</th>
          </tr>
        </thead>
        <tbody>
          
            <?php 
		
			$result = mysql_query("SELECT * FROM doctor");

while($row = mysql_fetch_array($result))
  {
	echo "<tr>";
    echo "<td> &nbsp;".$row['doctorname']."</td>";
    echo "<td> &nbsp;".$row['specialistin']."</td>";
	echo "<td>";
	$result1 = mysql_query("SELECT * FROM timings where docid='$row[docid]'");
	//time loops starts here
	while($row1 = mysql_fetch_array($result1))
  {
	if ($row1['session']=="Morning")	 
	{
	echo "&nbsp;". $row1['fromtime']." AM to ";
	echo $row1['totime'] ." AM <br>";
	}
	else
	{
	echo "&nbsp;". $row1['fromtime']." PM to ";
	echo $row1['totime'] ." PM <br>";
	}

  }
//time loop ends here

echo "</td>";
    echo "<td><a href='appointment.php?docid=$row[docid]&docname=$row[doctorname]&sptype=$row[specialistin]'>Make an Appointment</a></td>";
	echo "</tr>";
  }
  ?>
           
        
          
        </tbody>
      </table>
      <h2>&nbsp;</h2>
</div>
    <div id="column">
      <div class="subnav">
        <h2>Patient Account</h2>
        <ul>
          <li><a href="register.php">Patient Registration</a></li>
          <li><a href="patientaccount.php">Patient Login</a> </li>
        </ul>
      </div>
      <div class="holder"></div>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div id="footer">
  <div class="wrapper">
    <div id="newsletter">
      <h2>Stay In The Know !</h2>
      <p>Please enter your email to join our mailing list</p>
      <form action="#" method="post">
        <fieldset>
          <legend>News Letter</legend>
          <input type="text" value="Enter Email Here&hellip;"  onfocus="this.value=(this.value=='Enter Email Here&hellip;')? '' : this.value ;" />
          <input type="submit" name="news_go" id="news_go" value="GO" />
        </fieldset>
      </form>
      <p>To unsubscribe please <a href="#">click here &raquo;</a></p>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div id="copyright">
  <div class="wrapper">
    <p class="fl_left">Copyright &copy; 2011 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <br class="clear" />
  </div>
</div>
</body>
</html>
