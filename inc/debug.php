<?php
/**
 * DEBUG CONFIG
 * Configurações de debug >>> NÂO CONFUNDIR COM /functions/debug.php !!!
 * 
 */

//add_filter('admin_init', 'show_POST'); 
function show_POST(){
	pre($_POST);
}

//add_filter( 'whitelist_options', 'show_whitelist_options' );
function show_whitelist_options($whitelist_options){
	pre($whitelist_options);
	return $whitelist_options;
}
 
add_action( 'wp_footer', 'current_page_info' );
add_action( 'admin_footer', 'current_screen_info' );

//add_action( 'admin_footer', 'current_screen_viewer' );
function current_screen_viewer(){
	$screen = get_current_screen();
	pre($screen, '$screen');
}

//print_r( debug_backtrace( defined("DEBUG_BACKTRACE_IGNORE_ARGS") ? DEBUG_BACKTRACE_IGNORE_ARGS : FALSE ) );
//add_action( 'all', create_function( '', 'var_dump( current_filter() );' ) );

//add_action('shutdown', 'debug_queries');
function debug_queries(){
	global $wpdb;
	pre($wpdb->queries);
}

//add_action('admin_footer', 'debug_all');
//add_action('wp_footer', 'debug_all', 99);
function debug_all(){
	unset($GLOBALS['l10n']);// remover traduções
	unset($GLOBALS['wp_filter']);// remover filtros
	
	// GLOBALS extended
	$preglobs = array();
	foreach($GLOBALS AS $glob => $val){
		$preglobs[$glob] = $val;
	}
	unset($preglobs['GLOBALS']);
	$args = array(
		'legend' => 'GLOBALS FIRST LEVEL',
		'collapse' => false,
		'display' => 'first_level',
		//'subvariable' => '_ENV',
	);
	new prex( $preglobs, $args );
}

//add_action('wp_footer', 'debug_server');
//add_action('admin_footer', 'debug_server');
function debug_server(){
	pre($_SERVER, '$_SERVER');
	pre( WP_POST_REVISIONS );
}

//add_action('wp_footer', 'debug_constants');
//add_action('admin_footer', 'debug_constants');
function debug_constants(){
	$cons = get_defined_constants(true);
	pre($cons['user']);
}

//add_action('wp_footer', 'debug_theme_features');
//add_action('admin_footer', 'debug_theme_features');
function debug_theme_features(){
	global $_wp_theme_features;
	pre($_wp_theme_features, '$_wp_theme_features');
}

//add_action('admin_print_footer_scripts', 'debug_admin');
function debug_admin(){
	global $self, $parent_file, $submenu_file, $plugin_page, $pagenow, $typenow;
	$admin_globals = array(
		'self',
		'parent_file',
		'submenu_file',
		'plugin_page',
		'pagenow',
		'typenow',
		'wp_widget_factory',
	);
	$admin_globals_vals = array();
	foreach( $admin_globals as $var ){
		if( isset( $$var ) )
			$admin_globals_vals[$var] = $$var;
	}
	
	pre($admin_globals_vals);
}
