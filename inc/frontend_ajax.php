<?php
/**
 * FRONTEND AJAX
 * Todos os ajax para o frontend. Esse arquivo necessita ser incluido tanto no admin quanto no frontend, para que possa ser executado corretamente, 
 * já que a url que processará a requisição é http://SITE/wp-admin/admin-ajax.php
 * 
 * NÃO ESQUECER DE ADICIONAR OS DOIS HOOKS DE FRONTEND E ADMIN:

   add_action( 'wp_ajax_AJAX_ACTION', 'PHP_CALLBACK' ); // admin
   add_action( 'wp_ajax_nopriv_AJAX_ACTION', 'PHP_CALLBACK' ); // frontend
   ATENÇÃO: caso seja declarado apenas o 'wp_ajax_nopriv_*', usuário logados no wp não poderão executar esse ajax.
   
   AJAX_ACTION : action inclusa no 'data' enviado pelo ajax: var data { action:'AJAX_ACTION', myvar: 'lorem', othervar: 'ipsum' }
   PHP_CALLBACK: function do php que irá fazer o retorno. Todo o html que deverá ser retornado ao navegador precisa ser executado nessa function.
 * 
 * 
 */





