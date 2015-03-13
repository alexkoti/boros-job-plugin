<?php
/*
 * PLUGIN SETTINGS LINK
 * Link de opções na listagem de plugins
 * 
 */
add_filter( 'plugin_action_links_boros_base/boros_base.php', 'my_add_settings_link', 10, 2 );
function my_add_settings_link($links, $file){
	$settings_link = sprintf( '<a href="admin.php?page=%s">%s</a>', 'section_general', __('Settings') );
	array_unshift( $links, $settings_link );
	return $links;
}



/**
 * ==================================================
 * WORK CSS/JS ======================================
 * ==================================================
 * CSS e JS para o admin do trabalho.
 * NÃO ESQUECER A CONSTANTE DE CAMINHO!!!
 * 
 */
add_filter( 'admin_head', 'custom_admin_head' );
function custom_admin_head(){
	wp_enqueue_script( 'custom_admin_scripts', BOROS_BASE_URL . 'js/work.js', array('jquery') );
	wp_enqueue_style( 'custom_admin_styles', BOROS_BASE_URL . 'css/work.css' );
}


