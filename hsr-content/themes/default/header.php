<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php get_option('alumni_title'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo stylesheet_dir() . 'style.css'; ?>">
<!--[if IE]>
<link href="ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>

<div id="holder">
<div id="header">
<div id="page-title"><?php get_option('alumni_title'); ?></div>
<div id="page-subtitle"><?php get_option('tagline'); ?></div>
</div>
<div id="nav"><div id="admin-link"><?php admin_link(); ?></div><div id="pagelinks"><?php homepage_link(); ?><?php post_links(true); ?></div></div>