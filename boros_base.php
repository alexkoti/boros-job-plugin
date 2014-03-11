<?php
/*
Plugin Name: Boros Base
Plugin URI: http://alexkoti.com
Description: Plugin base para para qualquer job. Configurações mínimas ativadas e arquivos prontos para uso.
Version: 1.0.0
Author: Alex Koti
Author URI: http://alexkoti.com
License: GPL2
*/

/**
 * CONSTANTES
 */
define( 'BOROS_BASE_DIR', plugin_dir_path(__FILE__) );
if( !defined('BOROS_BASE_URL') )
	define( 'BOROS_BASE_URL', plugins_url( '/', __FILE__ ) );

define( 'JQUERY_URL', get_bloginfo('template_url') . '/js/libs/jquery-1.9.1.min.js' );



/**
 * ==================================================
 * EXTRA FORM ELEMENTS ==============================
 * ==================================================
 * Adicionar pasta de form elements
 * 
 */
add_filter( 'boros_extra_form_elements_folder', 'extra_form_elements_folder' );
function extra_form_elements_folder( $folders ){
	$folders[] = BOROS_BASE_DIR . 'form_elements';
	return $folders;
}



/**
 * INCLUDES ADMIN
 * 
 * 
 */
if( is_admin() ){
	include_once( 'inc/admin_dashboard.php' ); // configurações para o dashboard
}

/**
 * INCLUDES GERAL
 * 
 */
include_once( 'inc/admin_init.php' );				// configurações iniciais de admin: link e registro de settings
include_once( 'inc/debug.php' );					// configs de debug
include_once( 'inc/admin_pages.php' ); 				// configurações para as páginas de admin
include_once( 'inc/register_post_types.php' );		// adicionar custom post_types e configuração das listagens
include_once( 'inc/register_taxonomies.php' );		// adicionar custom taxonomies
include_once( 'inc/meta_boxes.php' );				// configurações dos metaboxes
include_once( 'inc/user.php' );						// edição de painéis e configs de usuários
include_once( 'inc/widgets.php' );					// widgets, configurar os widgets válidos
include_once( 'inc/shortcodes.php');				// shortcodes
include_once( 'inc/tinymce.php');					// tinymce do editor padrão
include_once( 'inc/admin_ajax.php');				// ajax apenas para admin
include_once( 'inc/frontend_ajax.php');				// ajax para o frontend(ver notas no arquivo)
include_once( 'inc/frontend_forms.php');			// configuração dos forms de frontend
include_once( 'inc/on_save.php' );					// functions para rodar no momento de salvamento de posts
include_once( 'inc/email.php' );					// configuração de email
include_once( 'inc/third_party.php' );				// configurações de integração com facebook/twitter/etc
include_once( 'inc/temp.php' );						// colocar aqui apenas functions de testes ou temporárias


/**
 * START OPTIONS
 * Opções requeridas, que devem ser setadas caso não existam no banco.
 * 
 */
register_activation_hook( __FILE__, 'activate_boros_base' );
function activate_boros_base(){
	$options = array(
		//'home_posts_per_page_box' => 3,
	);
	foreach( $options as $option => $value ){
		add_option( $option, $value );
	}
}
