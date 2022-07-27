<?php
/**
 * Header.
 *
 * @package cahu
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- header -->
	<header id="cu-js-header" class="cu-header">
		<div class="cu-container">
			<div class="cu-flex cu-flex-jc-sb cu-flex-ai-c">
				<div class="cu-logo">
					<a href="<?php echo get_home_url(); ?>">
						<img src="<?php echo CAHU_IMG_URI .'logo.jpg' ?>">
					</a>
				</div>
				<div class="cu-flex">
					<div class="cu-hide-sm">
						<?php get_template_part( 'partials/header/navigation' ); ?>
					</div>
					<div id="cu-js-header-search" class="cu-header__search cu-hide-sm" data-state="close">
						<button id="cu-js-header-search-btn" class="cu-header__search__btn" title="Open Search Form">
							<?php echo Cahu\get_icon( 'search', 'cu-header__search__magnify cu-svg' ); ?>
							<?php echo Cahu\get_icon( 'close', 'cu-header__search__close cu-svg' ); ?>
						</button>
						<div class="cu-header__search__panel">
							<?php get_search_form(); ?>
						</div>
					</div>
					<div class="cu-hide cu-show-sm">
						<div class="cu-flex-cc cu-height-full">
							<button class="cu-btn cu-btn--primary cu-btn--circle mjsidebar__toggle-btn" 
									title="Open Sidebar" 
									data-event="open"
									arial-lable="menu">
									<?php echo Cahu\get_icon( 'menu', 'cu-svg' ); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end: header -->

	<!-- sidebar navigation -->
	<?php get_template_part( 'partials/header/sidebar-navigation' ); ?>
	<!-- end: sidebar navigation -->