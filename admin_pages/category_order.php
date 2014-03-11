<?php
function category_order(){
	$args = array();
	$args[] = array(
		'title' => 'Ordem das Categorias',
		//'desc' => 'Ordenar as categorias dos posts',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'categories_box',
		'title' => 'Categorias',
		//'desc' => 'Ordem das categorias',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'category_order',
				'type' => 'content_order',
				'label' => 'Ordem das categorias:',
				'label_helper' => '<br /><a href="' . admin_url('edit-tags.php?taxonomy=category') . '">clique aqui para ir na tela de editar ou adicionar categorias</a>',
				'options' => array(
					'taxonomy' => array(
						'taxonomy_name' => 'category',
						'hide_empty' => false,
						'orderby' => 'term_order',
						'parent' => 0,
					),
					'save' => array(
						'callback' => 'taxonomy_term_order',
					),
				),
			),
		),
	);
	return $args;
}






