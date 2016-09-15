<?php
/*Plugin Name: Create Project & Website Post Type
Description: This plugin registers the 'project', 'code' and 'website' post type.
Version: 1.0
License: GPLv2
*/
include('projects2wordpress.php');
include('websites2wordpress.php');
 
function custom_slide_post_type() {
	// Set UI labels for 'Slide' Post Type
	$labels = array(
		'name'                => _x( 'Slides', 'Post Type General Name', 'dazzling' ),
		'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'dazzling' ),
		'menu_name'           => __( 'Slides', 'dazzling' ),
		'parent_item_colon'   => __( 'Parent Slide', 'dazzling' ),
		'all_items'           => __( 'All Slides', 'dazzling' ),
		'view_item'           => __( 'View Slide', 'dazzling' ),
		'add_new_item'        => __( 'Add new slide', 'dazzling' ),
		'add_new'             => __( 'Add New', 'dazzling' ),
		'edit_item'           => __( 'Edit Slide', 'dazzling' ),
		'update_item'         => __( 'Update Slide', 'dazzling' ),
		'search_items'        => __( 'Search Slide', 'dazzling' ),
		'not_found'           => __( 'Not Found', 'dazzling' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'dazzling' ),
	);
	// Set other options for 'Slide' Post Type
	$args = array(
		'label'               => __( 'Slides', 'dazzling' ),
		'description'         => __( 'Slides', 'dazzling' ),
		'labels'              => $labels,
		'supports'            => array( 'title'),
  	'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 4,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'			  => 'dashicons-format-gallery',
	);
	// Registering your Custom Post Type
	register_post_type( 'slides', $args );
}
/**
 * Add slide link custom fields
 */
function add_slide_meta_boxes() {
	add_meta_box("website_detail_meta", "Filepath", "add_slide_details_slide_meta_box", "slides", "normal", "low");
}
function add_slide_details_slide_meta_box()
{
	global $post;
	$custom = get_post_custom( $post->ID );
 
	?>
	<style>.width99 {width:99%;}</style>
	<p>
		<label>File:</label><br />
		<input type="text" name="file" value="<?= @$custom["file"][0] ?>" class="width99" />
	</p>
	<?php
}
/**
 * Save custom field data when creating/updating posts
 */
function save_slide_custom_fields(){
  global $post;
 
  if ( $post )
  {
    update_post_meta($post->ID, "file", @$_POST["file"]);
  }
}
add_action( 'admin_init', 'add_slide_meta_boxes' );
add_action( 'save_post', 'save_slide_custom_fields' );


/**
 * Add custom code post type
 */
function custom_code_post_type() {
	// Set UI labels for 'code' Post Type
	$labels = array(
		'name'                => _x( 'Code', 'Post Type General Name', 'dazzling' ),
		'singular_name'       => _x( 'Code', 'Post Type Singular Name', 'dazzling' ),
		'menu_name'           => __( 'Code', 'dazzling' ),
		'parent_item_colon'   => __( 'Parent code snippets', 'dazzling' ),
		'all_items'           => __( 'All code snippets', 'dazzling' ),
		'view_item'           => __( 'View code snippets', 'dazzling' ),
		'add_new_item'        => __( 'Add new code snippets', 'dazzling' ),
		'add_new'             => __( 'Add new', 'dazzling' ),
		'edit_item'           => __( 'Edit code snippets', 'dazzling' ),
		'update_item'         => __( 'Update code snippets', 'dazzling' ),
		'search_items'        => __( 'Search code snippets', 'dazzling' ),
		'not_found'           => __( 'Not found', 'dazzling' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'dazzling' ),
	);
	// Set other options for 'code' Post Type
	$args = array(
		'label'               => __( 'code', 'dazzling' ),
		'description'         => __( 'Code', 'dazzling' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'revisions' ),
		'hierarchical'        => false,
		'public'              => true,
		'taxonomies'          => array( 'language' ),
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'			=> 'page',
		'menu_icon'						=> 'dashicons-format-aside',
	);
	// Registering 'code' Post Type
	register_post_type( 'code', $args );
	register_taxonomy_for_object_type( 'language', 'code' );
}
/**
 * Add code custom fields
 */
