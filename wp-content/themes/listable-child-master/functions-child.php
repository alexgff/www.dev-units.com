<?php
define('NETWIDE_SETTING_PAGE_SLUG', 'netwide_setting');
require_once(get_stylesheet_directory() . '/include/isSchoolRating.php');
require_once(get_stylesheet_directory() . '/include/isPixelAdm.php');
require_once(get_stylesheet_directory() . '/include/isSchoolSettings.php');
require_once(get_stylesheet_directory() . '/include/isFunctions.php');
require_once(get_stylesheet_directory() . '/include/isData.php');
//require_once(get_stylesheet_directory(). '/include/popup.php');

/* Принудительный SSL в админ части */
if (filter_var(get_site_option('global_settings_preset')['force_ssl'], FILTER_VALIDATE_BOOLEAN)) {

    force_ssl_admin(true);
}

/** Side Menu */
require_once(get_stylesheet_directory() . '/include/menus/listable-child-side-menu.php');

/* Pixtype Gallery */
require_once(get_stylesheet_directory() . '/include/pixtype-gallery.php');

/* Pixtype PixtypeList */
require_once(get_stylesheet_directory() . '/include/pixtype-playlist.php');

/* Highlight Category */
require_once(get_stylesheet_directory() . '/include/pixtype-highlights.php');

/* Sync Functions */
require_once(get_stylesheet_directory() . '/include/sync-functions.php');

/* Breadcrums */
require_once(get_stylesheet_directory() . '/include/breadcrumbs.php');

/* Framework */
require_once(get_stylesheet_directory() . '/include/class-theme-menu.php');

/* Admin actions */
require_once(get_stylesheet_directory() . '/include/admin-actions.php');

/*SVG */
require_once(get_stylesheet_directory() . '/include/svg.php');

/*Merge JS & CSS */
require_once(get_stylesheet_directory() . '/include/merging.php');


/*
add_filter( 'document_title_parts',					'combine_custom_meta_tags',					10, 1	);
*/

/* Comment it out and load frontend on any page once to recalculate all posts raiting */
//add_action( 'init',								'update_all_comment_count',					10		);

remove_action('wp_head',							'rel_canonical'										);

add_action( 'template_redirect',					'child_redirects',							10		);
add_action( 'wp_ajax_listable_send_mail',			'listable_send_mail',						10		);
add_action( 'wp_ajax_nopriv_listable_send_mail',	'listable_send_mail',						10		);
add_action( 'wp_ajax_add_order_free',				'add_order_free',							10		);
add_action( 'wp_ajax_nopriv_add_order_free',		'add_order_free',							10		);
add_action( 'wp_ajax_get_schools',					'get_schools',								10		);
add_action( 'wp_ajax_nopriv_yandex_map',			'get_schools_geo_coords',					10		);
add_action( 'wp_ajax_yandex_map',					'get_schools_geo_coords',					10		);
add_action( 'admin_head',							'output_backhead_nonce',					10		);
add_action( 'wp_head',								'output_fronthead_description',				1		);
add_action( 'wp_head',								'theme_child_enque_styles',					10		);
add_action( 'wp_footer',							'child_wp_footer_actions',					10		);
add_action( 'init',									'listable_init_actions',					5		);
add_action( 'admin_init',							'listable_admin_init_actions',				1		);
add_action( 'admin_enqueue_scripts',				'listable_child_admin_enqueue_scripts',		10, 1	);
add_action( 'wp_enqueue_scripts',					'listable_child_front_enqueue_scripts',		0		);
add_action( 'generate_rewrite_rules',				'my_add_rewrite_rules'								);
add_action( 'save_post_job_listing',				'edit_geo_data',							10, 3	);

add_action( 'job_manager_job_filters_before',		'jq_jobs_data',								10		);
add_action( 'after_get_job_listings',				'get_jobs_no_pagination',					10, 2	);

add_action( 'widgets_init',							'listable_child_register_widget_area',		20		);
add_filter( 'wp_mail_from',							'mail_from_filter',							10, 1	);
add_filter( 'widgets_init',							'redefine_widget_classes',					30		);
add_filter( 'job_manager_output_jobs_defaults',		'jobs_shortcode',							10		);
add_filter( 'job_manager_job_listing_data_fields',	'jobs_fields',								10		);
add_filter( 'pre_get_document_title',				'combine_custom_meta_tags',					10, 1	);
add_filter( 'after_setup_theme',					'comments_ratings_edit',					10, 1	);
add_filter( 'job_manager_settings',					'set_wp_job_manager_setting',				10, 1	);
add_filter( 'get_job_listings_query_args',			'my_filter_job_listing_query_args',			10, 2	);
add_filter( 'job_manager_get_listings_args',		'my_job_manager_get_listings_args'					);
add_filter( 'job_manager_get_listings_result',		'my_filter_job_listing_search_message',		10, 2	);
add_filter( 'widget_display_callback',				'filter_widgets_data',						10, 3	);
add_filter( 'job_manager_job_listings_output',		'my_listable_wrap_the_listings',			20, 1	);
add_filter( 'body_class',							'front_body_classes'								);
add_filter( 'widget_output',						'substitute_widgets_output',				10, 3	);
add_filter( 'wp_nav_menu_objects',					'filter_menu_objects',						10, 2	);
add_filter( 'get_job_listings_cache_results',		'manage_jm_cache',							10, 1	);
add_filter( 'wp_headers',							'no_cache_sitemap',							10, 1	);


/*
add_filter( 'clean_url',							'async_attr_add',							10, 3	);
add_filter( 'widget_title',							'change_widgets_params',					10, 3 );
add_action( 'transition_comment_status',			'sync_status_comment', 						20, 3 );
 */

add_action('wp_job_manager_admin_field_objects_sequence', 'wp_job_manager_admin_field_objects_sequence', 10, 4);
add_action('wp_job_manager_admin_field_exclude_comments_widget_posts', 'wp_job_manager_admin_field_exclude_comments_widget_posts', 10, 4);
add_action('update_option_job_manager_category_base_permalink_substitution', 'my_add_rewrite_rules', 10);
add_action('update_option_job_manager_courses_no_map_page_id', 'my_add_rewrite_rules', 10);
add_action('update_option_job_manager_objects_sequence', 'update_posts_sequence', 10, 3);
add_action('update_option_job_manager_exclude_comments_widget_posts', 'update_posts_comments_excluding', 10, 3);

add_action('comment_form_before', 'action_function_name_5745');
function action_function_name_5745()
{
    ?><a name="respond"></a><?php
}

add_action('dynamic_sidebar_before', 'listable_child_footer_breadcrumbs', 10, 2);
add_filter('dynamic_sidebar_params', 'listable_filter_dynamic_sidebar_params', 10);
add_action('dynamic_sidebar', 'drop_ancors_on', 10, 1);
//add_action( 'wp_update_comment_count',				'listable_child_update_post_comment',				10,	3 );

add_action('save_post', 'child_set_default_average_rating');
add_action('deleted_post', 'child_deleted_post', 10, 1);

//add_action( 'post_submitbox_misc_actions',			'qqq',												10, 1 );
//add_action( 'post_submitbox_start',					'www',												10, 1 );

if (is_admin()) {

    add_action('wp_ajax_listable_check_slug_uniq', 'listable_check_slug_uniq', 10);
}


if (is_multisite()) {

    add_action('comment_post', 'sync_new_comment', 20, 3);
    add_action('edit_comment', 'sync_edit_comment', 20, 1);
    add_filter('comment_edit_redirect', 'sync_edit_redirect_comment', 20, 2);
    add_action('delete_comment', 'sync_delete_comment', 20, 1);
    add_action('trash_comment', 'sync_trash_comment', 20, 1);
    add_action('untrashed_comment', 'sync_untrashed_comment', 20, 1);
    add_action('spam_comment', 'sync_spam_comment', 20, 1);
    add_action('unspammed_comment', 'sync_unspamed_comment', 20, 1);

    add_action('comment_unapproved_to_approved', 'sync_status_comment_approve', 20, 1);
    add_action('comment_approved_to_unapproved', 'sync_status_comment_unapprove', 20, 1);

    /* if you want to turn it ON - comment out all filters before in multisite condition*/
    if (get_site_option('old_comments_synced', 0) == 0 && get_site_option('old_comments_synce_in_progress', 0) == 0 && is_admin()) {

        sync_existing_comment_once();
    }
}

add_shortcode('one_half', 'one_half_func');
add_shortcode('one_half_last', 'one_half_last_func');
add_shortcode('feedback', 'feedback_func');
add_shortcode('reviews', 'reviews_func');
add_shortcode('like_reviews', 'review_widget_substitude');
add_shortcode('yandex_maps', 'yandex_maps_clb');

remove_filter('pre_term_description', 'wp_filter_kses');

function update_posts_sequence($old_value, $value, $option)
{

    $sequence_position_keys = array();
    $sequence_date_limit_keys = array();

    $new_sequence = json_decode($value, true);
    $new_sequence_posts_id = array();

    //удалить отсутствующие в опции метаданные постов
    foreach ($new_sequence as $level_name => $level_data) {

        $sequence_position_keys[] = '_sequence_position' . $level_name;
        $sequence_date_limit_keys[] = '_sequence_date_limit' . $level_name;

        foreach ($level_data as $level_object) {
            $new_sequence_posts_id[] = $level_object['postid'];
        }
    }

    $query = array(
        'posts_per_page' => -1,
        'offset' => 0,
        'post_status' => 'any',
        'post_type' => array('job_listing'),
        'post__not_in' => $new_sequence_posts_id,
        'fields' => 'ids',
        'meta_query' => array(
            'relation' => 'OR',
        ),
    );

    foreach ($sequence_position_keys as $sequence_position_key) {

        $query['meta_query'][] = array(
            'key' => $sequence_position_key,
            'compare' => 'EXISTS',
        );
    }


    $posts_meta_to_delete = new WP_Query($query);

    if ($posts_meta_to_delete->found_posts !== 0) {

        foreach ($posts_meta_to_delete->posts as $postid) {

            foreach ($sequence_position_keys as $metakey) {
                delete_post_meta($postid, $metakey);
            }
            foreach ($sequence_date_limit_keys as $metakey) {
                delete_post_meta($postid, $metakey);
            }
        }
    }

    //обновить и добавить присутствующие в опции в метаданные постов
    foreach ($new_sequence as $level_name => $level_data) {
        foreach ($level_data as $position => $level_object) {

            update_post_meta($level_object['postid'], '_sequence_position' . $level_name, $position);
            update_post_meta($level_object['postid'], '_sequence_date_limit' . $level_name, $level_object['to_date']);
        }
    }
}

function update_posts_comments_excluding($old_value, $value, $option)
{

    $new_sequence = json_decode($value, true);
    $new_sequence_posts_id = array();

    //удалить отсутствующие в опции метаданные постов
    foreach ($new_sequence as $new_object) {
        $new_sequence_posts_id[] = $new_object['postid'];
    }

    $query = array(
        'posts_per_page' => -1,
        'offset' => 0,
        'post_status' => 'any',
        'post_type' => array('job_listing'),
        'post__not_in' => $new_sequence_posts_id,
        'fields' => 'ids',
        'meta_query' => array(
            'relation' => 'AND',
            'position' => array(
                'key' => '_exclude_comments_widget',
                'compare' => 'EXISTS',
            ),
        ),
    );

    $posts_meta_to_delete = new WP_Query($query);

    if ($posts_meta_to_delete->found_posts !== 0) {

        foreach ($posts_meta_to_delete->posts as $postid) {

            delete_post_meta($postid, '_exclude_comments_widget');
            delete_post_meta($postid, '_exclude_comments_widget_date_limit');
        }
    }

    //обновить и добавить присутствующие в опции в метаданные постов
    foreach ($new_sequence as $position => $new_object) {

        update_post_meta($new_object['postid'], '_exclude_comments_widget', 1);
        update_post_meta($new_object['postid'], '_exclude_comments_widget_date_limit', $new_object['to_date']);
    }
}

/* REDIRECTS */
function child_redirects($template)
{

    redirects_rules();
    redirects_tax();

}

function redirects_tax()
{

    $obj = get_queried_object();

    if (is_tax()) {

        if (is_object_in_taxonomy('job_listing', $obj->taxonomy)) {

            if (!empty ($courses_on_map = get_option('job_manager_category_base_permalink_substitution', false))) {

                wp_redirect(get_permalink($courses_on_map) . $obj->slug . '/', 301);

                exit();
            }
        }
    }
}

function redirects_rules()
{

    $site_options = get_site_option('global_settings_preset');

    if (empty($site_options) || $site_options === false) {

        return;
    }

    global $post, $wp_query/* , $site_options */
           ;

    $force_ssl = $site_options['force_ssl'];
    $main_site = $site_options['main_blog'];

    define('FORCE_SSL', filter_var($force_ssl, FILTER_VALIDATE_BOOLEAN));

    if (intval($main_site) != 0) {

        define('MAIN_CITY_ID', intval($main_site));
    }

    /* Запрос к главному домену */
    if (get_current_site()->domain == $_SERVER['HTTP_HOST'] && defined('MAIN_CITY_ID')) {

        if (preg_match('/(wp-(content|admin|includes).*)/', $_SERVER['REQUEST_URI']) === 0) {

            $target = parse_url(get_blogaddress_by_id(MAIN_CITY_ID))['host'];

            if (FORCE_SSL && !is_ssl()) {

                if (MAIN_CITY_ID != false) {

                    wp_redirect('https://' . $target, 301);
                    exit();
                }

            } elseif (isset ($_SERVER['HTTPS'])) {

                if (MAIN_CITY_ID != false) {

                    wp_redirect('https://' . $target, 301);
                    exit();
                }

            } else {

                if (MAIN_CITY_ID != false) {

                    wp_redirect('http://' . $target, 301);
                    exit();
                }
            }
        }
    } /* Все остальные поддомены сети */
    else {

        if (FORCE_SSL && !is_ssl()) {

            wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301);
            exit();
        }
    }

    $tax_in_url = get_taxonomies_from_url();

    $courses_on_map = get_option('job_manager_jobs_page_id', false);

    if ($post->ID == $courses_on_map) {

        if (count($tax_in_url['found']) !== $tax_in_url['of'] && $tax_in_url['of'] > 0) {

            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            include(get_query_template('search-404'));
            exit;
        } /* check for proper slugs order */
        else if (count($tax_in_url['found']) > 0) {

            $custom_taxonomies_key = array();
            $search_taxonomies_key = array();
            $ordered_search_array = array();

            foreach (WP_Job_Manager_Add_On::$custom_taxonomies as $key => $value) {

                $custom_taxonomies_key[] = $key;
            }

            foreach ($tax_in_url['found'] as $key => $value) {

                $search_taxonomies_key[] = $key;
            }

            foreach ($search_taxonomies_key as $index => $value) {

                $search_position = array_search($search_taxonomies_key[$index], $custom_taxonomies_key);

                if ($search_position !== false) {

                    $ordered_search_array[$search_position] = $value;
                }
            }

            ksort($ordered_search_array);
            $ordered_search_array = array_values($ordered_search_array);

            if ($ordered_search_array != $search_taxonomies_key) {

                $redirect_url = get_permalink($post->ID);
                $redirect_path = '';

                foreach ($ordered_search_array as $value) {
                    $redirect_path .= $tax_in_url['found'][$value][0] . '/';
                }
                wp_redirect($redirect_url . $redirect_path, 301);
                exit();
            }
        }
    }

    /* prevent opening page like POST_NAME/ANYTHING EXCEPTS "comments" */
    if (is_single($post->ID)) {

        $request_parts = parse_url($_SERVER['REQUEST_URI']);
        $path = preg_split('/\\//', $request_parts['path'], -1, PREG_SPLIT_NO_EMPTY);


        /*if(  $path[count($path) - 1] != $post->post_name && $path[count($path) - 1] != 'comments' ){*/
        if ($path[count($path) - 1] != $post->post_name && $path[count($path) - 1] != 'comments' && $path[count($path) - 1] != 'gallery' && $path[count($path) - 1] != 'amp') {

            $wp_query->set_404();
            status_header(404);
            include(get_query_template('search-404'));
            exit;
        }
    }
}

/* WP HEAD ACT */
function output_fronthead_description()
{

    $site_options = get_site_option('global_settings_preset');

    if ($site_options['add_in_head'] != '') {

        echo wp_unslash($site_options['add_in_head']);
    }

    if (!is_404()) {

        global $post;

        /* Description for search page with map or not */
        if (has_shortcode($post->post_content, 'jobs')) {

            /* Prevent doubling description with AISEO */
            add_filter('aioseop_description', 'lisatble_downforce_aiseo_descr', 10, 1);

            $combo = get_combo_meta_tags('search_page');
            ?>
            <meta name="description" content="<?php echo $combo['descr']; ?>" /><?php

            echo html_entity_decode($combo['noindex_page']);

        }

        /* Description for school page */
        if (is_single() && !is_front_page()) {

            if ($post->post_type === 'job_listing') {
                $is_def_meta = get_combo_meta_tags('school_page');
                $is_def_desc = '<meta name="description" content="' . $is_def_meta['descr'] . '" />';

                if ((get_query_var('content_type') == 'comments') && (!get_option('job_manager_hide_expired_content', 1) && 'expired' !== $post->post_status)) {
                    $is_def_meta = get_combo_meta_tags('school_vpage_comments');
                    $is_def_desc = '<meta name="description" content="' . $is_def_meta['descr'] . '" />';
                }

                if ((get_query_var('content_type') == 'gallery') && (!get_option('job_manager_hide_expired_content', 1) && 'expired' !== $post->post_status)) {
                    $is_def_meta = get_combo_meta_tags('school_vpage_gallery');
                    $is_def_desc = '<meta name="description" content="' . $is_def_meta['descr'] . '" />';
                }

                echo $is_def_desc;


                /*if ( get_query_var( 'content_type' ) == 'comments' ) {

					?><meta name="description" content="<?php echo get_combo_meta_tags( 'school_vpage_comments' )['descr']; ?>" /><?php
				}
				else{

					if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ){

						///* nothing to do
					}
					else{
						?><meta name="description" content="<?php echo get_combo_meta_tags( 'school_page' )['descr']; ?>" /><?php
					}
				}*/
            }
        }


        if (is_single() && !is_front_page() && $post->post_type === 'job_listing') {


        }

        /* Title for home page */
        if (is_front_page()) {

            /* Prevent doubling description with AISEO */
            add_filter('aioseop_description', 'lisatble_downforce_aiseo_descr', 10, 1);

            ?>
            <meta name="description" content="<?php echo get_combo_meta_tags('home_page')['descr']; ?>" /><?php
        }

        /* Hide icons on school card */
        if (get_option('job_manager_card_tags', false) == '1') {

            echo '<style type="text/css">ul.card__tags {display: none !important;}</style>';
        }
    }
}

