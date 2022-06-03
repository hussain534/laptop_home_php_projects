<?php
include_once('config.php');
$DEBUG_STATUS = $PRINT_LOG;
require 'controladorDB.php';
$controladorDB = new controladorDB();

/*$sql="select now() curr_dt from dual";
$resultSet = mysqli_query($databasecon,$sql);
if(mysqli_num_rows($resultSet) > 0)  
{
    while($row = mysqli_fetch_assoc($resultSet)) 
    {
        $fecha_carga_archivo=$row["curr_dt"];
    }
}*/

$fecha_carga_archivo=date("Ymd");

echo 'fecha_carga_archivo::'.$fecha_carga_archivo.'<br>';


$sql="select id, id_integrador, ip_servidor,ruta, usuario, clave, (select intervalo from c_auto_concil_intervalos i where i.id=f.id_intervalo) intervalo from c_config_file_server f where habilitado=1";
$auto_load=array();
$count=0;
$result = mysqli_query($databasecon,$sql);
if(mysqli_num_rows($result) > 0)  
{
    while($row = mysqli_fetch_assoc($result)) 
    {
        $auto_load[$count] = array($row["id"],str_pad($row["id_integrador"],4,"0",STR_PAD_LEFT),$row["ip_servidor"],$row["ruta"],$row["usuario"],$row["clave"],$row["intervalo"]);
        $count++;
    }
}

print_r($auto_load);

for($x=0;$x<count($auto_load);$x++)
{
    $host = $auto_load[$x][2];
    $port = 22;
    $username = $auto_load[$x][4];
    $password = $auto_load[$x][5];
    $connection = NULL;
    $remote_file_dir = $auto_load[$x][3];
    try 
    {
        if (!function_exists("ssh2_connect"))
            die('Function ssh2_connect does not exist.');
        echo "1<br>";
        $connection = ssh2_connect($host, $port);
        if(!$connection)
        {
            throw new \Exception("Could not connect to $host on port $port");
        }
        echo "2<br>";
        $auth  = ssh2_auth_password($connection, $username, $password);
        echo "3<br>";
        if(!$auth)
        {
            throw new \Exception("Could not authenticate with username $username and password ");  
        }
        echo "4<br>";
        $sftp = ssh2_sftp($connection);
        echo "5<br>";
        if(!$sftp)
        {
            throw new \Exception("Could not initialize SFTP subsystem.");  
        }
        echo "6<br>";
        $pattern = "/INT".$auto_load[$x][1]."_".$fecha_carga_archivo.".txt/";
        echo "7<br>";
        $sftp_fd = intval($sftp);
        echo "8<br>";
        //$handle = opendir("ssh2.sftp://".$sftp.$remote_file_dir);
        $handle = opendir("/home/bwise/entradas/");
        echo "9<br>";
        while (false != ($entry = readdir($handle)))
        {
            if(preg_match($pattern, $entry))
            {
                //$stream = fopen("ssh2.sftp://".$sftp.$remote_file_dir.'/'.$entry, 'r');
                $stream = fopen("/home/bwise/entradas/".$entry, 'r');
                if (! $stream) 
                {
                    throw new \Exception("Could not open file: ");
                }
                
                while (($line_data = fgets($stream, 4096)) !== false) 
                {
                    echo $line_data.'<br>';                
                }           

                if (!feof($stream)) 
                {
                    echo "Error: unexpected fgets() fail\n";
                }

               
                @fclose($stream);
                $connection = NULL;
            }
        }    
    } 
    catch (Exception $e) 
    {
        echo "Error due to :".$e->getMessage();
    }
}


?>