function add_code_meta_boxes() {
	add_meta_box("code_detail_meta", "Code Details", "add_code_details_code_meta_box", "code", "normal", "low");
}
function add_code_details_code_meta_box()
{
	global $post;
	$custom = get_post_custom( $post->ID );
 
	?>
	<style>.width99 {width:99%;}</style>
	<p>
		<label>Code:</label><br />
		<textarea rows="4" cols="50" id="code" name="code" value="<?= @$custom["code"][0] ?>" class="width99"><?= @$custom["code"][0] ?></textarea>
	</p>
	<?php
}
/**
 * Save custom field data when creating/updating posts
 */
function save_code_custom_fields(){
  global $post;
 
  if ( $post )
  {
    update_post_meta($post->ID, "code", @htmlspecialchars($_POST["code"]));
  }
}
add_action( 'admin_init', 'add_code_meta_boxes' );
add_action( 'save_post', 'save_code_custom_fields' );


//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );

function create_topics_nonhierarchical_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Language', 'taxonomy general name' ),
    'singular_name' => _x( 'language', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search language' ),
    'popular_items' => __( 'Popular language' ),
    'all_items' => __( 'All language' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit language' ), 
    'update_item' => __( 'Update language' ),
    'add_new_item' => __( 'Add New language' ),
    'new_item_name' => __( 'New language Name' ),
    'separate_items_with_commas' => __( 'Separate languages with commas' ),
    'add_or_remove_items' => __( 'Add or remove language' ),
    'choose_from_most_used' => __( 'Choose from the most used languages' ),
    'menu_name' => __( 'Language' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('language','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'topic' ),
  ));
}
/**
 * Add custom photo post type
 */
function custom_photo_post_type() {
	// Set UI labels for 'photo' Post Type
	$labels = array(
		'name'                => _x( 'Photos', 'Post Type General Name', 'dazzling' ),
		'singular_name'       => _x( 'Photo', 'Post Type Singular Name', 'dazzling' ),
		'menu_name'           => __( 'Photos', 'dazzling' ),
		'parent_item_colon'   => __( 'Parent photo', 'dazzling' ),
		'all_items'           => __( 'All photos', 'dazzling' ),
		'view_item'           => __( 'View photos', 'dazzling' ),
		'add_new_item'        => __( 'Add new photo', 'dazzling' ),
		'add_new'             => __( 'Add new', 'dazzling' ),
		'edit_item'           => __( 'Edit photo', 'dazzling' ),
		'update_item'         => __( 'Update photo', 'dazzling' ),
		'search_items'        => __( 'Search photo', 'dazzling' ),
		'not_found'           => __( 'Not found', 'dazzling' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'dazzling' ),
	);
	// Set other options for 'photo' Post Type
	$args = array(
		'label'               => __( 'photo', 'dazzling' ),
		'description'         => __( 'Photo', 'dazzling' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'taxonomies'          => array( 'photoset' ),
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 7,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'			=> 'page',
		'menu_icon'						=> 'dashicons-camera',
	);
	// Registering 'photo' Post Type
	register_post_type( 'photo', $args );
	register_taxonomy_for_object_type( 'photoset', 'photo' );
}
/**
 * Add photo custom fields
 */
function add_photo_meta_boxes() {
	add_meta_box("photo_detail_meta", "Photo details", "add_photo_details_photo_meta_box", "photo", "normal", "low");
}
function add_photo_details_photo_meta_box()
{
	global $post;
	$custom = get_post_custom( $post->ID );
 
	?>
	<style>.width99 {width:99%;}</style>
	<p>
		<label>Flickr ID:</label><br />
		<input type="text" name="flickr_id" value="<?= @$custom["flickr_id"][0] ?>" class="width99" />
	</p>
	<p>
		<label>Date taken:</label><br />
		<input type="text" name="date_taken" value="<?= @$custom["date_taken"][0] ?>" class="width99" />
	</p>
	<p>
		<label>Date uploaded:</label><br />
		<input type="text" name="date_upload" value="<?= @$custom["date_upload"][0] ?>" class="width99" />
	</p>
	<p>
		<label>URL [square]:</label><br />
		<input type="text" name="url_sq" value="<?= @$custom["url_sq"][0] ?>" class="width99" />
	</p>
	<p>
		<label>URL [thumb]:</label><br />
		<input type="text" name="url_t" value="<?= @$custom["url_t"][0] ?>" class="width99" />
	</p>
	<p>
		<label>URL [small]:</label><br />
		<input type="text" name="url_s" value="<?= @$custom["url_s"][0] ?>" class="width99" />
	</p>
	<p>
		<label>URL [medium]:</label><br />
		<input type="text" name="url_m" value="<?= @$custom["url_m"][0] ?>" class="width99" />
	</p>
	<p>
		<label>URL [original]:</label><br />
		<input type="text" name="url_o" value="<?= @$custom["url_o"][0] ?>" class="width99" />
	</p>
	<?php
}
/**
 * Save custom field data when creating/updating posts
 */
function save_photo_custom_fields(){
  global $post;
 
  if ( $post )
  {
    update_post_meta($post->ID, "flickr_id", @htmlspecialchars($_POST["flickr_id"]));
    update_post_meta($post->ID, "date_taken", @htmlspecialchars($_POST["date_taken"]));
    update_post_meta($post->ID, "date_upload", @htmlspecialchars($_POST["date_upload"]));
    update_post_meta($post->ID, "url_sq", @htmlspecialchars($_POST["url_sq"]));
    update_post_meta($post->ID, "url_t", @htmlspecialchars($_POST["url_t"]));
    update_post_meta($post->ID, "url_s", @htmlspecialchars($_POST["url_s"]));
    update_post_meta($post->ID, "url_m", @htmlspecialchars($_POST["url_m"]));
    update_post_meta($post->ID, "url_o", @htmlspecialchars($_POST["url_o"]));
  }
}
add_action( 'admin_init', 'add_photo_meta_boxes' );
add_action( 'save_post', 'save_photo_custom_fields' );



//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

add_action( 'init', 'create_photosets_nonhierarchical_taxonomy', 0 );

function create_photosets_nonhierarchical_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Photoset', 'taxonomy general name' ),
    'singular_name' => _x( 'photoset', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search photoset' ),
    'popular_items' => __( 'Popular photoset' ),
    'all_items' => __( 'All photoset' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit photoset' ), 
    'update_item' => __( 'Update photoset' ),
    'add_new_item' => __( 'Add New photoset' ),
    'new_item_name' => __( 'New photoset Name' ),
    'separate_items_with_commas' => __( 'Separate photosets with commas' ),
    'add_or_remove_items' => __( 'Add or remove photoset' ),
    'choose_from_most_used' => __( 'Choose from the most used photosets' ),
    'menu_name' => __( 'Photoset' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('photoset','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'photoset' ),
  ));
}

function print_frontpage_slideshow(){
	$args = array('post_type' => 'slides', 'posts_per_page' => 50);
	$loop = new WP_Query( $args );
	$i = 0;
	//Define the loop based on arguments
	if($loop->have_posts()){
		echo '<div class="carousel-inner" role="listbox">';
		while ( $loop->have_posts() ) : $loop->the_post();
			$title = get_the_title();
			$file = get_post_meta(get_the_ID(), "file")[0];
			$file = str_replace('..', 'http://', $file);
			echo '<div class="item';
			if($i == 0) echo ' active';
			echo '">';
			echo '<img src="'.$file.'" title="'.$title.'" alt="'.$title.'"/>';
			echo '<div class="carousel-caption">'.$title.'</div>';
			echo '</div><!-- item !-->';
			$i++;
		endwhile;
		echo '</div><!-- carousel-innner !-->';
		print('<!-- Left and right controls -->
		  <a class="left carousel-control" href="#frontcarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#frontcarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>');
	 } // Close if statement
}


/**
 * Hook into the 'init' action so that the function
 * containing our post type registration is not 
 * unnecessarily executed. 
 */
add_action( 'init', 'custom_slide_post_type', 0 );
add_action( 'init', 'custom_photo_post_type', 0 );

add_action( 'init', 'custom_code_post_type', 0 );


function queue_jj_stylesheet()
{
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( 'style_custom.css', __FILE__ ), array());
    // or
 	wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'queue_jj_stylesheet', 15);

function print_photosets(){
	$photosets = array(
					'Glow 2015', 
					'Milano 2015',
					'Glow 2014',
					'Madrid',
					'Stockholm',
					'Glow 2013', 
					'Glow 2012',
					'South Africa 2012',
					'Rome 2011',
					'Glow 2011',
					'Liguria 2011',
					'Paris',
					'Garden',
					'Ghent',
					);
	?>
	<ul>
	<?php
	foreach($photosets as $index => $photoset){
		// Display the photos
		$args = array( 
					'post_type' => 'photo',
					'posts_per_page' => 50,
					'tax_query' => array(
						array(
							'taxonomy' => 'photoset',
							'field' => 'name',
							'terms' => $photoset
						)
					)
		);

		//Define the loop based on arguments
		$loop = new WP_Query( $args );
		if($loop->have_posts()){
			?>
			<li class="li-photoset">
				<div class="div-photoset"><?php echo $photoset; ?></div>
			</li>
			<?php
			while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<?php 
				$url_s = get_post_meta(get_the_ID(), "url_s")[0]; 
				$url_o = get_post_meta(get_the_ID(), "url_o")[0]; 
				$datetaken = get_post_meta(get_the_ID(), "date_taken")[0]; 

			?>
			<a data-rel="lightbox" href="<?php echo $url_o; ?>" title="<?php echo get_the_title(); ?>">
			<li>
				<p>
					<b><?php the_title();?></b>
					<br/><br/><br/>
					[<?php echo $datetaken;?>]
				</p>
				<div style="background-image: url('<?php echo $url_m;?>');">
				</div>
			</li>
			</a>
		<?php endwhile;?>
		<?php }else{
			echo 'No pictures found!';
		}
	} // End foreach
	?>
	</ul>
	
<?php
}
	
add_action( 'admin_menu', 'jjs_admin_menu' );

function jjs_admin_menu() {
	add_options_page( 'JJs Custom Menu', 'JJ\'s Plugin', 'manage_options', 'jjsworld/jjplugin-admin-page.php', 'jjplugin_admin_page', 'dashicons-tickets', 6  );
}

function jjplugin_admin_page(){
	?>
	<div class="wrap">
		<h2>Welcome To JJs Plugin</h2>
		<a class='button button-primary' style='margin:0.25em 1em' href='<?php echo $_SERVER["PHP_SELF"]."?page=jjsworld%2Fjjplugin-admin-page.php";?>&insert_slides'>Insert slides</a>
		<a class='button button-primary' style='margin:0.25em 1em' href='<?php echo $_SERVER["PHP_SELF"]."?page=jjsworld%2Fjjplugin-admin-page.php";?>&insert_projects'>Insert projects</a>
		<a class='button button-primary' style='margin:0.25em 1em' href='<?php echo $_SERVER["PHP_SELF"]."?page=jjsworld%2Fjjplugin-admin-page.php";?>&insert_websites'>Insert websites</a>
		<a class='button button-primary' style='margin:0.25em 1em' href='<?php echo $_SERVER["PHP_SELF"]."?page=jjsworld%2Fjjplugin-admin-page.php";?>&insert_photosets'>Insert photosets</a>
	</div>
	<?php
	   

}

add_action( "admin_init", function() {
	// global $wpdb;
	
	if (isset( $_GET["insert_projects"] ) ) {
		$result = process_projects();
	}
		if (isset( $_GET["insert_websites"] ) ) {
		$result = process_websites();
	}
	

	
	
});	
?>