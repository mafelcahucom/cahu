<?php
namespace Cahu;

/**
 * Prints the site logo.
 *
 * @since 1.0.0
 * 
 * @return HTMLElement
 */
function get_logo() {
    $output = '';
    $site_name = get_bloginfo( 'name' );
    $output = '<h1 class="ma-fs-18 ma-clr-darker ma-m-0">'. $site_name .'</h1>';
    if ( ! empty( get_theme_mod( 'custom_logo' ) ) ) {
        $output = get_attachment_image( 
            get_theme_mod( 'custom_logo' ),
            [
                'class' => 'ma-logo__img'
            ],
            'featured-image'
        );
    }
    return $output;
}

/**
 * Returns the attachment image with title tag & lazyload attribute.
 *
 * @since 1.0.0
 * 
 * @param  number  $attachment_id          The target attachment id.
 * @param  array   $additional_attributes  Contains the additional attributes.
 * @param  string  $size                   The specific image size from add_image_size().
 * @return HTMLElement
 */
function get_attachment_image( $attachment_id, $additional_attributes = [], $size = 'full' ) {
    $output = '';
    if ( ! empty( $attachment_id ) ) {
        $default_attributes = [
            'title'   => get_the_title( $attachment_id ),
            'loading' => 'lazy'
        ];
        $attributes = array_merge( $additional_attributes, $default_attributes );
        $output = wp_get_attachment_image( $attachment_id, $size, false, $attributes );
    }
    return $output;
}

/**
 * Prints the image attachment form get_attachment_image(). 
 *
 * @since 1.0.0
 * 
 * @param  number  $attachment_id          The target attachment id.
 * @param  array   $additional_attributes  Contains the additional attributes.
 * @param  string  $size                   The specific image size from add_image_size().
 * @return void
 */
function the_attachment_image( $attachment_id, $additional_attributes = [], $size = 'full' ) {
    echo get_attachment_image( $attachment_id, $additional_attributes, $size );
}

/**
 * Returns the post thumbnail with title tag & lazyload attribute.
 *
 * @since 1.0.0
 * 
 * @param  number  $post_id                The target post id.
 * @param  array   $additional_attributes  Contains the additional attributes.
 * @param  string  $size                   The specific image size from add_image_size().
 * @return HTMLElement
 */
function get_custom_post_thumbnail( $post_id, $additional_attributes = [], $size = 'featured-image' ) {
    $output = '';
    if ( empty( $post_id ) ) {
        $post_id = get_the_ID();
    }

    if ( has_post_thumbnail( $post_id ) ) {
        $output = get_attachment_image( get_post_thumbnail_id( $post_id ), $additional_attributes, $size );
    }
    return $output;
}

/**
 * Prints the post thumbnail with title tag & lazyload attribute.
 *
 * @since 1.0.0
 * 
 * @param  number  $post_id                The target post id.
 * @param  array   $additional_attributes  Contains the additional attributes.
 * @param  string  $size                   The specific image size from add_image_size().
 * @return HTMLElement
 */
function the_custom_post_thumbnail( $post_id, $additional_attributes = [], $size = 'featured-image' ) {
    echo get_custom_post_thumbnail( $post_id, $additional_attributes, $size );
}


/**
 * Prints a link of date.
 *
 * @since 1.0.0
 * 
 * @param  number  $post_id  The target post id.
 * @param  string  $type     The type of format return.
 * @param  string  $format   The title format.
 * @param  string  $class    List of class.
 * @return HTMLELement
 */
function get_date_link( $post_id, $type, $format, $class = '' ) {
    $date = [
        'd'   => get_the_date( 'd', $post_id ),
        'm' => get_the_date( 'm', $post_id ),
        'y'  => get_the_date( 'Y', $post_id)
    ];

    if ( $type == 'day' ) {
        $link = get_day_link( $date['y'], $date['m'], $date['d'] );
    } elseif ( $type == 'month' ) {
        $link = get_month_link( $date['y'], $date['m'] );
    } elseif ( $type == 'year' ) {
        $link = get_year_link( $date['y'] );
    }
    $title = get_the_date( $format, $post_id );
    return '<a class="'. $class .'" href="'. $link .'">'. $title .'</a>';
}

/**
 * Prints the custom pagination.
 *
 * @since 1.0.0
 * 
 * @param  int     $total_pages  The total number of pages
 * @param  string  $class        The additional classname.
 * @return string
 */
function get_custom_pagination( $total_pages, $class = '' ){
    $output  = '';
    $output .= '<div class="'. esc_attr( $class ) .'">';
    $output .= '<ul>';

    $prev_icon = get_icon( 'chevron-back-outline', 'cu-svg' );
    $next_icon = get_icon( 'chevron-forward-outline', 'cu-svg' );

    if ( $total_pages > 1 ){
        $current_page = max( 1, get_query_var('paged') );

        if ( is_search() ) { // Removes the base in search result
             $output .= paginate_links( [
                'format'    => 'page/%#%/',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_text' => __( $prev_icon ),
                'next_text' => __( $next_icon ),
            ]);
        } else {
        	$base = get_pagenum_link( 1 );
        	if ( ! empty( $_GET ) ) {
        		$base = remove_query_arg( array_keys( $_GET ), get_pagenum_link( 1 ) );
        	}
            $output .= paginate_links( [
                'base'      => $base .'%_%',
                'format'    => 'page/%#%/',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_text' => __( $prev_icon ),
                'next_text' => __( $next_icon ),
            ]);
        }
    }

    $output .= '</ul>';
    $output .= '</div>';
    return $output;
}

/**
 * Prints the list of tags on a certain post.
 *
 * @since 1.0.0
 * 
 * @param  number  $post_id  The target post id.
 * @return HTMLElement
 */
function get_post_tag_list( $post_id ) {
	if ( empty( $post_id ) ) {
		return '';
	}

	$output = '';
	$tags   = get_the_tags( $post_id );
	if ( ! empty( $tags ) ) {
		$output .= '<ul>';
		foreach( $tags as $tag ) {
			$output .= '<li>';
			$output .= '<a href="'. esc_url( get_tag_link( $tag->term_id ) ) .'">';
			$output .= esc_html( $tag->name );
			$output .= '</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
	}
	return $output;
}

/**
 * Returns the svg icon based on icon name.
 *
 * @since 1.0.0
 * 
 * @param  string  $name  	   The name of the icon.
 * @param  string  $classname  The additional classname.
 * @return HTMLElement
 */
function get_icon( $name, $classname = '' ) {
	$output = '';
	switch ( $name ) {
		case 'search':
			$output = '<svg xmlns="http://www.w3.org/2000/svg" class="'. esc_attr( $classname ) .'" viewBox="0 0 512 512"><path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z"/></svg>';
			break;
		case 'close':
			$output = '<svg xmlns="http://www.w3.org/2000/svg" class="'. esc_attr( $classname ) .'" viewBox="0 0 512 512"><<path d="M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z"/></svg>';
			break;
		case 'menu':
			$output = '<svg xmlns="http://www.w3.org/2000/svg" class="'. esc_attr( $classname ) .'" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="48" d="M88 152h336M88 256h336M88 360h336"/></svg>';
			break;
	}
	return $output;
}