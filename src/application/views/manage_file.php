<html>
<head>
<title>MANAGE FILE Here</title>
</head>
<body>
<?php echo anchor("/","Home");?>
<p>MANAGE FILE Here</p>
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
    <tr><td><b>Description:</b></td><td colspan="3">{description}</td></tr>
    </tr>
</table>
{/info}

TAGS:
<table>
    {tags}
    <tr>
    <td width="150px">{name}</td>
    <td><a href="<?php echo site_url("manage/file/$id/removetag");?>/{name}" alt="Remove Tag">Delete</a></td>
    </tr>
    {/tags}
</table>

<?php
    echo form_open("manage/file/$id/addtag");
    echo form_input('tag', '');
    echo form_submit('submit', 'Add Tag');
?>
</form>

</body>
</html>
