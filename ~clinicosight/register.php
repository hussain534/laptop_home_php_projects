<?php 
include("dbconnection.php");
include("header.php");
include("validation/header.php"); 
include("functions/patient.php");

if(isset($_POST["button"]))
{
//select max value from patient db

	$result = mysql_query("SELECT MAX(patid) FROM patient");
while($row = mysql_fetch_array($result))
  {
$maxpatid = $row[0];
$maxpatid++;
  }
  
// Insert records to patient table
$sql="INSERT INTO patient(patid,patfname,patlname,emailid,contactno,password)
VALUES
('$maxpatid','$_POST[pfn]','$_POST[pln]','$_POST[email]','$_POST[contact]','$_POST[password]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}

?>
<!-- ####################################################################################################### -->
<?php include("menu.php"); ?>
<!-- ####################################################################################################### -->
<!-- ####################################################################################################### -->
<div id="container">
  <div class="wrapper">
    <div id="content">
      <h1>Patient Registration</h1>
      <p>&nbsp;</p>
 
      <?php
	  if(isset($_POST["button"]))
{
?>
 <table summary="Summary Here" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Patient Registered Successfully</th>
          </tr>
        </thead>
        <tbody>
          <tr class="light">
            <td><b>Your Patient ID is : <?php echo $maxpatid; ?></b></td>
          </tr>
                </tbody>
      </table>
      <form method="post" action="patientaccount.php" id="formID1" class="formular" >
        <input name="btnlogin" type="submit" id="submit" value="Click here to Login"  class="submit"/>

      <p>
&nbsp;<br />&nbsp;
      </p>
      </form>
<?php
}
else
{
?>
<form id="formID" class="formular" method="post">
  <div align="center"><strong><b> Registration Page</b></strong></div>
  <label for="textfield">  First Name</label>
     <input type="text" name="pfn" id="textfield" class="validate[required] text-input" />
     <label for="textfield2">Last Name</label>
      <input type="text" name="pln" id="textfield2" class="validate[required] text-input" />

      <label for="textfield4">Password</label>
        <input type="password" name="password" id="password"  class="validate[required] text-input"/>
      <label for="textfield3">        </label>
    
    
      Confirm Password
      <input type="password" name="textfield5" id="textfield5" class="validate[required,equals[password]] text-input" />
    
    
      Email ID
      <input type="text" name="email" id="textfield6" class="validate[required,custom[email]] text-input" />
    
    
      Contact No
      <input type="text" name="contact" id="textfield7" class="validate[required] text-input" />
    <div align="center">
        <input type="submit" name="button" id="button" value="Register"   class="submit"/>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="reset" name="button2" id="button2" value="Reset"  class="submit"/>
</div>
 <p>
&nbsp;<br />&nbsp;
      </p>
</form>
<form method="post" action="patientaccount.php" id="formID1" class="formular" >
       <p>
<b>Already Registered?</b>
      </p>
       <input name="btnlogin" type="submit" id="submit" value="Click here to Login"  class="submit"/>

      <p>
&nbsp;<br />&nbsp;
      </p>
      </form>
     <?php
}
?> 
      <p>&nbsp;</p>

      <div id="respond">
    </div>
    </div>
    <div id="column">
      <div class="holder">
        <h2>Registration Page</h2>
        <p>Please enter First Name, Last Name, Password, Email ID, Contact number to Register Clinicosight.</p>
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





