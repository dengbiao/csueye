<?php include("header.php"); ?>
            <!-- slider -->
			<div class="row">
                <div id="slider_control_left"><a href="#"></a></div>
                    <div id="slider_control_right"><a href="#"></a></div>
				<div class="slider_can">
                    <!-- index jiaodiantu 首页焦点图 -->
                    <div id="slider">
                    <?php foreach ($pictureNews as $key => $value) { ?>
                        <div class="slider_item">
                            <a target="_blank" alt="<?php echo $value['title'];?>" href="<?php echo site_url('/newspage/view').'/'.$value['id'];?>">
                                <img src=" <?php echo site_url('/resources/uploads/news').'/'.$value['picPath'];?>" alt="<?php echo $value['title'];?>">
                                    <p><?php echo $value['title'];?></p>
                            </a>
                        </div>
                   <?php  }?>
                                              
                    </div>
                    <div id="slider_control">
                    	<i class="now"></i>
                    	<i></i>
                    	<i></i>
                    </div>
                </div>
			</div>
            <!-- main content -->
            <div class="row">
                <!-- 学院动态 -->
                <div class="collegeNews aside grid-top">
                    <h2>学院动态</h2>
                    <div class="h-desc">
                        <span>College News</span>
                        <a href="<?php echo site_url('/newslist/view/8');?>">More</a>
                    </div>

                    <?php foreach ($schoolPictureNews as $key => $value) { ?>
                        <div class="news-row">
                            <a href="<?php echo site_url('/newspage/view').'/'.$value['id'];?>" class="show" title="<?php echo $value['title'];?>"><img src="<?php echo site_url('/resources/uploads/news').'/'.$value['picPath'];?>" alt="<?php echo $value['title'];?>"></a>
                            <a href="<?php echo site_url('/newspage/view').'/'.$value['id'];?>"><h4><?php echo $value['title'];?></h4></a>
                            <p>
                                <?php echo ellipsize($value['content'],160,0.7);?>

                            </p>
                        </div>
                   <?php }?>

                </div>
                <div class="presidentMsg aside grid-top">
                    <h2>院长寄语</h2>
                    <div class="h-desc">
                        <span>Message to the President</span>
                        <a href="<?php echo site_url('/article/view/11');?>">More</a>
                    </div>
                     <img src="/csueye/resources/images/present.JPG" alt="院长">
                    <h3>我们在书写历史</h3>
                    <p>“中南大学爱尔眼科学院”是一个新生事物，无论是对中南大学，对爱尔眼科集团，对我们，对你们，还是对中国的眼科高层次人才培养体系来说都是第一次，都将具有重要的现实意义和历史价值，都将会记入各自的历史，记入中南大学的历史，记入爱尔的历史。</p>
                </div>
                <div class="row"></div>
                <!-- 三格 -->
                <div class="left grid-aside aside">
                    <h2>爱尔文化</h2>
                    <div class="h-desc">
                        <span>Eye Culture</span>
                        <a href="<?php echo site_url('/downloadpage/view/11');?>">More</a>
                    </div>
                    <div class="left-img">
                        <img src="/csueye/resources/images/eye_video.jpg" alt="爱尔文化">
                         <a href="<?php echo site_url('/downloadpage/view/11');?>" class="video-mask"></a>
                    </div>
                </div>
                <div class="center grid-aside aside">
                    <h2>重要日期</h2>
                    <div class="h-desc">
                        <span>Important Date</span>
                        <a href="#">More</a>
                    </div>
                    <ul>
                    <?php foreach ($keytimeList as $key => $keytime): ?>
                        <li>
                            <span><?php echo $keytime['time']; ?></span>
                            <a href="#"><?php echo $keytime['event']; ?></a>
                        </li>
                    <?php endforeach ?>
                        
                    </ul>
                </div>
                <div class="right grid-aside aside">
                    <h2>爱尔眼科医院</h2>
                    <div class="h-desc">
                        <span>Eye Hospital</span>
                        <a href="<?php echo site_url('/article/view/7');?>">More</a>
                    </div>
                    <a href="http://www.aierchina.com" class="fl"><img src="/csueye/resources/images/eye_history.jpg" alt="爱尔眼科"></a>
                    <p>爱尔眼科医院集团是中国最大规模的连锁眼科医疗机构，已在全国建立近50家专业眼科医院。爱尔眼科充分吸纳国际先进经验，成功探索出一套适应中国国情的经营模式，是国内发展速度最快的眼科医疗机构，连续两年入选“清科——中国最具投资价值企业50强”。</p>
                </div>
            </div>
            <!-- footer -->
     <?php include("footer.php"); ?>