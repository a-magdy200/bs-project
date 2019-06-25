<?php
session_start();
require_once "partials/init.php";
$title = "homepage";
require_once "partials/headers.php";
?>

		<!--Start Carousel-->
		<div id="myslide" class="carousel slide" data-ride="carousel">
			  <!-- Indicators: the circle that changes color when its slide is showing 0,1,2 'cause three slides with three circles-->

			<ol class="carousel-indicators">
				<li data-target="#myslide" data-slide-to="0" class="active">
				</li> 
				<li data-target="#myslide" data-slide-to="1">
				</li>
				<li data-target="#myslide" data-slide-to="2">
				</li>
			</ol>					

			  <!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
			  		<img class="img-responsive center-block" src="<?php echo $images_path?>/slide1.jpg">
			  		<div class="carousel-caption">
			  			<div>
			  				<img class="img-responsive center-block" src="<?php echo $images_path?>/DSHELDON.png" style="position: absolute; top:-400px; left: 200px; height: 95px;">
			  			</div>
			    	    <div>
			    	    	<p style="position: absolute; top: -320px; left: 270px; font-size: 18px;">
			    	    		A community of dedicated learners.
			    	    	</p>
			    	    </div>
                        <?php if (!isset($_SESSION['user'])) { ?>
						<div style="position: absolute;top:-250px; left:210px;width: 400px;">
							<button type="button" class="btn btn-warning btn-lg btn-block" onclick="location.href='signup.php'">Sign Up</button>
							<button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='login.php'">Log In</button>
						</div>
                        <?php } ?>
			    	</div>
			    </div>
			    <div class="item">
			    	<img class="img-responsive center-block" src="<?php echo $images_path?>/slide2.jpg">
			    	<div class="carousel-caption">
			    	    <p style="position: absolute; top: -350px; left: 30px; font-size: 18px;background-color: rgba(0,0,0,0.6);padding:50px;">
			    	    	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			    	    </p>
			    	</div>
			    </div>
			    <div class="item">
			    	<img class="img-responsive center-block" src="<?php echo $images_path?>/slide3.jpg">
			    	<div class="carousel-caption">
			    	    <div>
			  				<h1 style="position: absolute; top: -365px; left: 210px; height: 95px;">
			  					Now you're all cought up,
			  				</h1>
			  			</div>
			  			<div>
			    	    	<p style="position: absolute; top: -295px; left: 320px; font-size: 18px;">
			    	    		join to our community.
			    	    	</p>
			    	    </div>`
                        <?php if (!isset($_SESSION['user'])) { ?>
						<div style="position: absolute;top:-250px; left:210px;width: 400px;">
							<button type="button" class="btn btn-warning btn-lg btn-block" onclick="location.href='signup.php'" >Sign Up</button>
							<button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='login.php'">Log In</button>
						</div>
                        <?php } ?>
			    	</div>
			    </div>
			</div>
		</div>
		<!--End Carousel-->
<?php require_once "partials/footer.php";
