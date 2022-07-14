<?php
//setting header to json
session_start();
header('Content-Type: application/json');
include_once('config.php');
/*$sql="select a.task_notified_through,  count(*) cnt from
(select 			
(select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) task_notified_through,
(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text
from mpm_tasks t where enabled=1 and task_status=".$_GET["status"].") a
group by a.task_notified_through";*/
/*$sql="SELECT dd.id_evaluado,AVG(r.satisfaccion) cnt FROM datos_dtl dd, respuestaevaluacion r WHERE dd.habilitado=1 AND r.habilitado=1 AND dd.id_planevaluacion=4 AND dd.id_tipoevaluacion=3 AND dd.id_satisfaccion=r.id GROUP BY dd.id_evaluado";*/
//$sql="SELECT (SELECT nombre FROM c_login l WHERE l.id=dd.id_evaluado) evaluado,AVG(r.satisfaccion) cnt FROM datos_dtl dd, respuestaevaluacion r, planevaluacion p WHERE dd.habilitado=1 AND r.habilitado=1 and p.habilitado=1 AND dd.id_tipoevaluacion=2 AND dd.id_satisfaccion=r.id and dd.id_planevaluacion=p.id GROUP BY dd.id_evaluado,dd.id_planevaluacion";

$sql="SELECT (SELECT nombre FROM c_login l WHERE l.id=dd.id_evaluado) evaluado,AVG(r.satisfaccion) cnt FROM datos_dtl dd, respuestaevaluacion r, planevaluacion p WHERE dd.habilitado in(1,2) AND r.habilitado=1 and p.habilitado in(1,2) AND dd.id_tipoevaluacion=2 AND dd.id_satisfaccion=r.id and dd.id_planevaluacion=p.id GROUP BY dd.id_evaluado,dd.id_planevaluacion";
//execute query
$result = mysqli_query($databasecon,$sql);
//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
//now print the data
print json_encode($data);