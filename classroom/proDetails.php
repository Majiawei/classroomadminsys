<?php 
require_once 'include.php';
$id=$_REQUEST['id'];
$proInfo=getProById($id);
$proImgs=getProImgsById($id);
$dateInfo=getDateById($id);
// print_r($proInfo);
// print_r($dateInfo);
// print_r($proImgs);

if(!($proImgs &&is_array($proImgs))){
	alertMes("商品图片错误", "index.php");
}
?>
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
			<div class="des_content">
				<h3 class="des_content_tit"><?php echo $proInfo['pName'];?></h3>
				<div class="dl clearfix">
					<div class="dt">教室容量</div>
					<div class="dd clearfix"><span class="des_money"><?php echo $proInfo['pNum'];?></span></div>
				</div>
				<div class="dl clearfix">
					<div class="dt">教室信息</div>
					<div class="dd clearfix"><span class="hg"><em><?php echo $proInfo['pDesc'];?></em></span></div>
				</div>
				<div class="des_position">
				<h3>预约教室</h3>
              <form action="doorder.php" method="post" enctype="multipart/form-data">
                <table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
                
                	<tr>
                		<td align="right">预约者</td>
                		<td><input type="text"  name="username"  value="<?php echo $_SESSION['username'];?>"/></td>
                	</tr>
                	<tr>
                		<td align="right">教室名称</td>
                		<td><input type="text"  name="pName"  value="<?php echo $proInfo['pName'];?>"/></td>
                	</tr>
                	<tr>
                		<td align="right">教室编号</td>
                		<td><input type="text" disabled="true" name="pSn"  value="<?php echo $proInfo['pSn'];?>"/></td>
                	</tr>
                	<tr>
                		<td align="right">教室容量</td>
                		<td><input type="text" disabled="true" name="pNum"  value="<?php echo $proInfo['pNum'];?>"/></td>
                	</tr>
                	<tr>
                		<td align="right">预约原因</td>
                		<td>
                			<textarea name="reason" id="editor_id" style="width:100%;height:150px;"></textarea>
                		</td>
                	</tr>
                	<tr>
                		<td align="right">选择日期-时间段</td>
                		<td>
                		<select name="date">
                            <?php foreach($dateInfo as $row):?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['date'];?> 
                            <?php 
                            switch ($row['w_time'])
                            {
                                case 1:
                                    echo "第一节课";
                                    break;
                                case 2:
                                    echo "第二节课";
                                    break;
                                case 3:
                                    echo "第三节课";
                                    break;
                                case 4:
                                    echo "第四节课";
                                    break;
                                case 5:
                                    echo "第五节课";
                                    break;
                                case 6:
                                    echo "第六节课";
                                    break;
                                    
                                default:
                                    echo "晚自习";
   
                            }
                            ?></option>
                             <?php endforeach;?>
                         </select>
                		</td>
                	</tr>
                
                	<tr>
                		<td colspan="2"><input type="submit"  value="提交预约"/></td>
                	</tr>
                </table>
                </form>
                </div>
<!-- 				<div class="des_position"> -->
<!-- 					<div class="dl clearfix"> -->
<!-- 						<div class="dt">选择日期-时间段</div> -->
<!--                             		<select name="date"> -->
<!--                             		</select> -->
<!-- 							<span class="theGoods">（当前可预约日期）</span> -->
<!-- 					</div> -->
<!-- 				<div class="des_select"> -->
<!-- 					已选择时间段 <span>"上午第一节课"</span> -->
<!-- 				</div> -->
<!-- 				<div class="shop_buy"> -->
<!-- 				<input type="button" value="提交预约" class="search_btn fr"> -->
<!-- 				</div> -->
				
				
<!-- 				<div class="notes"> -->
<!-- 					注意：预约后请签到！ -->
<!-- 				</div> -->
<!-- 			</div> -->
		</div>
	</div>
