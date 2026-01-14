<?php
class JAM_Admin {

    public function __construct() {
        add_action('admin_menu', [$this,'menu']);
    }

    public function menu() {
        add_menu_page('Applications','Applications','manage_options','jam-apps',[$this,'page']);
    }

    public function page() {
        global $wpdb;
        $table = $wpdb->prefix . 'job_applications';
        $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC");
        ?>
        <div class="wrap">
        <h2>Job Applications</h2>
        <table class="widefat">
            <tr><th>Name</th><th>Email</th><th>Resume</th></tr>
            <?php foreach($rows as $r): ?>
            <tr>
                <td><?php echo esc_html($r->name); ?></td>
                <td><?php echo esc_html($r->email); ?></td>
                <td><a target="_blank" href="<?php echo esc_url($r->resume); ?>">View</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </div>
        <?php
    }
}
