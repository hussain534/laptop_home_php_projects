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

if(isset($_POST["btnapp"]))
{
$sql="INSERT INTO appointment(patid,atime,adate,docid,status,comment) VALUES ('$_SESSION[patid]','$_POST[radio]','$_POST[appdate]','$_SESSION[appdocid]','Pending','$_POST[appcomment]')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}
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
      <h1>A</h1>
      <h2>Appointment Time</h2>
     <?php
$result1 = mysql_query("SELECT * FROM timings where docid='$_SESSION[appdocid]' AND tstatus='Enabled' AND session='Morning'");
	//time loops starts here
	while($row1 = mysql_fetch_array($result1))
  {
	 // docid 	fromtime 	totime 	session 	tstatus
	$start = $row1[fromtime];
	$endDate = $row1[totime];
  }
  echo "Appointment Date : ".$_POST[dateofbirth]. "<br>";
  ?>
      <form id="form1" name="form1" method="post" action="">
      <table width="734" border="1">
  <tr>
    <th width="253" align="center"><strong>Morning</strong></th>
    <th width="186" align="center"><strong>Afternoon</strong></th>
    <th width="273" align="center"><strong>Evening</strong></th>
   </tr>
  <tr>
    <th align="center">
    <input type="hidden" name="appdate" value="$_POST[dateofbirth]" />
    <input type="hidden" name="appcomment" value="$_POST[comment]" />
    <input type="radio" name="radio" id="radio" value="09:00:00" />
      09.00

        <label for="radio"></label> 
        AM
</th>
    <th align="center"><input type="radio" name="radio" id="09:15:00" value="09:15:00" />
      12.00 PM</th>
    <th align="center"><input type="radio" name="radio" id="09:15:00" value="09:30:00" />
      04.00 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="09:45:00" value="09:45:00" />
09.30

        <label for="radio2"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="10:00:00" value="10:00:00" />
      12.15 PM</th>
    <th align="center"><input type="radio" name="radio" id="10:15:00" value="10:15:00" />
      04.15 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="10:30:00" value="10:30:00" />
09.45

        <label for="radio3"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="10:45:00" value="10:45:00" />
      12.30 PM</th>
    <th align="center"><input type="radio" name="radio" id="11:00:00" value="11:00:00" />
      04.30 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="11:15:00" value="11:15:00" />
      10.00

        <label for="radio4"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="11:30:00" value="11:30:00" />
      12.45 PM</th>
    <th align="center"><input type="radio" name="radio" id="11:45:00" value="11:45:00" />
      04.45 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="12:00:00" value="12:00:00" />
      10.15

        <label for="radio5"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="12:15:00" value="12:15:00" />
      01.00 PM</th>
    <th align="center"><input type="radio" name="radio" id="12:30:00" value="12:30:00" />
      05.00 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="radio6" value="12:45:00" />
      10.30

        <label for="radio6"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="radio18" value="01:00:00" />
      01.15 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio18" value="01:15:00" />
      05.15 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="radio7" value="11:00:00" /> 
      10.45


        <label for="radio7"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="radio19" value="radio" />
      01.30 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio19" value="radio" />
      05.30 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="radio8" value="radio" />
11.00 

        <label for="radio8"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="radio20" value="radio" />
      01.45 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio20" value="radio" />
      05.45 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="radio9" value="radio" />
11.15 

        <label for="radio9"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="radio21" value="radio" />
      02.00 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio21" value="radio" />
      06.00 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="radio10" value="radio" /> 
      11.30


        <label for="radio10"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="radio22" value="radio" />
      02.15 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio22" value="radio" />
      06.15 PM</th>
    </tr>
  <tr>
    <th align="center"><input type="radio" name="radio" id="radio11" value="radio" />
11.45 

        <label for="radio11"></label>
AM</th>
    <th align="center"><input type="radio" name="radio" id="radio23" value="radio" />
      02.30 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio23" value="radio" />
      06.30 PM</th>
    </tr>
  <tr>
    <th align="center">&nbsp;</th>
    <th align="center"><input type="radio" name="radio" id="radio24" value="radio" />
      02.45 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio24" value="radio" />
    06.45 PM</th>
    </tr>
  <tr>
    <th align="center">&nbsp;</th>
    <th align="center"><input type="radio" name="radio" id="radio25" value="radio" />
      03.00 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio25" value="radio" />
      07.00 PM</th>
    </tr>
  <tr>
    <th align="center">&nbsp;</th>
    <th align="center"><input type="radio" name="radio" id="radio26" value="radio" />
      03.15 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio26" value="radio" />
      07.15 PM</th>
    </tr>
  <tr>
    <th align="center">&nbsp;</th>
    <th align="center"><input type="radio" name="radio" id="radio27" value="radio" />
      03.30PM</th>
    <th align="center"><input type="radio" name="radio" id="radio27" value="radio" />
      07.30PM</th>
    </tr>
  <tr>
    <th align="center">&nbsp;</th>
    <th align="center"><input type="radio" name="radio" id="radio28" value="radio" />
      03.45 PM</th>
    <th align="center"><input type="radio" name="radio" id="radio16" value="radio" />
07.45PM</th>
    </tr>
  <tr>
    <th colspan="3" align="center"><input type="submit" name="btnapp" id="btnapp" value="Click Here to Continue" /></th>
    </tr>
      </table>
    </form>
  <?php
/*

  $a = 9.00; $b =11.45;
  $c = 12.00; $d = 14.45;
  $e = 03.00; $f= 19.15;

  for ($i=0; $i<100; $i++)
  {
 echo "<tr><td>&nbsp;<input type='radio' name='timings'> ";
	if($a < $b)
	{
	echo $a;
	}
	
echo "</td><td>&nbsp;<input type='radio' name='timings'>";
	if($c < $d)
	{
	echo $c;
	} 
	
echo "</td><td>&nbsp;<input type='radio' name='timings'> ";
	if($e < $f)
	{
	echo $e;
	}
	echo "</td>";
	echo "</tr>";
	
$num = $a/1 ;
$intpart = floor( $num ). " : ";    // results in 3
$fraction = $num - $intpart ;

	if($fraction == 0.45)
	{
 	$a = $intpart + 1;
	}

	$a += 0.15;
	$c += 0.15;
	$e += 0.15;
  }
*/
	?>
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