</div>
<div class="hr_15"></div>
<!-- <div class="des_info comWidth clearfix"> -->
<!-- 	<div class="leftArea"> -->
<!-- 		<div class="recommend"> -->
<!-- 			<h3 class="tit">同价位</h3> -->
<!-- 			<div class="item"> -->
<!-- 				<div class="item_cont"> -->
<!-- 					<div class="img_item"> -->
<!-- 						<a href="#"><img src="images/shopImg.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<p><a href="#">文字介绍文字介绍文字介绍文字介绍文字介绍文字介绍</a></p> -->
<!-- 					<p class="money">￥888</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 			<div class="item"> -->
<!-- 				<div class="item_cont"> -->
<!-- 					<div class="img_item"> -->
<!-- 						<a href="#"><img src="images/shopImg.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<p><a href="#">文字介绍文字介绍文字介绍文字介绍文字介绍文字介绍</a></p> -->
<!-- 					<p class="money">￥888</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 			<div class="item"> -->
<!-- 				<div class="item_cont"> -->
<!-- 					<div class="img_item"> -->
<!-- 						<a href="#"><img src="images/shopImg.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<p><a href="#">文字介绍文字介绍文字介绍文字介绍文字介绍文字介绍</a></p> -->
<!-- 					<p class="money">￥888</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 		<div class="hr_15"></div> -->
<!-- 		<div class="recommend"> -->
<!-- 			<h3 class="tit">同价位</h3> -->
<!-- 			<div class="item"> -->
<!-- 				<div class="item_cont"> -->
<!-- 					<div class="img_item"> -->
<!-- 						<a href="#"><img src="images/shopImg.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<p><a href="#">文字介绍文字介绍文字介绍文字介绍文字介绍文字介绍</a></p> -->
<!-- 					<p class="money">￥888</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 			<div class="item"> -->
<!-- 				<div class="item_cont"> -->
<!-- 					<div class="img_item"> -->
<!-- 						<a href="#"><img src="images/shopImg.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<p><a href="#">文字介绍文字介绍文字介绍文字介绍文字介绍文字介绍</a></p> -->
<!-- 					<p class="money">￥888</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 			<div class="item"> -->
<!-- 				<div class="item_cont"> -->
<!-- 					<div class="img_item"> -->
<!-- 						<a href="#"><img src="images/shopImg.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<p><a href="#">文字介绍文字介绍文字介绍文字介绍文字介绍文字介绍</a></p> -->
<!-- 					<p class="money">￥888</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 	</div> -->
<!-- 	/////////////////////////////// -->
<!-- 	<div class="rightArea"> -->
<!-- 		<div class="des_infoContent"> -->
<!-- 			<ul class="des_tit"> -->
<!-- 				<li class="active"><span>产品介绍</span></li> -->
<!-- 				<li><span>产品评价(12312)</span></li> -->
<!-- 			</ul> -->
<!-- 			<div class="ad"> -->
<!-- 				<a href="#"><img src="images/ad.jpg"></a> -->
<!-- 			</div> -->
<!-- 			<div class="info_text"> -->
<!-- 				<div class="info_tit"> -->
<!-- 					<h3>强烈推荐</h3><h4>货比三家，还选</h4> -->
<!-- 				</div> -->
<!-- 				<p>现在就是买mini的好时候！换代清仓直降，但苹果品质不变！A5双核，内置Lightning闪电接口，正反可插，方便人性。小身材，炫丽的7.9英寸显示屏，7.2mm的厚度，薄如铅笔。女生包包随身携带更时尚！facetime视频通话，与密友24小时畅聊不断线。微信倾力打造，你的智能助理。苹果的牌子就不用我说了，1111补仓，存货不多哦！</p> -->
<!-- 				<div class="hr_45"></div> -->
<!-- 				<div class="info_tit"> -->
<!-- 					<h3>强烈推荐</h3><h4>货比三家，还选</h4> -->
<!-- 				</div> -->
<!-- 				<p>现在就是买mini的好时候！换代清仓直降，但苹果品质不变！A5双核，内置Lightning闪电接口，正反可插，方便人性。小身材，炫丽的7.9英寸显示屏，7.2mm的厚度，薄如铅笔。女生包包随身携带更时尚！facetime视频通话，与密友24小时畅聊不断线。微信倾力打造，你的智能助理。苹果的牌子就不用我说了，1111补仓，存货不多哦！</p> -->
<!-- 				<div class="hr_45"></div> -->
<!-- 				<img src="images/pad.jpg" class="center"> -->
<!-- 				<div class="hr_45"></div> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 		<div class="hr_15"></div> -->
<!-- 		<div class="des_infoContent"> -->
<!-- 			<h3 class="shopDes_tit">商品评价</h3> -->
<!-- 			<div class="score_box clearfix"> -->
<!-- 				<div class="score"> -->
<!-- 					<span>4.7</span><em>分</em> -->
<!-- 				</div> -->
<!-- 				<div class="score_speed"> -->
<!-- 					<ul class="score_speed_text"> -->
<!-- 						<li class="speed_01">非常不满意</li> -->
<!-- 						<li class="speed_02">不满意</li> -->
<!-- 						<li class="speed_03">一般</li> -->
<!-- 						<li class="speed_04">满意</li> -->
<!-- 						<li>非常满意</li> -->
<!-- 					</ul> -->
<!-- 					<div class="score_num"> -->
<!-- 						4.7<i></i> -->
<!-- 					</div> -->
<!-- 					<p>共18939位慕课网友参与评分</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 			<div class="review_tab"> -->
<!-- 				<ul class="review fl"> -->
<!-- 					<li><a href="#" class="active">全部</a></li> -->
<!-- 					<li><a href="#">满意（3121）</a></li> -->
<!-- 					<li><a href="#">一般（321）</a></li> -->
<!-- 					<li><a href="#">不满意（1121）</a></li> -->
<!-- 				</ul> -->
<!-- 				<div class="review_sort fr"> -->
<!-- 					<a href="#" class="review_time">时间排序</a><a href="#" class="review_reco">推荐排序</a> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 			<div class="review_listBox"> -->
<!-- 				<div class="review_list clearfix"> -->
<!-- 					<div class="review_userHead fl"> -->
<!-- 						<div class="review_user"> -->
<!-- 							<img src="images/userhead.jpg" alt=""> -->
<!-- 							<p>61***42</p> -->
<!-- 							<p>金色会员</p> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 					<div class="review_cont"> -->
<!-- 						<div class="review_t clearfix"> -->
<!-- 							<div class="starsBox fl"><span class="stars"></span><span class="stars"></span><span class="stars"></span><span class="stars"></span><span class="stars"></span></div> -->
<!-- 							<span class="stars_text fl">5分 满意</span> -->
<!-- 						</div> -->
<!-- 						<p>赖慕课挺不错的信赖慕课挺不错的，信赖慕课</p> -->
<!-- 						<p><a href="#" class="ding">顶(0)</a><a href="#" class="cai">踩(0)</a></p> -->
<!-- 					</div> -->
<!-- 				</div> -->
<!-- 				<div class="review_list clearfix"> -->
<!-- 					<div class="review_userHead fl"> -->
<!-- 						<div class="review_user"> -->
<!-- 							<img src="images/userhead.jpg" alt=""> -->
<!-- 							<p>61***42</p> -->
<!-- 							<p>金色会员</p> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 					<div class="review_cont"> -->
<!-- 						<div class="review_t clearfix"> -->
<!-- 							<div class="starsBox fl"><span class="stars"></span><span class="stars"></span><span class="stars"></span><span class="stars"></span><span class="stars"></span></div> -->
<!-- 							<span class="stars_text fl">5分 满意</span> -->
<!-- 						</div> -->
<!-- 						<p>赖慕课挺不错的信赖慕课挺不错的，信赖慕课</p> -->
<!-- 						<p><a href="#" class="ding">顶(0)</a><a href="#" class="cai">踩(0)</a></p> -->
<!-- 					</div> -->
<!-- 				</div> -->
<!-- 				<div class="hr_25"></div> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 	</div> -->
<!-- </div> -->
<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">平台简介</a><i>|</i><a href="#">平台公告</a><i>|</i> <a href="#">招纳贤士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：17801052318</p>
	<p>Copyright &copy; 2016 - 2017 ustb版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
	<p class="web"><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a></p>
</div>
</body>
</html>
