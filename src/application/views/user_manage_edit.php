<h2><?php echo $this->lang->line('manage_exist_user');?></h2>

<h2><?php echo $this->lang->line('delete_user');?></h2>
<?php echo anchor("/users/manage/delete/{$user_info['id']}", $this->lang->line('delete') . " {$user_info['username']}",
	"onclick=\"return confirm('{$this->lang->line('conf_del_user')}');\")"); ?>
	
<h2><?php echo $this->lang->line('change_pass');?></h2>
<?php
    echo form_open("/users/manage/changePass/{$user_info['id']}");
    echo $this->lang->line('password') . " " . form_password('password') . "<br>";
    echo form_submit('submit', $this->lang->line('change_pass'));
    echo "</form>";
?>
