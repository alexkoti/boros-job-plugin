<?php
/**
 * ==================================================
 * REMOVER CORE WIDGETS =============================
 * ==================================================
 * Caso seja preciso remover alguns dos widgets padrão do WordPress.
 * O segundo bloco é referente ao acesso do controle de widgets. Normalmente o acesso é restrito aos admins, então caso seja preciso liberar acesso aos
 * controles, utilize o modelo comentado, adicionando uma capacidade 'edit_theme_options' ao tipo de usuário desejado.
 * 
 */
//add_action( 'widgets_init', 'remove_widgets' );
function remove_widgets(){
	//unregister_widget( 'WP_Widget_Pages' );
	//unregister_widget( 'WP_Widget_Calendar' );
	//unregister_widget( 'WP_Widget_Archives' );
	//unregister_widget( 'WP_Widget_Links' );
	//unregister_widget( 'WP_Widget_Meta' );
	//unregister_widget( 'WP_Widget_Search' );
	//unregister_widget( 'WP_Widget_Text' );
	//unregister_widget( 'WP_Widget_Categories' );
	//unregister_widget( 'WP_Widget_Recent_Posts' );
	//unregister_widget( 'WP_Widget_Recent_Comments' );
	//unregister_widget( 'WP_Widget_RSS' );
	//unregister_widget( 'WP_Widget_Tag_Cloud' );
	//unregister_widget( 'WP_Nav_Menu_Widget' );
	
	/**
	// adicionar a capacidade ao user 'editor' de editar widgets
	if( is_admin() ){
		$role =& get_role('editor');
		$role->add_cap('edit_theme_options');
	}
	/**/
}



/**
 * ==================================================
 * ADICIONAR WIDGETS ================================
 * ==================================================
 * 
 * 
 */


