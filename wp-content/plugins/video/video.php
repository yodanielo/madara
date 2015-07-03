<?php
/**
 * @package video
 * @category video
 * @author VideoPress
 * @link http://videopress.com/ VideoPress
 * @version 1.1.2
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/*
Plugin Name: VideoPress
Plugin URI: http://wordpress.org/extend/plugins/video/
Description: Upload new videos to <a href="http://videopress.com/">VideoPress</a>, edit metadata, and easily insert VideoPress videos into posts and pages using shortcodes. Requires a <a href="http://wordpress.com/">WordPress.com</a> account and a WordPress.com blog with the <a href="http://en.wordpress.com/products/#videopress">VideoPress upgrade</a>.
Author: Automattic, Niall Kennedy, Joseph Scott
Contributor: Hailin Wu
Author URI: http://videopress.com/
Version: 1.1.2
Stable tag: 1.1.2
License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

add_action( 'media_buttons', 'videopress_media_buttons', 999 );

/**
 * Add a video button to the post composition screen
 * @since 0.1.0
 */
function videopress_media_buttons( ) {
	$title = esc_attr( __( 'VideoPress' ) );
	$plugin_url = esc_url( plugins_url( ) . '/' . dirname( plugin_basename( __FILE__ ) ) . '/' );

	echo '<a href="https://public-api.wordpress.com/videopress-plugin.php?page=video-plugin&amp;video_plugin=1&amp;iframe&amp;TB_iframe=true" id="add_video" class="thickbox" title="' . $title . '"><img src="' . $plugin_url . '/camera-video.png" alt="' . $title . '" width="16" height="16" /></a>';
}

//allow either [videopress xyz] or [wpvideo xyz] for backward compatibility
add_shortcode( 'videopress', 'videopress_shortcode' );
add_shortcode( 'wpvideo', 'videopress_shortcode' );

/**
 * Validate user-supplied guid values against expected inputs
 *
 * @since 1.1
 * @param string $guid video identifier
 * @return bool true if passes validation test
 */
function __videopress_is_valid_guid( $guid ) {
	if ( !empty($guid) && ctype_alnum($guid))
		return true;
	else
		return false;
}

/**
 * Search a given content string for VideoPress shortcodes. Return an array of shortcodes with guid and attribute values.
 *
 * @see do_shortcode()
 * @param string $content post content string
 * @return array Array of shortcode data. GUID as the key and other customization parameters as value. empty array if no matches found.
 */
function find_all_videopress_shortcodes( $content ) {
	$r = preg_match_all( '/(.?)\[(wpvideo)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\2\])?(.?)/s', $content, $matches, PREG_SET_ORDER );

	if ( $r === false || $r === 0 ) 
		return array();

	unset( $r );

	$guids = array();
	foreach ( $matches as $m ) {
		// allow [[foo]] syntax for escaping a tag
		if ( $m[1] == '[' && $m[6] == ']' )
			continue;
		$attr = shortcode_parse_atts( $m[3] );
		if ( __videopress_is_valid_guid( $attr[0] ) ) {
			$guid = $attr[0];
			unset( $attr[0] );
			$guids[$guid] = $attr;
			unset( $guid );
		}
		unset( $attr );
	}

	return $guids;
}

/**
 * Insert video handlers into HTML <head> if posts with video shortcodes exist.
 * If video posts are present add SWFObject JS and attach events for each movie container's identifier.
 */
function video_embed_head() {
	global $posts;

	if ( is_feed() || !is_array($posts) )
		return;

	$guids = array();
	foreach ($posts as $post) {
		$guids = array_merge( $guids, find_all_videopress_shortcodes( $post->post_content ) );
	}

	if ( is_array($guids) && count($guids) > 0 ) {
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>';
		$embed_seq = 0;
		$script_block = '<script type="text/javascript">' . "\n" . '// <![CDATA[' . "\n"; // escape the JS block for strict parsers
		foreach ($guids as $guid) {
			$script_block .= "swfobject.registerObject('video$embed_seq','9.0.115');";
			$embed_seq++;
		}
		echo $script_block . "\n" . '// ]]>' . "\n" . '</script>';
	}
}
add_action('wp_head', 'video_embed_head');

/**
 * Parse VideoPress XML into PHP variables we care about: allowed_sites and embed
 * Use SimpleXML processing for speed in PHP5
 *
 * @since 1.1
 * @uses simplexml_load_string()
 * @param string $vp_xml VideoPress XML feed as a string
 * @return array named arguments array containing $allowed_sites and $embed
 */
