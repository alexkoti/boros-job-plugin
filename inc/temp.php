<?php
/**
 * Apenas functions, actions e filters de teste
 * 
 */

//add_filter( 'whitelist_options', 'DEBUG_whitelist_options', 999 );
function DEBUG_whitelist_options( $whitelist_options ){
	pre($whitelist_options);
	
	return $whitelist_options;
}

function test_1(){

	$args = array();
	$args[] = array(
		'title' => 'Fábrica de elementos',
		'desc' => 'Teste conceitual para um controle de configuração de elementos, ou seja, um controle que cria a configuração de outro controle/page/metabox.',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'my_fac_group',
		'title' => 'Um teste simples com duplicate',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'og_locality',
				'type' => 'text',
				'size' => 'medium',
				'std' => '',
				'label' => 'Cidade:'
			),
			array(
				'name' => 'og_region',
				'type' => 'text',
				'size' => 'medium',
				'std' => '',
				'label' => 'Estado:'
			),
			array(
				'name' => 'my_fac_option',
				'type' => 'duplicate_group',
				'label' => 'Meus elementos',
				'label_helper' => 'Escolha entre os elementos disponíveis',
				//'layout' => 'block',
				'group_itens' => array(
					array(
						'name' => 'my_fac_name',
						'type' => 'text',
						'size' => 'small',
						'label' => 'Name',
					),
					array(
						'name' => 'my_fac_label',
						'type' => 'text',
						'size' => 'medium',
						'label' => 'Label',
					),
					array(
						'name' => 'my_fac_type',
						'type' => 'select',
						'label' => 'Type',
						'dependencies' => array(
							'provider' => true,
							'dependent' => 'my_fac_sec_select',
						),
						'options' => array(
							'values' => array(
								0 => 'Nenhum',
								'animais' => 'Animais',
								'cidades' => 'Cidades',
								'test-parent' => 'Test Parent',
							)
						)
					),
					array(
						'name' => 'my_fac_sec_select',
						'type' => 'factory_options',
						'label' => 'Opções',
						'dependencies' => array(
							'provider' => 'my_fac_type',
							'dependent' => true,
						),
					),
				)
			),
		)
	);
	
	$context = array(
		'option_page' => 'elements_factory',
		'group' => 'my_fac_group',
		'name' => 'my_fac_sec_select',
		'in_duplicate_group' => 1
	);
	$element_config = get_element_config( $args, $context );
	pre( $element_config, 'RESULT' );
}