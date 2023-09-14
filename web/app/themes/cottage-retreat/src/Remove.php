<?php

namespace CottageRetreat;

class Remove {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'remove_wp_block_library_css'] );
        add_action( 'wp_enqueue_scripts', [$this, 'remove_default_wp_css'], 100 );
        add_action( 'wp_enqueue_scripts', [$this, 'remove_dashicon'] );
        add_action( 'init', [$this, 'remove_emojis'] );
        add_action( 'admin_menu', [$this, 'remove_comments_from_admin'] );

        remove_action('wp_head', 'wp_generator');
        remove_action ('wp_head', 'rsd_link');
        remove_action( 'wp_head', 'wp_shortlink_wp_head');
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action('wp_head', 'feed_links_extra', 3 );
        add_filter('xmlrpc_enabled', '__return_false');
    }

    /**
     * Remove Gutenberg Block Library CSS from loading on the frontend
    */
    public function remove_wp_block_library_css()
    {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
    }

    /**
     * Remove WP Default Head CSS
    */

    public function remove_default_wp_css()
    {
        wp_dequeue_style( 'classic-theme-styles' );
        wp_dequeue_style( 'global-styles' );
    }


    /**
     * Remove Dashicons
     */
     public function remove_dashicon() 
     {
         if (!is_user_logged_in()) {
             wp_deregister_style('dashicons');
         }
     }

     /**
     * Remove Emojis
     */
    public function remove_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    }

    /**
     * Remove Comments from Admin
    */
    public function remove_comments_from_admin()
    {
		remove_menu_page( 'edit-comments.php' );
	}
}