<?php
	function OpenDBCon(){
		$dbhost="localhost";
		$dbuser="root";
		$dbpass="";
		$db="colleges";
		
		$conn=new mysqli($dbhost,$dbuser,$dbpass,$db) or die("Could not connect:".mysqli_error());
		
		return $conn;
	}
	
	function CloseDBCon($conn){
		$conn->close();
	}
?>