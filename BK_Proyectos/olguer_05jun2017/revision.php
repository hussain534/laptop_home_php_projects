<?php
error_reporting(E_ALL);
ini_set('display_errors','1');

set_time_limit(0);
ini_set('memory_limit', '-1');

include_once('config.php'); 
$databasecon = $databasecon;

if (isset($_POST["consulta_sql"])) 
	$consultas= $_POST["consulta_sql"];
else $consultas ="";
$consultas= str_replace('\\','',$consultas);


?>
<style type="text/css">
td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
</style>



<form action="" method="post" name="consulta">
<textarea name="consulta_sql" cols="150" rows="8"><?php echo($consultas);  ?></textarea>
<br>
<input type="password" name="secret_code">
<input name="btn_consultar" type="submit" value="consultar"/>
</form>
<?php
if(strcmp($_POST["secret_code"],"207381")==0)
{
	if (isset($_POST["consulta_sql"]) && !empty($_POST["consulta_sql"])) 
	{
	    $mensaje ="";
		$lista_querys = explode(";",$consultas);
		$cantQuery = count($lista_querys);
	    $contQuery = 0;
		$cantRegXQuery =0;
		$tiemp_ini = microtime(true);
		while ($contQuery<$cantQuery)
		{
			$cantRegXQuery =0;
			echo("<hr>".$lista_querys[$contQuery]).'<br>';
			if (isset($lista_querys[$contQuery]) && $lista_querys[$contQuery]!="" && $lista_querys[$contQuery] !=" ")
			{
				$recordset = mysqli_query($databasecon,$lista_querys[$contQuery]);
				$cabecera=0;
				echo('<table border="1" cellpadding="2" cellspacing="0">'.chr(10).chr(13));
				while ($arr = mysqli_fetch_assoc($recordset)) 
				{
					$contaCampos = 1;
					$cantRegXQuery++;
					if ($cabecera==0) 
					{
						$cabecera=1;
						$Keycampos = array_keys($arr);
						$cantCampos = count($arr);
						//echo 'cantCampos'.$cantCampos.'<br>';
						echo("<tr>".chr(10).chr(13));
						while($contaCampos <=$cantCampos)
						{
							//echo 'contaCampos'.$contaCampos.'<br>';
							echo("<td>".$Keycampos[$contaCampos-1]."</td> ".chr(10).chr(13));
							$contaCampos= $contaCampos+1;
						}
						echo("</tr>".chr(10).chr(13));
					}
					echo("<tr>".chr(10).chr(13));
					$contaCampos = 1;
					$Keyvalues = array_values($arr);
					while($contaCampos <=$cantCampos)
					{
						echo('<td align="center">'.$Keyvalues[$contaCampos-1]."</td> ".chr(10).chr(13));
						$contaCampos= $contaCampos+1;
					}
					echo("</tr>".chr(10).chr(13));			
					if ($cantRegXQuery>25000) 
					{
						$mensaje = "Consulta excede limite de registros permitidos.";
						break;
					}
				}
				$tiemp_fin = microtime(true);
				$tiempo = $tiemp_fin - $tiemp_ini;
				if ($cabecera==1 ) 
					echo('<tr><td colspan="'.($cantCampos/2).'" align="left"> '.$mensaje.'  ' . $cantRegXQuery .' Registros en '.$tiempo.' seg.</td></tr>'.chr(10).chr(13));			
				echo("</table>".chr(10).chr(13));	

			} 
		$contQuery++;
		}


	}
	else
		echo "<h3>NO QUERY FOUND!!</h3>";
}
else
	echo "<h3>UNAUTHORISED ACCESS!!</h3>";
?>

