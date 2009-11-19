{info}
<table width="85%" border="1">
    <tr>
        <td width="100px"><b><?php echo $this->lang->line('name');?></b></td>
        <td>
          <?php echo form_open("manage/file/$id/editname",array('style'=>"display:inline;")); ?>
          <input type="text" name="name" value="{name}" size="40" maxlength="40"/>
          <input type="submit" value="<?php echo $this->lang->line('save');?>"/>
          </form>
        </td>
        <td width="100px"><b><?php echo $this->lang->line('type');?></b></td><td>{type}</td>
    </tr>
    <tr>
        <td width="100px"><b><?php echo $this->lang->line('size');?></b></td><td>{size}</td>
        <td width="100px"><b><?php echo $this->lang->line('date');?></b></td><td>{date}</td>
    </tr>
    <tr><td><b><?php echo $this->lang->line('desc');?></b></td><td colspan="3">
     <?php
     echo form_open("manage/file/$id/editdesc");
     ?>
     <textarea name="desc" style="width: 100%;" rows=10>{description}</textarea>
     <br><input type="submit" value="<?php echo $this->lang->line('save');?>"/>
    </form>
    </td></tr>
    </tr>
</table>
{/info}

TAGS:
<table>
    {tags}
    <tr>
    <td width="150px"><a href="<?php echo site_url("home/tag/");?>/{tag_id}">{name}</td>
    <td><a href="<?php echo site_url("manage/file/$id/removetag");?>/{tag_id}"><?php echo $this->lang->line('rem_tag');?></a></td>
    </tr>
    {/tags}
</table>

<?php
    echo form_open("manage/file/$id/addtag");
    echo form_input('tag', '');
    echo form_submit('submit', $this->lang->line('add_tag') );
?>

<p><a href="<?php echo site_url("manage/file/$id/deleteFile")?>"
      onclick="return confirm('<?php echo $this->lang->line('conf_del_file');?>');"><?php echo $this->lang->line('del_file');?></a></p>
</form>
