<?php 
/*
	Template Name: Frontpage
*/
?>
<?php get_header(); ?>
</div><!-- container !-->
<div class="container-fluid">
	<div id="frontcarousel" class="row carousel slide carousel-fade" data-ride="carousel">
		<?php print_frontpage_slideshow(); ?>
	</div> <!-- frontcarousel !-->
</div> <!-- container -->
<div class="container">
	<div class="row" id="social-block">
		<center>
			<a href="http://www.facebook.com/jitsejan" target="blank"><i class="fa fa-facebook fa-3x"></i></a>
			<a href="http://www.flickr.com/photos/jitsejan/" target="blank"><i class="fa fa-flickr fa-3x"></i></a>
			<a href="http://youtube.com/JQadrad" target="blank"><i class="fa fa-youtube fa-3x"></i></a>
			<a href="https://play.spotify.com/user/jitsejan" target="blank"><i class="fa fa-spotify fa-3x"></i></a>
			<a href="http://nl.linkedin.com/pub/jitse-jan-van-waterschoot/24/b13/2b4" target="blank"><i class="fa fa-linkedin fa-3x"></i></a>
		</center>
	</div>
	<div class="row" id="projects">
		<hr/>
		<h2>Projects</h2>
		<h3 class='subtitle'>Some of the projects from my past</h3>
		<hr/>
		<?php print_project_posts();?>
	</div><!-- row !-->
	<div class="row" id="websites">
		<hr/>
		<h2>Websites</h2>
		<h3 class='subtitle'>A history of the websites I have created</h3>
		<hr/>
		<?php print_website_posts(); ?>
	</div><!-- row !-->
<?php get_footer(); ?>