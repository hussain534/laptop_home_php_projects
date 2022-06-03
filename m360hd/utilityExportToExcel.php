<?PHP
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
  session_start();
  header('Content-Type: application/json');
  include_once('config.php');
  $DEBUG_STATUS = $PRINT_LOG;
  require 'dbcontroller.php';
  $controller = new controller();

  

  function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    $str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
  }

  // filename for download


  if(isset($_GET["fechaNotificacionInicio"]))
  {
      $fechaInicio=$_GET["fechaNotificacionInicio"].' 00:00:00';
      //echo '<br>fechaInicio:'.$fechaInicio;
  }
  if(isset($_GET["fechaNotificacionFin"]))
  {
      $fechaFin=$_GET["fechaNotificacionFin"].' 23:59:59';
      //echo '<br>fechaFin:'.$fechaFin;
  }

  if(isset($_GET["id_tecnicoStr"]))
  {
      $id_tecnico=$_GET["id_tecnicoStr"];
      //echo '<br>fechaInicio:'.$fechaInicio;
  }
  if(isset($_GET["status"]))
  {
      $status=$_GET["status"];
      //echo '<br>fechaFin:'.$fechaFin;
  }

  if(!isset($_GET["fechaNotificacionInicio"]) || !isset($_GET["fechaNotificacionFin"]))
  {
      //echo '<br>';   
  }

  $filename = "SIT_DATA(".$fechaInicio."_".$fechaFin.").csv";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv; charset=UTF-16LE");

  $out = fopen("php://output", 'w');

  $flag = false;


  $sql="select t.task_id NRO_TICKET,
          (select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) TIPO_DE_TAREA,
          (select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) MEDIO_DE_NOTIFICACION,
          task_notified_by NOTIFICADO_POR,
          task_notified_on FECHA_NOTIFICACION,
          (select l.name from mpm_login l where l.id=t.task_recieved_by) TAREA_REGISTRADO_POR,
          (select l.name from mpm_login l where l.id=t.task_assigned_to) TECNICO_ASIGNADO,
          t.task_assigned_on FECHA_ASIGNACION,
          (select c.name from catalogue c where c.type=6 and c.enabled=1 and c.id=t.task_priority) PRIORIDAD_DEL_TAREA,
          (select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) SERVIICO_APLICACION,
          t.task_title DESC_BREVE_DEL_TAREA,
          t.task_desc DESC_COMPLETO_DEL_TAREA,
          t.task_server_ips SERVIDORES,
          t.task_email_sent_on FECHA_NOTIFICACION_EMAIL,
          t.task_call_made_on FECHA_NOTIFICACION_LLAMADA,
          (select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) ESTADO,
          task_last_updated_on FECHA_ULTIMO_ACTUALIZACION,
          (select l.name from mpm_login l where l.id=t.task_last_updated_by) TAREA_ULTIMO_ACTUALIZADO_POR
          from mpm_tasks t where enabled=1 ";
      if($status!=-1)
        $sql=$sql." and t.task_status=".$status;
      if($_SESSION["user_perfil"]==4)
        $sql=$sql." and t.task_assigned_to=".$_SESSION["user_id"];
      else if($id_tecnico!=-1)
      {
        $sql=$sql." and t.task_assigned_to=".$id_tecnico;
      }
    $sql=$sql." and t.task_notified_on>=DATE_FORMAT('".$fechaInicio."','%Y-%m-%d %H:%i:%s') 
                and t.task_notified_on<=DATE_FORMAT('".$fechaFin."','%Y-%m-%d %H:%i:%s')";
    $sql=$sql." order by task_last_updated_on desc";


  //$result = pg_query("SELECT * FROM table ORDER BY field") or die('Query failed!');
  $result = mysqli_query($databasecon,$sql);
  foreach ($result as $row) {
    if(!$flag) {
      // display field/column names as first row
      fputcsv($out, array_keys($row), ',', '"');
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }

  fclose($out);
  exit;
?>