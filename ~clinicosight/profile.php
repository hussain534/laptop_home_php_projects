<?php 
session_start();
include("dbconnection.php");
include("header.php");
include("validation/header.php"); 
include("functions/patient.php");
$dt= "$_POST[year]-$_POST[month]-$_POST[date]";

$resultpatientrec = mysql_query("SELECT * FROM patient WHERE patid ='$_SESSION[patid]'");
while($row = mysql_fetch_array($resultpatientrec))
  {
 $fname = $row["patfname"];
 $lname = $row["patlname"];


 $emailid = $row["emailid"];
 $contactno = $row["contactno"];
 $address = $row["address"];
 

 $city = $row["city"];

  }
  
  if(isset($_POST["submit"]))
{
$resrec= mysql_query("UPDATE patient SET patlname='$_POST[patlname]', dob ='$dt',patfname='$_POST[patfname]',emailid='$_POST[emailid]',contactno ='$_POST[contactno]',address='$_POST[address]',	city ='$_POST[city]',	state  ='$_POST[state]',country ='$_POST[country]',bloodgroup  ='$_POST[blood]',bloodgroup ='$_POST[textarea]' WHERE patid = '$_SESSION[patid]' ");
}

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
 if(isset($_SESSION["patid"]))
{
include("validation/header.php");
//retrieve country from database. Table: country
include("dbconnection.php");

?>
      <form id="formID" class="formular" method="post" action="">
 <div align="center"><strong><u>Profile Page</u></strong></div>
<label for="textfield">First Name :</label>
      <label>
	<input name="patfname" type="text" class="validate[required] text-input" id="req" value="<?php echo $fname; ?>"/>
	    </label>
            <br />Last Name <label>
	<input  class="validate[required] text-input" type="text" name="patlname" id="req1"  value="<?php echo $lname; ?>" />
			</label>
            <br />
            Date Of Birth<label for="select" class="validate[required]"></label><?php include("controls/datetimepicker/demo.htm"); ?>  <br />
     Gender
        <label for="select2"></label>
        <select name="gender" id="gender"  class="validate[required]">
          <option value=""></option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
<br />
        <label>Blood Group :
          <select name="blood" id="sport" class="validate[required]">
            <option value="">Select Group</option>
            <option>A</option>
            <option>A+ve</option>
            <option>A-ve</option>
            <option>B</option>
            <option>B+ve</option>
            <option>B-ve</option>
            <option>AB</option>
            <option>AB+ve</option>
            <option>AB-ve</option>
            <option>O</option>
            <option>O+ve</option>
            <option>O-ve</option>
          </select>
        </label>
<br />
    Email ID :<input type="text" name="emailid" id="textfield3" class="validate[required,custom[email]] text-input" value="<?php echo $emailid; ?>"/><br />Contact No :<input type="text" name="contactno" id="textfield7" class="validate[required] text-input" value="<?php echo $contactno; ?>" /><br />
   <label for="textarea">Address</label>
      <textarea name="address" id="textarea" cols="45" rows="5"class="validate[required]"><?php echo $address; ?></textarea><br />
      Country :   
        <select name="country" onChange="getCity('findcity.php?country='+this.value)">
<option>Select Country</option>
<option value="k">fd</option>
</select><br />
State : <div id="citydiv"><select name="state">
	<option>Select State</option>
        </select></div><br />
        City :<input  class="validate[required] text-input" type="text" name="city" id="city" value="<?php echo $city; ?>"/><br /><br />
      Comment :   
      <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea><br />
      <input class="submit" type="submit" value="Update Profile"/><hr/>

      </td>
    </tr>

     </table>
      
</form>
    
 <?php
}
 ?>
 <div id="respond"></div>
    </div>
    <div id="column">
      <div class="subnav">
        <h2>Patient Account</h2>
        <ul>
          <li><a href="profile.php">Patient Profile</a></li>
          <li><a href="#">Free CSS Templates</a>
            <ul>
              <li><a href="#">Free XHTML Templates</a></li>
              <li><a href="#">Free Website Templates</a></li>
            </ul>
          </li>
          <li><a href="#">Open Source Layouts</a>
            <ul>
              <li><a href="#">Open Source Software</a></li>
              <li><a href="#">Open Source Webdesign</a>
                <ul>
                  <li><a href="#">Open Source Downloads</a></li>
                  <li><a href="#">Open Source Website</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Open Source Themes</a></li>
        </ul>
      </div>
      <div class="holder">
        <h2 class="title"><img src="images/demo/60x60.gif" alt="" />Nullamlacus dui ipsum conseque loborttis</h2>
        <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna. Urnaultrices quis curabitur phasellentesque.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
      <div id="featured">
        <ul>
          <li>
            <h2>Indonectetus facilis leonib</h2>
            <p class="imgholder"><img src="images/demo/240x90.gif" alt="" /></p>
            <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna. Urnaultrices quis curabitur phasellentesque congue magnis vestibulum quismodo nulla et feugiat. Adipisciniapellentum leo ut consequam ris felit elit id nibh sociis malesuada.</p>
            <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
          </li>
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
