<?php
echo 'FB FAIL';
if(isset($_SESSION['EMAIL']))
	echo $_SESSION['EMAIL'];
else
	echo "EMAIL NA";
?>