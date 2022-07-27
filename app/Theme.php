<?php
namespace Cahu;

use Cahu\Menus;
use Cahu\Assets;
use Cahu\Traits\Singleton;

/**
 * Theme setup.
 *
 * @version 1.0.0
 */
final class Theme {

    /**
     * Inherit Singleton.
     */
    use Singleton;

    /**
     * Register theme support.
     *
     * @return void
     */
	protected function __construct() {
        // Instantiate.
        Menus::get_instance();
        Assets::get_instance();

        // Actions.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
	}

    /**
     * Setup theme support.
     *
     * @return void
     */
    public function setup() {
        /*
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_image_size( 'blog-thumbnail', 500, 375, false );
        
        /**
         * Add theme support for selective refresh for widgets.
         */
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
}