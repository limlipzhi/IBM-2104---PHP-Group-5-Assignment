<?php
	session_start();
	$_SESSION=array();
	session_destroy();
	
	echo "<script>window.location.replace(\"indexLogged.php\");</script>";
?>