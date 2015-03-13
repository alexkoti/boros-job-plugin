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




