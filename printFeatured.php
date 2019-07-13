<?php
function printFeatured(){
			$accounts=new mysqli("localhost","root","","colleges");
	if(mysqli_connect_errno()){
		echo"Failed to connect to MySQL:" .mysqli.connect_error();
		
	}
	$query="SELECT  College_ID FROM reviews GROUP BY College_ID ORDER BY AVG(Rating) DESC";
			$result=mysqli_query($accounts,$query);
			
			for($i=0;$i<3&&$row=mysqli_fetch_assoc($result);$i++){
				$query="SELECT * FROM college WHERE College_ID=".mysqli_real_escape_string($accounts,$row['College_ID'])." ORDER BY College_name";
				$result2=mysqli_query($accounts,$query);
				
				$row2=mysqli_fetch_assoc($result2);
				
				$query="SELECT AVG(Rating)AS Rating,COUNT(DISTINCT Acc_ID) AS numReview FROM reviews WHERE College_ID="
				.mysqli_real_escape_string($accounts,$row['College_ID']);
				
				$result3=mysqli_query($accounts,$query);
				
				$row3=mysqli_fetch_assoc($result3);
				
				echo "
				<div class=\"col-md-4 featured-responsive\">
                    <div class=\"featured-place-wrap\" style=margin-right:-10px;margin-left:-15px;>
                        <a href=\"detail.php?collegeID={$row['College_ID']}\">
                            <img src=\"{$row2['College_img']}\" class=\"img-fluid\" alt=\"#\">";
							
							if($row3['Rating']<5)
								echo"<span class=\"featured-rating\" style=postition:absolute;top:56%>".number_format($row3['Rating'],1,'.','')."</span>";
							else if($row3['Rating']<7.5)
								echo"<span class=\"featured-rating-orange\"style=postition:absolute;top:56%>".number_format($row3['Rating'],1,'.','')."</span>";
							else
								echo"<span class=\"featured-rating-green\"style=postition:absolute;top:56%>".number_format($row3['Rating'],1,'.','')."</span>";
							
                            echo "<div class=\"featured-title-box\">
                                <h6>{$row2['College_name']}</h6>
                                <p>".substr($row2['Course'],0,10)."</p> <span>• </span>
                                <p>{$row3['numReview']} Reviews</p> <span> • </span>
                                <p><span>$$$</span>$$</p>
                                <ul>
                                    <li><span class=\"icon-location-pin\"></span>
                                        <p>{$row2['College_address']}</p>
                                    </li>
                                    <li><span class=\"icon-screen-smartphone\"></span>
                                        <p>+{$row2['Colleges_phone']}</p>
                                    </li>
                                    <li><span class=\"icon-link\"></span>
                                        <p>{$row2['College_site']}</p>
                                    </li>

                                </ul>
                                <div class=\"bottom-icons\">
                                    
                                    <span class=\"ti-heart\"></span>
                                    <span class=\"ti-bookmark\"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>";
		}

	}
	?>