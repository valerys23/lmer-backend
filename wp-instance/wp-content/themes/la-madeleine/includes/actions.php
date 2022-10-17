<?
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function madeleine_theme_setup() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
    }

    add_action( 'after_setup_theme', 'madeleine_theme_setup' );

    /**
     * Sets up the wordpress admin panel.
     *
     * Note that this function is hooked into the admin_menu hook, which
     * runs before the admin panel is shown.
     */
    function madeleine_admin_menu_setup() {
        // remove_menu_page('edit.php'); // removes the posts menu
        remove_menu_page('edit.php?post_type=page'); // removes the pages menu
        remove_menu_page('edit-comments.php'); // removes the comments menu
        remove_menu_page('themes.php'); // removes the appearance menu
    }

    add_action('admin_menu', 'madeleine_admin_menu_setup');

    /**
     * Setup the image sizes
     */
    function madeleine_add_image_sizes() {
        remove_image_size( 'thumbnail' );
        remove_image_size( 'medium' );
        remove_image_size( 'medium_large' );
        remove_image_size( 'large' );
        remove_image_size( 'full' );
        remove_image_size( '1536x1536' );
        remove_image_size( '2048x2048' );

        add_image_size( 'madeleine-tiny', 167, 250 );
        add_image_size( 'madeleine-xs', 200, 300  );
        add_image_size( 'madeleine-s', 320, 480 );
        add_image_size( 'madeleine-m', 512, 768 ); 
        add_image_size( 'madeleine-lg', 600, 900 ); 
        add_image_size( 'madeleine-xl', 683, 1024 );
        add_image_size( 'madeleine-xxl', 700, 1050 ); 
    }

    add_action( 'after_setup_theme', 'madeleine_add_image_sizes' );

    function la_madeleexport_acf_single_field($object) {
        return get_fields($object['id']);
    }

    function madeleine_export_acf_fields() {
        $exclude = ['acf-field-group', 'acf-field'];
        $include = ['post', 'page', 'event'];
        $post_types = array_diff(get_post_types(["_builtin" => false], "names"), $exclude);

        array_push($post_types, $include);

        foreach ($post_types as $post_type) {
            register_rest_field($post_type, 'acf', [
                'get_callback' => 'madeleine_export_acf_single_field',
                'schema' => null,
            ]);
        }
    }
    add_action( 'rest_api_init', 'madeleine_export_acf_fields' );

    /**
     * Customise the admin menu
     */
    function madeleine_customise_admin() {
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/la-madeleine-admin.css' );
    }
    add_action( 'admin_menu', 'madeleine_customise_admin' );

    /**
     * Customise the login screen
     */
    function madeleine_login_logo() { ?>
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
    add_action( 'login_enqueue_scripts', 'madeleine_login_logo' );

    function madeleine_custom_login_headurl() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'madeleine_custom_login_headurl' );

    function madeleine_custom_login_title() {
        return 'La madeleine en route';
    }
    add_filter( 'login_headertitle', 'madeleine_custom_login_title' );

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
    function madeleine_disable_rss_feed() {
      wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
    }

    add_action('do_feed', 'madeleine_disable_rss_feed', 1);
    add_action('do_feed_rdf', 'madeleine_disable_rss_feed', 1);
    add_action('do_feed_rss', 'madeleine_disable_rss_feed', 1);
    add_action('do_feed_rss2', 'madeleine_disable_rss_feed', 1);
    add_action('do_feed_atom', 'madeleine_disable_rss_feed', 1);
    add_action('do_feed_rss2_comments', 'madeleine_disable_rss_feed', 1);
    add_action('do_feed_atom_comments', 'madeleine_disable_rss_feed', 1);
