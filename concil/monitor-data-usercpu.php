<?php
//setting header to json
session_start();
header('Content-Type: application/json');


include_once('config.php');




$sql="select md.data_entry_time,ROUND(md.data,2) stat from mon_data md, mon_param mp, mon_servers ms, mon_server_param_rn sp, server_types st
        where sp.id_mon_param =4 and md.data_2='USER_CPU'
        and md.server_param_rn_id=sp.id
        and sp.id_server=ms.id
        and sp.id_mon_param=mp.id
        and ms.server_type=st.id
        and md.enabled=1
        order by md.data_entry_time  desc limit 20";
//execute query
$result = mysqli_query($mon_databasecon,$sql);

//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

//now print the data
print json_encode($data);
