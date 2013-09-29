<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>中南大学爱尔眼科学院网站后台管理系统</title>
		<base href="<?php echo base_url()?>"/>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/blue.css" />
		<script type="text/javascript" src="resources/scripts/jquery.min.js"></script>   
		<script type="text/javascript" src="resources/scripts/jquery.date_input.js"></script>   
		<link rel="stylesheet" href="resources/css/date_input.css" type="text/css"> 

		<script type="text/javascript">

			jQuery.extend(DateInput.DEFAULT_OPTS, {   
			month_names: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],   
			short_month_names: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],   
			short_day_names: ["一", "二", "三", "四", "五", "六", "日"],  
			 dateToString: function(date) {  
			    var month = (date.getMonth() + 1).toString();  
			    var dom = date.getDate().toString();  
			    if (month.length == 1) month = "0" + month;  
			    if (dom.length == 1) dom = "0" + dom;  
			    return date.getFullYear() + "年" + month + "月" + dom+ "日";  
			  }  
			  
			});   
			  
			$(function() {   
			$("#timeChooser").date_input();  
			});   
			
			function IsEmpty(aTextField) {
				if ((aTextField.value.length == 0) || (aTextField.value == null)) {
					return true;
				}else{	return false;}
			}
			function Back(){
				var theForm = document.forms["articleForm"];
				var pid = theForm.pid.value;
				window.location.href= "/csueye/admin/keytime/keytimeList/";
				return true;
			}
		</script>

	</head>
	<body>
		<?php include("top.php"); ?>
		<div id="content">
			<?php include("left.php"); ?>
			<div id="right">
				<div class="box">
					<div class="title">
						<h5>编辑事件</h5>
					</div>
					<form id="articleForm" name="articleForm" action="<?php echo site_url('admin/keytime/keytimeAdd')?>" method="post">
					<div>
						<center>
							<div>事件时间：<input name="time" id="timeChooser" style="width:300px;height:20px" /></div><br/>
								<p>事件内容：<input name="event" style="width:300px;height:20px" />	</p>
							</div><br/>
							<div style="height:23px;width:120px;margin-left:744px;">
								<input type="submit" value="添加 " style="height:23px;width:45px;"/>
								&nbsp;
								<input type="button" onclick="Back()" value="返 回" style="height:23px;width:45px;"/>
							</div>
						</center>
					</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<?php include("bottom.php"); ?>
	</body>
</html>
