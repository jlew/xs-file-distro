{info}
<table width="85%" border="1">
    <tr>
        <td width="100px"><b>Name:</b></td>
        <td>
          <?php echo form_open("manage/file/$id/editname",array('style'=>"display:inline;")); ?>
          <input type="text" name="name" value="{name}" size="40" maxlength="40"/>
          <input type="submit" value="Save"/>
          </form>
        </td>
        <td width="100px"><b>Type:</b></td><td>{type}</td>
    </tr>
    <tr>
        <td width="100px"><b>Size:</b></td><td>{size}</td>
        <td width="100px"><b>Date:</b></td><td>{date}</td>
    </tr>
    <tr><td><b>Description:</b></td><td colspan="3">
     <?php
     echo form_open("manage/file/$id/editdesc");
     ?>
     <textarea name="desc" style="width: 100%;" rows=10>{description}</textarea>
     <br><input type="submit" value="Save"/>
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
    <td><a href="<?php echo site_url("manage/file/$id/removetag");?>/{tag_id}" alt="Remove Tag">Delete</a></td>
    </tr>
    {/tags}
</table>

<?php
    echo form_open("manage/file/$id/addtag");
    echo form_input('tag', '');
    echo form_submit('submit', 'Add Tag');
?>

<p><a href="<?php echo site_url("manage/file/$id/deleteFile")?>"
      onclick="return confirm('Are you sure you want to delete this file?');">Click here to Delete File</a></p>
</form>
