<?php

//phpinfo();


// -------------- CHANGE VARIABLES TO SUIT YOUR ENVIRONMENT  --------------
//LDAP server address
$server = "ldap://192.168.16.8/";
//$host ="192.168.16.8";
//$port ="636";
//$user = "CN=Xavier Santiago Espinoza Luna,OU=Desarrollo TI,OU=Usuarios,OU=Empresa,DC=etapa,DC=net,DC=ec";
//psw = "Etapa2020";
$user="CN=Prueba,OU=Usuarios portatiles,OU=Usuarios,OU=Empresa,DC=etapa,DC=net,DC=ec";
$psw="Etapa2019";
//$user = "ETAPA-NET\xespinoz";
//sw = "Etapa2020";

//FQDN path where search will be performed. OU - organizational unit / DC - domain component
//n = "OU=empresa,DC=etapa,DC=net,DC=ec";
//Search query. CN - common name (CN=* will return all objects)

//$search = "cn=*luna";   
//$filter="(|(sn=$search*)(givenname=$search*))";
//ustthese = array("ou", "sn", "givenname", "mail");
//$search = "cn=autenticacion alepo";                 
// ------------------------------------------------------------------------
echo "<h2>php LDAP query test</h2>";
// connecting to LDAP server
$ds=ldap_connect($server);// or die("could not connect to ldap");
//$ds=ldap_connect($host,$port) or die("could not connect to ldap");
//ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
//ldap_set_option($ds, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
//echo "hello<br>";
//sleep(10);
//echo "after sleep<br>";
$sr=ldap_bind($ds, $user , $psw); 
if($sr)
	echo "Authenticated";
else
	echo "Error in Authentication";
// performing search
//r=ldap_search($ds, $dn,$filter,  $justthese);
/*$sr=ldap_search($ds, $dn,$search);
$data = ldap_get_entries($ds, $sr);    
if ($data["count"]>0)
{
	echo "Found " . $data["count"] . " entries";
	print_r ($data);
}
else
	echo "Found 0 entries";
for ($i=0; $i<$data["count"]; $i++) 
{
	echo "<h4><strong>Common Name: </strong>" . $data[$i]["cn"][0] . "</h4><br />";
	echo "<strong>Distinguished Name: </strong>" . $data[$i]["dn"] . "<br />";
	//checking if discription exists 
	if (isset($data[$i]["description"][0])) 
		echo "<strong>Desription: </strong>" . $data[$i]["description"][0] . "<br />";
	else 
		echo "<strong>Description not set</strong><br />";
	//checking if email exists
	if (isset($data[$i]["mail"][0]))
		echo "<strong>Email: </strong>" . $data[$i]["mail"][0] . "<br /><hr />";
	else 
		echo "<strong>Email not set</strong><br /><hr />";
}*/
 // close connection
 ldap_close($ds);
?>
