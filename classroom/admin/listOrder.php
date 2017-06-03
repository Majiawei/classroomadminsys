<?php
require_once '../include.php';
checkLogined();
// $order=$_REQUEST['order']?$_REQUEST['order']:null;
// //print_r($order);
// $orderBy=$order?"order by p.".$order:null;
// // print_r($orderBy);
// $keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
// $where=$keywords?"where p.pName like '%{$keywords}%'":null;
//得到数据库中所有订单
// $sql="select p.id,p.pName,p.pSn,p.pNum,p.pDesc,p.pubTime,p.isShow,c.cName from  as p join room_cate c on p.cId=c.id {$where}{$orderBy}";
$sql = "select * from order_tab";
$totalRows=getResultNum($sql);
// print_r($totalRows);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
// $sql="select p.id,p.pName,p.pSn,p.pNum,p.pDesc,p.pubTime,p.isShow,c.cName from room_tab as p join room_cate c on p.cId=c.id {$where}{$orderBy} limit {$offset},{$pageSize}";
$sql="select *from order_tab limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
// print_r($rows);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
<!--                     <div class="details_operation clearfix"> -->
<!--                         <div class="bui_select"> -->
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addCate()">
<!--                         </div> -->
                            
<!--                     </div> -->
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">编号</th>
                                <th width="10%">教室名称</th>
                                <th width="10%">预约人</th>
                                <th width="15%">预约时间段</th>
                                <th width="15%">预约原因</th>
                                <th width="10%">预约时间</th>
                                <th width="10%">处理</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['pName'];?></td>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['time'];?></td>
                                <td><?php echo $row['reason'];?></td>
                                <td><?php echo $row['ordertime'];?></td>
                             
                                <td><?php 
                                if ($row['permit']==1) {
                                   echo "允许" ;
                                }elseif ($row['permit']==2){
                                    echo "不允许" ;
                                }else{
                                    echo "未处理";
                                }
                                ?></td>
                                <td align="center"><input type="button" value="允许预约" class="btn" onclick="perOrder(<?php echo $row['id'];?>)"><input type="button" value="不允许预约" class="btn"  onclick="noperOrder(<?php echo $row['id'];?>)"></td>
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

	function perOrder(id){
		window.location="doAdminAction.php?act=perorder&id="+id;
	}
	function noperOrder(id){
		if(window.confirm("确定不允许吗？")){
			window.location="doAdminAction.php?act=noper&id="+id;
		}
	}
</script>
</body>
</html>