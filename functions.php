<?php 

## theme supports ##
####################

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    // add_image_size('example', 800, 450, true);
}

## BASE STYLESHEET AND JS FILES ## 
##################################

function registerScripts() {
	// base concatenated app.js (contains all non-cdn vendors, look at readme.md, gulpfile.js and src/js folders if you have any questions);
	wp_register_script( 'app', get_bloginfo('template_url') . '/dist/app.js', '', null, false );
	wp_enqueue_script('app');
}

add_action( 'wp_enqueue_scripts', 'registerScripts' );

function registerStyles() {
    // base stylesheet (contains all non-cdn vendors, look at readme.md, gulpfile.js, src/main.css and src/stylus)
	wp_register_style( 'basic-stylesheet', get_bloginfo('template_url') . '/dist/main.css', '',  null, 'all' );
	wp_enqueue_style( 'basic-stylesheet');
}

add_action( 'wp_enqueue_scripts', 'registerStyles' );

## GENERIC FUNCTIONS ## 
#######################

// get pages by template name

function get_pages_by_template( $template = '', $args = array() ) {
	if ( empty( $template ) ) return false;
	if ( strpos( $template, '.php' ) !== ( strlen( $template ) - 4) )  $template .= '.php';
	$args['meta_key'] = '_wp_page_template';
	$args['meta_value'] = $template;
	return get_pages($args);
}

// list on menus

function menuListing($instance) {
	$list = get_pages_by_template($instance); 

	foreach ($list as $item ) {
		$ID = $item->ID; 
		$title = $item->post_title;
		$permalink = get_permalink($ID, false);
        
        // change this to your preferred html
		echo "<li><a href=\"$permalink\" title=\"$title\">$title</a></li>";
	}

}

// generic excerpt function
// $instance being WHAT you want to excerpt (ex: get_the_content())

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

// send object to app.js via wp_localize_script
// look at src/js/x.helpers.js to find the JS handling
function hoistObject() {

	// get post id
	// $id = get_queried_object()->ID;

	// get meta 
	$url = get_bloginfo('template_url');

	// create array
	$hoist = json_encode(array(
		'url' => $url,
	));

	if (!empty($hoist) ) {
		wp_localize_script('app', 'Hoist', $hoist);
	}

}

add_action('wp_enqueue_scripts', 'hoistObject');


## POST TYPES ## 
################

function create_posttypes() {
	// $procedureLabels = array(
	// 	'name'               => _x( 'aplicações', 'post type general name'),
	// 	'singular_name'      => _x( 'aplicação', 'post type singular name'),
	// 	'menu_name'          => _x( 'aplicações', 'admin menu'),
	// 	'name_admin_bar'     => _x( 'Adicionar aplicação', 'add new on admin bar'),
	// 	'add_new'            => _x( 'Adicionar nova', ''),
	// 	'add_new_item'       => __( 'Adicionar nova aplicação'),
	// 	'new_item'           => __( 'nova aplicação'),
	// 	'edit_item'          => __( 'Editar aplicação'),
	// 	'view_item'          => __( 'Ver aplicações'),
	// 	'all_items'          => __( 'Todos aplicações'),
	// 	'search_items'       => __( 'Buscar aplicações'),
	// 	'not_found'          => __( 'Nenhum item encontrado'),
	// 	'not_found_in_trash' => __( 'Nenhum item encontrado na lixeira.')
	// );

	// register_post_type( 'aplicações',
	// 	array(
	// 		'labels' => $procedureLabels,
	// 		'public' => true,
	// 		'supports' => array('title', 'editor'),
	// 	)
	// );
}

// add_action( 'init', 'create_posttypes' );


## GENERAL CHANGES TO WP "CORE" ## 
##################################

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

        // i do this because i generally concatenate jquery into my app.js
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );
	}
}

add_action( 'wp_enqueue_scripts', 'deregister_scripts' );

// remove autop from CF7 (5.0 +) 

// add_filter( 'wpcf7_autop_or_not', '__return_false' );