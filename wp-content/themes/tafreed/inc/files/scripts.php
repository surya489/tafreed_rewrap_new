<?php

/**
 * Enqueue scripts and styles.
 */
function load_css_js() {
    // CSS
    $cssFiles = [
        'fonts.css', 'common.css', 'font-awesome.css', 'swiper.css', 'stylesheet.css','style.css', 'responsive.css', 'resonsivestyle.css','magnific-popup.css'
    ];

    foreach ($cssFiles as $key => $cssFile){
        $id  = preg_replace('/\.css+/', '',$cssFile);
        wp_enqueue_style('custom-css-' . $id, get_template_directory_uri() . '/assets/css/' . $cssFile, false, filemtime(get_stylesheet_directory() . '/assets/css/' . $cssFile));
    }

    //JS 
    $jsFiles = [
        'libs/isinviewport.js', 'libs/jquery.ajaxq.js', 'libs/isotope.js', 'utils/utils.js',
        'utils/scrollbar.js', 'utils/jquery.extend.js', 'libs/swiper.min.js', 'utils/browser.js', 'utils/video.js', 'libs/jquery.matchHeight.js', 'libs/jquery.magnific-popup.min.js', 'libs/ResizeSensor.js', 'libs/sticky-sidebar.js','script.js','sidebar.js', 'utils/filter.js', 'utils/integratefilter.js', 'utils/imagegallery.js', 'utils/newsfilter.js', 'libs/waypoints.min.js'
    ];

    //Enqueue custom jquery file
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery.min.js', false, filemtime(get_stylesheet_directory() . '/assets/js/libs/jquery.min.js'), false);

    //Enqueue other files
    foreach ($jsFiles as $key => $jsFile){
        $id  = preg_replace('/\.js+/', '',$jsFile);
        $id  = preg_replace('/utils\//', '',$id);
        $id  = preg_replace('/libs\//', '',$id);
        wp_enqueue_script('custom-js-' . $id, get_template_directory_uri() . '/assets/js/' . $jsFile, false, filemtime(get_stylesheet_directory() . '/assets/js/' . $jsFile), false);
    }
}

add_action('wp_enqueue_scripts', 'load_css_js');

function add_defer_attribute($tag, $handle) {
    // List the handles of the scripts you want to defer
    $defer_scripts = array('custom-js-filter','custom-js-communityShowcaseFilter','custom-js-integratefilter','custom-js-templatesfilter','custom-js-imagegallery','custom-js-newsfilter');

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer="defer" src', $tag);
    }

    return $tag;
}

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

