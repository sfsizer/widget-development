<?php
/**
 * Plugin Name: Elementor Card Widget
 * Description: Card widget for Elementor.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: custom-card
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Card Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function elementor_card_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/product-card-widget.php' );

	$widgets_manager->register( new \Elementor_Card_Widget() );

}
add_action( 'elementor/widgets/register', 'elementor_card_widget' );
function elementor_card_assets() {

    wp_register_style(
        'elementor_card_css',
        plugin_dir_url( __FILE__ ) . 'assets/output.css'
    );

}
add_action( 'wp_enqueue_scripts', 'elementor_card_assets' );