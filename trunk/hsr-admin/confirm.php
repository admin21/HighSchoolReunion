<?php

/****************************************************
 * New user confirmation page. Should only get here *
 * from an email link.								*
 ****************************************************/
 
include_once('header_footer2.php');
require_once('../hsr-includes/register_funcs.php');
require_once('../hsr-config.php');
 
site_head('Account Confirmation');
 
if ($_GET['hash'] && $_GET['email']) {
 	$worked = user_confirm();
} else {
	$feedback_str ="<p class=\"errormess\">ERROR: Bad link</p>";
}

if ($worked != 1) {
	$noconfirm = '<p class=\"errormess\">Something went wrong. ' . // added slashed to "errormess"
		'Send email to ' . $admin_email . ' for help. If you got ' .
		'through to this page directly, please go to login.php ' .
		'instead.</p>';
} else {
	$confirm = '<p class="big">You are now confirmed. <a ' .
		'href=login.php>Log in</a> to start browsing the ' . // added slashes to "login.php"
		'site.</p>';
		
}
?>

<table cellpadding=0 cellspacing=0 border=0 align=center // change from table // change to real image
width=621>
<tr>
	<td><img width=15 height=1 src="../images/spacer.gif"></td> 
	<td width=606 class=left>
		<?php echo $feedback_str; ?>
		<?php echo $noconfirm; ?>
		<?php echo $confirm; ?>
		</td>
	</tr>
	</table>

<?php site_footer(); ?>