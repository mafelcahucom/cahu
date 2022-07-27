<?php
/**
 * Theme functions and definitions.
 *
 * @package cahu
 * @since   1.0.0
 * @author  Mafel John Cahucom
 */

/**
 * Define constact variables.
 *
 * @since 1.0.0
 */
if ( ! defined( 'CAHU_TEXT_DOMAIN' ) ) {
    define( 'CAHU_TEXT_DOMAIN', 'cahu' );
}

if ( ! defined( 'CAHU_URI' ) ) {
    define( 'CAHU_URI', get_stylesheet_directory_uri() );
}

if ( ! defined( 'CAHU_ASSETS_DIST_URI' ) ) {
    define( 'CAHU_ASSETS_DIST_URI', CAHU_URI .'/assets/dist/' );
}

if ( ! defined( 'CAHU_CSS_URI' ) ) {
    define( 'CAHU_CSS_URI', CAHU_ASSETS_DIST_URI .'css/' );
}

if ( ! defined( 'CAHU_JS_URI' ) ) {
    define( 'CAHU_JS_URI', CAHU_ASSETS_DIST_URI .'js/' );
}

if ( ! defined( 'CAHU_IMG_URI' ) ) {
    define( 'CAHU_IMG_URI', CAHU_ASSETS_DIST_URI .'img/' );
}

/**
 * VENDOR: Include autoloader.
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * VENDOR: Include kirki.
 */
if ( file_exists( dirname( __FILE__ ) .'/vendor/aristath/kirki/kirki.php' ) ) {
    require_once dirname( __FILE__ ) .'/vendor/aristath/kirki/kirki.php';
}

/**
 * Initialize theme.
 */
if ( class_exists( 'Cahu\\Init' ) ) {
    Cahu\Init::get_instance();

    /**
     * Helpers functions.
     */
    if ( file_exists( dirname( __FILE__ ) .'/app/Helpers.php' ) ) {
        require_once dirname( __FILE__ ) .'/app/Helpers.php';
    }

    /**
     * Template tags functions.
     */
    if ( file_exists( dirname( __FILE__ ) .'/app/TemplateTags.php' ) ) {
        require_once dirname( __FILE__ ) .'/app/TemplateTags.php';
    }
}