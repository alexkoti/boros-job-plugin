<?php
/**
 * 1 - Adicionar admin pages
 * 2 - Remover core pages
 * 3 - Configurar admin_bar
 * 
 */

/**
 * ==================================================
 * ACTIONS / FILTERS ================================
 * ==================================================
 * my_admin_pages_config()	trocar pela função de configuração do seu plugin
 * BOROS_BASE_DIR		trocar pela constante do caminho da seu plugin, usar <code> plugin_dir_path(__FILE__) </code> no arquivo base do plugin
 * BOROS_BASE_URL		trocar pela constante da URL do plugin, usar <code> plugin_dir_url(__FILE__) </code> no arquivo base do plugin
 * 
 */
add_action( 'init', 'my_admin_pages' );
function my_admin_pages(){
	$admin_pages = new BorosAdminPages( my_admin_pages_config(), BOROS_BASE_DIR, BOROS_BASE_URL );
}

/**
 * ==================================================
 * CONFIGURAÇÃO DAS PÁGINAS =========================
 * ==================================================
 * IMPORTANTE!
 * A chave do array será usada como 'menu_slug', nome de arquivo para o include e para function de inicialização:
 * 	'my_page' = array(...)		>>> chave do array de configuração declarado neste function admin_pages_config()
 * 	admin_pages/my_page.php	>>> arquivo de include com as configs e functions individuais de cada página
 * 	my_page()				>>> function de configuração de elementos
 * 	settings_fields('my_page')	>>> será o name usado nessa chamada nos campos hidden do form. Essa execução será automática
 * 
 * Para adicionar subpages ao core, defina como chave o nome do arquivo( 'edit.php' para posts, 'edit.php?post_type=page' para pages, 'tools.php' para ferramentas, etc ), e defina o 
 * atributo 'type' como 'core', dessa forma as configs de página raiz serão ignoradas e consideradas apenas as subpages. Não esqueça de adicionar o atributo 'capability' nessas subpages, 
 * que normalmente são herdadas da configuração do parent.
 * 
 * Em 'subpages' vale a mesma lógica de configuração, inclusive com seus próprios enqueues
 * Em 'tabs' defina a chave como o name a ser usado no mesmo padrão(chave, function e settings_field) e o valor como o label da aba.
 * 
 */
function my_admin_pages_config(){
	
	$admin_pages = array(
		'edit.php' => array(
			'type' => 'core',
			'subpages' => array(
				'category_order' => array(
					'page_title'	=> 'Ordem das Categorias', 
					'menu_title'	=> 'Ordenar Categorias', 
					'menu_slug'		=> 'category_order', 
					'capability'	=> 'manage_options',
				)
			),
		),
		'tools.php' => array(
			'type' => 'core',
			'subpages' => array(
				'section_dummy_content' => array(
					'page_title'	=> 'Conteúdo de Testes', 
					'menu_title'	=> 'Conteúdo de Testes', 
					'capability'	=> 'manage_options', 
				),
			),
		),
		'section_content' => array(
			'page_title'	=> 'Opções do Site', 
			'menu_title'	=> 'Opções do Site', 
			'capability'	=> 'manage_options', 
			'icon_url'		=> 'dashicons-admin-generic',
			'subpages' => array(
				'section_general' => array(
					'page_title'	=> 'Opções de Administração', 
					'menu_title'	=> 'Opções de Administração', 
					'capability'	=> 'manage_options', 
				),
				'section_emails' => array(
					'page_title'	=> 'Emails', 
					'menu_title'	=> 'Emails', 
					'capability'	=> 'manage_options', 
				),
			),
		),
		'section_networks' => array(
			'page_title'	=> 'Redes Sociais', 
			'menu_title'	=> 'Redes Sociais', 
			'capability'	=> 'manage_options', 
			'icon_url'		=> 'dashicons-admin-share',
		),
	);
	return $admin_pages;
}



/**
 * ==================================================
 * REMOVER PÁGINAS DO ADMIN =========================
 * ==================================================
 * 
 * @link http://devpress.com/blog/removing-menu-pages-from-the-wordpress-admin/
 */
//add_action('admin_menu', 'remove_admin_pages');
function remove_admin_pages(){
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
}



/**
 * ==================================================
 * CONFIGURAÇÔES DA ADMIN BAR :: SEMI-STATIC ========
 * ==================================================
 * @bug Em $wp_admin_bar->add_menu, no array de config, a opção 'meta' é obrigatória, declarar vazio se necessário
 * 
 * @link http://www.paulund.co.uk/how-to-remove-links-from-wordpress-admin-bar
 * @link http://wp-snippets.com/addremove-wp-admin-bar-links/
 */
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
	global $wp_admin_bar;
	
	// REMOVER
	$wp_admin_bar->remove_menu('wp-logo');				// Remove the WordPress logo
	$wp_admin_bar->remove_menu('view-site');			// Remove the view site link
	//$wp_admin_bar->remove_menu('my-account');			// Remove my-account
	
	// ADICIONAR
	if( is_admin() ) $frontend_text = 'Ver site: ' . get_bloginfo('name');
	else $frontend_text = get_bloginfo('name');
	$wp_admin_bar->add_menu(array(
		'id' => 'site-name',
		'title' => $frontend_text,
		'href' => home_url(),
		'meta' => array(),
	));
}


