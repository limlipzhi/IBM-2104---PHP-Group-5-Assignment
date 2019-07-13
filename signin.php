<?php
function signin(){
	if(isset($_POST["submitLogin"])){
		$username=$_POST["username"];
		$password=$_POST["pass"];
		$accounts=new mysqli("localhost","root","","colleges");
		if(mysqli_connect_errno()){
			echo"Failed to connect to MySQL:" .mysqli.connect_error();
		
	}
		$username=stripslashes($username);
		$password=stripslashes($password);
		
		$query="SELECT * FROM account WHERE Username='$username' and Password='$password'";
		$result=mysqli_query($accounts,$query);
		$count=mysqli_num_rows($result);
		
		if($count==1){
			session_start();
			$_SESSION["login"]=1;
			$_SESSION['username']=$username;
			$isAdmin=mysqli_fetch_assoc($result);
			if($isAdmin["Acc_type"]==0){
				$_SESSION["admin"]=1;
			}
			header("Location: indexLogged.php");
			
		}
		else {
			
			echo"<script>alert('Wrong Username or password.')</script>";
		}
		}
	else {
		$username=NULL;
		$password=NULL;
	}
}
	?>