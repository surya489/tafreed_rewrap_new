<?php

// //Include all required files
require get_template_directory() . '/inc/index.php';

function categoriesListSelect($fields) {

    $post_id = get_the_ID(); 

    $post_types = array(
        'customer_stories' => 'categories_select_list',
        'community_showcase' => 'categories_select_list', 
        'content_hub' => 'categories_select_list', 
        'templates' => 'categories_select_list', 
    );

    $current_post_type = get_post_type($post_id);
    if (empty($post_id) || !isset($post_types[$current_post_type])) {
        return $fields;
    }

    $acf_field_name = $post_types[$current_post_type];

    $taxonomies = get_object_taxonomies($current_post_type);
    foreach ($taxonomies as $taxonomy) {
        $terms = get_the_terms($post_id, $taxonomy);
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $taxonomies_array[]            = $term->name;
                $fields['choices'][$term->term_id] = $term->name; 
            }
        }
    }

    $fields['type'] = 'checkbox'; 
    $fields['multiple'] = 1;

    return $fields;
}

add_filter('acf/load_field/name=categories_select_list', 'categoriesListSelect');

// Override The Inbuilt Video Shortcode FUnction To Add STyle, To Align The Video 
add_shortcode('video', function ($atts, $content) {

    $style_rules = array();

    if (!empty($atts['width'])) {
        $style_rules[] = sprintf('width: %dpx;', $atts['width']);
    }

    if (!empty($atts['align'])) {
        if ($atts['align'] === 'center') {
            $style_rules[] = 'margin: auto;';
        } else if ($atts['align'] === 'left') {
            $style_rules[] = 'margin-right: auto;';
        } else if ($atts['align'] === 'right') {
            $style_rules[] = 'margin-left: auto;';
        }
    }

    $style_attribute = implode(' ', $style_rules);
    $newoutput = wp_video_shortcode($atts, $content, $html);
    $output = sprintf('<div style="%s" class="wp-video">%s</div>', $style_attribute, $newoutput);
    return $output;
});