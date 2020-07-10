<?php
/**
 * REGISTER POST TYPES
 * Configurações para adicionar custom post_types. Este arquivo trabalha em conjunto com o 'register_taxonomies.php'
 * 
 */

/**
 * ==================================================
 * ADICIONAR SUPORTE A POST FORMATS =================
 * ==================================================
 * Isso irá permitir o tema usar post_formats para os 'posts' padrão do wordpress. Caso sej apreciso adicionar esse recurso a outros post_types, usar add_post_type_support()
 * Se for preciso adicionar post_formats a um post_type e ao mesmo tempo não dar suporte aos posts comnuns, é preciso primeiro habilitar os post_formats ao tema, usando
 * add_theme_support(), adicionar o suporte ao post_type desejado e só então desabilitar os formats para posts, com remove_post_type_support().
 */
//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
//add_post_type_support( 'page', 'post-formats' );
//remove_post_type_support( 'post', 'post-formats' );

/**
 * ==================================================
 * REGISTER POST TYPES ==============================
 * ==================================================
 * 
 * 
 */
//add_action( 'init', 'register_post_types' );
function register_post_types(){
    
    /**
     * Inscrições
	 * @2019
     * 
     */
    $args = array(
        'labels'              => boros_config_posttype_labels('Inscrição', 'Inscrições', 'fem', array('menu_name' => 'Inscrições')),
        'description'         => 'Inscrições para o exame',
        'public'              => false,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => false,
        'query_var'           => true,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'hierarchical'        => true,
        'has_archive'         => false,
        'menu_icon'           => 'dashicons-groups',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
            'author',
        )
    ); 
    register_post_type( 'inscricao' , $args );
    $columns_config = array(
        'post_type' => 'inscricao',
        'columns' => array(
            'cb'                                 => '<input type="checkbox" />',
            'title'                              => 'Nome do candidato',
            'function_jlpt_column_author'        => 'Usuário responsável',
            'function_jlpt_column_boleto_status' => 'Status de pagamento',
            'function_jlpt_column_photo'         => 'Foto',
            'date'                               => 'Data',
        )
    );
    new BorosPostTypeColumns( $columns_config );
    
	/**
	 * Noticias
	 * 
	 */
    $labels = boros_config_posttype_labels( 'Notícia', 'Notícias', 'fem', array('menu_name' => 'Notícias') );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Notícias diversas',
        'public'              => true,
        'hierarchical'        => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        //'show_in_menu'        => 'edit.php?post_type=artigo',
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-editor-quote',
        'capability_type'     => 'post',
        'has_archive'         => 'noticias',
        //'query_var'           => $post_slug,
        //'rewrite' => array(
        //    'slug'       => $post_slug,
        //    'with_front' => '',
        //),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
        'capabilities' => array( 
            'edit_post'              => 'edit_post',
            'read_post'              => 'read_post',
            'delete_post'            => 'delete_post',
            'edit_posts'             => 'edit_posts',
            'edit_others_posts'      => 'edit_others_posts',
            'publish_posts'          => 'publish_posts',
            'read_private_posts'     => 'read_private_posts',
            'delete_posts'           => 'delete_posts',
            'delete_private_posts'   => 'delete_private_posts',
            'delete_published_posts' => 'delete_published_posts',
            'delete_others_posts'    => 'delete_others_posts',
            'edit_private_posts'     => 'edit_private_posts',
            'edit_published_posts'   => 'edit_published_posts',
            'create_posts'           => 'edit_posts',
            'read'                   => 'read',
        ), 
    ); 
    register_post_type( 'noticia' , $args );
    $columns_config = array(
        'post_type' => 'noticia',
        'columns' => array(
            'cb'                => '<input type="checkbox" />',
            'title'             => 'Título',
            'terms_list_regiao' => 'Regiões',
            'date'              => 'Data',
            'thumb'             => 'Imagem',
        )
    );
    new BorosPostTypeColumns( $columns_config );
	
	/**
	 * ARTIGOS
	 * 
	 */
	$labels = array(
		'name' => 'Artigos',
		'singular_name' => 'Artigo',
		'menu_name' => 'Artigos',
		'add_new' => 'Novo Artigo',
		'add_new_item' => 'Adicionar Artigo',
		'edit_item' => 'Editar Artigo',
		'new_item' => 'Novo Artigo',
		'view_item' => 'Ver Artigo',
		'search_items' => 'Buscar Artigo',
		'not_found' =>  'Nenhum encontrado',
		'not_found_in_trash' => 'Nenhum encontrado na lixeira',
		'parent_item_colon' => '',
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Artigos gerais',
		'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'capabilities' => array( 
			'edit_post'              => 'edit_post',
			'read_post'              => 'read_post',
			'delete_post'            => 'delete_post',
			'edit_posts'             => 'edit_posts',
			'edit_others_posts'      => 'edit_others_posts',
			'publish_posts'          => 'publish_posts',
			'read_private_posts'     => 'read_private_posts',
			'delete_posts'           => 'delete_posts',
			'delete_private_posts'   => 'delete_private_posts',
			'delete_published_posts' => 'delete_published_posts',
			'delete_others_posts'    => 'delete_others_posts',
			'edit_private_posts'     => 'edit_private_posts',
			'edit_published_posts'   => 'edit_published_posts',
			'create_posts'           => 'edit_posts',
			'read'                   => 'read',
		), 
		'hierarchical' => true,
		'has_archive' => 'artigos',
		'menu_icon' => 'dashicons-format-aside',
		//'show_in_menu' => 'edit.php?post_type=artigo',
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes',
		)
	); 
	register_post_type( 'artigo' , $args );
	$columns_config = array(
		'post_type' => 'artigo',
		'columns' => array(
			'cb' => '<input type="checkbox" />',
			'title' => 'Título',
			'date' => 'Data',
		)
	);
	new BorosPostTypeColumns( $columns_config );
	$help_config = array(
		'post_type' => 'artigo',
		'list' => array(
			array(
				'id' => 'page_edit',
				'title' => 'Help LIST',
				'content' => '	<p>Morbi rhoncus massa tellus, at eleifend nunc. Phasellus arcu purus, luctus nec commodo eget, scelerisque tempor sem.</p>
								<p>Sed nibh velit, rhoncus in tempus vitae, aliquam at metus? Phasellus vel tristique enim? Pellentesque ullamcorper, arcu ac pellentesque congue, sapien arcu viverra elit, a sagittis metus risus eu ligula. Curabitur ut leo et mi tempor porttitor at ut lectus.</p>
								<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam justo ligula, dignissim eu consequat et, iaculis non dui. Nulla facilisi. Morbi accumsan leo id quam accumsan eleifend. Aliquam elementum, odio quis rhoncus viverra, metus orci sodales turpis, vel facilisis lorem ipsum eu eros. Maecenas eu vehicula ligula.</p>'
			),
		),
		'edit' => array(
			array(
				'id' => 'page_edit',
				'title' => 'Help EDIT',
				'content' => '	<p>Morbi rhoncus massa tellus, at eleifend nunc. Phasellus arcu purus, luctus nec commodo eget, scelerisque tempor sem.</p>
								<p>Sed nibh velit, rhoncus in tempus vitae, aliquam at metus? Phasellus vel tristique enim? Pellentesque ullamcorper, arcu ac pellentesque congue, sapien arcu viverra elit, a sagittis metus risus eu ligula. Curabitur ut leo et mi tempor porttitor at ut lectus.</p>
								<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam justo ligula, dignissim eu consequat et, iaculis non dui. Nulla facilisi. Morbi accumsan leo id quam accumsan eleifend. Aliquam elementum, odio quis rhoncus viverra, metus orci sodales turpis, vel facilisis lorem ipsum eu eros. Maecenas eu vehicula ligula.</p>'
			),
		),
	);
	new BorosPostTypeScreenHelp( $help_config );
}

/**
 * COLUNAS DE 'POSTS' e 'PAGES'
 * Configuração das colunas de listagem dos post_types core.
 * 
 */
//add_filter('manage_posts_columns', 'control_posts_columns');
function control_posts_columns( $posts_columns ){
	$posts_columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Título',
		'author' => 'Autor',
		'categories' => 'Categorias',
		'tags' => 'Tags',
		'thumb' => 'Imagem de destaque',
		'comments' => '<div class="vers"><img alt="Comentários" title="Comentários" src="' . get_bloginfo('wpurl') . '/wp-admin/images/comment-grey-bubble.png"></div>',
		'date' => 'Data',
	);
	return $posts_columns;
}
//add_filter('manage_pages_columns', 'control_pages_columns');
function control_pages_columns( $posts_columns ){
	$posts_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Título",
		"thumb" => "Imagem de destaque",
		"date" => 'Data',
		"order" => 'Ordem',
	);
	return $posts_columns;
}


