<?php
function section_dummy_content(){
	$args = array();
	$args[] = array(
		'title' => 'Criar conteúdo de testes',
		'desc' => '',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'dummy_content_box',
		'title' => 'Criar páginas',
		'desc' => 'Criar páginas em formato hierárquico. Uma página por linha, sub-paginas deverão ser indicadas por hífen, modelo: <br /><code style="font-style:normal;">Home<br />Stories<br />Store<br />- Software<br />- Freebies<br />About<br />- Team<br />-- Jane Doe<br />-- John Doe<br />- Bio<br />Contact<br />- Form</code>',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'dummy_pages',
				'type' => 'textarea',
				'label' => 'Páginas',
				'layout' => 'block',
				//'callbacks' => array(
				//	'success' => array(
				//		'boros_create_dummy_pages' => array(),
				//	),
				//),
			),
			array(
				'name' => 'dummy_html_temp',
				'type' => 'html',
				'html' => $foo,
				'label' => 'Test',
				'layout' => 'block',
			),
		),
	);
	$args[] = array(
		'id' => 'dummy_content_submit_box',
		'block' => 'submit',
		'submit_type' => 'custom',
		'options' => array(
			'text' => 'Criar conteúdo',
			'class' => 'button-primary',
			'html' => false,
		),
	);
	return $args;
	
	
	//$lipsum = wp_remote_get('http://loripsum.net/api/14/short/headers/medium/decorate/ul/ol/bq/');
	//$foo = wp_remote_retrieve_body($lipsum);
	
	require_once( BOROS_FUNCTIONS . 'generator-dummy-content.php' );
	
	$pages = 'Home
Stories
Store
- Software
- Freebies
About
- Team
-- Jane Doe
-- John Doe
- Bio
Contact
- Form';
	$quick_pages = new BorosQuickPages($pages);
	$foo = $quick_pages->create_multilevel_pages_array();
	
	
	return $args;
}


