<?php
/**
 * Search Form.
 *
 * @package cahu
 * @since   1.0.0
 * @author  Mafel John Cahucom
 */
?>

<form method="get" class="cu-search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="cu-flex cu-flex-ai-c">
		<div class="cu-width-full">
			<div class="cu-input-field">
				<input type="text" name="s" placeholder="Search...">
			</div>
		</div>
		<div class="cu-ml-10">
			<button type="submit" class="cu-search-form__submit cu-btn" aria-label="search">
				<?php echo Cahu\get_icon( 'search', 'cu-svg' ); ?>
			</button>
		</div>
	</div>
</form>