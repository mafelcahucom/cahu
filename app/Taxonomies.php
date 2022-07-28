<?php
namespace Cahu;

use Cahu\Traits\Singleton;

/**
 * Register Taxonomies.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Taxonomies {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Register taxonomies.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function __construct() {
		add_action( 'init', [ $this, 'developer_taxonomy' ] );
	}

	/**
	 * Contains the developer taxnomy settings.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function developer_taxonomy() {
		$labels = array(
			'name'				=> 'Developer',
			'singlar_name'		=> 'Developer',
			'search_items'		=> 'Search Developer',
			'all_items'			=> 'All Developer',
			'parent_item'		=> 'Parent Developer',
			'parent_item_colon' => 'Parent Developer:',
			'edit_item'			=> 'Edit Developer',
			'update_item'		=> 'Update Developer',
			'add_new_item'		=> 'Add New Developer',
			'new_item_name'		=> 'New Developer Name',
			'menu_name'			=> 'Developer'
		);
		$args = array(
			'hierarchical'		=> true,
			'labels'			=> $labels,
			'show_ui'			=> true,
			'show_admin_column'	=> true,
			'query_var'			=> true,
			'rewrite'			=> array( 
				'slug'		 => 'developer',
				'with_front' => false 
			)
		);
		register_taxonomy( 'developer', array( 'projects' ), $args );
	}
}