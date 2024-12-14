<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Intercom Settings',
        'menu_slug' => 'intercom_settings',
        'icon_url' => 'dashicons-feedback',
        'capability' => 'publish_pages',
        'position' => '100',
        'redirect' => true
    ));
}