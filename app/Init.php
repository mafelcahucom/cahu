<?php
namespace Cahu;

use Cahu\Theme;
use Cahu\Actions;
use Cahu\Traits\Singleton;

/**
 * Initialize.
 *
 * @version 1.0.0
 */
final class Init {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Call register classes.
	 *
	 * @return void.
	 */
	protected function __construct() {
		self::register_classes();
	}

	/**
	 * Returns all the class services.
	 *
	 * @return array  List of classes
	 */
	private static function get_classes() {
		return [
			Theme::class,
			Actions::class
		];
	}

	/**
	 * Loop through the services classes and instantiate each class.
	 */
	public static function register_classes() {
		foreach ( self::get_classes() as $class ) {
			if ( method_exists( $class, 'get_instance' ) ) {
				self::instantiate( $class );
			}
		}
	}

	/**
	 * Instantiate the given service class.
	 *
	 * @param  class  $class  Containing a class from self::get_classes().
	 * @return class
	 */
	private static function instantiate( $class ) {
		$class::get_instance();
	}
}