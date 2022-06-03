<?php
//setting header to json
session_start();
header('Content-Type: application/json');


include_once('config.php');



$data = array();
$sql="select '<3 min' category,count(*) cnt from 
(select t.task_last_updated_on,t.task_call_made_on,round(TIMESTAMPDIFF(SECOND,t.task_call_made_on,t.task_last_updated_on)/60,2) res_time from mpm_tasks t where t.task_status=6) a 
where a.res_time>=0 and a.res_time<3";
/*$sql="select '<3 min' category,count(*) cnt from 
(select t.task_last_updated_on,t.task_call_made_on,round(TIMESTAMPDIFF(SECOND,t.task_call_made_on,t.task_last_updated_on)/60,2) res_time from mpm_tasks t where t.task_status=36) a 
where a.res_time>=0 and a.res_time<3";*/
//execute query
$result = mysqli_query($databasecon,$sql);

foreach ($result as $row) {
	$data[0] = $row;
}

$sql="select '3 - 7 min' category,count(*) cnt from 
(select t.task_last_updated_on,t.task_call_made_on,round(TIMESTAMPDIFF(SECOND,t.task_call_made_on,t.task_last_updated_on)/60,2) res_time from mpm_tasks t where t.task_status=6) a 
where a.res_time>=3 and a.res_time<7";
//execute query
$result = mysqli_query($databasecon,$sql);

foreach ($result as $row) {
	$data[1] = $row;
}

$sql="select '7 - 10 min' category,count(*) cnt from 
(select t.task_last_updated_on,t.task_call_made_on,round(TIMESTAMPDIFF(SECOND,t.task_call_made_on,t.task_last_updated_on)/60,2) res_time from mpm_tasks t where t.task_status=6) a 
where a.res_time>=7 and a.res_time<10";
//execute query
$result = mysqli_query($databasecon,$sql);

foreach ($result as $row) {
	$data[2] = $row;
}

$sql="select '> 10 min' category,count(*) cnt from 
(select t.task_last_updated_on,t.task_call_made_on,round(TIMESTAMPDIFF(SECOND,t.task_call_made_on,t.task_last_updated_on)/60,2) res_time from mpm_tasks t where t.task_status=6) a 
where a.res_time>=10";
//execute query
$result = mysqli_query($databasecon,$sql);

foreach ($result as $row) {
	$data[3] = $row;
}
//now print the data
print json_encode($data);