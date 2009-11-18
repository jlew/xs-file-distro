<html>
<head>
<title><?php echo $page_title ?></title>
<link rel='stylesheet' type='text/css' href='<?php echo $this->config->item('base_url');?>style.css' /> 
</head>
<body>

<div class="navigation">
	<?php echo anchor("/home","Home"); ?> |
	<?php echo anchor("/home/tag","Tag List"); ?> |
	<?php echo anchor("/home/files","File List"); ?> |
	<?php echo anchor("/upload","Upload File"); ?>
</div>
<div class="search">
<?php
	echo form_open("/home/search");
    echo form_input('search', '');
    echo form_submit('submit', 'Search Files');
?>
</form>
</div>
<?php
    if( isset( $status_message ) && $status_message){
        echo "<p class='status_message'>$status_message</p>";
    }
?>
