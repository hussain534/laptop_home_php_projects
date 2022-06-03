<?php
require('fpdf.php');

//Connect to your database

include_once('config.php');	

//Select the Products you want to show in your PDF file



//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_price = "";
$total = 0;
/*$sql="select '10' id,'ABC' nombre ,'1234567890' telefono from dual";
$result = mysqli_query($databasecon,$sql);
$number_of_products = mysqli_num_rows($result);
if(mysqli_num_rows($result) > 0)  
{
	while($row = mysqli_fetch_assoc($result))
	{
		$code = $row["id"];
		$name = $row["nombre"];
		$real_price = $row["telefono"];

		$column_code = $column_code.$code."\n";
		$column_name = $column_name.$name."\n";
		$column_price = $column_price.$real_price."\n";
	}
}*/

$pdf=new FPDF();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(34,138,199);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(10,6,'ID',1,0,'L',1);
$pdf->SetX(15);
$pdf->Cell(100,6,'NAME',1,0,'L',1);
$pdf->SetX(115);
$pdf->Cell(30,6,'TELEFONO',1,0,'R',1);
$pdf->Ln();
$ctr=0;
while($ctr<10)
{
	$code = '11';
	$name = 'ABC';
	$telefono = '9999999999';

	//Now show the 3 columns
	$pdf->SetFont('Arial','',12);
	$pdf->SetY($Y_Table_Position);
	$pdf->SetX(5);
	$pdf->MultiCell(10,6,$code,1);
	$pdf->SetY($Y_Table_Position);
	$pdf->SetX(15);
	$pdf->MultiCell(100,6,$name,1);
	$pdf->SetY($Y_Table_Position);
	$pdf->SetX(115);
	$pdf->MultiCell(30,6,$telefono,1,'R');
	$ctr++;
}





//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
/*$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
	$pdf->SetX(5);
	$pdf->MultiCell(140,6,'',1);
	$i = $i +1;
}*/

$pdf->Output();
?>
