<?php

require('../hsr-config.php');
include('header_footer.php');
include('../hsr-includes/login_funcs.php');

if (!user_isloggedin()) {
	header("Location: login.php");
}

$username = $_GET['username'];

$header = $site_name . ' &raquo; ' . $username;

site_head($header);
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_jumpMenuGo(selName,targ,restore){ //v3.0
  var selObj = MM_findObj(selName); if (selObj) MM_jumpMenu(targ,selObj,restore);
}
//-->
</script>

<div id="holder">

<div id="left" class="column">
<div id="gen-info" class="box">
<h4>General Info</h4>
<?php general_info($username); ?>
</div>
<div id="contact-info" class="box">
<h4>Contact Info</h4>
<?php contact_info($username); ?>
</div>
</div>
<div id="right" class="column">
<?php if(is_userlinks($username)): ?>
<div id="websites" class="box">
<h4>Websites</h4>
<?php user_links($username); ?>
</div>
<?php endif; ?>
<div id="lastten" class="box">
<?php user_lastten($username); ?>
</div>
</div>
</div>
<?php
site_footer();

?>