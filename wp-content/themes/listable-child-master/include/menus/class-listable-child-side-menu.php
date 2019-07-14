<?php
/**
 * File: class-listable-child-side-menu.php
 *
 * @package Listable Child
 */

if ( ! class_exists('Listable_Child_Side_Menu') ) :

	/**
	 * Class Listable_Child_Side_Menu.
	 */
	class Listable_Child_Side_Menu {

		/**
		 * Side menu ID.
		 *
		 * @var boolean|string
		 */
		protected static $menu_id = false;

		/**
		 * Side menu term ID (from `terms` table).
		 */		
		protected static $menu_term_id = false;

		/**
		 * Theme location.
		 */		
		protected static $theme_location = 'side_menu';

		/**
		 * Container class.
		 */		
		protected static $container_class = 'side-menu-wrapper';
	
		/**
		 * Menu class.
		 */			
		protected static $menu_class = 'side-menu';
		
		/**
		 * Class for first menu item.
		 */					
		protected static $menu_item_first_class = 'menu-item-first';
		
		/**
		 * Menu item selectable class.
		 */		
		protected static $menu_item_selectable_class = '';
		
		/**
		 * Menu close class.
		 */			
		protected static $menu_close_class = '';
		
		/**
		 * Meta key to store menu item icon.
		 */
		protected static $icon_file_meta_key = '_menu_item_custom_icon';
		
		/**
		 * Current theme.
		 */		
		protected static $theme = false;
		
		/**
		 * Current menu ID.
		 */
		protected static $current_menu_id = false;
		
		/**
		 * Constructor.
		 */
		public static function construct($opts) {
			
			if ( ! empty( $opts['theme'] ) ) {
				self::$theme = $opts['theme'];
			}
			
			/**
			 * Set item selectable class.
			 */				
			self::$menu_item_selectable_class = self::$menu_class . '-item-selectable';

			/**
			 * Set close class.
			 */				
			self::$menu_close_class = self::$menu_class . '-closed';
			
			/**
			 * Register side menu location.
			 *
			 * We are using action 'after_setup_theme' with order greater than 10 to add side menu location to bottom of menu theme locations.
			 */
			add_action( 'after_setup_theme', array( __CLASS__, 'on__register_menu_location' ), 15 );

			/**
			 * Filters the sorted list of menu item objects before generating the menu's HTML.
			 */	
			add_filter( 'wp_nav_menu_objects', array( __CLASS__, 'filter__menu_objects' ), 10, 2 );

			/**
			 * Filters the HTML list content for navigation menus.
			 */
			add_filter( 'wp_nav_menu_items', array( __CLASS__, 'filter__menu_items' ), 10, 2 );


			if ( is_admin() ) {
				
				/**
				 * Enqueue the script in admin.
				 */
				add_action( 'admin_print_scripts', array( __CLASS__, 'on__print_script' ) );
				
				/**
				 * Filter the Walker class. 	
				 */
				add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, 'filter__menu_walker' ), 10, 2 );
			
				/**
				 * Filter a navigation menu item object.
				 */
				add_filter( 'wp_setup_nav_menu_item', array( __CLASS__, 'filter__add_custom_field' ) );
				
				/**
				 * Update navigation menu item.
				 *
				 * @see wp-includes\nav-menu.php
				 */				
				add_action( 'wp_update_nav_menu_item', array( __CLASS__, 'on__update_custom_field'), 10, 3 );
				
			} else {
				
				/**
				 * @scope front
				 */
				 
				/** 
				 * Enqueue the script.
				 */
				add_action( 'wp_enqueue_scripts', array( __CLASS__, 'on__enqueue_script' ) );
			}

		}
		
		/**
		 * Get menu ID.
		 */
		public static function get_menu_id() {	
			return self::$menu_id;
		}

		/**
		 * Get menu term ID.
		 */		
		public static function get_menu_term_id() {
			return self::$menu_term_id;
		}

		/**
		 * Get theme location.
		 */		
		public static function get_theme_location() {	
			return self::$theme_location;
		}
		
		/**
		 * Get container class.
		 */				
		public static function get_container_class() {	
			return self::$container_class;
		}
		
		/**
		 * Get icon file meta key.
		 */				
		public static function get_file_meta_key() {	
			return self::$icon_file_meta_key;
		}		
		
		/**
		 * Get image URL.
		 *
		 * @param string  $icon_file 	   Icon file name.
		 * @param boolean $get_placeholder Return placehoder if $icon_file is empty.		 
		 */
		public static function get_image_url( $icon_file = '', $get_placeholder = false ) {
			
			$image_url = '';
			if ( empty($icon_file) ) {
				if ( $get_placeholder ) {
					/**
					 * @todo Maybe add another placeholder.
					 */
					$image_url = '#';
				} else {
					$image_url = get_stylesheet_directory_uri() . '/images/{{icon_file}}';
				}
			} else {
				$image_url = get_stylesheet_directory_uri() . '/images/' . $icon_file;
			}
			
			return $image_url;
		}
		
		/**
		 * Get menu class.
		 */			
		public static function get_menu_class() {	
			return self::$menu_class;
		}		
		
		/**
		 * Callback for 'after_setup_theme' action.
		 */
		public static function on__register_menu_location() {
			
			$location = self::get_theme_location();
			
			register_nav_menus( array(
				$location => esc_html__( 'Side Menu', 'listable-child-theme' ),
			) );
			
			/**
			 * @todo remove after testing.
			 *
			register_nav_menus( array(
				'test_theme_location' => esc_html__( 'Test menu', 'listable-child-theme' ),
			) ); // */
			
			$locations = get_nav_menu_locations();
			
			if ( ! empty( $locations[$location] ) ) {

				$menu = wp_get_nav_menu_object( $locations[$location] );
			
				if ( is_object($menu) ) {
					/**
					 * Set menu ID.
					 */ 
					self::$menu_id = $menu->slug;
					/**
					 * Set menu term ID.
					 */ 
					self::$menu_term_id = $menu->term_id;
				}
				
			}
			
		}		
	
		/**
		 * Filters a navigation menu item object.
		 *
		 * @param object $menu_item The menu item object.
		 */
		public static function filter__add_custom_field( $menu_item ) {	
			$menu_item->menu_item_custom_icon = get_post_meta( $menu_item->ID, self::$icon_file_meta_key, true );
			return $menu_item;		
		
		}
	
		/**
		 * Update navigation menu item.
		 *
		 * @param int   $menu_id         ID of the updated menu.
		 * @param int   $menu_item_db_id ID of the updated menu item.
		 * @param array $args            An array of arguments used to update a menu item.
		 */			
		public static function on__update_custom_field( $menu_id, $menu_item_db_id, $args ) {	
			/**
			 * Check if element is properly sent.
			 */
			if ( isset( $_REQUEST['menu-item-custom-icon'] ) && is_array( $_REQUEST['menu-item-custom-icon'] ) ) {
				$value = $_REQUEST['menu-item-custom-icon'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, self::$icon_file_meta_key, $value );
			}
		}
		
		/**
		 * Filters the sorted list of menu item objects before generating the menu's HTML.
		 */	
		public static function filter__menu_objects( $sorted_menu_items, $args ) {	
		
			$id = self::get_menu_id();
			
			if ( ! $id ) {
				return $sorted_menu_items;
			}

			if ( $id != $args->menu->slug ) {
				return $sorted_menu_items;
			}
			
			foreach( $sorted_menu_items as $key=>$item ) {
				if ( $key == 1 ) {
					$item->classes[] = self::$menu_item_first_class;
				}
				$item->classes[] = self::$menu_item_selectable_class;
			}

			return $sorted_menu_items;
		}
		
		/**
		 * Add last menu item with arrow.
		 */
		public static function filter__menu_items( $items, $args ) {	
			
			$id = self::get_menu_id();
			
			if ( ! $id ) {
				return $items;
			}

			if ( $id != $args->menu->slug ) {
				return $items;
			}

			$arrow_up = '<img src="'.self::get_image_url('arrow-chosen.png').'" />';
			$arrow_down = '<img src="'.self::get_image_url('icon-2.png').'" />';
			$item_last  = '<li id="menu-item-last-' . $id . '" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-last menu-item-last-' . $id . '">';
			$item_last .= 	'<a style="" class="listable-arrow-up listable-item-close" href="#">'.$arrow_up.'</a>';
			$item_last .= 	'<a style="display:none;" class="listable-arrow-down listable-item-open" href="#">'.$arrow_down.'</a>';
			$item_last .= '</li>';
			
			$items .= $item_last;
			
			return $items;
		}

		/**
		 * Filter the Walker class.
		 *
		 * We are using this 
		 * 	- to set current menu ID
		 *	- to set new walker class.
		 *
		 * @param string $class   The walker class to use. Default 'Walker_Nav_Menu_Edit'.
		 * @param int    $menu_id ID of the menu being rendered.
		 */		
		public static function filter__menu_walker( $walker, $menu_id ) {

			self::$current_menu_id = $menu_id;
			
			if ( (int) self::$menu_term_id !== (int) $menu_id ) {
				return $walker;
			}
			
			if ( class_exists('Listable_Child_Walker_Side_Menu_Edit') ) {
				return 'Listable_Child_Walker_Side_Menu_Edit';
			}
			return $walker;
		}
		
		/**
		 * Enqueue script.
		 *
		 * @scope front
		 */
		public static function on__enqueue_script() {
			
			$version = '1.0';
			if ( self::$theme ) {
				$parent = self::$theme->parent();
				$version = $parent->get('Version');
			}

			wp_register_script(
				'englishchoice-side-menu',
				get_stylesheet_directory_uri() . '/assets/js/listable-side-menu.js',
				array( 'jquery' ),
				$version,
				true
			);
			wp_enqueue_script( 'englishchoice-side-menu' );
			wp_localize_script(
				'englishchoice-side-menu',
				'EnglishchoiceSideMenu',			
				array(
					'version' => $version,
					'lastItemSelector' 		  	 => '.' . self::$menu_class . ' .menu-item-last',
					'menuItemSelectableSelector' => '.' . self::$menu_item_selectable_class,
					'menuCloseClass' 		   	 => self::$menu_close_class,
				)
			);
		}
		
		/**
		 * Print script.
		 *
		 * @scope admin
		 */
		public static function on__print_script() {
			
			global $pagenow;
			
			if ( 'nav-menus.php' != $pagenow ) {
				return;
			}
			
			$menu_id = self::get_menu_id();
			if ( ! $menu_id ) {
				return;
			}

			if ( isset($_REQUEST['action']) && 'edit' == $_REQUEST['action'] && isset($_REQUEST['menu']) && 0 == (int) $_REQUEST['menu'] ) {
				/**
				 * Don't handle when new menu is being added.
				 */
				return;
			}
			
			/**
			 * @see wp-admin\nav-menus.php
			 */
			$nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? $_REQUEST['menu'] : 0;
	
			if ( $nav_menu_selected_id == 0 ) {
				$nav_menu_selected_id = self::$current_menu_id;
			}
			
			if ( (int) $nav_menu_selected_id != (int) self::get_menu_term_id() ) {
				/**
				 * Don't handle others menus.
				 */
				return;
			}

			/**
			 * WordPress library.
			 */
			wp_enqueue_media();
			
			wp_register_script(
				'englishchoice-nav-menus',
				get_stylesheet_directory_uri() . '/include/assets/js/listable-nav-menus.js',
				array( 'jquery', 'media-editor', 'media-views' ),
				'',
				true
			);
			wp_enqueue_script( 'englishchoice-nav-menus' );
			wp_localize_script(
				'englishchoice-nav-menus',
				'EnglishchoiceNavMenus',
				array(
					'version' 	  	=> '',
					'menuID' 	  	=> self::get_menu_id(),
					'menuTermID'   	=> self::get_menu_term_id(),
					'navMenuSelectedId' 	 => $nav_menu_selected_id,
				)
			);			
		}
	}

endif;
# --- EOF