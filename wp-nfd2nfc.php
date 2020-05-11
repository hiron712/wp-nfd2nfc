<?php
/*
    Plugin Name: NFD to NFC
    Description: NFD形式からNFC形式に変換
*/

// ↓このファイルに直接アクセスされた場合のために必ず処理の先頭につけましょう
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once("macFileNameNormalizer.php");

if ( ! function_exists( 'my_the_content' ) ):
	function my_the_content($content) {
		$macFnn = new nameNormalizer();
		$content = $macFnn->nfd2nfc($content);
		return $content;
	}
	add_filter('the_content', 'my_the_content', 10, 3);
endif;

if ( ! function_exists( 'my_get_the_excerpt' ) ):
	function my_get_the_excerpt( $excerpt ) {
		$macFnn = new nameNormalizer();
		$excerpt = $macFnn->nfd2nfc($excerpt);
		return $excerpt;
	}
	add_filter( 'get_the_excerpt', 'my_get_the_excerpt' );
endif;

if ( ! function_exists( 'my_acf_load_value' ) ):
	function my_acf_load_value( $value, $post_id, $field ) {
		if( is_string($value) ) {
			$macFnn = new nameNormalizer();
			$value = $macFnn->nfd2nfc($value);
		}
		return $value;
	}
	add_filter('acf/load_value', 'my_acf_load_value', 10, 3);
endif;
