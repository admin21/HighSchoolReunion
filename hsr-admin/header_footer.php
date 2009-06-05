<?php
function site_head($title) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.php" rel="stylesheet" type="text/css" />
<title><?php echo $title; ?></title>
<!-- TinyMCE -->
<script type="text/javascript" src="../hsr-includes/js/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "safari,inlinepopups,media,contextmenu,paste,directionality",

		// Theme options
		theme_advanced_buttons1 : "formatselect,|,bold,italic,underline,strikethrough,|,cut,copy,pastetext,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,bullist,numlist,|,outdent,indent,|,|,image,media,|,code,help",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal: false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

</head>

<body>

<?php include('dashboard.php'); ?>
<div id="page">
<?php
}

function site_footer() {
?>
</div>
<div id="footer">
  <div class="bot"><span class="foot-text">High School Reunion | <a href="../privacy-policy.php" target="_blank">Privacy Policy</a> | <a href="http://highschoolreuni.com/docs/">Documentation</a> | <a href="http://highschoolreuni.com/support/">Support</a> | Version <?php echo VERSION; ?> <?php beta_build_number(); ?></span></div>
</div>
</body>
</html>
<?php } ?>