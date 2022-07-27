<?php
namespace Cahu\Ajax;

use Cahu\Traits\Singleton;
use Cahu\Traits\Security;

/**
 * Ajax Project Post Type Actions.
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class ProjectActions {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Inherit Security.
	 */
	use Security;

	/**
	 * Register ajax action.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function __construct() {
		add_action( 'wp_ajax_cahu_get_more_projects', [ $this, 'get_more_projects' ] );
		add_action( 'wp_ajax_nopriv_cahu_get_more_projects', [ $this, 'get_more_projects' ] );
	}

	/**
	 * Returns project theme thumbnails or ajax pagination.
	 *
	 * @since 1.0.0
	 * 
	 * @return json
	 */
	public function get_more_projects() {
		if ( ! self::is_security_passed( $_POST ) ) {
			wp_send_json_error([
				'error' => 'SECURITY_ERROR'
			]);
		}

		if ( self::has_post_empty_data( $_POST, [ 'page', 'total_post' ] ) ) {
			wp_send_json_error([
				'error' => 'MISSING_DATA_ERROR'
			]);
		}

		if ( ! is_numeric( $_POST['page'] ) || ! is_numeric( $_POST['total_post'] ) ) {
			wp_send_json_error([
				'error' => 'TOTAL_PAGE_ERROR'
			]);
		}

		$args = [
			'post_type' 	 => 'projects',
			'post_status'	 => 'publish',
			'posts_per_page' => $_POST['total_post'],
			'paged'			 => $_POST['page']
		];
		$query = new \WP_Query( $args );

		$thumbnails = '';
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$thumbnails .= \Cahu\get_template( 'partials/project/theme-thumbnail', null, [
					'id'		=> get_the_ID(),
					'title' 	=> get_the_title(),
					'type'		=> get_field('type'),
					'site_link' => get_field('link'),
					'permalink' => get_permalink(),
					'thumbnail' => \Cahu\get_custom_post_thumbnail( get_the_ID() ),
					'animate'	=> 'enable'
				]);
			}
		} else {
			wp_send_json_error([
				'error' => 'NO_POST_FOUND_ERROR'
			]);
		}
		wp_reset_postdata();
		wp_send_json_success([
			'thumbnails'    => $thumbnails,
			'max_num_pages' => $query->max_num_pages
		]);
	}
}