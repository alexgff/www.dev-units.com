<?php
/**
 * File: listable-child-side-menu.php
 *
 * @package Listable Child
 */
require_once(get_stylesheet_directory() . '/include/menus/class-listable-child-side-menu.php');
Listable_Child_Side_Menu::construct( array('theme'=>wp_get_theme()) );

if( is_admin() ){
	require_once(get_stylesheet_directory() . '/include/menus/class-listable-child-walker-side-menu-edit.php');
} else {
	require_once(get_stylesheet_directory() . '/include/menus/class-listable-child-walker-side-menu.php');
}

# --- EOF