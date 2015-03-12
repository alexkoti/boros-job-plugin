<?php
function section_general(){
	$args = array();
	$args[] = array(
		'title' => 'Variadas',
		'desc' => get_bloginfo('blogname') . ' - Opções gerais',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'site_options_recaptcha',
		'title' => 'Recaptcha',
		'desc' => 'Chaves para o serviço de captchas',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'recaptcha_publickey',
				'type' => 'text',
				'label' => 'Public Key',
				'size' => 'medium',
			),
			array(
				'name' => 'recaptcha_privatekey',
				'type' => 'text',
				'label' => 'Private Key',
				'size' => 'medium',
			),
		),
	);
	$args[] = array(
		'id' => 'site_options_logged_in_only',
		'title' => 'Acesso',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'logged_in_only',
				'type' => 'checkbox',
				'label' => 'Bloquear o acesso ao frontend apenas para usuários logados',
				'input_helper' => 'Bloquear',
			),
		),
	);
	$args[] = array(
		'id' => 'site_options_analytics',
		'title' => 'Google Analytics',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'google_analytics',
				'type' => 'textarea',
				'size' => 'medium',
				'label' => 'Código do Google Analytics',
				'input_helper' => '<br />Colar tudo, incluindo o <code>&lt;script type=&quot;text/javascript&quot;&gt;&lt;/script&gt;</code>',
			),
		),
	);
	$args[] = array(
		'id' => 'site_options_tests',
		'title' => 'Testes',
		'desc' => 'Opções para facilitar os testes de formulários. Usar apenas no ambiente de teste(<code style="font-weight:bold;font-style:normal;">localhost</code>) <br /><strong>Tenha muito cuidado ao modificar estas opções!</strong>',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'frontend_forms_test_mode',
				'type' => 'checkbox',
				'label' => 'Modo de testes para formulários',
				'label_helper' => 'Os dados dos formulários já virão preenchidos com valores aleatórios para teste.',
				'input_helper' => 'Habilitar test mode para os formulários de frontend <strong style="color:red;">NÃO USAR NO SITE FINAL</strong>',
			),
			array(
				'name' => 'frontend_forms_test_mode_email',
				'type' => 'text',
				'label' => 'Email a ser usado no modo teste',
				'label_helper' => 'Os emails dos testes serão enviados para uma conta do gmail separada para testes.',
				'input_helper' => 'Usar apenas o username, sem <code>@gmail.com</code>. Colocar <code>+</code> no final do username, por exemplo <code>dev.alexkoti+</code>',
			),
		),
	);
	return $args;
}