function __videopress_parse_simplexml( $vp_xml ) {
	$allowed_sites = '';
	$embed = '';
	$parsed_xml = simplexml_load_string( $vp_xml );
	if ( !empty( $parsed_xml ) ) {
		$embed_el = simplexml_load_string( (string) $parsed_xml->video->embed_code );
		if ( !empty( $embed_el ) ) {
			$embed = (array)$embed_el->attributes();
			if ( !empty($embed) )
				$embed = $embed['@attributes'];
			else
				$embed = ''; // reset the embed value
		}

		$allowed_sites_el = $parsed_xml->video->allowed_embed_sites;
		if ( !empty($allowed_sites_el) )
			$allowed_sites = explode(',', (string)$allowed_sites_el );
	}

	return array('allowed_sites' => $allowed_sites, 'embed' => $embed);
}

/**
 * Parse VideoPress XML into PHP variables we care about: allowed_sites and embed
 * Use xml_parser processing for compatibility in PHP 4
 *
 * @since 1.1
 * @uses xml_parse_into_struct()
 * @param string $vp_xml VideoPress XML feed as a string
 * @return array named arguments array containing $allowed_sites and $embed
 */
function __videopress_parse_xml( $vp_xml ) {
	$xml_parser = xml_parser_create();
	xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 1);
	xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1);
	$parsed = xml_parse_into_struct( $xml_parser, $vp_xml, $vals, $elements );
	// Free up memory used by the XML parser
	xml_parser_free($xml_parser);
	if ( !$parsed )
		return '';

	$embed_str = '';
	$allowed_sites = '';

	foreach ($elements as $key=>$val) {
		if ( $key == 'EMBED_CODE' )
			$embed_str = $vals[$val[0]]['value'];
		elseif ( $key == 'ALLOWED_EMBED_SITES' )
			$allowed_sites = $vals[$val[0]]['value'];
	}

	if ( !empty( $allowed_sites ) )
		$allowed_sites = explode(',', $allowed_sites);

	if ( !empty( $embed_str ) ) {
		$xml_parser = xml_parser_create();
		xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 1);
		xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1);
		$parsed = xml_parse_into_struct( $xml_parser, $embed_str, $vals );
		xml_parser_free( $xml_parser );
		$embed = $vals[0]['attributes'];
		if (!$parsed || !is_array($embed))
			$embed = '';
		else {
			$new_array = array();
			foreach($embed as $key => $val ) {
				$new_array[strtolower($key)] = $val;
			}
			$embed = $new_array;
		}
	}

	return array('allowed_sites' => $allowed_sites, 'embed' => $embed);
}

/**
 * Replaces wpvideo shortcode and customization parameters with full HTML markup for video playback
 *
 * @since 0.1.0
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @param array $attr an array of attributes: video guid, width (w) and height (h)
 * @return string HTML markup enabling video playback for the given video, or empty string if incorrect syntax
 */
