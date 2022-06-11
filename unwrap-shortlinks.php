<?php
/*
 Plugin Name: Unwrap Shortlinks
 Plugin URI: https://codeberg.org/kvibber/unwrap-shortlinks
 Description: Follow shortened links (t.co, bit.ly, etc) and expand them so that your blog post will point directly to the destination.
 Version: 0.2.3
 Author: Kelson Vibber
 Author URI: https://kvibber.com
 License: GPLv2 or later  
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// ini_set('display_errors', '1'); ini_set('error_reporting', E_ALL);

function ktv_unwrap_shortlinks($content) {
	preg_match_all('/\b(https?:\/\/(?:t\.co|bit\.ly|j\.mp|ow\.ly|is\.gd|trib\.al|buff\.ly|tmblr\.co|wp\.me|tinyurl\.com|goo\.gl|dlvr\.it|fb\.me|qr\.ae)\/[^\s"\']+)\b/', $content, $matches, PREG_PATTERN_ORDER);
	foreach ($matches[1] as $link) {
		$getlink = ktv_unwrap_shortlinks_replace($link);
		if ($getlink != "")
			$content = str_replace($link, $getlink, $content);
	}
	return $content;
}



function ktv_unwrap_shortlinks_replace($url) {
	// make a head request and don't follow redirection, just look at the response.
	$response = wp_remote_head( $url ); //, array( 'redirection' => 0 ) );
	$status = wp_remote_retrieve_response_code( $response );
	$finalURL = wp_remote_retrieve_header( $response, 'location' );
	
	// If it was a redirect, return the next URL.
	if ($status == 301 || $status == 302 || $status == 307 || $status == 308) {
		return esc_url($finalURL);
	}
	// We didn't get anything, or it didn't redirect, so let's return a blank.
	return "";
}

add_filter('content_save_pre', 'ktv_unwrap_shortlinks', 700);


?>
