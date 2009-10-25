<html>
<head>
<title>XS File Lib</title>
</head>
<body>

<p>Home Page Here</p>

<table border=1>
    <tr><th>File</th><th>Type</th><th>Date Added</th><th>Description</th><th>Size</th></tr>
    {filelist}
    <tr>
        <td>
        <a href="/uploads/{filename}" title="{filename}">{name}</a></td>
        <td>{type}</td>
        <td>{date}</td>
        <td>{description}</td>
        <td>{size}</td>
        <td><a href="<?php echo site_url("manage/file/");?>/{ID}">Manage File</a></td>
    </tr>
    {/filelist}
</table>
<p>Page rendered in {elapsed_time} seconds</p>

</body>
</html>