function videopress_shortcode( $attr ) {
	global $content_width;
	static $embed_seq = -1;

	$guid = $attr[0];
	if ( !__videopress_is_valid_guid($guid) )
		return '';

	// loading through wp_remote_get should cache the XML response on the installed blog
	$response = wp_remote_get( "http://v.wordpress.com/wp-content/plugins/video/video-xml.php?guid={$guid}" );
	$vp_xml = wp_remote_retrieve_body( $response );

	if ( wp_remote_retrieve_response_code( $response ) != 200 || empty( $vp_xml ) )
		return '';


	if ( function_exists('simplexml_load_string') )
		extract( __videopress_parse_simplexml( $vp_xml ) );
	else
		extract( __videopress_parse_xml( $vp_xml ) );
	unset( $vp_xml );

	/*
	* Check if the embed attempt will fail before inserting embed code.
	* Return an error message if current user can change the post
	*/
	if ( !empty($allowed_sites) ) {
		$url_parts = parse_url( get_option('siteurl') );
		if ( $url_parts ) {
			if ( !in_array( $url_parts['host'], $allowed_sites ) ) {
				if ( current_user_can('edit_posts')  )
					return __videopress_error_placeholder( __('Embed error'),  sprintf( __('<div><strong>%s</strong> is not an allowed embed site.</div><div>Publisher limits playback of video embeds.</div>'), $url_parts['host'] ) );
				else
					return '';
			}
		}
	}

	if ( empty($embed) )
		return '';

	$embed_seq++;
	$default_width = 400;
	if ( isset( $embed['width'] ) )
		$default_width = absint( $embed['width'] );

	$default_height = 300;
	if ( isset( $embed['height'] ) )
		$default_height = absint( $embed['height'] );

	$width  = 0;
	$height = 0;

	if ( isset( $attr['w'] ) )
		$width = absint( $attr['w'] );

	if ( isset( $attr['h'] ) )
		$height = absint( $attr['h'] );

	// if neither w nor h is given, take advantage of content_width to scale video
	if ( 0 == $width && 0 == $height ) {

		$width = $default_width;

		if ( isset( $content_width ) && $content_width > 0 ) {

		    if ( $content_width < $default_width )
				$width  = $content_width;
			else if ( $content_width > 630 )
				$width  = 640;

		} else {
			$height = $default_height;
		}
	}

	if ( 0 == $width ) {
		$width = (int)( ( $default_width*$height ) / $default_height );
		if ( $width %2 == 1 )
			$width--;
	} elseif (0 == $height) {
		$height = (int)( ( $default_height*$width ) / $default_width );
		if ( $height %2 == 1 )
			$height--;
	}

	$embed['width'] = $width;
	$embed['height'] = $height;

	if ( isset( $embed['flashvars'] ) ) {
		$flashvars = array();
		parse_str( $embed['flashvars'], $flashvars );
		$flashvars['site'] = 'wporg';
		if ( function_exists('http_build_query') ) {
			$embed['flashvars'] = http_build_query( $flashvars );
		}
		else {
			$flashvars_str_builder = array();
			foreach ( $flashvars as $key => $value ) {
				$flashvars_str_builder[] = $key . '=' . $value;
			}
			$embed['flashvars'] = implode('&', $flashvars_str_builder);
		}
	}

	$embed['id'] = 'video' . $embed_seq;

	if ( is_feed() ) {
		// feed readers such as Google Reader require embed markup
	    $final_markup = '<embed';
		foreach ($embed as $attribute => $value) {
			$value = esc_attr( $value );
			$final_markup .= " $attribute=\"$value\"";
		}
		$final_markup .= '></embed>';
	}
	else {
		$el_id = esc_attr( $embed['id'] );
		// remove id, class, and type markers if present. we will set these directly.
		unset( $embed['id'], $embed['class'], $embed['type'] );

		$src = clean_url( $embed['src'], array('http', 'https') );
		unset( $embed['src'] );

		$width = absint( $embed['width'] );
		unset( $embed['width'] );

		$height = absint( $embed['height'] );
		unset( $embed['height'] );

		$title = esc_attr( $embed['title'] );
		$title_html = esc_html( $embed['title'] );
		unset( $embed['title'] );

		$params = '';
		$embed['quality'] = 'best';
		$embed['overstretch'] = 'true';
		foreach( $embed as $name => $value ) {
			$value = esc_attr($value);
			$params .= "<param name=\"$name\" value=\"$value\" />";
		}

		$flash_help = sprintf( __('This movie requires <a rel="nofollow" href="%s">Adobe Flash</a> for playback.'), 'http://www.adobe.com/go/getflashplayer');

		// double bake for Internet Explorer and standards-compliant browsers
		$final_markup = <<<OBJECT
<object id="$el_id" class="videopress" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="$width" height="$height" standby="$title">
  <param name="movie" value="$src" />
  $params
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="$src" width="$width" height="$height" standby="$title">
    $params
  <!--<![endif]-->
  <p><strong>$title_html</strong></p><p class="robots-nocontent">$flash_help</p>
  <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
OBJECT;
	}

	return $final_markup;
}

/**
 * Display a VideoPress error message if an embed is unsuccessful
 *
 * @param string $text main error display plaintext
 * @param string $subtext additional information about the error. may include HTML.
 * @param string $text_type type of the text message display
 * @param int $width width of the error display element
 * @param int $height height of the error display element
 */
function __videopress_error_placeholder( $text='', $subtext='', $text_type='error', $width=400, $height=300, $context='blog' ) {
	$text = esc_html( $text ); // escape text for inclusion in HTML
	if ($text_type == 'error' )
		$text = "<span class='video-plh-error'>$text</span>";
	$class = $width >= 380? 'video-plh-full' : 'video-plh-thumb';
	if ( $context == 'blog' ) {
		$align = 'center';
		$margin = 'margin:auto';
	}
	else {
		$align = 'left';
		$margin = '';
	}
	$mid_width = $width - 16;
	$res = '';
	if ( !is_feed() ) {
		$res = <<<STYLE
	<style type="text/css">
		.video-plh {font-family:Trebuchet MS, Arial, sans-serif;text-align:$align;margin:3px;}
		.video-plh-notice {background-color:black;color:white;display:table;#position:relative;line-height:1.0em;text-align:$align;$margin;}
		.video-plh-mid {text-align:$align;display:table-cell;#position:absolute;#top:50%;#left:0;vertical-align:middle;padding: 8px;}
		.video-plh-text {#position:relative;#top:-50%;text-align:center;line-height:35px;}
		.video-plh-sub {}
		.video-plh-full {font-size:28px;}
		.video-plh-full .video-plh-sub {font-size:14px;}
		.video-plh-thumb {font-size:18px;}
		.video-plh-thumb .video-plh-sub {font-size:12px;}
		.video-plh-sub {line-height: 120%; margin-top:1em;}
		.video-plh-error {color:#f2643d;}
	</style>
STYLE;
	}
	$res .= <<<BODY
	<div class="video-plh $class">
		<div class="video-plh-notice" style='width:{$width}px;height:{$height}px;'>
			<div class="video-plh-mid" style='width:{$mid_width}px;'>
				<div class="video-plh-text">
					$text
					<div class="video-plh-sub">$subtext</div>
				</div>
			</div>
		</div>
	</div>
BODY;
	return $res;
}

?>