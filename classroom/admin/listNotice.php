<?php
require_once '../include.php';
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select * from notice_tab";
$totalRows=getResultNum($sql);
$pageSize=3;
$totalPage=ceil($totalRows/$pageSize);
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select * from notice_tab  order by id asc limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
if(!$rows){
    alertMes("sorry,没有公告,请添加!","addNotice.php");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addNotice()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">编号</th>
                                <th width="15%">标题</th>
                                <th width="25%">内容</th>
                                <th width="15%">发布时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['title'];?></td>
                                <td><?php echo $row['content'];?></td>
                                <td><?php echo date("Y-m-d H:i:s",$row['pubtime']);?></td>
                                <td align="center"><input type="button" value="修改" class="btn" onclick="editNotice(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"  onclick="delNotice(<?php echo $row['id'];?>)"></td>
                            </tr>
                            <?php endforeach;?>
                            <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="4"><?php echo showPage($page, $totalPage);?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
	function editNotice(id){
		window.location="editNotice.php?id="+id;
	}
	function delNotice(id){
		if(window.confirm("您确定要删除吗？删除之后不能恢复哦！！！")){
			window.location="doAdminAction.php?act=delNotice&id="+id;
		}
	}
	function addNotice(){
		window.location="addNotice.php";
	}
</script>
</body>
</html>