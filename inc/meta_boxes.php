<?php
/**
 * ==================================================
 * META BOXES CONFIGURAÇÂO ==========================
 * ==================================================
 * 
 */
add_action( 'admin_init', 'my_meta_boxes' );
function my_meta_boxes(){
	$meta_boxes = array();
	$meta_boxes[] = array(
		'id' => 'post_special_image_box', 
		'title' => 'Imagem do Post', 
		'post_type' => array('post'), 
		'context' => 'side', 
		'priority' => 'default',
		'help' => 'Você poderá enviar uma nova imagem ou escolher entre as imagens deste post ou uma da biblioteca.',
		'itens' => array(
			array(
				'name' => '_thumbnail_id',
				'type' => 'special_image',
				'layout' => 'block',
				'options' => array(
					'layout' => 'compact',
					'width' => false,
				),
			),
		)
	);
	$meta_boxes[] = array(
		'id' => 'post_category_box', 
		'title' => 'Categoria do Post', 
		'post_type' => array('post'), 
		'context' => 'side', 
		'priority' => 'default',
		'itens' => array(
			array(
				'name' => 'post_category',
				'type' => 'taxonomy_checkbox',
				'layout' => 'block',
				'options' => array(
					'taxonomy' => 'category',
					'force_hierachical' => true,
				)
			),
		)
	);
	$meta_boxes[] = array(
		'id' => 'video_box', 
		'title' => 'Vídeo do post', 
		'post_type' => array('post'), 
		'context' => 'normal', 
		'priority' => 'default',
		'itens' => array(
			array(
				'name' => 'video_url',
				'type' => 'text',
				'size' => 'full',
				'label' => 'Endereço do vídeo',
				'label_helper' => 'Vídeos privados não poderão ser exibidos',
				'input_helper' => '<br />Serviços suportados: YouTube, Vimeo, DailyMotion, blip.tv, Flickr(fotos e vídeo), Viddler, Hulu, Qik, Revision3, Scribd, Photobucket, PollDaddy',
			),
		)
	);
	$meta_boxes[] = array(
		'id' => 'links_box', 
		'title' => 'Links úteis', 
		'post_type' => array('post'), 
		'context' => 'normal', 
		'priority' => 'default',
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
	$meta_boxes[] = array(
		'id' => 'related_box', 
		'title' => 'Conteúdo relacionado', 
		'post_type' => array('post'), 
		'context' => 'normal', 
		'priority' => 'default',
		'itens' => array(
			array(
				'name' => 'related_type',
				'type' => 'radio',
				'label' => 'Tipo de conteúdo relacionado',
				'std' => 'most_recent_in_parent_category',
				'options' => array(
					'values' => array(
						'most_recent_in_category' => 'Mais recentes na mesma categoria',
						'most_recent_in_parent_category' => 'Mais recentes na mesma categoria principal',
						'most_viewed_in_category' => 'Mais vistos na mesma categoria',
						'most_viewed_in_parent_category' => 'Mais vistos na mesma categoria principal',
						'related_selected_contents' => 'Escolher conteúdos específicos abaixo',
					),
				),
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
		)
	);
	$my_meta_boxes = new BorosMetaBoxes( $meta_boxes );
}

/* ========================================================================== */
/* REMOVER META BOXES ======================================================= */
/* ========================================================================== */
/**
 * Remover meta_boxes das telas de edição. As custom taxonomies são removidas nessa função em vez da declaração 'show_ui' => false',
 * pois assim é exibida as páginas de controle das taxonomias no menu principal, mas removendo os controles de histórias 
 * das páginas de edição.
 * 
 * Padrão de nomenclatura:
 * Hierachical Taxonomy:		"{$tax-name}div"
 * Non-Hierachical Taxonomy:	"tagsdiv-{$tax-name}"
 */
add_action('do_meta_boxes', 'remove_custom_meta_boxes', 10, 3);
function remove_custom_meta_boxes( $post_type, $context, $post ){
	global $wp_meta_boxes, $post;
	//pre($wp_meta_boxes);
	
	$removes = array(
		'post' => array(
			'postimagediv',
			'categorydiv',
		),
	);
	
	if( isset($removes[$post_type]) ){
		foreach( $removes[$post_type] as $box ){
			remove_meta_box( $box, $post_type, $context );
		}
	}
}

