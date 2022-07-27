<?php
namespace Cahu;

use Cahu\Traits\Singleton;

/**
 * Register Menus.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Menus {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Register menu action.
	 *
	 * @return void
	 */
	protected function __construct() {
		add_action( 'init', [ $this, 'register_menus' ] );
	}

	/**
	 * List of menus.
	 * 
	 * @return void
	 */
	public function register_menus() {
		register_nav_menus([
			'header-nav' => __( 'Header Navigation' )
		]);
	}
}