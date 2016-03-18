<?php
$website_array = array();
$website_array[0] = array(
	'title' => 'MultyEPDM',
	'description' => "The website from Multy EPDM is a website a took over from another administrator. The layout was designed by the previous administrator. I 'only' changed the page structure, rewrote the whole menu and corrected the content of all the pages. Besides that I made the page easier to work with, so the prices can be easily adjusted by the owner of the company. Finally I created a new form which automatically calculated the materials needed for the roof based on the dimensions. Unfortunately somebody else took over the website and made it less appealing again.",
	'url' => 'http://www.multyepdm.nl'
	);
$website_array[1] = array(
	'title' => 'Lichtkoepeldump',
	'description' => "Lichtkoepeldump.nl is another website I took over from another administrator. I didn't create the design, but I rewrote the whole underlying code for the website. Apart from this code I changed the price lists for the different products on the Lichtkoepel Dump. The website was full of errors, which was ideal for me since I could get familiar with HTML and CSS standards.",
	'url' => 'http://www.lichtkoepeldump.nl'
	);
$website_array[2] = array(
	'title' => 'Café Eigenwijs',
	'description' => "Café Eigenwijs, a cafe in it's own way, in the centre of Haaren.<br/><br/>Update: Since March 2011 the cafe is closed and the website is offline.<br/><br/>This website was build in March 2010. It is the first webpage I've created for a company. I made my own content management system to make it easier for the owner of the cafe to add new activities and news, to upload pictures and to adjust the opening hours.",
	'url' => ''
	);
$website_array[3] = array(
	'title' => 'Borgo San Giovanni',
	'description' => "This is the second website I made for/with a client, building it from the ground up. It is meant to replace the old website, since it was cluttered and not appealing. I tried to make it a clean and clear website, while keeping it visually appealing for visitors. The website is available in 3 different languages, English, Dutch and Italian. The owners of the website can access the language files themselves and add translations as they wish.<br/><br/>Update Spring 2013: The website that I created has been replaced by a new website to work with the agency they are currently working with. The images and text that I selected and changed have been transferred to the new website luckily. On the link the 'naked' version can still be viewed.<br/><br/>Note January 2016. Site has been moved, Link is coming.",
	'url' => ''
	);
$website_array[4] = array(
	'title' => 'Econex',
	'description' => "After returning from my stay in South-Africa I was asked to work on the company website of my former flatmate. The old website, which is still online, looks old fashioned and publications and other research work should be found easier. The whole website was restructured to find the practise areas, sectors, publications and people who work there faster.<br/><br/>For me the big challenge lays in the fact I had to make a whole new database structure to link the publications to its corresponding areas, sectors and people and make the whole publication database searchable. Design was done by Shingi Nhari, but implementation was done by me. The front-end was finished in a few weeks, but the back-end took a while to finish. Luckily I finished before the deadline, but, as always in Africa, things move a little bit slow. The website is not officially online yet (Dec, 2013), but in the background the new website can be visited. Update Oct, 2015: The website has been updated. My code was used and the design has been updated.",
	'url' => 'http://www.econex.co.za'
	);
$website_array[5] = array(
	'title' => 'Sweet Surprise Nuenen',
	'description' => "Sweet Surprise is a candy shop in Nuenen. The owners asked me to redo their website with some big changes. The frontpage should show what Sweet Surprise is all about, people should be able to book a kids party and there should be a webshop with all the candy and presents. The frontpage has been upgraded, the booking system and the contact form work and the webshop contains all the products. Apart from that, they also wanted to control the content and add images without needing external help. Therefore, to create the website I have used WordPress combined with the Mantra theme and several plugins, namely<br/><ul><li>Booking Calendar</li><li>FancyBox for WordPress</li><li>Fast Secure Contact Form</li><li>ICEPAY Plugin for Woocommerce</li><li>MapPress Easy Google Maps</li><li>Widget Logic</li><li>WooCommerce</li><li>WooCommerce (nl)</li></ul><br/>I have delivered the website in 2013. Since then the owners are maintaining the website themselves.",
	'url' => 'http://www.sweetsurprisenuenen.com'
	);	
$website_array[6] = array(
	'title' => 'Fresh of the Press',
	'description' => "Another website for South-Africa. This one is a blog by two girls about wine. Shingi Nhari did the design and I am the one that implemented it. The website is not online officially, but can be viewed on my local copy in my own domain. It should still be finished up by the owners, but my work is done.<br/><br/>[Nov 2013]",
	'url' => ''
	);	
