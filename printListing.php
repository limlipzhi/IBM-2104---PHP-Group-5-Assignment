<?php
	function printListing($conn,$sql){
		
		if($result=mysqli_query($conn,$sql)){
			while($row=mysqli_fetch_assoc($result)){
				echo "<div class=\"col-sm-6 col-lg-12 col-xl-6 featured-responsive\">";
					echo "<div class=\"featured-place-wrap\">";
							echo "<a href=\"detail.php?collegeID={$row['College_ID']}\">";
							echo "<img src=\"{$row['College_img']}\" class=\"img-fluid\" alt=\"#\">";
							
							$sql2="SELECT AVG(rating) AS rating,COUNT(DISTINCT Review_ID) AS numReview FROM Reviews WHERE College_ID=".mysqli_real_escape_string($conn,$row['College_ID']);
							//exit($sql2);
							$result2=mysqli_query($conn,$sql2);
							$rating=mysqli_fetch_assoc($result2);
							if($rating['rating']<5){
								$format_rating=number_format($rating['rating'],1,'.','');
								echo "<span class=\"featured-rating \" style=\"position:absolute;top:63%;\">$format_rating</span>";
							}
							else if($rating['rating']<7.5){
								$format_rating=number_format($rating['rating'],1,'.','');
								echo "<span class=\"featured-rating-orange \" style=\"position:absolute;top:63%;\">$format_rating</span>";
							}
							else{
								$format_rating=number_format($rating['rating'],1,'.','');
								echo "<span class=\"featured-rating-green \" style=\"position:absolute;top:63%;\">$format_rating</span>";
							}
							
							echo "<div class=\"featured-title-box\">";
								echo "<h6>{$row['College_name']}</h6>";
								echo "<p>{$row['Course']} </p> <span>• </span>";
								echo "<p>{$rating['numReview']} Reviews</p> <span> • </span>";
								
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
									
								echo "<ul>";
									echo "<li><span class=\"icon-location-pin\"></span>";
										echo "<p>{$row['College_address']}</p>";
									echo "</li>";
									echo "<li><span class=\"icon-screen-smartphone\"></span>";
										echo "<p>+{$row['Colleges_phone']}</p>";
									echo "</li>";
									echo "<li><span class=\"icon-link\"></span>";
										echo "<p>{$row['College_site']}</p>";
									echo "</li>";

								echo "</ul>";
									echo " <div class=\"bottom-icons\">";
										echo " <span class=\"ti-heart\"></span>";
										echo " <span class=\"ti-bookmark\"></span>";
									echo "</div>";
								echo "</div>";
							echo "</a>";
					echo "</div>";
				echo "</div>";
			}
		}
		else
			echo "result got problem";
	}
?>