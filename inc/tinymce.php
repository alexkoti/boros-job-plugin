<?php
/**
 * ==================================================
 * EDITOR DE TEXTO TINYMCE ==========================
 * ==================================================
 * 
 */
add_filter( 'tiny_mce_before_init', 'set_the_editor_class' );
function set_the_editor_class( $init ){
	global $post;
	if( isset($post->post_type) ){
		$init['body_class'] = "hentry hentry-{$post->post_type}";
	}
	else{
		$init['body_class'] = "hentry hentry-undefined";
	}
	return $init;
}

/**
 * Configurar editor principal
 * 
 */
//add_filter( 'mce_buttons', 'custom_editor_buttons' );
function custom_editor_buttons( $buttons ){
	/**
	$buttons = array(
		'bold', 
		'italic', 
		'strikethrough', 
		'separator', 
		'bullist', 
		'numlist', 
		'separator', 
		'justifyleft', 
		'justifycenter', 
		'justifyright', 
		'separator', 
		'link', 
		'unlink', 
		'separator', 
		'cleanup', 
		'undo', 
		'redo', 
		'spellchecker', 
		'separator', 
		'wp_adv_start', 
		'wp_adv', 
		'separator', 
		'formatselect', 
		'underline', 
		'justifyfull', 
		'forecolor', 
		'separator', 
		'pastetext', 
		'pasteword', 
		'separator', 
		'removeformat', 
		'cleanup', 
		'separator', 
		'charmap', 
		'separator', 
		'undo', 
		'redo', 
		'wp_adv_end'
	);
	/**/
	array_insert( $buttons, array( 'separator', 'code', 'charmap', 'separator' ), count($buttons) - 1 );
	return $buttons;
}

/**
 * Adicionar styles(dropdown) de link no editor de texto.
 * Padrão "Nome de exibição=cssclass;Nome de exibição=cssclass;..."
 * Depende da função add_editor_mce_buttom2() para habilitar o botão no editor, pois este filtro apenas configura as opções
 * 
 * @link http://blog.estherswhite.net/2009/11/customizing-tinymce/
 *@link http://css-tricks.com/forums/discussion/12773/adding-styles-to-wordpress-tinymce/p1
 */
//add_filter( 'tiny_mce_before_init', 'config_tinymce' );
function config_tinymce($init){
	$class = array(
		'subtitulo' 		=> 'Subtítulo',
		'link_flickr' 		=> 'Link Flickr',
		'link_download' 	=> 'Link Download',
		'link_curtas' 		=> 'Link Curtas',
	);
	$_class = array();
	foreach( $class as $css => $title ){
		$_class[] = "{$title}={$css}";
	}
	$classes = implode( ';', $_class );
	
	$init['theme_advanced_buttons2_add'] = 'styleselect';
	$init['theme_advanced_blockformats'] = 'h3,h4,h5,h6,p';
	$init['theme_advanced_styles'] = $classes;
	//$init['theme_advanced_disable'] = 'bold,italic';
	$init['theme_advanced_text_colors'] = '0f3156,636466,0486d3';
	return $init;
}

/**
 * ==================================================
 * TINYMCE PLUGINS ==================================
 * ==================================================
 * 
 * 
 */
//add_filter("mce_external_plugins", "add_myplugin_tinymce_plugin");
function add_myplugin_tinymce_plugin($plugin_array) {
   $plugin_array['dummy'] = FUNCTIONS . '/js/dummy.js");';
   return $plugin_array;
}

