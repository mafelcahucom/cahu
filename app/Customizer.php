<?php
namespace Cahu;

use Kirki;
use Cahu\Traits\Singleton;

/**
 * Customizer.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Customizer {

	/**
     * Inherit Singleton.
     */
    use Singleton;

    /**
     * Load & Register fields.
     *
     * @since 1.0.0
     *
     * @return void
     */
	protected function __construct() {
		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		// Load fields.
		$this->load_fields();
	}

	/**
	 * Returns the full customizer full path directory.
	 *
	 * @since 1.0.0
	 *
	 * @param  string  $filename  Containing the target filename
	 * @return string
	 */
	private static function field_full_path( $filename ) {
		if ( empty( $filename ) ) {
			return;
		}

		return get_parent_theme_file_path( '/app/Customizer/'. $filename );
	}

	/**
	 * Require all the customizer fields.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_fields() {
		require_once self::field_full_path( '404-page-fields.php' );
	}
}