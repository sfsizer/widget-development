<?php
/**
 * Plugin Name: Shahriar Widget
 * Description: Custom widget for Elementor.
 * Plugin URI:  https://github.com/sfsizer/widget-development
 * Version:     1.0.0
 * Author:      Md. Shahriar
 * Author URI:  https://shahriar-portfolio-static.vercel.app/
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
    require_once( __DIR__ . '/widgets/slider-widget.php' );
    require_once( __DIR__ . '/widgets/skill-animated-card.php' );
    require_once( __DIR__ . '/widgets/glass-card.php' );
    require_once( __DIR__ . '/widgets/hero-post-type-slider.php' );

	$widgets_manager->register( new \Elementor_Card_Widget() );
    $widgets_manager->register( new \Elementor_Slider_Widget() );
    $widgets_manager->register( new \Elementor_Skill_Widget() );
    $widgets_manager->register( new \Elementor_Glass_Card_Widget() );
    $widgets_manager->register( new \Elementor_Hero_Post_type_Slider_Widget() );

}
add_action( 'elementor/widgets/register', 'elementor_card_widget' );
function elementor_card_assets() {

    wp_register_style(
        'elementor_card_css',
        plugin_dir_url( __FILE__ ) . 'assets/output.css',
    );
    wp_register_style(
        'skill_card_css',
        plugin_dir_url( __FILE__ ) . 'assets/style.css',
    );
    wp_register_style(
        'elementor_slider_css',
        plugin_dir_url( __FILE__ ) . 'assets/sliderassets/src/output.css',
    );
    wp_register_style(
        'elementor_slick_css',
        plugin_dir_url( __FILE__ ) . 'assets/sliderassets/src/slick.min.css',
    );
    wp_register_style(
        'elementor_extra_css',
        plugin_dir_url( __FILE__ ) . 'assets/sliderassets/src/extra.css',
    );
    wp_register_style(
        'glass_card_css',
        plugin_dir_url( __FILE__ ) . 'assets/glass-card.css',
    );
    wp_register_style(
        'hero_post_type_slider_css',
        plugin_dir_url( __FILE__ ) . 'assets/hero-post-type-slider-assets/style.css',
    );
   wp_register_script(
		'custome_slick_js',
		plugin_dir_url(__FILE__) . 'assets/sliderassets/js/slick.min.js',
		[ 'jquery' ],
		'1.8.1',
		true
	);

	wp_register_script(
		'custome_main_js',
		plugin_dir_url(__FILE__) . 'assets/sliderassets/js/main.js',
		[ 'jquery', 'custome_slick_js' ],
		'1.0',
		true
	);
	wp_register_script(
		'custom_hero_post_type_main_js',
		plugin_dir_url(__FILE__) . 'assets/hero-post-type-slider-assets/main-hero.js'
	);
}
add_action( 'wp_enqueue_scripts', 'elementor_card_assets' );
