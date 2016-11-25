<?php
function section_content(){
	$args = array();
	$args[] = array(
		'title' => 'Opções gerais de conteúdo',
		'desc' => '',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'site_options_post_format',
		'title' => 'Formatação',
		'desc' => 'Opções padrão de elementos visuais',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'post_default_image',
				'type' => 'special_image',
				'label' => 'Imagem padrão para os posts',
				'label_helper' => 'Será usado quando não existir a imagem de destaque do conteúdo',
			),
			array(
				'name' => 'related_selected_contents',
				'type' => 'search_content_list',
				'label' => 'Selecionar os posts relacionados',
				'options' => array(
					'show_thumbnails' => false,
					'show_excerpt' => true,
					'query_search' => array(
						'post_type' => 'post',
					),
					'query_selecteds' => array(
						'post_type' => 'post',
					),
				),
			),
            array(
                'name' => 'file',
                'type' => 'attach_select',
                'label' => 'Arquivo',
            ),
		),
	);
	$args[] = array(
		'id' => 'links_box', 
		'title' => 'Links úteis', 
		'desc' => '',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'links',
				'type' => 'duplicate_group',
				'label' => 'Links úteis',
				'label_helper' => 'No link, não esquecer o <code>http://</code> no começo do link.<br /><br />Caso não seja preechido o nome, será usado o link como texto.',
				//'layout' => 'block',
				'group_itens' => array(
					array(
						'name' => 'link',
						'type' => 'text',
						'size' => 'full',
						'label' => 'Link',
					),
					array(
						'name' => 'name',
						'type' => 'text',
						'size' => 'full',
						'label' => 'Nome <small>(opcional)</small>',
					),
					array(
						'name' => 'desc',
						'type' => 'text',
						'size' => 'full',
						'label' => 'Descrição',
					),
				)
			),
		)
	);
	return $args;
}






