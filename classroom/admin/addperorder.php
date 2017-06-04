<?php 
require_once '../include.php';
checkLogined();
$rows=getAllPros();
print_r($rows);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>添加可预约教室</h3>
<form action="doAdminAction.php?act=addperorder" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">教室名</td>
		<td><select name="pName">
			<?php foreach($rows as $row):?>
				<option value="<?php echo $row['pName'];?>"><?php echo $row['pName'];?></option>
			<?php endforeach;?>
		</select></td>
	</tr>
	<tr>
		<td align="right">日期</td>
		<td><input type="text" name="date" placeholder="YYYY-MM-DD"/></td>
	</tr>
	<tr>
		<td align="right">时间段</td>
		<td><input type="text" name="w_time" placeholder="请输入可预约时间段"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="添加分类"/></td>
	</tr>

</table>
</form>
</body>
</html>