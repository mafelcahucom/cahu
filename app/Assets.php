<?php
namespace Cahu;

use Cahu\Traits\Singleton;

/**
 * Equeue & Dequeue Theme Assets.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Assets {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Setup hooks.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function __construct() {
		// Equeue actions.
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );

		// Dequeue actions.
		add_action( 'wp_enqueue_scripts', [ $this, 'remove_styles' ] );

		// Dequeue footer actions.
		add_action( 'wp_footer', [ $this, 'remove_footer_scripts' ] );

		// Dequeue jquery actions.
		add_action( 'wp_enqueue_scripts', [ $this, 'remove_jquery' ] );

		// Dequeue contact form 7 actions.
		add_action( 'wp_enqueue_scripts', [ $this, 'remove_cf7_on_unused_pages' ] );
		
        // Remove the styles and scripts for emoji support.
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
		
		// Remove the styles and scripts for rss feed.
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'feed_links', 2 );


	}

	/**
	 * Register styles.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_styles() {
		// Register styles.
		wp_register_style( 'jost', 'https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap', [], false, 'all' );
		wp_register_style( 'mafe-app', CAHU_CSS_URI . 'app.min.css', [], false, 'all' );

		// Enqueue styles.
		wp_enqueue_style( 'jost' );
		wp_enqueue_style( 'mafe-app' );
	}

	/**
	 * Register scripts.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_scripts() {
		// Register scripts.
		wp_register_script( 'mafe-app-js', CAHU_JS_URI . 'app.min.js', [], '1.0.0', true );

		// Enqueue scripts.
		wp_enqueue_script( 'mafe-app-js' );
		
	}

	/**
	 * Removes jquery in the front-end.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function remove_jquery() {
		if ( ! is_admin() ) {
			wp_deregister_script('jquery');
		}
	}

	/**
	 * Removes contact form 7 scripts and styles if 
	 * particular page is not using it.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function remove_cf7_on_unused_pages() {
		if ( ! is_page_template( 'page-contact.php' ) ) {
			wp_dequeue_style( 'contact-form-7' );
			wp_dequeue_script( 'contact-form-7' );
		}
	}

	/**
	 * Remove styles.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function remove_styles() {
		// Remove gutenberg block css.
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wp-block-library' );

		// Remove WooCommerce block css.
		wp_dequeue_style( 'wp-block-style' );
	}

	/**
	 * Remove scripts.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function remove_footer_scripts() {
		// Remove wp-embed script.
		wp_dequeue_script( 'wp-embed' );
	}
}