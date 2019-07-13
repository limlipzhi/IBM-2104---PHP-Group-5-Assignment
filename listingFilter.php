<?php
	function listingFilter($conn){
		if(isset($_POST['location']))
			$location=$_POST['location'];
		else
			$location="all";
		
		if(isset($_POST['course']))
			$course=$_POST['course'];
		else
			$course="all";
		
		$condition=array();
		
		if($location!="all"){
			$condition[0]="State=\"$location\"";
			$noCondition=false;
		}
		else{
			$noCondition=true;
		}
		
		if($course!="all"){
			$condition[1]="Course LIKE \"%$course%\"";
			$noCondition2=false;
		}
		else{
			$noCondition2=true;
		}
		
		if($noCondition&&$noCondition2){
			$where="";
			$sql="SELECT * FROM college ORDER BY College_name;";
			
		}
		else{
			$where="WHERE ".implode(' AND ',$condition);
			//echo $where;
			$sql="SELECT * FROM college ".$where." ORDER BY College_name";
			//echo $sql;
		}
		
		return $sql;
	}
?>