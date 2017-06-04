<?php
require_once 'include.php';
$id=$_POST['date'];
print_r($id);
print_r($_POST);
$datetime=getDateTimeById($id);
print_r($datetime);
$array['pName']=$_POST['pName'];
$array['username']=$_POST['username'];
$array['reason']=$_POST['reason'];
$array['ordertime']=time();
$array['permit']=1;
$array['date']=$datetime['date'];
$array['w_time']=$datetime['w_time'];
// delperorder($id);
print_r($array);
//delete("perorder","id={$id}");
//insert("order_tab", $array);
// $proInfo=getProById($id);
// $proImgs=getProImgsById($id);
// $dateInfo=getDateById($id);
// // print_r($proInfo);
// // print_r($dateInfo);
// // print_r($proImgs);

// if(!($proImgs &&is_array($proImgs))){
//     alertMes("商品图片错误", "index.php");
// }
// ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品介绍</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<link type="text/css" rel="stylesheet" media="all" href="styles/jquery.jqzoom.css"/>
<script src="scripts/jquery-1.6.js" type="text/javascript"></script>
<script src="scripts/jquery.jqzoom-core.js" type="text/javascript"></script>

<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);		
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false,
			title:false,
			zoomWidth:410,
			zoomHeight:410
        });
	
});
</script>
</head>

<body class="grey">
<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">
			<div class="leftArea">
				<a href="#" class="collection">设为标签</a>
			</div>
			<div class="rightArea">
<!-- 				欢迎来到ustb教室预约系统！<a href="login.php">[登录]</a><a href="reg.php">[免费注册]</a> -->
				欢迎来到ustb教室预约系统！
				<?php if($_SESSION['loginFlag']):?>
				<span>欢迎您</span><?php echo $_SESSION['username'];?>
				<a href="doAction.php?act=userOut">[退出]</a>
				<?php else:?>
				<a href="login.php">[登录]</a><a href="reg.php">[注册]</a>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="images/logo1.jpg" alt="ustb" height="70" width="112"></a>
			</div>
			<div class="search_box fl">
				<input type="text" class="search_text fl">
				<input type="button" value="教室搜索" class="search_btn fr">
			</div>
		</div>
	</div>
<div class="userPosition comWidth">
	<strong><a href="index.php">首页</a></strong>
	<span>&nbsp;&gt;&nbsp;</span>
	<a href="#"><?php echo $proInfo['cName'];?></a>
	<span>&nbsp;&gt;&nbsp;</span>
	<em><?php echo $proInfo['pSn'];?></em>
</div>
<div class="description_info comWidth">
	<div class="description clearfix">
		<div class="leftArea">
			<div class="description_imgs">
				<div class="big">
					<a href="image_800/<?php echo  $proImgs[0]['albumPath'];?>" class="jqzoom" rel='gal1'  title="triumph" >
           			 <img width="309" height="340" src="image_350/<?php  echo $proImgs[0]['albumPath'];?>"  title="triumph">
	        		</a>
				</div>
				<ul class="des_smimg clearfix" id="thumblist" >
					<?php foreach($proImgs as $key=>$proImg):?>
					<li><a class="<?php echo $key==0?"zoomThumbActive":"";?> active" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'image_350/<?php echo $proImg['albumPath'];?>',largeimage: 'image_800/<?php echo $proImg['albumPath'];?>'}"><img src="image_50/<?php echo $proImg['albumPath'];?>" alt=""></a></li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="rightArea">
		
		</div>
	</div>
<div class="hr_15"></div>

<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">平台简介</a><i>|</i><a href="#">平台公告</a><i>|</i> <a href="#">招纳贤士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：17801052318</p>
	<p>Copyright &copy; 2016 - 2017 ustb版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
	<p class="web"><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a></p>
</div>
</body>
</html>
