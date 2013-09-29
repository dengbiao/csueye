<?php include("header.php"); ?>
            <!-- main content: article list -->
            <script src="<?php echo site_url('/resources/player').'/flowplayer-3.2.12.min.js';?>"></script>
            <div class="list-can">
                <div class="list-menu">
                    <ul>
                       <?php foreach ($currentSlibingSubjects as $key => $value) {
                            if ($value["name"] == $currentSubject->name) {  ?>
                                <li class="list-menu-entry current">
                           <?php }else{ ?>
                                <li class="list-menu-entry">
                            <?php } ?>
                                <a href="<?php echo site_url('/downloadlist/view').'/'.$value['id'];?>"><?php echo $value["name"];?></a></li>
                            <?php }?>
                    </ul>
                </div>
                <div class="article-list">
                    <h4 class="location">
                        <span><?php echo $parentSubject->name;?></span>
                        &gt;
                        <span><?php echo $currentSubject->name;?></span>
                        &gt;
                        <span>正文</span>
                    </h4>
                    <div class="article">
                        <div class="hd">
                            <h3><?php echo $downloadpage->title;?></h3>
                            <div class="article-info">
                                <span>来源：<?php echo $downloadpage->author;?></span>
                                <span>时间：<?php echo $downloadpage->addTime;?></span>
                                <span>下载次数：<?php echo $downloadpage->downloadCount;?></span>
                            </div>
                        </div>
                        <div class="article-main row">
                            <?php if ($currentSubject->id == 31) { ?>
                                <div class="player">
                                    <a href="<?php echo site_url('/resources/uploads/document').'/'.$downloadpage->path;?>" style="display:block;width:640px;height:480px;" id="player"></a>
                                </div>
                            <?php } else {?>
                                <p>文件说明：<?php echo $downloadpage->brief;?></p>
                                <p><a target="_blank" href="<?php echo site_url('/resources/uploads/document').'/'.$downloadpage->path;?>">[下载地址]</a></p>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script language="JavaScript">
            flowplayer("player", "<?php echo site_url('/resources/player').'/flowplayer-3.2.16.swf';?>");
        </script>
            <!-- footer -->
<?php include("footer.php"); ?>