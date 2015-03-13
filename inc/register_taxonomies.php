<?php
/**
 * REGISTER TAXONOMIES
 * Configurações para adicionar custom taxonomies e colunas de exibição.
 * Este arquivo trabalha em conjunto com o 'register_post_types.php'
 * 
 */

/**
 * ==================================================
 * REGISTER TAXONOMIES ==============================
 * ==================================================
 * 
 * 
 */
//add_action('init', 'register_taxonomies');
function register_taxonomies(){
	/**
	MODELOS DE LABELS ================================
	
	GERAL
	$labels = array(
		'name' => 'Categorias',
		'singular_name' => 'Categoria',
		'search_items' => 'Buscar Categoria',
		'popular_items' => 'Categorias Populares',
		'all_items' => 'Todas as Categorias',
		'edit_item' => 'Editar Categoria',
		'update_item' => 'Atualizar Categoria',
		'add_new_item' => 'Adicionar nova Categoria',
		'new_item_name' => 'Nome da nova Categoria',
	);
	
	HIERARCHICAL
	$labels = array(
		// >>> hierarchical labels
		'parent_item' => 'Categoria Mãe',
		'parent_item_colon' => 'Categoria Mãe:',
	);
	NON-HIERARCHICAL
	$labels = array(
		// >>> NON hierarchical labels
		'separate_items_with_commas' => 'Separar Categorias com vírgulas',
		'add_or_remove_items' => 'Adicionar ou remover Categorias',
		'choose_from_most_used' => 'Selecionar das Categorias mais usadas',
	);
	 ==================================================
	*/

	/**
	 * REGIÕES
	 * 
	 */
	$labels = array(
		'name' => 'Regiões',
		'singular_name' => 'Região',
		'search_items' => 'Buscar Região',
		'popular_items' => 'Regiões Populares',
		'all_items' => 'Todas as Regiões',
		'edit_item' => 'Editar Região',
		'update_item' => 'Atualizar Região',
		'add_new_item' => 'Adicionar nova Região',
		'new_item_name' => 'Nome da nova Região',
		// >>> hierarchical labels
		'parent_item' => 'Região Pai',
		'parent_item_colon' => 'Região Pai:',
	); 
	register_taxonomy('regiao', array('post', 'noticia'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'public' => true,
		'query_var' => 'regiao',
		'capabilities' => array(
			'manage_terms' => 'manage_categories',
			'edit_terms'   => 'manage_categories',
			'delete_terms' => 'manage_categories',
			'assign_terms' => 'edit_posts',
		),
		'rewrite' => array(
			'slug' => 'regiao',
			'hierarchical' => true
		),
	));
}

/**
 * ==================================================
 * APPEND TAXONOMIES ================================
 * ==================================================
 * Adicionar taxonomias já declaradas(em geral 'categories') a um post_type.
 * 
 */
//add_action( 'init', 'register_categories_to_custom_post_type' );
function register_categories_to_custom_post_type(){
	register_taxonomy_for_object_type( 'category', 'noticia' );
	register_taxonomy_for_object_type( 'post_tag', 'noticia' );
}

/**
 * ==================================================
 * TAXONOMY META CONFIG =============================
 * ==================================================
 * Configurar os termmetas das taxonomias
 * 
 */
//add_action('admin_init', 'my_add_taxonomy_meta');
function my_add_taxonomy_meta(){
	$taxonomy_meta = array();
	$taxonomy_meta['category'] = array(
		'itens' => array(
			array(
				'name' => 'alias_pt',
				'type' => 'text',
				'label' => '<img src="'.BOROS_IMG.'/flag_br.png" alt="" /> Nome de exibição no menu:',
			),
			array(
				'name' => 'alias_en',
				'type' => 'text',
				'label' => '<img src="'.BOROS_IMG.'/flag_uk.png" alt="" /> Nome de exibição no menu:',
			),
		),
	);
	$my_term_metas = new BorosTermMeta( $taxonomy_meta );
}

/**
 * ==================================================
 * TAXONOMY COLUMNS =================================
 * ==================================================
 * Configurar as colunas de listagem das taxonomias.
 * 
 * Colunas padrão:
<code>
'tax_name' = array(
	'cb' => <input type="checkbox" />,
	'name' => Nome,
	'description' => Descrição,
	'slug' => Slug,
	'posts' => Posts,
)
</code>
 * 
 * Existem dois modelos dinâmicos de chave pré-configurados:
 * - termmeta_{term_name} - faz a busca do termmeta correspondente e exibe em um span
 * - function_{function_name} - callback, com os parâmetros $taxonomy e $term_id
 * 
 * Lista de chaves customizadas
 * @TODO image, order
 * 
 */
//add_action('admin_init', 'my_taxonomy_columns');
function my_taxonomy_columns(){
	$columns = array(
		'category' => array(
			'cb' => '<input type="checkbox" />',
			'name' => 'Nome da Categoria',
			'term_color' => 'Cor',
			'posts' => 'Posts',
		),
	);
	new BorosTaxonomyColumns( $columns );
}

