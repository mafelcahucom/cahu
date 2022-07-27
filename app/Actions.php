<?php
namespace Cahu;

use Cahu\Traits\Singleton;

/**
 * Actions.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Actions {

    /**
     * Inherit Singleton.
     */
    use Singleton;

    /**
     * Register actions.
     *
     * @return void.
     */
	protected function __construct() {
	   // Actions.
        add_action( 'admin_head', [ $this, 'fix_svg_thumbnail_in_wp_media_directory' ] );
	}

    /**
     * Fix the SVG thumbnail style in admin media directory.
     *
     * @since 1.0.0
     * 
     * @return void
     */
    public function fix_svg_thumbnail_in_wp_media_directory() {
        echo '<style type="text/css">
                td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
                  width: 100% !important; 
                  height: auto !important; 
                }
             </style>';
    }

    
}