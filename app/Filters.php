<?php
namespace Mafe;

use Cahu\Traits\Singleton;

/**
 * Filters.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Filters {

    /**
     * Inherit Singleton.
     */
    use Singleton;


    /**
     * Register Filters.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct() {
      // Filters.
      add_filter( 'script_loader_tag',[ $this, 'defer_parsing_of_js' ], 10 );
      add_filter( 'wp_check_filetype_and_ext', [ $this, 'allow_svg_filetype' ], 10, 4 );
      add_filter( 'upload_mimes', [ $this, 'cc_svg_types' ] );
    }


   /**
    * Add defer attribute to all scripts.
    *
    * @since 1.0.0
    * 
    * @param  string  $url  The script url.
    * @return string
    */
   public function defer_parsing_of_js( $url ) {
      if ( is_admin() ) return $url;
      if ( false == stripos( $url, '.js' ) ) return $url;
      if ( stripos( $url, 'jquery.js' ) ) return $url;
      return str_replace( ' src', ' defer src', $url );
   }


   /**
    * Allows the svg filetype to be uploaded in media library.
    * Note: use only in wp_version 4.7.1.
    *
    * @since 1.0.0
    * 
    * @return void
    */
   public function allow_svg_filetype( $data, $file, $filename, $mimes ) {
      $filetype = wp_check_filetype( $filename, $mimes );
      return [
         'ext'             => $filetype['ext'],
         'type'            => $filetype['type'],
         'proper_filename' => $data['proper_filename']
      ];
  }

   /**
    * Adding the svg file extention in the mimes.
    *
    * @since 1.0.0
    * 
    * @param  array  $mimes  Containing the list of mimes
    * @return array
    */
   public function cc_svg_types( $mimes ) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
   }
}