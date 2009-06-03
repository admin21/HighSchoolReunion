<?php
function site_head($title) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.php" rel="stylesheet" type="text/css" />
<title><?php echo $title; ?></title>
<script language="javascript" type="text/javascript" src="../hsr-includes/js/tiny_mce/tiny_mce.js"></script>

	<script language="javascript" type="text/javascript">tinyMCE.init({ 

	mode : "textareas",

	theme: "advanced",

	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink,|,outdent,indent,blockquote,|",

	theme_advanced_buttons2 : "",

	theme_advanced_buttons3 : "",

	theme_advanced_toolbar_location : "top",

	theme_advanced_toolbar_align : "left",

	theme_advanced_statusbar_location : "bottom",

	theme_advanced_resizing : true

 });</script>
</head>

<body>
<?php
}

function site_footer() {
?>
    </body>
    </html>
    
<?php } ?>