<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>中南大学爱尔眼科学院——首页</title>
    <base href="<?php echo base_url()?>"/>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
    <link rel="stylesheet" type="text/css" href="resources/css/list.css" />
    <script src="resources/scripts/jquery.min.js" type="text/javascript"></script>
    <script src="resources/scripts/jquery-extension.js" type="text/javascript"></script>
    <style>
 
    </style>
</head>
<body>
	<div id="viewport">
		<div id="pageWrapper">
            <!-- top -->
			<div class="header row">
                <!-- logo -->
                <a href="index.html" class="logo"><img src="resources/images/logo2.jpg" alt="艾尔眼科学院"></a>
                <form action="" class="search">
                    <input type="text" class="keyword">
                    <button type="submit" class="btn">search</button>
                </form>
				<div class="top-menu">
                    <ul>
                        <li class="first-list"><a href="http://www.irs-chn.com/" target="_blank">IRS·2013</a></li>
                        <li><a href="#">English</a></li>
			<li><a href="admin/admin" target="_blank">门户登录</a></li>
                    </ul>            
                </div>
				<div class="nav-menu">
                    <ul>
                        <li class="index"><a href="<?php echo site_url('/');?>" rel="首页">首页</a></li>

                    <?php foreach($rootSubjectList as $key => $subject){ ?>
                        <li class="dropdown">
                            <a href="#"><?php echo $subject['name'] ?></a>
                            <div class="mega-wrap">

                                <div class="mega-col">
                                    <?php
                                    $mega_col = 'subjectList_'.$subject['id'];
                                     foreach ($$mega_col as $key2 => $value) {
                                        $bindItemName = 'bindItem_'.$value['id'];
                                        $tempItem = isset($$bindItemName)?$$bindItemName:"test";
                                        if ( $key2 % 3 == 0) {?> 
                                        <h5> <?php echo $value['name']; ?> </h5> 
                                            <?php switch ($value['flag']) {
                                                case 2:
                                                    echo "<p><a href='".site_url('/newslist/view').'/'.$tempItem->subjectID."'>".$tempItem->title."</a></p>";
                                                    break;
                                                case 1:
                                                    echo "<p><a href='".site_url('/article/view').'/'.$tempItem->subjectID."'>".$tempItem->title."</a></p>";
                                                    break;
                                                case 0:
                                                    echo "<p>";
                                                    foreach ($$bindItemName as $bindItemKey => $bindItemValue) {
                                                    	if ($bindItemValue['flag'] == 1) {
                                                        	echo "<a href='".site_url('/article/view').'/'.$bindItemValue['id']."'>".$bindItemValue['name']."</a>&nbsp;&nbsp;";
                                                    	}else{
                                                        	echo "<a href='".site_url('/newslist/view').'/'.$bindItemValue['id']."'>".$bindItemValue['name']."</a>&nbsp;&nbsp;";
                                                    	}
                                                    }
                                                    echo "</p>";
                                                    break;
                                                case 3:
                                                    echo "<p><a href='".site_url('/downloadlist/view').'/'.$value['id']."'>下载列表</a></p>";
                                                    break;
                                            } } } ?>
                                </div>
                                
                                <div class="mega-col">
                                     <?php
                                    $mega_col = 'subjectList_'.$subject['id'];
                                     foreach ($$mega_col as $key2 => $value) {
                                        $bindItemName = 'bindItem_'.$value['id'];
                                        $tempItem = isset($$bindItemName)?$$bindItemName:"test";
                                        if ( $key2 % 3 == 1) {?> 
                                        <h5> <?php echo $value['name']; ?> </h5> 
                                            <?php switch ($value['flag']) {
                                                case 2:
                                                    echo "<p><a href='".site_url('/newslist/view').'/'.$tempItem->subjectID."'>".$tempItem->title."</a></p>";
                                                    break;
                                                case 1:
                                                    echo "<p><a href='".site_url('/article/view').'/'.$tempItem->subjectID."'>".$tempItem->title."</a></p>";
                                                    break;
                                                case 0:
                                                    echo "<p>";
                                                    foreach ($$bindItemName as $bindItemKey => $bindItemValue) {
                                                    	if ($bindItemValue['flag'] == 1) {
                                                        	echo "<a href='".site_url('/article/view').'/'.$bindItemValue['id']."'>".$bindItemValue['name']."</a>&nbsp;&nbsp;";
                                                    	}else{
                                                        	echo "<a href='".site_url('/newslist/view').'/'.$bindItemValue['id']."'>".$bindItemValue['name']."</a>&nbsp;&nbsp;";
                                                    	}
                                                    }
                                                    echo "</p>";
                                                    break;
                                                case 3:
                                                    echo "<p><a href='".site_url('/downloadlist/view').'/'.$value['id']."'>下载列表</a></p>";
                                                    break;
                                            } } } ?>
                                </div>
                                <div class="mega-col last">
                                     <?php
                                    $mega_col = 'subjectList_'.$subject['id'];
                                     foreach ($$mega_col as $key2 => $value) {
                                        $bindItemName = 'bindItem_'.$value['id'];
                                        $tempItem = isset($$bindItemName)?$$bindItemName:"test";
                                        if ( $key2 % 3 == 2) {?> 
                                        <h5> <?php echo $value['name']; ?> </h5> 
                                            <?php switch ($value['flag']) {
                                                case 2:
                                                    echo "<p><a href='".site_url('/newslist/view').'/'.$tempItem->subjectID."'>".$tempItem->title."</a></p>";
                                                    break;
                                                case 1:
                                                    echo "<p><a href='".site_url('/article/view').'/'.$tempItem->subjectID."'>".$tempItem->title."</a></p>";
                                                    break;
                                                case 0:
                                                    echo "<p>";
                                                    foreach ($$bindItemName as $bindItemKey => $bindItemValue) {
                                                    	if ($bindItemValue['flag'] == 1) {
                                                        	echo "<a href='".site_url('/article/view').'/'.$bindItemValue['id']."'>".$bindItemValue['name']."</a>&nbsp;&nbsp;";
                                                    	}else{
                                                        	echo "<a href='".site_url('/newslist/view').'/'.$bindItemValue['id']."'>".$bindItemValue['name']."</a>&nbsp;&nbsp;";
                                                    	}
                                                    }
                                                    echo "</p>";
                                                    break;
                                                case 3:
                                                    echo "<p><a href='".site_url('/downloadlist/view').'/'.$value['id']."'>下载列表</a></p>";
                                                    break;
                                            } } } ?>
                                </div>                         
                        </li>
                        <?php } ?>   
                    </ul>            
                </div>
			</div>
