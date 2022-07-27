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
        <?php if ( is_single() ): ?>
            <h1 class="cu-entry-title">
                <?php echo esc_html( get_the_title() ); ?>
            </h1>
        <?php else: ?>
            <h1 class="cu-entry-title">
                <a href="<?php echo get_permalink(); ?>" rel="bookmark">
                    <?php echo esc_html( get_the_title() ); ?>
                </a>
            </h1>
        <?php endif; ?>
    </header>
</article>