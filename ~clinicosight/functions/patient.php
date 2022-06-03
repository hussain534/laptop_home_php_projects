<?php
session_start();

// Login to patient account
function loginfuntion($loginid,$password)
{
	//LOGIN QUERY
$resultlogin = mysql_query("SELECT * FROM patient WHERE patid ='$loginid' AND password='$password' ");
// LOGIN VALIDATON
	if(mysql_num_rows($resultlogin) == 1)
	{
 	$_SESSION["patid"] =$loginid;
	$_SESSION["usertype"] = "PATIENT";
	}
	else
	{
	$in= "Invalid Login ID or invalid password. ";
	return $in;
	}
}
	
$resultpro = mysql_query("SELECT * FROM patient WHERE patid ='$_SESSION[patid]'");

while($row = mysql_fetch_array($resultpro))
  {
$_SESSION["patname"] =  $row['patfname']. " ".$row['patlname'] ; 	 	
  }
?>