function theme_child_enque_styles()
{

    if (is_page(get_option('job_manager_jobs_page_id', false))) {

        wp_enqueue_style('style_search_page');
    }
    if (is_front_page()) {

        wp_enqueue_style('style_front_page');
    }

    wp_enqueue_style('style_frontend_all');
    wp_enqueue_script('script_frontend_all');

    $ip = $_SERVER['REMOTE_ADDR'];
    $referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : null;
    $url_query = (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : null;


    ?>
    <script type="text/javascript">

        var ttl = 12 * 60 * 60 * 1000;
        /* 12 часов */
        var date = new Date();
        var visit_data = JSON.parse(localStorage.getItem('visit_data'));

        if (visit_data == null || (date - visit_data.timestamp) > ttl) {

            var visit_data = {
                referer: '<?php echo $referer ?>',
                url_query: '<?php echo $url_query ?>',
                timestamp: date.getTime(),
                ip: '<?php echo $ip; ?>',
            }
            localStorage.setItem('visit_data', JSON.stringify(visit_data));
        }
    </script>
    <?php
}

function visit_data_to_html($visit_data)
{

    if ($visit_data['referer'] != null) {

        $referer = parse_url($visit_data['referer']);
        $trafic_source = $visit_data['referer'];

        (isset($referer['scheme'])) ? $scheme = 'Протокол: ' . $referer['scheme'] : $scheme = 'Протокол: Undefined';
        (isset($referer['host'])) ? $host = 'Домен: ' . $referer['host'] : $host = 'Домен: Undefined';
        (isset($referer['path'])) ? $path = 'Страница: ' . $referer['path'] : $path = 'Страница: No path';
        (isset($referer['query'])) ? $query = 'Запрос: ' . $referer['query'] : $query = 'Запрос: No query';
    } else {
        $trafic_source = 'Direct acces';
        $scheme = 'Протокол: -';
        $host = 'Домен: -';
        $path = 'Страница: -';
        $query = 'Запрос: -';
    }

    if ($visit_data['url_query'] != null) {

        $url_query_html = '<p style="text-align: left;">Переменные в URL на странице запроса: </p><ul style="text-align: left;">';
        $url_query = $visit_data['url_query'];
        parse_str($url_query, $url_query_arr);

        foreach ($url_query_arr as $name => $value) {

            $url_query_html .= '<li>' . $name . ': ' . $value . '</li>';
        }

        $url_query_html .= '</ul>';

    } else {
        $url_query_html = '<p>Переменные в URL на странице запроса: -</p>';

    }

    $date = new DateTime();
    $date->setTimestamp($visit_data['timestamp'] / 1000);
    $date->setTimezone(new DateTimeZone('Europe/Moscow'));
    $storage_time = $date->format('d/m/Y H:i P (e)');

    //$geo = (array)json_decode( file_get_contents ("http://158.69.249.75/json/" . $visit_data['ip']) );
    //$geo = '<p style="text-align: left;">Гео данные:' . $geo['zip_code'] . ', ' .  $geo['country_name'] . '(' .  $geo['country_code'] . '), ' . $geo['region_name'] . ', ' . $geo['city'] . ', ' . $geo['ip'] . '</p>';
    $geo = '';
    $html = '<p style="text-align: left;">Сведения получены: ' . $storage_time . '<p style="text-align: left;">Источник трафика: ' . $trafic_source . ', где:</p>' .
        '<ul style="text-align: left;">' .
        '<li>' . $scheme . '</li>' .
        '<li>' . $host . '</li>' .
        '<li>' . $path . '</li>' .
        '<li>' . $query . '</li>' .
        '</ul>' .
        $url_query_html .
        $geo;

    return $html;
}

/* WP FOOTER ACT */
function child_wp_footer_actions()
{

    scroll_top();
    render_counters();
}

function scroll_top()
{
    ?>
    <a id="scroll_back_to_top" class="off"><?php echo svg_arrow(); ?></a>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            setTimeout(function () {
                detect();
            }, 1000);

            var timeoutId;
            var top = $('a#scroll_back_to_top');

            $(window).scroll(function () {

                detect();

            });

            top.click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 500);
            });

            function detect() {

                if ($(this).scrollTop() >= 200) {
                    top.addClass('on').removeClass('off');

                    top.css('opacity', '0.2');
                    if (timeoutId) {
                        clearTimeout(timeoutId);
                    }
                    timeoutId = setTimeout(function () {
                        top.css('opacity', '');
                    }, 600);

                } else {
                    top.addClass('off').removeClass('on');
                }
            }

        });
    </script>

    <?php
}

function render_counters()
{

    $gl = get_site_option('global_settings_preset', '');

    if (isset($gl['add_in_footer'])) {

        echo wp_unslash($gl['add_in_footer']);
    };
}

function filter_menu_objects($sorted_menu_items, $args)
{

    if (get_site_option('global_settings_preset')['force_ssl'] == 'true') {

        foreach ($sorted_menu_items as $item) {

            if ($item->object == 'custom') {

                $item->url = str_replace('http://', 'https://', $item->url);
            }
        }
    }

    return $sorted_menu_items;
}

function manage_jm_cache($status)
{

    $status = false;

    return $status;
}

function async_attr_add($good_protocol_url, $original_url, $_context)
{

    if (strpos($good_protocol_url, '#eng_asyncload') === false) {

        return $good_protocol_url;
    } else if (is_admin()) {

        return str_replace('#eng_asyncload', '', $good_protocol_url);
    } else {

        return str_replace('#eng_asyncload', '', $good_protocol_url) . "' async='async";
    }
}

function listable_filter_dynamic_sidebar_params($sidebar_params)
{

    if (is_admin()) {
        return $sidebar_params;
    }

    global $wp_registered_widgets;
    $widget_id = $sidebar_params[0]['widget_id'];

    $wp_registered_widgets[$widget_id]['original_callback'] = $wp_registered_widgets[$widget_id]['callback'];
    $wp_registered_widgets[$widget_id]['callback'] = 'listable_output_widget_callback_function';

    return $sidebar_params;

}

function mail_from_filter($from_email)
{

    if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {

        $from_email = 'wp_local@englishchoice.ru';
    }

    return $from_email;
}

function listable_output_widget_callback_function()
{

    global $wp_registered_widgets;
    $original_callback_params = func_get_args();
    $widget_id = $original_callback_params[0]['widget_id'];

    $original_callback = $wp_registered_widgets[$widget_id]['original_callback'];
    $wp_registered_widgets[$widget_id]['callback'] = $original_callback;

    $widget_id_base = $wp_registered_widgets[$widget_id]['callback'][0]->id_base;

    if (is_callable($original_callback)) {

        ob_start();
        call_user_func_array($original_callback, $original_callback_params);
        $widget_output = ob_get_clean();

        echo apply_filters('widget_output', $widget_output, $widget_id_base, $widget_id);

    }

}

function substitute_widgets_output($widget_output, $widget_id_base, $widget_id)
{

    /* Conditionaly */
    if ($widget_id_base == 'front_page_listing_categories') {

        /* h3 -> h2 */
        $widget_output = preg_replace("/h3/", "h2", $widget_output, -1);

        /* h2 content of span */
        preg_match("/<span class=\"widget_subtitle.*?>(.*?)<\/span>/s", $widget_output, $h2_content, null, 0);

        /* del h2 content of span */
        $widget_output = preg_replace("/<span class=\"widget_subtitle.*?>(.*?)<\/span>/s", '', $widget_output, -1);

        preg_match("/<h2.*?>(.*?)<\/h2>/s", $widget_output, $new_h2_content, null, 0);

        /* span -> p inside h2 content of span */
        $span_to_p = preg_replace("/span/", "p", $h2_content[0], -1);

        $widget_output = preg_replace("/<h2.*?>(.*?)<\/h2>/s", $new_h2_content[0] . $span_to_p, $widget_output, -1);

    }

    /* For ALL */
    $widget_output = preg_replace_callback('/\[(.*?)\]/', function ($matches) {

        return parse_nominants($matches[0]);
    },
        $widget_output
    );

    return $widget_output;

}

function change_widgets_params($title, $instance, $id_base)
{

    if ($id_base == 'front_page_listing_categories') {

        if ($instance['title'] != '') {

            $instance['title'] = preg_replace_callback('/\[(.*?)\]/', function ($matches) {

                return parse_nominants($matches[0]);
            },
                $instance['title']
            );
        }
    }

    return $instance['title'];
}

function drop_ancors_on($wp_registered_widgets_id)
{

    if (strpos($wp_registered_widgets_id['id'], 'front_page_listing_categories') !== false) {

        echo '<a name="popular-categories-ancor"></a>';
        wp_enqueue_style('listing_categories_widget_css');
    }
    if (strpos($wp_registered_widgets_id['id'], 'listing_sidebar_top_rated') !== false) {
        echo '<a name="top-rated-ancor"></a>';
    }
    if (strpos($wp_registered_widgets_id['id'], 'listing_sidebar_latest_review') !== false) {
        echo '<a name="reviews-ancor"></a>';
    }
    if (strpos($wp_registered_widgets_id['id'], 'listing_content') !== false) {
        echo '<a name="content-ancor"></a>';
    }
    if (strpos($wp_registered_widgets_id['id'], 'listing_comments') !== false) {
        echo '<a name="comments-ancor"></a>';
    }
    if (strpos($wp_registered_widgets_id['id'], 'listing_sidebar_gallery') !== false) {
        echo '<a name="gallery-ancor"></a>';
    }
    if (strpos($wp_registered_widgets_id['id'], 'listing_sidebar_map') !== false) {
        echo '<a name="map-ancor"></a>';
    }

}

function update_all_comment_count()
{

    $args = [
        'post_type' => 'job_listing',
        'posts_per_page' => -1,
    ];

    if (is_multisite()) {

        $sites = get_sites();

        foreach ($sites as $site) {

            switch_to_blog($site->blog_id);

            $site_posts = get_posts($args);

            foreach ($site_posts as $site_post) {

                wp_update_comment_count_now($site_post->ID);

            }

            restore_current_blog();
        }
    } else {

        $site_posts = get_posts($args);

        foreach ($site_posts as $site_post) {

            wp_update_comment_count_now($site_post->ID);

        }
    }
}


function listable_child_update_post_comment($post_id, $new = null, $old = null)
{
    global $wpdb;

    //some sanity check
    if (!is_numeric($post_id)) {
        return;
    }

    if (class_exists('PixReviewsPlugin')) {

        $instance = PixReviewsPlugin::get_instance();

        //$rating = PixReviewsPlugin::get_average_rating($post_id);
        //$rating = $pixreviews_plugin->get_average_rating($post_id);

        $rating = $instance->get_average_rating($post_id);

        if (!empty($rating)) {
            //$wpdb->query("UPDATE $wpdb->postmeta set meta_value = '".$rating."' WHERE post_id = '".$post_id."' AND meta_key = '_pixreviwes_average' LIMIT 1");
        }
    }
}

function child_set_default_average_rating($post_id)
{

    $old_value = get_post_meta($post_id, '_pixreviwes_average', true);

    if (!$old_value) {

        //update_post_meta($post_id,'_pixreviwes_average','0');
    }
}

function child_deleted_post($postid)
{

    $save_objects_sequence = false;
    $save_exclude_posts = false;

    $sequence = get_option('job_manager_objects_sequence', false);
    $exclude_posts = get_option('job_manager_exclude_comments_widget_posts', false);

    if ($sequence) {

        $sequence = json_decode($sequence);

        for ($x = 0; $x < count($sequence); $x++) {

            if ($sequence[$x]->postid === (int)$postid) {
                unset($sequence[$x]);
                $save_objects_sequence = true;
            }
        }

        if ($save_objects_sequence) {

            update_option('job_manager_objects_sequence', wp_unslash(trim(json_encode($sequence))));
        }
    }
    if ($exclude_posts) {

        $exclude_posts = json_decode($exclude_posts);

        for ($x = 0; $x < count($exclude_posts); $x++) {

            if ($exclude_posts[$x]->postid === (int)$postid) {
                unset($exclude_posts[$x]);
                $save_exclude_posts = true;
            }
        }

        if ($save_exclude_posts) {

            update_option('job_manager_exclude_comments_widget_posts', wp_unslash(trim(json_encode($exclude_posts))));
        }
    }
}

// Allows shortcodes to be used in widgets
if (!is_admin()) {
    add_filter('widget_text', 'do_shortcode');
}

/*
 * Shortcode: one_half
 * Usage: [one_half]Content goes here...[/one_half]
 */
function one_half_func($atts, $content = null)
{

    return '<div class="halfer"><div class="one_half">' . do_shortcode($content) . '</div>';
}

/*
 * Shortcode: one_half_last
 * Usage: [one_half_last]Content goes here...[/one_half_last]
 */
function one_half_last_func($atts, $content = null)
{
    return '<div class="one_half last_column">' . do_shortcode($content) . '</div></div>';
}

function front_body_classes($classes)
{

    $classes[] = 'listable-scope';

    return $classes;
}

function reviews_func($atts)
{

    $atts = shortcode_atts(array(
        'title' => null,
        'subtitle' => null,
        'review_quantity' => 10,
        'render_mode' => 'as_page',
    ), $atts);

    ob_start();

    the_widget('Listing_Latest_Reviews', $atts);

    $w_content = ob_get_clean();

    $w_content = preg_replace_callback('/\[(.*?)\]/', function ($matches) {

        return parse_nominants($matches[0]);
    },
        $w_content
    );

    echo $w_content;
}

function review_widget_substitude($atts)
{

    $atts = shortcode_atts(array(
        'title' => sprintf(__('Отзывы о курсах английского языка %s', 'listable-child-theme'), get_option('job_manager_city_name_PC', 'опиция город в склонении - пуста')),
        'subtitle' => __('Новые положительные и отрицательные отзывы реальных студентов курсов английского с удобной фильтрацией.', 'listable-child-theme'),
    ), $atts);

    /* STYLES */
    wp_enqueue_style('add_review_form_css');

    $review_page = get_option('job_manager_comments_archive_page', null);

    $commets_trap = array();
    $step = 0;
    $show_uniq_comments = 3;

    $positive_comments_args = array(
        'no_found_rows' => true,
        'number' => 10,
        'offset' => 0,
        'orderby' => 'comment_date',
        'order' => 'DESC',
        'status' => 'approve',
        'meta_query' => array(
            'relation' => 'AND',
            'reviwes' => array(
                'key' => 'pixrating',
                'value' => '3.5',
                'compare' => '>',
            ),
        ),
        'count' => false,
        'date_query' => null,
        'hierarchical' => false,
        'update_comment_meta_cache' => true,
        'update_comment_post_cache' => false,
    );
    $negative_comments_args = array(
        'no_found_rows' => true,
        'number' => 20,
        'offset' => 0,
        'orderby' => 'comment_date',
        'order' => 'DESC',
        'status' => 'approve',
        'meta_query' => array(
            'relation' => 'AND',
            'reviwes' => array(
                'key' => 'pixrating',
                'value' => '3.5',
                'compare' => '<',
            ),
        ),
        'count' => false,
        'date_query' => null,
        'hierarchical' => false,
        'update_comment_meta_cache' => true,
        'update_comment_post_cache' => false,
    );


    /*$all_comments = array(
		array(
			'id'		=> 'positive',
			'content'	=> get_comments( $positive_comments_args ),
		),
	);*/


    /*if ( $_SERVER['REMOTE_ADDR'] == '88.147.140.24'){*/
    $all_comments = array(
        array(
            'id' => 'negatives',
            'content' => isGetCommentForMainPage(10),
        ),
    );
    $show_uniq_comments = 30;
    /*} */

    foreach ($all_comments as $comments_type) {

        ?>


        <div class="front-page-section">
            <div class="section-wrap">

                <h2 class="widget_title  widget_title--frontpage"><?php echo $atts['title'] ?></h2>
                <p class="widget_subtitle  widget_subtitle--frontpage"><?php echo $atts['subtitle'] ?></p>
                <?php
                /*if ( $_SERVER['REMOTE_ADDR'] == '88.147.140.24'){ */

                echo '<div id="controls" class="ui-tabs ui-widget ui-widget-content ui-corner-all">';
                echo '<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">';
                echo '<li id="isSelectCommType" isCommTypeButton="posi" class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="positive" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true">';
                echo svg_smile_positive();
                _e('Положительные', 'listable-child-theme');
                echo '</li>';
                echo '<li id="isSelectCommType" isCommTypeButton="nega" class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="negative" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false">';
                echo svg_smile_negative();
                _e('Отрицательные', 'listable-child-theme');
                echo '</li>';
                echo '</ul></div>';
                /*} */
                ?>
                <div id="review_wrapper" style="opacity: 1;">
                    <noindex>
                        <div id="<?php echo $comments_type['id']; ?>">
                            <?php
                            if (count($comments_type['content']) > 0) {
                                foreach ($comments_type['content'] as $comment) {

                                    if ($step === $show_uniq_comments) {
                                        //break;
                                    }

                                    if (!in_array($comment->comment_post_ID, $commets_trap)) {
                                        ?>
                                        <div class="comment_wrapper" isRoleComm="<?= $comment->commType; ?>">
                                            <div class="comment_content">
                                                <div class="comment_img">
                                                    <img src="<?php echo listable_get_post_image_src($comment->comment_post_ID); ?> "/>
                                                    <div class="post_title"><a
                                                                href="<?php echo get_the_permalink($comment->comment_post_ID) ?>"><?php echo get_the_title($comment->comment_post_ID) ?></a>
                                                    </div>
                                                </div>
                                                <div class="comment_text collapsed">
                                                    <div class="comment_data">
                                                        <div class="comment_time"><?php echo $comment->comment_author . ', ' . date_i18n('d F Y', strtotime($comment->comment_date)); ?></div>
                                                        <div class="post_raiting"><?php echo listable_generate_object_rating_html(array(
                                                                'object_type' => 'comment',
                                                                'object_id' => $comment->comment_ID,
                                                                'set_rating' => false,
                                                                'with_digits' => 'comments',
                                                                'reviews_count' => wp_count_comments($comment->comment_post_ID)->approved,
                                                            )); ?>
                                                        </div>
                                                    </div>
                                                    <?php echo $comment->comment_content ?>
                                                </div>
                                                <div class="expand-comment-wrapper">
                                                    <a class="expand-comment"
                                                       style="margin-left: 20%;"><?php _e('Развернуть', 'listable-child-theme'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        //$commets_trap[] = $comment->comment_post_ID; //разбивка по школа, т.е. не показывать комменты для одной и тоже школы
                                        $step++;
                                    }
                                }
                            } else {
                                ?>
                                <div class="empty_comments"><?php _e('Пока что здесь нет отзывов. Вы можете написать первый отзыв.', 'listable-child-theme'); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                    </noindex>
                </div><?php

                if (!empty($review_page)) { ?>

                    <div class="btn-container">
                    <button class="btn btn-add__reviews"
                            onclick="javascript:window.location.href='<?= get_permalink($review_page); ?>'">
                        <?php
                        echo svg_eye();
                        echo '<a href="' . get_permalink($review_page) . '">' . __('Все отзывы', 'listable-child-theme') . '</a>';

                        ?>
                    </button>
                    </div><?php } ?>
            </div>
        </div>
        <?php
    }

    ?>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            $(document).find('.comment_content').each(function () {

                var t = 800;
                var comment_text_height = $(this).find('.comment_text')[0].scrollHeight;
                var img = $(this).find('img')[0].offsetHeight;

                if (comment_text_height > img) {

                    $(this).one('click', 'a.expand-comment', {
                        comment_text: $(this).find('.comment_text'),
                        height_to: comment_text_height,
                    }, function (e) {

                        e.data.comment_text.css({
                            'max-height': e.data.height_to + 'px',
                            'transition': 'max-height ' + t + 'ms',
                        }).removeClass('collapsed');

                        setTimeout(function () {
                            e.data.comment_text.siblings('div.expand-comment-wrapper').animate({

                                opacity: 0,

                            }, t / 4, function () {

                                $(this).animate({

                                    height: 0,

                                }, t / 6, function () {

                                    $(this).remove();
                                })


                            });
                        }, t);

                    });
                }
                else {
                    $(this).find('.comment_text').siblings('div.expand-comment-wrapper').remove();
                }
            });
        });
    </script>

    <?php
}

