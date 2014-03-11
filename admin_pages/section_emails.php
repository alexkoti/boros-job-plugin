<?php
function section_emails(){
	$args = array();
	$args[] = array(
		'title' => 'Configurações de Emails',
		'desc' => 'Configurações dos emails automáticos do sistema e formulário de contato',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'emails_general_box',
		'title' => 'Novo usuário',
		'desc' => 'Configurações gerais',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'email_content_type',
				'type' => 'checkbox',
				'std' => '',
				'label' => '<code>content-type</code> dos emails',
				'label_helper' => 'Ativar para poder enviar emails formatados com HTML e imagens',
				'input_helper' => 'Habilitar <code>text/html</code>',
			),
			array(
				'name' => 'email_from',
				'type' => 'text',
				'size' => 'small',
				'std' => get_bloginfo('admin_email'),
				'label' => 'Email remetente dos emails enviados pelo site',
				'label_helper' => 'Caso não seja preenchido, será usado o email do administrador do site.<br /><br />Este email também receberá os avisos de novo usuário e formulários de contato.',
			),
			array(
				'name' => 'email_from_name',
				'type' => 'text',
				'size' => 'small',
				'std' => get_bloginfo('name'),
				'label' => 'Nome do remetente dos emails enviados pelo site',
				'label_helper' => 'Caso não seja preenchido, será usado o nome do site',
			),
		),
	);
	$args[] = array(
		'id' => 'emails_new_user_box',
		'title' => 'Novo usuário',
		'desc' => 'Email de novo usuário',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'new_user_admin_notification_title',
				'type' => 'text',
				'size' => 'large',
				'std' => '',
				'label' => 'Aviso para o admin : <strong>Título</strong>'
			),
			array(
				'name' => 'new_user_admin_notification_text',
				'type' => 'wp_editor',
				'size' => 'large',
				'std' => '',
				'label' => 'Aviso para o admin : <strong>Texto</strong>',
			),
			array(
				'type' => 'separator',
			),
			array(
				'name' => 'new_user_notification_title',
				'type' => 'text',
				'size' => 'large',
				'std' => 'Seus dados de acesso',
				'label' => 'Aviso para o usuário : <strong>Título</strong>'
			),
			array(
				'name' => 'new_user_notification_text',
				'type' => 'wp_editor',
				'size' => 'large',
				'std' => "Seu usuário [USERNAME]\nSua senha: [SENHA]\n\nEndereço para login: [LINK]",
				'label' => 'Aviso para o usuário : <strong>Texto</strong>',
				'label_helper' => ' Usar os códigos <code>[USERNAME]</code>, <code>[SENHA]</code> e <code>[LINK]</code>, como placeholder do nome do usuário, senha e link para login. 
									Eles serão substituídos pelos dados corretos ao ser enviado o email. <br /><br />
									<code>[USERNAME]</code> - será trocado pelo nome do usuário <br /><br />
									<code>[SENHA]</code> - será trocado pela senha escolhida pelo usuário <br /><br />
									<code>[LINK]</code> - será trocado pelo link do questionário
									',
			),
		),
	);
	$args[] = array(
		'id' => 'emails_retrieve_box',
		'title' => 'Recuperação de senha',
		'desc' => 'Email de recuperação de senha',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'retrieve_password_title',
				'type' => 'text',
				'size' => 'large',
				'std' => '',
				'label' => 'Título'
			),
			array(
				'name' => 'retrieve_password_intro',
				'type' => 'wp_editor',
				'size' => 'large',
				'std' => '',
				'label' => 'Texto de introdução',
				'label_helper' => 'O WordPress possui um texto padrão com as instruções para recuperação de senha(que não pode ser mudado). Esse texto padrão poderá ser precedido pelo texto cadastrado aqui.'
			),
		),
	);
	return $args;
}






