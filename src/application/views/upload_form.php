<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<?php echo $this->lang->line('file');?> <input type="file" name="userfile" /><br/><br>
<?php echo $this->lang->line('name');?> <input type="text" name="filename" /><br/>
<?php echo $this->lang->line('desc');?> <br><textarea name="description" style="width: 80%; height: 150px;"></textarea>
<br /><br />
<input type="submit" value="<?php echo $this->lang->line('upload_file');?>" />

</form>
