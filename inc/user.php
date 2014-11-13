<?php
/**
 * CONFIGURAÇÔES DE USUÁRIOS
 * Configuração de novas funcionalidades para usuários
 * 
 * 
 * 
 */



/**
 * ==================================================
 * CONTACT METHODS ==================================
 * ==================================================
 * Para informações simples, que necessitem apenas de um text field sem necessidade de manipulação(validação, filtragem, etc)
 * Caso seja preciso usar campos mais complexos, usar os campos extras 'show_extra_profile_fields()'
 */
add_filter( 'user_contactmethods', 'custom_contact_methods' );
function custom_contact_methods( $contactmethods ){
	// adicionar
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['twitter']  = 'Twitter';
	$contactmethods['hangouts'] = 'Hangouts';
	$contactmethods['linkedin'] = 'LinkedIn';
	
	// remover
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}



/**
 * ==================================================
 * CAMPOS EXTRAS NO PROFILE =========================
 * ==================================================
 * 
 * 
 */
add_action( 'admin_init', 'custom_user_metas' );
function custom_user_metas(){
	$user_meta_boxes = array();
	
	if( current_user_can('edit_posts') ){
		$user_meta_boxes['admin_user_options_box'] = array(
			'id' => 'admin_user_options_box', 
			'title' => 'Opções', 
			//'desc' => '',
			//'help' => '',
			'itens' => array(
				array(
					'name' => 'show_debug',
					'type' => 'checkbox',
					'label' => 'Mostrar debug de rodapé',
					'input_helper' => 'mostrar',
				),
			)
		);
	}
	
	/**
	if( current_user_can('edit_posts') ){
		$user_meta_boxes['author_photo_box'] = array(
			'id' => 'author_photo_box', 
			'title' => 'Foto', 
			//'desc' => 'Dados extras do usuário, foto, etc',
			//'help' => 'HELP aoiusy daysdiasy diuasy diuy',
			'itens' => array(
				array(
					'name' => 'user_photo',
					'type' => 'special_image',
					'label' => 'Foto',
					'options' => array(
						'image_size' => 'thumbnail',
						'layout' => 'large',
						'width' => 150,
					),
				),
			)
		);
	}
	
	$user_id = boros_user_profile_page_user_id();
	$user_meta_boxes['user_meta_box'] = array(
		'id' => 'user_meta_box', 
		'title' => 'Dados extras', 
		'itens' => array(
			array(
				'name' => 'rg',
				'type' => 'text',
				'size' => 'small',
				'label' => 'RG',
			),
			array(
				'name' => 'cpf',
				'type' => 'text',
				'label' => 'CPF',
				'size' => 'small',
				'validate' => array(
					'required' => array(
						'rule' => 'required',
						'message' => "É preciso preencher seu CPF. \n",
					),
					'cpf' => array(
						'rule' => 'cpf',
						'message' => "É preciso preencher um CPF válido. \n",
					),
					'cpf_unique' => array(
						'rule' => 'cpf_unique',
						'message' => "Este CPF já está sendo usado por outro usuário. \n",
						'args' => array(
							'user_id' => $user_id,
						)
					),
				),
			),
			
			array(
				'name' => 'celular',
				'type' => 'text',
				'size' => 'small',
				'label' => 'Celular',
			),
			array(
				'name' => 'ddd',
				'type' => 'text',
				'size' => 'tiny',
				'label' => 'DDD',
			),
			array(
				'name' => 'telefone',
				'type' => 'text',
				'size' => 'small',
				'label' => 'Telefone',
			),
			
			array(
				'name' => 'endereco',
				'type' => 'text',
				'size' => 'medium',
				'label' => 'Endereço',
			),
			array(
				'name' => 'numero',
				'type' => 'text',
				'size' => 'tiny',
				'label' => 'Número',
			),
			array(
				'name' => 'complemento',
				'type' => 'text',
				'size' => 'tiny',
				'label' => 'Complemento',
			),
			
			array(
				'name' => 'cidade',
				'type' => 'text',
				'size' => 'small',
				'label' => 'Cidade',
			),
			array(
				'name' => 'estado',
				'type' => 'text',
				'size' => 'small',
				'label' => 'Estado',
			),
			array(
				'name' => 'cep',
				'type' => 'text',
				'size' => 'small',
				'label' => 'CEP',
			),
		)
	);
	/**/
	
	$custom_user_metas = new BorosUserMeta($user_meta_boxes);
}



/**
 * BLOCOS DE HTML LIVRE
 * Estes blocos podem exibir HTML livre em determinadas partes da página de profile.
 * 
 */
//add_action( 'personal_options', 'custom_personal_options' );
function custom_personal_options( $profileuser ){
	global $current_user;
	?>
	<tr>
		<th colspan="2">
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio enim, molestie non, pretium ut, fringilla vel, libero. Nam adipiscing ultricies nisl. Sed ornare. Vivamus sodales congue ligula. Nunc purus nulla, consectetuer non, sollicitudin a, tincidunt non, arcu. Nam purus urna, consequat eu, mattis scelerisque, facilisis eu, leo. Nulla facilisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer libero diam, eleifend et, vestibulum non, scelerisque ut, ipsum. Ut dictum mattis libero. Duis quis arcu vel elit ultrices ornare. Donec neque dui, auctor eget, aliquet quis, tempus id, sem. Fusce sapien.</p>
			<p>Duis lectus eros, elementum vitae, egestas eu, pharetra quis, nisl. Pellentesque viverra. Pellentesque id mauris gravida metus ultricies tincidunt. Mauris adipiscing ante eu nisl. Nullam placerat pede id sem. Fusce nonummy accumsan urna. Nunc sodales tristique diam. Morbi mollis. Nam eget nisl vel ante iaculis nonummy. Praesent ultricies consequat purus. Integer eu felis. Donec id pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce non libero.</p>
		</th>
	</tr>
	<?php
}
//add_action( 'profile_personal_options', 'custom_profile_personal_options' );
function custom_profile_personal_options( $profileuser ){
	?>
	<h4>Texto de introdução ao profile</h4>
	<p>Duis lectus eros, elementum vitae, egestas eu, pharetra quis, nisl. Pellentesque viverra. 
	Pellentesque id mauris gravida metus ultricies tincidunt. Mauris adipiscing ante eu nisl. Nullam placerat pede id sem. 
	Fusce nonummy accumsan urna. Nunc sodales tristique diam. Morbi mollis. Nam eget nisl vel ante iaculis nonummy.</p>';
	<?php
}


/**
 * ==================================================
 * ADICIONAR CSS THEMA DO ADMIN =====================
 * ==================================================
 * 
 * 
 */
//add_action( 'init', 'custom_admin_theme' );
function custom_admin_theme(){
	wp_admin_css_color('wpmodel', 'WPMODEL', get_bloginfo('template_url').'/functions/css/admin_theme_css.php', array('#4F2700', '#996633', '#FFEED9', '#F8D89F'));
}



/**
 * DEPRECATED!!! Não existe function substituta.
 * Filtrar o output da descrição de user ao editar com tinymce
 * 
 */
//add_filter( 'edit_user_description', 'user_description_edit', 10, 2 );
function user_description_edit( $value, $user_id ){
	return format_to_post($value );
}
//add_filter( 'pre_user_description', 'user_description_presave', 20 );
//remove_filter( 'pre_user_description', 'wp_filter_kses');
function user_description_presave( $value ){
	return format_to_post( $value);
}
