<?php

function load_stylesheets(){

	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
	wp_enqueue_style('bootstrap');
	

	wp_register_style('stylesheet', get_template_directory_uri() . '/style.css', array(), false, 'all');
	wp_enqueue_style('stylesheet');

}
add_action('wp_enqueue_scripts', 'load_stylesheets');

function include_jquery(){
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-3.5.1.min.js', '', 1, true);
	add_action('wp_enqueue_script', 'jquery');
}
add_action('wp_enqueue_scripts', 'include_jquery');


function load_js(){

	wp_register_script('customjs', get_template_directory_uri() . '/js/scripts.js', '', 1, true);
	wp_enqueue_script('customjs');

	wp_register_script('slideContentjs', get_template_directory_uri() . '/js/slideContent.js', '', 1, true);
	wp_enqueue_script('slideContentjs');

}
add_action('wp_enqueue_scripts', 'load_js');


// MENU
add_theme_support('menus');
register_nav_menus(
	array(
		'top-menu' => __('Top Menu', 'theme'),
		'footer-menu' => __('Footer menu', 'theme')
	)
);

/* Change excerpt length */ 
/*
function get_excerpt( $count ) {
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_content();
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $count);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = '<p>'.$excerpt.'... <a href="'.$permalink.'">Read More</a></p>';
	return $excerpt;
}
*/
function wplab_custom_excerpt_length( $length ) {
	return 25;
	//return 999;
}
add_filter( 'excerpt_length', 'wplab_custom_excerpt_length', 999 );

function wplab_new_excerpt_more( $more ) {
	return '' . __( ' (...)', 'your-text-domain' ) . '';
}
add_filter( 'excerpt_more', 'wplab_new_excerpt_more' );

add_theme_support( 'post-thumbnails' );

/*
function czy_kategoria_istnieje($cat_name, $parent = 0) {
	$id = term_exists($cat_name, 'category', $parent);
	if ( is_array($id) ) return true;
	else return false;
}
*/

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

?>