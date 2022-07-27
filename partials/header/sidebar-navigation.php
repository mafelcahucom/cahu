<?php
/**
 * Partials > Header > Sidebar Navigation.
 *
 * @package cahu
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
?>
<div class="mjsidebar">
	<div class="mjsidebar__overlay">
		<div class="mjsidebar__panel">
			<button class="mjsidebar__close-btn mjsidebar__toggle-btn" title="Close" data-event="close"></button>
			<div class="mjsidebar__search">
				<?php echo get_search_form(); ?>
			</div>
			<?php
			wp_nav_menu([
				'theme_location' 		=> 'header-nav',
				'container'				=> 'ul',
				'depth'          		=> 3,
				'menu_class'			=> 'mjnav'
			]);
			?>
		</div>
	</div>
</div>