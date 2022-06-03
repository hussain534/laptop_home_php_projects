<?php
	sessionstart();
	echo 'FB PASS';
	if(isset($_SESSION['EMAIL']))
		echo $_SESSION['EMAIL'];
	else
		echo "EMAIL NA";
?>