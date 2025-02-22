<?php
/**
 * Register metaboxes
 * @package DS
 */

namespace DS_THEME\Inc;

use DS_THEME\Inc\Traits\Singleton;

class Meta_Boxes
{
    use Singleton;
    protected function __construct()
    {
        //load class
        $this->setup_hooks();
    }
    protected function setup_hooks()
    {
        //actions and filters
        /**
         * Actions
         */
        add_action("add_meta_boxes", [$this, 'add_custom_meta_box']);
        add_action("save_post",[$this,"save_post_meta_data"]);

    }
    public function add_custom_meta_box()
    {
        $screens = ['post'];
        foreach ($screens as $screen) {
            add_meta_box(
                'hide-page-title', // Unique ID
                __('Hide Page Title', 'DS'), // Box title
                [$this, 'custom_meta_box_html'], // Content callback, must be of type callable
                $screen, // Post type
                'side'
            );
        }
    }
    public function custom_meta_box_html($post)
    {
        $value = get_post_meta($post->ID, '_hide_page_title', true);
        /**
         * Use nonce for verification
         */
        wp_nonce_field(plugin_basename(__FILE__),'_hide_title_metabox_nonce_name');
        ?>
        <label for="ds-field"><?php esc_html_e('Hide the page title', 'ds'); ?></label>
        <select name="ds_hide_title_field" id="ds-field" class="postbox">
            <option value=""><?php esc_html_e('Select', 'ds'); ?></option>
            <option value="yes" <?php selected($value, 'yes'); ?>><?php esc_html_e('yes', 'ds'); ?></option>
            <option value="no" <?php selected($value, 'no'); ?>><?php esc_html_e('no', 'ds'); ?></option>
        </select>
        <?php
    }
    public function save_post_meta_data($post_id){
        /**
         * when the post is saved or updated we get $_POST available
         * Check if the current user is authorized
         */
        if(!current_user_can('edit_post',$post_id)){
            return;
        }
        /**
         * Check the nonce value we received is the same we created
         */
        if(!isset($_POST['_hide_title_metabox_nonce_name']) || ! wp_verify_nonce($_POST['_hide_title_metabox_nonce_name'],plugin_basename(__FILE__))){
            return;
        }
        if ( array_key_exists( 'DS_hide_title_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_hide_page_title',
                $_POST['DS_hide_title_field']
            );
        }
    }
}