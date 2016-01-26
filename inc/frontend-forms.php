<?php
/**
 * FRONTEND FORMS
 * 
 * 
 * 
 * 
 * 
 */

/**
 * ==================================================
 * NEWSLETTER =======================================
 * ==================================================
 * 
 * 
 */
function borosnews_config(){
	$form_model = array(
		'ipt_nome' => array(
			'db_column' => 'person_name',
			'type' => 'text',
			'label' => 'Nome',
			'placeholder' => 'Seu nome',
			'std' => '',
			'class' => 'required txt',
			'validate' => 'string',
			'required' => true,
			'accept_std' => false,
		),
		'ipt_email' => array(
			'db_column' => 'person_email',
			'type' => 'text',
			'label' => 'E-mail',
			'placeholder' => 'Seu e-mail',
			'std' => '',
			'class' => 'required valid txt',
			'validate' => 'email',
			'required' => true,
			'accept_std' => false,
		),
	);
	return $form_model;
}

