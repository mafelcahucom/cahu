<?php
/**
 * Partials > Header > Navigation.
 *
 * @package cahu
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
?>
<nav class="cu-nav">
	<?php
		wp_nav_menu([
			'theme_location' 		=> 'header-nav',
			'container'				=> 'ul',
			'depth'          		=> 3,
			'menu_class'			=> 'cu-nav__menu'
		]);
	?>
</nav>