<?php 
session_start();
$menu= 1;
include("dbconnection.php");
include("header.php");
include("validation/header.php"); 
include("functions/staff.php");

//CHECKS login button is submitted or not
if(isset($_POST["btnlogin"]))
{
	//patient Login funtion..
$loginvalidation =  loginfuntion($_POST["loginid"],$_POST["password"]);
}
include("menu.php"); 
?>

<!-- Patient Login Form####################################################################################################### -->
<div id="container">
  <div class="wrapper">
    <div id="content">
     <?php 
 if(isset($_SESSION["docid"]) && $_SESSION["usertype"] == "DOCTOR" )
{
	$enable ="true";
	?>
	<table width="480" border="1">
  <tr>
    <th colspan="4" align="center"> 
    <?php
	if(isset($_POST["updtimings"]))
	{
		mysql_query("DELETE FROM timings WHERE docid='$_SESSION[docid]'");

$sql="INSERT INTO timings(docid,fromtime,totime,session,tstatus) VALUES ('$_SESSION[docid]', '$_POST[atime]:$_POST[amin]:00','$_POST[btime]:$_POST[bmin]:00','Morning','$_POST[status1]')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

$sql="INSERT INTO timings(docid,fromtime,totime,session,tstatus)VALUES
('$_SESSION[docid]', '$_POST[ctime]:$_POST[cmin]:00','$_POST[dtime]:$_POST[dmin]:00','Afternoon','$_POST[status2]')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

$sql="INSERT INTO timings(docid,fromtime,totime,session,tstatus)VALUES
('$_SESSION[docid]', '$_POST[etime]:$_POST[emin]:00','$_POST[ftime]:$_POST[fmin]:00','Evening','$_POST[status3]')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

$updmsg ="Record updated successfully...";
	  
}
	?>
     </tr>
      <form method="post" action=""  name="form1"  id="formID" class="formular">
      <tr>
        <th colspan="4">  <?php echo $updmsg; ?>    </tr>
      <tr>
    <th width="107">&nbsp;</td>
    <th width="182"><strong>From</strong></td>
    <th width="169"><strong>To</strong></td>
    <th width="169">Status    
  </tr>
  <tr  class="dark">
    <td><strong>Morning</strong></td>
    <td> &nbsp; <select name="atime" id="atime">
        <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
        </select>
:      
<select name="amin" id="amin">
	<option value="00">00</option>
  <option value="00">15</option>
  <option value="08">30</option>
  <option value="08">45</option>
</select></td>
    <td> &nbsp;
      <select name="btime" id="btime">
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      </select>
:      
<select name="bmin" id="bmin">
	<option value="00">00</option>
  <option value="00">15</option>
  <option value="08">30</option>
  <option value="08">45</option>
      </select></td>
    <td>
      <label for="select"></label>
      <select name="status1" id="status1">
        <option value="Enabled">Enabled</option>
        <option value="Disabled">Disabled</option>
      </select>
</td>
  </tr>
  <tr  class="dark">
    <td><strong>Afternoon</strong></td>
    <td> &nbsp;
      <select name="ctime" id="ctime">
        <option value="12">12</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
      </select>
:      
<select name="cmin" id="cmin">
  <option value="00">00</option>
  <option value="15">15</option>
  <option value="30">30</option>
  <option value="45">45</option>
</select></td>
    <td> &nbsp;
      <select name="dtime" id="dtime">
   		<option value="12">12</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
      </select>
:      
<select name="dmin" id="dmin">
  <option value="00">00</option>
  <option value="15">15</option>
  <option value="30">30</option>
  <option value="45">45</option>
</select>
</td>
    <td><select name="status2" id="status2">
      <option value="Enabled">Enabled</option>
      <option value="Disabled">Disabled</option>
    </select></td>
  </tr>
  <tr class="dark">
    <td><strong>Evening</strong></td>
    <td> &nbsp;
      <select name="etime" id="etime">
        <option value="00">-</option>
        <option value="07">07.00</option>
        <option value="08">08.00</option>
        </select>
:      
<select name="emin" id="emin">
        <option value="00">-</option>
        <option value="07">07.00</option>
        <option value="08">08.00</option>
        </select></td>
    <td> &nbsp;
      <select name="ftime" id="ftime">
        <option value="00">-</option>
        <option value="07">07.00</option>
        <option value="08">08.00</option>
        </select>
       : 
       <select name="fmin" id="fmin">
        <option value="00">-</option>
        <option value="07">07.00</option>
        <option value="08">08.00</option>
        </select></td>
    <td><select name="status3" id="status3">
      <option value="Enabled">Enabled</option>
      <option value="Disabled">Disabled</option>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="updtimings" id="updtimings" value="Update Timings" /></td>
  </tr>
</table>
    </form>
    
	<?php
}
else
{
header("patientaccount.php");
}
 ?>
      
    <table width="480" border="1">
      <tr>
        <th colspan="3" align="center"> <?php
	if(isset($_POST["updtimings"]))
	{

		mysql_query("DELETE FROM timings WHERE docid='$_SESSION[docid]'");
		
$sql="INSERT INTO timings(docid,fromtime,totime) VALUES ('$_SESSION[docid]', '$_POST[atime]:$_POST[amin]:00','$_POST[btime]:$_POST[bmin]:00')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

$sql="INSERT INTO timings(docid,fromtime,totime)VALUES
('$_SESSION[docid]', '$_POST[ctime]:$_POST[cmin]:00','$_POST[dtime]:$_POST[dmin]:00')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

$sql="INSERT INTO timings(docid,fromtime,totime)VALUES
('$_SESSION[docid]', '$_POST[etime]:$_POST[emin]:00','$_POST[ftime]:$_POST[fmin]:00')";
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

	  
}
	?>
          </th>
      </tr>
      
      
      <tr>
        <th width="107">&nbsp;
          </td>
        </th>
        <th width="182"><strong>From</strong>
          </td>
        </th>
        <th width="169"><strong>To</strong>
          </td>
        </th>
      </tr>
      <tr  class="dark">
        <td><strong>Morning</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr  class="dark">
        <td><strong>Afternoon</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr class="dark">
        <td><strong>Evening</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <h2>&nbsp;</h2>
<div id="respond"></div>
    </div>
    <div id="column">
      <div class="subnav">
        <h2>Doctors Account</h2>
        <ul>
          <li><a href="profile.php">Doctors  Profile</a></li>
          <li><a href="#">Appointment</a> </li>
          <li><a href="#">Patient Reports</a> </li>
          <li><a href="timings.php">Timings</a></li>
          <li><a href="#">Account</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </div>
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
