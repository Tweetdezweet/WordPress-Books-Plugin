<?php
/*
Plugin Name: Oxfam Books Plugin
Plugin URI:  https://koengabriels.be
Description: WordPress plugin to support the sales and inventory management of secondhand books for Oxfam
Version:     20170828
Author:      Koen Gabriëls
Author URI:  https://koengabriels.be
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: oxfambooks
Domain Path: /languages
*/

function register_oxfam_books_submenu_page() {
	$submenu_page = add_submenu_page(
		'edit.php?post_type=product',
		'Oxfam Secondhand books',
		'Oxfam Secondhand books',
		'manage_options',
		'oxfam-books-submenu-page',
		'oxfam_books_submenu_page_callback'
	);

	add_action( 'admin_print_styles-' . $submenu_page, 'add_stylesheets' );
	add_action( 'admin_print_scripts-' . $submenu_page, 'add_scripts' );
}
function oxfam_books_submenu_page_callback() {
	include_once __DIR__ . "/views/book.php";
}
add_action('admin_menu', 'register_oxfam_books_submenu_page',99);

function add_stylesheets() {
	wp_enqueue_style( 'oxfam_stylesheet', plugin_dir_url( __FILE__) . 'css/book.css' );
}

function add_scripts() {
	wp_enqueue_script( 'oxfam_script', plugin_dir_url( __FILE__) . 'js/book.js' );
}