<?php
session_start();

// Login to doctors account
function loginfuntion($loginid,$password)
{
	//LOGIN QUERY
$resultlogin = mysql_query("SELECT * FROM doctor WHERE docid ='$loginid' AND password='$password' ");
// LOGIN VALIDATON
	if(mysql_num_rows($resultlogin) == 1)
	{
 	$_SESSION["docid"] =$loginid;
	$_SESSION["usertype"] = "DOCTOR";
	}
	else
	{
	$in= "Invalid Login ID or invalid password. ";
	return $in;
	}
}
?>
