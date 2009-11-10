{filelist}
<div class="file-container">
    <div class="containerTitle">
        <div class="fileName">{name}</div>
        <div class="fileType">{type}</div>
    </div>
    <div class="containerSubTitle">
        <div class="fileSize">{size}</div>
        <div class="fileDate">{date}</div>
    </div>
    <div class="fileDescription">
        {description}
    </div>
    <div class="fileOptions">
        <a href="<?php echo $uploadUrl; ?>{filename}" title="{filename}">Open</a>
        <a href="<?php echo site_url("download/file/");?>/{id}" title="{filename}">Save</a>
        <a href="<?php echo site_url("manage/file/");?>/{id}">Manage File</a>
    </div>
    </div>
</div>
{/filelist}
