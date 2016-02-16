<?php
/**
 * HTML
 * Bloco de HTML simples, sem input de controle
 * 
 * 
 */

class BFE_extra_element extends BorosFormElement {
	var $valid_attrs = array(
		'id' => '',
		'class' => 'ipt-extra-element',
		'rel' => '',
	);
	
	function set_input( $value = null ){
		return 'Este é um elemento da pasta extra do job';
	}
}