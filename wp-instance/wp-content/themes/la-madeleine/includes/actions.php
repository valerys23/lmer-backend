<?
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function la_madele_theme_setup() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
    }

    add_action( 'after_setup_theme', 'la_madele_theme_setup' );

    /**
     * Sets up the wordpress admin panel.
     *
     * Note that this function is hooked into the admin_menu hook, which
     * runs before the admin panel is shown.
     */
    function la_madele_admin_menu_setup() {
        // remove_menu_page('edit.php'); // removes the posts menu
        // remove_menu_page('edit.php?post_type=page'); // removes the posts menu
        remove_menu_page('edit-comments.php'); // removes the comments menu
        remove_menu_page('themes.php'); // removes the appearance menu
    }

    add_action('admin_menu', 'la_madele_admin_menu_setup');


    function la_madeleexport_acf_single_field($object) {
        return get_fields($object['id']);
    }

    function la_madele_export_acf_fields() {
        $exclude = ['acf-field-group', 'acf-field'];
        $include = ['post', 'page', 'event'];
        $post_types = array_diff(get_post_types(["_builtin" => false], "names"), $exclude);

        array_push($post_types, $include);

        foreach ($post_types as $post_type) {
            register_rest_field($post_type, 'acf', [
                'get_callback' => 'la_madele_export_acf_single_field',
                'schema' => null,
            ]);
        }
    }
    add_action( 'rest_api_init', 'la_madele_export_acf_fields' );

    /**
     * Customise the admin menu
     */
    function la_madele_customise_admin() {
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/la-madeleine-admin.css' );
    }
    add_action( 'admin_menu', 'la_madele_customise_admin' );

    /**
     * Customise the login screen
     */
    function la_madele_login_logo() { ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/logo.png);
    		height: 110px;
            width: 220px;
            background-size: 220px;
            background-repeat: no-repeat;
            padding-bottom: 0px;
            }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'la_madele_login_logo' );

    function vist_custom_login_headurl() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'vist_custom_login_headurl' );

    function vist_custom_login_title() {
        return 'VIRT';
    }
    add_filter( 'login_headertitle', 'vist_custom_login_title' );

    /**
     * Removes silly and useless emoji scripts
     */
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    /**
     * Removes meta generator tag
     */
    remove_action( 'wp_head', 'wp_generator' );

    /**
     * Disables RSS feed
     */
    function la_madele_disable_rss_feed() {
      wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
    }

    add_action('do_feed', 'la_madele_disable_rss_feed', 1);
    add_action('do_feed_rdf', 'la_madele_disable_rss_feed', 1);
    add_action('do_feed_rss', 'la_madele_disable_rss_feed', 1);
    add_action('do_feed_rss2', 'la_madele_disable_rss_feed', 1);
    add_action('do_feed_atom', 'la_madele_disable_rss_feed', 1);
    add_action('do_feed_rss2_comments', 'la_madele_disable_rss_feed', 1);
    add_action('do_feed_atom_comments', 'la_madele_disable_rss_feed', 1);
