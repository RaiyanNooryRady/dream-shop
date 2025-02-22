<?php
/**
 * Theme Functions
 * @package DS
 */
if (!defined("DS_DIR_PATH")) {
    define("DS_DIR_PATH", untrailingslashit(get_template_directory()));
}
if(!defined("DS_DIR_URI")){
    define("DS_DIR_URI", untrailingslashit(get_template_directory_uri()));
}
//print_r(DS_DIR_PATH);
require_once DS_DIR_PATH . '/inc/helpers/autoloader.php';
//add wp_bootstrap_navwalker.php file
require_once 'wp_bootstrap_navwalker.php';

function ds_get_theme_instance()
{
    \DS_THEME\Inc\DS_THEME::get_instance();
}
ds_get_theme_instance();