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
        <a href="<?php echo $uploadUrl; ?>{filename}" title="{filename}"><?php echo $this->lang->line('open');?></a>
        <!--<a href="<?php echo site_url("download/file/");?>/{id}" title="{filename}"><?php echo $this->lang->line('force_download');?></a>-->
        <a href="<?php echo site_url("manage/file/");?>/{id}"><?php echo $this->lang->line('manage_file');?></a>
    </div>
    </div>
</div>
{/filelist}
