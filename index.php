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

    <main id="cu-primary" class="cu-site-main" role="main">
        <div class="cu-container">
        
        <?php
            if ( have_posts() ):
                while ( have_posts() ):
                    the_post();
                endwhile;
            else:

            endif;
        ?>
        
        </div>
    </main>

<?php
get_footer();