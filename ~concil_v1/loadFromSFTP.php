<?php
include_once('config.php');
$DEBUG_STATUS = $PRINT_LOG;
require 'controladorDB.php';
$controladorDB = new controladorDB();

$sql="select now() curr_dt from dual";
$resultSet = mysqli_query($databasecon,$sql);
if(mysqli_num_rows($resultSet) > 0)  
{
    while($row = mysqli_fetch_assoc($resultSet)) 
    {
        $fecha_carga_archivo=$row["curr_dt"];
    }
}


$host = "merakiminds.com";
$port = 2222;
$username = "merakiadmin";
$password = "meraki534";
$connection = NULL;
#$remote_file_path = "/C:/hussain/PERSONAL/Proyectos/CONCILIACION/INT0004_20190102.txt";
#$remote_file_dir = "/C:/hussain/PERSONAL/Proyectos/CONCILIACION";
$remote_file_dir = "/public_ftp/incoming";
try 
{
    if (!function_exists("ssh2_connect"))
        die('Function ssh2_connect does not exist.');

    $connection = ssh2_connect($host, $port);
    if(!$connection)
    {
        throw new \Exception("Could not connect to $host on port $port");
    }
    $auth  = ssh2_auth_password($connection, $username, $password);
    if(!$auth)
    {
        throw new \Exception("Could not authenticate with username $username and password ");  
    }
    $sftp = ssh2_sftp($connection);
    
    if(!$sftp)
    {
        throw new \Exception("Could not initialize SFTP subsystem.");  
    }
    
    $pattern = "/INT0004_20190102.txt/";

    $sftp_fd = intval($sftp);
    //echo $sftp_fd.'<br>';
    $handle = opendir("ssh2.sftp://".$sftp.$remote_file_dir);
    //echo "Directory handle: $handle".'<br>';
    //echo "Entries:".'<br>';
    while (false != ($entry = readdir($handle)))
    {
        //echo "$entry".'<br>';
        if(preg_match($pattern, $entry))
        {
            $stream = fopen("ssh2.sftp://".$sftp.$remote_file_dir.'/'.$entry, 'r');
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

            //$contents = stream_get_contents($stream);
            //echo $contents;
            //echo "<pre>"; 
            //print_r($contents); 
            //echo "</pre>";
            @fclose($stream);
            $connection = NULL;
        }
    }



   
} 
catch (Exception $e) 
{
    echo "Error due to :".$e->getMessage();
}

?>