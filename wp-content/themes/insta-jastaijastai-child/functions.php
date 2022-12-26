<?php 
add_action( 'wp_enqueue_scripts', 'insta_jastaijastai_child_enqueue_styles' );
function insta_jastaijastai_child_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
}

// linking css
function my_scripts() {
  wp_enqueue_style( 'my_style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action( 'wp_enqueue_scripts', 'my_scripts', 11 );
?>