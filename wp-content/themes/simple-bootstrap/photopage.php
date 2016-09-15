<?php 
/*
	Template Name: Photopage
*/
?>
<?php get_header(); ?>
<div id="photos">
	 <article id="post-<?php the_ID(); ?>" <?php post_class(""); ?> role="article">
        <header>
             <div class="article-header">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>
    <hr/>
	<?php print_photosets(); ?>
<div style="clear: both;"></div>
</div> <!-- end photo !-->
</article>
<?php get_footer(); ?>
