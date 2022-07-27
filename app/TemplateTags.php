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
function get_custom_post_thumbnail( $post_id = 0, $additional_attributes = [], $size = 'featured-image' ) {
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
function the_custom_post_thumbnail( $post_id = 0, $additional_attributes = [], $size = 'featured-image' ) {
    echo get_custom_post_thumbnail( $post_id, $additional_attributes, $size );
}

/**
 * Return the entry post thumbnail.
 *
 * @since 1.0.0
 * 
 * @return HTMLElement
 */
function get_entry_post_thumbnail() {
    if ( ! has_post_thumbnail() || is_attachment() ) {
        return;
    }

    $output = '';
    $output .= '<figure class="cu-entry-post-thumbnail">';
    if ( is_single() ) {
        $output .= get_custom_post_thumbnail( get_the_ID() );
    } else {
        $output .= '<a href="'. get_permalink() .'" aria-hidden="true">';
        $output .= get_custom_post_thumbnail( get_the_ID() );
        $output .= '</a>'; 
    }
    $output .= '</figure>';
    return $output; 
}

/**
 * Prints the entry post thumbnail.
 *
 * @since 1.0.0
 * 
 * @return void
 */
function the_entry_post_thumbnail() {
    echo get_entry_post_thumbnail();
}

/**
 * Return the entry post author link.
 *
 * @since 1.0.0
 * 
 * @param  string  $label  The link label.
 * @return HTMLElement
 */
function get_entry_posted_by( $label = '' ) {
    $link  = '';
    $link .= '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" class="cu-entry-author__link">';
    $link .= esc_html( get_the_author() );
    $link .= '</a>';

    $output = $link;
    if ( ! empty( $label ) ) {
        $output = '<span class="cu-entry-author cu-entry-author__label">'. esc_html( $label ) .' '. $link .'</span>';
    }
    return $output;
}

/**
 * Prints the entry post author link.
 *
 * @since 1.0.0
 * 
 * @param  string  $label  The link label.
 * @return void
 */
function the_entry_posted_by( $label = '' ) {
    echo get_entry_posted_by( $label );
}

/**
 * Returns the entry post posted on date link.
 *
 * @since 1.0.0
 * 
 * @param  string  $label  The link label.
 * @return HTMLElement
 */
function get_entry_posted_on( $label = '' ) {
    $link = get_date_link( get_the_ID(), 'day', 'F d, Y', 'cu-entry-date__link' );

    $output = $link;
    if ( ! empty( $label ) ) {
        $output = '<span class="cu-entry-date">'. esc_html( $label ) .' '.$link .'</span>';
    }
    return $output;
}

/**
 * Prints the entry post posted on date link.
 *
 * @since 1.0.0
 * 
 * @param  string  $label  The link label.
 * @return HTMLElement
 */
function the_entry_posted_on( $label = '' ) {
    echo get_entry_posted_on( $label );
}

/**
 * Returns the tag list.
 *
 * @since 1.0.0
 * 
 * @param  int     $post_id  The post id target.
 * @param  string  $class    Additional class.
 * @return HTMLElement
 */
function get_tag_list( $post_id = 0, $class = '' ) {
    if ( empty( $post_id ) ) {
        $post_id = get_the_ID();
    }

    $output = '';
    $tags   = get_the_tags( $post_id );
    if ( ! empty( $tags ) ) {
        $output .= '<ul class="'. esc_attr( $class ) .'">';
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
 * Prints the tag list.
 *
 * @since 1.0.0
 * 
 * @param  int     $post_id  The post id target.
 * @param  string  $class    Additional class.
 * @return void
 */
function the_tag_list( $post_id = 0, $class = '' ) {
    echo get_tag_list( $post_id, $class );
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
function get_date_link( $post_id, $type = 'day', $format = 'F d, Y', $class = '' ) {
    $date = [
        'd' => get_the_date( 'd', $post_id ),
        'm' => get_the_date( 'm', $post_id ),
        'y' => get_the_date( 'Y', $post_id )
    ];

    switch( $type ) {
        case 'day':
            $link = get_day_link( $date['y'], $date['m'], $date['d'] );
            break;
        case 'month':
            $link = get_month_link( $date['y'], $date['m'] );
            break;
        case 'year':
            $link = get_year_link( $date['y'] );
            break;
    }

    $formated_date = get_the_date( $format, $post_id );
    $output  = '<a class="'. esc_attr( $class ) .'" href="'. esc_url( $link ) .'">';
    $output .= '<time datetime="'. get_the_date( 'yy-mm-dd', $post_id ) .'">'. $formated_date .'</time>';
    $output .= '</a>';
    return $output;
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