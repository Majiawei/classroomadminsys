<?php
require_once '../include.php';
checkLogined();
$rows=getAllCate();
if(!$rows){
    alertMes("没有相应分类，请先添加分类!!", "addCate.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
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
</head>
<body>
<h3>预约添加</h3>
<form action="doAdminAction.php?act=addOrder" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">预约人</td>
		<td><input type="text" name="username"  value="<?php echo $_SESSION['adminName'];?>"/></td>
	</tr>
	<tr>
		<td align="right">教室分类</td>
		<td>
		<select name="cId" onchange="change(this.value)">
			<?php foreach($rows as $row):?>
				<option value="<?php echo $row['id'];?>"><?php echo $row['cName'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">教室名称</td>
		<td><select name="cId">
			<?php 
			$rows1=getProById($id);
			foreach($rows1 as $row2):?>
				<option value="<?php echo $row2['id'];?>"><?php echo $row2['cName'];?></option>
			<?php endforeach;?>
		</select></td>
	</tr>
	<tr>
		<td align="right">教室容量</td>
		<td><input type="text" name="pNum"  placeholder="请输入座位数"/></td>
	</tr>
	<tr>
		<td align="right">预约时间段</td>
		<td><input type="text" name="pNum"  placeholder="请输入座位数"/></td>
	</tr>
<!-- 	<tr> -->
<!-- 		<td align="right">是否可预约</td> -->
<!-- 		<td><input type="text" name="mPrice"  placeholder="请输入商品市场价"/></td> -->
<!-- 	</tr> -->
<!-- 	<tr> -->
<!-- 		<td align="right">商品慕课价</td> -->
<!-- 		<td><input type="text" name="iPrice"  placeholder="请输入商品慕课价"/></td> -->
<!-- 	</tr> -->
	<tr>
		<td align="right">预约原因</td>
		<td>
			<textarea name="pDesc" id="editor_id" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
<!-- 	<tr> -->
<!-- 		<td align="right">教室图片</td> -->
<!-- 		<td> -->
<!-- 			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a> -->
<!-- 			<div id="attachList" class="clear"></div> -->
<!-- 		</td> -->
<!-- 	</tr> -->
	<tr>
		<td colspan="2"><input type="submit"  value="提交预约"/></td>
	</tr>
</table>
</form>
<script type="text/javascript">
	function change(val){
		window.location="listOrder.php?order="+val;
	}
</script>
</body>
</html>