<?php
$line_data="10100007,MOVILWAY_BATCH1_30042019,WIFI PREPAGO $1.00,2,2019-06-10,,Active,1_PRUEBAS,5799,1.00,1718,10-0002, 4415634";
$lineDataValues=explode(",",$line_data);
$sql="insert into c_ventas_etapa(VoucherId,Batch,OfferDesc,Location,CreateDate,UsedDate,Status,Id_integrador,Prefix,OfferCode,OfferPrice,InvoiceId,
                                TransactionId,CustomerCode,forma_de_carga,habilitado) values('".$lineDataValues[0]."','".$lineDataValues[1]."','".$lineDataValues[2]."',
                                    ".$lineDataValues[3].",'".$lineDataValues[4]."','".$lineDataValues[5]."','".$lineDataValues[6]."',".explode("_",$lineDataValues[7])[0].",'".$lineDataValues[7]."',
                                    ".$lineDataValues[8].",".$lineDataValues[9].",'".$lineDataValues[10]."','".$lineDataValues[11]."','".$lineDataValues[12]."',2,1)";

                        echo 'VENTAS SQL::'.$sql.'<br>';
?>