/**
 * Função callback de renderização de coluna
 * 
 */
//add_action( 'boros_custom_taxonomy_column', 'boros_custom_taxonomy_column', 10, 3 );
function boros_custom_taxonomy_column( $taxonomy, $term_id, $column_name ){
	if( $column_name == 'term_color' ){
		$colors = get_option('colors');
		$term_color = get_metadata( 'term', $term_id, 'term_color', true );
		if( !empty($term_color) ){
			//pal($term_color);
			$term_color = str_replace( 'bg-color-type-', '', $term_color );
			$color_name = $colors[$term_color]['color_name'];
			$color_code = $colors[$term_color]['color_code'];
			echo "<div style='width:25px;height:25px;background:{$color_code}'></div>{$color_name}";
		}
	}
}

/**
 * ==================================================
 * CUSTOM POST TYPES IN CORE TAXONOMIES QUERIES =====
 * ==================================================
 * Adicionar as custom taxonomies às querys de categora padrão. Por exemplo, um post_type artigo, que também esteja na taxonomia category, poderá aparecer na listagem de category
 * STATIC: não precisa editar essa function.
 * 
 * @link	http://wordpress.org/support/topic/adding-custom-post-type-to-the-loop-wp-nav-menu-dissapears#post-1583396
 * @link	http://wordpress.org/support/topic/custom-post-type-tagscategories-archive-page#post-1786990
 */
add_filter( 'pre_get_posts', 'append_custom_post_types_to_category_query' );
function append_custom_post_types_to_category_query( $query ){
	if( !is_admin() ){
		if( is_category() || is_tag() ){
			$post_type = get_query_var('post_type');
			if($post_type)
				$post_type = $post_type;
			else
				$post_type = get_post_types();
			$query->set( 'post_type',$post_type );
			return $query;
		}
	}
	return $query;
}



/* ========================================================================== */
/* DROPDOWN FILTER ========================================================== */
/* ========================================================================== */
/**
 * Adds taxonomy filter to post_type list in admin edit.php
 * Without filter echo only hierarchical taxonomies
 * 
 * @param string $post_type
 */
function taxonomy_dropdown_filters( $post_type ){
	// filter
	$accepted_taxonomies = true;
	$accepted_taxonomies = apply_filters("{$post_type}-taxonomy_dropdown_filters", $accepted_taxonomies);
	if( empty($accepted_taxonomies) )
		return false;
		
	// get all taxonomies associated to post_type
	$post_type_taxonomies = get_object_taxonomies($post_type);
	
	// loop through all taxonomies
	foreach( $post_type_taxonomies as $tax ){
		$args = array('name' => $tax);
		$taxonomy = get_taxonomies( $args, 'object' );
		
		// only custom
		if( is_array($accepted_taxonomies) ){
			if( in_array($tax, $accepted_taxonomies) ){
				taxonomy_dropdown( $taxonomy[$tax] );
			}
		}
		// only hierarchical, but without padding
		else{
			if( $taxonomy[$tax]->hierarchical == true ){
				taxonomy_dropdown( $taxonomy[$tax] );
			}
		}
	}
}

/**
 * Create dropdown filter for taxonomy
 * 
 * @param object $taxonomy
 */
function taxonomy_dropdown( $taxonomy ){
	$args = array('hide_empty' => false);
	$terms = get_terms( $taxonomy->name, $args );
	
	if( $terms ){
		echo '<select name="' . $taxonomy->name . '">';
		echo '<option value="0">' . $taxonomy->labels->all_items . '</option>';
		foreach( $terms as $term ){
			$selected = selected($_GET[$taxonomy->name], $term->slug, false);
			echo '<option value="' . $term->slug . '"' . $selected . '>' . $term->name . '</option>';
		}
		echo '</select>';
	}
}


// FILTER EXAMPLES
// Example A) add hierarchical and non-hierarchical taxonomies
//add_filter('artigo-taxonomy_dropdown_filters', 'artigos_dropdown_filters');
function artigos_dropdown_filters( $accepts ){
	$accepts = array( 'secao', 'palavras' );
	return $accepts;
}

// Example B) add only one non-hierarchical taxonomy
add_filter('depoimento-taxonomy_dropdown_filters', 'depoimento_dropdown_filters');
function depoimento_dropdown_filters( $accepts ){
	$accepts = array( 'profissao' );
	return $accepts;
}

// Example C) remove all dropdown filters
//add_filter('books-taxonomy_dropdown_filters', 'remove_books_dropdown_filters');
function remove_books_dropdown_filters( $accepts ){
	return false;
}

// Example D) add tags dropdown to core posts
add_filter('post-taxonomy_dropdown_filters', 'post_tags_dropdown_filters');
function post_tags_dropdown_filters( $accepts ){
	$accepts = array( 'post_tag' );
	return $accepts;
}
