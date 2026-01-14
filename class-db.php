<?php
class JAM_DB {

    public function __construct() {
        register_activation_hook(dirname(__DIR__).'/job-application-manager.php', [$this,'create_tables']);
    }

    public function create_tables() {
        global $wpdb;
        $table = $wpdb->prefix . 'job_applications';
        $charset = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            email VARCHAR(100),
            resume VARCHAR(255),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) $charset;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}
