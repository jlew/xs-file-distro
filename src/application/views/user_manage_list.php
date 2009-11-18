<h2>Manange Existing User</h2>
<ul>
	{user_list}
	<li><a href="<?php echo site_url("/users/manage/edit")?>/{id}">{username}</a></li>
	{/user_list}
</ul>

<h2>Add User</h2>
<?php
	echo form_open("/users/manage/adduser");
    echo "Username: " . form_input('username', '') . "<br>";
    echo "Password: " . form_password('password') . "<br>";
    echo form_submit('submit', 'Add User');
    echo "</form>";
?>
