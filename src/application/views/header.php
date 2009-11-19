<?php	$this->lang->load('header');?><html>
<head>
<title><?php echo $page_title ?></title>
<link rel='stylesheet' type='text/css' href='<?php echo $this->config->item('base_url');?>style.css' /> 
</head>
<body>

<div class="navigation">
	<?php echo anchor("/home", $this->lang->line('home')); ?> |
	<?php echo anchor("/home/tag", $this->lang->line('tag_list')); ?> |
	<?php echo anchor("/home/files", $this->lang->line('file_list')); ?> |
	<?php echo anchor("/upload", $this->lang->line('upload_file')); ?> |
	<?php echo anchor("/users", $this->lang->line('manage_users')); ?>
</div>
<div class="search">
<?php
    echo form_open("/home/search");
    echo form_input('search', '');
    echo form_submit('submit', $this->lang->line('search'));
?>
</form>
</div>
<?php
    if( isset( $status_message ) && $status_message){
        echo "<p class='status_message'>$status_message</p>";
    }
?>
