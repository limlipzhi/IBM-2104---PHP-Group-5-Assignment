<?php

function signup(){
	$accounts=new mysqli("localhost","root","","colleges");
	if(mysqli_connect_errno()){
		echo"Failed to connect to MySQL:" .mysqli.connect_error();
		
	}
	if(isset($_POST["submit"])){
		$username=$_POST["username"];
		$password=$_POST["pass"];
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$query=mysqli_query($accounts,"SELECT * FROM account WHERE Username='$username'");
		if(mysqli_num_rows($query)>0){
			echo"<script> alert('Username Taken')</script>";
		}
		else{
			$sql="INSERT INTO account(Username,Password,F_name,L_name,Acc_type) VALUES(\"$username\",$password,\"$fname\",\"$lname\",1)";

			mysqli_query($accounts,$sql);
			header("Location: signin2.php?success=1");
			
		}
	}
	else{
		$username=NULL;
		$password=NULL;
		$fname=NULL;
		$lname=NULL;
		
	}
		
}

?>