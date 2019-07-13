<?php
if(isset($_POST["addCollege"])){
$college_name=$_POST["college_name"];
$college_phone=$_POST["college_phone"];
$college_site=$_POST["college_site"];
$college_state=$_POST["college_state"];
$college_course=array();
$college_course=$_POST["college_course"];
$course=implode(",",$college_course);
$college_img=$_POST["college_img"];
$college_address=$_POST["college_address"];
$college_description=$_POST["college_description"];
$college_price=$_POST["college_price"];
$accounts=new mysqli("localhost","root","","colleges");
	if(mysqli_connect_errno()){
		echo"Failed to connect to MySQL:" .mysqli.connect_error();
		
	}
$query=mysqli_query($accounts,"SELECT * FROM college WHERE College_name='$college_name'");
		if(mysqli_num_rows($query)>0){
			echo"<script> alert('This college name is already in database.')</script>";
		}
		else{
			$sql="INSERT INTO college(College_name,Colleges_phone,College_address,College_site,College_description,State,Course,College_img,Avg_price)
			VALUES('$college_name','$college_phone','$college_address','$college_site',\"$college_description\",'$college_state','$course','$college_img',$college_price)";
			if(mysqli_query($accounts,$sql))
				echo "<script>alert('Add successful')</script>";
			else
				echo "<script> alert('Add Failed!')</script>";
			
			
		}

}
else{
	$college_name=NULL;
	$college_phone=NULL;
	$college_site=NULL;
	$college_state=NULL;
	$college_course=NULL;
	$college_img=NULL;
	$college_address=NULL;
	$college_description=NULL;
}
	
?>