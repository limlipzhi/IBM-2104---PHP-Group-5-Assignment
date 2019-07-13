<!DOCTYPE html>
<html lang="en">
	<?php session_start(); ?>
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
    <title>Listing &amp; Directory Website Template</title>
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
    <!-- Swipper Slider -->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
	.modal {
	  display: none; /* Hidden by default */
	  z-index: 1; /* Sit on top */
	  margin:0 auto;
	  left: 0;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	  padding-top: 60px;
	}
	.modal-content {
	  background-color: #fefefe;
	  margin: 100px auto; /* 15% from the top and centered */
	  border: 1px solid #888;
	  border-radius:15px;
	  width: 40%; /* Could be more or less, depending on screen size */
	}

	/* The Close Button */
	.close {
	  /* Position it in the top right corner outside of the modal */
	  position: absolute;
	  right: 0px;
	  top: 0; 
	  color: #000;
	  font-size: 35px;
	  font-weight: bold;
	}

	/* Close button on hover */
	.close:hover,
	.close:focus {
	  color: red;
	  cursor: pointer;
	}

	/* Add Zoom Animation */
	.animate {
	  -webkit-animation: animatezoom 0.6s;
	  animation: animatezoom 0.6s
	}

	@-webkit-keyframes animatezoom {
	  from {-webkit-transform: scale(0)} 
	  to {-webkit-transform: scale(1)}
	}

	@keyframes animatezoom {
	  from {transform: scale(0)} 
	  to {transform: scale(1)}
	}
	*{
    margin: 0;
    padding: 0;
	}
	.rate {
		float: left;
		height: 46px;
		padding: 0 10px;
	}
	.rate:not(:checked) > input {
		position:absolute;
		top:-9999px;
	}
	.rate:not(:checked) > label {
		float:right;
		width:1em;
		overflow:hidden;
		white-space:nowrap;
		cursor:pointer;
		font-size:30px;
		color:#ccc;
	}
	.rate:not(:checked) > label:before {
		content: '★ ';
	}
	.rate > input:checked ~ label {
		color: #ffc700;    
	}
	.rate:not(:checked) > label:hover,
	.rate:not(:checked) > label:hover ~ label {
		color: #deb217;  
	}
	.rate > input:checked + label:hover,
	.rate > input:checked + label:hover ~ label,
	.rate > input:checked ~ label:hover,
	.rate > input:checked ~ label:hover ~ label,
	.rate > label:hover ~ input:checked ~ label {
		color: #c59b08;
	}

</style>

