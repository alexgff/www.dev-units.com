<?php

/**
 * Initialize.
 */
define( 'UNITS_THEME_VERSION', '1.0.0' );
define( 'UNITS_THEME_YANDEX_API_KEY', '5ea541c2-8d1c-459d-81dc-fb77a608ecd3' );
define( 'UNITS_THEME_YANDEX_MAP_ID', 'units_theme__yandex_map_post_' );

/** 
 * Enqueue the parent theme stylesheet.
 */
add_action( 'wp_enqueue_scripts', 'units_theme__enqueue_styles' );
function units_theme__enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

/** 
 * Enqueue Yandex Map API.
 *
 * @since 1.0.0
 */
add_action( 'wp_head', 'units_theme__wp_head' );
function units_theme__wp_head() {
	echo '<script src="https://api-maps.yandex.ru/2.1/?apikey='.UNITS_THEME_YANDEX_API_KEY.'&lang=ru_RU" type="text/javascript"></script>';
}

/** 
 * Enqueue custom scripts.
 *
 * @since 1.0.0
 */
add_action( 'wp_enqueue_scripts', 'units_theme__enqueue_scripts' );
function units_theme__enqueue_scripts() {
	
	global $post;
	
	$is_archive = false;
	if ( is_archive() ) {
		$is_archive = true;
	}
	
	wp_register_script(
		'units-theme',
		get_stylesheet_directory_uri() . '/assets/js/units-theme.js',
		array( 'jquery' ),
		UNITS_THEME_VERSION,
		true
	);
	wp_enqueue_script( 'units-theme' );
	wp_localize_script(
		'units-theme',
		'UnitsTheme',
		array(
			'version'    => UNITS_THEME_VERSION,
			'postTitle'  => empty($post->post_title) ? '' : $post->post_title,
			'postID' 	 => $post->ID,
			'is_archive' => $is_archive,
			'postIDs'	 => '',
			'mapID'	  	 => UNITS_THEME_YANDEX_MAP_ID . $post->ID
		)
	);	
}

/**
 * Register a `unit` custom post type.
 *
 * @since 1.0.0
 */
add_action( 'init', 'units_theme__register_cpt' );
function units_theme__register_cpt() {
		
	$labels = array(
		'name'               => esc_html__( 'Units', 'units' ),
		'singular_name'      => esc_html__( 'Unit', 'units' ),
		'menu_name'          => esc_html__( 'Units', 'units' ),
		'name_admin_bar'     => esc_html__( 'Unit', 'units' ),
		'add_new'            => esc_html__( 'Add New', 'units' ),
		'add_new_item'       => esc_html__( 'Add New Unit', 'units' ),
		'new_item'           => esc_html__( 'New Unit', 'units' ),
		'edit_item'          => esc_html__( 'Edit Unit', 'units' ),
		'view_item'          => esc_html__( 'View Unit', 'units' ),
		'all_items'          => esc_html__( 'All Units', 'units' ),
		'search_items'       => esc_html__( 'Search Units', 'units' ),
		'parent_item_colon'  => esc_html__( 'Parent Units:', 'units' ),
		'not_found'          => esc_html__( 'No Units found.', 'units' ),
		'not_found_in_trash' => esc_html__( 'No Units found in Trash.', 'units' )
	);
	
	$args = array(
		'labels'             => $labels,
		'description'        => esc_html__( 'Description.', 'units' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'unit' ),
		'capability_type'    => 'post',
		'taxonomies'    	 => array( 'post_tag' ),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor' )
	);
	
	register_post_type( 'unit', $args );
	
}

/**
 * Register meta box(es).
 *
 * @since 1.0.0
 */
add_action( 'add_meta_boxes', 'units_theme__register_meta_boxes' );
function units_theme__register_meta_boxes() {
    add_meta_box( 'units_theme_coordinates', esc_html__( 'Coordinates', 'unit' ), 'units_theme__display_callback', 'unit' );
}

/**
 * Fills the meta box with the desired content.
 *
 * @since 1.0.0
 */
function units_theme__display_callback($post) {
	
	/**
	 * Needed for security reasons.
	 */
	wp_nonce_field( basename( __FILE__ ), 'units_theme__coordinates_nonce' );

	/**
	 * Latitude.
	 */
	$html  = '<p><label>' . esc_html__( 'Unit Latitude', 'unit' ) . '&nbsp';
	$html .= '<input type="text" name="unit_latitude" value="' . esc_attr( get_post_meta($post->ID, 'unit_latitude',true) )  . '" />';
	$html .= '</label></p>';
	
	/**
	 * Longitude.
	 */
	$html .= '<p><label>' . esc_html__( 'Unit Longitude', 'unit' ) . '&nbsp';
	$html .= '<input type="text" name="unit_longitude" value="' . esc_attr( get_post_meta($post->ID, 'unit_longitude',true) )  . '" />';
	$html .= '</label></p>';

	/**
	 * Description.
	 */
	$html .= '<p><strong>';
	$html .= esc_html__( 'Please use Yandex format, e.g 55.123456', 'unit' );
	$html .= '</strong></p>';
	
	/**
	 * Print all of this.
	 */
	echo $html;
}

/**
 * Save meta box data.
 *
 * @since 1.0.0
 */
add_action( 'save_post', 'units_theme__save_post_meta', 10, 2 );
function units_theme__save_post_meta( $post_id, $post ) {

	/**
	 * Do not save the data if autosave.
	 */
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}
	
	/**
	 * Security checks.
	 */
	if ( ! isset( $_POST['units_theme__coordinates_nonce'] ) || ! wp_verify_nonce( $_POST['units_theme__coordinates_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}
	
	/**
	 * Check current user permissions.
	 */
	$post_type = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}
 
	if ( 'unit' == $post->post_type ) {
		update_post_meta($post_id, 'unit_latitude', sanitize_text_field( $_POST['unit_latitude'] ) );
		update_post_meta($post_id, 'unit_longitude', sanitize_text_field( $_POST['unit_longitude'] ) );
	}
	
	return $post_id;
}

/**
 * Add Yandex map shortcode.
 *
 * @since 1.0.0
 */
add_shortcode( 'yandex_map', 'units_theme__yandex_map' );
function units_theme__yandex_map( $atts ) {
	
	global $post;

	/**
	 * Prevent output shortcode content on another post type.
	 */
	if ( 'unit' != $post->post_type ) {
		return;
	}

	$latitude = get_post_meta($post->ID, 'unit_latitude', true);
	if ( empty($latitude) ) {
		$latitude = '0.00';
	}
	
	$longitude = get_post_meta($post->ID, 'unit_longitude', true);
	if ( empty($longitude) ) {
		$longitude = '0.00';
	}
	
	$attrs = shortcode_atts( array(
		'latitude'  => $latitude,
		'longitude' => $longitude,
	), $atts );

	$html = '<div id="'.UNITS_THEME_YANDEX_MAP_ID . $post->ID.'" style="width:600px;height:400px" data-latitude="'.$attrs['latitude'].'" data-longitude="'.$attrs['longitude'].'"></div>';

	return $html;

}

