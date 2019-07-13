<div class="dark-bg sticky-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light">
					<a class="navbar-brand" href="indexLogged.php" style=font-family:"Times New Roman">College Finder</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="icon-menu"></span>
		</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="listingPage.php">Listing</a>
							</li>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="compare.php">Compare</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Blog</a>
							</li>
							<li><a href="#" class="btn btn-outline-light top-btn"><img style=width:20px;margin-right:10px; src="images/user-icon.png" ><?php 
								if(isset($_SESSION['username']))
									echo $_SESSION['username'];
								else
									echo "Anonymous";
							?></a></li>
							<li style="margin-left:15px"><a href="logout.php" class="btn btn-outline-light top-btn">Log Out</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>