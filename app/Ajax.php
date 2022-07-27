<?php
namespace Cahu;

use Cahu\Traits\Singleton;
use Cahu\Ajax\ProjectActions;

/**
 * Ajax.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Ajax {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Instantiate all ajax action classes.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	protected function __construct() {
		// Instantiate actions.
		ProjectActions::get_instance();

		// Enqueue localize scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'register_localize_scripts' ] );
	}

	/**
	 * Register localize scripts.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function register_localize_scripts() {
		wp_localize_script( 'cahu-app-js', 'cahuLocalizeAjax', [
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => [
				'getMoreProjects' => wp_create_nonce( 'cahu_get_more_projects' )
			]
		]);
	}
}