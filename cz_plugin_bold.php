<?php

/*
Plugin Name: Bold
Description: A brief description of the Plugin.
Version: 1.0.0
Author: Igor Finagin <Igor@Finag.in>
Author URI: https://finag.in
License: MIT
*/

add_action('post_submitbox_misc_actions', 'cz_plugin_bold_show');
function cz_plugin_bold_show()
{
    global $post;
    $value = boolval(get_post_meta($post->ID, 'cz_plugin_bold', true));
    wp_enqueue_script('attrchange', '//cdn.rawgit.com/meetselva/attrchange/master/js/attrchange.js', array('jquery'), '66f6910');
    wp_enqueue_script('cz_plugin_bold', plugins_url('/js/cz_plugin_bold.js', __FILE__), array('attrchange'), time());
    ?>
    <div id="CZPluginBoldFallback">
        <script type="text/javascript">
            <!--
            jQuery(function ($) {
                var inderval = setInterval(function () {
                    var cz_plugin_bold = $("#cz-plugin-bold");

                    if (cz_plugin_bold.length) {
                        cz_plugin_bold<?php if ($value) echo '.attr("checked", "checked")'; ?>;
                        clearInterval(inderval);
                    }
                }, 0);
            });
            //-->
        </script>
        <style>
            #cz-plugin-bold-span {
                margin-left: 18px;
            }
        </style>
    </div>
    <?php
}


add_action('save_post', 'cz_plugin_bold_save', 10, 2);
function cz_plugin_bold_save($postID, $post)
{
    if (
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        $post->post_type != 'post' ||
        !current_user_can('edit_post', $postID) ||
        wp_is_post_revision($postID)
    ) {
        return false;
    }

    update_post_meta($postID, 'cz_plugin_bold', isset($_POST['cz-plugin-bold']) ? 1 : 0);
}
