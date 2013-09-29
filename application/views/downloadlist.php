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
                                <a href="<?php echo site_url('/downloadlist/view').'/'.$value['id'];?>"><?php echo $value["name"];?></a></li>
                            <?php }?>
                    </ul>
                </div>
                <div class="article-list">
                    <h4 class="location">
                       <span><?php echo $parentSubject->name;?></span>
                        &gt;
                        <span><?php echo $currentSubject->name;?></span>
                    </h4>
                    <ul>
                        <?php foreach ($documentlist as $key => $value) { ?>
                        <li class="list-entry">                        
                            <h4 class="article-title"><a href="#"><?php echo $value['title'];?></a></h4>
                            <div class="details">
                                <a href="<?php echo site_url('/downloadpage/view').'/'.$value['id'];?>" class="overview"><?php echo ellipsize($value['brief'],64,5);?> <span>[查看详情]</span></a>
                                <p class="detail-entry">来源：<?php echo $value['author'];?></p>
                                <p class="detail-entry">时间：<?php echo $value['addTime'];?></p>
                            </div>
                        </li>
                        <?php }?>
                     
                    </ul>
                </div>
            </div>
        </div>
<?php include("footer.php"); ?>