{info}
<table width="85%" border="1">
    <tr>
        <td width="100px"><b>Name:</b></td><td>{name}</td>
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
</form>
