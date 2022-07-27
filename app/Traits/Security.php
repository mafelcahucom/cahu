<?php
namespace Cahu\Traits;

/**
 * Security.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
trait Security {

	/**
     * Protected class constructor to prevent direct object creation.
     */
    protected function __construct() {
    }

    /**
     * Checks if the post request for ajax has been pass for security.
     *
     * @since 1.0.0
     * 
     * @param  array   $post    Containg the $_POST data.
     * @return boolean
     */
    final private static function is_security_passed( $post ) {
    	$result = true;

    	// Check if the event is not ajax.
    	if ( ! DOING_AJAX ) {
    		return false;
    	}

    	// Check if nonce is valid.
		if ( ! isset( $post['nonce'] ) || ! wp_verify_nonce( $post['nonce'], $post['action'] ) ) {
			$result = false;
		}

		return $result;
    }

    /**
     * Checks if $_POST has empty data based on defined array key index.
     *
     * @since 1.0.0
     * 
     * @param  array   $post  Containg the $_POST data.
     * @param  array   $keys  List of keys in post.
     * @return boolean
     */
    final private static function has_post_empty_data( $post, $keys = [] ) {
    	if ( $keys ) {
			foreach( $keys as $key ) {
				if ( empty( $post[ $key ] ) ) {
					return true;
				}
			}
		}
		return false;
    }
}