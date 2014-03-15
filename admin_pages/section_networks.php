<?php
function section_networks(){
	$args = array();
	/**
	 * Array de redes, escrever os nome normalmente, pois serão filtrados para criar os names
	 * Decido crar loop para facilitar a adição/remoção de redes :P
	 * 
	 */
	$networks_data = array();
	$networks = array(
		'Facebook',
		'Twitter',
		'YouTube',
		'Gplus',
		'Flickr',
		'LinkedIn',
	);
	foreach( $networks as $network ){
		$networks_data[] = array(
			'name' => 'network_' . sanitize_title_with_dashes($network),
			'type' => 'text',
			'size' => 'medium',
			'std' => '',
			'label' => "{$network}:"
		);
	}

	$args[] = array(
		'title' => 'Redes Sociais',
		'desc' => get_bloginfo('blogname') . ' - configurações dos links de redes sociais.',
		'block' => 'header',
	);
	
	$args[] = array(
		'id' => 'network_redes',
		'title' => 'Redes Sociais',
		'desc' => 'Links das contas',
		'block' => 'section',
		'itens' => $networks_data,
	);
	
	$args[] = array(
		'id' => 'twitter_api',
		'title' => 'Chaves da API do Twitter',
		'desc' => '',
		'block' => 'section',
		'section' => 'redes_sociais',
		'itens' => array(
			array(
				'name' => 'home_feed_tt',
				'type' => 'text',
				'size' => 'tiny',
				'label' => 'Quantidade status do Twitter',
			),
			array(
				'name' => 'twitter_api_key_oauth_access_token',
				'label' => 'Access token',
				'type' => 'text',
				'size' => 'medium',
			),
			array(
				'name' => 'twitter_api_key_oauth_access_token_secret',
				'label' => 'Access token secret',
				'type' => 'text',
				'size' => 'medium',
			),
			array(
				'name' => 'twitter_api_key_consumer_key',
				'label' => 'Consumer key',
				'type' => 'text',
				'size' => 'medium',
			),
			array(
				'name' => 'twitter_api_key_consumer_secret',
				'label' => 'Consumer Secret',
				'type' => 'text',
				'size' => 'medium',
			),
		),
	);
	
	$args[] = array(
		'id' => 'network_opengraph',
		'title' => 'Opengraph e Share Options',
		'desc' => 'Meta informações de compartilhamento[facebook e redes sociais]',
		'block' => 'section',
		'section' => 'redes_sociais',
		'itens' => array(
			array(
				'name' => 'share_active',
				'type' => 'checkbox',
				'std' => '',
				'label' => 'Botões de share',
				'input_helper' => 'Ativar',
			),
			array(
				'name' => 'og_active',
				'type' => 'checkbox',
				'std' => '',
				'label' => 'Opengraph Tags Ativado',
				'label_helper' => 'São as tags de indexação do Facebook',
				'input_helper' => 'Ativar',
			),
			array(
				'name' => 'gplus_active',
				'type' => 'checkbox',
				'std' => '',
				'label' => 'Gplus Tags Ativado',
				'label_helper' => 'São as tags de indexação do G+',
				'input_helper' => 'Ativar',
			),
			array(
				'name' => 'og_image',
				'type' => 'special_image',
				'size' => 'medium',
				'std' => '',
				'label' => 'Imagem padrão:',
				'label_helper' => 'Será usado pelo Facebook e G+',
				'options' => array(
					'image_size' => 'medium',
					'width' => 100,
					'default_image' => BOROS_IMG . '/default_thumbnail_2.jpg',
					'layout' => 'large',
				),
			),
			array(
				'name' => 'fb_admins',
				'type' => 'text',
				'size' => 'medium',
				'label' => 'Lista de admins do Facebook <code>(fb:admins)</code>',
				'label_helper' => 'Caso o site possua uma fanpage no Facebook, preencher este campo com a lista dos IDs dos administradores..',
				'input_helper' => 'Colar as IDs separadas por vírgula:'
			),
			array(
				'name' => 'share_text_twitter',
				'type' => 'text',
				'size' => 'large',
				'label' => 'Texto de share do Twitter:',
				'label_helper' => 'Texto padrão que vem preenchido na caixa de texto do Twitter(poderá ser modificado pelo usuário).',
			),
		),
	);
	
	return $args;
}

