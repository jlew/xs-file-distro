<html>
<head>
<title><?php echo $page_title ?></title>
<link rel='stylesheet' type='text/css' href='<?php echo $this->config->item('base_url');?>/style.css' /> 
</head>
<body>

<div class="navigation">
	<?php echo anchor("/home","Home"); ?> |
	<?php echo anchor("/home/tag","Tag List"); ?> |
	<?php echo anchor("/home/files","File List"); ?> |
	<?php echo anchor("/upload","Upload File"); ?>
</div>
