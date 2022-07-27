<?php
/**
 * Partials > Content > Content.
 *
 * @package cahu
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
?>

<article id="cu-post-<?php the_ID(); ?>" <?php post_class( 'cu-entry-article' ); ?>>
    <header class="cu-entry-header">
        <h1 class="cu-entry-title">
            <?php if ( is_single() ): ?>
                <?php echo esc_html( get_the_title() ); ?>
            <?php else: ?>
                <a href="<?php echo get_permalink(); ?>" rel="bookmark">
                    <?php echo esc_html( get_the_title() ); ?>
                </a>
            <?php endif; ?>
        </h1>
        <div class="cu-entry-meta">
            <?php Cahu\the_entry_posted_on( 'Posted On' ); ?>
            <?php Cahu\the_entry_posted_by( 'Posted By' ); ?>
        </div>
    </header>
    <?php Cahu\the_entry_post_thumbnail(); ?>
    <div class="cu-entry-content">
        <?php the_content(); ?>
    </div>
    <footer class="cu-entry-footer">
        <?php Cahu\the_tag_list(); ?>
        <?php var_dump( wp_get_post_categories( get_the_ID(), [ 'fields' => 'all' ] ) ); ?>
    </footer>
</article>