<?php
/**
 * ==================================================
 * WORK CSS/JS ======================================
 * ==================================================
 * CSS e JS para o admin do trabalho.
 * NÃO ESQUECER A CONSTANTE DE CAMINHO!!!
 * 
 */
add_filter( 'admin_head', 'custom_admin_head' );
function custom_admin_head(){
	wp_enqueue_script( 'custom_admin_scripts', BOROS_BASE_URL . 'js/work.js', array('jquery') );
	wp_enqueue_style( 'custom_admin_styles', BOROS_BASE_URL . 'css/work.css' );
}