$website_array[7] = array(
	'title' => 'Ben Cuypers',
	'description' => "Ben Cuypers is a painting and maintenance company in Valkenswaard. Because they want to be independent of the web admin (and pay less) they asked me to create a simple webpage which they could easily maintain. I have created this website in WordPress with the Vantage theme and the Page Builder plugin because I believe that is the easiest way to put together an appealing website which is not complicated to maintain. Instead of writing a manual, I''ve created a number of screencasts for the company to explain how to use the website. They can now watch the instructions on YouTube and reproduce the steps I show in the video to edit the content and add new media to their webpage. Delivered in October 2014.",
	'url' => 'http://www.b-cuypers.nl'
	);
/* Insert the website into WordPress */
function insert_wordpress_website($website){
	$result = wp_exist_website_by_title($website['title']);
	if(!isset($result)){
		// Set data for custom post type 'website'
		$website_post = array(
	  	'post_title'    => $website['title'],
	  	'post_content'  => $website['description'],
	  	'post_type' 	=> 'websites',
	  	'post_status'   => 'publish',
		);
		// Insert the post to WordPress
		$post_id = wp_insert_post( $website_post );
		// Add URL for the inserted website
		add_post_meta($post_id, 'website', 	$website['url'], 			true);
		return true;
	}else{
		return false;
	}
}

function wp_exist_website_by_title($title_str) {
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM wp_v8_posts WHERE post_type = 'websites' AND post_title = '" . $title_str . "'", 'ARRAY_A');
}

function process_websites(){
	global $website_array;
    foreach($website_array as $index => $website){
	    $result = insert_wordpress_website($website);
    }
}

function print_website_posts(){
	$args = array('post_type' => 'websites');
	$loop = new WP_Query( $args );
	$web = 1;
	while ( $loop->have_posts() ) : $loop->the_post();
	?>
		<?php if($web % 2 == 1){?>
		<div class="row row-eq-height webrow">
		<?php } ?>
		<div class="col-sm-6 col-xs-12 col-md-6">
		<h4 class="entry-title"><?php the_title(); ?></h4>
		<img class="web-img" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" width=200 />
		<?php the_content();?>

		<?php 
			$url = get_post_meta(get_the_ID(), "website")[0]; 
			if($url != "") echo '<a target="blank" href="'.$url.'">Link</a>';
		?>
		</div>
		<?php if($web %2 == 0){?>
		</div><!~~ end row !~~>
		<?php }
		$web++;
	endwhile;
}

function custom_website_post_type() {
	// Set UI labels for 'website' Post Type
	$labels = array(
		'name'                => _x( 'Websites', 'Post Type General Name', 'dazzling' ),
		'singular_name'       => _x( 'Website', 'Post Type Singular Name', 'dazzling' ),
		'menu_name'           => __( 'Websites', 'dazzling' ),
		'parent_item_colon'   => __( 'Parent Website', 'dazzling' ),
		'all_items'           => __( 'All Websites', 'dazzling' ),
		'view_item'           => __( 'View Website', 'dazzling' ),
		'add_new_item'        => __( 'Add New Website', 'dazzling' ),
		'add_new'             => __( 'Add New', 'dazzling' ),
		'edit_item'           => __( 'Edit Website', 'dazzling' ),
		'update_item'         => __( 'Update Website', 'dazzling' ),
		'search_items'        => __( 'Search Website', 'dazzling' ),
		'not_found'           => __( 'Not Found', 'dazzling' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'dazzling' ),
	);
	// Set other options for 'website' Post Type
	$args = array(
		'label'               => __( 'websites', 'dazzling' ),
		'description'         => __( 'Websites', 'dazzling' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
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
		'menu_icon'			  => 'dashicons-id-alt',
	);
	// Registering your Custom Post Type
	register_post_type( 'websites', $args );
}
/**
 * Add website link custom fields
 */
function add_website_meta_boxes() {
	add_meta_box("website_detail_meta", "Website Details", "add_website_details_website_meta_box", "websites", "normal", "low");
}
function add_website_details_website_meta_box()
{
	global $post;
	$custom = get_post_custom( $post->ID );
 
	?>
	<style>.width99 {width:99%;}</style>
	<p>
		<label>Website:</label><br />
		<input type="text" name="website" value="<?= @$custom["website"][0] ?>" class="width99" />
	</p>
	<?php
}
/**
 * Save custom field data when creating/updating posts
 */
function save_website_custom_fields(){
  global $post;
 
  if ( $post )
  {
    update_post_meta($post->ID, "website", @$_POST["website"]);
  }
}
add_action( 'admin_init', 'add_website_meta_boxes' );
add_action( 'save_post', 'save_website_custom_fields' );
add_action( 'init', 'custom_website_post_type', 0 );


?>

