<?php

/**
 * ACF Optimise
 */
function acf_json_loc($path) {
    $path = get_stylesheet_directory() . '/acf_db/files';
    return $path;
}
add_filter('acf/settings/save_json', 'acf_json_loc');

function acf_json_load($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf_db/files';
    return $paths;
}
add_filter('acf/settings/load_json', 'acf_json_load');


/**
 * Cache posts & media
 */
function get_acf_ids(&$ids, $field_id, $repeater_id = false, $depends = false) {
    if ($repeater_id === false) {
        //If not inside a repeater
        $ids[] = (int) get_field($field_id);
    } else {
        while (have_rows($repeater_id)) : the_row();
            if ($depends === false)
                $ids[] = (int) get_sub_field($field_id);
            else
                $ids[] = (int) get_sub_field($field_id . "_" . get_sub_field($depends));
        endwhile;
    }

    return $ids;
}

function get_acf_cache($post_ids) {
    if (count($post_ids))
        $posts = get_posts(array('post_type' => 'any', 'numberposts' => -1, 'post__in' => $post_ids));
}


/**
 * Disable Emoji
 */
function disable_emojicons_tinymce($plugins) {
    if (is_array($plugins))
        return array_diff($plugins, array('wpemoji'));
    else
        return array();
}

function disable_wp_emojicons() {
    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');

// Post Name Change

function change_post_menu_label() {
    global $menu, $submenu;

    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'All News';
    $submenu['edit.php'][10][0] = 'New News';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

function change_post_object_label() {
    global $wp_post_types;

    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'New News';
    $labels->add_new_item = 'New News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'New News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'Not found';
    $labels->not_found_in_trash = 'Not found in trash';
}
add_action( 'init', 'change_post_object_label' );

add_filter('register_post_type_args',function ($args, $post_type) {
        if ($post_type !== 'post') {
            return $args;
        }
        $args['rewrite'] = [
            'slug' => 'news',
            'with_front' => true,
        ];

        return $args;
},10,2);

add_filter('pre_post_link',function ($permalink, $post) {
        if ($post->post_type !== 'post') {
            return $permalink;
        }
        return '/news/%postname%/';
},10,2);

// Add Type in Testimonials Post Name
add_filter('acf/fields/post_object/result', function ( $text, $post, $field, $post_id ) {
    if($post->post_type == "testimonials"){
        $type = get_post_meta($post->ID,'testimonials_type',true);
        $categoryName = "";
        global $wpdb;
        $result = $wpdb->get_results( "SELECT term_taxonomy_id from " . $wpdb->prefix . "term_relationships WHERE object_id = '" . $post->ID . "' " );
        foreach ( $result as $c ) {
            $result = $wpdb->get_results( "SELECT name from " . $wpdb->prefix . "terms WHERE term_id = '" . $c->term_taxonomy_id . "' " );
            foreach($result as $name){
                $categoryName .= $name->name.", ";
            }
        }
        $type = "Type : ".ucfirst($type);
        $category = ($categoryName) ? ", Category : ".ucfirst($categoryName) : "";
        $text .= ' ('.$type." ".$category.')';
        return $text;
    }else{
        return $text;
    }
} , 10, 4);


//Content-Hub URL Params Rule
add_action('init', function() {

    $pagenameList = array('resources/webinars','resources/research-analysis-insight'); // Page List

    foreach($pagenameList as $pagename){
        //Rule for 6 Params (taxonomytype,taxonomyname,orderby,orderbyvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,orderby,orderbyvalue)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
            'top' );
        //Rule for 2 Params (taxonomytype,taxonomyname)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]',
            'top' );
        //Rule for 4 Params (orderby,orderbyvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
            'top' );
        //Rule for 2 Params (orderby,orderbyvalue)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/?$',
            'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]',
            'top' );
        //Rule for 2 Params (urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&urlpage=$matches[1]&urlpagenumber=$matches[2]',
            'top' );
        //Rule for 4 Params (searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
            'top' );
        //Rule for 2 Params (searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(search)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]',
            'top' );
        //Rule for 6 Params (orderby,orderbyvalue,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (orderby,orderbyvalue,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(search)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,orderby,orderbyvalue,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,orderby,orderbyvalue,searchkey,searchvalue)
        add_rewrite_rule(
           $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/?$',
           'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
           'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(search)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
            'top' );
        //Rule for 10 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/?$',
            'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
            'top' );

        add_rewrite_rule('^custom-archive/([^/]+)/?', 'index.php?custom_category=$matches[1]', 'top');
    }

});

