<html>
	<?php
		session_start();
	?>
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
	</head>

	<body style="overflow-x:hidden">
		<!--============================= HEADER =============================-->
		<?php include('header.php');?>
		<!--//END HEADER -->
		<!--============================= DETAIL =============================-->
		<section  style="width:1800px;position: relative;left: 13.75%;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-7 responsive-wrap">
						<div class="row detail-filter-wrap">
							<?php
								echo "<div class=\"col-md-4 featured-responsive\">";
									
								include 'connect.php';
								include 'listingFilter.php';
								include 'printListing.php';
								
								$conn=OpenDBCon();
								
								
								if(isset($_POST['state'])&&$_POST['name']==""){
									$sql="SELECT * FROM college WHERE State=\"".$_POST['state']."\" ORDER BY College_name";
									//exit($sql);
								}
								else if(isset($_POST['name'])&&$_POST['state']=="none"){
									$sql="SELECT * FROM college WHERE College_name LIKE \"%".$_POST['name']."%\" ORDER BY College_name";
									//exit($sql);
								}
								else if(isset($_POST['state'])&&isset($_POST['name'])){
									$sql="SELECT * FROM college WHERE College_name LIKE \"%".$_POST['name']."%\" AND State=\"".$_POST['state']."\" ORDER BY College_name";
									//exit($sql);
								}
								else if(isset($_GET['state'])){
									$sql="SELECT * FROM college WHERE State=\"".$_GET['state']."\" ORDER BY College_name";
									//exit($sql);
								}
								else if(isset($_GET['course'])){
									$sql="SELECT * FROM college WHERE Course LIKE \"%".$_GET['course']."%\" ORDER BY College_name";
								}
								else
									$sql=listingFilter($conn);
								
								echo "<div class=\"detail-filter-text\">";
								echo "<p>Results For <span>Colleges.</span></p>";
								echo "</div>";
								echo "</div>";
								echo "<div class=\"col-md-8 featured-responsive\">";
									echo "<div class=\"detail-filter\">";
										echo "<p>Filter by</p>";
										
										if(isset($_POST['location']))
											$location=$_POST['location'];
										else
											$location="all";
										
										if($location=="all")
											$default1=array("selected='selected'","","","","","");
										else if($location=="johor")
											$default1=array("","selected='selected'","","","","");
										else if($location=="kedah")
											$default1=array("","","selected='selected'","","","");
										else if($location=="kelantan")
											$default1=array("","","","selected='selected'","","");
										else if($location=="kl")
											$default1=array("","","","","selected='selected'","");
										else if($location=="penang")
											$default1=array("","","","","","selected='selected'");
										
										if(isset($_POST['course']))
											$course=$_POST['course'];
										else
											$course="all";
										
										if($course=="all")
											$default2=array("selected='selected'","","","","","","","","");
										else if($course=="business")
											$default2=array("","selected='selected'","","","","","","","");
										else if($course=="culinary")
											$default2=array("","","selected='selected'","","","","","","");
										else if($course=="engineering")
											$default2=array("","","","selected='selected'","","","","","");
										else if($course=="hospitality")
											$default2=array("","","","","selected='selected'","","","","");
										else if($course=="IT")
											$default2=array("","","","","","selected='selected'","","","");
										else if($course=="philosophy")
											$default2=array("","","","","","","selected='selected'","","");
										else if($course=="management")
											$default2=array("","","","","","","","selected='selected'","");
										else if($course=="science")
											$default2=array("","","","","","","","","selected='selected'");
										
										echo "<form class=\"filter-dropdown\" id=\"FilterForm\" action=\"\" method=\"post\">";
											echo "<select class=\"custom-select mb-2 mr-sm-2 mb-sm-0\" id=\"inlineFormCustomSelect\" name=\"location\" onchange=\"document.getElementById('FilterForm').submit();\">";
											  echo "<option $default1[0] value=\"all\">Location</option>";
											  echo "<option $default1[1] value=\"johor\">Johor</option>";
											  echo "<option $default1[2] value=\"kedah\">Kedah</option>";
											  echo "<option $default1[3] value=\"kelantan\">Kelantan</option>";
											  echo "<option $default1[4] value=\"kl\">Kuala Lumpur</option>";
											  echo "<option $default1[5] value=\"penang\">Penang</option>";
											echo "</select>";
											echo "<select class=\"custom-select mb-2 mr-sm-2 mb-sm-0\" id=\"inlineFormCustomSelect1\" name=\"course\" onchange=\"document.getElementById('FilterForm').submit();\">";
											  echo "<option $default2[0] value=\"all\">Course Offered</option>";
											  echo "<option $default2[1] value=\"business\">Business</option>";
											  echo "<option $default2[2] value=\"culinary arts\">Culinary Arts</option>";
											  echo "<option $default2[3] value=\"engineering\">Engineering</option>";
											  echo "<option $default2[4] value=\"hospitality\">Hospitality</option>";
											  echo "<option $default2[5] value=\"it\">IT</option>";
											  echo "<option $default2[6] value=\"literature\">Literature</option>";
											  echo "<option $default2[7] value=\"management\">Management</option>";
											  echo "<option $default2[8] value=\"science\">Science</option>";
											echo "</select>";
											echo "<input type=\"submit\" value=\"Filter\">";
										echo "</form>";
									echo "</div>";
								echo "</div>";
								echo "</div>";
							echo "<div class=\"row light-bg detail-options-wrap\" style=\"margin-bottom:20px\">";
							printListing($conn,$sql);
							CloseDBCon($conn);
							?>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--//END DETAIL -->
		<!--============================= FOOTER =============================-->
			<?php include('footer.php');?>
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
