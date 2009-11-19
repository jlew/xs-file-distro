<h2><?php echo $this->lang->line('manage_exist_user'); ?></h2>
<ul>
	{user_list}
	<li><a href="<?php echo site_url("/users/manage/edit")?>/{id}">{username}</a></li>
	{/user_list}
</ul>

<h2><?php echo $this->lang->line('add_user'); ?></h2>
<?php
	echo form_open("/users/manage/adduser");
    echo $this->lang->line("username") . " " . form_input('username', '') . "<br>";
    echo $this->lang->line("password") . " " . form_password('password') . "<br>";
    echo form_submit('submit',  $this->lang->line('add_user'));
    echo "</form>";
?>