function yandex_maps_clb($atts)
{

    $map_html = null;

    /* objects: all, self_geo_for_POST_ID, branchies_for_POST_ID */
    $atts = shortcode_atts(array(
        'map_height' => '300px',
        'footer' => false,
        'objects' => 'all',
        'output_as' => 'link',
        'popup_title' => __('Клиники на карте', 'listable-child-theme'),
        'button_title' => __('Все клиники на карте', 'listable-child-theme'),
    ), $atts);

    foreach ($atts as $att_name => $att_value) {

        $atts[$att_name] = preg_replace_callback('/%(.*?)%/', function ($matches) {

            return parse_nominants($matches[0]);
        },
            $atts[$att_name]
        );
    }

    if ($atts['objects'] == 'branchies') {
        $atts['objects'] .= '_for_' . get_the_ID();
    } else if ($atts['objects'] == 'post') {
        $atts['objects'] = 'self_geo_for_' . get_the_ID();
    }

    wp_enqueue_style('jquery_css');
    wp_enqueue_script('schools_on_map');

    ob_start();

    if ($atts['output_as'] == 'link') {
        ?>
        <a id="yandex-map-frame-trigger" class="map-i"><?php echo $atts['button_title'] ?></a>
        <div id="isYaMapsModal" class="isPopupMap"
             data-title="<?php echo $atts['popup_title'] ?>"
             data-popup="true"
             data-cls="<?php _e('Закрыть', 'listable-child-theme') ?>"
             data-objects="<?php echo $atts['objects'] ?>"
             data-action="<?php echo 'yandex_map' ?>"
             data-nonce="<?php echo wp_create_nonce('yandex_map') ?>"
             data-ajaxurl="<?php echo admin_url('admin-ajax.php') ?>">
            <div id="isMapAll" style="width: 100%; height: 100%;"></div>
        </div>
        <?php
    } else if ($atts['output_as'] == 'box') {
        ?>
        <div id="isYaMapsModal"
             class="isBoxedMap" <?php echo ($atts['footer']) ? 'style="width: 100vw; position: relative; margin-left: -50vw; left: 50%;"' : '' ?>
             data-title="<?php echo $atts['popup_title'] ?>"
             data-popup="false"
             data-cls="<?php _e('Закрыть', 'listable-child-theme') ?>"
             data-objects="<?php echo $atts['objects'] ?>"
             data-action="<?php echo 'yandex_map' ?>"
             data-nonce="<?php echo wp_create_nonce('yandex_map') ?>"
             data-ajaxurl="<?php echo admin_url('admin-ajax.php') ?>">
            <?php echo svg_spinner() ?>
            <div id="isMapAll" style="width: 100%; height: <?php echo $atts['map_height'] ?>;"></div>
        </div>
        <?php
    }

    $map_html = ob_get_clean();

    if ($atts['footer']) {
        add_action('get_footer', function () use ($map_html) {
            echo $map_html;
        });
    } else {
        return $map_html;
    }
}

function feedback_func($atts)
{

    $atts = shortcode_atts(array(
        'to' => false,
        'subject' => 'Englishchoice - запрос посетителя',
        'title' => '<span class="no-data">Укажите в шорткоде параметр title, например так: title="Ваш текст"</span>',
        'subtitle' => '<span class="no-data">Укажите в шорткоде параметр subtitle, например так: subtitle="Ваш текст"</span>',
        'description' => '<span class="no-data">Укажите в шорткоде параметр description, например так: description="Ваш текст"</span>',
        'title_alter' => "false",
        'subtitle_alter' => "false",
        'description_alter' => "false",
        'submit' => "",
        'submit_text' => "Request Call",
        'wrapper_id' => "feedback_wrapper_auto_width",
        'form_id' => "feedback_form_auto_width",
        'start_work' => time(),
    ), $atts);

    if ($atts['title_alter'] == 'false') {
        $atts['title_alter'] = preg_replace("/##(.*?)##/", "", $atts['title'], -1);
    }
    if ($atts['subtitle_alter'] == 'false') {
        $atts['subtitle_alter'] = preg_replace("/##(.*?)##/", "", $atts['subtitle'], -1);
    }
    if ($atts['description_alter'] == 'false') {
        $atts['description_alter'] = preg_replace("/##(.*?)##/", "", $atts['description'], -1);
    }

    wp_enqueue_style('feedback_form_css');
    wp_enqueue_style('messagebox_css');
    wp_enqueue_script('feedback_form_js');
    wp_enqueue_script('messagebox_js');


    $patterned_string = array(
        'title' => $atts['title'],
        'subtitle' => $atts['subtitle'],
        'description' => $atts['description'],

    );

    foreach ($patterned_string as $name => $string) {

        preg_match_all("/##(.*?)##/", $string, $shortcode_matches[$name], PREG_PATTERN_ORDER, 0);
    }

    $atts_parsed = parse_feedback_data_form($atts, $shortcode_matches);

    $onclick = '';

    if (!empty($atts['submit'])) {

        $onclick = preg_replace('/\r|\t|\n/', '', $atts['submit'], -1);
        $onclick = preg_replace('/\"/', '\'', $onclick, -1);

        $onclick = 'onclick="' . $onclick . '"';
    }
    /* Savitov */
    global $post;

    $is_array_replaced = array('post_title');
    foreach ($atts_parsed as $k => $v) {
        foreach ($is_array_replaced as $k1 => $v1) {
            $is_r = '%' . $v1 . '%';
            $atts_parsed[$k] = str_replace($is_r, $post->$v1, $v);
        }
    }

    /* /Savitov */

    ob_start();

    if ($atts_parsed['to'] === false) {
        echo '<p style="text-align: center; color: red;">Эта форма не работоспособна, потому что в шорткоде не указан параметр to, например to="Получатель@имя.домена"</p>';
    }
    ?>
    <div name="feedback_form" id="<?php echo $atts['wrapper_id']; ?>">
        <div id="<?php echo $atts['form_id']; ?>">
            <div id="title_wrapper">
                <div id="title"><?php echo htmlspecialchars_decode($atts_parsed['title']); ?></div>
            </div>
            <div id="icon_wrapper">
                <div id="icon">?</div>
            </div>
            <div id="form_body">
                <div id="subtitle"><?php echo htmlspecialchars_decode($atts_parsed['subtitle']); ?></div>
                <div id="description"><?php echo htmlspecialchars_decode($atts_parsed['description']); ?></div>
                <div id="data">
                    <input id="name"
                           title="<?php echo __('How to appeal to You. Only letters, please.', 'listable-child-theme') ?>"
                           type="text" placeholder="Имя">
                    <input id="phone"
                           title="<?php echo esc_html__('Phone number within international format: "+ and 11 digits".', 'listable-child-theme') ?>"
                           type="tel" placeholder="+7 xxx xxx-xxxx">
                    <?php echo oferta_warning() ?>
                    <span id="submit" <?php echo $onclick; ?>
                          title="<?php echo __('Request Your Call to us.', 'listable-child-theme') ?>"
                          class="spinner"><?php echo __($atts_parsed['submit_text'], 'listable-child-theme') ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php

    $return = ob_get_clean();

    ob_start();
    ?>
    (function($){

    $('[name="feedback_form"]').data(
    {'ajaxurl'        : '<?php echo admin_url('admin-ajax.php') ?>',
    'nonce_name'    : '<?php echo wp_create_nonce('send_mail_nonce') ?>',
    'sending_title': '<?php echo __('Sending...', 'listable-child-theme') ?>',
    'ajax_err_msg'    : '<?php echo __('Internal error, reload page and repeat Your request', 'listable-child-theme') ?>',
    'atts'            : JSON.parse('<?php echo json_encode($atts, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'),
    'matches'        : JSON.parse('<?php echo json_encode($shortcode_matches) ?>'),
    }
    );

    })(jQuery);
    <?php

    $script_text = ob_get_clean();

    wp_add_inline_script('feedback_form_js', $script_text, 'after');

    return $return;
}

function parse_feedback_data_form($atts, $shortcode_matches)
{

    if (isset($_REQUEST['search_taxonomy'])) {

        $search_taxonomy = $_REQUEST['search_taxonomy'];
    } else {

        $search_taxonomy = get_taxonomies_from_url()['found'];
    }

    $replacement = array(
        'title' => '',
        'subtitle' => '',
        'description' => '',
    );

    foreach ($search_taxonomy as $taxonomy => $term) {

        foreach ($shortcode_matches as $shortcode_match => $match_value) {

            foreach ($match_value[1] as $seo_pattern) {

                $term_id = get_term_by('slug', $term[0], $taxonomy)->term_id;
                $term_meta_value = get_term_meta($term_id, $seo_pattern, true);

                if ($term_meta_value == true) {

                    $replacement[$shortcode_match][$seo_pattern] = $term_meta_value;
                }
            }
        }
    }


    foreach ($replacement as $target => $seo_value) {

        /* if at least 1 seo_pattern filter found */
        if (!empty($seo_value)) {

            $replaces = $seo_value;
            $text = $atts[$target];

            $atts[$target] = preg_replace_callback("/##(.*?)##/", function ($m) use ($replaces) {

                /* If it exists in our array */
                if (isset($replaces[$m[1]])) {

                    /* Then replace it from our array */
                    return $replaces[$m[1]];
                } else {

                    /*
					*  Otherwise:
					*/

                    /* the whole match (basically we won't change it) */
                    //return $m[0];

                    /* OR Nothing */
                    return '';
                }
            }, $text);
        } else {

            $atts[$target] = $atts[$target . '_alter'];
        }
    }

    unset($atts['title_alter']);
    unset($atts['subtitle_alter']);
    unset($atts['description_alter']);

    return $atts;
}

function jobs_shortcode($atts)
{

    $atts['init_load'] = 0;
    $atts['feedback_to'] = false;
    $atts['feedback_subject'] = "Englishchoice - запрос посетителя";
    $atts['feedback_title'] = "<span class='no-data'>Укажите в шорткоде параметр feedback_title, например так: feedback_title=&quot;Ваш текст&quot;</span>";
    $atts['feedback_subtitle'] = "<span class='no-data'>Укажите в шорткоде параметр feedback_subtitle, например так: feedback_subtitle=&quot;Ваш текст&quot;</span>";
    $atts['feedback_description'] = "<span class='no-data'>Укажите в шорткоде параметр feedback_description, например так: feedback_description=&quot;Ваш текст&quot;</span>";
    $atts['feedback_title_alter'] = "false";
    $atts['feedback_subtitle_alter'] = "false";
    $atts['feedback_description_alter'] = "false";
    $atts['feedback_submit'] = "";

    return $atts;
}

function jq_jobs_data($atts)
{


    /* Lets save $atts for a while */
    WP_Job_Manager_Add_On::$output_jobs_args = $atts;

    if ($atts['init_load'] > 0) {

        global $wp_post_types;

        $args = array(
            'orderby' => $atts['orderby'],
            'order' => $atts['order'],
            'posts_per_page' => $atts['init_load'],
            'search_location' => $atts['location'],
            'search_keywords' => $atts['keywords'],
            'search_categories' => $atts['categories'],
            'job_types' => $atts['job_types'],
            'featured' => $atts['featured'],
            'filled' => $atts['filled'],
        );

        $_REQUEST['sort']['sort_rating'] = 'DESC';
        $_REQUEST['sort']['sort_price'] = 'NONE';

        WP_Job_Manager_Add_On::$searching_jb_cat = is_category_searching('job_listing_category');

        ob_start();

        $jobs = get_job_listings($args);

        $result['found_jobs'] = false;

        if ($jobs->have_posts()) {

            $jobs->posts = build_objects_sequence($jobs->posts);

            $result['found_jobs'] = true;

            WP_Job_Manager_Add_On::$init_found['count'] = $jobs->found_posts;

            while ($jobs->have_posts()) {

                $jobs->the_post();
                get_job_manager_template_part('content', 'job_listing');
            }
            wp_reset_postdata();

        } else {

            get_job_manager_template_part('content', 'no-jobs-found');
        }

        WP_Job_Manager_Add_On::$init_load_html = ob_get_clean();

        $search_message = my_filter_job_listing_search_message(false, $jobs);
        WP_Job_Manager_Add_On::$init_cat_des = '<div id="cat_des_wrapper">' . $search_message['cat_des'] . '</div>';

        ?>
        <script type="application/ld+json">{
				"@context"		: "https://schema.org",
				"@type"			: "Product",
				"name"			: "<?php echo $search_message['h1'] ?>",
				"description"	: "<?php echo $search_message['descr'] ?>",
				"offers":{
					"@type"		: "aggregateOffer",
					"lowPrice"	: <?php echo WP_Job_Manager_Add_On::$init_found['min_price'] ?>,
					"highPrice"	: <?php echo WP_Job_Manager_Add_On::$init_found['max_price'] ?>,
					"priceCurrency":"RUB",
					"offerCount": <?php echo WP_Job_Manager_Add_On::$init_found['count'] ?>
				},
				"aggregateRating":{
					"@type":"AggregateRating",
					"worstRating":"1",
					"bestRating":"5",
					"ratingValue":4.4,
					"reviewCount":2797
				}}

        </script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {

                $(document).data({
                    'init_load': <?php echo $atts['init_load']; ?>,
                    'init_result': <?php

                    unset($search_message['cat_des']);
                    echo json_encode($search_message); ?>,
                })
            });
        </script>
        <?php

        if (is_active_sidebar('search-page-banner')) {

            dynamic_sidebar('search-page-banner');
        }
    }
}

/* Repeat Jobs request getting all results on one page */
function get_jobs_no_pagination($query_args, $args = false)
{

    unset($query_args['meta_query']);

    $query_args['orderby'] = array();

    $query_args['meta_query']['price'] = array(
        'key' => '_lessen_price',
        'value' => 0,
        'compare' => '>',
        'type' => 'numeric',
    );

    $query_args['orderby']['price'] = 'DESC';

    $query_args['posts_per_page'] = -1;

    $jobs = new WP_Query($query_args);
    $jobsOffline = array();

    foreach ($jobs->posts as $line) {
        if (isIsOfflineSchool($line->ID)) {

            $isTryPrice = intval(get_post_meta($line->ID, '_lessen_price', true));
            if ($isTryPrice > 0) {
                $jobsOffline[] = $line;
            }
        }
    }


    WP_Job_Manager_Add_On::$init_found['max_price'] = (int)get_post_meta($jobsOffline[0]->ID, '_lessen_price', true);
    WP_Job_Manager_Add_On::$init_found['min_price'] = (int)get_post_meta($jobsOffline[count($jobsOffline) - 1]->ID, '_lessen_price', true);


}

function isGetRangePrices()
{

}

