<?php
namespace Cahu;

/**
 * Dump the data in more readable way.
 *
 * @since 1.0.0
 *
 * @param any  $data  The data to be dump.
 * @return void
 */
function dump( $data ) {
	highlight_string( "<?php\n " . var_export( $data, true ) . "?>" );
}

/**
 * Checks if the get_theme_mod setting is empty.
 *
 * @since 1.0.0
 * 
 * @param  string  $setting  The name or id of the setting.
 * @return boolean
 */
function e_mod( $setting ) {
    $output = false;
    if ( ! empty( $setting ) ) {
        if ( ! empty( get_theme_mod( $setting ) ) ) {
            $output = true;
        }
    }
    return $output;
}

/**
 * Returns the get_template_part html to string.
 *
 * @since 1.0.0 
 * 
 * @param  string  $slug  The slug name for the generic template.
 * @param  string  $name  The name of the specialised template.
 * @param  array   $args  Additional arguments passed to the template.
 * @return HTMLElement
 */
function get_template( $slug, $name = null, $args = [] ) {
    if ( empty( $slug ) ) {
        return;
    }

    ob_start();
    get_template_part( $slug, $name, $args );
    return ob_get_clean();
}

/**
 * Returns the image url of the distribution image.
 *
 * @since 1.0.0
 * 
 * @param  string  $image_name  The name of the image with file extension.
 * @return string
 */
function get_dist_image_url( $image_name ) {
    if ( empty( $image_name ) ) {
        return;
    }
    return CAHU_IMG_URI . $image_name;
}

/**
 * Returns the truncated string based on the
 * total length set.
 *
 * @since 1.0.0
 * 
 * @param  string  $content  The content to be truncated.
 * @param  int     $length   The limit of the characters.
 * @param  string  $end      The ending of trancated content.
 * @return string
 */
function get_truncated_string( $content, $length, $end = '...' ) {
    $excerpt = $content;
    $length++;
    $output = '';
    if ( mb_strlen( $excerpt ) > $length ) {
        $subex = mb_substr( $excerpt, 0, $length - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            $output .= mb_substr( $subex, 0, $excut );
        } else {
            $output .= $subex;
        }
        $output .= $end;
    } else {
        $output .= $excerpt;
    }

    return $output;
}

/**
 * Returns a boolean checking if woocoomerce plugin
 * is installed or activated in theme.
 *
 * @since 1.0.0
 * 
 * @return boolean
 */
function is_wc_active() {
    return class_exists( 'WooCommerce' );
}


/**
 * Returns the alt and title of an attachment.
 *
 * @since 1.0.0
 * 
 * @param  number  $attachment_id  The attachment id. 
 * @return string
 */
function get_attachment_data( $attachment_id ) {
    $output = '';
    if ( ! empty( $attachment_id ) ) {
        if ( wp_get_attachment_url( $attachment_id ) != false ) {
            $output = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
        }
    }
    return $output;
}