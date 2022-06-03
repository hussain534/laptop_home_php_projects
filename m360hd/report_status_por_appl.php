<?php
//setting header to json
session_start();
header('Content-Type: application/json');


include_once('config.php');




$sql="select a.task_service_appl,  count(*) cnt from
	(select 			
	(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
	(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text
	from mpm_tasks t where enabled=1 and task_status=".$_GET["status"].") a
	group by a.task_service_appl";
/*$sql="select a.task_service_appl,  count(*) cnt from
	(select 			
	(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
	(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text
	from mpm_tasks t where enabled=1 and task_status=".$_GET["status"];
if($_SESSION["user_perfil"]==4)
	$sql=$sql." and t.task_assigned_to=".$_SESSION["user_id"];

$sql=$sql.") a";
$sql=$sql."group by a.task_service_appl";*/
//execute query
$result = mysqli_query($databasecon,$sql);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//now print the data
print json_encode($data);