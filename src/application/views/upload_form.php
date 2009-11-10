<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

File: <input type="file" name="userfile" /><br/><br>
Display Name: <input type="text" name="filename" /><br/>
File Description: <textarea name="description"></textarea>
<br /><br />
<input type="submit" value="upload" />

</form>