<body>
    <!--============================= HEADER =============================-->
		<?php include('header.php');?>
    <!--//END HEADER -->
	
	
    <!--============================= BOOKING =============================-->
    <?php
		include('connect.php');
		include('saveReview.php');
		
		$conn=OpenDBCon();
		
		$collegeID=$_GET['collegeID'];
		
		$sql="SELECT * FROM college WHERE College_ID=".$collegeID;
		if($result=mysqli_query($conn,$sql)){
			while($row=mysqli_fetch_assoc($result)){
				echo"<div>
				<!-- Swiper -->
					<div class=\"swiper-container\" style=\"background:#94989e\">
						<a href=\"{$row['College_img']}\" class=\"grid image-link\">
							<img src=\"{$row['College_img']}\" class=\"img-fluid\" alt=\"#\" width=\"600\" style=\"position:relative;left:28%;\">
						</a>
					</div>
				</div>
				<!--//END BOOKING -->
				<!--============================= RESERVE A SEAT =============================-->";
	
				echo" <section class=\"reserve-block\">";
					echo" <div class=\"container\">";
						echo" <div class=\"row\">";
							echo" <div class=\"col-md-6\" style=\"margin-top:15px\">";
								echo" <h5>{$row['College_name']}</h5>";
								
								if($row['Avg_price']<=10000)
									echo "<p><span>$</span>$$$$</p>";
								else if($row['Avg_price']<=25000)
									echo "<p><span>$$</span>$$$</p>";
								else if($row['Avg_price']<=35000)
									echo "<p><span>$$$</span>$$</p>";
								else if($row['Avg_price']<=50000)
									echo "<p><span>$$$$</span>$</p>";
								else
									echo "<p><span>$$$$$</span></p>";
								
							echo" </div>";
							echo" <div class=\"col-md-6\">";
								echo" <div class=\"reserve-seat-block\">";
									echo" <div class=\"reserve-rating\">";
										$sql2="SELECT AVG(rating) AS rating,COUNT(DISTINCT Review_ID) AS numReview FROM Reviews WHERE College_ID=".mysqli_real_escape_string($conn,$row['College_ID']);
										//exit($sql2);
										$result2=mysqli_query($conn,$sql2);
										$rating=mysqli_fetch_assoc($result2);
										$format_rating=number_format($rating['rating'],1,'.','');
										echo "<span>$format_rating</span>";
									echo" </div>";
									echo" <div class=\"review-btn\">";
										echo" <a href=\"#\" class=\"btn btn-outline-danger\" onclick=\"document.getElementById('id01').style.display='block'\">WRITE A REVIEW</a>";
										echo" <span>{$rating['numReview']} reviews</span>";
									echo" </div>";	
								echo" </div>";
							echo" </div>";
						echo" </div>";
					echo" </div>";
				echo "</section>";
				echo "<!--//END RESERVE A SEAT -->";
				echo "<!--============================= BOOKING DETAILS =============================-->";
				echo "<section class=\"light-bg booking-details_wrap\">";
					echo "<div class=\"container\">";
						echo "<div class=\"row\">";
							echo "<div class=\"col-md-8 responsive-wrap\">";
								echo "<div class=\"booking-checkbox_wrap\">";
									echo "<div class=\"booking-checkbox\">";
										echo "<p>{$row['College_description']}</p>";
										echo "<hr>";
									echo "</div>";
									
									$courses=array();
									$courses=explode(",",$row['Course']);
									
									echo "<b style=\"font-size:18px;padding-left:265px;\">Courses Offered</b>";
									foreach($courses as $index=>$course){
										echo "<div class=\"row\">";
											echo "<div class=\"col-md-4\">";
												echo "<label class=\"custom-checkbox\">";
													echo "<span class=\"ti-check-box\"></span>";
													echo "<span class=\"custom-control-description\">".strtoupper($course)."</span>";
												echo "</label> ";
											echo "</div>";
										echo "</div>";
									}
								echo "</div>";
								echo "<div class=\"booking-checkbox_wrap mt-4\">";
									echo "<h5>{$rating['numReview']} Reviews</h5>";
									
									
									
									$sql3="SELECT Reviews.*,account.F_name,account.L_name FROM Reviews,account WHERE Reviews.College_ID=".mysqli_real_escape_string($conn,$row['College_ID'])." AND Reviews.Acc_ID=account.Acc_ID ORDER BY Timestamp;";
									$result3=mysqli_query($conn,$sql3);
									while($row2=mysqli_fetch_assoc($result3)){
										echo "<div class=\"customer-review_wrap\">";
											echo "<hr>";
											echo "<div class=\"customer-img\">";
												echo "<img src=\"images/customerImg.jpg\" class=\"img-fluid\" alt=\"#\" width=90px>";
												echo "<p>{$row2['F_name']} {$row2['L_name']}</p>";
											echo "</div>";
											echo "<div class=\"customer-content-wrap\">";
												echo "<div class=\"customer-content\">";
													echo "<div class=\"customer-review\">";
														echo "<h6>{$row2['Review_title']}</h6>";
														
														if($row2['Rating']<=2){
															echo "<span class=\"customer-rating-red\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
														}
														else if($row2['Rating']<=4){
															echo "<span class=\"customer-rating-red\"></span>";
															echo "<span class=\"customer-rating-red\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
														}
														else if($row2['Rating']<=6){
															echo "<span class=\"customer-rating-red\"></span>";
															echo "<span class=\"customer-rating-red\"></span>";
															echo "<span class=\"customer-rating-red\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
														}
														else if($row2['Rating']<=8){
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"round-icon-blank\"></span>";
														}
														else if($row2['Rating']<=10){
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
															echo "<span class=\"customer-rating-green\"></span>";
														}
														
														echo "<p>Reviewed on {$row2['Timestamp']}</p>";
													echo "</div>";
													
													if($row2['Rating']<=6){
														echo "<div class=\"customer-rating customer-rating-red\">";
															echo number_format($row2['Rating'],1,".","");
														echo "</div>";
													}
													else{
														echo "<div class=\"customer-rating customer-rating-green\">";
															echo number_format($row2['Rating'],1,".","");
														echo "</div>";
													}
													
												echo "</div>";
												echo "<p class=\"customer-text\">{$row2['Comment']}</p>";
											echo "</div>";
										echo "</div>";
									}	
									
								echo "</div>";
							echo "</div>";
							
							echo "<div class=\"col-md-4 responsive-wrap\" >";
								echo "<div class=\"contact-info\">";
									echo "<h5 style=\"color:grey;text-align:center;padding-top:20px\">Relevant Information</h5>";
									echo "<div class=\"address\">";
										echo "<span class=\"icon-location-pin\"></span>";
										echo "<p>{$row['College_address']}</p>";
									echo "</div>";
									echo "<div class=\"address\">";
										echo "<span class=\"icon-screen-smartphone\"></span>";
										echo "<p> +{$row['Colleges_phone']}</p>";
									echo "</div>";
									echo "<div class=\"address\">";
										echo "<span class=\"icon-link\"></span>";
										echo "<p style=\"padding-bottom:20px;\">{$row['College_site']}</p>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				echo "</section>";
			}
		}
		
		CloseDBCon($conn);
	?> 
	
	<!--Popup Write Review-->
	<div id="id01" class="modal">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<form class="modal-content animate" action="" method="post">
			<div class="imgcontainer">
			  <img src="images/reviewIcon.jpg" alt="Avatar" class="avatar" width=80px style="margin-top:20px;margin-left:10px;float:left">
			  <h5 style="padding-top:27px">Write a Review</h5>
			</div>
			
			<div class="container" style="margin-left:85px;margin-top:30px">
				<label for="rating"><b>Rating</b></label><br>
				<div class="rate" style="position:absolute;left:24%" required>
					<input type="radio" id="star10" name="rate" value="10" checked=checked>
						<label for="star10">10 stars</label>
					<input type="radio" id="star9" name="rate" value="9" >
						<label for="star9">9 stars</label>
					<input type="radio" id="star8" name="rate" value="8" >
						<label for="star8">8 stars</label>
					<input type="radio" id="star7" name="rate" value="7" >
						<label for="star7">7 stars</label>
					<input type="radio" id="star6" name="rate" value="6" >
						<label for="star6">6 star</label>
					<input type="radio" id="star5" name="rate" value="5" >
						<label for="star5">5 stars</label>
					<input type="radio" id="star4" name="rate" value="4" >
						<label for="star4">4 stars</label>
					<input type="radio" id="star3" name="rate" value="3">
						<label for="star3">3 stars</label>
					<input type="radio" id="star2" name="rate" value="2" >
						<label for="star2">2 stars</label>
					<input type="radio" id="star1" name="rate" value="1" >
						<label for="star1">1 star</label>
				</div><br><br><br>
				
				<label for="review_title"><b>Review Title</b></label><br>
					<input type="text" placeholder="Enter Review Title" name="title" size="50" required><br><br>

				<label for="comment"><b>Your Review</b></label><br>
					<textarea placeholder="Type your review here." name="review" rows="10" cols="50" required></textarea><br><br>
			</div>
			
			<table style="margin-left:108px;margin-bottom:20px">
				<tr>
					<td>
						<button type="submit" style="border:3px solid #2e9e25;background-color:#2e9e25;width:150px;height:40px;border-radius:15px;font-family:Roboto;font-size:20px;color:white;"><b>Submit<b></button>
					</td>
					<td>
						<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" 		
						style="border:3px solid #db2818;background-color:#db2818;width:150px;height:40px;border-radius:15px;font-family:Roboto;font-size:20px;color:white;"><b>Cancel<b></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<!--End Write Review-->
	
	<?php saveReview(); ?>
	
    <!--//END BOOKING DETAILS -->
    <!--============================= FOOTER =============================-->
		<?php include('footer.php');?>
    <!--//END FOOTER -->




    <!-- jQuery, Bootstrap JS. -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Magnific popup JS -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- Swipper Slider JS -->
    <script src="js/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    <script>
        if ($('.image-link').length) {
            $('.image-link').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
        if ($('.image-link2').length) {
            $('.image-link2').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
    </script>
</body>

</html>
