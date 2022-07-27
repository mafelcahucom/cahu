<?php
/**
 * 404 Page Fields.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */

new \Kirki\Panel(
	'mafe_404_panel',
	[
		'title'       => esc_html__( '404 Page', CAHU_TEXT_DOMAIN ),
		'description' => esc_html__( 'Contains all the field of 404 page.', CAHU_TEXT_DOMAIN ),
	]
);

/**
 * Componets
 */
new \Kirki\Section(
	'mafe_404_section_components',
	[
		'title'       => esc_html__( 'Components', CAHU_TEXT_DOMAIN ),
		'description' => esc_html__( 'Edit components.', CAHU_TEXT_DOMAIN ),
		'panel'       => 'mafe_404_panel',
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'mafe_404_illustration',
		'label'       => esc_html__( 'Illustration', CAHU_TEXT_DOMAIN ),
		'section'     => 'mafe_404_section_components',
		'choices'     => [
			'save_as' => 'id',
		],
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'mafe_404_title',
		'label'    => esc_html__( 'Title', CAHU_TEXT_DOMAIN ),
		'section'  => 'mafe_404_section_components'
	]
);

new \Kirki\Field\Textarea(
	[
		'settings' => 'mafe_404_short_message',
		'label'    => esc_html__( 'Short Message', CAHU_TEXT_DOMAIN ),
		'section'  => 'mafe_404_section_components'
	]
);