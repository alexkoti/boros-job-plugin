<?php
/**
 * CONFIGURAÇÔES DE ADMIN: DASHBOARD
 * Configurações para o dashboard, controle de widgets
 * 
 * 
 * 
 */

/* ========================================================================== */
/* ADD ACTIONS/FILTERS ====================================================== */
/* ========================================================================== */
//CUSTOM
add_action('wp_dashboard_setup', 'manage_dashboard_widgets' );

//Widget com form-ajax
add_action('admin_head', 'destaque_principal_script');
add_action('wp_ajax_destaque_principal_save', 'destaque_principal_save');



/* ========================================================================== */
/* DASHBOARD ================================================================ */
/* ========================================================================== */
/**
 * Organizar widgets do dashboard
 * Para adicionar novos widgets é preciso usar wp_add_dashboard_widget() dentro dessa função
 * 
 * @link	http://hankis.me/modifying-the-wordpress-dashboard/
 */
function manage_dashboard_widgets() {
	global $wp_meta_boxes;
	//pre($wp_meta_boxes);
	
	// registrar os custom dashboards
	wp_add_dashboard_widget('dashboard_rascunhos_recentes', 'Rascunhos Recentes', 'dashboard_rascunhos_recentes');
	wp_add_dashboard_widget('site_shortcuts', 'Atalhos', 'dashboard_shortcuts');
	// armazenar temporariamente
	$dashboard_rascunhos_recentes = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_rascunhos_recentes'];
	$site_shortcuts = $wp_meta_boxes['dashboard']['normal']['core']['site_shortcuts'];
	
	$dashboard_right_now = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
	$dashboard_recent_comments = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'];
	
	// remove all cores
	foreach( $wp_meta_boxes['dashboard']['normal']['core'] as $dashboard_key => $dashboard_vals ){
		unset( $wp_meta_boxes['dashboard']['normal']['core'][$dashboard_key] );
	}
	// remove all sides
	foreach( $wp_meta_boxes['dashboard']['side']['core'] as $dashboard_key => $dashboard_vals ){
		unset( $wp_meta_boxes['dashboard']['side']['core'][$dashboard_key] );
	}
	// remove all dashboards
	//unset($wp_meta_boxes['dashboard']['normal']['core']);
	//unset($wp_meta_boxes['dashboard']['side']['core']);
	
	// readicionar os custons
		// coluna esquerda
	$wp_meta_boxes['dashboard']['normal']['core'][] = $dashboard_right_now;
    $wp_meta_boxes['dashboard']['normal']['core'][] = $site_shortcuts;
		// coluna direita
	$wp_meta_boxes['dashboard']['side']['core'][] = $dashboard_recent_comments;
	$wp_meta_boxes['dashboard']['side']['core'][] = $dashboard_rascunhos_recentes;
	//pre($wp_meta_boxes['dashboard']);
}



/* ========================================================================== */
/* DASHBOARD WIDGETS ======================================================== */
/* ========================================================================== */
// Widget com seleção de posts
function dashboard_rascunhos_recentes(){
	global $wpdb, $post;
	$total_rascunhos = $wpdb->get_col(
		$wpdb->prepare("
			SELECT id 
			FROM $wpdb->posts 
			WHERE `post_status` = %s
			AND `post_type` = %s
		",
		'draft', 'post'
		)
	);
	//pre($total_perguntas);
	
	$query = array(
		'post_type' => 'post',
		'post_status' => 'draft',
		'posts_per_page' => 10
	);
	$rascunhos = new WP_Query();
	$rascunhos->query($query);
	if( $rascunhos->posts ){
		?>
		<p><a href="edit.php?post_status=draft&post_type=post" class="alignright">Ver todos os rascunhos (<?php echo count($total_rascunhos); ?>)</a>10 rascunhos mais recentes: </p>
		<ul id="pergunta_lista">
		<?php
		foreach($rascunhos->posts as $post){
			setup_postdata($post);
			?>
			<li class="pergunta_item">
				<h4><?php echo apply_filters('the_title', $post->post_title); ?> <a href="<?php echo "post.php?post={$post->ID}&action=edit";?>" class="small_text">editar</a></h4>
				<div class="pergunta_content">
					<?php the_excerpt(); ?>
				</div>
			</li>
			<?php
		}
		?>
		</ul>
		<?php
		wp_reset_query();
	}
	else{
		?>
		<p><a href="edit.php?post_type=post" class="alignright">ver todos os posts</a> Todos os posts estão publicados!</p>
		<?php
	}
}

// Widget com conteúdo estático
function dashboard_shortcuts(){
	?>
	<p>Abaixo alguns atalhos para as páginas de configuração mais importantes:</p>
	<ol>
		<li><a href="<?php echo admin_url('/admin.php?page=section_general'); ?>">Opções gerais</a></li>
		<li><a href="<?php echo admin_url('/admin.php?page=section_networks'); ?>">Configurações das redes sociais</a></li>
		<li><a href="<?php echo admin_url('/admin.php?page=section_emails'); ?>">Configurações dos emails</a></li>
	</ol>
	<?php
}



/**
 * Dashbboard Widget com form ajax
 * 
 */
function destaque_principal_function(){
?>
	<form id="destaque_principal_form">
		<table>
			<tr>
				<td style="padding:0 20px 0 0;"><label for="destaque_principal_text">Texto</label></td>
				<td><input type="text" name="destaque_principal_text" id="destaque_principal_text" class="regular-text" style="width:400px;" value="<?php echo get_option('destaque_principal_text'); ?>" /></td>
			</tr>
			<tr>
				<td style="padding:0 20px 0 0;"><label for="destaque_principal_link">Link</label></td>
				<td><input type="text" name="destaque_principal_link" id="destaque_principal_link" class="regular-text" style="width:400px;" value="<?php echo get_option('destaque_principal_link'); ?>" /></td>
			</tr>
			<tr>
				<td style="padding:0 20px 0 0;"><input type="submit" value="ok" class="button-primary" id="destaque_principal_form_submit"></td>
				<td id="destaque_principal_status"></td>
			</tr>
		</table>
	</form>
<?php
}
// adicionar ajax do dashboard widget
function destaque_principal_script() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	
	$('#destaque_principal_form').submit(function(){
		$('#destaque_principal_status').html('<span style="color:#E66F00;">Salvando dados</span>');
		var data = {
			action: 'destaque_principal_save',
			text: $('#destaque_principal_text').val(),
			link: $('#destaque_principal_link').val()
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			$('#destaque_principal_status').html(response);
		});
		return false;
	});
	
});
</script>
<?php
}
// salvar dados do dashboard widget
function destaque_principal_save() {
	global $wpdb; // this is how you get access to the database
	$text = $_POST['text'];
	$link = $_POST['link'];
	
	update_option('destaque_principal_text', $text);
	update_option('destaque_principal_link', $link);
	
	echo '<span style="color:green;">Novos dados gravados</span>';
	die(); // this is required to return a proper result
}