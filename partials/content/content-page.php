<?php
/**
 * Partials > Content > Content Page.
 *
 * @package cahu
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
?>

<article id="cu-post-<?php the_ID(); ?>" <?php post_class( 'cu-entry-article' ); ?>>
    <header class="cu-entry-header">
        <?php the_title( '<h1 class="cu-entry-title">', '</h1>' ); ?>
    </header>

    <?php Cahu\the_entry_post_thumbnail(); ?>

    <div class="cu-entry-content">
        <?php the_content(); ?>
    </div>
    
    <?php if ( get_edit_post_link() ): ?>
        <footer class="cu-entry-footer">
            <?php edit_post_link(); ?>
        </footer>
    <?php endif; ?>
</article>