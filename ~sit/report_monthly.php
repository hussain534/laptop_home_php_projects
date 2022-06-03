<?php
//setting header to json
session_start();
header('Content-Type: application/json');

//database
include_once('config.php');
//$DEBUG_STATUS = $PRINT_LOG;
//require 'dbcontroller.php';
//$controller = new controller();
//$tasks = $controller->getMyTodaysProjectTaskReport($databasecon,$_GET["pid"],$DEBUG_STATUS);
//print_r($tasks);

$sql="select 
(case when t.categorea_tarea=1 then 'SOPORTE'
when t.categorea_tarea=2 then 'ADMINISTRACION'
when t.categorea_tarea=3 then 'MEJORAS'
when t.categorea_tarea=4 then 'VALOR AGREGADO' end) category, count(*) cnt
from mpm_tasks t where enabled=1";
if($_SESSION["user_id"]!=1)
	$sql=$sql." and t.created_by=".$_SESSION["user_id"];
$sql=$sql." and t.project_id=".$_GET["pid"]."
and t.task_date>=DATE_ADD(DATE_FORMAT(concat(DATE_FORMAT(now(),'%Y-%m-%d'),' 00:00:00'),'%Y-%m-%d %H:%i:%s'), INTERVAL -30 DAY) 
and t.task_date<=DATE_FORMAT(concat(DATE_FORMAT(now(),'%Y-%m-%d'),' 23:59:59'),'%Y-%m-%d %H:%i:%s')
group by t.categorea_tarea";
//execute query
$result = mysqli_query($databasecon,$sql);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//now print the data
print json_encode($data);