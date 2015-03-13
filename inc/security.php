<?php
/**
 * ==================================================
 * SECURITY =========================================
 * ==================================================
 * Funções para melhorar a segurança do WordPress. A maioria dos itens usados são de artigos e tutoriais encontrados na internet.
 * 
 * Neste arquivo estão os filtros e functions específicos para cada projeto, que podem precisar de configuração ou ser opcionais.
 * 
 * 
 */



/**
 * Desabilitar a XML-RPC API, que é usada para a utilização de clients de blogs externos.
 * 
 * Baseado no plugin "Disable XML-RPC" de 'Solve the Net' e 'Phil Erb'
 * @link https://wordpress.org/plugins/disable-xml-rpc/
 */
add_filter( 'xmlrpc_enabled', '__return_false' );




