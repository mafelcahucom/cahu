<?php
/**
 * Index.
 *
 * @package cahu
 * @since   1.0.0
 * @author  Mafel John Cahucom
 */

get_header(); 
?>
    <div style="height: 200px; width: 20px;"></div>
    <main id="cu-primary" class="cu-site-main" role="main">
        <div class="cu-container">
        
        <?php
            if ( have_posts() ):
                while ( have_posts() ):
                    the_post();

                    get_template_part( 'partials/content/content', get_post_type() );
                endwhile;
            else:

            endif;
        ?>

        <?php

            $args = [
                'post_type' => 'projects',
                'post_status' => 'publish',
                'posts_per_page' => -1
            ];
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    echo '<h1>'. get_the_title() .'</h1>';
                    echo '<p>Category Lists</p>';
                    Cahu\the_post_category_list( get_the_ID() );
                    echo '<p>Tag Lists</p>';
                    Cahu\the_post_tag_list( get_the_ID() );
                    echo '<p>Taxonomy Lists</p>';
                    Cahu\the_post_term_list( get_the_ID(), 'developer' );
                }
            }

            echo '<p>Categories Lists</p>';
            Cahu\the_categories_list( true, 'some-class' );
            echo '<p>Tags Lists</p>';
            Cahu\the_tags_list( true, 'some-class' );
            echo '<p>Terms Lists</p>';
            Cahu\the_terms_list( 'developer', true, 'some-class' );

        ?>

        </div>
    </main>

<?php
get_footer();