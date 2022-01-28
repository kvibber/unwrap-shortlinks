<?php
/*
 Plugin Name: Unwrap Shortlinks
 Plugin URI: https://codeberg.org/kvibber/unwrap-shortlinks
 Description: Follow shortened links (t.co, bit.ly, etc) and expand them so that your blog post will point directly to the destination.
 Version: 0.2.1
 Author: Kelson Vibber
 Author URI: https://kvibber.com
 License: GPLv2 or later  
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// ini_set('display_errors', '1'); ini_set('error_reporting', E_ALL);

function ktv_unwrap_shortlinks($content) {
	preg_match_all('/[^>"]?(https?:\/\/(?:t\.co|bit\.ly|j\.mp|ow\.ly|is\.gd|trib\.al|buff\.ly|tmblr\.co|wp\.me|tinyurl\.com|goo\.gl|dlvr\.it|fb\.me|qr\.ae)\/[^\s"\']+)/', $content, $matches, PREG_PATTERN_ORDER);
	foreach ($matches[1] as $link) {
		$getlink = ktv_unwrap_shortlinks_replace($link);
		if ($getlink != "")
			$content = str_replace($link, $getlink, $content);
	}
	return $content;
}



function ktv_unwrap_shortlinks_replace($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1); // Only follow one redirect
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
	// Retrieve content and final URL.
        $output = curl_exec($ch);
	$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$finalURL = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);
	
	
	if ($output === FALSE && ! ($status == '301' || $status == '302') ) {
		// We didn't get anything, so let's return a blank.
		return "";

	} else {
		return esc_url($finalURL);
	}
}
/*
// Takes a post ID and updates the post with the short URLs unwrapped.
ktv_unwrap_shortlinks_update($which_post) {
	$post_content = get_post_field('post_content', $which_post);
	$post_content = ktv_unwrap_shortlinks($post_content);
	$my_post = array (
		'ID' => $which_post,
		'post_content' => $post_content
	);
	wp_update_post( $my_post );
}
*/

//add_filter('the_content', 'ktv_unwrap_shortlinks');

add_filter('content_save_pre', 'ktv_unwrap_shortlinks', 700);


?>
