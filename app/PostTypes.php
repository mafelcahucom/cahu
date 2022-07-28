<?php
namespace Cahu;

use Cahu\Traits\Singleton;

/**
 * Register Custom Post Types.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class PostTypes {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Register custom post type.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function __construct() {
		add_action( 'init', [ $this, 'project_post_type' ] );
	}

	/**
	 * Contains the project custom post type settings.
	 *
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function project_post_type() {
		$labels = array(
			'name'                  => _x( 'Projects', 'Post Type General Name', CAHU_TEXT_DOMAIN ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', CAHU_TEXT_DOMAIN ),
			'menu_name'             => __( 'Projects', CAHU_TEXT_DOMAIN ),
			'name_admin_bar'        => __( 'Projects', CAHU_TEXT_DOMAIN ),
			'archives'              => __( 'Item Archives', CAHU_TEXT_DOMAIN ),
			'attributes'            => __( 'Item Attributes', CAHU_TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Item:', CAHU_TEXT_DOMAIN ),
			'all_items'             => __( 'All Items', CAHU_TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Item', CAHU_TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', CAHU_TEXT_DOMAIN ),
			'new_item'              => __( 'New Item', CAHU_TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit Item', CAHU_TEXT_DOMAIN ),
			'update_item'           => __( 'Update Item', CAHU_TEXT_DOMAIN ),
			'view_item'             => __( 'View Item', CAHU_TEXT_DOMAIN ),
			'view_items'            => __( 'View Items', CAHU_TEXT_DOMAIN ),
			'search_items'          => __( 'Search Item', CAHU_TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', CAHU_TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', CAHU_TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', CAHU_TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', CAHU_TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', CAHU_TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', CAHU_TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into item', CAHU_TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', CAHU_TEXT_DOMAIN ),
			'items_list'            => __( 'Items list', CAHU_TEXT_DOMAIN ),
			'items_list_navigation' => __( 'Items list navigation', CAHU_TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter items list', CAHU_TEXT_DOMAIN ),
		);
		$args = array(
			'label'                 => __( 'Project', CAHU_TEXT_DOMAIN ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-media-document',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'projects', $args );
	}
}