//Content-Hub Archive URL Params Rule
add_action('init', function() {

    $pagenameList = array('content-hub'); // Page List

    foreach($pagenameList as $pagename){
        //Rule for 6 Params (taxonomytype,taxonomyname,orderby,orderbyvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,orderby,orderbyvalue)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
            'top' );
        //Rule for 2 Params (taxonomytype,taxonomyname)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]',
            'top' );
        //Rule for 4 Params (orderby,orderbyvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&orderby=$matches[1]&orderbyvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
            'top' );
        //Rule for 2 Params (orderby,orderbyvalue)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/?$',
            'index.php?post_type=content_hub&orderby=$matches[1]&orderbyvalue=$matches[2]',
            'top' );
        //Rule for 2 Params (urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&urlpage=$matches[1]&urlpagenumber=$matches[2]',
            'top' );
        //Rule for 4 Params (searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&searchkey=$matches[1]&searchvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
            'top' );
        //Rule for 2 Params (searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(search)/([^/]*)/?$',
            'index.php?post_type=content_hub&searchkey=$matches[1]&searchvalue=$matches[2]',
            'top' );
        //Rule for 6 Params (orderby,orderbyvalue,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (orderby,orderbyvalue,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/?$',
            'index.php?post_type=content_hub&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(search)/([^/]*)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,orderby,orderbyvalue,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,orderby,orderbyvalue,searchkey,searchvalue)
        add_rewrite_rule(
           $pagename.'/(type|topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/?$',
           'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
           'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
            'top' );
        //Rule for 4 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
            'top' );
        //Rule for 6 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(search)/([^/]*)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
            'top' );
        //Rule for 10 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue,searchkey,searchvalue,urlpage,urlpagenumber)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/(page)/([0-9]+)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
            'top' );
        //Rule for 8 Params (taxonomytype,taxonomyname,taxonomytopic,taxonomytopicname,orderby,orderbyvalue,searchkey,searchvalue)
        add_rewrite_rule(
            $pagename.'/(type)/([^/]*)/(topic)/([^/]*)/(orderby)/(asc|desc|alphabetical)/(search)/([^/]*)/?$',
            'index.php?post_type=content_hub&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomytopic=$matches[3]&taxonomytopicname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
            'top' );
    }
});

function custom_query_vars($vars) {
    $vars[] = 'custom_param1';
    $vars[] = 'custom_param2';
    return $vars;
}
add_filter('query_vars', 'custom_query_vars', 10, 1);


add_filter('query_vars', function( $vars ){
    $vars[] = 'taxonomytype';
    $vars[] = 'taxonomyname';
    $vars[] = 'urlpage';
    $vars[] = 'urlpagenumber';
    $vars[] = 'orderby';
    $vars[] = 'orderbyvalue';
    $vars[] = 'searchkey';
    $vars[] = 'searchvalue';
    $vars[] = 'taxonomytopic';
    $vars[] = 'taxonomytopicname';
    return $vars;
});

// Content-Hub Custom Yoast Head Tag
function modify_yoast_seo_links($canonical, $canonicalLink,$headerContentHubListQuery) {
    $canonical = $canonicalLink;
    $prevUrl = get_previous_posts_page_link( $headerContentHubListQuery->max_num_pages );
    $nextUrl = get_next_posts_page_link( $headerContentHubListQuery->max_num_pages );
    if(get_query_var('orderbyvalue')){
        if($nextUrl){
            $nextUrl = preg_replace('/\/orderby\/[^\/]+/', '', $nextUrl);
        }
        if($prevUrl){
            $prevUrl = preg_replace('/\/orderby\/[^\/]+/', '', $prevUrl);
        }
    }
    if(get_query_var('searchvalue')){
        if($nextUrl){
            $nextUrl = preg_replace('/\/search\/[^\/]+/', '', $nextUrl);
        }
        if($prevUrl){
            $prevUrl = preg_replace('/\/search\/[^\/]+/', '', $prevUrl);
        }
    }
    if(get_query_var('taxonomyname') && get_query_var('taxonomytopicname')){
        if($nextUrl){
            $nextUrl = preg_replace('/\/type\/[^\/]+/', '', $nextUrl);
            $nextUrl = preg_replace('/\/topic\/[^\/]+/', '', $nextUrl);
        }
        if($prevUrl){
            $prevUrl = preg_replace('/\/type\/[^\/]+/', '', $prevUrl);
            $prevUrl = preg_replace('/\/topic\/[^\/]+/', '', $prevUrl);
        }
    }
    if (strpos($nextUrl, "page/2") !== false){
        $prevUrl = "";
    }else{
        $prevUrl = $prevUrl;
    }
    if ( $prevUrl ) {
        echo '<link rel="prev" href="' . esc_url( $prevUrl ) . '"  class="yoast-seo-meta-tag"  />' . "\n";
    }
    if ( $nextUrl ) {
        echo '<link rel="next" href="' . esc_url( $nextUrl ) . '"  class="yoast-seo-meta-tag" />' . "\n";
    }
    add_filter('wpseo_next_rel_link', 'remove_next_tags_yoast_seo');
    add_filter('wpseo_prev_rel_link', 'remove_prev_tags_yoast_seo');
    echo '<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https://schema.org","@graph":[{"@type":"CollectionPage","@id":"'.$canonicalLink.'/","url":"'.$canonicalLink.'/","name":"Report2 - Turtl","isPartOf":{"@id":"'.$canonicalLink.'/#website"},"breadcrumb":{"@id":"'.$canonicalLink.'/#breadcrumb"},"inLanguage":"en-US"},{"@type":"BreadcrumbList","@id":"'.$canonicalLink.'/#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"'.$canonicalLink.'/"},{"@type":"ListItem","position":2,"name":"Report2"}]},{"@type":"WebSite","@id":"'.$canonicalLink.'/#website","url":"'.$canonicalLink.'/","name":"Turtl","description":"Create beautiful digital documents","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"'.$canonicalLink.'/?s={search_term_string}"},"query-input":"required name=search_term_string"}],"inLanguage":"en-US"}]}</script>'."\n";
    return $canonical."/";
}
function modify_yoast_opengraph_url( $url,$canonicalLink ) {
    $url = $canonicalLink;
    return $url."/";
}
function remove_next_tags_yoast_seo($link) {
    return false;
}
function remove_prev_tags_yoast_seo($link) {
    return false;
}