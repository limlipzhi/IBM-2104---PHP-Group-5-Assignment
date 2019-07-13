<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Colorlib">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <!-- Favicons -->
    <link rel="shortcut icon" href="#">
    <!-- Page Title -->
    <title>College Finder</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
    <!-- Simple line Icon -->
    <link rel="stylesheet" href="css/simple-line-icons.css">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Hover Effects -->
    <link rel="stylesheet" href="css/set1.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
	
	<style>
		
		.form-container {
		  margin:0 auto;
		  text-align:left;
		  max-width: 350px;
		  padding: 20px;
		  max-width:400px;
		 margin-top:20px;
		 margin-bottom:10px;
		}
		.form-container .btn {
		  background-color: #4CAF50;
		  color: white;
		  padding: 16px 20px;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  margin-bottom:0px;
		  opacity: 0.8;
		}
		.form-container .btn:hover, .open-button:hover {
		  opacity: 1;
		}
		td {
		  padding: 15px;
		  text-align: left;
		}
		th {
		  padding: 15px;
		  text-align: center;
		}
	</style>
</head>

<body style="overflow-x:hidden">
    <!--============================= HEADER =============================-->
    <?php 
		
		session_start();
		include('header.php');
		include('connect.php');
		
		$conn=OpenDBCon();
		
		$sqlOpt="SELECT College_name,College_ID FROM college ORDER BY College_name";
		$resultOpt=mysqli_query($conn,$sqlOpt);
		
		if(isset($_POST['college1'])&&$_POST['college1']===''){
			$_POST['college1']=null;
		}
		if(isset($_POST['college1'])){
			$college1=$_POST['college1'];
			$sql="SELECT * FROM college WHERE College_ID=$college1";
			$result=mysqli_query($conn,$sql);
			
			$sqlRate="SELECT AVG(Rating) AS rating FROM reviews WHERE College_ID=$college1";
			$resultRate=mysqli_query($conn,$sqlRate);
		}
		if(isset($_POST['college2'])&&$_POST['college2']===''){
			$_POST['college2']=null;
		}
		if(isset($_POST['college2'])){
			$college2=$_POST['college2'];
			$sql2="SELECT * FROM college WHERE College_ID=$college2";
			$result2=mysqli_query($conn,$sql2);
			
			$sqlRate2="SELECT AVG(Rating) AS rating FROM reviews WHERE College_ID=$college2";
			$resultRate2=mysqli_query($conn,$sqlRate2);
		}
		
		function defaultCollege($college,$choice){
		if($college==$choice)
			return "selected='selected'";
		}
	?>
    <!--//END HEADER -->
    <!--============================= DETAIL =============================-->
    <section style="width:1800px;position: relative;left: 2.15%;">
        <div class="container-fluid" style="width:140%;">
            <div class="row">
                <div class="col-md-7 responsive-wrap">
                    <div class="row detail-filter-wrap">
                        <div class="col-md-8 featured-responsive">
                            <div class="detail-filter" style="margin-left:98px;">
                                <p style="font-size:40px;padding-right:53px"><b>Compare Colleges</b></p><br><br>
                                <form class="filter-dropdown" id="compareForm" action="" method="post">
									<table style="margin-left:103px">
										<tr>
											<td>
												<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="college1" style="width:500px;">
													<option value="" selected>College #1</option>
													<?php 
														while($rowOpt=mysqli_fetch_assoc($resultOpt)){
														echo "<option value='{$rowOpt['College_ID']}'";if(isset($college1)){echo defaultCollege($rowOpt['College_ID'],$college1);} echo ">{$rowOpt['College_name']}</option>";
														}
													?>	
												</select>
											</td>
											<td>
												<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect1" name="college2" style="width:500px">
													<option value="" selected>College #2</option>
													<?php 
														$sqlOpt="SELECT College_name,College_ID FROM college ORDER BY College_name";
														$resultOpt=mysqli_query($conn,$sqlOpt);
													
														while($rowOpt=mysqli_fetch_assoc($resultOpt)){
															echo "<option value='{$rowOpt['College_ID']}'";if(isset($college2)){echo defaultCollege($rowOpt['College_ID'],$college2);} echo ">{$rowOpt['College_name']}</option>";
														}
													?>
												</select>
											</td>
										</tr>
									</table>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="row light-bg detail-options-wrap" style="margin-bottom:20px;">
						<!-- Insert table here-->
						<table align="center" style="margin-top:20px;">
							<tr>
								<td>
									<?php
										if(isset($result)&&isset($result2)){
											
											$row=mysqli_fetch_assoc($result);
											$row2=mysqli_fetch_assoc($result2);
											
											$rowRate=mysqli_fetch_assoc($resultRate);
											$rowRate2=mysqli_fetch_assoc($resultRate2);
											
											$c1=explode(',',$row['Course']);
											$c2=explode(',',$row2['Course']);
											
											echo"
											<table style=\"text-align:center;\">
												<tr style='border-bottom: 1px solid #ddd;'>
													<th><h5>{$row['College_name']}</h5></th>
													<th></th>
													<th><h5>{$row2['College_name']}</h5></th>
												</tr>
												<tr style='border-bottom: 1px solid #ddd;background-color:lightgrey'>
													<td>".number_format($rowRate['rating'],1,'.','')."</td>
													<td style='font-weight:bold;text-align:center;padding-left:100px;padding-right:100px;'>Rating</td>
													<td>".number_format($rowRate2['rating'],1,'.','')."</td>
												</tr>
												<tr style='border-bottom: 1px solid #ddd;'>
													<td>RM ".number_format($row['Avg_price'],2,'.',',')."</td>
													<td style='font-weight:bold;text-align:center;padding-left:100px;padding-right:100px;'>Average Price</td>
													<td>RM ".number_format($row2['Avg_price'],2,'.',',')."</td>
												</tr>
												<tr style='border-bottom: 1px solid #ddd;background-color:lightgrey'>
													<td>{$row['College_address']}</td>
													<td style='font-weight:bold;text-align:center;padding-left:100px;padding-right:100px;'>Address</td>
													<td>{$row2['College_address']}</td>
												</tr>
												<tr style='border-bottom: 1px solid #ddd;'>
													<td>".ucfirst($row['State'])."</td>
													<td style='font-weight:bold;text-align:center;padding-left:100px;padding-right:100px;'>State</td>
													<td>".ucfirst($row2['State'])."</td>
												</tr>
												<tr style='border-bottom: 1px solid #ddd;background-color:lightgrey'>
													<td style='vertical-align:top'>";foreach($c1 as $index=>$course){echo ucfirst($course)."<br>";} echo"</td>
													<td style='font-weight:bold;text-align:center;padding-left:100px;padding-right:100px;'>Courses Offered</td>
													<td style='vertical-align:top'>";foreach($c2 as $index=>$course){echo ucfirst($course)."<br>";} echo"</td>
												</tr>
											</table>";
										}
										else
											echo "<h5 style='color:grey;margin:0 auto'>Please choose BOTH colleges to be compared.</h5>";
									?>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-container">
										<br><button type="submit" form="compareForm" class="btn" name="compareCollege" style="background-color: #4CAF50;border:2px solid #4CAF50;border-radius:15px" onclick="<script>window.location.replace('compare.php');</script>">Compare Colleges</button>
									<div>
								</td>
							</tr>
						</table>
					</div>
                </div>
            </div>
        </div>
    </section>
    <!--//END DETAIL -->
    <!--============================= FOOTER =============================-->
    <?php 
		include('footer.php');
		CloseDBCon($conn);
	?>
    <!--//END FOOTER -->




    <!-- jQuery, Bootstrap JS. -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <script>
        $(".map-icon").click(function() {
            $(".map-fix").toggle();
        });
    </script>
    <script>
        // Want to customize colors? go to snazzymaps.com
        function myMap() {
            var maplat = $('#map').data('lat');
            var maplon = $('#map').data('lon');
            var mapzoom = $('#map').data('zoom');
            // Styles a map in night mode.
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: maplat,
                    lng: maplon
                },
                zoom: mapzoom,
                scrollwheel: false
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: maplat,
                    lng: maplon
                },
                map: map,
                title: 'We are here!'
            });
        }
    </script>
    <!-- Map JS (Please change the API key below. Read documentation for more info) -->
    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyDMTUkJAmi1ahsx9uCGSgmcSmqDTBF9ygg"></script>
</body>

</html>
