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


// send object to app.js via wp_localize_script
// look at src/js/x.helpers.js to find the JS handling
function hoistObject() {

	// URLS
	$url = get_bloginfo('template_url');
	$adminURL = admin_url('admin-ajax.php');
	$homeURL = home_url('/');

	// create array
	$hoist = json_encode(array(
		'url' => $url,
		'adminURL' => $adminURL,
		'homeURL' => $homeURL,
	));

	if (!empty($hoist) ) {
		wp_localize_script('app', 'Hoist', $hoist);
	}

}

add_action('wp_enqueue_scripts', 'hoistObject');


## POST TYPES ## 
################

// function create_posttypes() {
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
// }

// add_action( 'init', 'create_posttypes' );

## TAXONOMIES ## 
################

// function registerTaxonomies() {

//     // serviços
// 	$servicos = array(
// 		'name' => _x('Tipos de Serviço', 'taxonomy general name'),
// 		'singular_name' => _x('Serviço', 'taxonomy singular name'),
// 		'search_items' => __('Procurar Serviço'),
// 		'all_items' => __('Todos os Serviços'),
// 		'parent_item' => __('Serviço Pai'),
// 		'parent_item_colon' => __('Serviço Pai:'),
// 		'edit_item' => __('Editar Serviço'),
// 		'update_item' => __('Atualizar Serviço'),
// 		'add_new_item' => __('Adicionar novo Serviço'),
// 		'new_item_name' => __('Nome da novo Serviço'),
// 		'menu_name' => __('Serviços'),
// 	);

// 	$servArgs = array(
// 		'labels' => $servicos,
// 		'hierarchical' => true,
// 		'public' => true,
// 		'show_ui' => true,
// 		'show_in_menu' => true,
// 		'show_admin_column' => true,
// 		'query_var' => true,
// 		'rewrite' => array('slug' => 'servicos', 'with_front' => false),
// 	);

// 	register_taxonomy('servicos', 'page', $servArgs);
// }

// add_action('init', 'registerTaxonomies');


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

add_filter( 'wpcf7_autop_or_not', '__return_false' );


// remove margin top from admin bar

function remove_admin_login_header()
{
	remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('init', 'remove_admin_login_header');

/**
 * Disable the emoji's
*/

function disable_emojis() {

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );

}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// disable the admin bar
add_filter('show_admin_bar', '__return_false');
show_admin_bar(false);

function hideAdminBar() { ?>
	<style type="text/css">.show-admin-bar { display: none; }</style>
<?php }
add_action('admin_print_scripts-profile.php', 'hideAdminBar');


//Disable gutenberg style in Front
function wps_deregister_styles() {
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );