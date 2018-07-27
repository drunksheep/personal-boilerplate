<?php 

## theme supports ##
####################

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
}

## BASE STYLESHEET AND JS FILES ## 
##################################

function registerScripts() {
	// base concatenated app.js (contains all non-cdn vendors)
	wp_register_script( 'app', get_bloginfo('template_url') . '/dist/app.js', '', null, false );
	wp_enqueue_script('app');
}

add_action( 'wp_enqueue_scripts', 'registerScripts' );

function registerStyles() {
	// base stylesheet
	wp_register_style( 'basic-stylesheet', get_bloginfo('template_url') . '/dist/main.css', '',  null, 'all' );
	wp_enqueue_style( 'basic-stylesheet');
}

add_action( 'wp_enqueue_scripts', 'registerStyles' );


## GENERIC FUNCTIONS ## 
#######################

// get pages by template used for loops 

function get_pages_by_template( $template = '', $args = array() ) {
	if ( empty( $template ) ) return false;
	if ( strpos( $template, '.php' ) !== ( strlen( $template ) - 4) )  $template .= '.php';
	$args['meta_key'] = '_wp_page_template';
	$args['meta_value'] = $template;
	return get_pages($args);
}

function menuListing($instance) {
	$list = get_pages_by_template($instance); 

	foreach ($list as $item ) {
		$ID = $item->ID; 
		$title = $item->post_title;
		$permalink = get_permalink($ID, false);

		echo "<li><a href=\"$permalink\" title=\"$title\">$title</a></li>";
	}

}

// generic excerpt function

function excerpt($limit, $instance) {
	$excerpt = explode(' ', $instance, $limit);
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode(" ", $excerpt ).' ...';
	} 
	else {
		$excerpt = implode( " ", $excerpt );
	}	
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );
	return $excerpt;
}

// shuffle array with association
// http://php.net/manual/pt_BR/function.shuffle.php#94697 

function shuffle_assoc(&$array) {
	$keys = array_keys($array);

	shuffle($keys);

	foreach($keys as $key) {
		$new[$key] = $array[$key];
	}

	$array = $new;

	return true;
}

// send object to JS via wp_localize_script
function hoistObject() {

	// get post id
	$id = get_queried_object()->ID;

	// get meta 
	$lat = get_post_meta($id, 'map_latitude', true);
	$long = get_post_meta($id, 'map_longitude', true);
	$url = get_bloginfo('template_url');

	// create array
	$hoist = json_encode(array(
		'lat' => $lat, 
		'long' => $long, 
		'url' => $url,
	));

	if (!empty($lat) && !empty($long) ) {
		wp_localize_script('app', 'coordinatesObject', $hoist);
	}

}

add_action('wp_enqueue_scripts', 'hoistObject');


## POST TYPES ## 
################

function create_posttypes() {
	// $profLabels = array(
	// 	'name'               => _x( 'Professores', 'post type general name'),
	// 	'singular_name'      => _x( 'Professor', 'post type singular name'),
	// 	'menu_name'          => _x( 'Professores', 'admin menu'),
	// 	'name_admin_bar'     => _x( 'Professor', 'add new on admin bar'),
	// 	'add_new'            => _x( 'Adicionar novo', 'book'),
	// 	'add_new_item'       => __( 'Adicionar novo professor'),
	// 	'new_item'           => __( 'Novo Professor'),
	// 	'edit_item'          => __( 'Editar Professor'),
	// 	'view_item'          => __( 'Ver Professor'),
	// 	'all_items'          => __( 'Todos Professors'),
	// 	'search_items'       => __( 'Buscar Professores'),
	// 	'not_found'          => __( 'Nenhum item encontrado'),
	// 	'not_found_in_trash' => __( 'Nenhum item encontrado na lixeira.')
	// );

	// register_post_type( 'professores',
	// 	array(
	// 		'labels' => $profLabels,
	// 		'public' => true,
	// 		'rewrite' => array(
	// 			'slug' => 'professores',
	// 			'with_front'  => false,
	// 		),
	// 		'supports' => array('title', 'editor', 'thumbnail'),
	// 	)
	// );
}

add_action( 'init', 'create_posttypes' );


## GENERAL CHANGES TO WP "CORE" ## 
#################################

// Add copyright to wp-admin footer

function change_footer_admin() {

	echo 'Tema desenvolvido pela: <a href="http://www.3xceler.com.br" target="_blank">Agência 3xceler</a>
	| usando: <a href="http://www.wordpress.org" target="_blank">WordPress</a> </p>';

}

add_filter('admin_footer_text', 'change_footer_admin');

// remove welcome panel

remove_action('welcome_panel', 'wp_welcome_panel');

// de-register useless wp scripts

function deregister_scripts() {
	wp_deregister_script( 'wp-embed' );

	if ( !is_admin() ) {
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );
	}
}

add_action( 'wp_enqueue_scripts', 'deregister_scripts' );

// remove autop from CF7 (5.0 +)

// add_filter( 'wpcf7_autop_or_not', '__return_false' );
