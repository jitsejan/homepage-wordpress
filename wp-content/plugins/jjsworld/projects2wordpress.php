<?php
$project_array = array();
$project_array[0]['title'] = '3D Mario';
$project_array[0]['description'] = 'In this project I turned a 2 dimensional Mario into a 3 dimensional Mario. I started with an image of 17×17 pixels and used Blender® to create the 3D Mario. (Summer 2009)';

$project_array[1]['title'] = 'Hongerdoeken';
$project_array[1]['description'] = 'This is a project where I made a Flash application with information about hongerdoeken. In October 2010 this application was distributed together with the corresponding book through the Netherlands. The online version doesn’t contain the correct contents, but the functionality is up-to-date.<br/><br/><strike><a href="http://hongerdoeken.jitsejan.com">Link</a> [Dutch]</strike>';

$project_array[2]['title'] = 'Remote control';
$project_array[2]['description'] = 'In 2007 I started using a remote control to control the media player on my computer. In November 2009 the use extended to controlling the music, video, sound and different lights on my room. I created a simulation of the remote control, so when I click the buttons in the simulation on my computer, it will start and stop the music mimicking the behavior of the remote control.';

$project_array[3]['title'] = 'Phone project';
$project_array[3]['description'] = 'My bachelor thesis was a research on how to use a mobile phone to control a computer by moving the phone. For this I needed to make a connection between the phone and the computer and send the data about the movement of the phone over link to the computer. The computer can apply the intended action by processing the received data. Communication was done over a Bluetooth link. I developed the software for both the client and the server and tested it on several platforms (Windows, Linux).';

$project_array[4]['title'] = 'Aho-Corasick on the FPGA';
$project_array[4]['description'] = 'My internship research in Stellenbosch, SA aimed at the recognition of patterns of strings in data. Dedicated hardware in combination with the Aho-Corasick algorithm was used to find occurrences of words in network data. This way unwanted network traffic, e.g. mail, could be detected before it reached the personal computer of the end user. The research focused on a speed comparison between a normal desktop computer and a field-programmable gate array (FPGA). It turned out that for sufficiently large strings, the FPGA outperformed the desktop computer.';

$project_array[5]['title'] = 'Monitoring eating behavior';
$project_array[5]['description'] = 'My graduation project focused on an automatic way of recognising intake moments of a person based on data from different sensors. I used two accelerometers to monitor the arm movements and an in-ear microphone to monitor the sounds of the jaw bone. Based on the recorded data of different persons during the day, I made a classifier in Matlab to automatically find intake moments in the data. For the recognition algorithm I used different feature selectors and classifiers to compare the performance of the classification. It turned out that the intake of drinks is the easiest movement to recognise, while intake using cutlery, especially forks, is difficult to be found in the data. Apart from the cutlery used, it turned out that taller people had better classification results because their long arms make the intake movement more clear.';
    
/* Insert the slide into WordPress */
function insert_wordpress_project($project){
	$result = wp_exist_project_by_title($project['title']);
	if(!isset($result)){
		// Set data for custom post type 'project'
		$project_post = array(
	  	'post_title'    => $project['title'],
	  	'post_content'  => $project['description'],
	  	'post_type' 	  => 'projects',
	  	'post_status'   => 'publish',
		);
		// Insert the post to WordPress
		$post_id = wp_insert_post( $project_post );
		// echo $post_id;
		// Add file path for the inserted slide
		// 	add_post_meta($post_id, 'file', 	$url, 			true);
		return true;
	}else{
		return false;
	}
}

function wp_exist_project_by_title($title_str) {
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM wp_v8_posts WHERE post_type = 'projects' AND post_title = '" . $title_str . "'", 'ARRAY_A');
}

function process_projects(){
	global $project_array;
    foreach($project_array as $index => $project){
	    $result = insert_wordpress_project($project);
    }
}

function print_project_posts(){
	$args = array('post_type' => 'projects', 'orderby' => 'date', 'order' => 'DESC');
	$loop = new WP_Query( $args );
	$proj = 0;
	while ( $loop->have_posts() ) : $loop->the_post();
	?>
	<article>
	<div id="code" class="row">
	<?php if($proj % 2 == 0){ ?>
	<div class="thumbnail col-lg-4 col-md-4 col-sm-4"><?php echo get_the_post_thumbnail(get_the_ID(), 'large');?></div>
	<?php }?>
	<div class="col-md-8 col-lg-8 col-sm-8"><h4 class="entry-title"><?php the_title(); ?></h4>
	<?php the_content(); ?></div>
	<?php if($proj % 2 == 1){ ?>
	<div class="col-lg-4 col-md-4 col-sm-4 thumbnail"><?php echo get_the_post_thumbnail(get_the_ID(), 'large');?></div>
	<?php }?>
	</div>
	</article>
	<?php
	$proj++;
	endwhile;
}


/**
 * Add custom project post type
 */ 
function custom_project_post_type() {
	// Set UI labels for 'project' Post Type
	$labels = array(
		'name'                => _x( 'Projects', 'Post Type General Name', 'dazzling' ),
		'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'dazzling' ),
		'menu_name'           => __( 'Projects', 'dazzling' ),
		'parent_item_colon'   => __( 'Parent Project', 'dazzling' ),
		'all_items'           => __( 'All Projects', 'dazzling' ),
		'view_item'           => __( 'View Project', 'dazzling' ),
		'add_new_item'        => __( 'Add New Project', 'dazzling' ),
		'add_new'             => __( 'Add New', 'dazzling' ),
		'edit_item'           => __( 'Edit Project', 'dazzling' ),
		'update_item'         => __( 'Update Project', 'dazzling' ),
		'search_items'        => __( 'Search Project', 'dazzling' ),
		'not_found'           => __( 'Not Found', 'dazzling' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'dazzling' ),
	);
	// Set other options for 'project' Post Type
	$args = array(
		'label'               => __( 'projects', 'dazzling' ),
		'description'         => __( 'Projects', 'dazzling' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'			  => 'dashicons-format-aside',
	);
	// Registering your Custom Post Type
	register_post_type( 'projects', $args );
}
add_action( 'init', 'custom_project_post_type', 0 );
?>

