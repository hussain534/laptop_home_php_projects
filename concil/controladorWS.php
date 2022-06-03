<?php
	//session_start();
	class controladorWS
	{
		public function cargarTxnVentas($dbcon,$fecha_conciliacion, $id_integrador,$DEBUG_STATUS)
		{
			//LLAMAR WEB SERVICE

			$sql="select cvi.id_txn_interna, cvi.id_txn_integrador, cvi.id_integrador,cvi.id_canal,cvi.id_plan,cvi.monto,cvi.fecha_venta,cvi.fecha_conciliacion from c_ventas_interna cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') and cvi.id_integrador=".$id_integrador." and cvi.habilitado=1";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_txn_interna"],$row["id_txn_integrador"],$row["id_integrador"],$row["id_canal"],$row["id_plan"],$row["monto"],$row["fecha_venta"],$row["fecha_conciliacion"]);
					$count++;
				}
			}
			return $txn;
		}
	}
?>