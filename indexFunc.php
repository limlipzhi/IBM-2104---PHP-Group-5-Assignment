<?php
	$accounts=new mysqli("localhost","root","","colleges");
	if(mysqli_connect_errno()){
		echo"Failed to connect to MySQL:" .mysqli.connect_error();
		
	}
	$query="SELECT * FROM college WHERE State='penang'";
	$result=mysqli_query($accounts,$query);
	$countPenang=mysqli_num_rows($result);
	$query="SELECT * FROM college WHERE State='kedah'";
	$result=mysqli_query($accounts,$query);
	$countKedah=mysqli_num_rows($result);
	$query="SELECT * FROM college WHERE State='kuala lumpur'";
	$result=mysqli_query($accounts,$query);
	$countKL=mysqli_num_rows($result);
	$query="SELECT * FROM college WHERE State='johor'";
	$result=mysqli_query($accounts,$query);
	$countJohor=mysqli_num_rows($result);
	$query="SELECT * FROM college WHERE State='kelantan'";
	$result=mysqli_query($accounts,$query);
	$countKelantan=mysqli_num_rows($result);
	
	function destroySession(){
		session_destroy();
	}
		
	
	
	?>