function jobs_fields($fields)
{

    include get_stylesheet_directory() . '/include/selects_data.php';

    /*$fields['_has_branch'] = array(
		'label'       => __( 'Has Branch(es)', 'listable-child-theme' ),
		'type'        => 'checkbox',
		'priority'    => 12.99,
		'description' => __( 'Check if you want mark school card with appropriate marker', 'listable-child-theme' ),
	);*/
    $fields['_to_maps'] = array(
        'label' => esc_html__('Отмечать на карте', 'listable-child-theme'),
        'type' => 'checkbox',
        'description' => __('', 'listable-child-theme'),
        'priority' => 2,
    );
    $fields['_site_fake'] = array(
        'label' => esc_html__('Использовать фейк сайта если он есть', 'listable-child-theme'),
        'type' => 'checkbox',
        'description' => __('', 'listable-child-theme'),
        'priority' => 3,
    );
    if (!listable_child_is_user_role('admin_from_school')) {
        $fields['_link_to_site'] = array(
            'label' => esc_html__('Ссылка на внешний сайт в поиске и в рейтинге', 'listable-child-theme'),
            'type' => 'checkbox',
            'description' => __('', 'listable-child-theme'),
            'priority' => 4,
        );
    }
    $fields['_company_phone_show'] = array( //название осталось т.к. переделываем уже раз 5
        'label' => __('Показывать блок телефон/сайт', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('Информационный блок вверзу страницы (плавающий)', 'listable-child-theme'),
        'options' => company_phone_show(),
        'priority' => 5,
    );
    $fields['_promo'] = array(
        'label' => esc_html__('Акция', 'listable-child-theme'),
        'type' => 'textarea',
        'placeholder' => esc_html__('Любой текст, в т.ч. HTML & JS', 'listable-child-theme'),
        'description' => __('Введенный здесь текст будет использован для показа в карточке школы в инфо-секции Акция', 'listable-child-theme'),
        'priority' => 6,
    );
    $fields['_company_phone_show_text'] = array(
        'label' => esc_html__('Надпись для блока телефон/сайт', 'listable-child-theme'),
        'type' => 'text',
        'placeholder' => esc_html__('Изменить надпись в блоке телефон/сайт', 'listable-child-theme'),
        'description' => __(' ', 'listable-child-theme'),
        'priority' => 7,
    );
    $fields['_lessen_price'] = array(
        'label' => esc_html__('Price', 'listable-child-theme'),
        'type' => 'text',
        'placeholder' => esc_html__('Digits only, e.g 670, leave empty or type 0 to hide price at all', 'listable-child-theme'),
        'description' => __('Price dimention is RUB per hour', 'listable-child-theme'),
        'priority' => 8,
    );
    $fields['_translit'] = array(
        'label' => esc_html__('Transliteration', 'listable-child-theme'),
        'type' => 'text',
        'placeholder' => esc_html__('Any type data. Used in seo templates', 'listable-child-theme'),
        'description' => __('This text will be used in outputes H1, Title, Description and so on...', 'listable-child-theme'),
        'priority' => 9,
    );
    $fields['_foundation_data'] = array(
        'label' => esc_html__('Дата основания', 'listable-child-theme'),
        'type' => 'text',
        'placeholder' => esc_html__('Дата основания школы. Будет выведена "как есть"', 'listable-child-theme'),
        'description' => __('На странице поиска из даты будет взят только год.', 'listable-child-theme'),
        'priority' => 10,
    );
    $fields['_featured'] = array(
        'label' => __('Вводный или тестовый урок-формы', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('Отметьте, если школа проводит вводный или тестовый урок', 'listable-child-theme'),
        'options' => featured_start(),
        'priority' => 11,
    );
    $fields['_featured_lessons'] = array(
        'label' => __('Вводный или тестовый урок-кнопка', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('Отметьте, если школа проводит вводный или тестовый урок', 'listable-child-theme'),
        'options' => featured_lessons(),
        'priority' => 12,
    );
    $fields['_branch_num'] = array(
        'label' => esc_html__('Филиалы', 'listable-child-theme'),
        'type' => 'text',
        'placeholder' => esc_html__('Целое число', 'listable-child-theme'),
        'description' => __('Количество филиалов у школы', 'listable-child-theme'),
        'priority' => 13,
    );

    $countries = countries_options();
    asort($countries);

    //$countries = array_merge(array('-1' => __( 'Не указано', 'listable-child-theme' )), $countries);

    $fields['_expat_lessons'] = array(
        'label' => esc_html__('Наличие занятий с носителем', 'listable-child-theme'),
        'type' => 'multiselect',
        'description' => __('Значения будут выведены с строку, через запятую', 'listable-child-theme'),
        'options' => $countries,
        'priority' => 14,
    );
    $fields['_branchies_list'] = array(
        'label' => esc_html__('Филиалы этой школы', 'listable-child-theme'),
        'type' => 'multiselect',
        'description' => __('Школы из списка будут показаны на карте на странице этой школы', 'listable-child-theme'),
        'options' => blog_schools(),
        'priority' => 15,
    );
    $fields['_training_lessons'] = array(
        'label' => __('Отработка пропущенных занятий', 'listable-child-theme'),
        'type' => 'checkbox',
        'description' => __('Отметьте, если школа позволяет отработать пропущенные занятия', 'listable-child-theme'),
        'priority' => 16,
    );
    $fields['_sertificat'] = array(
        'label' => esc_html__('Сертификат', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('В каких случаях школы выдает сертификат', 'listable-child-theme'),
        'options' => sertificat_options(),
        'priority' => 17,
    );
    $fields['_talking_clubs'] = array(
        'label' => __('Разговорные клубы', 'listable-child-theme'),
        'type' => 'checkbox',
        'description' => __('Отметьте, если школа организовывает разговорные клубы', 'listable-child-theme'),
        'priority' => 18,
    );
    $fields['_teach_books'] = array(
        'label' => esc_html__('Учебные пособия', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('Выдает ли школа учебники и другие учебные пособия', 'listable-child-theme'),
        'options' => teach_books(),
        'priority' => 19,
    );
    $fields['_teach_paymant'] = array(
        'label' => esc_html__('Оплата', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('Установленный порядоку оплаты услуг школы', 'listable-child-theme'),
        'options' => teach_paymant(),
        'priority' => 20,
    );
    $fields['_teach_start'] = array(
        'label' => esc_html__('Старт обучения', 'listable-child-theme'),
        'type' => 'select',
        'description' => __('Периодичность начала занятий в новой группе', 'listable-child-theme'),
        'options' => teach_start(),
        'priority' => 21,
    );

    return $fields;
}

function combine_custom_meta_tags($custom_title)
{

    if (!is_404()) {

        global $post;

        /* Title for search page with map or not */
        if (has_shortcode($post->post_content, 'jobs') && !is_front_page()) {

            $meta_tag_text['title'] = get_combo_meta_tags('search_page')['title'];

            /* New Title goes back to filter */
            return $meta_tag_text['title'];
        }

        /* Title for school page */
        if (is_single() && !is_front_page()) {

            if ($post->post_type === 'job_listing') {

                if (get_query_var('content_type') == 'gallery') {

                    return $meta_tag_text['title'] = get_combo_meta_tags('school_vpage_gallery')['title'];
                }

                if (get_query_var('content_type') == 'comments') {

                    return $meta_tag_text['title'] = get_combo_meta_tags('school_vpage_comments')['title'];
                } else {

                    if (get_option('job_manager_hide_expired_content', 1) && 'expired' === $post->post_status) {

                        /* nothing to do */
                    } else {
                        $meta_tag_text['title'] = get_combo_meta_tags('school_page')['title'];
                        return $meta_tag_text['title'];
                    }
                }
            }
        }

        /* Title for comments page */
        if (has_shortcode($post->post_content, 'reviews') && !is_front_page()) {

            $meta_tag_text['title'] = get_combo_meta_tags('reviews')['title'];

            /* New Title goes back to filter */
            return $meta_tag_text['title'];
        }

        /* Title for home page */
        if (is_front_page()) {

            /* Prevent AISEO rewrite title form home page */
            add_filter('aioseop_title', 'lisatble_downforce_aiseo_title', 10, 1);

            $meta_tag_text['title'] = get_combo_meta_tags('home_page')['title'];
            return $meta_tag_text['title'];
        }
    }
}

/*
* Generate intellectual Title, Description
* and H1 in both cases: for initial load (takes taxonomy terms from url),
* and on ajax requests - jast pass in func array $taxonomy_terms
*/
function get_combo_meta_tags($preset, $taxonomy_terms = false)
{

    global $current_site;
    global $post;

    $custom_taxonomies = WP_Job_Manager_Add_On::$custom_taxonomies;

    /*
	* !!! IMPORTANT Taxonomy value ($taxonomy_val_in_url)
	* should be uniq accross ALL taxonomies processing
	* by class WP_Job_Manager_Add_On
	*/

    if ($taxonomy_terms === false) {
        $taxonomy_val_in_url = preg_split('/\//', $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY);
        array_shift($taxonomy_val_in_url); /* remove permalink like All-courses */
    } else {
        $taxonomy_val_in_url = $taxonomy_terms;
    }

    $meta_tag_text = array();

    switch ($preset) {

        case 'search_page':

            if (count($taxonomy_val_in_url) > 0) {

                foreach ($taxonomy_val_in_url as $taxonomy_in_url) {

                    foreach ($custom_taxonomies as $key => $custom_taxonomy) {

                        if (get_term_by('slug', $taxonomy_in_url, $key) && $custom_taxonomy['active']) {

                            ${$custom_taxonomy['taxonomy_extra_fields']['seo_before']['id']} = get_term_meta(get_term_by('slug', $taxonomy_in_url, $key)->term_id, $custom_taxonomies[$key]['taxonomy_extra_fields']['seo_before']['id'], true);
                            ${$custom_taxonomy['taxonomy_extra_fields']['seo_after']['id']} = get_term_meta(get_term_by('slug', $taxonomy_in_url, $key)->term_id, $custom_taxonomies[$key]['taxonomy_extra_fields']['seo_after']['id'], true);

                        };
                    }
                }

                /*
				* This is the TITLE rule:
				* Школы и курсы английского языка
				* 1-kategoria-DO 6-onlain-offlain-DO 7-tip_obucheniya-DO 8-prepodovatel-DO 2-okrug-DO 3-rajon-DO 4-metro-DO 5-cena-DO
				* v-gorode — рейтинг школ английского языка
				* 1-kategoria-POSLE 6-onlain-offlain-POSLE 7-tip_obucheniya-POSLE 8-prepodovatel-POSLE 2-okrug-POSLE 3-rajon-POSLE 4-metro-POSLE 5-cena-POSLE с отзывами
				*/

                @$meta_tag_text['title'] = 'Курсы английского языка' . ' ' .
                    $category_seo_before . ' ' .
                    $communitype_seo_before . ' ' .
                    $educatype_seo_before . ' ' .
                    $teach_level_seo_before . ' ' .
                    $district_seo_before . ' ' .
                    $region_seo_before . ' ' .
                    $metro_seo_before . ' ' .
                    $price_seo_before . ' ' .
                    get_option('job_manager_city_name_PC', '') . ' ' . '— рейтинг школ английского языка' . ' ' .
                    $category_seo_after . ' ' .
                    $communitype_seo_after . ' ' .
                    $educatype_seo_after . ' ' .
                    $teach_level_seo_after . ' ' .
                    $district_seo_after . ' ' .
                    $region_seo_after . ' ' .
                    $metro_seo_after . ' ' .
                    $price_seo_after . ' ' .
                    'с отзывами';

                /*
				* This is the DESCRIPTION rule:
				* Рейтинг школ английского языка goroda 2-okrug-DO 3-rajon-DO 4-metro-DO.
				* Список курсов по изучению английского языка
				* 1-kategoria-POSLE 6-onlain-offlain-POSLE 7-tip_obucheniya-POSLE 8-prepodovatel-POSLE 5-cena-POSLE
				* с отзывами, рекомендациями и ценами
				* 2-okrug-POSLE 3-rajon-POSLE 4-metro-POSLE v-gorode.
				*/

                @$meta_tag_text['descr'] = 'Рейтинг школ английского языка' . ' ' .
                    get_option('job_manager_city_name_GC', '') . ' ' .
                    $district_seo_before . ' ' .
                    $region_seo_before . ' ' .
                    $metro_seo_before . '. ' .
                    'Список курсов по изучению английского языка' . ' ' .
                    $category_seo_after . ' ' .
                    $communitype_seo_after . ' ' .
                    $educatype_seo_after . ' ' .
                    $teach_level_seo_after . ' ' .
                    $price_seo_after . ' ' .
                    'с отзывами, рекомендациями и ценами' . ' ' .
                    $district_seo_after . ' ' .
                    $region_seo_after . ' ' .
                    $metro_seo_after . ' ' .
                    get_option('job_manager_city_name_PC', '');

                /*
				* This is the H1 rule:
				* Школы и курсы английского языка
				* 1-kategoria-DO
				* 6-onlain-offlain-DO
				* 7-tip_obucheniya-DO
				* 8-prepodovatel-DO
				* 2-okrug-DO
				* 3-rajon-DO
				* 4-metro-DO
				* 5-cena-DO
				* v-gorode
				*/

                @$meta_tag_text['h1'] = 'Курсы английского языка' . ' ' .
                    $category_seo_before . ' ' .
                    $communitype_seo_before . ' ' .
                    $educatype_seo_before . ' ' .
                    $teach_level_seo_before . ' ' .
                    $district_seo_before . ' ' .
                    $region_seo_before . ' ' .
                    $metro_seo_before . ' ' .
                    $price_seo_before . ' ' .
                    get_option('job_manager_city_name_PC', '');

            } else {

                @$meta_tag_text['title'] = 'Школы и курсы английского языка ' . get_option('job_manager_city_name_PC', '') . ' с рейтингом и отзывами учеников, цены';
                @$meta_tag_text['descr'] = 'Рейтинг школ и курсов английского ' . get_option('job_manager_city_name_PC', '') . ' с отзывами студентов. ' .
                    'Лучшие школы и курсы английского языка с ценами и адресами на карте ' . get_option('job_manager_city_name_PC', '') . '. Онлайн-заявка.';
                @$meta_tag_text['h1'] = 'Школы и курсы английского языка ' . get_option('job_manager_city_name_PC', '');
            }

            if (isset (WP_Job_Manager_Add_On::$init_found['count'])) {

                $found = WP_Job_Manager_Add_On::$init_found['count'];

                if ($found == 1) {

                    @$meta_tag_text['sub_h1'] = __('Найден 1 курс', 'listable-child-theme') . ' английского языка ' . $category_seo_before . ' ' . $communitype_seo_before . ' ' . $educatype_seo_before . ' ' . $teach_level_seo_before . ' ' . get_option('job_manager_city_name_PC', '') . '. Цена в ним составляет ' . WP_Job_Manager_Add_On::$init_found['min_price'] . ' р/час' . ' и представлена из расчёта за один академический час. На карточку выведена информация, которая поможет быстро сориентироваться, например: уроки проходят в онлайн и/или оффлайн режиме, год основания, кол-во филиалов, наличие или отсутствие бесплатного урока, минимальная цена. Так же можно сужать воронку поиска, используя фильтры. Все услуги консультантов ' . get_current_site()->domain . ' предоставляются бесплатно.';
                } else {

                    if (WP_Job_Manager_Add_On::$searching_jb_cat) {

                        @$meta_tag_text['sub_h1'] = sprintf(_nx('Найдено %s курс', 'Найдено %s курсов', $found, 'sub h1', 'listable-child-theme'), $found) . ' английского языка ' . $category_seo_before . ' ' . $communitype_seo_before . ' ' . $educatype_seo_before . ' ' . $teach_level_seo_before . ' ' . get_option('job_manager_city_name_PC', '') . '. Цены в них варьируется от ' . WP_Job_Manager_Add_On::$init_found['min_price'] . ' руб/месяц до ' . WP_Job_Manager_Add_On::$init_found['max_price'] . ' руб/месяц. На каждую карточку курсов выведена информация, которая поможет быстро сориентироваться, например: уроки проходят в онлайн и/или оффлайн режиме, год основания, кол-во филиалов, наличие или отсутствие бесплатного урока, минимальная цена. Так же можно сужать воронку поиска, используя фильтры. Все услуги консультантов ' . get_current_site()->domain . ' предоставляются бесплатно.';
                    } else {
                        @$meta_tag_text['sub_h1'] = sprintf(_nx('Найдено %s школы', 'Найдено %s школ', $found, 'sub h1', 'listable-child-theme'), $found) . ' английского языка ' . get_option('job_manager_city_name_PC', '') . '. Цены начинаются от ' . WP_Job_Manager_Add_On::$init_found['min_price'] . ' руб/месяц и доходят до ' . WP_Job_Manager_Add_On::$init_found['max_price'] . ' руб/месяц .  На каждую карточку школы выведена информация, которая поможет быстро сориентироваться, например: уроки проходят в онлайн и/или оффлайн режиме, год основания, кол-во филиалов, наличие или отсутствие бесплатного урока, минимальная цена. Так же вы можете сужать воронку своего поиска, используя удобные фильтры. Все услуги консультантов ' . get_current_site()->domain . ' предоставляются бесплатно.';
                    }
                }
            } else {
                @$meta_tag_text['sub_h1'] = null;
            }

            if (count($taxonomy_val_in_url) >= 3) {

                $meta_tag_text['noindex_page'] = '<meta name="robots" content="noindex, nofollow" />';
            }

            break;

        case 'home_page':

            $meta_tag_text['title'] = 'Курсы английского языка ' . get_option('job_manager_city_name_PC', '') . ' с рейтингом и отзывами учеников, найдено 418 курсов, цена от 2760 рублей';
            $meta_tag_text['descr'] = 'Рейтинг курсов английского ' . get_option('job_manager_city_name_PC', '') . ' с отзывами студентов. Все курсы английского языка с ценами и адресами на карте. Онлайн-заявка.';

            break;

        case 'school_page':

            $h1 = '';

            (get_post_meta($post->ID, '_translit', true) != '') ? $descr_translit = get_post_meta($post->ID, '_translit', true) . ' — ' : $descr_translit = '';
            (get_post_meta($post->ID, '_pixreviwes_average', true) != '' || !get_post_meta($post->ID, '_pixreviwes_average', true)) ? $descr_rating = '(' . get_post_meta($post->ID, '_pixreviwes_average', true) . ')' : __('(пока нет рейтинга)', 'listable-child-theme');
            (get_post_meta($post->ID, '_translit', true) != '') ? $h1 = '(' . get_post_meta($post->ID, '_translit', true) . ')' : '';

            $post_comments = wp_count_comments($post->ID)->approved;
            $descr_review = sprintf(_nx('(%1$s review)', '(%1$s reviews)', $post_comments, 'school h1', 'listable-child-theme'), $post_comments);

            $meta_tag_text['title'] = 'Школа английского языка ' . get_the_title() . ' — отзывы учеников, цены, рейтинг курсов английского языка ' . get_post_meta($post->ID, '_translit', true) . ' ' .
                get_option('job_manager_city_name_PC', '') . ' со ссылкой на официальный сайт';
            $meta_tag_text['descr'] = 'Подробно о курсах английского языка ' . get_the_title() . ' ' . get_option('job_manager_city_name_PC', '') . ' ' . $current_site->domain . '. ' .
                $descr_translit . ' отзывы студентов и преподавателей ' . $descr_review . ',' . ' рейтинг школы ' . $descr_rating .
                ' цены курсов английского от (' . get_post_meta($post->ID, '_lessen_price', true) . ' руб' . '), филиалы на карте Москвы.';
            $meta_tag_text['h1'] = 'Школа английского ' . get_the_title() . ' ' . $h1;

            break;

        case 'reviews':

            $meta_tag_text['title'] = sprintf(__('Отзывы о курсах английского языка %s — отзывы студентов о школах английского', 'listable-child-theme'), get_option('job_manager_city_name_PC', ''));

            break;

        case 'school_vpage_comments':

            $school_vpage_comments_title = get_option('job_manager_vpage_comments_title', 'шаблон для title не заполнен в настройках');
            $school_vpage_comments_descr = get_option('job_manager_vpage_comments_desr', 'шаблон для description не заполнен в настройках');
            $school_vpage_comments_h1 = get_option('job_manager_vpage_comments_h1', 'шаблон для H1 не заполнен в настройках');

            (empty($school_vpage_comments_title)) ? $meta_tag_text['title'] = 'шаблон title содержит пустую строку' : $meta_tag_text['title'] = $school_vpage_comments_title;
            (empty($school_vpage_comments_descr)) ? $meta_tag_text['descr'] = 'шаблон description содержит пустую строку' : $meta_tag_text['descr'] = $school_vpage_comments_descr;
            (empty($school_vpage_comments_h1)) ? $meta_tag_text['h1'] = 'шаблон H1 содержит пустую строку' : $meta_tag_text['h1'] = $school_vpage_comments_h1;


            break;

        case 'school_vpage_gallery':

            $school_vpage_gallery_title = get_option('job_manager_vpage_gallery_title', 'шаблон для title (gallery) не заполнен в настройках');
            $school_vpage_gallery_descr = get_option('job_manager_vpage_gallery_desr', 'шаблон для description (gallery) не заполнен в настройках');
            $school_vpage_gallery_h1 = get_option('job_manager_vpage_gallery_h1', 'шаблон для H1 (gallery) не заполнен в настройках');

            (empty($school_vpage_gallery_title)) ? $meta_tag_text['title'] = 'шаблон title содержит пустую строку' : $meta_tag_text['title'] = $school_vpage_gallery_title;
            (empty($school_vpage_gallery_descr)) ? $meta_tag_text['descr'] = 'шаблон description содержит пустую строку' : $meta_tag_text['descr'] = $school_vpage_gallery_descr;
            (empty($school_vpage_gallery_h1)) ? $meta_tag_text['h1'] = 'шаблон H1 содержит пустую строку' : $meta_tag_text['h1'] = $school_vpage_gallery_h1;


            break;


    }

    foreach ($meta_tag_text as $tag_name => $tag_string) {

        $meta_tag_text[$tag_name] = normalize_string($tag_string);

        $meta_tag_text[$tag_name] = preg_replace_callback('/\[(.*?)\]/', function ($matches) {

            return parse_nominants($matches[0]);
        },
            $meta_tag_text[$tag_name]
        );
    }

    return $meta_tag_text;
}

function normalize_string($string)
{

    /* strip double and more spaces */
    if (seems_utf8($string)) {
        $string = preg_replace('/[\p{Z}\s]{2,}/u', ' ', $string);
    } else {
        $string = preg_replace('/\s\s+/', ' ', $string);
    }

    /* " ." to "." */
    $string = preg_replace('/\s+\./', '.', $string);

    /* 1st & last spaces */
    $string = trim($string);

    /* WP Text filters */
    $string = wptexturize($string);
    $string = convert_chars($string);
    $string = esc_html($string);
    $string = capital_P_dangit($string);

    /* Capitalize first letter in sentence */
    $string = preg_replace_callback(
        '/\.\s+\w/u',
        function ($matches) {
            return mb_strtoupper($matches[0], 'UTF-8');
        },
        $string
    );

    return $string;
}

function output_backhead_nonce()
{

    if (get_current_screen()->base == 'edit-tags' || get_current_screen()->base == 'term') {

        ?>
        <script type="text/javascript">
            var listable_uniq_slug_nonce = '<?php echo wp_create_nonce("tax_slug_uniq"); ?>'
            var found_title_text = '<?php echo __('This slug is in use by (Taxonomy Name › Taxonomy Value › Value ID):', 'listable-child-theme'); ?>'
            var found_note_text = '<?php echo __('KEEP in MIND! The core compares slug string, that will be stored if it is not in uses. It means slug string sintize first by WP engine and not allowed symbols removes from it. ' .
                'Next step - slug compares, so if you try slug? for example "slug---", and same time slug "slug-" exist you will be denied of storing "slug---", couse WP removes "--" and string ' .
                'becomes "slug-" that is in use', 'listable-child-theme'); ?>'
            var taxonomy_term_prefix = '<?php echo WP_Job_Manager_Add_On::$custom_taxonomies[get_current_screen()->taxonomy]['taxonomy_term_prefix']; ?>'
        </script><?php
    }
}

function lisatble_downforce_aiseo_descr($description)
{

    /* return nothing will empty description at all */
    /* return $description; */
}

function lisatble_downforce_aiseo_title($title)
{

    /* return nothing will empty title at all */
    /* return $title; */
}

function listable_init_actions()
{

    /* Plugin Translations */
    unload_textdomain('comments-ratings');
    load_textdomain('comments-ratings', get_stylesheet_directory() . '/languages/plugins/comments-ratings-' . get_locale() . '.mo');
    remove_action('wp_head', 'rsd_link', 20);

    /* CSS */
    wp_register_style('menu_chosen_css', get_stylesheet_directory_uri() . '/include/assets/css/chosen.css');
    wp_register_style('jquery_css', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.min.css');
    wp_register_style('bootstrap_css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array('jquery_css'));
    wp_register_style('pixplaylist_css', get_stylesheet_directory_uri() . '/assets/css/pixplaylist.css');
    wp_register_style('pixgallery_css', get_stylesheet_directory_uri() . '/assets/css/pixgallery.css');
    wp_register_style('messagebox_css', get_stylesheet_directory_uri() . '/assets/css/messagebox.css');
    wp_register_style('listable_child_sortable_css', get_stylesheet_directory_uri() . '/assets/css/sortable-listing.css');
    wp_register_style('style_search_page', get_stylesheet_directory_uri() . '/assets/css/search-page.css', array('menu_chosen_css'));
    wp_register_style('style_front_page', get_stylesheet_directory_uri() . '/assets/css/front-page.css');
    wp_register_style('style_frontend_all', get_stylesheet_directory_uri() . '/assets/css/style-frontend-all.css');
    wp_register_style('relative_posts_widget_css', get_stylesheet_directory_uri() . '/assets/css/relative-posts-widget.css');
    wp_register_style('feedback_form_css', get_stylesheet_directory_uri() . '/assets/css/feedback-form.css', array('jquery_css'));
    wp_register_style('popup_form_css', get_stylesheet_directory_uri() . '/assets/css/popup-form.css', array('jquery_css'));
    wp_register_style('add_school_form_css', get_stylesheet_directory_uri() . '/assets/css/add-school-form.css', array('top_rated_widget_css', 'jquery_css'));
    wp_register_style('add_order_free_css', get_stylesheet_directory_uri() . '/assets/css/add-order-free.css', array('school_page_css', 'jquery_css'));
    wp_register_style('add_review_form_css', get_stylesheet_directory_uri() . '/assets/css/add-review-form.css', array('latest_review_widget_css', 'jquery_css'));
    wp_register_style('top_rated_widget_css', get_stylesheet_directory_uri() . '/assets/css/top-rated-widget.css', array('jquery_css'));
    wp_register_style('latest_review_widget_css', get_stylesheet_directory_uri() . '/assets/css/latest-review-widget.css', array('jquery_css'));
    wp_register_style('school_page_css', get_stylesheet_directory_uri() . '/assets/css/school-page.css', array('jquery_css'));
    wp_register_style('listing_categories_widget_css', get_stylesheet_directory_uri() . '/assets/css/listing-categories-widget.css', array('jquery_css'));
    wp_register_style('compare_schools_widget_css', get_stylesheet_directory_uri() . '/assets/css/compare-schools-widget.css', array('jquery_css'));


    /* JS */
    wp_register_script('yandex_maps_js', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=' . get_site_option('global_settings_preset')['yamaps_apikey'] . '');
    wp_register_script('isPopUpWindow_js', get_stylesheet_directory_uri() . '/assets/js/isPopUpWindow.js', array('jquery'));
    wp_register_script('schools_on_map', get_stylesheet_directory_uri() . '/assets/js/schools-on-map.js', array('jquery', 'yandex_maps_js', 'jquery-ui-dialog', 'jquery-effects-drop'));
    wp_register_script('brunchies_front_js', get_stylesheet_directory_uri() . '/assets/js/branchies-front.js', array('jquery'));
    wp_register_script('easy_slider_js', get_stylesheet_directory_uri() . '/include/assets/js/easy-slider.min.js', array('jquery'));
    wp_register_script('pixplaylist', get_stylesheet_directory_uri() . '/assets/js/pixplaylist.js', array('jquery'));
    wp_register_script('pixgallery', get_stylesheet_directory_uri() . '/assets/js/pixgallery.js', array('jquery'));
    wp_register_script('messagebox_js', get_stylesheet_directory_uri() . '/assets/js/messagebox.js', array('jquery'));
    wp_register_script('admin_taxonomies', get_stylesheet_directory_uri() . '/assets/js/admin-taxonomies.js', array('jquery'));
    wp_register_script('script_frontend_all', get_stylesheet_directory_uri() . '/assets/js/script-frontend-all.js', array('jquery'));
    wp_register_script('listable_child_sortable_js', get_stylesheet_directory_uri() . '/assets/js/sortable-listings.js', array('jquery'));
    wp_register_script('feedback_form_js', get_stylesheet_directory_uri() . '/assets/js/feedback-form.js', array('jquery', 'jquery-ui-tooltip'));
    wp_register_script('add_school_form_js', get_stylesheet_directory_uri() . '/assets/js/add-school-form.js', array('jquery', 'jquery-ui-tooltip', 'jquery-ui-button', 'jquery-ui-dialog', 'jquery-effects-drop', 'jquery-effects-fade'));
    wp_register_script('add_order_free_js', get_stylesheet_directory_uri() . '/assets/js/add-order-free.js', array('jquery', 'jquery-ui-tooltip', 'jquery-ui-button', 'jquery-ui-dialog', 'jquery-effects-drop', 'jquery-effects-fade'));
    wp_register_script('popup_form_js', get_stylesheet_directory_uri() . '/assets/js/popup-form.js', array('jquery', 'jquery-ui-tooltip', 'jquery-ui-button', 'jquery-ui-dialog', 'jquery-effects-drop', 'jquery-effects-fade'));
    wp_register_script('add_review_form_js', get_stylesheet_directory_uri() . '/assets/js/add-review-form.js', array('jquery', 'jquery-ui-tooltip', 'jquery-ui-tabs', 'jquery-ui-dialog', 'jquery-effects-drop', 'jquery-effects-fade', 'latest_review_js'));
    wp_register_script('latest_review_js', get_stylesheet_directory_uri() . '/assets/js/latest-review.js', array('jquery'));

    /* Register new taxonomy an setup it */
    require_once(get_stylesheet_directory() . '/include/class-wp-job-manager-add-on.php');

    /* Ajax Functions */
    require_once(get_stylesheet_directory() . '/include/ajax-calls.php');

    if (is_admin()) {

        /* CSS */
        wp_register_style('jquery_css', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.min.css');
        wp_register_style('netwide_settings_css', get_stylesheet_directory_uri() . '/assets/css/netwide-settings.css');
        wp_register_style('branchies_css', get_stylesheet_directory_uri() . '/assets/css/branchies.css');
        wp_register_style('compare_css', get_stylesheet_directory_uri() . '/assets/css/compare.css');
        wp_register_style('wpjb_setting_css', get_stylesheet_directory_uri() . '/assets/css/wpjb-setting.css', array('jquery_css'));
        wp_register_style('style_backend_all', get_stylesheet_directory_uri() . '/assets/css/style-backend-all.css');

        /* JS */
        wp_register_script('netwide_settings_js', get_stylesheet_directory_uri() . '/assets/js/netwide-settings.js', array('jquery'));
        wp_register_script('branchies_js', get_stylesheet_directory_uri() . '/assets/js/branchies.js', array('jquery'));
        wp_register_script('compare_js', get_stylesheet_directory_uri() . '/assets/js/compare.js', array('jquery'));
        wp_register_script('wpjb_setting_js', get_stylesheet_directory_uri() . '/assets/js/wpjb-setting.js', array('jquery', 'jquery-ui-autocomplete', 'jquery-ui-sortable', 'jquery-ui-datepicker', 'jquery-ui-tabs', 'jquery-ui-tooltip', 'jquery-effects-fade'));
        wp_register_script('script_backend_all', get_stylesheet_directory_uri() . '/assets/js/script-backend-all.js', array('jquery'));
        wp_register_script('menu_chosen_js', get_stylesheet_directory_uri() . '/include/assets/js/chosen.jquery.js', array('jquery'));

        /* NetWide Setting Menu */
        require_once(get_stylesheet_directory() . '/include/class-netwide-setting.php');

        /* Global settings */
        require_once(get_stylesheet_directory() . '/include/class-global-settings.php');
    }

    $listing_base = get_option('listable_permalinks_settings')['listing_base'];

    add_rewrite_tag('%content_type%', '([^&]+)');

    if (function_exists('amp_get_slug')) {
        add_rewrite_rule($listing_base . '/([^/]+)/amp/([^/]+)', 'index.php?job_listing=$matches[1]&content_type=$matches[2]', 'top');
    } else {
        add_rewrite_rule($listing_base . '/([^/]+)/([^/]+)', 'index.php?job_listing=$matches[1]&content_type=$matches[2]', 'top');
    }
}

function listable_admin_init_actions()
{

    if (is_plugin_active('pixtypes/pixtypes.php')) {

        deactivate_plugins('pixtypes/pixtypes.php');
        add_action('all_admin_notices', 'restrict_pixtypes');
    }
}

function set_wp_job_manager_setting($settings_array)
{

    unset ($settings_array['job_listings'][1][1]); /* Hide filled positions		*/
    unset ($settings_array['job_listings'][1][6]); /* Category Filter Type			*/
    unset ($settings_array['job_listings'][1][7]); /* Date Format					*/
    unset ($settings_array['job_listings'][1][9]); /* Multi-select Listing Types	*/
    //unset ( $settings_array['job_listings'][1][10]); /* Google Maps API Key			*/

    //unset ( $settings_array['job_submission']	 );		/* Hole Submission tab		*/
    unset ($settings_array['job_submission'][1][0]);    /* Account Required			*/
    unset ($settings_array['job_submission'][1][1]);    /* Account Creation			*/
    unset ($settings_array['job_submission'][1][2]);    /* Account Username			*/
    unset ($settings_array['job_submission'][1][3]);    /* Account Password			*/
    unset ($settings_array['job_submission'][1][4]);    /* Account Role				*/
    unset ($settings_array['job_submission'][1][5]);    /* Moderate New Listings	*/
    unset ($settings_array['job_submission'][1][6]);    /* Allow Pending Edits		*/
    unset ($settings_array['job_submission'][1][8]);    /* Application Method		*/

    $settings_array['job_pages'][1][0]['label'] = __('Submit Job Form Page', 'listable-child-theme');
    $settings_array['job_pages'][1][1]['label'] = __('Job Dashboard Page', 'listable-child-theme');
    $settings_array['job_pages'][1][2]['label'] = __('Job Listings Page', 'listable-child-theme');

    $settings_array['job_pages'][1][0]['desc'] = __('Select the page where you have placed the [submit_job_form] shortcode. This lets the plugin know where the form is located.', 'listable-child-theme');
    $settings_array['job_pages'][1][1]['desc'] = __('Select the page where you have placed the [job_dashboard] shortcode. This lets the plugin know where the dashboard is located.', 'listable-child-theme');
    $settings_array['job_pages'][1][2]['desc'] = __('Select the page where you have placed the [jobs] shortcode. This lets the plugin know where the job listings page is located. ' .
        'This page will also be used as "All corses node link in Breadcrumbs"', 'listable-child-theme');

	//Insert before Google API Key
/* 	array_splice($settings_array['general'][1], 1, 0, array(array(
		'name' => 'yamaps_api_key',
		'std' => '',
		'placeholder' => __('например: 4e1db7c7-40cc-48c1-82c3-b907625bde3d', 'listable-child-theme'),
		'label' => __('Yandex Maps API Key', 'listable-child-theme'),
		'desc' => __('Для корректной работы Яндекс карт требуется использование API ключа', 'listable-child-theme'),
		'type' => 'text',
		'attributes' => array()
    ))); */

    $settings_array['job_listings'][1][] = array(
        'name' => 'job_manager_card_tags',
        'std' => '0',
        'label' => __('Card tags', 'listable-child-theme'),
        'cb_label' => __('Hide card tags pictures', 'listable-child-theme'),
        'desc' => __('Check to hide pictures on the school cards.', 'listable-child-theme'),
        'type' => 'checkbox',
        'attributes' => array()
    );

    $settings_array['job_listings'][1][] = array(
        'name' => 'geo_taxonomies_slugs',
        'std' => '',
        'placeholder' => __('ex: job_listing_category job_listing_district', 'listable-child-theme'),
        'label' => __('GEO Taxonomies', 'listable-child-theme'),
        'desc' => __('Space separated list of geo taxonomies slugs', 'listable-child-theme'),
        'type' => 'text',
        'attributes' => array()
    );

    $settings_array['job_listings'][1][] = array(
        'name' => 'search_result_school',
        'std' => '',
        'placeholder' => __('ex: skyeng', 'listable-child-theme'),
        'label' => __('Favorite school', 'listable-child-theme'),
        'desc' => __('School slug that will be shown as online school after serach result', 'listable-child-theme'),
        'type' => 'text',
        'attributes' => array()
    );

    $settings_array['job_listings'][1][] = array(
        'name' => 'job_manager_widget_list',
        'std' => '0',
        'label' => __('in Widget List', 'listable-child-theme'),
        'cb_label' => __('Ignore default Widget logic', 'listable-child-theme'),
        'desc' => __('Check to ingnore "Front Page Listing Categories" widget setting. Will be applied ONLY for taxonomy "Category".', 'listable-child-theme'),
        'type' => 'checkbox',
        'attributes' => array()
    );

    $settings_array['job_listings'][1][] = array(
        'name' => 'job_manager_order_free_email',
        'std' => '',
        'placeholder' => __('ex: info@englischchoice.ru', 'listable-child-theme'),
        'label' => __('Order E-mail', 'listable-child-theme'),
        'desc' => __('Mail-to address for order free request', 'listable-child-theme'),
        'type' => 'text',
        'attributes' => array()
    );

    $settings_array['job_listings'][1][] = array(
        'name' => 'job_manager_order_free_email_onclick',
        'std' => '',
        'placeholder' => esc_attr('ex: yaCounter34825020.reachGoal("ZapisSchoolPage"); return true;', 'listable-child-theme'),
        'label' => __('Onclick action', 'listable-child-theme'),
        'desc' => __('Onclick code, no brackets. Will be executed on click free lessen order button', 'listable-child-theme'),
        'type' => 'textarea',
        'attributes' => array()
    );

    $settings_array['job_pages'][1][] = array(
        'name' => 'job_manager_courses_no_map_page_id',
        'std' => '',
        'label' => __('Courses Page with No Map', 'listable-child-theme'),
        'desc' => __('Select the page where you have placed the [jobs per_page=... show_map="false"] shortcode. This lets the plugin know where the this page is located.', 'listable-child-theme'),
        'type' => 'page'
    );

    $settings_array['job_pages'][1][] = array(
        'name' => 'job_manager_category_base_permalink_substitution',
        'std' => '',
        'label' => __('Category permalink base', 'listable-child-theme'),
        'desc' => __('Substitute all categories url with this page url', 'listable-child-theme'),
        'type' => 'page'
    );

    $settings_array['job_pages'][1][] = array(
        'name' => 'job_manager_comments_archive_page',
        'std' => '',
        'label' => __('Comments page', 'listable-child-theme'),
        'desc' => __('This page will show latest review', 'listable-child-theme'),
        'type' => 'page'
    );

    $settings_array['job_pages'][1][] = array(
        'name' => 'job_manager_oferta_page',
        'std' => '',
        'label' => __('Oferta page', 'listable-child-theme'),
        'desc' => __('Point the page, containing oferta content', 'listable-child-theme'),
        'type' => 'page'
    );

    $settings_array['job_pages'][1][] = array(
        'name' => 'external_links_in_new_windows_force',
        'std' => '0',
        'label' => __('External links', 'listable-child-theme'),
        'cb_label' => __('Cards Listing', 'listable-child-theme'),
        'desc' => __('Force links to open in a new window on pages with cards', 'listable-child-theme'),
        'type' => 'checkbox',
        'attributes' => array()
    );

    $settings_array['global_descr'] = array(__('SEO Variables', 'listable-child-theme'),
        array(
            array(
                'name' => 'job_manager_global_description',
                'std' => '',
                'placeholder' => __('Any valid Html code', 'listable-child-theme'),
                'label' => __('Global description', 'listable-child-theme'),
                'desc' => __('Wll be used as school description, while<br>no filters selected on the search page', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'width: 25em; resize: both;',
                ),
            ),
            array(
                'name' => 'job_manager_city_name_NC',
                'std' => '',
                'placeholder' => __('ex: «Moscow», «Kazan»', 'listable-child-theme'),
                'label' => __('Domain (subdomain) the nominative case city name', 'listable-child-theme'),
                'desc' => __('Data will be used as seo<br>variable «gorod» meaning', 'listable-child-theme'),
                'type' => 'text',
                'attributes' => array()
            ),
            array(
                'name' => 'job_manager_city_name_GC',
                'std' => '',
                'placeholder' => __('ex: city of «Moscow», «Kazan»', 'listable-child-theme'),
                'label' => __('Domain (subdomain) the genitive case city name', 'listable-child-theme'),
                'desc' => __('Data will be used as seo<br>variable «goroda» meaning', 'listable-child-theme'),
                'type' => 'text',
                'attributes' => array()
            ),
            array(
                'name' => 'job_manager_city_name_PC',
                'std' => '',
                'placeholder' => __('ex: «in Moscow», «in Kazan»', 'listable-child-theme'),
                'label' => __('Domain (subdomain) the prepositional case city name', 'listable-child-theme'),
                'desc' => __('Data will be used as seo<br>variable «vgorode» meaning', 'listable-child-theme'),
                'type' => 'text',
                'attributes' => array()
            ),
        )
    );

    $settings_array['seo_data'] = array(__('SEO Шаблоны', 'listable-child-theme'),
        array(
            array(
                'name' => 'job_manager_vpage_comments_title',
                'std' => '',
                'placeholder' => __('Any text', 'listable-child-theme'),
                'label' => __('Страница комментариев - title', 'listable-child-theme'),
                'desc' => __('Указанный тут текст будет использован как title на виртуальной странице комментариев школы.', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'resize: both;',
                ),
            ),
            array(
                'name' => 'job_manager_vpage_comments_desr',
                'std' => '',
                'placeholder' => __('Any text', 'listable-child-theme'),
                'label' => __('Страница комментариев - description', 'listable-child-theme'),
                'desc' => __('Указанный тут текст будет использован как description на виртуальной странице комментариев школы.', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'resize: both;',
                ),
            ),
            array(
                'name' => 'job_manager_vpage_comments_h1',
                'std' => '',
                'placeholder' => __('Any text', 'listable-child-theme'),
                'label' => __('Страница комментариев - H1', 'listable-child-theme'),
                'desc' => __('Указанный тут текст будет использован как H1 на виртуальной странице комментариев школы.', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'resize: both;',
                ),
            ),

            array(
                'name' => 'job_manager_vpage_gallery_title',
                'std' => '',
                'placeholder' => __('Any text', 'listable-child-theme'),
                'label' => __('Страница галереи - Title', 'listable-child-theme'),
                'desc' => __('Указанный тут текст будет использован как title на виртуальной странице галереи школы.', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'resize: both;',
                ),
            ),
            array(
                'name' => 'job_manager_vpage_gallery_desr',
                'std' => '',
                'placeholder' => __('Any text', 'listable-child-theme'),
                'label' => __('Страница галереи - description', 'listable-child-theme'),
                'desc' => __('Указанный тут текст будет использован как description на виртуальной странице комментариев школы.', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'resize: both;',
                ),
            ),
            array(
                'name' => 'job_manager_vpage_gallery_h1',
                'std' => '',
                'placeholder' => __('Any text', 'listable-child-theme'),
                'label' => __('Страница галереи - H1', 'listable-child-theme'),
                'desc' => __('Указанный тут текст будет использован как H1 на виртуальной странице галереи школы.', 'listable-child-theme'),
                'type' => 'textarea',
                'attributes' => array(
                    'style' => 'resize: both;',
                ),
            ),
        )
    );

    $settings_array['priorities'] = array(__('Приоритеты', 'listable-child-theme'),
        array(
            array(
                'name' => 'job_manager_objects_sequence',
                'std' => '',
                'label' => __('Порядок школ в поиске', 'listable-child-theme'),
                'type' => 'objects_sequence',
                'attributes' => array(),
            ),
            array(
                'name' => 'job_manager_objects_sequence_debug',
                'std' => '0',
                'label' => __('Отладка', 'listable-child-theme'),
                'cb_label' => __('Выделить цветом карточки школ', 'listable-child-theme'),
                'desc' => __('Установка галочки ативирует выеделение цветом указанные выше школы', 'listable-child-theme'),
                'type' => 'checkbox',
                'attributes' => array()
            ),
        )
    );

    global $wp_widget_factory;

    if (isset($wp_widget_factory->widgets['Listing_TopRated_And_FeedbackForm_Widget'])) {

        $settings_array['priorities'][1][] = array(
            'name' => 'job_manager_exclude_comments_widget_posts',
            'std' => '',
            'label' => __('Исключить школы из виджета комментариев', 'listable-child-theme'),
            'type' => 'exclude_comments_widget_posts',
            'attributes' => array(),
        );
    }

    return $settings_array;
}

function wp_job_manager_admin_field_exclude_comments_widget_posts($option, $attributes, $value, $placeholder)
{

    $sequence = json_decode($value);

    ?>
    <div class="objects-container" data-ajaxurl="<?php echo admin_url('admin-ajax.php') ?>"
         data-nonce-name="<?php echo wp_create_nonce('get_schools_nonce') ?>"
         data-for-input-name="<?php echo $option['name'] ?>"><?php

    foreach ($sequence as $key => $object) {

        unset($sequence[$key]);

        $class = 'object-slot';
        $post_trashed_notice = null;

        $sequence_post = get_post($object->postid);

        if ($sequence_post->post_status == 'trash') {
            $class .= ' post-trashed';
            $post_trashed_notice = '<div class="post-trashed-notice">' . __('запись в корзине', 'listable-child-theme') . '</div>';
        }
        ?>
        <div class="<?php echo $class ?>">
            <?php echo $post_trashed_notice ?>
            <div class="close dashicons dashicons-no"></div>
            <div class="move dashicons dashicons-move prevent-sort"></div>
            <input spellcheck="false" data-postid="<?php echo $sequence_post->ID ?>"
                   data-post-title="<?php echo htmlentities($sequence_post->post_title) ?>"
                   title="<?php _e('Начните вводить название существующей школы', 'listable-child-theme') ?>"
                   class="object" placeholder="<?php _e('Укажите название школы', 'listable-child-theme') ?>"
                   value="<?php echo htmlentities($sequence_post->post_title) ?>"/>
            <span class="date-holder">
						<input spellcheck="false"
                               data-title="<?php _e('Дата (включительно), до которой приоритет будет действовать. Пусто - без ограничений', 'listable-child-theme') ?>"
                               class="date" placeholder="<?php _e('ДД.ММ.ГГГГ', 'listable-child-theme') ?>"
                               value="<?php echo $object->to_date ?>"/>
					</span>
        </div>
        <?php
    }
    ?>
    <div class="object-slot template">
        <div class="close dashicons dashicons-no"></div>
        <div class="move dashicons dashicons-move"></div>
        <input spellcheck="false"
               title="<?php _e('Начните вводить название существующей школы', 'listable-child-theme') ?>" class="object"
               placeholder="<?php _e('Укажите название школы', 'listable-child-theme') ?>"/>
        <span class="date-holder">
				<input spellcheck="false"
                       data-title="<?php _e('Дата (включительно), до которой приоритет будет действовать. Пусто - без ограничений', 'listable-child-theme') ?>"
                       class="date" placeholder="<?php _e('ДД.ММ.ГГГГ', 'listable-child-theme') ?>"/>
			</span>
    </div>
    </div><?php

    echo '<div class="objects-container-result"><input type="hidden" value=\'' . wp_unslash(trim(json_encode($value), '"')) . '\' name="' . $option['name'] . '"/></div>';
}

function wp_job_manager_admin_field_objects_sequence($option, $attributes, $value, $placeholder)
{

    add_filter('admin_body_class', 'wpjm_setting_page_add_classes', 20);

    $sequence = json_decode($value, true);

    if (!isset($sequence['_level_0'])) {
        $sequence['_level_0'] = [];
    }
    if (!isset($sequence['_level_1'])) {
        $sequence['_level_1'] = [];
    }

    ksort($sequence);

    $search_page = get_post(get_option('job_manager_jobs_page_id', false))->post_name;
    if (!$search_page) {
        $search_page = __('Страница поиска не указана в настройках', 'listable-child-theme');
    } else {
        $search_page = '../' . $search_page . '/';
    }

    ?>
    <div>
    <div id="levels-tabs" class="objects-container" data-ajaxurl="<?php echo admin_url('admin-ajax.php') ?>"
         data-nonce-name="<?php echo wp_create_nonce('get_schools_nonce') ?>">
        <ul>
            <?php
            $count = 0;
            foreach ($sequence as $level_name => $level_data) {
                ?>
                <li>
                    <a <?php echo 'href="#' . $level_name . '"' ?>><?php echo $search_page . '-' . $count . '-' . __('filter(s) choosen', 'listable-child-theme') ?></a>
                </li>
                <?php
                $count++;
            }
            ?>
        </ul>
        <?php
        foreach ($sequence as $level_name => $level_data) {
            ?>
            <div id="<?php echo $level_name ?>"><?php

            foreach ($level_data as $level_object) {

                $class = 'object-slot';
                $post_trashed_notice = null;

                $sequence_post = get_post($level_object['postid']);

                if ($sequence_post->post_status == 'trash') {
                    $class .= ' post-trashed';
                    $post_trashed_notice = '<div class="post-trashed-notice">' . __('запись в корзине', 'listable-child-theme') . '</div>';
                }
                ?>
                <div class="<?php echo $class ?>" data-level-name="<?php echo $level_name ?>">
                    <?php echo $post_trashed_notice ?>
                    <div class="close dashicons dashicons-no"></div>
                    <div class="move dashicons dashicons-move"></div>
                    <input spellcheck="false" data-postid="<?php echo $sequence_post->ID ?>"
                           data-post-title="<?php echo htmlentities($sequence_post->post_title) ?>"
                           title="<?php _e('Начните вводить название существующей школы', 'listable-child-theme') ?>"
                           class="object" placeholder="<?php _e('Укажите название школы', 'listable-child-theme') ?>"
                           value="<?php echo htmlentities($sequence_post->post_title) ?>"/>
                    <span class="date-holder">
									<input spellcheck="false"
                                           data-title="<?php _e('Дата (включительно), до которой приоритет будет действовать. Пусто - без ограничений', 'listable-child-theme') ?>"
                                           class="date" placeholder="<?php _e('ДД.ММ.ГГГГ', 'listable-child-theme') ?>"
                                           value="<?php echo $level_object['to_date'] ?>"/>
								</span>
                </div>
                <?php
            }
            ?>
            <div class="object-slot template" data-level-name="<?php echo $level_name ?>">
                <div class="close dashicons dashicons-no"></div>
                <div class="move dashicons dashicons-move"></div>
                <input spellcheck="false"
                       title="<?php _e('Начните вводить название существующей школы', 'listable-child-theme') ?>"
                       class="object" placeholder="<?php _e('Укажите название школы', 'listable-child-theme') ?>"/>
                <span class="date-holder">
								<input spellcheck="false"
                                       data-title="<?php _e('Дата (включительно), до которой приоритет будет действовать. Пусто - без ограничений', 'listable-child-theme') ?>"
                                       class="date" placeholder="<?php _e('ДД.ММ.ГГГГ', 'listable-child-theme') ?>"/>
							</span>
            </div>
            </div>
            <?php
        }
        ?>
    </div>
    </div><?php

    echo '<div class="objects-container-result"><input type="hidden" value=\'' . wp_unslash(trim(json_encode($value), '"')) . '\' name="' . $option['name'] . '"/></div>';
}

function wpjm_setting_page_add_classes($classes)
{

    $classes = $classes . ' custom-scope ';

    return $classes;
}

function restrict_pixtypes()
{
    ?>
    <div id="message" class="error">
        <p><?php _e('PixTypes was excluded from allowed plugins by Listable Child Theme and has been deactivated Back', 'listable-child-theme') ?></p>
    </div>
    <?php
}

function populate_posts_data($posts, $query)
{

    if (count($posts) === 0) {
        return $posts;
    }

    if (isset($query->query['orderby']['reviwes'])) {

        global $wpdb;

        $post_status = $query->query['post_status'];

        $rule = get_site_option('global_settings_preset', 1);

        if ($rule) {
            if (!empty($rule['rating_downforce_rule'])) {
                $downforce_raiting = preg_replace("/reviews/", "COUNT(postmeta.meta_key)", $rule['rating_downforce_rule'], -1);
            } else {
                $downforce_raiting = 1;
            }
        } else {
            $downforce_raiting = 1;
        }

        if ($query->query['posts_per_page'] === -1) {

            $limit = '';
        } else {
            $limit = 'LIMIT ' . $query->query['offset'] . ', ' . $query->query['posts_per_page'];
        }

        $order = $query->query['orderby']['reviwes'];

        $squares = '';
        $inner = array();
        $inner_join = '';
        $where = '';

        $to_step = $query->query['tax_query'];

        if (count($to_step > 0)) {

            foreach ($to_step as $index => $data) {

                $inner[] = $wpdb->prepare("INNER JOIN $wpdb->term_relationships AS term_relationships_%d ON posts.ID = term_relationships_%d.object_id", $index + 1, $index + 1);

                foreach ($data['terms'] as $term_slug) {

                    $term_id = get_term_by('slug', $term_slug, $data['taxonomy'])->term_taxonomy_id;

                    $where .= 'AND term_relationships_' . ($index + 1) . '.term_taxonomy_id IN(' . $term_id . ') ';
                }
            }
            $inner_join = implode($inner, ') ');

            for ($i = 1; $i < count($to_step); $i++) {

                $squares .= '(';
            }
        }

        $query_post_array = $wpdb->get_results(
            $wpdb->prepare("
				SELECT
					posts.ID as ID,
					posts.ID as post_id,
					posts.post_author as post_author,
					posts.post_date as post_date,
					posts.post_date_gmt as post_date_gmt,
					posts.post_content as post_content,
					posts.post_title as post_title,
					posts.post_excerpt as post_excerpt,
					posts.post_status as post_status,
					posts.comment_status as comment_status,
					posts.ping_status as ping_status,
					posts.post_password as post_password,
					posts.post_name as post_name,
					posts.to_ping as to_ping,
					posts.pinged as pinged,
					posts.post_modified as post_modified,
					posts.post_modified_gmt as post_modified_gmt,
					posts.post_content_filtered as post_content_filtered,
					posts.post_parent as post_parent,
					posts.guid as guid,
					posts.menu_order as menu_order,
					posts.post_type as post_type,
					posts.post_mime_type as post_mime_type,
					posts.comment_count as comment_count,
					posts.comment_status as comment_status,
					postmeta.meta_value AS review_average,
					ROUND( postmeta.meta_value * (  1 - 1 / pow( COUNT(postmeta.meta_key), 0.99 ) ), 2) AS review_average_pow,
					COUNT(postmeta.meta_key) AS reviews_count, Sum(commentmeta.meta_value) AS reviews_sum

				FROM (
						$squares

						(
							($wpdb->posts AS posts INNER JOIN $wpdb->postmeta AS postmeta ON posts.ID = postmeta.post_id)

							LEFT JOIN $wpdb->comments AS comments ON posts.ID = comments.comment_post_ID
						)
							LEFT JOIN $wpdb->commentmeta AS commentmeta ON comments.comment_ID = commentmeta.comment_id
						$inner_join
					)


				WHERE
					(
					(((comments.comment_approved)='1') OR ((comments.comment_approved)='0') OR ((comments.comment_approved) is null))
					AND ((postmeta.meta_key)	= '_pixreviwes_average')
                    AND (((commentmeta.meta_key)	= 'pixrating') OR ((commentmeta.meta_key) is null))
					AND ((posts.post_type)		= 'job_listing')
					AND (((posts.post_status)	= 'publish') OR ((posts.post_status) = 'expired'))
                    $where
                    )

               GROUP BY posts.ID, postmeta.meta_value
			   ORDER BY review_average_pow $order;
			", [])
        );

        /* $posts = $query_post_array; */
        $posts = build_objects_sequence($query_post_array);

        if ($query->query['posts_per_page'] > 0) {

            $posts = array_slice($posts, $query->query['offset'], $query->query['posts_per_page']);
        }
    }

    remove_filter('the_posts', 'populate_posts_data', 10, 2);

    return $posts;
}

function build_objects_sequence($posts_array)
{

    $level = WP_Job_Manager_Add_On::$searching_texonomies;

    if (count($level) > 0) {
        $sequence_key = '_sequence_position_level_1';
        $date_key = '_sequence_date_limit_level_1';
    } else {
        $sequence_key = '_sequence_position_level_0';
        $date_key = '_sequence_date_limit_level_0';
    }
    $premium_args = array(
        'posts_per_page' => -1,
        'offset' => 0,
        'post_type' => 'any',
        'post_type' => array('job_listing'),
        'fields' => 'ids',
        'meta_query' => array(
            'relation' => 'AND',
            'position' => array(
                'key' => $sequence_key,
                'compare' => 'EXISTS',
                'type' => 'NUMERIC',
            ),
            'date' => array(
                'relation' => 'OR',
                array(
                    'key' => $date_key,
                    'value' => date('d.m.Y'),
                    'compare' => '>=',
                    'type' => 'DATE',
                ),
                array(
                    'key' => $date_key,
                    'value' => null,
                    'compare' => '=',
                ),
            ),
        ),
        'orderby' => 'position',
        'order' => 'ASC',
    );

    $posts_premium = new WP_Query($premium_args);

    if ($posts_premium->found_posts > 0) {

        $sequented_posts = array();

        foreach ($posts_array as $key => $post) {

            $sequence_position = array_search($post->ID, $posts_premium->posts);

            if ($sequence_position !== false) {

                $sequented_posts[$sequence_position] = $posts_array[$key];
                unset($posts_array[$key]);
            }
        }

        ksort($sequented_posts);
        return array_values(array_merge($sequented_posts, $posts_array));
    } else {
        return $posts_array;
    }
}

/*
* This function filters the $query_args that uses WP Job Manager
* "get_job_listings" func to return listing into theme "get_listings",
* that return result with AJAX
* If $_REQUEST['search_taxonomy'] is not set - will try to parse
* Taxonomy from URL
*/
function my_filter_job_listing_query_args($query_args, $args)
{

    if (isset($_POST['search_school'])) {

        $query_args = array(
            's' => $_POST['search_school'],
        );

        return $query_args;
    }

    if (isset($_GET['search_school'])) {

        $query_args = array(
            's' => $_GET['search_school'],
        );

        return $query_args;
    }

    add_filter('the_posts', 'populate_posts_data', 10, 2);

    if (isset ($args['search_categories'])) {
        unset ($args['search_categories']);
    }

    if (isset($_REQUEST['search_taxonomy'])) {

        $search_taxonomy = $_REQUEST['search_taxonomy'];
    } else {

        $search_taxonomy = get_taxonomies_from_url()['found'];
    }

    $_REQUEST['sort']['sort_rating'] = 'DESC';
    $_REQUEST['sort']['sort_price'] = 'NONE';

    WP_Job_Manager_Add_On::$searching_jb_cat = is_category_searching('job_listing_category');
    WP_Job_Manager_Add_On::$searching_texonomies = $search_taxonomy;

    foreach ($search_taxonomy as $taxonomy => $value_array) {

        if ($taxonomy == 'job_listing_category') {

            $field = is_numeric($taxonomy[0]) ? 'term_id' : 'slug';
            $operator = 'all' === get_option('job_manager_category_filter_type', 'all') && sizeof($taxonomy) > 1 ? 'AND' : 'IN';
            $query_args['tax_query'][] = array(
                'taxonomy' => $taxonomy,
                'field' => $field,
                'terms' => array_values($value_array),
                'include_children' => $operator !== 'AND',
                'operator' => $operator
            );
        } else {

            $query_args['tax_query'][] = array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $value_array
            );
        }
    }

    if (isset($_REQUEST['sort']) && ($_REQUEST['sort']['sort_price'] != 'NONE' || $_REQUEST['sort']['sort_rating'] != 'NONE')) {

        $query_args['meta_query'] = array(
            'relation' => 'OR'
        );
        $query_args['orderby'] = array();

        if ($_REQUEST['sort']['sort_price'] != 'NONE') {

            $query_args['meta_query']['price'] = array(
                'key' => '_lessen_price',
                'compare' => 'EXISTS',
                'type' => 'NUMERIC',
            );

            $query_args['orderby']['price'] = $_REQUEST['sort']['sort_price'];
        }

        if ($_REQUEST['sort']['sort_rating'] != 'NONE') {

            $query_args['meta_query']['reviwes'] = array(
                'key' => '_pixreviwes_average',
                'compare' => 'EXISTS'
            );

            $query_args['orderby']['reviwes'] = $_REQUEST['sort']['sort_rating'];
        }
    }

    return $query_args;
}

/*
* This function filters $args for ajax request from filters page
* that goes into WP Job Manager "get_job_listings"
* If $_REQUEST['search_taxonomy'] is not set - will try to parse
* Taxonomy from URL
*/
function my_job_manager_get_listings_args($args)
{

    global $wp_post_types;

    if (isset($_REQUEST['search_taxonomy'])) {

        $search_taxonomy = $_REQUEST['search_taxonomy'];
    } else {

        $search_taxonomy = get_taxonomies_from_url()['found'];
    }

    foreach ($search_taxonomy as $taxonomy => $value_array) {

        if (is_array($value_array)) {
            $search_this = array_filter(array_map('sanitize_text_field', array_map('stripslashes', $value_array)));
        } else {
            $search_this = array_filter(array(sanitize_text_field(stripslashes($value_array))));
        }

        $args['search_' . $taxonomy] = $search_this;
    }

    return $args;
}

/*
* Try to parse taxonomy terms from URL
*/
function get_taxonomies_from_url()
{

    $custom_taxonomies = WP_Job_Manager_Add_On::$custom_taxonomies;

    //$taxonomy_val_in_url = preg_split( '/\//', $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY );
    $taxonomy_val_in_url = preg_split('/\//', parse_url($_SERVER['REQUEST_URI'])['path'], -1, PREG_SPLIT_NO_EMPTY);
    array_shift($taxonomy_val_in_url); /* remove permalink like All-courses */

    if (count($taxonomy_val_in_url) >= 0) {

        $search_taxonomy_arr['found'] = array();

        foreach ($taxonomy_val_in_url as $taxonomy_in_url) {

            foreach ($custom_taxonomies as $key => $custom_taxonomy) {

                if (get_term_by('slug', $taxonomy_in_url, $key) && $custom_taxonomy['active']) {

                    $search_taxonomy_arr['found'][$key][] = $taxonomy_in_url;
                };
            }
        }
        $search_taxonomy_arr['of'] = count($taxonomy_val_in_url);
    }

    return $search_taxonomy_arr;
}

function listable_child_front_enqueue_scripts()
{

    wp_deregister_script('wp-job-manager-ajax-filters');
    wp_register_script('wp-job-manager-ajax-filters', get_stylesheet_directory_uri() . '/assets/js/ajax-filters.js', array('jquery', 'jquery-effects-core', 'jquery-effects-drop', 'chosen'));
}

function my_add_rewrite_rules()
{

    global $wp_rewrite;

    $courses_on_map = get_option('job_manager_jobs_page_id', false);

    if (!empty($courses_on_map)) {

        $new_rules = array(
            'jobs/(.*)/?$' => 'index.php?post_type=job_listing', //обязательно в интерфейсе админ панели указать Listing Listings Page
            get_post($courses_on_map)->post_name . '/(.*)/?$' => 'index.php?page_id=' . $courses_on_map,
        );

        if ($wp_rewrite->rules === null) {

            $wp_rewrite->rules = $new_rules;
        } else {
            $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
        }
    }
}

function edit_geo_data($post_ID, $post, $update){
	
	$geo_set			= array();
	$upd_all			= false;
	$current_geo_set	= get_option( 'clinics_geo_set', array() );
	
	$args = array(
		'numberposts'	=> -1,
		'post_type'		=> $post->post_type,
		'post_status'	=> 'publish',
		'fields'		=> 'ids',
		'orderby'		=> 'ID',
		'order'			=> 'ASC',
	);
	
	if(!$upd_all){
		$args['p'] = $post_ID;
	}
	
	$blog_posts = get_posts($args);
	
	foreach($blog_posts as $blog_post_id){
		
		$current_geo_set[ $blog_post_id ] = prepare_post_geo( $blog_post_id );
	}
	
	if(!$upd_all && count($blog_posts) == 0){
		
		unset($current_geo_set[ $post_ID ]);
	}
	
	update_option( 'clinics_geo_set', $current_geo_set);

}

function prepare_post_geo($post_id){
	
	$post_meta = get_post_meta($post_id);
		
	$post_geo_set = array();
	$post_geo_set['title']	= get_post($post_id)->post_title;
	
	if( isset($post_meta['geolocation_lat'][0]) ){
		$post_geo_set['lat'] = $post_meta['geolocation_lat'][0];
	}
	if( isset($post_meta['geolocation_long']) ){
		$post_geo_set['long'] = $post_meta['geolocation_long'][0];
	}
	if( isset($post_meta['geolocation_formatted_address']) ){
		$post_geo_set['address'] = $post_meta['geolocation_formatted_address'][0];
	}
	
	$post_geo_set['image']	= get_the_post_thumbnail_url($post_id, 'thumbnail');
	$post_geo_set['url']	= get_the_permalink($post_id);
	
	if( isset($post_meta['_company_phone']) ){
		$post_geo_set['phone'] = $post_meta['_company_phone'][0];
	}
	
	return $post_geo_set;
}

/*
* This func filters search info like H1, description, title
* and so on in AJAX request on filters page
*/
function my_filter_job_listing_search_message($result = false, $jobs = false)
{

    $result['showing'] = array();
    $result['cat_des'] = "";

    if ($jobs->have_posts()) {
        $result['found_jobs'] = true;
        WP_Job_Manager_Add_On::$init_found['count'] = $jobs->found_posts;
    }

    $taxonomy_terms = array();

    if (isset($_REQUEST['search_taxonomy'])) {

        $search_taxonomy = $_REQUEST['search_taxonomy'];
    } else {

        $search_taxonomy = get_taxonomies_from_url()['found'];
    }

    foreach ($search_taxonomy as $taxonomy) {

        if (is_array($taxonomy)) {

            foreach ($taxonomy as $value) {

                $taxonomy_terms[] = $value;
            }
        } else {
            $taxonomy_terms[] = $value;
        }
    }

    $combo_meta = get_combo_meta_tags('search_page', $taxonomy_terms);

    $wclass = ' no_widget';
    $add_column = '';

    if (is_active_sidebar('taxonomy_description_add_column')) {

        ob_start();

        dynamic_sidebar('taxonomy_description_add_column');

        $content = ob_get_clean();

        if (Listing_Sidebar_Crosslinking_Widget::$widget_has_content === true) {

            $add_column = '<div id="widget_placeholder">' . $content . '</div>';
            $wclass = ' with_widget';
        } else {
            $add_column = '<div id="widget_placeholder" class="empty_content"></div>';
        }
    }

    if (count($search_taxonomy) === 1) {

        reset($search_taxonomy);
        $first = key($search_taxonomy);

        $search_category = isset($search_taxonomy[$first]) ? $search_taxonomy[$first] : '';

        if (is_array($search_category)) {
            $search_category = array_filter(array_map('sanitize_text_field', array_map('stripslashes', $search_category)));
        } else {
            $search_category = array_filter(array(sanitize_text_field(stripslashes($search_category))));
        }

        if ($search_category) {
            $term = array();

            foreach ($search_category as $category) {
                $category_object = get_term_by(is_numeric($category) ? 'id' : 'slug', $category, $first);

                if (!is_wp_error($category_object)) {
                    $search_category[] = $category_object->name;
                    $result['cat_des'] = '<div id="cat_des_holder" class="with_cat_content' . $wclass . '"><div id="cat_des" class="cat_des">' . $category_object->description . '</div>' . $add_column . '</div>';
                }
            }
        }
    } else if (count($search_taxonomy) === 0) {

        $reviews = '';
        $blog_id = get_current_blog_id();
        if ($blog_id == 2) {
            ob_start();
            do_shortcode('[like_reviews]');
            $reviews = ob_get_clean();
        }

        $result['cat_des'] = '<div id="cat_des_holder" class="with_cat_content' . $wclass . '"><div id="cat_des" class="cat_des">' . $reviews . get_option('job_manager_global_description', '') . '</div>' . $add_column . '</div>';
    } else {
        $result['cat_des'] = '<div id="cat_des_holder" class="no_cat_content' . $wclass . '"><div id="cat_des"></div>' . $add_column . '</div>';
    }

    //$sorting_tools_classes = 'sort_tools active';

    //Generate link

    //$result['showing_links']	= '<a href="#" class="reset">' . __('Reset', 'listable-child-theme') . '</a>';
    $result['showing_links'] = '';
    $result['title'] = $combo_meta['title'];
    $result['descr'] = $combo_meta['descr'];
    $result['h1'] = $combo_meta['h1'];
    $result['sub_h1'] = $combo_meta['sub_h1'];
    $result['total_found'] = $jobs->found_posts;
    $result['search_text'] = listable_child_search_result_string($search_taxonomy);
    $result['sort_tools'] = $result['search_text']['sorting'];
    $result['breadcrumbs'] = listable_child_footer_breadcrumbs_data($search_taxonomy);
    $result['noindex_page'] = html_entity_decode($combo_meta['noindex_page']);

    if (isset($_REQUEST['feedback_form_atts']) && isset($_REQUEST['feedback_form_match'])) {

        $result['feedback_form'] = parse_feedback_data_form($_REQUEST['feedback_form_atts'], $_REQUEST['feedback_form_match']);
    }

    return $result;
}

function listable_child_register_widget_area()
{

    require_once(get_stylesheet_directory() . '/include/widgets.php');

    unregister_sidebar('footer-widget-area');
    unregister_sidebar('listing_sidebar');            /* i want to change its name */
    unregister_sidebar('listing_content');            /* changind order of areas */
    unregister_sidebar('listing__sticky_sidebar');    /* changind order of areas */

    register_sidebar(array(
        'name' => '&#x1f535; ' . esc_html__('Главная страница', 'listable-child-theme') . ' &raquo; ' . esc_html__('Баннер', 'listable-child-theme'),
        'id' => 'front-page-banner',
        'description' => esc_html__('Контент этой области виджетов будет выведен на главной странице перед инфоблоками в контейнере с размерами 978х122px. Изображение предпочтительно.', 'listable-child-theme'),
        'before_widget' => '<aside id="%1$s" class="widget  widget--frontpage--banner  %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => '&#x1f535; ' . esc_html__('Footer Area', 'listable-child-theme'),
        'id' => 'footer-widget-area',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget  widget--footer  %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Listing', 'listable-child-theme') . ' &raquo; ' . esc_html__('Content', 'listable-child-theme'),
        'description' => esc_html__('The widget area where the main listing content should go.', 'listable-child-theme'),
        'id' => 'listing_content',
        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_sidebar_title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Listing', 'listable-child-theme') . ' &raquo; ' . esc_html__('Listing After Content', 'listable-child-theme'),
        'description' => esc_html__('Placed below the Sidebar Bottom, this area brings together all the widgets under the same container.', 'listable-child-theme'),
        'id' => 'listing_after_content_area',
        'before_widget' => '<div id="%1$s" class="widget widget_listing_sidebar_categories %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_sidebar_title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Listing', 'listable-child-theme') . ' &raquo; ' . esc_html__('Sidebar Top', 'listable-child-theme'),
        'description' => esc_html__('Placed to the top of the right sidebar, this area put each widget in a visually different boxed container.', 'listable-child-theme'),
        'id' => 'listing__sticky_sidebar',
        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_sidebar_title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Listing', 'listable-child-theme') . ' &raquo; ' . esc_html__('Sidebar Middle', 'listable-child-theme'),
        'description' => esc_html__('Placed below the Sidebar Top, this area brings together all the widgets under the same container.', 'listable-child-theme'),
        'id' => 'listing_sidebar',
        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_sidebar_title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Listing', 'listable-child-theme') . ' &raquo; ' . esc_html__('Sidebar Bottom', 'listable-child-theme'),
        'description' => esc_html__('Placed below the Sidebar Bottom, this area brings together all the widgets under the same container.', 'listable-child-theme'),
        'id' => 'after_sidebar_bottom_area',
        'before_widget' => '<div id="%1$s" class="widget widget_listing_sidebar_categories %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_sidebar_title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Поиск', 'listable-child-theme') . ' &raquo; ' . esc_html__('Баннер', 'listable-child-theme'),
        'description' => esc_html__('Контент этой области виджетов будет выведен на странице поиска школ перед фильтрами в контейнере с размерами 978х122px. Изображение предпочтительно.', 'listable-child-theme'),
        'id' => 'search-page-banner',
        'before_widget' => '<div id="%1$s" class="widget widget--search--banner %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget_sidebar_title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => '&#x1F536; ' . esc_html__('Поиск', 'listable-child-theme') . ' &raquo; ' . esc_html__('Taxonomy Description', 'listable-child-theme'),
        'description' => esc_html__('Placed below the Taxonomy Description, this area divides taxonomy description area as 3/4 to 1/4 and show widgets in 1/4 column.', 'listable-child-theme'),
        'id' => 'taxonomy_description_add_column',
        'before_widget' => '<div id="%1$s" class="widget widget_listing_sidebar_categories %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget_sidebar_title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => '&#x1F4AC; ' . esc_html__('Listing', 'listable-child-theme') . ' &raquo; ' . esc_html__('Comments Page', 'listable-child-theme'),
        'description' => esc_html__('This widget content outputs on the standalong school comments page like schoolname/comments/', 'listable-child-theme'),
        'id' => 'schoolpage_comments_sidebar',
        'before_widget' => '<div id="%1$s" class="widget widget_listing_sidebar_comments %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget_sidebar_title">',
        'after_title' => '</h3>',
    ));

    if (function_exists('the_job_permalink')) {
        register_widget('Front_Page_Sortable_Listing_Cards_Widget');
    }

    register_widget('Listing_Sidebar_Custom_Taxonomies_Widget');
    register_widget('Listing_TopRated_And_FeedbackForm_Widget');
    register_widget('Listing_Latest_Reviews');
    register_widget('Listing_Sidebar_Relative_Post_Widget');
    register_widget('Listing_Sidebar_Promo_Post_Widget');
    register_widget('Listing_Sidebar_Crosslinking_Widget');
    register_widget('PopUpForm_Widget');
    register_widget('Listing_Brunchies_Widget');
    register_widget('Listing_Study_Condition_Widget');
    register_widget('Listing_Compare_Schools_Widget');
}


/*
* This func defined in \wp-content\themes\listable\functions.php
* But we need to change it. So we will define it first
*/
function listable_display_logo()
{

    $home_link = esc_url(home_url('/'));
    $blog_name = get_bloginfo('name');
    $logo = wp_get_attachment_image(listable_get_option('logo_invert'), 'full', false, array(
        'class' => 'custom-logo',
    ));

    /* Display the inverted logo if all the requirements are met */
    $logo_invert = wp_get_attachment_image_src(listable_get_option('logo_invert'));
    $header_transparent = listable_get_option('header_transparent');

    if ($header_transparent && !empty($logo_invert[0]) && is_page_template('page-templates/front_page.php')) {

        $html = sprintf('<div class="site-branding  site-branding--image">' .
            '<a href="%1$s" class="custom-logo-link  custom-logo-link--light" rel="home">%2$s</a>' .
            '</div>',
            $home_link,
            $logo
        );
    } /* or else display the regular logo */
    elseif (function_exists('the_custom_logo') && has_custom_logo()) {

        /* For transferring existing site logo from Jetpack -> Core */
        if (!get_theme_mod('custom_logo') && $jp_logo = get_option('site_logo')) {

            set_theme_mod('custom_logo', $jp_logo['id']);
            delete_option('site_logo');
        }

        //echo $jp_logo['id']; - я так и не смог въехать что они пытались этим вывести

        $html = sprintf('<div class="site-branding  site-branding--image">%1$s</div>', get_custom_logo());
    } /* or else display the text logo */
    else {

        $html = sprintf('<div class="site-branding" itemscope itemtype="http://schema.org/Organization">' .
            '<h1 class="site-title  site-title--text">' .
            '<a class="site-logo-link" href="%1$s" rel="home">%2$s</a>' .
            '</h1>' .
            '</div>',
            $home_link,
            $blog_name
        );
    }
    echo $html;
}

function comments_ratings_edit()
{

    if (class_exists('PixReviewsPlugin')) {

        class PixReviewsPlugin_Child extends PixReviewsPlugin
        {

            function __construct()
            {

                $plugin_basename = plugin_basename(plugin_dir_path(__FILE__) . 'pixreviews.php');

                remove_action('admin_menu', array(PixReviewsPlugin::$instance, 'add_plugin_admin_menu'));
                remove_filter('plugin_action_links_' . $plugin_basename, array(PixReviewsPlugin::$instance, 'add_action_links'));
                remove_action('admin_enqueue_scripts', array(PixReviewsPlugin::$instance, 'enqueue_admin_scripts'));
                remove_action('wp_enqueue_scripts', array(PixReviewsPlugin::$instance, 'enqueue_scripts'));
                remove_action('comment_form_logged_in_after', array(PixReviewsPlugin::$instance, 'output_review_fields'));
                remove_action('comment_form_after_fields', array(PixReviewsPlugin::$instance, 'output_review_fields'));
                remove_action('comment_form_field_comment', array(PixReviewsPlugin::$instance, 'filter_comment_form'));
                remove_action('comment_form_defaults', array(PixReviewsPlugin::$instance, 'filter_submit_comment_button'));
                remove_action('comment_post', array(PixReviewsPlugin::$instance, 'save_comment'));
                remove_action('save_post', array(PixReviewsPlugin::$instance, 'set_default_average_rating'));
                remove_action('wp_update_comment_count', array(PixReviewsPlugin::$instance, 'update_post_comment'), 10, 3);
                remove_action('comment_text', array(PixReviewsPlugin::$instance, 'display_rating'));
                remove_filter('comment_edit_redirect', array(PixReviewsPlugin::$instance, 'save_comment_backend'), 10, 2);
                remove_action('add_meta_boxes', array(PixReviewsPlugin::$instance, 'add_custom_backend_box'));
                remove_action('comment_text', array(PixReviewsPlugin::$instance, 'display_rating'));

                parent::__construct();

            }

            function display_rating($comment)
            {
                //bail if shouldn't show ratings for the current post
                if (!$this->is_visible_on_this_post()) {
                    return $comment;
                }

                //bail if we don't have a valid current comment ID
                if (!get_comment_ID()) {
                    return $comment;
                }

                //get the rating
                $rating = get_comment_meta(get_comment_ID(), 'pixrating', true);
                //get the rating title
                $pixrating_title = get_comment_meta(get_comment_ID(), 'pixrating_title', true);

                //add the rating stars to the comment
                if (!empty($rating)) {
                    $comment = '<div class="review_rate" data-pixrating="' . $rating . '"></div>' . $comment;
                }

                //add the rating title
                if (!empty($pixrating_title)) {
                    $comment = '<p class="pixrating_title">' . $pixrating_title . '</p>' . $comment;
                }

                return $comment;
            }
        }

        new PixReviewsPlugin_Child();
    }
}

function listable_child_footer_breadcrumbs($index, $has_widgets)
{

    if (!is_admin() && $index == 'footer-widget-area') {
        if (get_the_ID() == get_option('job_manager_jobs_page_id', false)) {

            return;
        } else if (get_post()->post_type == 'job_listing' && get_query_var('content_type') == 'comments') {
            $id = get_the_ID();
            ?>
            <div style="border-bottom: 1px solid #424242;">
                <div id="footer_breadcrumbs" class="widget widget--footer widget_text">
                    <div itemscope itemtype="http://schema.org/BreadcrumbList">
							<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a href="<?php echo get_bloginfo('wpurl'); ?>" itemprop="item"><span
                                            itemprop="name"><?php echo get_bloginfo('description') ?></span></a>
								<span class="arrow right">→</span>
								<a href="<?php get_permalink($id) ?>"><?php echo get_the_title($id) ?></a>
								<span class="arrow right">→</span>
								<span><?php _e('Отзывы', 'listable-child-theme') ?></span>
								<meta itemprop="position" content="1"/>
							</span>
                    </div>
                </div>
            </div>
            <?php
        } else if (get_post()->post_type == 'job_listing') {
            $id = get_the_ID();
            ?>
            <div style="border-bottom: 1px solid #424242;">
                <div id="footer_breadcrumbs" class="widget widget--footer widget_text">
                    <div itemscope itemtype="http://schema.org/BreadcrumbList">
							<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a href="<?php echo get_bloginfo('wpurl'); ?>" itemprop="item"><span
                                            itemprop="name"><?php echo get_bloginfo('description') ?></span></a>
								<span class="arrow right">→</span>
								<span><?php echo get_the_title($id) ?></span>
								<meta itemprop="position" content="1"/>
							</span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

function listable_child_footer_breadcrumbs_data($search_taxonomy = false)
{

    if ($search_taxonomy === false) {

        if (isset($_REQUEST['search_taxonomy'])) {

            $search_taxonomy = $_REQUEST['search_taxonomy'];
        } else {

            $search_taxonomy = get_taxonomies_from_url()['found'];
        }
    }

    ob_start();

    echo '<div itemscope itemtype="http://schema.org/BreadcrumbList">';

    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    echo '<a href="' . get_bloginfo('wpurl') . '" itemprop="item"><span itemprop="name">' . get_bloginfo('description') . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '<span class="arrow right">→</span>';
    echo '</span>';

    $step = 1;
    $length = count($search_taxonomy);

    if (count($search_taxonomy) === 0) {

        echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
        echo '<span itemprop="item"><span itemprop="name">' . get_the_title(get_option('job_manager_jobs_page_id', false)) . '</span></span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</span>';
    } else {

        echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
        echo '<a href="' . get_permalink(get_option('job_manager_jobs_page_id', false)) . '" itemprop="item"><span itemprop="name">' . get_the_title(get_option('job_manager_jobs_page_id', false)) . '</span></a>';
        echo '<meta itemprop="position" content="2" />';
        echo '<span class="arrow right">→</span>';
        echo '</span>';
    }

    foreach ($search_taxonomy as $taxonomy => $term) {

        if ($step != $length) {

            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<a href="' . get_term_link($term[0], $taxonomy) . '" itemprop="item"><span itemprop="name">' . get_term_by('slug', $term[0], $taxonomy)->name . '</span></a>';
            echo '<meta itemprop="position" content="' . ($step + 2) . '" />';
            echo '<span class="arrow right">→</span>';
            echo '</span>';
        } else {

            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<span itemprop="item"><span itemprop="name">' . get_term_by('slug', $term[0], $taxonomy)->name . '</span></span>';
            echo '<meta itemprop="position" content="' . ($step + 2) . '" />';
            echo '</span>';
        }

        $step++;
    }

    echo '</div>';

    $footer_breadcrumbs_data = ob_get_clean();

    return $footer_breadcrumbs_data;
}

function listable_child_search_result_string($search_taxonomy)
{

    $geo = null;

    $custom_taxonomies = WP_Job_Manager_Add_On::$custom_taxonomies;
    $geo_taxonomies = explode(' ', get_option('geo_taxonomies_slugs', false));
    $string = array();

    foreach ($search_taxonomy as $taxonomy => $term) {

        if (in_array($taxonomy, $geo_taxonomies)) {

            $geo .= get_term_meta(get_term_by('slug', $term[0], $taxonomy)->term_id, $custom_taxonomies[$taxonomy]['taxonomy_extra_fields']['seo_before']['id'], true) . ' ';
        }

    }

    /* Taxonomy coud exists in query or not - we do not know */

    @$category_tax_meta = ' ' . get_term_meta(get_term_by('slug', $search_taxonomy['job_listing_category'][0], 'job_listing_category')->term_id, $custom_taxonomies['job_listing_category']['taxonomy_extra_fields']['seo_before']['id'], true);
    @$price_tax_meta = ' ' . get_term_meta(get_term_by('slug', $search_taxonomy['job_listing_price'][0], 'job_listing_price')->term_id, $custom_taxonomies['job_listing_price']['taxonomy_extra_fields']['seo_before']['id'], true);
    @$communitype_tax_meta = ' ' . get_term_meta(get_term_by('slug', $search_taxonomy['job_listing_communitype'][0], 'job_listing_communitype')->term_id, $custom_taxonomies['job_listing_communitype']['taxonomy_extra_fields']['seo_before']['id'], true);
    @$educatype_tax_meta = ' ' . get_term_meta(get_term_by('slug', $search_taxonomy['job_listing_educatype'][0], 'job_listing_educatype')->term_id, $custom_taxonomies['job_listing_educatype']['taxonomy_extra_fields']['seo_before']['id'], true);
    @$teach_level_tax_meta = ' ' . get_term_meta(get_term_by('slug', $search_taxonomy['job_listing_teach_level'][0], 'job_listing_teach_level')->term_id, $custom_taxonomies['job_listing_teach_level']['taxonomy_extra_fields']['seo_before']['id'], true);

    $tax_metas = $category_tax_meta . $price_tax_meta . $communitype_tax_meta . $educatype_tax_meta . $teach_level_tax_meta;

    $found = WP_Job_Manager_Add_On::$init_found['count'];

    /* GEO presents */
    if ($geo != null) {
        $string['text'] = '<div class="search_icon">' . svg_pin() . '</div>' .
            '<div id="geo_data">' .
            '<p>' . ' ' . $geo . 'города' . ' ' . get_option('job_manager_city_name_GC') . ' ' . 'мы нашли:</p>' . ' ' .
            '<span>' . sprintf(_n('%s школу', '%s школ', $found, 'listable-child-theme'), $found) . ' ' . 'английского языка' . ' ' . $tax_metas . '</span>' .
            '</div>';
    } /* No GEO */
    else {
        $string['text'] = '<div class="search_icon">' . svg_pin() . '</div>' .
            '<div id="geo_data">' .
            '<p>В городе' . ' ' . get_option('job_manager_city_name_NC') . ' ' . 'мы нашли:</p>' . ' ' .
            '<span>' . sprintf(_n('%s школу', '%s школ', $found, 'listable-child-theme'), $found) . ' ' . 'английского языка' . ' ' . $tax_metas . '</span>' .
            '</div>';
    }


    /* Online school */
    $school_id = get_page_by_path(get_option('search_result_school'), OBJECT, 'job_listing')->ID;

    $string['online'] = '<div class="search_icon">' . svg_laptop() . '</div>' .
        '<div id="text_data">' .
        '<p>Возможность обучения онлайн:</p>' .
        '<span><a href="' . get_the_permalink($school_id) . '">' . get_the_title($school_id) . '</a>' . ' ' . 'самая популярная онлайн школа</span>' .
        '</div>';

    /* Sorting text */
    if (isset ($search_taxonomy['job_listing_district'])) {

        $district_seo_after = get_term_meta(get_term_by('slug', $search_taxonomy['job_listing_district'][0], 'job_listing_district')->term_id, $custom_taxonomies['job_listing_district']['taxonomy_extra_fields']['seo_after']['id'], true) . ' ';
        $text = '<span id="search_location">' . $district_seo_after . ' ' . get_option('job_manager_city_name_GC') . '</span>';
    } else {

        $text = '<span id="search_location">' . get_option('job_manager_city_name_PC') . '</span>';
    }
    $string['sorting'] = '<p>' .
        '<span id="title">' .
        '<span id="sort_count">' . sprintf(_n('%s школу', '%s школ', $found, 'listable-child-theme'), $found) . '</span>' . ' английского языка ' . $text . ' можно отсортировать по: ' .
        '</span>' .
        '<button id="sort_rating" class="tool desc">' . _x('rating', 'Sorting tools', 'listable-child-theme') . '</button>' .
        '<span> | </span>' .
        '<button id="sort_price" class="tool">' . _x('price', 'Sorting tools', 'listable-child-theme') . '</button>' .
        '</p>';

    /* strip double and more spaces */
    if (seems_utf8($string['text'])) {
        $string['text'] = preg_replace('/[\p{Z}\s]{2,}/u', ' ', $string['text']);
    } else {
        $string['text'] = preg_replace('/\s\s+/', ' ', $string['text']);
    }

    /* strip first and last spaces */
    $string['text'] = trim($string['text']);

    $hardcoded = false;

    if ($hardcoded) {

        $price_range = 'от ' . WP_Job_Manager_Add_On::$init_found['min_price'] . ' ' . 'до ' . WP_Job_Manager_Add_On::$init_found['max_price'] . ' ' . 'рублей';
    } else {

        $price_range = '9500 рублей';
    }

    $string['price_range'] = '<div class="search_icon">' . svg_rub() . '</div>' .
        '<div id="price_data">' .
        '<p>' . 'Средняя цена в месяц на курсы английского ' . get_option('job_manager_city_name_PC', 'option_is_empty') . ': ' . '</p>' . ' ' .
        '<span>' . $price_range . '</span>' .
        '</div>';

    return $string;
}

function redefine_widget_classes()
{

    if (class_exists('Listing_Content_Widget')) {

        unregister_widget('Listing_Content_Widget');

        class Listing_Content_Widget_Child extends Listing_Content_Widget
        {

            function __construct()
            {

                parent::__construct();

            }

            public function widget($args, $instance)
            {
                global $post;
                echo $args['before_widget'];

                //first let's filter the content in any way we might find suitable
                $content = get_the_content();
                //let add-ons and so on, hook into this
                //but cripple it's behaviour similar to the_content
                remove_filter('the_job_description', 'wptexturize');
                remove_filter('the_job_description', 'convert_smilies');
                remove_filter('the_job_description', 'convert_chars');
                remove_filter('the_job_description', 'wpautop');
                remove_filter('the_job_description', 'shortcode_unautop');
                remove_filter('the_job_description', 'prepend_attachment');
                $content = apply_filters('the_job_description', $content);

                //deliver the_content blessing from the Heavens (you know... shortcodes and all)
                $content = apply_filters('the_content', $content);

                if (!empty($content)) : ?>

                    <div class="job_description">
                        <?php
                        //now show it to the world
                        echo $content;
                        ?>
                    </div>

                <?php endif;

                // if ( candidates_can_apply() ) {get_job_manager_template( 'job-application.php' ); }

                /**
                 * single_job_listing_end hook
                 */
                do_action('single_job_listing_end');

                echo $args['after_widget'];
            }
        }

        new Listing_Content_Widget_Child();
        register_widget('Listing_Content_Widget_Child');
    }

    if (class_exists('Listing_Sidebar_Map_Widget')) {

        unregister_widget('Listing_Sidebar_Map_Widget');

        class Listing_Sidebar_Map_Widget_Child extends Listing_Sidebar_Map_Widget
        {

            function __construct()
            {

                parent::__construct();

            }

            public function widget($args, $instance)
            {
                global $post;

                $address = listable_get_formatted_address();

                if (empty($address)) {
                    return;
                }

                $geolocation_lat = get_post_meta(get_the_ID(), 'geolocation_lat', true);
                $geolocation_long = get_post_meta(get_the_ID(), 'geolocation_long', true);

                $get_directions_link = '';
                if (!empty($geolocation_lat) && !empty($geolocation_long) && is_numeric($geolocation_lat) && is_numeric($geolocation_long)) {
                    $get_directions_link = '//maps.google.com/maps?daddr=' . $geolocation_lat . ',' . $geolocation_long;
                }

                if (empty($get_directions_link)) {
                    return;
                }
                echo $args['before_widget']; ?>

                <div class="listing-map-container" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                    <div id="map" class="listing-map"></div>

                    <?php if (!empty($geolocation_lat) && !empty($geolocation_long) && is_numeric($geolocation_lat) && is_numeric($geolocation_long)) : ?>

                        <meta itemprop="latitude" content="<?php echo $geolocation_lat; ?>"/>
                        <meta itemprop="longitude" content="<?php echo $geolocation_long; ?>"/>

                    <?php endif; ?>

                </div>
                <div class="listing-map-content">
                    <div class="listing-address" itemprop="address" itemscope
                         itemtype="http://schema.org/PostalAddress">
                        <?php
                        echo $address;
                        if (true == apply_filters('listable_skip_geolocation_formatted_address', false)) { ?>
                            <meta itemprop="streetAddress"
                                  content="<?php echo trim(get_post_meta($post->ID, 'geolocation_street_number', true), ''); ?> <?php echo trim(get_post_meta($post->ID, 'geolocation_street', true), ''); ?>">
                            <meta itemprop="addressLocality"
                                  content="<?php echo trim(get_post_meta($post->ID, 'geolocation_city', true), ''); ?>">
                            <meta itemprop="postalCode"
                                  content="<?php echo trim(get_post_meta($post->ID, 'geolocation_postcode', true), ''); ?>">
                            <meta itemprop="addressRegion"
                                  content="<?php echo trim(get_post_meta($post->ID, 'geolocation_state', true), ''); ?>">
                            <meta itemprop="addressCountry"
                                  content="<?php echo trim(get_post_meta($post->ID, 'geolocation_country_short', true), ''); ?>">
                        <?php } ?>
                    </div>
                    <?php if (!empty($get_directions_link)) { ?>
                        <a href="<?php echo $get_directions_link; ?>" class="listing-address-directions"
                           target="_blank"><?php esc_html_e('Get directions', 'listable'); ?></a>
                    <?php } ?>
                </div><!-- .listing-map-content -->

                <?php
                echo $args['after_widget'];
            }

        }

        new Listing_Sidebar_Map_Widget_Child();
        register_widget('Listing_Sidebar_Map_Widget_Child');
    }
}

function filter_widgets_data($instance, $widget, $args)
{

    if ($widget->id_base === 'front_page_listing_categories') {

        add_filter('get_terms', 'front_page_widget_terms', 10, 4);
    }

    return $instance;
}

function front_page_widget_terms($terms, $taxonomies, $args, $term_query)
{

    if (get_option('job_manager_widget_list', false) == '1') {

        $terms = []; /* removes 'job_listing_category' selected by Widget - comment it if needed */
    }

    /* Be shure we filters exact $terms called from Front_Page_Listing_Categories_Widget */
    if ($args['taxonomy'][0] === 'job_listing_category' &&
        count($args['taxonomy']) === 1 &&
        $args['order'] === 'DESC' &&
        $args['hide_empty'] === false &&
        $args['hierarchical'] === true &&
        $args['pad_counts'] === true) {

        /* beware of infinite loop */
        remove_filter('get_terms', 'front_page_widget_terms', 10, 4);

        $custom_taxonomies = WP_Job_Manager_Add_On::$custom_taxonomies;

        $query_args = array(
            'order' => 'DESC',
            'hide_empty' => false,
            'hierarchical' => true,
            'pad_counts' => true,
            'meta_key' => 'use_in_widget',
            'meta_value' => 'true',
        );

        foreach ($custom_taxonomies as $id => $taxonomy) {

            $new_terms = get_terms(
                $id,
                $query_args
            );
            $terms = array_merge($new_terms, $terms);
        }

        return $terms;
    } else {

        return $terms;
    }
}

function my_listable_wrap_the_listings($html)
{

    if (is_admin()) {

        return $html;
    }

    $html = preg_replace('/(class="myflex"|class="myflex no-map")/', 'class="myflex cards"', $html, -1);
    $html = preg_replace('/myflex__left/', 'myflex__top', $html, -1);
    $html = preg_replace('/myflex__right/', 'myflex__bottom', $html, -1);

    ob_start();
    echo '<div data="draft">'; /* - содержимое этого узла будет импортировано в контент */
    echo WP_Job_Manager_Add_On::$init_cat_des;

    if (WP_Job_Manager_Add_On::$output_jobs_args['feedback_to'] != false) {

        echo do_shortcode('[feedback to="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_to'] . '" ' .
            'subject="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_subject'] . '" ' .
            'title="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_title'] . '" ' .
            'subtitle="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_subtitle'] . '" ' .
            'description="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_description'] . '" ' .
            'title_alter="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_title_alter'] . '" ' .
            'subtitle_alter="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_subtitle_alter'] . '" ' .
            'description_alter="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_description_alter'] . '" ' .
            'submit="' . WP_Job_Manager_Add_On::$output_jobs_args['feedback_submit'] . '" ' .
            ']');
    }

    echo '</div>';
    $sidebar = ob_get_clean();


    libxml_use_internal_errors(true);

    $import = new DOMDocument;
    $import->preserveWhiteSpace = false;
    $import->loadHTML(mb_convert_encoding($sidebar, 'HTML-ENTITIES', 'UTF-8'));

    # remove <!DOCTYPE
    $import->removeChild($import->doctype);

    # remove <html><body></body></html>
    $import->replaceChild($import->firstChild->firstChild->firstChild, $import->firstChild);

    // Узел, который будет импортирован в новый документ
    $node_import = $import->documentElement;

    // Создание нового документа
    $job = new DOMDocument;
    $job->validateOnParse = true;
    $job->formatOutput = true;

    // Добавление разметки
    $job->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    # remove <!DOCTYPE
    $job->removeChild($job->doctype);

    # remove <html><body></body></html>
    $job->replaceChild($job->firstChild->firstChild->firstChild, $job->firstChild);

    // Импорт узла и всех его потомков в документ
    $node_import = $job->importNode($node_import, true);

    // Отбор получателя
    $xpath = new DomXPath($job);
    $ref = $xpath->query("//div/div[@id='map']");
    //$ref	= $xpath->query( "//*[contains(concat(' ', normalize-space(@class), ' '), ' myflex__top ')]" );
    $parent = $xpath->query("//div");

    //Финиш
    //$parent->item(0)->insertBefore( $node_import, $ref->item(0) );

    for ($x = 0; $x < $node_import->childNodes->length; $x++) {

        if ($node_import->childNodes->item($x)->nodeType === 1) {

            $parent->item(0)->insertBefore($node_import->childNodes->item($x), $ref->item(0));
        }
    }

    libxml_use_internal_errors(false);

    $html = html_entity_decode($job->saveHTML());


    return $html;

}

function is_category_searching($category)
{

    (isset($_REQUEST['search_taxonomy'])) ? $search_taxonomy = $_REQUEST['search_taxonomy'] : $search_taxonomy = get_taxonomies_from_url()['found'];

    if (isset($search_taxonomy[$category])) {

        return get_term_by('slug', $search_taxonomy[$category][0], $category);
    } else {
        return false;
    }
}

function downforce_raiting($rating, $reviews, $rule_string)
{

    $rating = $rating * eval('return ' . $rule_string . ';');

    return round($rating, 2);
}

/* array where
	$object_type	- post or comment,
	$object_id		- integer
	$set_rating		- force this rating value,
	$with_digits	- 'rating' or 'comments'
	$reviews_count	- comments amount (required)
*/

function listable_generate_object_rating_html($data = array(), $with_microdata = false)
{

    if (count($data) === 0) {
        return;
    }

    if ($data['object_id'] != false) {

        if ($data['object_type'] == 'post') {

            $rating = get_post_meta($data['object_id'], '_pixreviwes_average', true);
        }

        if ($data['object_type'] == 'comment') {

            $rating = get_comment_meta($data['object_id'], 'pixrating', true);
        }
    } else if ($data['set_rating'] != false) {
        $rating = $data['set_rating'];
    } else {
        return;
    }

    $rule = get_site_option('global_settings_preset', false);

    if ($rule && $data['reviews_count'] !== false) {

        if (!empty($rule['rating_downforce_rule'])) {

            /* $rating = downforce_raiting( $rating, $data['reviews_count'], preg_replace("/reviews/", "intval(\$reviews)", $rule['rating_downforce_rule'], -1)); */
        }
    }

    if ($data['with_digits'] === 'rating') {

        $reviews_count = false;
    } else if ($data['with_digits'] === 'comments' && $data['reviews_count']) {

        $reviews_count = $data['reviews_count'];
    } else {
        $reviews_count = false;
    }

    $html = listable_generate_rating_html($rating, $reviews_count, $with_microdata);

    return $html;
}

function listable_generate_rating_html($rating, $reviews_count, $with_microdata = true)
{

    ob_start();

    if (floatval($rating) < 0.01) {
        $rating = 'еще не сформирован';
        $review_class = ' review_rate_1 ';
    } else {
        $review_class = ' review_rate ';
    }
    ?>
    <div id="redesign" class="single-rating <?= $review_class; ?> display-only"
         data-pixrating="<?php echo $rating ?>" <?php echo ($with_microdata) ? 'itemscope itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating"' : '' ?>>
			<span class="rating-value">
				<span><?php echo $rating ?></span>
			</span>
        <?php
        if ($with_microdata) {
            ?>
            <meta itemprop="ratingValue" content="<?php echo $rating ?>"><?php
            ?>
            <meta itemprop="reviewCount" content="<?php echo $reviews_count ?>"><?php
            ?>
            <meta itemprop="worstRating" content=1><?php
            ?>
            <meta itemprop="bestRating" content=5><?php
        } ?>

    </div>
    <?php

    return ob_get_clean();
}

function parse_nominants($content)
{

    global $post;

    if ($content == '[city_is]' || $content == '%city_is%') {
        return get_option('job_manager_city_name_NC', 'option_is_empty');
    }
    if ($content == '[city_of]' || $content == '%city_of%') {
        return get_option('job_manager_city_name_GC', 'option_is_empty');
    }
    if ($content == '[city_in]' || $content == '%city_in%') {
        return get_option('job_manager_city_name_PC', 'option_is_empty');
    }
    if ($content == '[month_in]' || $content == '%month_in%') {

        $month = current_time('n', 0);
        switch ($month) {
            case 1:
                $month = 'Январе';
                break;
            case 2:
                $month = 'Феврале';
                break;
            case 3:
                $month = 'Марте';
                break;
            case 4:
                $month = 'Апреле';
                break;
            case 5:
                $month = 'Мае';
                break;
            case 6:
                $month = 'Июне';
                break;
            case 7:
                $month = 'Июле';
                break;
            case 8:
                $month = 'Августе';
                break;
            case 9:
                $month = 'Сентябре';
                break;
            case 10:
                $month = 'Октябре';
                break;
            case 11:
                $month = 'Ноябре';
                break;
            case 12:
                $month = 'Декабре';
                break;
        }
        return $month;
    }
    if ($content == '[year]' || $content == '%year%') {
        return current_time('Y', 0);
    }
    if ($content == '[city_comments_count_v1]' || $content == '%city_comments_count_v1%') {
        $count = wp_count_comments()->approved;
        return sprintf(_nx('%1$s отзывов', '%1$s отзыва', $count, 'comments title', 'listable-child-theme'), $count);
        /* return wp_count_comments()->approved; */
    }
    if ($content == '[schoolname]' || $content == '%schoolname%') {
        return $post->post_title;
    }
    if ($content == '[translit]' || $content == '%translit%') {

        (get_post_meta($post->ID, '_translit', true) != '') ? $return = '(' . get_post_meta($post->ID, '_translit', true) . ')' : $return = '';
        return $return;
    }

    /* if nothing found - return $content as is */
    return $content;
}

function createGUID()
{

    // Create a token
    $token = $_SERVER['HTTP_HOST'];
    $token .= $_SERVER['REQUEST_URI'];
    $token .= uniqid(rand(), true);

    // GUID is 128-bit hex
    $hash = strtoupper(md5($token));

    // Create formatted GUID
    $guid = '';

    // GUID format is XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX for readability
    $guid .= substr($hash, 0, 8) .
        '-' .
        substr($hash, 8, 4) .
        '-' .
        substr($hash, 12, 4) .
        '-' .
        substr($hash, 16, 4) .
        '-' .
        substr($hash, 20, 12);

    return $guid;

}

function oferta_warning($variation = false)
{

    $oferta_page = get_option('job_manager_oferta_page', false);

    if (!empty ($oferta_page)) {

        $link = '<a style="color: red !important;" target="_blank" href="https://msk.englishchoice.ru/public-oferta/" >' . __('правила работы сервиса', 'listable-child-theme') . '</a>'; //Соглашения     ' . get_permalink($oferta_page) . '

        if ($variation == 'comment_form') {

            ob_start();

            ?>
            <div style="text-align: center; color: #7d7d7d; margin: 10px 0 10px 0; font-size: 13px; text-shadow: 0 1px white;"><?php echo sprintf(__('Оставляя комментарий, Вы принимаете %s', 'listable-child-theme'), $link); ?></div><?php
            return ob_get_clean();
        } else {
            $link = 'Отправляя заявку, вы принимаете<br/> ' . $link;
            ob_start();
            ?>
            <div style="text-align: center; color: #7d7d7d; margin: 10px 0 10px 0; font-size: 13px; text-shadow: 0 1px white;"><?php echo sprintf(__('%s', 'listable-child-theme'), $link); ?></div><?php //Нажимая, Вы принимаете условия %s
            return ob_get_clean();
        }
    }
}

function string_excerpt($string, $length)
{

    $excerpt = strip_tags(str_replace(array("\n", "\r"), ' ', $string));
    $words = explode(' ', $excerpt);

    $use_ellipsis = count($words) > $length;

    if ($use_ellipsis) {
        $words = array_slice($words, 0, $length);
    }

    $excerpt = trim(join(' ', $words));
    if ($use_ellipsis) {
        $excerpt .= '&hellip;';

        return $excerpt;
    } else {
        return $string;
    }
}

function listable_child_is_user_role($role, $user_id = null)
{
    $user = is_numeric($user_id) ? get_userdata($user_id) : wp_get_current_user();

    if (!$user)
        return false;

    return in_array($role, (array)$user->roles);
}

function no_cache_sitemap($headers) {
	
    if (strpos($_SERVER['REQUEST_URI'], 'sitemap.xml') !== false) {
	   $headers['Cache-Control'] = 'No-Store';
    }
    return $headers;
}