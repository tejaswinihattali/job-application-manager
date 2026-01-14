<?php
class JAM_Public {

    public function __construct() {
        add_shortcode('job_apply_form', [$this,'render_form']);
        add_action('admin_post_jam_submit', [$this,'save_form']);
        add_action('admin_post_nopriv_jam_submit', [$this,'save_form']);
    }

    public function render_form() {
        ob_start(); ?>
        <form method="post" enctype="multipart/form-data" action="<?php echo admin_url('admin-post.php'); ?>">
            <p><input type="text" name="name" placeholder="Name" required></p>
            <p><input type="email" name="email" placeholder="Email" required></p>
            <p><input type="file" name="resume" required></p>

            <input type="hidden" name="action" value="jam_submit">
            <?php wp_nonce_field('jam_form','jam_nonce'); ?>

            <button type="submit">Apply</button>
        </form>
        <?php return ob_get_clean();
    }

    public function save_form() {
        if (!isset($_POST['jam_nonce']) || !wp_verify_nonce($_POST['jam_nonce'],'jam_form')) {
            wp_die('Security check failed');
        }

        global $wpdb;
        $table = $wpdb->prefix . 'job_applications';

        $name  = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);

        $upload = wp_handle_upload($_FILES['resume'], ['test_form'=>false]);

        $wpdb->insert($table, [
            'name'=>$name,
            'email'=>$email,
            'resume'=>$upload['url']
        ]);

        wp_redirect(home_url());
        exit;
    }
}
