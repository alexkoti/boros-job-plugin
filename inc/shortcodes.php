<?php
/**
 * SHORTCODES
 * Configuração de todos os custom shortcodes
 * 
 * 
 * 
 */



/* ========================================================================== */
/* SHORTCODE BOX HTML ======================================================= */
/* ========================================================================== */
// add_shortcode( 'box', 'get_html_box' );
function get_html_box( $attr ){
	global $post;
	//pre($html_boxes);
	//pre($attr['name']);
	
	if( isset($attr['name']) ){
		$html_boxes = get_post_meta( $post->ID, 'html_boxes', true);
		foreach( $html_boxes as $box ){
			if( $box['html_box_name'] == $attr['name'] )
			return $box['html_box_code'];
		}
	}
}
