<?
  /**
   * ACF settings path
   */
  function assi_acf_settings_path( $path ) {
    // update path
    $path = get_stylesheet_directory().'/includes/acf/';
    // return
    return $path;
  }
  add_filter('acf/settings/path', 'assi_acf_settings_path');

  /**
   * ACF settings dir
   */
  function assi_acf_settings_dir( $dir ) {
      // update path
      $dir = get_stylesheet_directory_uri().'/includes/acf/';
      // return
      return $dir;
  }
  add_filter('acf/settings/dir', 'assi_acf_settings_dir');

  function virt_get_text( $translation, $original ){
    if ( 'Excerpt' == $original ) {
        return 'Short description';
    }

    return $translation;
  }
  add_filter( 'gettext', 'virt_get_text', 10, 2 );
