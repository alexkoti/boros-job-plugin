<?php
add_filter( 'new_user_admin_notification_text', 'boros_email_base' );
add_filter( 'new_user_notification_text', 'boros_email_base' );
add_filter( 'retrieve_password_message_text', 'boros_email_base' );

function boros_email_base( $message ){
$sitename = get_bloginfo('name');

$BASE = <<<BASE
<table>
	<tr>
		<th>Site:</th>
		<td>{$sitename}</td>
	</tr>
	<tr>
		<th>Mensagem:</th>
		<td>{$message}</td>
	</tr>
</table>
BASE;
return $BASE;
}

