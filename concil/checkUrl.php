<?php
//$url="https://conciliacion-metrowifi.etapa.net.ec/";
$url=$_GET["url"];
$headers=get_headers($url);
echo 'Result:'.$headers[0].'<br>';
echo stripos($headers[0],"200 OK")?"WEB SITE ON":"WEB SITE DOWN" ;
/*echo 'POS::'.$pos.'<br>';
if($pos==1)
    echo "WEB SITE ON";
else
    echo "WEB SITE DOWN";*/

?>