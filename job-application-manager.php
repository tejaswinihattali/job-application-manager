<?php
/**
 * Plugin Name: Job Application Manager
 * Description: Simple job application system.
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

define('JAM_PATH', plugin_dir_path(__FILE__));

require_once JAM_PATH . 'includes/class-db.php';
require_once JAM_PATH . 'includes/class-admin.php';
require_once JAM_PATH . 'includes/class-public.php';

add_action('plugins_loaded', function(){
    new JAM_DB();
    new JAM_Admin();
    new JAM_Public();
});
