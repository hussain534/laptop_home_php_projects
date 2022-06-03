<?php
// Connect to MySQL
$link = mysqli_connect('localhost','merakiprod01','merakiprod01','merakipm') or die('Error:DB Connect error.');//IP,user,pwd,db

// Fetch the data
$query = "
  SELECT '2013-08-24' category, '417' value1, '127' value2 
  FROM dual";
$result = mysqli_query($link,$query);

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . $link->error . "n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Set proper HTTP response headers
header( 'Content-Type: application/json' );

// Print out rows
$data = array();
while ( $row = mysqli_fetch_assoc($result) ) {
  $data[] = $row;
}
echo json_encode( $data );

// Close the connection
mysqli_close($link);
?>