<?php

if ( ! function_exists( 'get_filesize' ) ) {
  function get_filesize( $file_path ) {
    $file_fullpath = str_replace( site_url(), ABSPATH, $file_path );
    if ( is_file( $file_fullpath ) ) {
      $file_size = '<span class="filesize-value">' . str_replace( ' ', '</span><span class="filesize-unit">', size_format( filesize( $file_fullpath ) ) ) . '</span>';
      return $file_size;
    }
  }
}