<!DOCTYPE html>
<?php define ( 'lang_nl',true); include 'languages/lang_nl.php';
session_start(); 
include "classes/Database.php";

if(!isset($_SESSION['ingelogd'])){
    $_SESSION['ingelogd'] = "0";
}


?>
	<!--[if lt IE 7]>
		<html class="no-js lt-ie9 lt-ie8 lt-ie7">
		<![endif]-->
		<!--[if IE 7]>
			<html class="no-js lt-ie9 lt-ie8">
			<![endif]-->
			<!--[if IE 8]>
				<html class="no-js lt-ie9">
				<![endif]-->
				<!--[if gt IE 8]>
					<!-->
					<html class="no-js">
					<!--<![endif]-->
					<head>
						<meta charset="utf-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<title>
							SocialTags
							<?php echo $title;?>
						</title>
						<meta name="viewport" content="width=device-width, initial-scale=1">
						<meta name="description" content="SocialTags" />
						<meta name="keywords" content="social tags, html5, css3, mobile first, responsive" />
						<meta name="author" content="Tahier" />
						<!-- ////////////////////////////////////////////////////// FREE HTML5 TEMPLATE DESIGNED & DEVELOPED by FREEHTML5.CO Website: http://freehtml5.co/ Email: info@freehtml5.co Twitter: http://twitter.com/fh5co
						Facebook: https://www.facebook.com/fh5co ////////////////////////////////////////////////////// -->
						<!-- Facebook and Twitter integration -->
						<meta property="og:title" content=""/>
						<meta property="og:image" content=""/>
						<meta property="og:url" content=""/>
						<meta property="og:site_name" content=""/>
						<meta property="og:description" content=""/>
						<meta name="twitter:title" content="" />
						<meta name="twitter:image" content="" />
						<meta name="twitter:url" content="" />
						<meta name="twitter:card" content="" />
						<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
						<link rel="shortcut icon" href="images/socialtags.png">
						<!-- Google Webfont -->
						<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
						<!-- Themify Icons -->
						<link rel="stylesheet" href="css/themify-icons.css">
						<!-- Bootstrap -->
						<link rel="stylesheet" href="css/bootstrap.css">
                        <!-- Bootstrap font awesome -->
                        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
                        <!-- Social Buttons -->
                        <link rel="stylesheet" href="css/social-buttons.css">
						<!-- Owl Carousel -->
						<link rel="stylesheet" href="css/owl.carousel.min.css">
						<link rel="stylesheet" href="css/owl.theme.default.min.css">
						<!-- Magnific Popup -->
						<link rel="stylesheet" href="css/magnific-popup.css">
						<!-- Superfish -->
						<link rel="stylesheet" href="css/superfish.css">
						<!-- Easy Responsive Tabs -->
						<link rel="stylesheet" href="css/easy-responsive-tabs.css">
						<!-- Animate.css -->
						<link rel="stylesheet" href="css/animate.css">
						<!-- Theme Style -->
						<link rel="stylesheet" href="css/style.css">
						<!-- jQuery -->
						<script src="js/jquery-1.10.2.min.js">
							
						
						</script>
						<!-- jQuery Easing -->
						<script src="js/jquery.easing.1.3.js">
						</script>
                        
                        <!-- jQuery Dialog -->
                        <script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
                        crossorigin="anonymous"></script>
                        
                        <!-- jQuery validator -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js">
                        
                        </script>
                        
                        <!-- jQuery validator additional methods -->
                        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.js">
                        
                        </script>
                        
						<!-- Bootstrap -->
						<script src="js/bootstrap.js">
							
						
						</script>
						<!-- Owl carousel -->
						<script src="js/owl.carousel.min.js">
							
						
						</script>
						<!-- Magnific Popup -->
						<script src="js/jquery.magnific-popup.min.js">
							
						
						</script>
						<!-- Superfish -->
						<script src="js/hoverIntent.js">
							
						
						</script>
						<script src="js/superfish.js">
							
						
						</script>
						<!-- Easy Responsive Tabs -->
						<script src="js/easyResponsiveTabs.js">
							
						
						</script>
						<!-- FastClick for Mobile/Tablets -->
						<script src="js/fastclick.js">
							
						
						</script>
						<!-- Parallax -->
						<script src="js/jquery.parallax-scroll.min.js">
							
						
						</script>
						<!-- Waypoints -->
						<script src="js/jquery.waypoints.min.js">
							
						
						</script>
						<!-- Main JS -->
						<script src="js/main.js">
							
						
						</script>
						<!-- Modernizr JS -->
						<script src="js/modernizr-2.6.2.min.js">
							
						
						</script>
						<!-- FOR IE9 below -->
						<!--[if lt IE 9]>
							<script src="js/respond.min.js">
								
							
							</script>
						<![endif]-->
					</head>
					<body>
						<!-- START #fh5co-header -->
						<header id="fh5co-header-section" role="header" class="">
							<div class="container">
								<!-- <div id="fh5co-menu-logo"> -->
								<!-- START #fh5co-logo -->
								<h1 id="fh5co-logo" class="pull-left">
									<a href="index.php"><img src="images/socialtags.png" width="100px" alt="SocialTags"></a>
								</h1>
								<!-- START #fh5co-menu-wrap -->
								<nav id="fh5co-menu-wrap" role="navigation">
									<ul class="sf-menu" id="fh5co-primary-menu">
                                    <?php if($_SESSION['ingelogd'] == "1"){?>                                    
                                        
                                        <li>
											<a href="prijzen.php">Prijzen</a>
										</li>
										<li>
											<a href="boards.php">Boards</a>
										</li>
										<li>
											<a href="account.php">Account</a>
										</li>
										<li>
											<a href="contact.php">Contact</a>
										</li>
										<li class="fh5co-special">
											<a href="uitloggen.php">Uitloggen</a>
										</li>
										<li>
											<img class="img-reponsive" src="images/profile-icon.png" width="80px"/>
										</li>
                                        
                                    <?}
                                    else{?>
                                        <li class="active">
											<a href="index.php">Home</a>
										</li>
										<li>
											<a href="prijzen.php">Prijzen</a>
										</li>
										<li>
											<a href="contact.php">Contact</a>
										</li>
                                        <li class="registreer" id="registreren">
                                            <a href="#registreer_pop">Registreren</a>
                                        </li>
										<li class="fh5co-special login" id="login">
											<a href="#login_pop">Login</a>
										</li>                                        
                                    <?}?>
                                    
										
									</ul>
								</nav>
								<!-- </div> -->
							</div>
						</header>
                        <?php
                        
    error_reporting(E_ALL);
                        ?>