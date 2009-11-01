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
        <a href="<?php echo site_url("download/file/");?>/{ID}" title="{filename}">Download</a>
        <a href="<?php echo site_url("manage/file/");?>/{ID}">Manage File</a>
    </div>
    </div>
</div>
{/filelist}
