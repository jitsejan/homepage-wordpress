<?php 
/*
	Template Name: Codepage
*/
?>
<?php get_header(); ?>
<div id="commands">
	<article id="post-<?php the_ID(); ?>" <?php post_class(""); ?> role="article">
        <header>
             <div class="article-header">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>
    <hr/>
	<div id="bash">
	<h3>Bash</h3>
	<!-------------------------!-->
	<!---------- Bash ---------!-->
	<!-------------------------!-->
	<?php
	// Display the commands
	$args = array('post_type' => 'code', 'language' => 'bash');
	//Define the loop based on arguments
	$loop = new WP_Query( $args );
	if($loop->have_posts()){
		while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<div class="row row-eq-height cmdrow">
		<h4><?php the_title(); ?></h4>
		<?php 
			the_content(); $cmd = get_post_meta(get_the_ID(), "code")[0];
			echo '<pre class="prettyprint lang:sh decode:true">'.$cmd.'</pre>';
		?>  
		</div><!-- end row !-->
	<?php endwhile;?>
	<?php }else{
		echo 'No code snippets found for bash language!';
	} ?>
	</div> <!-- end bash !-->
	<!-------------------------!-->
	<!--------- WordPress -----!-->
	<!-------------------------!-->

	<div id="wordpress">
	<h3>WordPress</h3>
	<?php
	// Display the snippet
	$args = array('post_type' => 'code', 'language' => 'WordPress');
	//Define the loop based on arguments
	$loop = new WP_Query( $args );
	if($loop->have_posts()){
		while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<div class="row row-eq-height cmdrow">
		<h4><?php the_title(); ?></h4>
		<?php 
			the_content(); 
			$cmd = get_post_meta(get_the_ID(), "code")[0];
			echo '<pre class="prettyprint language-cmd">'.$cmd.'</pre>';
		?>  
		</div><!-- end row !-->
	<?php endwhile;?>
	<?php }else{
		echo 'No code snippets found for WordPress!';
	} ?>
	</div> <!-- end Python !-->
	</article>
</div> <!-- end commands !-->
<?php get_footer(); ?>
