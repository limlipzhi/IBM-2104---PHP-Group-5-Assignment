<?php
		function saveReview(){
			$conn=OpenDBCon();
			if(isset($_POST['rate'])&&isset($_POST['title'])&&isset($_POST['review'])){
				$rating=$_POST['rate'];
				$title=$_POST['title'];
				$review=$_POST['review'];
				$collegeID=$_GET['collegeID'];
				
				$sql="SELECT Acc_ID FROM account WHERE Username='".$_SESSION['username']."'";
				//exit($sql);
				$result=mysqli_query($conn,$sql);
				$accId=mysqli_fetch_assoc($result);
				
				$sql="INSERT INTO reviews (Acc_ID,Comment,Rating,College_ID,Review_title) VALUES({$accId['Acc_ID']},'$review','$rating','$collegeID','$title');";
				//exit($sql);
				mysqli_query($conn,$sql);
				
				echo "<script>window.location.replace(\"detail.php?collegeID=$collegeID\");</script>";
			}
			CloseDBCon($conn);
		}
	?>