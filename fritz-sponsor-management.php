<?php

/**
 * Plugin Name: Fritz Sponsor Managment
 * Description: Fritz Sponsor Managment
 * Version:     1.0.0
 * Author:      Robin Furrer
 * Author URI:  https://agentur-fritz.ch
 * License:     Apache License, Version 2.0
 * License URI: https://www.apache.org/licenses/LICENSE-2.0
 * Text Domain: fritz-post
 * Domain Path: /languages
 *
 * @package           create-block
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/*
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_fritz_block_init()
{
	register_block_type(__DIR__ . '/build/text');

}
add_action('init', 'create_fritz_block_init');

function fritz_post_enqueue()
{
	wp_enqueue_style(
		'fritz_post_css',
		plugin_dir_url(__FILE__) . 'styles.css'
	);
}

add_action('wp_enqueue_scripts', 'fritz_post_enqueue');
add_action('admin_enqueue_scripts', 'fritz_post_enqueue');

function example() {
	return "true";
}

// rest endpoint preparation, for now just an example
function fritz_post_rest_api_routes()
{
	add_action('rest_api_init', function () {
		register_rest_route('fritz-post/v2', '/example', array(
			'methods' => 'GET',
			'callback' => 'example',
			'permission_callback' => '__return_true'
		)
		);
	});
}

add_action('init', 'fritz_post_rest_api_routes');

function fritz_post_load_textdomain() {
	load_plugin_textdomain( 'fritz-post', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action('init', 'fritz_post_load_textdomain');
?>