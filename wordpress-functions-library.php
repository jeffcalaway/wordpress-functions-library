<?php
/*
Plugin Name: Wordpress Functions Library
Plugin URI: https://github.com/peterjohnhunt/wordpress-functions-library
Version: 1.0.0
Author: PeterJohn Hunt
Description: Functions Library for Wordpress
*/

if(!function_exists('_log')){
	function _log( $message ) {
		if( WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}

if(!function_exists('get_svg')){
	function get_svg($svg, $png=false) {
		$newABSPATH = ABSPATH;
		$newSITEURL = site_url();
		if ( $svg ) :
		  $icon = $svg;
		  if ( strpos( $icon, '.svg' ) !== false ) :
		    $icon = str_replace( $newSITEURL, '', $icon);
				ob_start();
				include($newABSPATH . $icon);
				if ($png) {
					echo '<!--[if lt IE 9]><img src="'.$png.'" alt=""><![endif]-->';
				}
				return ob_get_clean();
		   endif;
		endif;
	}
}

if(!function_exists('the_svg')){
	function the_svg($svg, $png=false) {
		echo get_svg($svg, $png);
	}
}

if(!function_exists('get_accent_words')){
	function get_accent_words( $content, $tag="em", $wrap=false ) {
		$content = preg_replace(array('/\s\"/'), " <".$tag.">", $content);
		$content = preg_replace(array('/\"\s/'), "</".$tag."> ", $content);

		$content = preg_replace(array('/^\"/'), "<".$tag.">", $content);
		$content = preg_replace(array('/\"$/'), "</".$tag.">", $content);

		$content = preg_replace(array('/>\"/'), "><".$tag.">", $content);
		$content = preg_replace(array('/\"</'), "</".$tag."><", $content);

		if ($wrap) {
			$content = explode("\n\r", $content);
			$newContent = '';
			foreach ($content as $piece) {
				if ($piece) {
					$newContent .= '<'.$wrap.'>'.$piece.'</'.$wrap.'>';
				}
			}
			return $newContent;
		}

		return $content;
	}
}

if(!function_exists('the_accent_words')){
	function the_accent_words( $content, $tag="em", $wrap=false ) {
		echo get_accent_words( $content, $tag, $wrap );
	}
}

if(!function_exists('get_phone')){
	function get_phone($number, $prefix="+1") {
		$url_phone = str_replace(array("+1", "+44", "+", "(", ")", "-", ".", " " ), "", $number);
		$url_phone = 'tel:'.$prefix.$url_phone;
		return $url_phone;
	}
}

if(!function_exists('the_phone')){
	function the_phone($number, $prefix="+1") {
		echo get_phone($number, $prefix);
	}
}

if(!function_exists('get_static')){
	function get_static($filename='') {
		return get_template_directory_uri().'/'.$filename;
	}
}

if(!function_exists('the_static')){
	function the_static($filename='') {
		echo get_static($filename);
	}
}

?>
