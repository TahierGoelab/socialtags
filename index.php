<?php
include "header.php"; ?>
		<div id="fh5co-hero">
			<a href="#fh5co-main" class="smoothscroll fh5co-arrow to-animate hero-animate-4"><i class="ti-angle-down"></i></a>
			<!-- End fh5co-arrow -->
			<div class="container">
				<div class="col-md-8 col-md-offset-2">
					<div class="fh5co-hero-wrap">
						<div class="fh5co-hero-intro">
							<h1 class="to-animate hero-animate-1">SocialTags. <?php echo $title_message; ?></h1>
							<h2 class="to-animate hero-animate-2"><?php echo $made_by; ?> <a href="http://linga.nl" target="_blank">Linga</a></h2>
							<?php
if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == "1") {
?> <p class="to-animate hero-animate-3"><a href="boards.php" class="btn btn-outline btn-lg">Mijn Boards</a></p><?php
} else { ?><p class="to-animate hero-animate-3"><a href="#login_pop" class="btn btn-outline btn-lg login">Login</a></p><?php } ?>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<div id="fh5co-main">
	
			<div class="container">
            
            <div class="row">
			     <div class="col-md-8 fh5co-section-heading feature-box">
                    <h2 class="fh5co-lead"><?php echo $gather_content; ?></h2>
                    <p class="fh5co-sub"><?php echo $gather_sub; ?></p>
                </div>
                <div class="col-md-4 fh5co-section-heading feature-box">
                    <img class="img-responsive" src="images/verzamel_content.png" /> 
                </div> 
            </div>
            
			<div class="fh5co-spacer fh5co-spacer-md"></div>
                
            <div class="row" id="fh5co-features">
                <div class="col-md-4 fh5co-section-heading fh5co-feature feature-box">
                    <img class="img-responsive" src="images/content_board.jpg" />
                </div>
                <div class="col-md-8 fh5co-section-heading fh5co-feature feature-box">
                    <h2 class="fh5co-lead"><?php echo $board_info_h2; ?></h2>
                    <p class="fh5co-sub"><?php echo $board_info_p; ?></p>
                </div>   
            </div>        
            
			<div class="fh5co-spacer fh5co-spacer-md"></div>  
            
            <div class="row">
                <div class="col-md-8 fh5co-section-heading fh5co-feature feature-box">
                    <h2 class="fh5co-lead"><?php echo $zoek_h2; ?></h2>
                    <p class="fh5co-sub"><?php echo $zoek_p; ?></p>
                </div>
                <div class="col-md-4 fh5co-section-heading fh5co-feature feature-box">
                    <img class="img-responsive" src="images/zoek_hashtag.jpg" />
                </div>
            </div>
            
			<div class="fh5co-spacer fh5co-spacer-md"></div>
            
            <div class="row">
                <div class="col-md-4 fh5co-section-heading fh5co-feature feature-box">
                    <img class="img-responsive" src="images/beheer_posts.jpg" />
                </div>
                <div class="col-md-8 fh5co-section-heading fh5co-feature feature-box">
                    <h2 class="fh5co-lead"><?php echo $beheer_h2; ?></h2>
                    <p class="fh5co-sub"><?php echo $beheer_p; ?></p>
                </div>
            
            </div>
            
				<div class="fh5co-spacer fh5co-spacer-md"></div>
                          
				
				<!-- END row -->

				<div class="fh5co-spacer fh5co-spacer-md"></div>
				<!-- End Spacer -->

				<div class="row" id="fh5co-works">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-section-heading work-box">
						<h2 class="fh5co-lead"><?php echo $netwerken; ?></h2>
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 text-center fh5co-work-item work-box">
						<img class="img-responsive" src="images/facebook.png" alt="Facebook" />
						<h3 class="heading"><a href="http://facebook.com" target="_blank">Facebook</a></h3>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 text-center fh5co-work-item work-box"> 
						<img class="img-responsive twitter" src="images/twitter.png" alt="Twitter" />
						<h3 class="heading"><a href="http://twitter.com" target="_blank">Twitter</a></h3>
					</div>

					<div class="clearfix visible-sm-block visible-xs-block"></div>

					<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 text-center fh5co-work-item work-box"> 
						<img class="img-responsive" src="images/instagram.png" alt="Instagram" />
						<h3 class="heading"><a href="http://instagram.com" target="_blank">Instagram</a></h3>
					</div>

					<div class="clearfix visible-md-block visible-lg-block"></div>

					<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 text-center fh5co-work-item work-box">
						<img class="img-responsive" src="images/linkedin.png" alt="Linkedin" />
						<h3 class="heading"><a href="http://linkedin.com" target="blank">Linkedin</a></h3>
					</div>

					<div class="clearfix visible-sm-block visible-xs-block"></div>

				</div>
				<!-- END row -->
				
				<div class="fh5co-spacer fh5co-spacer-md"></div>

				<!-- END row -->
				<div class="fh5co-spacer fh5co-spacer-md"></div>

			</div>
			<!-- END container -->

		
		</div>
		<!-- END fhtco-main -->
<?php include "footer.php"; ?>

	</body>
</html>
