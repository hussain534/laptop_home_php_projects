<?php
//setting header to json
session_start();
header('Content-Type: application/json');


include_once('config.php');




$sql="select a.task_type,  count(*) cnt from
(select 			
(select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) task_type,
(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text
from mpm_tasks t where enabled=1 and task_status=".$_GET["status"].") a
group by a.task_type";
//execute query
$result = mysqli_query($databasecon,$sql);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//now print the data
print json_encode($data);