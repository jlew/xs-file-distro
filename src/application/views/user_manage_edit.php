<h2>Manange Existing User</h2>

<h2>Delete User</h2>
<?php echo anchor("/users/manage/delete/{$user_info['id']}", "Delete {$user_info['username']}",
	"onclick=\"return confirm('Are you sure you want to delete this user?');\")"); ?>
	
<h2>Change User Password</h2>
<?php
    echo form_open("/users/manage/changePass/{$user_info['id']}");
    echo "Password: " . form_password('password') . "<br>";
    echo form_submit('submit', 'Change Password');
    echo "</form>";
?>
