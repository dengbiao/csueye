<?php include("header.php"); ?>
            <!-- main content: article list -->
            <div class="list-can">
                <div class="list-menu">
                    <ul>
                       <?php foreach ($currentSlibingSubjects as $key => $value) {
                            if ($value["name"] == $currentSubject->name) {  ?>
                                <li class="list-menu-entry current">
                           <?php }else{ ?>
                                <li class="list-menu-entry">
                            <?php } ?>
                                <a href="<?php echo $value['flag'] == 2 ? site_url('/newslist/view').'/'.$value['id'] : site_url('/article/view').'/'.$value['id'] ?>"><?php echo $value["name"];?></a></li>
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
                            <h3><?php echo $article->title;?></h3>
                            <div class="article-info">
                                <span>来源：宣传部</span>
                                <span>时间：<?php echo $article->updateTime;?></span>
                                <span>点击次数：<?php echo $article->clickCount;?></span>
                            </div>
                        </div>
                        <div class="article-main row">
                            <?php echo $article->content;?>
                        </div>
                    </div>
                </div>
            </div>
</div>
            <!-- footer -->
<?php include("footer.php"); ?>