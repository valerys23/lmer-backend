<?
  /**
   * ACF settings path
   */
  function madeleine_acf_settings_path( $path ) {
    // update path
    $path = get_stylesheet_directory().'/includes/acf/';
    // return
    return $path;
  }
  add_filter('acf/settings/path', 'madeleine_acf_settings_path');

  /**
   * ACF settings dir
   */
  function madeleine_acf_settings_dir( $dir ) {
      // update path
      $dir = get_stylesheet_directory_uri().'/includes/acf/';
      // return
      return $dir;
  }
  add_filter('acf/settings/dir', 'madeleine_acf_settings_dir');

  function madeleine_get_text( $translation, $original ){
    if ( 'Excerpt' == $original ) {
        return 'Short description';
    }

    return $translation;
  }
  add_filter( 'gettext', 'madeleine_get_text', 10, 2 );


  function mytheme_custom_excerpt_length( $length ) {
    return 20;
  }
  add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );
